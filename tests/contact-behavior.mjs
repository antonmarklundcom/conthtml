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
const excluded = new Set(['.git', '.claude', 'dist', 'docs', 'prompts', 'tests', 'deploy', 'logs', 'config.php', 'config.crm.php']);
const calls = [];
const leads = new Map();
let crmFailure = 0;
const crm = createServer(async (req, res) => {
  if (req.url !== '/api/v1/leads' || req.method !== 'POST' || req.headers['x-api-key'] !== 'local-test-only') {
    res.writeHead(404).end();
    return;
  }
  let body = '';
  for await (const chunk of req) body += chunk;
  const payload = JSON.parse(body);
  calls.push(payload);
  if (crmFailure) {
    res.writeHead(crmFailure, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ error: 'synthetic-rejection' }));
    return;
  }
  const duplicate = leads.has(payload.idempotency_key);
  leads.set(payload.idempotency_key, payload);
  res.writeHead(duplicate ? 200 : 201, { 'Content-Type': 'application/json' });
  res.end(JSON.stringify({ contactId: 'local-contact', dealId: 'local-deal', submissionId: 'local-submission', duplicate }));
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
  assert.ok(await form.locator('[name=phone]').evaluate(el => el === document.activeElement));
  assert.equal(await form.locator('[name=phone]').getAttribute('aria-invalid'), 'true');
  assert.ok(await form.locator('[name=phone]').getAttribute('aria-describedby'));
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
  const acceptedChat = new URL(serviceResult.thanks.whatsapp).searchParams.get('text');
  assert.match(acceptedChat, /contador\.com\.py/);
  assert.match(acceptedChat, /Página: \/eas\//);
  assert.equal(serviceResult.value_tier, 'A', 'tier is resolved server-side');
  assert.equal(calls.at(-1).utm_source, 'first-source');
  assert.equal(calls.at(-1).utm_campaign, 'first-campaign');
  assert.equal(calls.at(-1).gclid, 'first-click');
  assert.equal(calls.at(-1).referrer, firstTouch.referrer);
  assert.equal(await success.locator('.btn--whatsapp').getAttribute('data-service'), 'eas');
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
  const noJS = await browser.newContext({ javaScriptEnabled: false, reducedMotion: 'reduce', viewport: { width: 390, height: 900 } });
  const plain = await noJS.newPage();
  await plain.goto(base + '/eas/');
  assert.ok(await plain.locator('[data-mega] a[href="/eas/"]').isVisible());
  const plainForm = plain.locator('[data-lead-form]').first();
  // Synchronize on the destination document response, then its visible
  // thank-you. A lifecycle wait can miss DOMContentLoaded after a native POST.
  const noJsDestination = () => plain.waitForResponse(response => {
    const url = new URL(response.url());
    return response.request().resourceType() === 'document' && response.status() === 200
      && url.pathname === '/contacto/' && url.searchParams.get('enviado') === '1'
      && url.searchParams.get('s') === 'eas';
  });
  await plainForm.locator('[name=name]').fill('Local No JS Test');
  await plainForm.locator('[name=phone]').fill('0981123456');
  await Promise.all([
    noJsDestination(),
    plainForm.locator('[data-submit]').click({ noWaitAfter: true })
  ]);
  await plain.locator('#gracias').waitFor({ state: 'visible' });
  assert.equal(calls.at(-1).fields.valor, 'A');
  await plain.setViewportSize({ width: 1440, height: 900 });
  await plain.goto(base + '/eas/');
  await plainForm.locator('[name=name]').fill('Local Desktop No JS Test');
  await plainForm.locator('[name=phone]').fill('0981123456');
  await Promise.all([
    noJsDestination(),
    plainForm.locator('[data-submit]').click({ noWaitAfter: true })
  ]);
  await plain.locator('#gracias').waitFor({ state: 'visible' });
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
    assert.ok(await page.locator('[data-wa-trigger]').count() > 0, 'service actions open the shared picker');
    const ids = await page.locator('[id]').evaluateAll(nodes => nodes.map(node => node.id));
    assert.equal(new Set(ids).size, ids.length, `${slug}: forms have distinct IDs`);
    const data = (await page.locator('script[type="application/ld+json"]').allTextContents()).map(JSON.parse);
    const entity = data.find(item => item['@type'] === 'Service');
    assert.equal(entity.url, base + '/' + slug + '/');
    assert.equal(entity.provider['@id'], base + '/#organization');
  }
  pass('buyer FAQ matches visible answers; service forms/schema/WhatsApp picker retain page intent');

  await configure(`http://127.0.0.1:${crm.address().port}`, 'local-test-only', 'G-LOCALTEST');
  await page.route('https://www.googletagmanager.com/**', route => route.fulfill({ contentType: 'application/javascript', body: '' }));
  await page.goto(base, { waitUntil: 'networkidle' });
  await page.locator('.hero__copy .btn--whatsapp').click();
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

  await page.setViewportSize({ width: 1440, height: 900 });
  await page.goto(base + '/eas/');
  await page.locator('[data-mega-toggle]').click();
  const contrast = async link => link.evaluate(el => {
    const rgb = s => s.match(/[\d.]+/g).slice(0, 3).map(Number);
    const lum = c => c.map(v => v / 255).map(v => v <= .04045 ? v / 12.92 : ((v + .055) / 1.055) ** 2.4)
      .reduce((sum, v, i) => sum + v * [.2126, .7152, .0722][i], 0);
    const css = getComputedStyle(el), layers = [];
    for (let ancestor = el; ancestor; ancestor = ancestor.parentElement) layers.push(getComputedStyle(ancestor).backgroundColor);
    const background = layers.reverse().reduce((canvas, layer) => {
      const values = layer.match(/[\d.]+/g).map(Number), alpha = values.length > 3 ? values[3] : 1;
      return canvas.map((v, i) => values[i] * alpha + v * (1 - alpha));
    }, [255,255,255]);
    const fg = lum(rgb(css.color)), bg = lum(background);
    return (Math.max(fg, bg) + .05) / (Math.min(fg, bg) + .05);
  });
  for (const selector of ['a[href="/contabilidad/"]', 'li[data-child] a', 'a[aria-current]']) {
    const link = page.locator('[data-mega]').locator(selector).first();
    await link.hover();
    assert.ok(await contrast(link) >= 4.5, `desktop hover contrast ${selector}`);
    await page.mouse.move(0, 500);
    await page.keyboard.press('Tab');
    await link.focus();
    assert.ok(await contrast(link) >= 4.5, `desktop focus contrast ${selector}`);
  }
  pass('desktop dropdown normal, child and current links meet 4.5:1 hover/focus contrast');

  await page.setViewportSize({ width: 390, height: 844 });
  await page.goto(base);
  await menu.click();
  assert.ok(await menu.evaluate(el => {
    const r = el.getBoundingClientRect();
    return el.contains(document.elementFromPoint(r.x + r.width / 2, r.y + r.height / 2));
  }), 'Close is the actual touch target above the drawer');
  const mobileLink = page.locator('[data-mega] li[data-child] a').first();
  await mobileLink.hover();
  assert.ok(await contrast(mobileLink) >= 4.5);
  await menu.focus();
  await page.keyboard.press('Shift+Tab');
  assert.ok(await page.locator('[data-nav] a').last().evaluate(el => el === document.activeElement));
  await page.keyboard.press('Tab');
  assert.ok(await menu.evaluate(el => el === document.activeElement));
  await menu.click();
  assert.equal(await page.evaluate(() => document.body.style.overflow), '');
  await menu.click();
  await page.locator('[data-nav] a[data-wa-trigger]').click();
  await page.keyboard.press('Escape');
  assert.ok(await menu.evaluate(el => el === document.activeElement), 'closing WhatsApp returns focus to visible menu control');
  assert.equal(await page.evaluate(() => document.body.style.overflow), '');
  pass('mobile Close works by touch; focus loops; WhatsApp link closes drawer and restores focus/scroll');

  await page.goto(base + '/blog/como-se-calcula-el-aguinaldo-en-paraguay/');
  // Use a real article from the site's own directory if the selected slug changes.
  if (!(await page.locator('.article-contents').count())) {
    await page.goto(base + '/blog/');
    const article = await page.locator('a[href^="/blog/"]').filter({ hasText: /aguinaldo/i }).first().getAttribute('href');
    assert.ok(article, 'article directory has an aguinaldo guide');
    await page.goto(base + article);
  }
  const contents = page.locator('.article-contents a');
  assert.ok(await contents.count() > 1);
  for (const href of await contents.evaluateAll(links => links.map(a => a.getAttribute('href')))) {
    assert.equal(await page.locator(href).count(), 1);
  }
  await contents.nth(1).click();
  const anchor = await contents.nth(1).getAttribute('href');
  assert.ok((await page.locator(anchor).boundingBox()).y >= 90, 'article target clears sticky header');
  await page.goto(base + '/nosotros/');
  assert.equal(await page.getByText('Integridad matriculada', { exact: true }).count(), 0);
  assert.equal(await page.getByRole('heading', { name: 'Credenciales', exact: true }).count(), 0);
  await page.goto(base + '/contacto/');
  assert.match(await page.locator('.contact-illustration figcaption').textContent(), /Imagen ilustrativa/);
  pass('article contents targets clear header; About claims respect verified facts; contact illustration is labelled');

  await page.goto(base + '/herramientas/calculadora-aguinaldo/');
  const toolLead = page.locator('[data-lead-form]').first();
  const notes = toolLead.locator('[name=message]');
  await toolLead.locator('details').evaluate(el => { el.open = true; });
  await notes.fill('Mis notas originales');
  await page.locator('#aguinaldo-salario').fill('3000000');
  await page.locator('#aguinaldo-form [type=submit]').click();
  const result = page.locator('#aguinaldo-result');
  assert.ok(await result.evaluate(el => el === document.activeElement));
  assert.match(await result.textContent(), /3\.000\.000/);
  await page.evaluate(() => { window.print = () => { window.printCalled = true; }; });
  await result.locator('[data-print]').click();
  assert.ok(await page.evaluate(() => window.printCalled));
  await page.locator('#aguinaldo-use-result').click();
  assert.match(await notes.inputValue(), /Mis notas originales/);
  assert.ok(await toolLead.locator('[name=tool_result]').inputValue());
  await notes.fill((await notes.inputValue()) + '\nNota añadida');
  await page.locator('#aguinaldo-salario').fill('4000000');
  assert.ok(await result.isHidden());
  assert.equal(await toolLead.locator('[name=tool_result]').inputValue(), '');
  assert.match(await notes.inputValue(), /Mis notas originales/);
  assert.match(await notes.inputValue(), /Nota añadida/);
  assert.doesNotMatch(await notes.inputValue(), /3\.000\.000/);
  await page.locator('#aguinaldo-form [type=submit]').click();
  await page.emulateMedia({ media: 'print' });
  assert.ok(await result.isVisible());
  assert.ok(await page.locator('[data-header]').isHidden());
  assert.ok(await toolLead.isHidden());
  await page.emulateMedia({ media: 'screen' });
  const noJsTools = await browser.newContext({ javaScriptEnabled: false });
  const fallback = await noJsTools.newPage();
  await fallback.goto(base + '/herramientas/calculadora-aguinaldo/');
  assert.ok(await fallback.locator('.tool-fallback a[href="/guias/"]').isVisible());
  assert.ok(await fallback.locator('.tool-form').isHidden());
  assert.ok(await fallback.locator('[data-lead-form]').isVisible());
  await noJsTools.close();
  pass('calculator answer/focus/print, stale attachment removal with preserved notes and no-JS alternatives');

  await page.goto(base + '/herramientas/que-necesita/');
  const quizLead = page.locator('[data-lead-form]').first();
  const originalService = await quizLead.locator('[name=service]').inputValue();
  await page.locator('label[for=qn-quien-abrir]').click();
  await page.locator('#quenecesita-form [type=submit]').click();
  await page.locator('#quenecesita-use-result').click();
  assert.equal(await quizLead.locator('[name=service]').inputValue(), 'eas');
  await page.locator('label[for=qn-quien-persona]').click();
  assert.ok(await page.locator('#quenecesita-result').isHidden());
  assert.equal(await quizLead.locator('[name=service]').inputValue(), originalService);
  assert.equal(await quizLead.locator('[name=tool_result]').inputValue(), '');
  pass('changed quiz answers discard stale service classification and attached recommendation');

  await configure(`http://127.0.0.1:${crm.address().port}/api/v1/leads`, 'local-test-only');
  await clearRate();
  await page.goto(base + '/herramientas/vencimientos/');
  await page.locator('#vencimientos-terminacion').selectOption('3');
  const reminder = page.locator('#vencimientos-recordatorio');
  const firstKey = await reminder.locator('[name=idempotency_key]').inputValue();
  for (let i = 0; i < 2; i++) {
    await reminder.locator('[name=phone]').fill('0981123456');
    const response = page.waitForResponse(res => res.url() === base + '/enviar.php' && res.request().method() === 'POST');
    await reminder.locator('[data-submit]').click();
    assert.equal((await (await response).json()).degraded, false);
    await reminder.locator('[data-form-ok]').waitFor({ state: 'visible' });
    await reminder.locator('[data-submit]').waitFor({ state: 'visible' });
  }
  assert.equal(calls.at(-2).idempotency_key, firstKey);
  assert.notEqual(calls.at(-1).idempotency_key, firstKey);
  assert.equal(calls.at(-1).phone, '+595981123456');
  assert.match(calls.at(-1).fields.resultado_herramienta, /RUC termina en 3/);
  assert.equal(calls.at(-1).fields.servicio, 'Recordatorio de vencimientos');
  pass('complete CRM endpoint accepted; reminder renews successful keys and sends normalized Paraguay phone/result');

  await writeFile(join(site, 'config.crm.php'), `<?php return ['VENDERCRM_URL'=>${quote(`http://127.0.0.1:${crm.address().port}/api/v1/leads`)}, 'VENDERCRM_API_KEY'=>'local-test-only'];`);
  assert.equal((await page.request.get(base + '/config.crm.php')).status(), 404);
  assert.equal((await page.request.get(base + '/deploy/crm-status.php')).status(), 404);
  await page.goto(base + '/contacto/');
  await fill();
  await form.locator('label[for=need-contacto-apertura]').click();
  await clearRate();
  assert.equal((await submit()).service, 'eas');
  await success.waitFor({ state: 'visible' });
  assert.equal(await success.locator('.btn--whatsapp').getAttribute('data-service'), 'eas', 'thank-you changes from initial contact context to accepted service');
  for (const status of [401,403,422,429,500]) {
    crmFailure = status;
    await clearRate();
    const response = await page.request.post(base + '/enviar.php', { headers: { Accept: 'application/json', Origin: base }, form: { phone: '0981123456', idempotency_key: 'rejected-local-' + status } });
    const data = await response.json();
    assert.equal(data.ok, true, 'fallback storage accepts enquiry');
    assert.equal(data.degraded, true, `CRM HTTP ${status} is never reported as CRM success`);
  }
  crmFailure = 0;
  await clearRate();
  await context.addCookies([{ name: 'vc_attr', value: JSON.stringify({ referrer: ['invalid-array'] }), url: base }]);
  const limited = await page.request.post(base + '/enviar.php', { headers: { Accept: 'application/json', Origin: base }, form: { phone: '+46 70 123 45 67', source_page: '/' + 'a'.repeat(1999), idempotency_key: 'payload-limits-local' } });
  assert.equal((await limited.json()).degraded, false);
  assert.equal(calls.at(-1).phone, '+46701234567');
  assert.ok(calls.at(-1).page_url.length <= 2000);
  assert.ok(!('referrer' in calls.at(-1)));
  pass('private files denied, thank-you context updated, rejected CRM responses fall back, payload lengths/types bounded');

  await page.goto(base + '/contacto/');
  await fill();
  await form.locator('details').evaluate(el => { el.open = true; });
  await form.locator('[name=message]').fill('Necesito ayuda con mi empresa');
  const timedKey = await key();
  await page.clock.install();
  await page.route('**/enviar.php', route => new Promise(resolve => {
    page.once('close', resolve); // Never contact a CRM for this stalled-response scenario.
  }));
  await button.click();
  await page.clock.fastForward(31000);
  await error.waitFor({ state: 'visible' });
  assert.equal(await key(), timedKey);
  assert.equal(await form.locator('[name=message]').inputValue(), 'Necesito ayuda con mi empresa');
  assert.equal(await button.isDisabled(), false);
  assert.match(new URL(await error.locator('a').getAttribute('href')).searchParams.get('text'), /Necesito ayuda con mi empresa/);
  assert.match(new URL(await error.locator('a').getAttribute('href')).searchParams.get('text'), /contador\.com\.py/);
  assert.match(new URL(await error.locator('a').getAttribute('href')).searchParams.get('text'), /Página: \/contacto\//);
  await page.unrouteAll({ behavior: 'ignoreErrors' });
  pass('stalled request recovers after deadline; enquiry/key retained and WhatsApp carries entered message');
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
