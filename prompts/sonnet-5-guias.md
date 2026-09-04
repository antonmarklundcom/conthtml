# Phase C2 — Guías. Paste into a fresh SONNET session, ONLY after phase C1 is merged.

Read ONLY `plan.md` §1, §4, your own §6 section below, the phase table, and the last three entries of §9 (build log) — not the whole plan — plus, `KNOWN-ISSUES.md`, `docs/keyword-research.md`
and `docs/lead-value.md`. Execute plan §6.5 under the autonomy protocol §4. Build nothing outside the plan.

HARD LIMITS (plan §4.7): no changes to the CSS tokens block, `partials/header.php`, `partials/footer.php`, `lib/*`, `templates/service.php` structure, `enviar.php`, `.htaccess`.

Phase rules:
- Branch `phase/c2-guias` off latest main. C1 unmerged ⇒ finish it first.
- Copy brief from `prompts/sonnet-1-services.md` applies (usted, no fabricated facts, every figure into `docs/facts-to-verify.md`). Guides are step lists first, prose second.
- `templates/guide.php` follows the `templates/tool.php` pattern (output buffering into shared chrome). `content/guias.php` follows the `content/tools.php` shape discipline.
- Every guide's "Cuándo conviene delegarlo" box uses the lead form with `service` set to the matching service slug (C1 contract), never a bare link.
- Do not scrape DNIT/IPS sites; write from the reference material and general knowledge, log what needs a human check.
- Re-runnable; minor issues → KNOWN-ISSUES.md; stop only per §4.4.

Exit: `/guias/` + 10 guide URLs in the sitemap, titles ≤ 60 / descriptions 120–155, HowTo + FAQ JSON-LD on each, verify green, screenshots come from the CI artifact (plan §4.12), none committed, PR merged.

## After this phase
Follow `prompts/_handoff.md`. Next: `prompts/sonnet-6-segmentos-ads.md`, model **Sonnet**.
