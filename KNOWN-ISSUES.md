# Known issues

Minor, non-blocking findings. Phases append here rather than stopping (plan §4.3).

## A1 — Foundation (2026-09-03)

- **No WhatsApp number, phone, email or address yet** (plan §7). The header pill,
  the floating button and every service CTA keep their shape and colour but point
  at `/contacto/` and read "Contactar" instead of opening `wa.me`; the footer NAP
  and the contact page's address block render nothing. Filling `whatsapp` in
  `content/site.php` switches all of it on at once, with no code change. This is
  the single highest-value input still outstanding — the whole conversion path in
  plan §1.6 is WhatsApp-first.

- **`--amber-text` (#B4831B) is 3.39:1 on white**, below the 4.5:1 WCAG AA
  threshold for normal text. It is used for the `.eyebrow` label (13px/600), which
  is too small to qualify as large text. The value is locked by the 1B style guide
  (plan §1.1), so A1 kept it rather than inventing a colour. `#996F17` is the same
  hue at 4.53:1 if B4's accessibility pass (plan §6.4.2, target 100 a11y) decides
  to move it. Amber on ink blue is 9.47:1 and fine.

- **Fonts are the variable versions of Bricolage Grotesque and Onest**, not
  static per-weight files. Google Fonts serves one variable woff2 per subset for
  both families, which covers every weight the design uses (Bricolage 600/800,
  Onest 400/500/600) in four files instead of ten — 170 KB total, latin and
  latin-ext. `@font-face` declares the weight ranges. Worth revisiting in B4 only
  if subsetting to the characters actually used saves something meaningful.

- **`docs/screenshots/a1/contacto-1440.png` has a faint ghost line under the
  header.** Headless Chromium occasionally paints bottom-of-page content into the
  top of a page-length capture. `tests/screenshots.mjs` scrolls the page before
  capturing, which removes it almost everywhere; one page still shows a trace. The
  live page is unaffected — verified against a normal viewport. Cosmetic, affects
  committed preview images only.

- **The A1 homepage is not the 1B homepage.** It has the hero band, the six
  service cards and the CTA band so the design system and the shared partials are
  exercised end to end, but the status panel, credibilidad, proceso and casos
  sections are A2's work (plan §5.2). A2 replaces the page wholesale.

- **`/nosotros/`, `/precios/`, `/herramientas/`, `/blog/`, `/privacidad/` and
  `/terminos/` are placeholders.** They respond 200 with their real H1 and lead,
  say plainly that the page is being prepared, and offer the conversion path. They
  are `noindex` and excluded from `sitemap.xml` until the phase that owns each one
  sets `'stub' => false` in `content/pages.php`.

## A2 — Homepage, shared partials, Servicios hub (2026-09-03)

- **The WhatsApp button's white-on-green is 3.24:1**, below the 4.5:1 WCAG AA
  threshold. `#25A35A` is WhatsApp's own brand green and is locked by the 1B
  style guide (plan §1.1), so A2 kept it rather than inventing a shade.
  `#1E7A45` — already a token, `--ok-text` — is 5.3:1 against white and would
  fix it without leaving the palette, if B4's accessibility pass (plan §6.4.2,
  target 100 a11y) decides to move it. This and the `--amber-text` eyebrow
  above are the only two contrast failures Lighthouse reports on `/`; together
  they are the whole gap between 96 and 100 on accessibility.

- **The two "Quiénes somos" photo slots are empty.** B4 supplies the imagery
  (plan §6.4.1). Until then they render as a neutral diagonal texture rather
  than a broken image or a captioned identity claim, and on screens ≤ 768px
  they are hidden entirely (`.figures--empty`) so a phone does not get a
  screenful of placeholder. Setting `site('photos')['portrait'|'team']` to
  `['src' => ..., 'alt' => ...]` swaps in real `<img>`s with no code change.

- **The amber badge carries a line of text instead of a number.** 1B's
  "14 años · de ejercicio profesional" needs `foundedYear`, which is still
  pending (plan §7), so the badge shows the neutral "Contadores públicos
  matriculados" at display weight. Filling `foundedYear` restores the figure
  and the badge computes the years itself.

- **The Auditoría cluster on `/servicios/` lists its own sub-hub alongside its
  three children**, so `/auditoria/` appears as a peer of the pages it
  contains. All four are real, indexed URLs and the hub has to link every one
  of the 14 services, so A2 left the grid flat rather than inventing a nesting
  treatment. B1 owns `/auditoria/` (plan §6.1.4) and is better placed to decide
  whether the children should be visually subordinate there.

