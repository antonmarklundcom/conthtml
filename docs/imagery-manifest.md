# Imagery manifest (B4, plan §6.4.1)

Generated via the Higgsfield MCP this phase, following the `higgsfield-web-imagery`
skill (cost preflight, one style Element per mode, ≤ 12 generations — **9 used**).
Illustrative only: no captioned identity claims, no readable text/logos/signage in
any photo, no recognisable public figures (skill rule 1).

## Why the files are not in the repo yet

This session's outbound network egress allows the Higgsfield **generation** API
(MCP tool calls) but denies the CloudFront CDN the **result images** are served
from (`d8j0ntlcm91z4.cloudfront.net` — `curl` returns `403 connect_rejected,
organization policy`). This matches the skill's "Anthropic chat sandbox" case
(`SKILL.md` Step 6.0) even though this is a Claude Code session: generation works,
downloading the bytes does not. There is no human present in this run to do the
one-step manual bridge (download from Higgsfield → upload back), so the images
exist in Anton's Higgsfield account and job history, fully specified below, but
are not yet AVIF/WebP files in `assets/img/`.

**To finish (one-time manual step, ~10 minutes):**

1. Open [higgsfield.ai](https://higgsfield.ai) → Generations (or use the 9 result
   URLs below while they remain valid) and download each PNG.
2. Save them into `deploy/imagery-src/` using the **exact filenames** in the
   "Save as" column below.
3. `cd deploy && npm i sharp && node optimize-images.mjs` — converts each to
   AVIF + WebP at the widths listed, writes them into `assets/img/`.
4. Apply the four wiring snippets in "Code changes to apply" below.
5. `./verify.sh`, re-run Lighthouse, commit.

Two style Elements were registered for consistency (`show_reference_elements`):
icon set `contador-icon-set` (`d57b9115-6995-464e-b8f4-20773e2cd700`) and photo
style `contador-photo-style` (`af359e06-d4ce-4948-8026-dd0415d64c2e`) — reusable
for any future image on this site without spending a new reference generation.

## The 9 images

| # | Job ID | Save as (`deploy/imagery-src/`) | Model | Result URL |
|---|---|---|---|---|
| 1 | `30425f5c-54f0-48d5-a0b4-523d8442f31d` | `icon-contabilidad.png` | nano_banana_2_lite | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030357_30425f5c-54f0-48d5-a0b4-523d8442f31d.png |
| 2 | `f98220f7-dc37-4577-9a74-e5fb8ae899dc` | `icon-impuestos.png` | nano_banana_2_lite | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030540_f98220f7-dc37-4577-9a74-e5fb8ae899dc.png |
| 3 | `b5d85810-d9ea-408d-97d4-f727c1196211` | `icon-nomina.png` | nano_banana_2_lite | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030540_b5d85810-d9ea-408d-97d4-f727c1196211.png |
| 4 | `cf9eaf44-3ae8-4e8c-a908-025689e1b9a9` | `icon-apertura.png` | nano_banana_2_lite | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030540_cf9eaf44-3ae8-4e8c-a908-025689e1b9a9.png |
| 5 | `882aab52-bca3-486c-ac20-7ffe2a57a51a` | `icon-facturacion.png` | nano_banana_2_lite | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030540_882aab52-bca3-486c-ac20-7ffe2a57a51a.png |
| 6 | `babe2ec6-0e4b-4e20-bd25-4a00c21af1eb` | `icon-auditoria.png` | nano_banana_2_lite | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030540_babe2ec6-0e4b-4e20-bd25-4a00c21af1eb.png |
| 7 | `d7bd9424-8b18-447d-85af-18309d87b9cd` | `hero-portrait.png` | nano_banana_2 (routed to nano_banana_flash) | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030553_d7bd9424-8b18-447d-85af-18309d87b9cd.png |
| 8 | `4f34d026-ddc5-443b-9d46-45da5d106ceb` | `team-office.png` | nano_banana_2 (routed to nano_banana_flash) | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030627_4f34d026-ddc5-443b-9d46-45da5d106ceb.png |
| 9 | `36fa196f-8d78-412f-8e8e-d2265bf802a8` | `og-default.png` | nano_banana_2 (routed to nano_banana_flash) | https://d8j0ntlcm91z4.cloudfront.net/user_349VrHjTFIpx9q71lpfpAXcLXvR/hf_20260904_030627_36fa196f-8d78-412f-8e8e-d2265bf802a8.png |

Full prompts (including the negative constraints — no text/logos/names/signage,
no recognisable public figures) are in each job's params; they are also embedded
in `deploy/optimize-images.mjs`'s manifest array as a comment per entry, and can
be re-fetched any time with `show_generation_by_ids` using the job IDs above.

## Target slots and alt text

