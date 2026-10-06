/** Real browser → isolated PHP site → local CRM stub. Never uses live leads or credentials.
 * cd tests && npm ci && npx playwright install chromium
 * node contact-behavior.mjs (CHROMIUM_PATH optionally selects an installed browser)
 */
import assert from 'node:assert/strict';
import { cp, mkdtemp, mkdir, readFile, rm, writeFile } from 'node:fs/promises';
import { tmpdir } from 'node:os';
import { join, relative } from 'node:path';
import { fileURLToPath } from 'node:url';
import { createServer } from 'node:http';
import { spawn } from 'node:child_process';
import { chromium } from 'playwright';

const root = fileURLToPath(new URL('../', import.meta.url));
const temp = await mkdtemp(join(tmpdir(), 'contador-contact-test-'));
const site = join(temp, 'site');
const excluded = new Set(['.git', '.claude', 'dist', 'docs', 'prompts', 'tests', 'deploy', 'logs', 'config.php']);
const calls = [];
const leads = new Map();
const crm = createServer(async (req, res) => {
  if (req.url !== '/api/v1/leads' || req.method !== 'POST' || req.headers['x-api-key'] !== 'local-test-only') {
    res.writeHead(404).end();
    return;
  }
  let body = '';
  for await (const chunk of req) body += chunk;
  const payload = JSON.parse(body);
  calls.push(payload);
  const duplicate = leads.has(payload.idempotency_key);
  leads.set(payload.idempotency_key, payload);
  res.writeHead(duplicate ? 200 : 201, { 'Content-Type': 'application/json' });
  res.end(JSON.stringify({ contact_id: 'local-contact', deal_id: 'local-deal', deduplicated: duplicate }));
});
const listen = server => new Promise((resolve, reject) => {
  server.once('error', reject);
  server.listen(0, '127.0.0.1', resolve);
});
const quote = value => "'" + value.replaceAll('\\', '\\\\').replaceAll("'", "\\'") + "'";
let php, browser, phpOutput = '';
let completed = 0;
const pass = message => { completed++; console.log(`PASS ${message}`); };

