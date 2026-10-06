/** Shared redesign: every public page fits, and the lead actions stay usable. */
import assert from 'node:assert/strict';
import { execFileSync } from 'node:child_process';
import { fileURLToPath } from 'node:url';
import { chromium } from 'playwright';

const root = fileURLToPath(new URL('../', import.meta.url));
const args = process.argv.slice(2), baseIndex = args.indexOf('--base');
const base = (baseIndex < 0 ? 'http://127.0.0.1:8080' : args[baseIndex + 1]).replace(/\/$/, '');
const paths = execFileSync('php', [root + 'deploy/routes.php'], { encoding: 'utf8' }).trim().split('\n')
  .map(line => line.split('\t')).filter(([path, status]) => status === '200' && path.endsWith('/')).map(([path]) => path);
const luminance = rgb => rgb.slice(0, 3).map(v => v / 255)
  .map(v => v <= .04045 ? v / 12.92 : ((v + .055) / 1.055) ** 2.4)
  .reduce((sum, value, i) => sum + value * [.2126, .7152, .0722][i], 0);
const rgb = color => color.match(/[\d.]+/g).map(Number);
const contrast = (fg, bg) => {
  const a = luminance(rgb(fg)), b = luminance(rgb(bg));
  return (Math.max(a, b) + .05) / (Math.min(a, b) + .05);
};
const browser = await chromium.launch({ executablePath: process.env.CHROMIUM_PATH || undefined });
let layouts = 0;
try {
  const page = await browser.newPage({ reducedMotion: 'reduce' });
  const errors = [];
  page.on('pageerror', error => errors.push(String(error)));
  for (const width of [360, 390, 768, 1024, 1440]) {
    await page.setViewportSize({ width, height: 844 });
    for (const path of paths) {
      assert.ok((await page.goto(base + path, { waitUntil: 'domcontentloaded' })).ok(), path);
      await page.evaluate(() => document.fonts.ready);
      assert.ok(await page.evaluate(() => document.documentElement.scrollWidth <= innerWidth + 1), `${path}: overflow at ${width}px`);
      const heading = await page.locator('h1').evaluate(el => ({ family: getComputedStyle(el).fontFamily, weight: getComputedStyle(el).fontWeight }));
      assert.match(heading.family, /Georgia/, `${path}: shared editorial headings`);
      assert.equal(heading.weight, '400', `${path}: readable heading weight`);
      const wa = await page.locator('.wa-fab').evaluate(el => ({ fg: getComputedStyle(el).color, bg: getComputedStyle(el).backgroundColor, height: el.getBoundingClientRect().height }));
      assert.equal(wa.bg, 'rgb(37, 211, 102)', `${path}: green WhatsApp CTA`);
      assert.ok(contrast(wa.fg, wa.bg) >= 4.5, `${path}: WhatsApp text contrast`);
      assert.ok(wa.height >= 48, `${path}: WhatsApp target size`);
      const formChoices = await page.locator('[data-lead-form] .chip').evaluateAll(labels => labels.map(el => {
        let parent = el, bg = 'rgba(0, 0, 0, 0)';
        while (parent && bg === 'rgba(0, 0, 0, 0)') {
          bg = getComputedStyle(parent).backgroundColor;
          parent = parent.parentElement;
        }
        return { text: el.textContent.trim(), fg: getComputedStyle(el).color, bg };
      }));
      for (const choice of formChoices) assert.ok(contrast(choice.fg, choice.bg) >= 4.5, `${path}: form choice contrast for ${choice.text}`);
      if (path === '/' && width <= 390) {
        const bounds = await page.locator('.hero__copy a[href^="https://wa.me/"]').boundingBox();
        assert.ok(bounds.y >= 0 && bounds.y + bounds.height <= 844, `homepage WhatsApp visible in the first ${width}px viewport`);
        assert.ok(await page.locator('.home-portrait img').evaluate(async img => {
          await img.decode();
          return img.currentSrc.includes('consulta-contable-conversacion-cliente') && img.naturalWidth > 0;
        }), 'different homepage photo loads');
      }
      layouts++;
    }
  }
  await page.goto(base);
  const unsure = await page.locator('.unsure').evaluate(el => ({ fg: getComputedStyle(el).color, bg: getComputedStyle(document.body).backgroundColor }));
  assert.ok(contrast(unsure.fg, unsure.bg) >= 4.5, 'homepage enquiry strip text contrast');
  await page.locator('[data-mega-toggle]').click();
  const hoverLink = page.locator('[data-mega] a[href="/eas/"]');
  await hoverLink.hover();
  const hovered = await hoverLink.evaluate(el => ({ fg: getComputedStyle(el).color, bg: getComputedStyle(el).backgroundColor }));
  assert.ok(contrast(hovered.fg, hovered.bg) >= 4.5, 'desktop dropdown hover text contrast');
  await page.keyboard.press('Escape');
  await page.setViewportSize({ width: 390, height: 844 });
  await page.locator('[data-nav-toggle]').click();
  const mobileLink = page.locator('[data-mega] a[href="/eas/"]');
  await mobileLink.focus();
  const focused = await mobileLink.evaluate(el => ({ fg: getComputedStyle(el).color, bg: getComputedStyle(el).backgroundColor }));
  assert.ok(contrast(focused.fg, focused.bg) >= 4.5, 'mobile dropdown focus text contrast');
  await page.keyboard.press('Escape');
  await page.locator('.wa-fab').click();
  await page.locator('[data-wa-menu]:not([hidden])').waitFor();
  await page.keyboard.press('Escape');
  assert.ok(await page.locator('.wa-fab').evaluate(el => el === document.activeElement), 'WhatsApp menu restores keyboard focus');
  assert.deepEqual(errors, [], 'no client-side exceptions');
  console.log(`Editorial design PASS: ${paths.length} pages, ${layouts} layouts; green CTA contrast, mobile hero action, new photo and menu interactions`);
} finally { await browser.close(); }
