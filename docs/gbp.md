# Google Business Profile (B4, plan §6.4.6)

Off-site half of local visibility per the `gbp-optimizer` skill: the site
converts the click, the GBP listing wins it. This document is the setup
checklist and copy drafts; it does not create or edit the live profile
(no API access from this session) — Anton or whoever holds the GBP account
applies it.

## NAP consistency

**Not actionable yet.** `content/site.php` — the single source every NAP
field on the site is drawn from (footer, `/contacto/`, the `LocalBusiness`
JSON-LD) — still has `phone`, `whatsapp`, `email`, `street` and `hours` all
`null` (plan §7, unchanged since A1). Once those are filled in:

- [ ] Copy the exact phone, address and hours into the GBP listing —
      character-for-character, including how the street address is
      abbreviated/punctuated. A formatting mismatch (e.g. "Av." vs "Avda.")
      counts as an inconsistency for local-pack ranking.
- [ ] `content/site.php`'s `country` is currently the word "Paraguay" in the
      JSON-LD (`addressCountry`) — A2's `KNOWN-ISSUES.md` flagged this should
      become the ISO code `PY` when the address is confirmed anyway; do that
      in the same edit.
- [ ] Set the GBP website URL to `https://contador.com.py` (launch checklist
      §9) once DNS cutover is done.
- [ ] Add `?utm_source=google&utm_medium=organic&utm_campaign=gbp` to the
      website link in the GBP listing itself, so GBP-sourced traffic is
      visible in GA4 once `GA4_ID` is configured.

## Categories

- **Primary:** Contador (the DNIT/IPS-facing compliance work — Marangatu,
  IVA, IRE, nómina — is the core of every service page) — Google's English
  system category is **"Accountant"**.
- **Secondary:** Asesor fiscal (**"Tax consultant"**); consider **"Bookkeeping
  service"** given `/contabilidad/` is now a first-class page.
- Do **not** add "Auditor" as a category unless the firm's real registration
  covers statutory audit sign-off — `/auditoria/`'s three children
  (impositiva, interna, forense) are consulting-style engagements per the
  page copy, not a distinct regulated audit practice; adding the category
  without that credential risks a suspension review (skill §7, anti-fabrication).

## Services section

Mirror the six homepage service cards (`content/ui.php` → `home.cards`), one
GBP service entry each, description = the card's own `text` (already written,
already fact-checked, no new copy needed):

| GBP service | Source |
|---|---|
| Contabilidad mensual | `content/services.php['contabilidad']` |
| Impuestos: IVA e IRE | `content/services.php['iva']` |
| Nómina | `content/services.php['ips']` |
| Apertura de empresas y RUC | `content/services.php['eas']` |
| Facturación electrónica | `content/services.php['ekuatia']` |
| Auditoría | `content/services.php['auditoria']` |

## Description draft (750-character limit)

First sentence leads with service + city + the one concretely verifiable
claim the site itself makes (the range of compliance the firm covers) — no
superlative without a source, per the skill's anti-fabrication rule and this
project's own plan §1.4.

> Estudio contable en Asunción para pymes y empresas: contabilidad mensual,
> liquidación de IVA e IRE ante la DNIT, nómina e IPS, apertura de empresas
> (EAS, RUC) y facturación electrónica en SIFEN. Trabajamos con fechas
> acordadas y un informe mensual en lenguaje claro, no solo planillas.
> Contadores públicos matriculados. Escríbanos por WhatsApp o complete el
> formulario del sitio para una cotización sin costo.

(318 characters — well under the 750 limit, deliberately not padded with
unverifiable claims. Extend it once `foundedYear`/`teamSize`/real stats are
confirmed — plan §7 — with a second sentence naming years of practice or
client count, the same way the homepage's "N años" badge is designed to
switch on with no code change.)

## Three post drafts

Each ≤ 1500 characters, one photo/graphic + a CTA button, per the skill's
monthly-activity cadence (§4). None invent a promotion, price or statistic
not already on the site — every fact below traces to a real page.

**1. Compliance-deadline reminder (ties to `/herramientas/vencimientos/`)**

> ¿Sabe cuándo vence su IVA este mes según su RUC? La DNIT asigna la fecha
> según la terminación de su RUC, y el calendario cambia de contribuyente a
> contribuyente. Calcule su fecha en segundos con nuestra calculadora de
> vencimientos — sin costo, sin registrarse.
> **CTA: Más información → /herramientas/vencimientos/**

**2. Aguinaldo season (ties to the aguinaldo article + calculator, seasonal — post in November/December)**

> El aguinaldo se calcula sobre todo lo percibido en el año, no solo el
> sueldo de diciembre — y si trabajó solo parte del año, le corresponde el
> proporcional. Publicamos una guía completa con ejemplos y una calculadora
> gratuita para que sepa exactamente cuánto le corresponde cobrar.
> **CTA: Más información → /herramientas/calculadora-aguinaldo/**

**3. New-page announcement (contabilidad mensual, or swap for whichever page is newest when posted)**

> Ahora puede ver en un vistazo qué incluye nuestro servicio de contabilidad
> mensual: libros al día, conciliaciones bancarias, balance general y estado
> de resultados cada mes, con el cierre entregado antes del día 5.
> **CTA: Reservar → /contabilidad/**

## Reviews and photos

Both need real inputs this session cannot supply (skill §3, §4 — no fabricated
reviews, no stock/AI photos on the GBP profile itself, distinct from the
site's own illustrative imagery in `docs/imagery-manifest.md` which is
labelled and used only on the website, never posted to GBP as if it were a
real photo of the firm). Once the firm has real clients to ask:

- [ ] Get the GBP review link (`search.google.com/local/writereview?placeid=...`)
      from the verified listing and add it to the post-engagement WhatsApp
      message template
- [ ] Seed the Q&A section with the 3–5 questions this site's own FAQs
      already answer most often (e.g. "¿Cómo sé si tengo multas de la DNIT?"
      from `/marangatu/`, "¿Se descuenta el 9 % del IPS del finiquito?" from
      `/herramientas/liquidacion-de-salario/`) — same answers, GBP surface
- [ ] 2–4 real photos/month once available: office, team, real (not
      AI-generated) — the skill is explicit that GBP photos must be real,
      unlike the website's own illustrative Higgsfield imagery
