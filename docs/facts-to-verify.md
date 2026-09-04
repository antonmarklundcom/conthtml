# Facts to verify — B1 service pages (2026-09-03)

Every legal number, rate, threshold or deadline stated on the 14 service pages
(plan §6.1, copy brief in `prompts/sonnet-1-services.md`), with where it came
from and whether it needs Anton's confirmation before launch. Nothing here was
invented: figures are either carried from the scan (`docs/reference/site-scan-2026-09-02.md`,
whitelisted for reuse by the copy brief) or from public DNIT/IPS sources
checked during this phase. Where a number changes with reglamentación, the
page hedges with "consulte el monto vigente" instead of a hard figure.

| Page(s) | Statement | Source | Confidence / action |
|---|---|---|---|
| `/auditoria/`, `/auditoria-auditoria-impositiva/` | Umbral de facturación anual que obliga a la auditoría externa: **Gs. 9.201.143.662** | Scan §3.10/§3.11 FAQ (legacy site copy), whitelisted for reuse by the copy brief | Carried verbatim from the legacy site. **Confirm the current figure for the ejercicio in progress** — this kind of threshold is typically adjusted; pages hedge with "confírmelo con nosotros" alongside the number. |
| `/ire-simple/` | Tope Resimple: **Gs. 80.000.000** anuales | Scan §3.6 FAQ 1, whitelisted | Same caveat — confirm current tope before the next tax season. |
| `/ire-simple/` | Tope IRE Simple: **Gs. 2.000.000.000** anuales | Scan §3.6 FAQ 1, whitelisted | Same caveat. |
| `/ruc/` | Plazo de aprobación de RUC: **24 a 72 horas hábiles** | Scan §3.4 FAQ 1, whitelisted | Service-level commitment from the legacy site; reasonable to keep, but confirm DNIT hasn't changed typical processing time. |
| `/ips/` | Aporte obrero **9%** / aporte patronal **16,5%** | Copy brief (prompts/sonnet-1-services.md, "proof without stats" §, mechanism list) | These are the standard IPS contribution rates for private-sector dependientes in Paraguay. Confirm no recent regulatory change and that this applies to all the employee categories the firm actually serves (there are special regimes for some sectors). |
| `/eas/` | Constitution goes through **SUACE** (Sistema Unificado de Apertura y Cierre de Empresas), no notarial deed required, no minimum capital by law | Scan §3.5 body + general public knowledge of the EAS law (Ley 6480/2020) | High confidence, but not independently re-verified against the current SUACE process this phase — confirm no procedural changes before quoting "sin necesidad de escritura notarial" to a client. |
| `/asesoria/` | References **Ley 6380/2019** as the current tax-reform law underpinning IVA/IRE | Public knowledge (Paraguay's 2019 tax modernization law) | High confidence; not itself a number that changes, but confirm the firm is comfortable citing the law by number on the page. |
| `/marangatu/` (Guía rápida) | Marangatu login goes through the system's **ESET module** at `marangatu.set.gov.py/eset/login`; DNIT institutional page at `dnit.gov.py` also links to Sistema Marangatu | WebSearch during this phase (see below) — **not independently fetched**, this session's network egress blocked both `dnit.gov.py` and `marangatu.set.gov.py` directly | **Needs a human check before launch**: confirm the URL still resolves and that DNIT hasn't moved the login off the `set.gov.py` domain as part of the SET→DNIT rebrand. The page's Guía block links to the DNIT institutional page rather than hardcoding the raw login URL, precisely because of this uncertainty. |
| `/marangatu/` (Guía rápida) | "ESET" in Marangatu is the login/authentication module (the literal `/eset/login` URL path), not a separate product | WebSearch during this phase | Reasonably confident (the URL itself confirms it), but the page deliberately does not expand what "ESET" stands for as an acronym, since that wasn't confirmed. |
| `/ekuatia/` | **Ekuatia vs Ekuatia'i**: Ekuatia'i is DNIT's free single-establishment/single-point-of-issuance tool; Ekuatia is the umbrella system reached via software integration with SIFEN for larger taxpayers | WebSearch during this phase (third-party summaries, e.g. Tiendli, Neosystem, BillPy) | Consistent across multiple independent sources found; not sourced directly from a DNIT primary document this phase. Recommend a quick primary-source check (dnit.gov.py) before the B4 launch pass. |
| All pages | "DNIT (antes SET)" naming | Plan §1's terminology list; well-established public fact (the tax authority was renamed) | High confidence, no action needed. |
| `/irp/` | IRP tax brackets, rates and specific deduction categories | Not stated on the page — deliberately hedged | This phase did **not** find a confidently current source for IRP brackets/rates/deduction limits, so the page says "consulte el monto vigente" instead of a number, per the copy brief's fact-discipline rule. **Anton or a future phase should supply the current IRP tramos/tasas/deducciones so the page can state them.** |
| `/auditoria-auditoria-impositiva/`, `/auditoria/` | Duration of a full audit engagement | Scan §3.10/§3.11 said "4 a 8 semanas" — **not reused**, because it is not on the whitelist in the copy brief | Pages now say duration "depende del volumen de sus operaciones... se lo confirmamos en el diagnóstico inicial" instead of quoting a week range. If the firm has a real typical range, it can be added later. |

## B2 — Secondary pages and blog (2026-09-04)

| Page(s) | Statement | Source | Confidence / action |
|---|---|---|---|
| `/blog/como-se-calcula-el-aguinaldo-en-paraguay/` | "En general, el aguinaldo está exceptuado del aporte obrero del 9 % al IPS" | Well-established public knowledge among Paraguayan payroll practitioners (aguinaldo is not part of the base for the ordinary IPS worker contribution) — not independently re-verified against a primary IPS resolution this phase | Phrased with "en general" and a suggestion to confirm special regimes, per the site's existing hedging pattern. Recommend a primary-source check (IPS resolution) before the B4 launch pass, alongside the other B1 hedged items above. |
| `/privacidad/`, `/terminos/` | Cites **Ley N.º 1682/2001** (información de carácter privado) and its modification by **Ley N.º 6534/2020** | Plan §6.2.4 explicitly authorizes citing exactly these two laws for the privacy page | Pre-authorized by the plan, not independently verified against the law text this phase. High confidence — both are real, publicly known Paraguayan statutes — but a legal review before launch is still advisable for any accounting-firm privacy policy. |
| `/blog/ire-simple-resimple-ire-general-formulario-120/`, `/blog/certificado-de-cumplimiento-tributario-marangatu/`, `/blog/abrir-una-eas-en-paraguay/`, `/blog/como-habilitarse-en-sifen-factura-electronica-ekuatia/` | Reuse the IRE thresholds (Gs. 80.000.000 / Gs. 2.000.000.000), the Ekuatia/Ekuatia'i distinction and the SUACE/EAS process already logged above for the matching service pages | Same sources as the B1 rows above — no new figures introduced | Same caveats as the original B1 rows apply; nothing new to confirm beyond what is already listed there. |

## Notes on method

- Two figures the copy brief explicitly named as reusable (`site.stats`-style
  numbers are *not* used anywhere — no invented client counts, testimonials,
  or years were added, per plan §1.4 and the copy brief's "proof without
  stats" rule).
- `WebFetch` to `dnit.gov.py` and `marangatu.set.gov.py` was blocked by this
  session's network egress policy, so the Marangatu login URL was confirmed
  only via `WebSearch` result snippets, not by loading the page directly.
  Flagged above for a human check.
- No new numeric claims were added beyond what this table lists; every other
  statement on the 14 pages is a description of process ("qué incluye", "qué
  necesitamos de usted", commitments like "respondemos el mismo día hábil")
  rather than a verifiable external fact.
