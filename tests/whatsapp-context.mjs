/** Inspect every public page's real chat links and the deadline tool's changing prefill. */
import assert from 'node:assert/strict';
import { execFileSync } from 'node:child_process';
import { fileURLToPath } from 'node:url';
import { chromium } from 'playwright';
const root = fileURLToPath(new URL('../', import.meta.url));
const args = process.argv.slice(2), option = args.indexOf('--base');
const base = (option < 0 ? 'http://127.0.0.1:8080' : args[option + 1]).replace(/\/$/, '');
const routes = execFileSync('php', [root + 'deploy/routes.php'], { encoding: 'utf8' }).trim().split('\n')
  .map(line => line.split('\t')).filter(([path,status]) => status === '200' && path.endsWith('/')).map(([path]) => path);
const browser = await chromium.launch({ executablePath: process.env.CHROMIUM_PATH || undefined });
try {
  const parser = await browser.newPage();
  let links = 0;
  for (const path of routes) {
    const response = await fetch(base + path);
    assert.ok(response.ok, path);
    const html = await response.text();
    const hrefs = await parser.evaluate(body => Array.from(new DOMParser().parseFromString(body, 'text/html').querySelectorAll('a[href]'))
      .map(a => a.getAttribute('href')).filter(href => href.startsWith('https://wa.me/')), html);
    assert.ok(hrefs.length > 0, `${path} has a WhatsApp route`);
    for (const href of hrefs) {
      const url = new URL(href), text = url.searchParams.get('text');
      assert.equal(url.pathname, '/595995628862', `${path}: confirmed destination`);
      assert.match(text, /contador\.com\.py/, `${path}: website identified`);
      assert.ok(text.includes((path.startsWith('/en/') ? 'Page: ' : 'Página: ') + path), `${path}: correct page`);
      assert.doesNotMatch(text, /utm_|gclid=|fbclid=/, `${path}: no campaign query data in chat`);
      links++;
    }
  }
  const page = await browser.newPage({ reducedMotion: 'reduce' });
  await page.goto(base + '/eas/');
  let text = new URL(await page.locator('.wa-fab').getAttribute('href')).searchParams.get('text');
  assert.match(text, /abrir una EAS/);
  await page.goto(base + '/contacto/?servicio=contabilidad&plan=profesionales&utm_source=private-marker');
  text = new URL(await page.locator('.wa-fab').getAttribute('href')).searchParams.get('text');
  assert.match(text, /contabilidad mensual/);
  assert.doesNotMatch(text, /private-marker/);
  await page.goto(base + '/herramientas/vencimientos/');
  await page.locator('#vencimientos-terminacion').selectOption('2');
  await page.locator('#vencimientos-terminacion').selectOption('7');
  text = new URL(await page.locator('#vencimientos-recordar').getAttribute('href')).searchParams.get('text');
  assert.match(text, /contador\.com\.py/);
  assert.match(text, /Página: \/herramientas\/vencimientos\//);
  assert.match(text, /RUC termina en 7/);
  assert.doesNotMatch(text, /RUC termina en 2/);
  console.log(`WhatsApp contract PASS: ${routes.length} pages, ${links} real links, service/contact-query intent and dynamic deadline message`);
} finally { await browser.close(); }
