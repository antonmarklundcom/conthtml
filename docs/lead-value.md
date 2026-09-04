# Lead value model — which leads are worth the most, and why

Binding input for phase C1 (`content/lead-values.php`), C3 (`docs/ads-campaigns.md`) and for anyone selling or routing the leads. Written 2026-09-04 from `docs/keyword-research.md` (volumes, competition, top-of-page bids) and from what each service is worth to an accounting practice in Paraguay.

## How a lead is valued

A lead's value is what the *engagement it starts* is worth, not what the search term costs:

- **Recurring retainer** (contabilidad mensual, nómina, declaraciones) is the prize: a Pyme client pays every month for years. One retainer is worth more than a dozen one-off jobs.
- **One-off with a retainer behind it** (apertura de empresa, inscripción de RUC, habilitación SIFEN): the job itself is modest, but a company that just opened needs an accountant next month. Valued as a discounted retainer.
- **One-off, high ticket** (auditoría, peritaje): rare, well paid, no recurrence.
- **Individual, low ticket, seasonal** (IRP, aguinaldo questions, liquidación de salario): high volume, low willingness to pay, often an employee rather than an employer. Valuable only as a list and as a source of the occasional employer.
- **Navigational** (Marangatu login, consulta de RUC): near-zero direct value. The guides exist to be found, to build authority, and to catch the fraction who would rather delegate.

## Tiers

| Tier | Ads conversion value (proxy, ₲) | Services / sources | Reasoning |
|---|---|---|---|
| **A** | 1 000 000 | contabilidad, cambiar-de-contador, eas, ruc (jurídica), auditoria-*, segment pages (importadores, comercios, construcción, gastronomía, empresas-extranjeras), `/en/` leads | Retainer or retainer-adjacent. "estudio contable" is the core commercial term (1 000/mo, +14 %, low competition, bid 3.5–12 kr) and every one of these converts into it. Foreign founders are the highest ticket of all: they pay for the whole stack and rarely price-shop. |
| **B** | 400 000 | ekuatia / SIFEN habilitación, iva, ire-simple, ips (nómina), asesoria, unipersonales, profesionales-independientes, emprendedores | Real businesses with a concrete compliance need. "factura electrónica paraguay" (1 300/mo, medium competition), "inscripción ruc" (2 400, +50 %), "sifen" (2 900). Some become retainers, many are one-off. |
| **C** | 100 000 | irp, calculators (aguinaldo, liquidación de salario, IVA), vencimientos reminders, quiz "otro", guides | Mostly individuals or employees; "liquidacion de salario" 5 400/mo and aguinaldo phrasings ~5 000/mo are traffic and list-building, not revenue. Keep them because they are the cheapest leads on the site and the reminder list is a nurture asset. |

The values are optimisation proxies for Google Ads (so bidding favours A over C by 10:1), not revenue estimates. They live in one file (`content/lead-values.php`) and can be changed without touching pages.

## Per-source detail

| Source (page or tool) | Tier | Volume signal | Competition / bid | Note |
|---|---|---|---|---|
| `/contabilidad/`, homepage form | A | estudio contable 1 000 (+14 %) | low, 3.5–12 kr | The retainer entry point. Every B/C thank-you page should upsell to it. |
| `/cambiar-de-contador/` (C3) | A | ≤ 10 but pure intent | none | Someone unhappy with their accountant is the easiest retainer to win. |
| `/eas/`, `/ruc/` (jurídica) | A | abrir eas 140 (+55 %), inscripción ruc 2 400 (+50 %) | low | New companies need an accountant in 30 days. Ask "¿ya tiene contador?" in the next-step text. |
| `/auditoria/`, `/auditoria-*` | A | 70–110 each | low | Few, but each one is a large invoice. |
| Segment pages (C3) | A/B | rubros band; "contador para importadores" not yet measured | — | Pre-qualified by rubro. Importadores/construcción A; unipersonales/profesionales B. |
| `/en/` (C5) | A | unmeasured; international | — | Highest ticket. Route to WhatsApp in English immediately. |
| `/ekuatia/` | B | ekuatia 33 100, ekuatia i 22 200 (+309 %), factura electrónica 1 300 | medium, 2.8–7 kr | Mostly how-to; the habilitación job is real. Guide (C2) catches the rest. |
| `/iva/`, `/ire-simple/` | B | ire simple 880, declaración de iva 110, formulario 120 320 | low | Compliance retainers in disguise. |
| `/ips/` | B | liquidacion de salario ips 1 000 (+30 %) | low | Employers searching IPS obligations are B; employees are C. The form's `company` field separates them. |
| `/asesoria/` | B | asesoría tributaria ≤ 10 | — | Low volume, decent intent. |
| `/irp/` | C | irp paraguay 1 600 (−45 %) | low | Individuals, seasonal (March). Batch them; offer a fixed-fee IRP service. |
| Calculators (B3) | C | aguinaldo ~5 000, liquidación 5 400 | low, 4.8–11 kr | Employees mostly. The CTA should ask "¿Es empleador?" and upgrade to B when yes. |
| Vencimientos reminders | C | vencimientos dnit unmeasured | — | Nurture list. Monthly WhatsApp broadcast later (plan §10). |
| Guides (C2) | C | marangatu 165 000, consulta de ruc 140, CCT 210 (+136 %), multas dnit 110 (+22 %) | low | Authority and long-tail. Multas DNIT and CCT are the two guide topics with real delegate-it intent → B when the form is used. |

## Rules the phases must follow

1. Every form submission carries `service`, `value_tier` and (tools) `tool_result`. A lead without a service is a `/contacto/` lead and takes the tier of its `need` chip.
2. Tier is set by the **page**, not by the visitor. A tier-C page may upgrade to B through one explicit question ("¿Es empleador?"); nothing else changes tiers client-side.
3. Thank-you text always names the next concrete step and offers WhatsApp with a service-specific prefill. Tier C thank-you pages mention the monthly retainer once.
4. Never bid on the navigational giants. Guides are organic only.
5. Revisit this table after four weeks of GA4 data: the tiers are a starting hypothesis, the file is one edit.
