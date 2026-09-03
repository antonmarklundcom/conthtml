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
