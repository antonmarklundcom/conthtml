# Phase C4 — Blog round 2 + internal-link pass. Paste into a fresh SONNET session, ONLY after phase C3 is merged.

Read ONLY `plan.md` §1, §4, your own §6 section below, the phase table, and the last three entries of §9 (build log) — not the whole plan — plus, `KNOWN-ISSUES.md`, `docs/keyword-research.md`
(round 2 table) and `docs/facts-to-verify.md`. Execute plan §6.7 under the autonomy protocol §4.

HARD LIMITS (plan §4.7): no changes to the CSS tokens block, `partials/header.php`, `partials/footer.php`, `lib/*`, `templates/service.php` structure, `enviar.php`, `.htaccess`. `templates/article.php` stays as is.

Phase rules:
- Branch `phase/c4-blog-2` off latest main. C3 unmerged ⇒ finish it first.
- Same article shape as B2 (`content/blog.php` metadata, body in `/blog/<slug>/index.php`, `$toolLink` slot, FAQ JSON-LD, 900–1 300 words, usted).
- Every legal figure goes through `docs/facts-to-verify.md`; the IRP article uses brackets only if that file marks them resolved.
- Internal-link pass is part of the exit, not optional: every service page → ≥ 1 article and ≥ 1 guide; every article → ≥ 2 services; add a small script `tests/links.mjs` (or extend `verify.sh`) that asserts it.
- Re-runnable; minor issues → KNOWN-ISSUES.md; stop only per §4.4.

Exit: 14 articles in the sitemap, link assertions green, verify green, screenshots come from the CI artifact (plan §4.12), none committed, PR merged.

## After this phase
Follow `prompts/_handoff.md`. Next: `prompts/sonnet-8-english-founders.md`, model **Sonnet**.
