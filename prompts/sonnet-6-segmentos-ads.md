# Phase C3 — Segment landing pages + Ads runbook. Paste into a fresh SONNET session, ONLY after phase C2 is merged.

Read ONLY `plan.md` §1, §4, your own §6 section below, the phase table, and the last three entries of §9 (build log) — not the whole plan — plus, `KNOWN-ISSUES.md`, `docs/keyword-research.md`
and `docs/lead-value.md`. Execute plan §6.6 under the autonomy protocol §4. Build nothing outside the plan.

HARD LIMITS (plan §4.7): no changes to the CSS tokens block, `partials/header.php`, `partials/footer.php`, `lib/*`, `templates/service.php` structure, `enviar.php`, `.htaccess`.

Phase rules:
- Branch `phase/c3-segmentos` off latest main. C2 unmerged ⇒ finish it first.
- Load skills: `paraguay-business-apps` (rubro-specific tax mechanics), `nextjs-national-lead-gen` (§3 SEO and conversion patterns only).
- Each segment page names three specific traps for that rubro (mechanics, not stats) and one bundle of services. No prices unless `content/precios.php` has them.
- `/cambiar-de-contador/` is tier A: explain the handover (what we request from the previous accountant, timeline "con fechas acordadas"), reassure on continuity.
- `docs/ads-campaigns.md` is a runbook Anton executes by hand: campaigns, ad groups, exact/phrase keywords, negatives, landing URL, conversion action and value per group. Create nothing in Google Ads.
- Re-runnable; minor issues → KNOWN-ISSUES.md; stop only per §4.4.

Exit: 9 URLs in the sitemap, homepage rubros cards and `/servicios/` link to them, verify green, screenshots come from the CI artifact (plan §4.12), none committed, `docs/ads-campaigns.md` written, PR merged.

## After this phase
Follow `prompts/_handoff.md`. Next: `prompts/sonnet-7-blog-2.md`, model **Sonnet**.
