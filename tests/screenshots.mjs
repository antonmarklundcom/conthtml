/**
 * Captures the PR preview screenshots (plan §4.12): every page named on the
 * command line, at 1440 and 390 px, into docs/screenshots/<phase>/.
 *
 *   cd tests && npm ci
 *   node screenshots.mjs --phase a1 --base http://127.0.0.1:8080 / /servicios/
 *
 * The site is plain PHP; Node lives here and only here.
 */
import { chromium } from "playwright";
import { mkdir } from "node:fs/promises";
import { dirname, resolve } from "node:path";
import { fileURLToPath } from "node:url";

const here = dirname(fileURLToPath(import.meta.url));

const args = process.argv.slice(2);
const opt = (name, fallback) => {
  const i = args.indexOf(`--${name}`);
  return i === -1 ? fallback : args[i + 1];
};

const phase = opt("phase", "a1");
const base = opt("base", "http://127.0.0.1:8080");
const paths = args.filter((a) => a.startsWith("/"));

if (paths.length === 0) {
  console.error("no paths given");
  process.exit(2);
}

const widths = [
  { label: "1440", width: 1440, height: 1400 },
  { label: "390", width: 390, height: 1400 }
];

const outDir = resolve(here, "..", "docs", "screenshots", phase);
await mkdir(outDir, { recursive: true });

const browser = await chromium.launch();
let failures = 0;

for (const path of paths) {
  const name = path === "/" ? "home" : path.replace(/^\/|\/$/g, "").replace(/\//g, "-");

  for (const { label, width, height } of widths) {
    const context = await browser.newContext({
      viewport: { width, height },
      deviceScaleFactor: 2,
      reducedMotion: "reduce"
    });

    /* Injected before the first paint, not after load. A page-length capture
       repaints sticky and fixed elements as it goes, so the sticky header and
       the WhatsApp button ghost over the top of the image — which reads as a
       layout bug in the PR even though the live page is fine. Neutralising the
       positioning before anything is painted is the only reliable fix; the
       elements still appear, at their document position. */
    await context.addInitScript(() => {
      const css = `.site-header { position: static !important; }
                   body { position: relative !important; }
                   .wa-fab { position: absolute !important; top: auto !important; }`;
      const apply = () => {
        const style = document.createElement("style");
        style.textContent = css;
        document.head.appendChild(style);
      };
      if (document.head) {
        apply();
      } else {
        document.addEventListener("DOMContentLoaded", apply);
      }
    });

    const page = await context.newPage();

    const errors = [];
    page.on("pageerror", (e) => errors.push(String(e)));
    page.on("console", (m) => m.type() === "error" && errors.push(m.text()));

    const response = await page.goto(base + path, { waitUntil: "networkidle" });
    if (!response || !response.ok()) {
      console.error(`  ${path} @${label}: HTTP ${response ? response.status() : "no response"}`);
      failures++;
    }

    /* Fonts must be settled or the shot catches the fallback face mid-swap. */
    await page.evaluate(() => document.fonts.ready);



    /* No page may scroll horizontally. This is checked on every phase's
       screenshot run because it is easy to reintroduce and invisible until
       someone opens the site on a phone: an absolutely-positioned element in a
       wrapping flex row did exactly this to /contacto/ in A1. */
    const overflow = await page.evaluate(() => {
      const de = document.documentElement;
      if (de.scrollWidth <= de.clientWidth) return null;
      const culprits = [...document.querySelectorAll("*")]
        .filter((el) => el.getBoundingClientRect().right > de.clientWidth + 1)
        .map((el) => `${el.tagName.toLowerCase()}.${String(el.className).split(" ")[0]}`);
      return { scrollWidth: de.scrollWidth, clientWidth: de.clientWidth, culprits: [...new Set(culprits)] };
    });
    if (overflow) {
      console.error(
        `  horizontal overflow on ${path} @${label}: ` +
          `${overflow.scrollWidth}px wide in a ${overflow.clientWidth}px viewport ` +
          `(${overflow.culprits.slice(0, 5).join(", ")})`
      );
      failures++;
    }

    /* Walk the page once before capturing. Chromium paints lazily, and a
       page-length screenshot of a never-scrolled document leaves bottom-of-page
       content ghosted into the top of the image. Scrolling forces every tile to
       paint for real, then we return to the top for the shot. */
    await page.evaluate(async () => {
      const step = window.innerHeight;
      for (let y = 0; y < document.body.scrollHeight; y += step) {
        window.scrollTo(0, y);
        await new Promise((r) => setTimeout(r, 60));
      }
      window.scrollTo(0, 0);
      await new Promise((r) => setTimeout(r, 400));
      await new Promise(requestAnimationFrame);
    });

    const file = `${outDir}/${name}-${label}.png`;
    await page.screenshot({ path: file, fullPage: true });
    console.log(`  ${file.replace(resolve(here, ".."), "")}`);

    if (errors.length) {
      console.error(`  console errors on ${path} @${label}:`);
      errors.forEach((e) => console.error(`    ${e}`));
      failures++;
    }

    await context.close();
  }
}

await browser.close();
process.exit(failures === 0 ? 0 : 1);