- **`addressCountry` in the JSON-LD is the word "Paraguay", not the ISO code
  `PY`.** Both are valid schema.org and the block passes, but Google's
  structured-data guidance prefers the two-letter code. One-word change in
  `content/site.php` whenever the address is confirmed anyway.

## B1 — Service pages (2026-09-03)

- **Marangatu's Guía rápida links to the DNIT institutional page, not a raw
  login URL.** This session's network egress is blocked for both `dnit.gov.py`
  and `marangatu.set.gov.py`, so the login endpoint found via search
  (`marangatu.set.gov.py/eset/login`) could not be fetched to confirm it
  still resolves. See `docs/facts-to-verify.md` — a human check before launch
  should either confirm that URL or swap in whatever DNIT currently links
  from its own Sistema Marangatu page.

- **IRP tax brackets, rates and deduction limits are not stated on `/irp/`.**
  This phase could not find a confidently current primary source for them
  within the session, so the page says "consulte el monto vigente" instead
  of a number, per the copy brief's fact-discipline rule (never state a
  figure that isn't verified). Logged in `docs/facts-to-verify.md` as an
  open input for Anton or a later phase.

- **`/auditoria/` and `/auditoria-auditoria-impositiva/` no longer quote the
  legacy site's "4 a 8 semanas" audit duration.** That figure wasn't on the
  copy brief's whitelist of reusable scan figures, so both pages now say the
  duration depends on the engagement and is confirmed in the initial
  diagnosis. If the firm has a real typical range, it's a one-line addition.

- **The `/servicios/` hub still lists `/auditoria/` as a peer of its three
  children** (flagged by A2, plan §6.1.4 handed the decision to B1). B1 left
  it as is: `service-card-grid.php` is a locked partial (plan §4.7) and the
  flat grid is still accurate information architecture — all four are real,
  indexed pages. A nested treatment there would need a partial change, which
  is out of scope for a Model-B phase; noted here as a backlog item instead.

- **`templates/service.php` gained one new section** (the "Qué incluye / Qué
  no incluye / Qué necesitamos de usted" checklist grid, `content/services.php`
  keys `excludes` and `weNeed`) and **`assets/css/site.css` gained a "b1
  service pages" block below the tokens** (`.checklist-grid`, `.checklist--no`,
  `.checklist--need`). Both are additive per plan §4.7 (new content keys, new
  CSS below the tokens are allowed) — no existing section, partial, or token
  was changed.

## B2 — Secondary pages and blog (2026-09-04)

- **The six blog articles link to their related service page, not a calculator.**
  Plan §6.2.6 says "each article links to its calculator/service", written with
  the assumption B3's tools would exist by then. They don't yet — B2 runs before
  B3 in phase order — so every article links to the closest service page
  instead (e.g. the aguinaldo article links to `/ips/`). Logged as a follow-up
  in plan §10 for once B3 ships.

- **`/nosotros/`'s "Equipo" section is hidden.** `content/site.php`'s `team[]`
  is still empty (plan §7), so the section that would list team members simply
  doesn't render — same degrade-gracefully pattern as every other empty
  collection on the site. Filling `site('team')` switches it on with no code
  change.

- **`/precios/` shows "Cotización en 48 h" on all three plans.** None of
  `content/precios.php`'s `priceGs` values are set (plan §7 still lists this as
  pending). The scope lines (`includes[]`) are real; only the guaraní figures
  are missing.

- **The aguinaldo article's IPS-exemption claim is not independently
  re-verified against a primary source this phase.** "El aguinaldo está
  exceptuado del aporte obrero del 9 % al IPS" is well-established practice
  among Paraguayan payroll professionals, phrased with a hedge ("en general")
  consistent with the rest of the site, but logged in
  `docs/facts-to-verify.md` alongside the B1 items for a primary-source check
  before B4's launch pass.

## B3 — Tools (2026-09-04)

