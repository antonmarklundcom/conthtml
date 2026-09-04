# Template reuse — starting the next HTML+PHP site from this repo

This repo is the template profile named in the `phased-autonomous-build` skill. The next
local-business brochure / tools / blog site on shared PHP hosting starts here and skips
phases A1 and A2 entirely. This file is the executable checklist for phase **T0 Adopt**
(one Sonnet session, ≤ 1 h, one PR). Do it in this order; verify must be green at the end.

## 1. Fork

- New repo from the latest `main` of `antonmarklundcom/conthtml` (fresh history is fine:
  `git init` on a copy — the old build log is not this site's memory).
- Keep: `lib/`, `partials/`, `templates/`, `assets/css/site.css`, `assets/js/` (see §3 for
  the market module), `assets/fonts/` (until the new design picks fonts), `enviar.php`,
  `config.example.php`, `router.php`, `.htaccess`, `sitemap.php`, `404.php`, `verify.sh`,
  `deploy/`, `tests/`, `.github/workflows/verify.yml`, `prompts/_handoff.md`,
  `docs/template-reuse.md`, `docs/skills/`, `README.md` (rewrite §Content model later).

## 2. Delete (content and history of the old site)

- Route directories of the old site: every service dir (`asesoria/`, `auditoria*/`, `eas/`,
  `ekuatia/`, `ips/`, `ire-simple/`, `irp/`, `iva/`, `marangatu/`, `ruc/`, `contabilidad/`),
  `blog/*/` articles, `herramientas/*/` tools, `nosotros/`, `precios/`, `privacidad/`,
  `terminos/`, `servicios/`, `contacto/` (keep `contacto/` only if the new site's contact page
  is the same shape — it usually is; then just retext it).
- `content/services.php`, `blog.php`, `tools.php`, `precios.php`, `lead-values.php`:
  **empty the values, keep the file, the header comment and the key shape.** The shape is
  the contract lane 2 builds against.
- `content/laboral.php`, `content/vencimientos.php`: Paraguay-only tables — delete for a
  non-PY site, keep and re-source for a PY site.
- `docs/reference/`, `docs/keyword-research.md`, `docs/facts-to-verify.md`,
  `docs/imagery-manifest.md`, `docs/gbp.md`, `docs/launch-checklist.md`,
  `docs/analytics-setup.md`, `docs/lead-value.md`, `docs/log/` (if present),
  `KNOWN-ISSUES.md`, `plan.md`, `prompts/*` except `_handoff.md` and `_watcher.md`.
- `assets/img/*` except a new `og-default.png` placeholder; `deploy/imagery-src/*`.

## 3. Rename / retoken (every hardcoded brand reference, all in named places)

| What | Where |
|---|---|
| Site facts: name, legalName, phone, WhatsApp, email, address, hours, socials | `content/site.php` |
| `<title>` suffix and JSON-LD organisation fallbacks | `lib/seo.php` (`SEO_TITLE_SUFFIX`, two `?? 'Contador.com.py'` fallbacks) |
| Deploy zip name | `deploy/make-zip.sh` (`NAME="contador-..."`) and `.github/workflows/verify.yml` (`-name 'contador-*'`) |
| Design tokens (colours, type scale, radii) | the `/* == tokens == */` block at the top of `assets/css/site.css` — replace from the new design canvas' style guide; nothing below the block changes in T0 |
| Fonts | `assets/fonts/` + the `@font-face` block; re-run `deploy/subset-fonts.sh` |
| UI strings, cluster names, nav labels | `content/ui.php`, `content/nav.php` (`nav.primary`, clusters) |
| Static pages list (stubs) | `content/pages.php` — every page starts `'stub' => true`, noindex, out of the sitemap |
| Market module: number/currency formatting and tax-id validation | `assets/js/py.js` + `lib/helpers.php` (`fmt_gs`, RUC) → for Sweden: SEK/org.nr equivalents; keep the function names so templates do not change |
| Lead handler destination | `config.example.php` (VenderCRM site key, Resend) — unchanged code, new keys |
| CI / README title lines | `README.md`, workflow name if you care |

Then: `grep -rn "contador" --include=*.php --include=*.sh --include=*.yml --include=*.md .`
must return only this file and `docs/skills/`.

## 4. Verify and hand off

- `./verify.sh` green with only `/` and the stub pages (the route list comes from
  `content/pages.php` + the empty content arrays, so it shrinks by itself).
- `./deploy/make-zip.sh` builds; `./verify.sh --root <stage>` green.
- Open the T0 PR, merge. Write `docs/log/t0.md` (≤ 12 lines). Hand off to T1 Home per
  `prompts/_handoff.md`. T1 is the last lane-1 phase: it creates the watcher Routine and
  spawns every lane-2 phase at once.

## 5. What the new plan.md must still say

The template removes A1/A2 from the plan, not the plan itself. Stage 2 of the skill still
produces `plan.md` with: the locked decisions, the content model (point at the kept key
shapes), lane-2 phases each with an `Owns` list, the link pass, the human inputs, and the
§9 index. Phase prompts follow the skill's skeleton — including the "read ONLY" line and the
polish cap. Copy briefs from this repo's `prompts/sonnet-1-services.md` (fear → mechanism →
service, proof by specificity, fact discipline) transfer almost verbatim to any local
accounting/legal/trades site; read it once when writing the new briefs.
