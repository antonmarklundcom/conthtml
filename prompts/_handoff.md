# Handoff footer (referenced by every phase prompt)

Hand off ONLY when all four gates pass:
1. This phase's PR is merged green.
2. Every exit criterion in the prompt is checked.
3. Pre-handoff audit done: re-run `./verify.sh` and `deploy/make-zip.sh` on main, adversarially re-read your own merged diff, fix findings in a follow-up commit if needed.
4. Build-log entry (plan.md §9, 5–10 dated lines) committed and pushed.

Then spawn the next phase as a NEW session with the claude-code-remote `create_session` tool:
`source_url` = `https://github.com/antonmarklundcom/conthtml` (so the session starts with the repo attached
instead of "default"), inherit environment and permission mode (never `plan`), `model` = the next phase's model from the
plan.md phase table (Opus or Sonnet only — NEVER Fable). Always pass `model` explicitly as the current
model id of that family (look it up in the `claude-api` skill; `create_session` otherwise inherits the
caller's model, which is wrong at a model switch). `prompt` exactly:
`Read prompts/<next-file>.md in this repo and execute it.`
Then end with a short phase report (PR link, what exists now, deviations).

Fallback if `create_session` is unavailable: same model next → continue in this window; model switch → stop and report.
Never hand off with a red build, an open PR, or an unmet exit criterion.
