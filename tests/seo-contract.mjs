/** Preserve the SEO contract when changing shared UI. Run against php -S.
 * node tests/seo-contract.mjs --base http://127.0.0.1:8080
 * --capture intentionally refreshes the reviewed baseline before a change.
 */
import assert from 'node:assert/strict';
import { readFile, writeFile, mkdir } from 'node:fs/promises';
import { fileURLToPath } from 'node:url';
import { chromium } from 'playwright';
import { execFileSync } from 'node:child_process';

const root = fileURLToPath(new URL('../', import.meta.url));
const fixture = new URL('./fixtures/seo-contract.json', import.meta.url);
const args = process.argv.slice(2);
const baseIndex = args.indexOf('--base');
const base = (baseIndex === -1 ? 'http://127.0.0.1:8080' : args[baseIndex + 1]).replace(/\/$/, '');
const capture = args.includes('--capture');
const live = args.includes('--live');
assert.ok(!(capture && live), 'capture the reviewed repository baseline, not live hosting differences');
const privatePaths = new Set(['/lib/helpers.php', '/content/site.php', '/partials/header.php', '/templates/service.php', '/config.example.php', '/logs/leads.log']);
const routes = execFileSync('php', [root + 'deploy/routes.php'], { encoding: 'utf8' })
  .trim().split('\n').map(line => {
    const [path, status] = line.split('\t');
    return { path, status: Number(status) };
  });
const servicePaths = new Set(JSON.parse(execFileSync('php', ['-r',
  `require ${JSON.stringify(root + 'lib/bootstrap.php')}; echo json_encode(array_column(services(), 'path'));`
], { encoding: 'utf8' })));
const browser = await chromium.launch({ executablePath: process.env.CHROMIUM_PATH || undefined });
const parser = await browser.newPage();
const result = { routes: {}, pages: {}, sitemap: [], robots: '' };
try {
  for (const { path, status } of routes) {
    const response = await fetch(base + path, { redirect: 'manual', signal: AbortSignal.timeout(20000) });
    if (live && privatePaths.has(path)) {
      assert.ok([403, 404].includes(response.status), `${path}: internal file must stay inaccessible`);
      if (response.status !== status) console.log(`Hosting difference: ${path} denies access with ${response.status} (local ${status})`);
    } else assert.equal(response.status, status, `HTTP status for ${path}`);
    const body = await response.text();
    const location = response.headers.get('location');
    result.routes[path] = { status, location: location ? new URL(location, base).pathname + new URL(location, base).search : null };
    if (status !== 200) continue;
    if (path === '/robots.txt') { result.robots = body; continue; }
    const parsed = await parser.evaluate(({ body, path, base }) => {
      const doc = new DOMParser().parseFromString(body, path === '/sitemap.xml' ? 'application/xml' : 'text/html');
      const relative = href => {
        const url = new URL(href, base);
        if (url.origin !== new URL(base).origin) throw new Error(`Unexpected SEO/link origin: ${url.origin} for ${href}`);
        return url.pathname + url.search;
      };
      if (path === '/sitemap.xml') return [...doc.querySelectorAll('loc')].map(el => relative(el.textContent)).sort();
      const clean = el => el?.textContent.replace(/\s+/g, ' ').trim() || '';
      const internalLinks = [...doc.querySelectorAll('a[href^="/"]')]
        .map(el => relative(el.getAttribute('href')));
      return {
        title: doc.title,
        description: doc.querySelector('meta[name="description"]')?.getAttribute('content') || '',
        canonical: relative(doc.querySelector('link[rel="canonical"]').getAttribute('href')),
        robots: doc.querySelector('meta[name="robots"]')?.getAttribute('content') || '',
        lang: doc.documentElement.lang,
        h1: [...doc.querySelectorAll('h1')].map(clean),
        alternates: [...doc.querySelectorAll('link[rel="alternate"][hreflang]')]
          .map(el => [el.hreflang, relative(el.getAttribute('href'))]).sort(),
        schemaTypes: [...doc.querySelectorAll('script[type="application/ld+json"]')]
          .flatMap(el => [JSON.parse(el.textContent)['@type']].flat()).sort(),
        internalLinks: [...new Set(internalLinks)].sort()
      };
    }, { body, path, base });
    if (path === '/sitemap.xml') result.sitemap = parsed;
    else result.pages[path] = parsed;
  }
  if (capture) {
    await mkdir(new URL('./fixtures/', import.meta.url), { recursive: true });
    await writeFile(fixture, JSON.stringify(result, null, 2) + '\n');
    console.log(`Captured ${routes.length} routes and ${Object.keys(result.pages).length} pages before implementation`);
  } else {
    const expected = JSON.parse(await readFile(fixture, 'utf8'));
    for (const [path, before] of Object.entries(expected.routes)) {
      if (live && privatePaths.has(path)) assert.equal(result.routes[path].location, null, `${path}: denied without redirect`);
      else assert.deepEqual(result.routes[path], before, `route and redirect target: ${path}`);
    }
    assert.deepEqual(result.sitemap, expected.sitemap, 'indexed sitemap membership');
    assert.equal(result.robots, expected.robots, 'robots.txt');
    for (const [path, before] of Object.entries(expected.pages)) {
      const after = result.pages[path];
      assert.ok(after, `page retained: ${path}`);
      for (const key of ['title', 'description', 'canonical', 'robots', 'lang', 'alternates']) {
        assert.deepEqual(after[key], before[key], `${path}: ${key}`);
      }
      // Keep the original fixture; allow only the documented additive schema.
      const allowedAddition = path === '/' ? 'FAQPage' : servicePaths.has(path) ? 'Service' : null;
      for (const type of before.schemaTypes) assert.ok(after.schemaTypes.includes(type), `${path}: preserved schema ${type}`);
      for (const type of after.schemaTypes) assert.ok(before.schemaTypes.includes(type) || type === allowedAddition, `${path}: unexpected schema ${type}`);
      assert.equal(after.h1.length, 1, `${path}: exactly one H1`);
      if (path === '/') assert.match(after.h1[0], /estudio contable en asunción/i);
      else assert.deepEqual(after.h1, before.h1, `${path}: existing H1`);
      for (const href of before.internalLinks) assert.ok(after.internalLinks.includes(href), `${path}: retained link ${href}`);
    }
    console.log(`SEO contract PASS: ${routes.length} routes, ${Object.keys(result.pages).length} pages, ${result.sitemap.length} sitemap URLs; metadata and internal links preserved`);
  }
} finally {
  await browser.close();
}
