# Phase C5 — English section for foreign founders. Paste into a fresh SONNET session, ONLY after phase C4 is merged.

Read ONLY `plan.md` §1, §4, your own §6 section below, the phase table, and the last three entries of §9 (build log) — not the whole plan — plus, `KNOWN-ISSUES.md`, `docs/lead-value.md` and
`docs/facts-to-verify.md`. Execute plan §6.8 under the autonomy protocol §4.

HARD LIMITS (plan §4.7) with ONE sanctioned exception: `lib/bootstrap.php`'s `ui()` may gain an optional
English lookup (`content/ui.en.php`) selected by a constant the `/en/` pages define. Spanish pages must
render byte-identical before and after (diff two rendered pages to prove it). No other `lib/*`, partial
or `.htaccess` change; `enviar.php` unchanged (send `lang=en` as a form field).

Phase rules:
- Branch `phase/c5-english` off latest main. C4 unmerged ⇒ finish it first.
- Five `/en/` pages per plan §6.8, `lang="en"`, hreflang pairs, English WhatsApp prefill, form with `service=empresas-extranjeras` (tier A).
- Tax figures only from `docs/facts-to-verify.md` resolved items; otherwise explain the mechanism and say "current rates confirmed on request".
- Re-runnable; minor issues → KNOWN-ISSUES.md; stop only per §4.4.

Exit: 5 `/en/` URLs in the sitemap with hreflang, verify green with the extended route contract, a test lead from `/en/contact/` logged with `lang=en`, screenshots come from the CI artifact (plan §4.12), none committed, PR merged.

## After this phase — STOP
No further phase. Run the four handoff gates, rebuild the zip, and end with the closing report to Anton:
what exists now, the leads ledger command, the Ads runbook location, and open items in `docs/facts-to-verify.md`.
Do not spawn a session.
