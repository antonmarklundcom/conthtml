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
