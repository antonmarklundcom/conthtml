# Google Ads campaign structure — runbook

Written for phase C3 (plan §6.6.2). This document creates nothing in Google
Ads — it is the exact structure Anton builds by hand in the Ads UI once the
account has a payment method and `docs/analytics-setup.md`'s conversion
import is live. Do the analytics setup first: bidding on value needs
`lead_submit` importing with a real `value` before a campaign spends a
guaraní, or Ads optimises toward nothing.

Values, keywords and competition figures are from `docs/keyword-research.md`
(2026-09, KWP export) and the tier model in `docs/lead-value.md`. Landing
pages are what exists on the site today — B1's 14 service pages, C2's guides
(when merged) and C3's nine segment pages.

## 0. Conversion actions (set up once, before any campaign)

Both are already wired site-wide (`assets/js/analytics.js`, `enviar.php`,
`docs/analytics-setup.md`) — this section only says what to import.

| Conversion action | Fires on | Value | Count |
|---|---|---|---|
| `lead_submit` | The lead form (any page) or a tool's reminder capture is accepted by `enviar.php` | Dynamic — `value` in the event, ₲1 000 000 / 400 000 / 100 000 per tier (`content/lead-values.php`'s `tierValues`) | One |
| `whatsapp_click` | Any `wa.me` link is clicked | Fixed proxy ₲50 000 (a WhatsApp click is real intent but weaker signal than a completed form — set this once in Ads, not per campaign) | One |

Import both from **Tools → Data manager → Google Analytics 4** once each has
at least one real event in GA4 (`docs/analytics-setup.md` §2.2–2.3). Mark
`lead_submit` primary; keep `whatsapp_click` primary too while WhatsApp stays
the site's main conversion path (plan §1.6). Bid on **Maximise conversion
value** only once ~30 conversions have landed — start on **Maximise
conversions** or manual CPC.

## 1. Budget split by tier

The 10:1 value ratio between tier A and tier C (docs/lead-value.md) should
show up in budget, not just in bid value — a smart-bidding campaign still
needs enough tier-A budget to leave the learning phase on the leads that
matter.