| Save as | Destination | Output files | Sizes | Alt text (es-PY) |
|---|---|---|---|---|
| `icon-contabilidad.png` | `#servicios .grid > :nth-child(1)` background | `assets/img/services/contabilidad.avif` + `.webp` | 128px | decorative (CSS background, no `<img>`, no alt needed) |
| `icon-impuestos.png` | `#servicios .grid > :nth-child(2)` background | `assets/img/services/impuestos.avif` + `.webp` | 128px | decorative |
| `icon-nomina.png` | `#servicios .grid > :nth-child(3)` background | `assets/img/services/nomina.avif` + `.webp` | 128px | decorative |
| `icon-apertura.png` | `#servicios .grid > :nth-child(4)` background | `assets/img/services/apertura.avif` + `.webp` | 128px | decorative |
| `icon-facturacion.png` | `#servicios .grid > :nth-child(5)` background | `assets/img/services/facturacion.avif` + `.webp` | 128px | decorative |
| `icon-auditoria.png` | `#servicios .grid > :nth-child(6)` background | `assets/img/services/auditoria.avif` + `.webp` | 128px | decorative |
| `hero-portrait.png` | homepage `content('site')['photos']['portrait']` | `assets/img/team/portrait.avif` + `.webp` | 420×560 | "Contador trabajando con planillas y una calculadora en una oficina en Asunción" |
| `team-office.png` | homepage `content('site')['photos']['team']` | `assets/img/team/office.avif` + `.webp` | 420×420 | "Dos contadores revisando informes financieros en una oficina" |
| `og-default.png` | `assets/img/og-default.png` (replaces the A1 placeholder) | `assets/img/og-default.png` (flattened PNG, no `<picture>` — OG needs one static URL) | 1200×630 | n/a (social preview, no `<img>` tag) |

The six service-card icons intentionally do **not** go through
`partials/service-card-grid.php` — that partial is locked for B-phases (plan
§5.2.3, its own docblock: "locked for B-phases"). They are wired as pure CSS
`background-image` on the homepage's `#servicios` grid children instead, which
needs no partial or template edit. See the CSS snippet below.

## Code changes to apply once the files exist