- **`assets/js/py.js`'s `fmtGs()` no longer uses `Intl.NumberFormat`'s
  `style: "currency"` mode.** Building the first calculator that displays a
  computed amount (`calculadora-aguinaldo`) surfaced that Node's — and
  potentially some browsers' — bundled ICU data renders the PYG currency
  symbol as `"Gs."` instead of `"₲"`, which would have disagreed with every
  server-rendered price on the site (`lib/helpers.php`'s `fmt_gs()` always
  emits the literal `"₲ "` prefix). The fix formats only the number grouping
  through `Intl.NumberFormat` and prepends `"₲ "` itself, making the two
  helpers byte-for-byte identical regardless of a browser's ICU
  completeness. `assets/js/py.js` predates B3 (A1) but had never rendered a
  currency value in the UI before this phase.

- **The liquidación de salario calculator treats every month as 30 days**,
  the conventional basis Paraguayan payroll practice uses, rather than each
  month's real length. The page states this next to the result. A finiquito
  computed on real calendar days would differ by at most a day or two per
  proportional line — immaterial next to the "valores orientativos"
  disclaimer the plan requires (plan §6.3.1c).

- **The IPS 9 % deduction line on the finiquito calculator applies only to
  the salario and vacaciones proporcionales**, not to the aguinaldo
  proporcional, the preaviso or the indemnización. This split is not
  independently verified against a primary IPS source this phase — see
  `docs/facts-to-verify.md` B3 section — and is the same category of hedge
  B1 and B2 already carry for the aguinaldo/IPS relationship.

- **The vencimientos calculator does not check a holiday calendar.** When a
  computed date falls on a weekend or a Paraguayan public holiday, the DNIT
  moves it to the next business day; the page states this in its copy and
  FAQ but does not compute the adjusted date, since that would require a
  maintained holiday list (plan §6.3.2 explicitly rules out scraping a live
  feed). The Calendario Perpetuo digit-to-day table itself
  (`content/vencimientos.php`) is the stable part and is unaffected.

- **The IRE anual vencimiento shown is a month range with a note, not a
  single date** — the exact month is DNIT's own annual administrative
  decision (typically March for IRE Simple/IRP, April for IRE General), so
  the calculator only computes the day-of-month from the RUC digit and asks
  the visitor to confirm the month, consistent with how B1's `/ire-simple/`
  and `/iva/` already hedge this same fact.

## B4 — Imagery, polish, launch (2026-09-04)

- **The 9 Higgsfield-generated images are not yet in the repo.** This
  session's network egress allows the Higgsfield MCP generation calls but
  denies the CloudFront CDN the result images are served from
  (`d8j0ntlcm91z4.cloudfront.net` — 403, "organization policy"), and no human
  was present in this run to do the one-step manual bridge (download →
  upload back) the `higgsfield-web-imagery` skill's sandbox path calls for.
  All 9 generations completed successfully, cost preflighted (≤ 12 cap, ~9–14
  credits actually spent), two style Elements registered for consistency.
  Every job ID, prompt, target filename and destination is in
  `docs/imagery-manifest.md`, along with the one-time manual step and the
  `deploy/optimize-images.mjs` / `deploy/subset-fonts.sh`-style conversion
  script that finishes the job once the PNGs are downloaded. Until then the
  homepage photo slots keep A2's neutral decorative texture (never a broken
  image), the six service cards have no icon, and `assets/img/og-default.png`
  stays A1's placeholder — nothing is broken, the polish is incomplete.

- **`--amber-text` moved again, past what plan §6.4.2 suggested.** The plan
  named `#996F17` (4.53:1 on white) as the fix for A1's `#B4831B` (3.39:1).
  Measuring it against `--surface` (`#F4F6FA`) — the darker of the two
  alternating light section bands most eyebrows actually sit on, not just
  white — gave only 4.18:1, still short of AA. `#8F6A17` (4.95:1 on white,
  4.58:1 on `--surface`) is what's shipped; see the token's own comment in
  `assets/css/site.css`. Still the one sanctioned token *value* change per
  plan §6.4.2 — same token, a different final hex than the plan's draft
  suggestion because the plan's number wasn't checked against both bands.

- **WhatsApp buttons and the floating action button both moved to
  `--ok-text`, not just the buttons.** The B4 prompt's review-decision 1 says
  "`#25A35A` stays for the icon/FAB accent only," which reads two ways: the
  fab's *background* stays green, or only its *icon glyph* does. Keeping the
  fab's background green would leave Lighthouse's colour-contrast audit
  failing on every page (the fab renders on all of them, and 3.24:1 white-on-
  `#25A35A` fails AA at its 14–16px label size) — directly against this same
  phase's 100 a11y target. Both `.btn--whatsapp` and `.wa-fab` now use
  `--ok-text` for the background; `--whatsapp` (`#25A35A`) is kept as the
  fab's SVG icon fill (`fill: var(--whatsapp)` instead of `currentColor`), so
  the brand green still appears as the icon's own accent, per the more
  literal reading of "icon ... accent."