try {
  await cp(root, site, { recursive: true, filter: source => !excluded.has(relative(root, source).split('/')[0]) });
  await mkdir(join(site, 'logs'));
  await listen(crm);
  const reservation = createServer();
  await listen(reservation);
  const port = reservation.address().port;
  await new Promise(resolve => reservation.close(resolve));
  const base = `http://127.0.0.1:${port}`;
  const configure = async (url, key, ga4 = '', ads = '') => writeFile(join(site, 'config.php'),
    `<?php return ['SITE_URL'=>${quote(base)}, 'VENDERCRM_URL'=>${quote(url)}, 'VENDERCRM_API_KEY'=>${quote(key)}, 'GA4_ID'=>${quote(ga4)}, 'ADS_ID'=>${quote(ads)}];\n`);
  await configure(`http://127.0.0.1:${crm.address().port}`, 'local-test-only');
  // This test rewrites its temporary config between scenarios; bypass opcode caching.
  php = spawn('php', ['-d', 'opcache.enable=0', '-S', `127.0.0.1:${port}`, '-t', site, join(site, 'router.php')]);
  php.stdout.on('data', chunk => { phpOutput += chunk; });
  php.stderr.on('data', chunk => { phpOutput += chunk; });
  php.on('error', error => { phpOutput += String(error); });
  let ready = false;
  for (let attempt = 0; attempt < 60; attempt++) {
    try { ready = (await fetch(base)).ok; } catch {}
    if (ready) break;
    await new Promise(resolve => setTimeout(resolve, 100));
  }
  assert.ok(ready, `isolated PHP server started: ${phpOutput}`);
  browser = await chromium.launch({ executablePath: process.env.CHROMIUM_PATH || undefined });
  const context = await browser.newContext({ reducedMotion: 'reduce' });
  const page = await context.newPage();
  const errors = [];
  page.on('pageerror', error => errors.push(String(error)));
  const routes = ['/', '/contacto/', '/en/contact/', '/contabilidad/', '/eas/', '/nosotros/', '/herramientas/calculadora-aguinaldo/', '/guias/', '/precios/'];
  for (const width of [360, 390, 768, 1024, 1440]) {
    await page.setViewportSize({ width, height: 900 });
    for (const path of routes) {
      assert.ok((await page.goto(base + path)).ok(), `layout route ${path}`);
      await page.evaluate(() => document.fonts.ready);
      assert.equal(await page.locator('h1').count(), 1, `${path}: one H1`);
      assert.ok(await page.evaluate(() => document.documentElement.scrollWidth <= innerWidth + 1), `${path}: no overflow at ${width}`);
    }
  }
  pass('45 layouts across five viewport widths, including pricing/service/tool/English pages');

  // Closed-menu document width misses negative-left overflow. Exercise the open panel.
  for (const width of [901, 960, 1024, 1100, 1280, 1366, 1440, 1920]) {
    await page.setViewportSize({ width, height: 768 });
    await page.goto(base);
    await page.evaluate(() => document.fonts.ready);
    assert.ok(await page.evaluate(() => document.documentElement.scrollWidth <= innerWidth + 1), `closed desktop header fits at ${width}`);
    const trigger = page.locator('[data-mega-toggle]');
    await trigger.focus();
    await page.keyboard.press('Enter');
    assert.equal(await trigger.getAttribute('aria-expanded'), 'true');
    const bounds = await page.locator('[data-mega]').boundingBox();
    assert.ok(bounds.x >= 0 && bounds.x + bounds.width <= width + 1, `opened desktop dropdown fits horizontally at ${width}`);
    assert.ok(bounds.y >= 0 && bounds.y + bounds.height <= 768, `opened desktop dropdown fits vertically at ${width}`);
    assert.equal(await page.locator('[data-mega] a').count(), 15, 'all 14 services and the directory remain available');
    await page.keyboard.press('Escape');
    assert.ok(await trigger.evaluate(el => el === document.activeElement));
  }
  // Resize an open panel into a short browser window; its final link remains reachable.
  await page.locator('[data-mega-toggle]').click();
  await page.setViewportSize({ width: 1024, height: 360 });
  const shortBounds = await page.locator('[data-mega]').boundingBox();
  assert.ok(shortBounds.x >= 0 && shortBounds.x + shortBounds.width <= 1025);
  assert.ok(shortBounds.y >= 0 && shortBounds.y + shortBounds.height <= 360);
  const lastServiceLink = page.locator('[data-mega] a[href="/servicios/"]');
  await lastServiceLink.focus();
  const lastBounds = await lastServiceLink.boundingBox();
  assert.ok(lastBounds.y >= 0 && lastBounds.y + lastBounds.height <= 360, 'last menu link can be focused inside the short viewport');
  assert.ok(await page.locator('[data-mega]').evaluate(el => el.scrollTop > 0), 'short menu scrolls internally');
  await page.keyboard.press('Escape');
  pass('opened desktop menu fits eight screen widths and short-window resizing; all service links remain reachable');

  await page.setViewportSize({ width: 390, height: 900 });
  await page.goto(base);
  const menu = page.locator('[data-nav-toggle]');
  await menu.focus();
  await page.keyboard.press('Enter');
  assert.equal(await menu.getAttribute('aria-expanded'), 'true');
  assert.ok(await page.locator('[data-mega] a[href="/eas/"]').isVisible());
  await page.keyboard.press('Escape');
  assert.equal(await menu.getAttribute('aria-expanded'), 'false');
  assert.ok(await menu.evaluate(el => el === document.activeElement));
  pass('mobile menu opens by keyboard and Escape restores focus');

  const clearRate = () => rm(join(site, 'logs/rate'), { recursive: true, force: true });
  const form = page.locator('[data-lead-form]').first();
  const button = form.locator('[data-submit]');
  const error = form.locator('[data-form-error]');
  const success = form.locator('[data-form-ok]');
  const key = () => form.locator('[name=idempotency_key]').inputValue();
  const fill = async () => {
    await form.locator('[name=name]').fill('Local Browser Test');
    await form.locator('[name=phone]').fill('0981123456');
  };
  const submit = async () => {
    const response = page.waitForResponse(res => res.url() === base + '/enviar.php' && res.request().method() === 'POST');
    await button.click();
    return (await response).json();
  };
  await page.goto(base + '/contacto/');
  const beforeEmpty = calls.length;
  await button.click();
  assert.equal(await form.locator('[name=name]').evaluate(el => el.validity.valueMissing), true);
  assert.equal(calls.length, beforeEmpty);
  await fill();
  await form.locator('summary').click();
  await form.locator('[name=email]').fill('invalid-email');
  await form.locator('summary').click();
  await button.click();
  assert.ok(await form.locator('details').evaluate(el => el.open));
  assert.ok(await form.locator('[name=email]').evaluate(el => el === document.activeElement));
  assert.equal(calls.length, beforeEmpty);
  await form.locator('[name=email]').fill('');
  await form.locator('[name=phone]').fill('abc');
  assert.equal((await submit()).error, 'phone');
  await error.waitFor({ state: 'visible' });
  assert.equal(await error.locator('[data-form-error-message]').textContent(), await form.getAttribute('data-error-phone'));
  assert.ok(await error.evaluate(el => el === document.activeElement));
  assert.equal(await form.locator('[name=name]').inputValue(), 'Local Browser Test');
  assert.ok(await error.locator('a').getAttribute('href').then(href => href.startsWith('https://wa.me/')));
  pass('required fields, optional email validation, localized server errors and accessible recovery');

  await clearRate();
  await fill();
  const originalKey = await key();
  const beforeLost = leads.size;
  await page.route('**/enviar.php', async route => {
    await route.fetch(); // The CRM accepted it; the browser loses the response.
    await route.abort('failed');
  }, { times: 1 });
  await button.click();
  await error.waitFor({ state: 'visible' });
  await page.waitForFunction(() => document.querySelector('[data-lead-form]').getAttribute('aria-busy') === 'false');
  assert.equal(leads.size, beforeLost + 1);
  assert.equal(await key(), originalKey);
  assert.equal(await form.locator('[name=phone]').inputValue(), '0981123456');
  assert.ok(await button.isEnabled());
  assert.ok((await submit()).ok);
  await success.waitFor({ state: 'visible' });
  assert.ok(await success.evaluate(el => el === document.activeElement));
  assert.equal(leads.size, beforeLost + 1, 'retry creates no second lead');
  assert.equal(calls.at(-1).idempotency_key, originalKey);
  assert.notEqual(await key(), originalKey, 'confirmed success gets a fresh enquiry key');
  assert.equal(await form.locator('[name=name]').inputValue(), '');
  assert.ok(!('email' in calls.at(-1)), 'empty email is omitted from CRM payload');
  pass('lost-response retry retains details/key, deduplicates and resets only after success');

  await clearRate();
  const firstTouch = { utm_source: 'first-source', utm_campaign: 'first-campaign', gclid: 'first-click', referrer: 'https://search.example/' };
  await context.addCookies([{ name: 'vc_attr', value: JSON.stringify(firstTouch), url: base }]);
  await page.goto(base + '/eas/?utm_source=later-source&utm_campaign=later-campaign');
  await fill();
  await form.locator('[name=value_tier]').evaluate(el => { el.value = 'C'; });
  const serviceResult = await submit();
  await success.waitFor({ state: 'visible' });
  assert.equal(serviceResult.service, 'eas');
  assert.equal(serviceResult.value_tier, 'A', 'tier is resolved server-side');
  assert.equal(calls.at(-1).utm_source, 'first-source');
  assert.equal(calls.at(-1).utm_campaign, 'first-campaign');
  assert.equal(calls.at(-1).gclid, 'first-click');
  assert.equal(calls.at(-1).referrer, firstTouch.referrer);
  pass('first-touch attribution survives later campaign queries and service tiers resist tampering');

  await clearRate();
  await page.goto(base + '/en/contact/');
  assert.equal(await form.locator('[name=lang]').inputValue(), 'en');
  assert.equal(await form.locator('[name=need]').inputValue(), 'apertura');
  assert.equal(await form.locator('[name=service]').inputValue(), 'empresas-extranjeras');
  assert.equal(await form.locator('[name=need][type=radio]').count(), 0);
  await fill();
  assert.ok((await submit()).ok);
  await success.waitFor({ state: 'visible' });
  assert.equal(calls.at(-1).fields.valor, 'A');
  pass('English shared form retains language, service and lead routing');

  await clearRate();
  const noJS = await browser.newContext({ javaScriptEnabled: false, viewport: { width: 390, height: 900 } });
  const plain = await noJS.newPage();
  await plain.goto(base + '/eas/');
  assert.ok(await plain.locator('[data-mega] a[href="/eas/"]').isVisible());
  const plainForm = plain.locator('[data-lead-form]').first();
  await plainForm.locator('[name=name]').fill('Local No JS Test');
  await plainForm.locator('[name=phone]').fill('0981123456');
  await Promise.all([
    plain.waitForURL(url => url.pathname === '/contacto/' && url.searchParams.get('enviado') === '1' && url.searchParams.get('s') === 'eas', { waitUntil: 'domcontentloaded' })
      .catch(error => { throw new Error(`No-JS redirect failed at ${plain.url()}: ${error.message}`); }),
    plainForm.locator('[data-submit]').click()
  ]);
  assert.ok(await plain.locator('#gracias').isVisible());
  assert.equal(calls.at(-1).fields.valor, 'A');
  await plain.setViewportSize({ width: 1440, height: 900 });
  await plain.goto(base + '/eas/');
  await plainForm.locator('[name=name]').fill('Local Desktop No JS Test');
  await plainForm.locator('[name=phone]').fill('0981123456');
  await Promise.all([
    plain.waitForURL(url => url.pathname === '/contacto/' && url.searchParams.get('s') === 'eas', { waitUntil: 'domcontentloaded' }),
    plainForm.locator('[data-submit]').click()
  ]);
  assert.ok(await plain.locator('#gracias').isVisible());
  await noJS.close();
  pass('mobile/desktop no-JS navigation and ordinary POST retain per-service thank-you');

  await configure('https://crm.example.test', '');
  await context.clearCookies();
  let scriptLoads = 0;
  await page.route('https://crm.example.test/vc-attribution.js', route => {
    scriptLoads++;
    return route.fulfill({ contentType: 'application/javascript', body: `if (!document.cookie.includes('vc_attr=')) document.cookie = 'vc_attr=' + encodeURIComponent(JSON.stringify({utm_source: new URLSearchParams(location.search).get('utm_source')})) + '; Path=/; SameSite=Lax';` });
  });
  await page.goto(base + '/?utm_source=captured-first', { waitUntil: 'networkidle' });
  await page.goto(base + '/contacto/?utm_source=later', { waitUntil: 'networkidle' });
  assert.equal(scriptLoads, 2, 'configured HTTPS script loaded on both pages');
  await clearRate();
  await fill();
  assert.ok((await submit()).degraded);
  await success.waitFor({ state: 'visible' });
  const logs = (await readFile(join(site, 'logs/leads.log'), 'utf8')).trim().split('\n').map(JSON.parse);
  assert.equal(logs.at(-1).utm_source, 'captured-first');
  await configure('', '');
  await page.goto(base);
  assert.equal(await page.locator('script[src$="/vc-attribution.js"]').count(), 0);
  pass('HTTPS attribution script wiring preserves capture across pages; unset config sends no request');

  await configure(`http://127.0.0.1:${crm.address().port}`, 'local-test-only');
  await clearRate();
  await page.goto(base + '/precios/');
  await page.locator('a[href="/contacto/?servicio=contabilidad&plan=pyme"]').click();
  assert.equal(await form.locator('[name=service]').inputValue(), 'contabilidad');
  assert.equal(await form.locator('[name=plan]').inputValue(), 'pyme');
  assert.match(await form.locator('.lead-form__context').textContent(), /Pyme/);
  assert.equal(await page.locator('link[rel=canonical]').getAttribute('href'), base + '/contacto/');
  await fill();
  assert.equal((await submit()).value_tier, 'A');
  await success.waitFor({ state: 'visible' });
  assert.equal(calls.at(-1).message, 'Plan solicitado: Pyme');
  await page.goto(base + '/contacto/?servicio=%3Cscript%3E&plan=unknown');
  assert.equal(await form.locator('[name=service]').inputValue(), '');
  assert.equal(await form.locator('[name=plan]').count(), 0);
  pass('pricing → contact preserves a validated plan/service, canonical and CRM message');

  await page.goto(base);
  const schema = await page.locator('script[type="application/ld+json"]').allTextContents();
  const faq = schema.map(JSON.parse).find(item => item['@type'] === 'FAQPage');
  assert.ok(faq, 'home has FAQ schema');
  const visibleFAQ = await page.locator('.home-faq details').evaluateAll(nodes => nodes.map(node => ({
    q: node.querySelector('summary').textContent.trim(), a: node.querySelector('p').textContent.trim()
  })));
  assert.deepEqual(faq.mainEntity.map(item => ({ q: item.name, a: item.acceptedAnswer.text })), visibleFAQ);
  for (const slug of ['contabilidad', 'eas', 'iva', 'ips', 'ekuatia', 'auditoria']) {
    await page.goto(base + '/' + slug + '/');
    const quick = page.locator('#consulta-rapida');
    assert.equal(await quick.locator('[name=service]').inputValue(), slug);
    assert.equal(await quick.locator('[name=need][type=radio]').count(), 0);
    assert.equal(await page.locator('[data-wa-trigger]').count(), 0, 'service actions go directly to WhatsApp');
    const ids = await page.locator('[id]').evaluateAll(nodes => nodes.map(node => node.id));
    assert.equal(new Set(ids).size, ids.length, `${slug}: forms have distinct IDs`);
    const data = (await page.locator('script[type="application/ld+json"]').allTextContents()).map(JSON.parse);
    const entity = data.find(item => item['@type'] === 'Service');
    assert.equal(entity.url, base + '/' + slug + '/');
    assert.equal(entity.provider['@id'], base + '/#organization');
  }
  pass('buyer FAQ matches visible answers; service forms/schema/direct WhatsApp retain page intent');

  await configure(`http://127.0.0.1:${crm.address().port}`, 'local-test-only', 'G-LOCALTEST');
  await page.route('https://www.googletagmanager.com/**', route => route.fulfill({ contentType: 'application/javascript', body: '' }));
  await page.goto(base, { waitUntil: 'networkidle' });
  await page.locator('.wa-fab').click();
  let events = await page.evaluate(() => window.dataLayer.filter(item => item[0] === 'event').map(item => [item[1], item[2]]));
  assert.equal(events.filter(item => item[0] === 'whatsapp_menu_open').length, 1);
  assert.equal(events.filter(item => item[0] === 'whatsapp_click').length, 0, 'opening a chooser is not a chat click');
  // Capture intent without navigating to WhatsApp or sending a message.
  await page.evaluate(() => document.addEventListener('click', event => {
    if (event.target.closest('a[href^="https://wa.me/"]')) event.preventDefault();
  }));
  await page.locator('.wa-menu__option[data-service=contabilidad]').click();
  events = await page.evaluate(() => window.dataLayer.filter(item => item[0] === 'event').map(item => [item[1], item[2]]));
  assert.equal(events.filter(item => item[0] === 'whatsapp_click').length, 1);
  assert.equal(events.find(item => item[0] === 'whatsapp_click')[1].service, 'contabilidad');
  await page.goto(base + '/eas/');
  await clearRate();
  await fill();
  assert.ok((await submit()).ok);
  await success.waitFor({ state: 'visible' });
  events = await page.evaluate(() => window.dataLayer.filter(item => item[0] === 'event').map(item => [item[1], item[2]]));
  const leadEvents = events.filter(item => item[0] === 'lead_submit');
  assert.equal(leadEvents.length, 1);
  assert.equal(leadEvents[0][1].service, 'eas');
  assert.equal(leadEvents[0][1].value, 1000000);
  assert.ok(!JSON.stringify(events).includes('Local Browser Test'), 'no lead name in analytics');
  assert.ok(!JSON.stringify(events).includes('0981123456'), 'no phone in analytics');
  await configure('', '', '', 'AW-LOCALTEST');
  await page.goto(base);
  assert.ok(await page.evaluate(() => window.siteAnalytics.enabled), 'Ads-only config enables event commands');
  pass('gtag receives real event commands; menu opens and chat clicks are separate; accepted leads contain no PII');

  await configure('', '');
  await clearRate();
  await rm(join(site, 'logs/leads.log'));
  await mkdir(join(site, 'logs/leads.log')); // A deterministic local storage fault.
  await page.goto(base + '/contacto/');
  await fill();
  const deliveryKey = await key();
  const failedDelivery = await submit();
  assert.equal(failedDelivery.ok, false);
  assert.equal(failedDelivery.error, 'delivery');
  await error.waitFor({ state: 'visible' });
  assert.equal(await key(), deliveryKey);
  assert.equal(await form.locator('[name=phone]').inputValue(), '0981123456');
  assert.ok(await success.isHidden());
  await configure(`http://127.0.0.1:${crm.address().port}`, 'local-test-only');
  await clearRate();
  const acceptedDespiteLog = await submit();
  assert.equal(acceptedDespiteLog.ok, true, 'CRM acceptance survives an unavailable local log');
  await success.waitFor({ state: 'visible' });
  await rm(join(site, 'logs/leads.log'), { recursive: true });
  pass('all-channel failure retains enquiry/key; confirmed CRM acceptance remains successful');
  assert.deepEqual(errors, [], 'no uncaught JavaScript errors');
  assert.doesNotMatch(phpOutput, /PHP (Warning|Fatal error|Parse error)/);
  console.log(`Contact/browser contract PASS: ${completed} checks; real PHP and local mock CRM only`);
} finally {
  await browser?.close();
  if (php && php.exitCode === null) {
    const stopped = new Promise(resolve => php.once('exit', resolve));
    php.kill();
    await stopped;
  }
  await new Promise(resolve => crm.close(resolve));
  await rm(temp, { recursive: true, force: true });
}
