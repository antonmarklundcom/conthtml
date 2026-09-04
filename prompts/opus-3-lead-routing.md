# Phase C1 — Lead value routing. Paste into a fresh OPUS session, ONLY after phase B4 is merged.

Read `plan.md` FIRST, in full — plus §9 build log and `KNOWN-ISSUES.md`. Then read
`docs/lead-value.md` (binding). Execute plan §5.3 under the autonomy protocol §4.
Build nothing outside the plan.

This is a Model-A phase: you MAY change `enviar.php`, `partials/lead-form.php`, `lib/*` and
`templates/*` structure — additively, never renaming an existing field or content key. The
VenderCRM payload contract (plan §1.6) only gains fields.

Phase rules:
- Branch `phase/c1-lead-routing` off latest main. B4 unmerged ⇒ finish it first.
- Load skills: `vendercrm-lead-capture`, `paraguay-business-apps`.
- `content/lead-values.php` is the single source: tier, adsValueGs, whatsappText, nextStep, crmTag per service and tool slug. Pages never hardcode a tier.
- The site is LIVE from B4 on: keep every existing URL and status code; verify.sh must stay green at every commit; run `deploy/make-zip.sh` at the end so main is redeployable.
- Test the Resend subject and the CSV export against a real leads.log line from verify.sh.
- Re-runnable; minor issues → KNOWN-ISSUES.md; stop only per §4.4.

Exit: plan §5.3.8 checks green in `verify.sh`; thank-you screenshots for one tier-A and one tier-C service in `docs/screenshots/c1/`; `docs/analytics-setup.md` written; PR merged.

## After this phase
Follow `prompts/_handoff.md`. Next: `prompts/sonnet-5-guias.md`, model **Sonnet** (model switch — pass the Sonnet model id explicitly).