- **Google Ads conversion actions are not individually wired.** `gtag('config',
  ADS_ID)` loads and fires once `config.php` sets `ADS_ID` (plan §6.4.3), which
  is enough for the base Ads tag and remarketing audiences, but a specific
  conversion action (its own label per goal — WhatsApp click, lead submit)
  needs a decision only whoever owns the Ads account can make, then a
  one-line addition next to the matching `track()` call. Logged in
  `docs/launch-checklist.md` §4.

- **`content/services.php` gained an optional `toolLinks` key and
  `templates/service.php` gained one new additive section** (a calculator
  callout, same `card card--link` pattern B3's `templates/article.php`
  `$toolLink` slot already used) — the B4 review decision 3 wiring (aguinaldo
  article + `/ips/` → both salary calculators; `/iva/` → the IVA calculator
  and vencimientos; `/marangatu/`, `/ire-simple/` → vencimientos; EAS article
  + `/eas/` → the comparador). `templates/article.php`'s `$toolLink` now also
  accepts a list of link arrays (previously exactly one), used by the
  aguinaldo article's two links. Both are additive per plan §4.7's precedent
  (B1's checklist-grid section) — no locked file's existing structure changed.

- **`/servicios/` gained an "¿No sabe qué necesita?" strip it didn't have
  before**, reusing the homepage's `.unsure` component but pointing its CTA
  at `/herramientas/que-necesita/` (the quiz) instead of WhatsApp — the
  review decision names `/servicios/` specifically, and the hub is where a
  visitor comparing all 14 services is most likely to want the self-service
  triage. The homepage's own strip is untouched and still opens WhatsApp/
  contact, which is the right default for that page. New `services_hub.unsure_*`
  strings in `content/ui.php`; no partial touched.

- **Lighthouse was measured against the deploy zip, not the raw repository.**
  `deploy/make-zip.sh` now ships `assets/css/site.css` minified (35–36%
  smaller); the working tree keeps the readable source, which real browsers
  never see in production. Measuring the raw repo would report a lower,
  less representative number, so `/`, `/marangatu/` and the aguinaldo article
  were all measured against an unzipped `dist/` build:
  **95 / 100 / 100** (perf/a11y/SEO) on `/`, **98 / 100 / 100** on
  `/marangatu/`, **98 / 100 / 100** on the article — all against
  `php -S`, mobile throttling, matching A2's own measurement methodology.

- **Fonts were subset to the characters this site actually renders**
  (`deploy/subset-fonts.sh`, `pyftsubset`): ASCII + the Latin-1 letters and
  typographic marks Spanish copy uses, plus the guaraní sign (₲, U+20B2) and
  the right-arrow (→, U+2192) found in real page output. The four webfont
  files went from ~166 KB combined to ~90 KB (the two "latin" files ~20%
  smaller; the two "latin-ext" files, which exist almost solely to carry ₲
  and →, ~93% smaller — most of Google's original "latin-ext" subset is
  Vietnamese/IPA/historic-Latin glyphs this site never uses). The `→`
  character was not in either face's original `unicode-range` at all (a gap
  in Google's own subset, unrelated to this session) — added to the
  latin-ext `@font-face` blocks so it now renders in the brand typeface
  instead of silently falling back to the system font.

- **VenderCRM, Hostinger and analytics credentials are all still pending**
  (plan §7, unchanged): the lead form still runs in degraded mode
  (`logs/leads.log`), there is no staging subdomain to run
  `deploy/verify-live.sh` against yet, and `GA4_ID`/`ADS_ID` are unset so the
  new gtag.js snippet in `partials/head.php` never loads. All three are
  numbered, actionable steps in `docs/launch-checklist.md` rather than a
  blocker — consistent with every prior phase's handling of missing §7 inputs.
  This is also why `docs/launch-checklist.md`'s own exit step
  (`deploy/verify-live.sh` against a real URL) could only be exercised
  against `php -S` in this session, not a real Hostinger deployment.