**1. `content/site.php`** — fills the already-built, already-tested photo slots
(see A2 build log: "verified against temporary fixture data ... and then
reverted"):

```php
'photos' => [
    'portrait' => ['src' => '/assets/img/team/portrait.avif', 'alt' => 'Contador trabajando con planillas y una calculadora en una oficina en Asunción'],
    'team'     => ['src' => '/assets/img/team/office.avif',   'alt' => 'Dos contadores revisando informes financieros en una oficina'],
],
```

`asset()` cache-busts by mtime, and the `<img>` markup, `width`/`height` and the
`figures--empty` fallback are already built in `index.php` (plan §6.4.1's "no
layout shift on the hero panel" — the slots are pre-sized 420×560 / 420×420, so
filling them causes zero CLS). AVIF has no universal fallback in this repo's
`<img>` markup (no `<picture>`); given the site's minimum-supported-browser bar
(evergreen mobile Chrome/Safari, plan §1.5 has no legacy-browser requirement)
AVIF alone is acceptable here — WebP is still produced by the script as a
same-directory fallback if a later phase wants to add a `<picture>` wrapper.

**2. `assets/css/site.css`** — new block below tokens, `/* == b4 service icons
== */`, appended after the `/* == b4 polish == */` block this phase already
added:

```css
#servicios .grid > :nth-child(1) { background: url("/assets/img/services/contabilidad.avif") no-repeat top 20px right 20px / 40px auto; }
#servicios .grid > :nth-child(2) { background: url("/assets/img/services/impuestos.avif") no-repeat top 20px right 20px / 40px auto; }
#servicios .grid > :nth-child(3) { background: url("/assets/img/services/nomina.avif") no-repeat top 20px right 20px / 40px auto; }
#servicios .grid > :nth-child(4) { background: url("/assets/img/services/apertura.avif") no-repeat top 20px right 20px / 40px auto; }
#servicios .grid > :nth-child(5) { background: url("/assets/img/services/facturacion.avif") no-repeat top 20px right 20px / 40px auto; }
#servicios .grid > :nth-child(6) { background: url("/assets/img/services/auditoria.avif") no-repeat top 20px right 20px / 40px auto; }
```

(Purely decorative background images — no markup change, no alt text needed,
no CLS since background-images never occupy box space.)

**3. `assets/img/og-default.png`** — replace the A1 placeholder with the
converted, flattened `og-default.png` (1200×630, still PNG — Open Graph
consumers don't reliably support AVIF/WebP yet, so this one stays a plain PNG
even though the others go AVIF/WebP).

**4. Re-run `./verify.sh`, retake B4 screenshots, re-measure Lighthouse** (image
weight affects the perf budget — see plan §6.4.2's ≤ 120 KB hero rule).

## Cost

9 generations against a 5,822-credit balance: 6 × `nano_banana_2_lite` (1
credit each) + 3 × `nano_banana_flash` (the account's `nano_banana_2` request
was auto-routed to `nano_banana_flash`) ≈ 9–13.5 credits total. Well inside the
skill's monthly-budget guidance and the phase's own ≤ 12 generation cap.

## Keyword-round guide images (2026-10-18)

Ten guide thumbnails (one per new guide), Nano Banana 2.1 (`nano_banana_2_1`) via
the Higgsfield MCP, `resolution: 2k`, `thinking_level: high`, `aspect_ratio: 4:3`
(results 2400×1792), with `assets/img/apertura-eas-documentos-paraguay-1920.webp`
uploaded as an `image_references` style reference (media `de9eefc4-3a92-448a-aef0-c6306a008b89`)
so the set matches the existing editorial illustrations. Converted with webimg 0.2
(`--widths 640,1280,1920 --og`), all files inside the default budgets.
`templates/guide.php` now renders the set as `<picture>` (AVIF/WebP srcset, real
width/height, `fetchpriority="high"`) and uses `<slug>-og.jpg` as the page's og:image.

Style tail (appended to every prompt): flat editorial vector illustration, soft paper
grain, thin gold and slate line loops, cream `#F7F1E8`, navy `#1F2A44`, slate
`#5B6B8C`, mustard `#E3A62F`, ochre `#C8873E`, terracotta `#B5603A`, sage, lapacho
pink `#E58BA6` accents; Paraguayan touches (lapacho, chipa, tereré, ñandutí, red tile
roofs); no text, letters, numbers, logos or signage with words; no deformed hands or faces.

| Page | File (`assets/img/`) | Alt (es-PY) | Job ID |
|---|---|---|---|
| /guias/salario-minimo-paraguay/ | `salario-minimo-trabajadora-paraguay` | Trabajadora con su sobre de sueldo sube una escalera de monedas hacia una puerta iluminada, junto a un lapacho en flor. | `041ec3db-fa55-4888-b57d-0778400b7e22` |
| /guias/ver-aportes-ips/ | `aportes-ips-celular-familia-paraguay` | Hombre bajo un lapacho mira su celular, del que surge un paraguas de meses dorados que protege a su familia. | `53b65526-f9a8-4192-b13a-a660dbeccb0d` |
| /guias/preaviso-paraguay/ | `preaviso-laboral-reloj-arena-paraguay` | Trabajador y empleador se dan la mano frente a un reloj de arena del que sale un camino de calendarios. | `7448f726-a288-4187-836b-bec094bbc65e` |
| /guias/suace/ | `suace-apertura-empresa-online-paraguay` | Dos emprendedores encajan piezas de rompecabezas que salen de una tableta para armar el frente de su nueva empresa. | `8963c69d-67cf-4e12-aeee-d0db4a082e74` |
| /guias/kude/ | `kude-factura-electronica-mercado-paraguay` | Cliente escanea con el celular el código QR del comprobante que le entrega un vendedor de chipa en el mercado. | `a2cdf7f2-b414-4332-8c20-85b857e03543` |
| /guias/nota-de-credito/ | `nota-de-credito-devolucion-comercio` | Cliente devuelve una caja en el mostrador de un comercio mientras las monedas vuelven de la caja, bajo una balanza. | `f86f188a-e0df-40bc-88e2-c31b4db099c3` |
| /guias/factura-legal-paraguay/ | `factura-legal-almacen-paraguay` | Dueño de un almacén de barrio entrega una factura a una clienta, bajo un sello dorado de ñandutí. | `12687d6f-dc7b-41ef-b1d2-658994c63d2a` |
| /guias/libro-diario-y-libro-mayor/ | `libro-diario-libro-mayor-contabilidad` | Una fila de personas lleva una cinta de asientos desde el libro diario hasta un libro mayor lleno de cajones ordenados. | `5a1b84d4-c116-4787-bf8f-655fbff58062` |
| /guias/conciliacion-bancaria/ | `conciliacion-bancaria-banco-libros` | Contadora con una lupa coloca la moneda que faltaba para unir los movimientos del banco con los del libro contable. | `2d9eed62-ed12-41f4-9dec-da79e17e51c8` |
| /guias/registro-mipymes/ | `mipymes-comercios-barrio-paraguay` | Calle de barrio con panadería de chipa, sastrería, taller de motos y carpintería cada vez más altos, bajo una insignia dorada. | `932f4af1-bd27-465c-92e1-cae8c6228fb2` |

Credits: balance 4,418.75 before; preflight 2 per image (2k) × 10 = 20. Ledger
2026-10-18: 11 × −2 = 22. The extra charge is one regeneration: the first factura-legal
image (`dbffdc1e-4a76-4eed-b51c-749bb2045ee4`) showed the readable word "INVOICE" and was
rejected. Two first submissions hit a 429 rate limit and created no job (no charge).
Not illustrated: `/srl/` and `/herramientas/calculadora-ips/`, because the service and
tool templates have no image slot (same as every other service and tool page).
