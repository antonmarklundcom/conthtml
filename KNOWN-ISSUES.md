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
