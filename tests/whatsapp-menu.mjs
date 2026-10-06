/** Browser contracts for the service picker and mobile floating action.
 * All chat navigation and form delivery are intercepted; no live leads. */
import assert from 'node:assert/strict';
import { mkdir } from 'node:fs/promises';
import { fileURLToPath } from 'node:url';
import { chromium } from 'playwright';

const args = process.argv.slice(2), baseIndex = args.indexOf('--base');
const base = (baseIndex < 0 ? 'http://127.0.0.1:8080' : args[baseIndex + 1]).replace(/\/$/, '');
const browser = await chromium.launch({ executablePath: process.env.CHROMIUM_PATH || undefined });
const screenshots = fileURLToPath(new URL('../docs/screenshots/whatsapp-picker/', import.meta.url));
await mkdir(screenshots, { recursive: true });
let checks = 0;
const pass = message => { checks++; console.log('PASS ' + message); };
try {
  const page = await browser.newPage({ viewport: { width: 1440, height: 900 }, reducedMotion: 'reduce' });
  const errors = [];
  page.on('pageerror', error => errors.push(String(error)));
  await page.route('https://wa.me/**', route => route.abort());
  await page.route('**/enviar.php', route => route.fulfill({ status: 503, contentType: 'application/json', body: '{"ok":false}' }));
  await page.addInitScript(() => document.addEventListener('click', event => {
    if (event.target.closest('.wa-menu__option')) event.preventDefault();
  }));
  const menu = page.locator('[data-wa-menu]');
  const panel = page.locator('.wa-menu__panel');
  const choices = page.locator('.wa-menu__option');
  const textFor = async group => new URL(await page.locator(`[data-wa-group="${group}"]`).getAttribute('href')).searchParams.get('text');
  const assertFits = async () => {
    const bounds = await panel.boundingBox(), size = page.viewportSize();
    assert.ok(bounds.x >= 0 && bounds.y >= 0 && bounds.x + bounds.width <= size.width && bounds.y + bounds.height <= size.height + 1);
    assert.ok(await page.evaluate(() => document.documentElement.scrollWidth <= innerWidth + 1));
  };
  const scrollPastHero = async () => {
    await page.evaluate(() => {
      const hero = document.querySelector('main > section');
      const header = document.querySelector('[data-header]');
      window.scrollTo({ top: hero.getBoundingClientRect().bottom + scrollY - header.getBoundingClientRect().height + 4, behavior: 'instant' });
    });
    await page.waitForFunction(() => document.querySelector('.wa-fab').dataset.waVisible === 'true');
  };

  await page.goto(base);
  assert.equal(await choices.count(), 5);
  assert.equal(await page.locator('a[href^="https://wa.me/"]:not(.wa-menu__option):not([data-wa-enhanced])').count(), 0);
  for (const selector of ['.site-header__actions .btn--whatsapp', '.hero__copy .btn--whatsapp', '.home-service__enquiry[data-service="ips"]', '.home-contact .btn--whatsapp', '.wa-fab']) {
    const trigger = page.locator(selector).first();
    await trigger.click();
    assert.equal(await menu.isVisible(), true);
    assert.equal(await trigger.getAttribute('aria-expanded'), 'true');
    assert.equal(await panel.getAttribute('aria-modal'), 'true');
    assert.ok(await page.locator('main').evaluate(el => el.inert));
    assert.equal(await page.evaluate(() => document.body.style.overflow), 'hidden');
    if (selector.includes('ips')) assert.match(await textFor('ips'), /nómina y el IPS/);
    await assertFits();
    await page.keyboard.press('Escape');
    assert.ok(await trigger.evaluate(el => el === document.activeElement));
    assert.equal(await page.locator('main').evaluate(el => el.inert), false);
    assert.equal(await page.evaluate(() => document.body.style.overflow), '');
  }
  pass('header, hero, service, contact and floating actions open one five-option dialog');

  await page.locator('.wa-fab').focus();
  await page.keyboard.press('Space');
  await page.locator('.wa-menu__close').focus();
  await page.keyboard.press('Shift+Tab');
  assert.ok(await choices.last().evaluate(el => el === document.activeElement));
  await page.keyboard.press('Tab');
  assert.ok(await page.locator('.wa-menu__close').evaluate(el => el === document.activeElement));
  await page.screenshot({ path: screenshots + 'desktop-menu.png' });
  await page.locator('.wa-menu__backdrop').click({ position: { x: 8, y: 8 } });
  assert.equal(await menu.isVisible(), false);
  await page.keyboard.press('Enter');
  await choices.first().click();
  assert.equal(await menu.isVisible(), false);
  pass('Space/Enter, focus trap, Escape, backdrop and option selection work');

  for (const [path, group, intent] of [
    ['/eas/', 'eas', /abrir una EAS/], ['/ruc/', 'eas', /inscribir mi RUC/],
    ['/iva/', 'contabilidad', /liquidación de IVA/], ['/ips/', 'ips', /nómina y el IPS/],
    ['/irp/', 'contabilidad', /presentar el IRP/],
    ['/auditoria/', 'other', /diagnóstico de auditoría/],
  ]) {
    await page.goto(base + path);
    await page.locator('.wa-fab').click();
    assert.equal(await choices.count(), 5);
    assert.equal(await page.locator('.wa-menu__option--current').getAttribute('data-wa-group'), group);
    assert.match(await textFor(group), intent);
    for (const choice of await choices.all()) assert.ok(new URL(await choice.getAttribute('href')).searchParams.get('text').includes('Página: ' + path));
    await page.keyboard.press('Escape');
  }
  pass('service pages keep precise EAS/RUC/IVA/payroll/audit messages inside the matching group');

  await page.goto(base + '/herramientas/vencimientos/');
  await page.locator('#vencimientos-terminacion').selectOption('7');
  await page.locator('#vencimientos-recordar').click();
  for (const choice of await choices.all()) assert.match(new URL(await choice.getAttribute('href')).searchParams.get('text'), /RUC termina en 7/);
  await page.keyboard.press('Escape');
  await page.locator('.wa-fab').click();
  for (const choice of await choices.all()) assert.doesNotMatch(new URL(await choice.getAttribute('href')).searchParams.get('text'), /RUC termina en 7/);
  await page.keyboard.press('Escape');
  pass('calculator context follows the chosen service and does not leak into later openings');

  await page.goto(base + '/contacto/?servicio=contabilidad&plan=pyme');
  const form = page.locator('[data-lead-form]');
  await form.locator('[name=name]').fill('Local Test');
  await form.locator('[name=phone]').fill('0981123456');
  await form.locator('.lead-form__optional').evaluate(el => el.open = true);
  await form.locator('[name=message]').fill('Necesito organizar mis libros.');
  await form.locator('[data-submit]').click();
  await form.locator('[data-form-error]').waitFor({ state: 'visible' });
  await form.locator('[data-form-error] a').click();
  for (const choice of await choices.all()) {
    const text = new URL(await choice.getAttribute('href')).searchParams.get('text');
    assert.match(text, /Local Test/);
    assert.match(text, /Necesito organizar mis libros/);
    assert.match(text, /Pyme/);
  }
  await page.keyboard.press('Escape');
  pass('failed-form recovery retains visitor notes and plan context across all five choices');

  await page.goto(base + '/en/contact/');
  await page.locator('.wa-fab').click();
  assert.match(await panel.textContent(), /Accounting and taxes/);
  assert.doesNotMatch(await panel.textContent(), /Contabilidad|Abrir empresa|Otra consulta/);
  for (const choice of await choices.all()) {
    const text = new URL(await choice.getAttribute('href')).searchParams.get('text');
    assert.match(text, /^Hello/);
    assert.match(text, /Page: \/en\/contact\//);
  }
  await page.keyboard.press('Escape');
  pass('English pages have English choices and messages');

  for (const width of [320, 360, 390, 768]) {
    await page.setViewportSize({ width, height: 844 });
    await page.goto(base);
    await page.locator('.home-portrait img').evaluate(img => img.decode());
    assert.equal(await page.locator('.wa-fab').getAttribute('data-wa-visible'), 'false');
    assert.equal(await page.locator('.wa-fab').getAttribute('aria-hidden'), 'true');
    assert.equal(await page.locator('.wa-fab').getAttribute('tabindex'), '-1');
    if (width === 390) await page.screenshot({ path: screenshots + 'mobile-hero.png' });
    await scrollPastHero();
    await page.locator('.wa-fab').click();
    await assertFits();
    if (width === 390) await page.screenshot({ path: screenshots + 'mobile-menu.png' });
    await page.keyboard.press('Escape');
    if (width === 390) await page.screenshot({ path: screenshots + 'mobile-revealed.png' });
    await page.evaluate(() => window.scrollTo({ top: 0, behavior: 'instant' }));
    await page.waitForFunction(() => document.querySelector('.wa-fab').dataset.waVisible === 'false');
  }
  pass('320–768px: mobile overlay appears after the hero and hides again at the top');

  await page.setViewportSize({ width: 390, height: 844 });
  await page.goto(base);
  await page.locator('[data-nav-toggle]').click();
  await page.locator('.nav-drawer-cta .btn--whatsapp').click();
  assert.equal(await page.locator('[data-nav]').isVisible(), false);
  assert.equal(await menu.isVisible(), true);
  await page.keyboard.press('Escape');
  assert.ok(await page.locator('[data-nav-toggle]').evaluate(el => el === document.activeElement));
  assert.equal(await page.evaluate(() => document.body.style.overflow), '');
  await scrollPastHero();
  await page.reload();
  await page.waitForFunction(() => document.querySelector('.wa-fab').dataset.waVisible === 'true');
  await page.setViewportSize({ width: 1440, height: 900 });
  await page.evaluate(() => window.scrollTo({ top: 0, behavior: 'instant' }));
  assert.equal(await page.locator('.wa-fab').isVisible(), true);
  pass('drawer handoff, restored scroll and resizing preserve focus and visibility');

  await page.setViewportSize({ width: 390, height: 360 });
  await page.goto(base);
  await page.locator('.hero__copy .btn--whatsapp').click();
  await assertFits();
  await choices.last().scrollIntoViewIfNeeded();
  assert.equal(await choices.last().isVisible(), true);
  await page.keyboard.press('Escape');
  assert.ok(await page.locator('.wa-fab').evaluate(el => getComputedStyle(el).transitionDuration.split(',').every(value => parseFloat(value) <= .00001)));
  pass('short screens can scroll every option; reduced motion disables reveal animation');

  await page.emulateMedia({ reducedMotion: 'no-preference' });
  await page.setViewportSize({ width: 390, height: 844 });
  await page.goto(base);
  await scrollPastHero();
  assert.match(await page.locator('.wa-fab').evaluate(el => getComputedStyle(el).transitionDuration), /0.24s/);
  await page.waitForFunction(() => getComputedStyle(document.querySelector('.wa-fab')).opacity === '1');
  pass('normal motion completes a short fade and upward slide');

  const fallback = await browser.newPage({ javaScriptEnabled: false, viewport: { width: 390, height: 844 } });
  await fallback.goto(base + '/eas/');
  assert.equal(await fallback.locator('.wa-fab').isVisible(), true);
  assert.match(new URL(await fallback.locator('.wa-fab').getAttribute('href')).searchParams.get('text'), /abrir una EAS/);
  assert.equal(await fallback.locator('[data-wa-menu]').isVisible(), false);
  await fallback.close();
  pass('no JavaScript keeps the direct service-specific WhatsApp fallback usable');
  assert.deepEqual(errors, [], 'no browser exceptions');
  console.log(`WhatsApp picker PASS: ${checks} interaction contracts`);
} finally { await browser.close(); }
