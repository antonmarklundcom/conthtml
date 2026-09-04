#!/usr/bin/env node
/**
 * Converts the raw PNGs listed in docs/imagery-manifest.md into the AVIF/WebP
 * files the site actually ships (plan §6.4.1: "pre-optimised to AVIF/WebP ...
 * explicit dimensions, lazy below the fold").
 *
 * Manual pre-step (see docs/imagery-manifest.md — this environment's network
 * egress allows Higgsfield generation but not downloading the CloudFront
 * result URLs): download the 9 PNGs and save them into deploy/imagery-src/
 * using the filenames in the manifest's "Save as" column.
 *
 *     cd deploy && npm i sharp && node optimize-images.mjs
 *
 * Idempotent: re-running only touches files whose source changed.
 */
import sharp from "sharp";
import { existsSync } from "node:fs";
import { mkdir } from "node:fs/promises";
import { dirname, resolve } from "node:path";
import { fileURLToPath } from "node:url";

const here = dirname(fileURLToPath(import.meta.url));
const root = resolve(here, "..");
const srcDir = resolve(root, "deploy/imagery-src");

// slot, source filename, destination (relative to assets/img/), pixel widths.
const MANIFEST = [
  { slot: "icon-contabilidad", src: "icon-contabilidad.png", out: "services/contabilidad", widths: [128] },
  { slot: "icon-impuestos", src: "icon-impuestos.png", out: "services/impuestos", widths: [128] },
  { slot: "icon-nomina", src: "icon-nomina.png", out: "services/nomina", widths: [128] },
  { slot: "icon-apertura", src: "icon-apertura.png", out: "services/apertura", widths: [128] },
  { slot: "icon-facturacion", src: "icon-facturacion.png", out: "services/facturacion", widths: [128] },
  { slot: "icon-auditoria", src: "icon-auditoria.png", out: "services/auditoria", widths: [128] },
  { slot: "hero-portrait", src: "hero-portrait.png", out: "team/portrait", widths: [420, 840] },
  { slot: "team-office", src: "team-office.png", out: "team/office", widths: [420, 840] },
];

// The OG image stays a plain flattened PNG at a fixed size (Open Graph
// consumers don't reliably support AVIF/WebP), so it is handled separately.
const OG = { src: "og-default.png", out: "og-default.png", width: 1200, height: 630 };

async function convertOne({ slot, src, out, widths }) {
  const srcPath = resolve(srcDir, src);
  if (!existsSync(srcPath)) {
    console.warn(`skip ${slot}: ${src} not found in deploy/imagery-src/`);
    return;
  }
  const destDir = resolve(root, "assets/img", dirname(out));
  await mkdir(destDir, { recursive: true });
  const base = resolve(root, "assets/img", out);

  const image = sharp(srcPath);
  const width = Math.max(...widths);
  await image.clone().resize({ width }).avif({ quality: 62 }).toFile(`${base}.avif`);
  await image.clone().resize({ width }).webp({ quality: 72 }).toFile(`${base}.webp`);
  console.log(`wrote ${out}.avif + .webp (${width}px)`);
}

async function convertOg() {
  const srcPath = resolve(srcDir, OG.src);
  if (!existsSync(srcPath)) {
    console.warn(`skip og-default: ${OG.src} not found in deploy/imagery-src/`);
    return;
  }
  const destPath = resolve(root, "assets/img", OG.out);
  await sharp(srcPath)
    .resize({ width: OG.width, height: OG.height, fit: "cover" })
    .flatten({ background: "#0F1B2D" })
    .png({ compressionLevel: 9 })
    .toFile(destPath);
  console.log(`wrote ${OG.out} (${OG.width}x${OG.height})`);
}

for (const entry of MANIFEST) {
  await convertOne(entry);
}
await convertOg();
