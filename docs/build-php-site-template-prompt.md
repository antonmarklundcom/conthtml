# Build antonmarklundcom/php-site-template — paste into a fresh OPUS window on that (empty) repo, permission mode auto-accept

You are building a reusable GitHub template repository for local-business brochure / tools / blog
sites in static HTML + PHP on shared hosting (Hostinger). It is extracted from the finished site
`antonmarklundcom/conthtml` (contador.com.py). Attach or clone that repo read-only and copy its
foundation; do NOT copy its client content. One session, one PR to `main`, then STOP.

Load skills: `phased-autonomous-build` (§Template profile — this repo is what it describes),
`vendercrm-lead-capture`, `fable-cost-guardrail`. Never spawn any session on Fable.

## Copy from conthtml (generic foundation, keep working as-is unless a step below says otherwise)
- `lib/` (bootstrap, helpers, seo), all `partials/`, all `templates/` (service, article, tool, page-stub,
  guide, segment), `router.php`, `.htaccess`, `sitemap.php`, `404.php`, `enviar.php`, `config.example.php`,
  `verify.sh`, `deploy/` (make-zip, minify-css, subset-fonts, optimize-images, verify-live, leads-to-csv,
  routes), `tests/screenshots.mjs` + its package files, `.github/workflows/verify.yml`,
  `prompts/_handoff.md`, `assets/css/site.css`, `assets/fonts/`, `assets/js/` (see market modules).
- Every `content/*.php` file: keep the file, the header comment documenting the key shape, and the
  array structure; EMPTY the values. The shapes are the contract every site builds against.

## Do NOT copy
- Route directories of contador (service dirs, `blog/*`, `herramientas/*`, `guias/*`, `contador-para/*`,
  `nosotros/`, `precios/`, `privacidad/`, `terminos/`, `servicios/`), `docs/reference`, `docs/keyword-research.md`,
  `docs/facts-to-verify.md`, `docs/imagery-manifest.md`, `docs/gbp.md`, `docs/launch-checklist.md`,
  `docs/analytics-setup.md`, `docs/lead-value.md`, `docs/ads-campaigns.md`, `docs/screenshots`,
  `KNOWN-ISSUES.md`, `plan.md`, `prompts/opus-*`, `prompts/sonnet-*`, `assets/img/*` (make a neutral
  `og-default.png` placeholder), `content/laboral.php`, `content/vencimientos.php` (they move into the PY market module).

## Generalise (this is the real work)
1. **No brand anywhere.** Title suffix, JSON-LD organisation fallbacks, zip name, CI zip glob, README —
   all read from `content/site.php` (`name`, `domain`, `slug`). `grep -rni "contador"` over the repo must
   return nothing except CHANGELOG/attribution lines you choose to keep in README.
2. **Market modules.** `lib/market/py.php` + `assets/js/market/py.js` (RUC validation, guaraní formatting,
   the labour-law and DNIT tables from conthtml's `content/laboral.php` / `content/vencimientos.php`) and
   `lib/market/se.php` + `assets/js/market/se.js` (org.nr/personnummer validation, SEK formatting, moms
   25/12/6, empty tables to fill later). `content/site.php` has `'market' => 'py'|'se'`; bootstrap loads the
   matching module and exposes the same function names (`fmt_money`, `validate_tax_id`, …) so templates never
   change per market. Keep conthtml's exact PY formulas; they were verified.
3. **Design tokens.** Keep conthtml's tokens block as the default theme but neutral (ink/accent named by role,
   not by client); document in README exactly which block a new site replaces from its design canvas.
4. **Example content.** `content/site.php` filled with an obvious fake business ("Ejemplo S.A." / "Exempel AB"),
   `content/pages.php` with `/`, `/contacto/`, `/privacidad/`, `/terminos/`, `/404` as real pages; ONE example
   entry in each of `services.php`, `blog.php`, `tools.php`, `guias.php`, `segmentos.php`, `lead-values.php`
   so every template renders and `verify.sh` has routes to check. Mark them `'example' => true` so a new site's
   T0 step deletes them with one grep.
5. **`prompts/_watcher.md`** (new): the hourly Sonnet watcher prompt exactly as `phased-autonomous-build`
   §Supervision describes it (read phase table + git/PR state, restart stalled phases, spawn the link pass,
   notify Anton, never edit code, self-disable after 10 firings).
6. **`prompts/_lane2-phase.template.md`**: the phase-prompt skeleton from the skill's Stage 3, with
   `Owns`, `Depends on`, the read-ONLY line, the budget line and the polish cap already filled in.
7. **README.md** with a "Start a new site (T0)" section: numbered, ≤ 20 steps, every step a command or a
   file edit, ending in `./verify.sh` green and the first PR. Also the content-model reference (key shapes)
   and the market-module contract.
8. **CI**: conthtml's `verify.yml` as-is (verify + deploy-zip check + screenshots of changed pages as an artifact).
9. `.gitignore` from conthtml plus `docs/screenshots/*`. Mark the repo as a GitHub template
   (Settings → Template repository) — if you cannot, say so in the closing report.

## Exit (all must hold before the PR opens; open it that same turn — no polish rounds)
- `./verify.sh` green on the repo and on the unzipped `deploy/make-zip.sh` output; `php -S` renders `/`
  and one page of every template type with no PHP notices.
- `grep -rni contador` clean (except README attribution); `grep -rn "example' => true"` lists every example entry.
- Switching `'market'` between `py` and `se` in `content/site.php` renders the site with no errors.
- README T0 section tested by following it once yourself into a temp dir.
- One PR, merged green. Closing report: repo URL, file tree, what a new site edits, anything you could not do.