| Tier | Share of total daily budget | Why |
|---|---|---|
| A (Retainer / EAS / RUC / cambiar-de-contador) | 55 % | Highest value per lead, the two priority services (docs/lead-value.md), lowest competition on the keywords that convert |
| B (Compliance one-offs: SIFEN, IVA, IRE, nómina) | 35 % | Real businesses, real intent, medium competition — steady volume |
| C (Individuals / calculators / IRP) | 10 % | Cheapest leads, mostly organic-served already (B3's tools rank); a small always-on budget catches the commercial fraction without competing with A/B for spend |

Start the whole account at the lowest daily budget Google Ads accepts per
campaign (its minimum, not a fixed guaraní figure here — check the current
UI), split by the percentages above, and raise only the campaigns that are
converting once there is data. Do not raise budget on a campaign with zero
conversions after 2× its expected cost-per-lead in spend — pause it and
recheck the ad group first.

## 2. Account structure

```
Contador.com.py
├── Campaign: Apertura y RUC (tier A)
├── Campaign: Contabilidad y cambio de contador (tier A)
├── Campaign: Rubros (tier A/B)
├── Campaign: Cumplimiento — SIFEN, IVA, IRE (tier B)
├── Campaign: Nómina e IPS (tier B)
└── Campaign: Individuos — IRP y calculadoras (tier C)
```

One campaign per row below unless noted. Each ad group is Search, exact +
phrase match only (no broad match — the whole point of this structure is
that Ads only pays for someone who already typed the specific thing).

### Campaign: Apertura y RUC (tier A, ~30 % of total budget — Anton's two priority services, docs/lead-value.md)

| Ad group | Keywords (exact / phrase) | Landing URL | Conversion value |
|---|---|---|---|
| Abrir EAS | [abrir eas], [abrir una eas paraguay], "abrir eas paraguay", [constituir srl paraguay], "apertura de empresa paraguay" | `/eas/` | ₲1 000 000 |
| Inscripción RUC | [inscripción ruc], [inscripcion de ruc], "inscribirse al ruc", [sacar ruc], "actualizar ruc" | `/ruc/` | ₲1 000 000 |

### Campaign: Contabilidad y cambio de contador (tier A)

| Ad group | Keywords | Landing URL | Conversion value |
|---|---|---|---|
| Estudio contable | [estudio contable], "estudio contable asunción", [contador asunción], [contador en asunción], "contabilidad para pymes" | `/contabilidad/` | ₲1 000 000 |
| Cambiar de contador | [cambiar de contador], "cambio de contador paraguay", "honorarios contador" | `/cambiar-de-contador/` | ₲1 000 000 |

"estudio contable" is the core commercial term (1 000/mo, +14 % YoY, low
competition, bid 3.5–12 kr) — this ad group should never be paused for
underspend; it is the cheapest tier-A click on the account.

### Campaign: Rubros (tier A/B — one ad group per segment page, C3)

| Ad group | Keywords | Landing URL | Tier / value |
|---|---|---|---|
| Importadores | "contador para importadores", "contador para empresas importadoras" | `/contador-para/importadores/` | A — ₲1 000 000 |
| Construcción | "contador para constructoras", "contador para empresas de construcción" | `/contador-para/construccion/` | A — ₲1 000 000 |
| Empresas extranjeras | "contador para inversores extranjeros", "abrir empresa paraguay extranjeros" | `/contador-para/empresas-extranjeras/` | A — ₲1 000 000 |
| Emprendedores | "contador para emprendedores paraguay" | `/contador-para/emprendedores/` | A — ₲1 000 000 |
| Comercios | "contador para comercios", "contador para negocios paraguay" | `/contador-para/comercios/` | B — ₲400 000 |
| Gastronomía | "contador para restaurantes paraguay", "contador para bares y restaurantes" | `/contador-para/gastronomia/` | B — ₲400 000 |
| Unipersonales | "contador para unipersonal", "contador para empresa unipersonal" | `/contador-para/unipersonales/` | B — ₲400 000 |
| Profesionales independientes | "contador para profesionales independientes", "contador para freelance paraguay" | `/contador-para/profesionales-independientes/` | B — ₲400 000 |

None of these keywords have a KWP volume figure yet (`docs/keyword-research.md`
lists "contador para unipersonal" / "contador para importadores" as **not yet
checked**) — start each ad group at the campaign's minimum bid, watch impression
volume for two weeks, and drop any ad group with under ~50 impressions/month
rather than guessing a bid on no data.

### Campaign: Cumplimiento — SIFEN, IVA, IRE (tier B)

| Ad group | Keywords | Landing URL | Conversion value |
|---|---|---|---|
| Facturación electrónica | [factura electrónica paraguay], "facturacion electronica paraguay set", [sifen], "habilitación sifen", "sifen que es" | `/ekuatia/` | ₲400 000 |
| IVA | "declaración de iva", [liquidación de iva] | `/iva/` | ₲400 000 |
| IRE Simple | [ire simple], "formulario 120" | `/ire-simple/` | ₲400 000 |
| Certificado y multas (guides, once C2 is merged) | [certificado cumplimiento tributario], [multas dnit] | C2's CCT and multas guides, `/marangatu/` fallback until then | ₲400 000 |

### Campaign: Nómina e IPS (tier B)

| Ad group | Keywords | Landing URL | Conversion value |
|---|---|---|---|
| Liquidación de sueldo (empleador) | [liquidacion de salario ips], "liquidacion de salario paraguay empleador", "planilla mtess" | `/ips/` | ₲400 000 |
| Auditoría | [auditoría interna], "auditoria impositiva paraguay", "auditoria externa paraguay", "peritaje contable" | `/auditoria/` (or the matching child page) | A — ₲1 000 000 (auditoría is tier A per docs/lead-value.md, kept in this campaign for the nómina/compliance audience overlap, not moved to the Apertura campaign) |

### Campaign: Individuos — IRP y calculadoras (tier C, smallest budget)

| Ad group | Keywords | Landing URL | Conversion value |
|---|---|---|---|
| IRP | [irp paraguay], "irp en paraguay" | `/irp/` | ₲100 000 |
| Aguinaldo | [como se calcula el aguinaldo], [cálculo aguinaldo], "aguinaldo proporcional" | `/herramientas/calculadora-aguinaldo/` | ₲100 000 |
| Liquidación de salario (empleado) | [liquidacion de salario] (without "ips"/"empleador" modifiers — those go to the Nómina campaign above) | `/herramientas/liquidacion-de-salario/` | ₲100 000 |

Consider pausing this whole campaign first if budget is ever tight: B3's
calculators already rank organically for most of these terms
(`docs/keyword-research.md` §1), so the paid incremental value here is the
weakest on the account.

## 3. Negative keywords (account-level, apply to every campaign)

| Negative | Why |
|---|---|
| marangatu, ekuatia, marangatu login, marangatu 2.0, consulta de ruc | Navigational giants (165k / 33k searches/mo) — near-zero direct value, we do not outrank the DNIT for its own login (docs/lead-value.md rule 4, keyword-research.md §2) |
| jubilado, liquidacion de sueldo jubilado, pension | Retiree pension calculations are out of scope (keyword-research.md round 2) |
| iso 9001, auditor iso, auditor hseq, calidad iso | ISO/HSEQ auditor job-seeker intent, not our buyer (keyword-research.md round 2) |
| empleo, trabajo, vacante, se busca contador | Job-seeker intent on "contador" terms, not a client |
| gratis (except our own "gratis" in "consulta gratis" ad copy, which is fine — this blocks searches like "planilla ips gratis" / "calculadora aguinaldo gratis descargar") | Free-tool/download intent that will not convert to an engagement |
| acm, mb, mc, dc, rb, gm, martinez, guerrero, abaco estudio contable (+ any other named competitor) | Competitor brand searches (keyword-research.md round 2) — do not bid on a competitor's name |
| curso, capacitación, que es contabilidad, nic 1, eeff | Student/informational intent that the blog already serves organically, not a paid target |

Add per-campaign negatives as data comes in — this list is the floor, not
the ceiling.

## 4. What Anton does, in order

1. Confirm the GA4 property and the two conversion actions are importing real
   values (`docs/analytics-setup.md` §2, especially the check that
   `lead_submit` shows different `value`s on `/eas/` vs `/irp/`).
2. Create the six campaigns above, Search only, manual CPC to start.
3. Build each ad group with its keyword list, exact + phrase match only.
4. Apply the account-level negative list (§3) before the first campaign goes
   live, not after.
5. Write 2–3 responsive search ads per ad group. Headlines name the rubro or
   the service term exactly as searched (e.g. "Contador para importadores",
   "Abrir una EAS en Paraguay"), never a generic "Servicios contables". Every
   ad's final URL is the landing page in the table above — never the
   homepage.
6. Set budgets per §1, watch for two weeks, then move underperforming ad
   groups (§2's "Rubros" campaign especially) to Ads' Recommendations or pause
   them rather than raising bids blind.
7. Once ~30 conversions have accumulated on the account, switch bidding to
   Maximise conversion value (or a tROAS target), so Ads starts favouring
   tier A over tier C automatically — the whole reason the values above exist.
8. Revisit this document alongside `docs/lead-value.md` rule 6, after four
   weeks of GA4 data. Both are one edit, not a rebuild.
