# Phase B1 — 14 service pages. Paste into a fresh SONNET session, ONLY after phase A2 is merged.

Read `plan.md` FIRST, in full — plus §9 build log and `KNOWN-ISSUES.md`.
Execute plan §6.1 under the autonomy protocol §4. Build nothing outside the plan.

HARD LIMITS (plan §4.7): do not change the CSS tokens block, `partials/header.php`, `partials/footer.php`, `lib/*`, the structure of `templates/service.php`, `enviar.php`, or `.htaccess`. Need something there? Work around it and add a Backlog note in plan §10. Adding content keys, new partials, or CSS below the tokens is fine.

Phase rules:
- Branch `phase/b1-services` off latest `main`. A2 unmerged ⇒ finish it first.
- Stack is HTML + PHP partials (plan §1.5). All copy lives in `content/services.php`; page files stay 3 lines.
- Load skills: `paraguay-business-apps`, `nextjs-national-lead-gen` (§3 SEO only).
- Source copy = `docs/reference/site-scan-2026-09-02.md` §3 (verbatim legacy text). REWRITE it: "usted", tighter,
  600–900 words per page, keyword-first H1 that still contains the legacy title label. Never paste paragraphs verbatim.
- Fix the three copy-paste bugs in scan §6.9 with genuinely new passages (EAS closing CTA; Auditoría Impositiva benefits; Auditoría Forense FAQ 3).
- Write the new `/contabilidad/` and `/irp/` pages from scratch (plan §6.1.3, 3b) and the Guía blocks on Marangatu/Ekuatia/IRE/RUC (§6.1.3c). Read `docs/keyword-research.md` first for the H2 targets.
- Every page: unique title ≤ 60 chars, unique description 120–155 chars, FAQ (3–5) with `FAQPage` JSON-LD, 3 related services, service-specific WhatsApp prefill text. Everything escaped through `e()`.
- Re-runnable; minor issues → `KNOWN-ISSUES.md`; stop only per §4.4.

## Copy brief (binding — decided at the A1→B1 review)

**Angle.** Every page sells one outcome: "se presenta a tiempo y bien, y usted se entera antes que la DNIT". Open with the concrete thing the reader fears (multa automática, RUC inconsistente, timbrado bloqueado, IPS en mora, CCT bloqueado), name the mechanism (which form, which system, which deadline), then what we do about it. In that order. The old copy opens with adjectives; do not.

**Proof without stats.** `site.stats`, `team` and `testimonials` are empty, so proof is specificity and process, never numbers about the firm. Use: (a) named mechanics — Formulario 120, vencimiento por terminación de RUC, F.120 anual, aporte IPS 9 % obrero / 16,5 % patronal, tope Resimple, CCT, SUACE; (b) three lists on every page: "Qué incluye", "Qué no incluye", "Qué necesitamos de usted"; (c) commitments phrased as commitments, not statistics ("respondemos el mismo día hábil", "cierre antes del día 5"); (d) facts of Paraguayan law rather than claims about us. Never invent clients, years, counts, awards or quotes.

**Cut.** "blindaje", "inteligencia fiscal", "nativos digitales", "detectives financieros", "el beneficio principal/colateral de…", "tu tranquilidad es nuestra métrica", every superlative and every exclamation mark. Benefit blocks shrink from 150-word paragraphs to 3 cards of ≤ 45 words. Body ≤ 900 words including FAQ.

**Register.** "usted" throughout, short sentences, no English. Terminology: DNIT (antes SET), SIFEN, Ekuatia'i, Marangatu, IPS, MTESS, IRE, IRP, IVA, RUC, CCT, EAS, SUACE.

**FAQ.** Answer what people actually type (`docs/keyword-research.md`): "¿cuándo se cobra…?", "¿qué es SIFEN?", "¿cómo sé si tengo multas?", "¿qué pasa si no vendí nada?". 40–80 words each, direct answer in the first sentence.

**Fact discipline.** Every legal number, threshold, rate or deadline you state goes into `docs/facts-to-verify.md` (page, statement, where you believe it comes from). If unsure, write "consulte el monto vigente" instead of a figure. The scan's figures (Gs. 9.201.143.662 audit threshold, Resimple 80 millones, IRE Simple 2.000 millones, RUC en 24–72 h) may be reused only if listed there.

**Navigational terms.** "marangatu" (165k) and "ekuatia" (33k) are mostly people looking for the DNIT login; a service page will not outrank DNIT for the bare term and must not try. Keep the commercial H1/hero as the service. In the Guía block, link the official DNIT login first (find the current URL on dnit.gov.py and verify it resolves), then answer the how-to long tail: Marangatu 2.0 qué cambió, recuperar clave, CCT, consulta de RUC, ESET; Ekuatia vs Ekuatia'i, cómo habilitarse. "ekuatia i" (+309 %) is people adopting DNIT's free invoicing tool, which is exactly the habilitación service we sell — that page is commercially right.

**IRP.** Explainer first (quiénes deben inscribirse, rangos y tasas, deducciones, plazo anual), service second. It ranks on the informational term and converts the professionals who need the liquidación.

Exit: all 14 service URLs render full copy; `docs/facts-to-verify.md` exists; `FAQPage` JSON-LD validates on each; no duplicate titles/descriptions; `./verify.sh` green; screenshots of 3 service pages in `docs/screenshots/b1/` and the PR; PR merged.

## After this phase
Follow `prompts/_handoff.md`. Next: `prompts/sonnet-2-pages.md`, model **Sonnet**.
