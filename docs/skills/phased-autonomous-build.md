---
name: phased-autonomous-build
description: Plan and run a full project build as autonomous, phased Claude Code sessions with minimal human time at the keyboard — idea sketch → reviewed plan.md → per-phase prompt files → two lanes (short sequential Opus foundation lane, then all Sonnet content phases spawned at once in parallel, each owning its own files) → one PR per phase merged green → an hourly Sonnet watcher Routine instead of any live supervision. Includes the HTML+PHP template profile (start the next brochure site from antonmarklundcom/conthtml and skip the foundation phases). Use EVERY time Anton plans a new app/site build, shares an idea sketch, asks to "make a plan", "review the plan", "split work between Opus and Sonnet", "build this AFK", "phased build", "one PR per step", "start from conthtml", "another PHP brochure site", or asks how to structure prompts for an unsupervised end-to-end build. Also when a build session says "continue with the next phase". Proven on alquilar.com.py (rent) and contador.com.py (conthtml).
---

# Phased Autonomous Build

Turn a project idea into a repo that builds itself: a reviewed `plan.md`, a `prompts/` folder with one prompt file per phase, and handoff rules so each finished phase starts the next one in a fresh session. The human's total involvement: share the idea, answer the review questions, start phase 1, and read the closing report.

Why this shape works:
- **Phases = PRs.** Each phase is one branch, one PR, merged green. A failure can only ever cost one phase.
- **Two lanes.** Lane 1 (Opus, sequential): the few foundation phases whose decisions constrain everything. Lane 2 (Sonnet, parallel): every content/page/tool phase, spawned all at once the moment lane 1 merges, each owning its own files so they cannot conflict.
- **Fresh session per phase, reading only what it needs.** Each phase starts with its own plan sections + the logs of the phases it depends on, never the whole history.
- **The repo is the memory.** plan.md, `docs/log/<phase>.md` and KNOWN-ISSUES.md carry ALL state. If it isn't committed, the next phase doesn't know it. Nobody messages a running session.
- **Nobody supervises live.** A phase either finishes or stalls; an hourly Sonnet watcher Routine restarts stalled phases and notifies Anton. Fable is never in the loop while a build runs.

## Budget and the lesson behind these rules (conthtml, 2026-09-03/04)

contador.com.py — a static HTML+PHP brochure site, no database, no framework — cost ~$263 and ~12 h. ~$153 of that was seven Opus/Sonnet phases that shipped code; ~$110 (42 %) was Fable: one planning session ($28, useful) and two "Fable lead" sessions ($82) that supervised running builds live for hours, hit the 5-hour session limit, shipped nothing, and at the one real decision (a "do not merge yet" that arrived 16 minutes after the merge) deliberated instead of escalating. Content phases that touched disjoint files ran one after another. B4 and C1 spent a third of their budget re-verifying, re-screenshotting and rewriting PR bodies. 59 MB of screenshots were committed to the tree.

**Target for the next comparable HTML+PHP site: ≤ $60 and ≤ 4 h wall-clock**, via the template profile below plus lane 2 in parallel. Anything over that is a process failure to log here, not a fact of life.

## Stage 1 — Review the idea

Input is a raw idea sketch (a markdown doc, a voice-note transcript, a chat message — rawness is fine; do NOT ask the user to have another model "improve" it first).

0. **Check for a template first.** A local-business brochure/tools/blog site in HTML+PHP starts from the conthtml template profile (below) and skips the foundation lane. A Next.js listings/app build starts from the stack skills. Say which applies before anything else.
1. Read the sketch. Identify the decisions that BLOCK a build start (business model, vertical sequencing, market, monetization) vs. ones that don't.
2. For each blocking decision, give a concrete recommendation with reasoning — the goal is that the user can reply with "yes" or short corrections, not homework.
3. Ask for the stack only if it isn't obvious; default to the user's proven stack skills (for Anton: `nodejs-mysql-hostinger-stack` + `nextjs-deploy-hostinger`, market skills for PY/SE).
4. Rank optional feature ideas numbered so the user can reply with numbers. Note which features chain together and where schema/content shape must support them from day one even if UI comes later.

Wait for the user's decisions before Stage 2. Record every resolved decision in plan.md §1 as "already made — do not re-litigate".

## Stage 2 — Write plan.md

One file, repo root. Required sections (keep the numbering stable — prompts reference it):

1. **Decisions already made** — locked; build sessions never reopen these.
2. **Roles & object model** (apps) / **Content model** (sites) — the structural anchors. Apps: roles as a DB enum from day one; one shared object table + typed 1:1 detail tables; identifiers in English, public URLs and copy in the market language, all UI strings through an i18n layer. Sites: one content array file per page type, its key shape documented as the contract, page files are three lines.
3. **Feature scope** — core + approved extras, grouped by dependency chain.
4. **Autonomy protocol** — see below; every prompt references it.
5. **Lane 1 phases** (Opus, sequential) — full task detail per phase. The COMPLETE schema / content-shape contract is written in the first phase: it is never retrofitted.
6. **Lane 2 phases** (Sonnet, parallel) — each with hard limits (no schema/auth/core-logic/foundation changes) and an **Owns** list. Plus one final **link pass** phase (Sonnet, sequential, after all of lane 2 merges) that holds every cross-cutting edit: internal links between lane-2 outputs, nav additions, hub cards, sitemap sanity. Cross-links are the only thing that makes content phases collide, so they all live here.
7. **Human-inputs checklist** — every credential/access only the user can provide, and which phase first needs it.
8. **Open business questions** — parked, not build work.
9. **Build log index** — one line per phase: id, PR, `docs/log/<phase>.md`. The detail lives in the per-phase log files, never here.
10. **Backlog** — where scope creep goes to wait.

Phase table in the header: phase id, lane, model, prompt file, plan sections, **Owns** (paths/globs the phase may create or modify), **Depends on** (phases whose logs it must read). Right-size phases to what one Sonnet session finishes in ≤ 90 minutes — a phase that needs two sessions was two phases. Lane 2 for a brochure site is typically 3–5 phases (services, pages+blog, tools, guides, segments) plus the link pass.

### The autonomy protocol (plan §4) — include these rules

1. Work until the phase's exit criteria all pass; never ask permission for in-plan work.
2. One PR per phase: branch `phase/<id>` off latest main; create, watch, and merge the PR when green; a red build is always the session's own work. Lane 2 phases never wait for each other — only for lane 1.
3. Minor non-blocking issues → the phase's `docs/log/<phase>.md` "Known issues" section, keep building. Only still-open, cross-phase items get promoted to the root `KNOWN-ISSUES.md` by the link pass.
4. Stop and ask ONLY for: a missing credential with no graceful fallback, or a bad-foundation decision (schema/content shape, auth, money math, route contract) where guessing wrong forces a rewrite. Everything else: choose reasonably, record the choice in the phase log, continue. "Ask" means: append the question to `docs/decisions-needed.md`, commit, push, end the session. The watcher notifies Anton. Never wait in the session for an answer.
5. Missing env/config values never block: document in the example file, degrade gracefully.
6. Every phase prompt is re-runnable: check what exists on the branch first, continue from the first unmet exit criterion. Commit to the phase branch at least every 30 minutes of work (WIP commits are fine; the PR squash-merges).
7. Lane 2 hard limits: no foundation changes; workaround + Backlog note instead.
8. **Model cost guardrail** — Fable (`claude-fable-5` / Mythos-class) is NEVER used for build phases, subagents, spawned sessions, watchers or Routines. Phase tables only ever name Opus and Sonnet. If a session believes Fable is genuinely needed, it writes the reason to `docs/decisions-needed.md` and ends; spawning Fable without Anton's explicit approval is treated like a destructive action. Fable's only roles in this method are the planning conversation and the bounded reviews Anton opens himself (see "Supervision" below).
9. **File ownership** — a phase writes only to the paths in its prompt's `Owns` block, plus: its own `docs/log/<phase>.md`, a new `/* == <phase> == */` block appended at the end of the site CSS, its own new content/template/route/JS files, and the one line the link pass will need in `docs/decisions-needed.md` if it has a cross-cutting wish. On `git merge main` conflicts: main wins, re-apply your own change on top, re-run verify. Never edit a file outside your Owns block to resolve a conflict — if you cannot resolve it inside your files, log it in `docs/decisions-needed.md`, push the branch, and end (§4.4). Two phases that both need to change the same non-append-only line were mis-planned; the fix is in the plan, not in the session.
10. **Phase handoff / spawning** — a phase is done when four gates pass: PR merged green; exit checklist passed; pre-handoff audit done (ONE re-run of the verify script on main + ONE adversarial re-read of the merged diff, findings fixed in ONE follow-up commit, no second round); phase log committed. Then: **lane 1 phases** spawn the next lane 1 phase (`create_session`, inherit environment and permission mode, never `plan`, `model` set explicitly per the phase table, `prompt` exactly `Read prompts/<next-file>.md in this repo and execute it.`). **The last lane 1 phase** creates the watcher Routine (below), then spawns every lane 2 phase at once, up to 4 sessions concurrently (the watcher spawns the rest as slots free up). **Lane 2 phases** spawn nothing — they end with their phase report. **The link pass** is spawned by the watcher when every lane 2 PR is merged; it deletes the watcher Routine before its own closing report. Fallback when `create_session` is unavailable (local CLI): continue in the same window if the next phase uses the same model; stop and report at a model switch.
11. **Phase log**: before merging, write `docs/log/<phase>.md` — ≤ 12 lines under "Built", ≤ 8 under "Decisions", ≤ 8 under "Known issues", plus one line "Verification: verify green on <commit>, screenshots in PR CI artifact". Add the index line to plan §9. If the log runs longer, cut it; nobody reads a 40-line verification narrative.
12. **Orientation read** — a fresh session reads: the prompt file, plan §1 and §4, its own plan section(s), the phase table, plan §9's index, and the `docs/log/<phase>.md` of the phases in its `Depends on` list. Not the whole plan, not every log, not the whole KNOWN-ISSUES. Reading more costs context, not dollars — and stale history is what makes sessions re-litigate settled decisions.
13. **Polish cap** — per phase: ONE screenshot pass (≤ 5 pages × 2 widths, after the last code change), ONE Lighthouse run and only if the phase's exit criteria name a number, ONE scripted interaction pass and only for phases that ship JS behaviour (save the script under `tests/` so later phases re-run instead of re-derive), verify script runs unlimited while fixing but only the final green run is reported. Screenshots are NOT re-taken after a routine merge of main unless the merge changed a page you screenshotted. The PR body is written once when the PR opens (≤ 25 lines, the CI screenshot artifact link instead of embedded images) and edited only to fix a wrong link. When every exit criterion passes, open the PR in that same turn; improvement ideas found afterwards go to the Backlog, not to commits. A 90-minute phase that is still polishing at minute 60 stops polishing.
14. **Screenshots live in CI, not git.** `docs/screenshots/` is git-ignored. The CI screenshot job captures the pages the PR changed (derived from the diff, plus `/`) and uploads them as a PR artifact. Committed screenshots made the conthtml tree 97 % PNGs by size, and every later session paid to see them.
15. **Decisions travel by files, never by messages.** To change what a running phase will do, edit its prompt file on main (phases re-read their prompt from main before opening the PR and before merging, and follow the newer version). Never send a chat message to a running build session: the "do not merge yet" that arrived 16 minutes after the merge is the failure this rule prevents.

## Supervision: the watcher Routine, and Fable's role

**Rule: no session ever supervises a running build live — not Fable, not Opus, not Sonnet.** Supervision is a Routine, not a conversation.

The **watcher** is a `create_trigger` Routine created by the last lane 1 phase: `cron_expression` hourly (the platform minimum), `create_new_session_on_fire: true`, `model` Sonnet (current id from the `claude-api` skill), `prompt` exactly `Read prompts/_watcher.md in this repo and execute it.`, `source` the repo. Each firing is a fresh Sonnet session that: reads the phase table and `git`/PR state; for every lane 2 phase decides merged / running (branch has a commit < 90 min old) / stalled (branch older than that, PR not merged) / not started; re-spawns stalled phases (prompts are re-runnable) and starts not-started ones while fewer than 4 are running; merges a green PR whose session died before merging; spawns the link pass when every lane 2 PR is merged; reads `docs/decisions-needed.md` and, if it has unanswered entries, pushes a notification to Anton with the questions verbatim; ends within a few minutes. It never edits code, never answers a design question, never messages a running session, and disables itself after 10 firings with a notification if the build is still not done. Cost per firing: cents. It escalates to Anton, never to Fable — Fable cannot be spawned (§4.8), so any question a build needs Fable for reaches Fable only when Anton opens a Fable conversation and pastes it.

**Fable's role, as a rule, not a hope:** Fable appears in a build at most three times, each time in a conversation Anton starts himself, each time reading committed state once, writing decisions into files (plan.md, prompt files, `docs/decisions-needed.md` answers), and ending. (1) Stage 1–4 planning. (2) Optionally at the lane boundary — after lane 1 merges and before or while lane 2 runs — one read of the merged foundation, decisions pushed into the lane 2 / link-pass prompt files. (3) Optionally after the link pass, the post-build review. A Fable session never waits for a build session to finish, never polls PR or session state more than once, never sends a message to a running session, and never holds an open question ("should I revert?") for longer than it takes to write it down for Anton and end. If a Fable session notices it has checked on a build twice, it stops and writes the rule it was about to enforce into the prompt files instead. The two conthtml "Fable lead" sessions did the opposite of all of this and were the single largest cost of the build.

## Stage 3 — Write the prompt files

One file per phase in `prompts/`, named `<lane>-<n>-<slug>.md` (e.g. `opus-1-foundation.md`, `sonnet-3-tools.md`, `sonnet-9-link-pass.md`), plus `prompts/_handoff.md` (the gates and spawn call) and `prompts/_watcher.md`. Keep each under ~35 lines — the detail lives in plan.md; the prompt points at sections. Skeleton:

```markdown
# Phase <ID> — <name>. <MODEL> session. Lane <1|2>[, runs in parallel with <ids>].

Read ONLY: this file, `plan.md` §1, §4, §<own sections>, the phase table and §9 index,
and `docs/log/<dep>.md` for each phase in Depends on: <ids>. Do not read the rest.
Execute under the autonomy protocol §4. Build nothing outside the plan.

Owns (the only paths you may create or modify, plus the §4.9 append-only exceptions):
- content/<file>.php, templates/<file>.php, <route-dir>/**, assets/js/<dir>/**, docs/log/<id>.md

[Lane 2: repeat the hard limits here explicitly.]

Budget: one session, ≤ 90 min. When the exit criteria pass, open the PR that turn (§4.13).

Phase rules:
- Branch `phase/<id>` off latest main. WIP commit every 30 min.
- Load these skills at the matching step: <list, per phase content>.
- <3–6 phase-specific bullets: the traps, the quality bars, what NOT to spend effort on>.
- Same-shaped units (N ≥ 4 pages/articles/guides): build the template + one exemplar first, then fan out
  the rest as parallel Sonnet subagents per `fable-directs-sonnet-builds` §Fan-out; one verify, one PR.
- Re-runnable; minor issues → docs/log/<id>.md; stop only per §4.4.

Exit: <concrete, checkable criteria — verify green, named checks, PR merged>. Screenshots: CI artifact.

## After this phase
Follow `prompts/_handoff.md`. [Lane 1: Next: `prompts/<file>.md`, model <Opus|Sonnet>.]
[Last lane 1 phase: create the watcher, then spawn ALL lane 2 phases: <list>.] [Lane 2: spawn nothing.]
[Link pass: delete the watcher Routine, then STOP with the closing report.]
```

Prompts must name the exit bar concretely. "Works" is not checkable; "14 service URLs render full copy, FAQ JSON-LD validates, verify green" is.

## Stage 4 — Hand back to the user

Tell the user:
1. Merge the plan PR first, so phase 1 branches from a main that contains the plan.
2. What to paste and where: fresh window, phase 1's model, permission mode set to auto-accept (spawned children can never be MORE permissive than their parent — a restrictive phase-1 session strands every later phase at permission prompts).
3. The single line to paste: `Read prompts/<phase-1-file>.md in this repo and execute it.`
4. Recovery rule: the watcher restarts stalled phases by itself. If the watcher itself is gone, re-paste any phase's prompt in a fresh window — it resumes from the first unmet criterion. Find the state in plan §9 and `docs/decisions-needed.md`.
5. The human-inputs checklist (§7) and when each item is first needed. Anything that needs a human network step (e.g. downloading generated images past a CDN the sandbox cannot reach) is a §7 item with a manual step, never a phase: the conthtml imagery import was attempted twice against a known 403 and finished neither time.
6. Where Fable comes back in, if at all (the two optional review points above), and that each is a session Anton opens and closes.

## Template profile: HTML+PHP brochure site from conthtml

Use when the next site is a local-business brochure / tools / blog site on shared PHP hosting (Paraguayan or Swedish local business, contador.com.py's shape). The template is `antonmarklundcom/conthtml` at its latest main; `docs/template-reuse.md` in that repo is the executable checklist. What it contains that is generic: `lib/` (bootstrap, helpers, seo/JSON-LD), all `partials/`, `templates/` (service, article, tool, page-stub), the design-system CSS with a tokens block, `enviar.php` + `config.example.php` (lead form → VenderCRM, Resend, log fallback), `router.php` + `.htaccess` + `sitemap.php`, `verify.sh`, `deploy/` (zip, CSS minify, font subset, image optimize, live verify), `tests/screenshots.mjs`, CI, `prompts/_handoff.md`, and every `content/*.php` file's key shape.

Phases for a template start (replaces lane 1 entirely; A1 and A2 are never rebuilt):

| Phase | Lane | Model | What |
|---|---|---|---|
| T0 Adopt | 1 | Sonnet | Fork conthtml, run `docs/template-reuse.md`: delete the old content values, routes, blog, tools, logs, screenshots; rename brand/site facts, title suffix, zip name; swap the tokens block to the new design canvas' style guide; verify green with stub pages; PR. ≤ 1 h. |
| T1 Home | 1 | Opus if the design canvas is a new layout, Sonnet if it reuses conthtml's homepage layout with new tokens/copy | Homepage + hub from the design canvas, using the existing partials. Creates the watcher, spawns lane 2. |
| Lane 2 | 2 | Sonnet, parallel | Services, secondary pages + blog, tools, guides/segments — each owning its content file, template, route dirs, JS dir. |
| Link pass | — | Sonnet | Cross-links, nav additions, KNOWN-ISSUES promotion, closing report. |

Expected cost: T0 $5–8, T1 $10–15, lane 2 $8–12 per phase in parallel, link pass ~$3 → $45–60; wall-clock ~1 h + ~1 h + ~1.5 h + ~0.5 h ≈ 4 h. Market swaps live in named places: `assets/js/py.js` + `lib/helpers.php` (RUC/Gs formatting → org.nr/SEK), `content/laboral.php` / `content/vencimientos.php` (PY labour and DNIT tables — delete for a non-PY site), and the market skill loaded in prompts (`paraguay-business-apps` ↔ `sweden-business-apps`).

## After the build

When the project is live and stable, prompt the user to create a project-specific skill (like `propia-dev`) capturing final schema, routes, known issues, and do-not-touch guardrails — this skill covers the build method; project skills carry the specifics. Any skill written or edited for Anton (this one included) must keep its frontmatter `description` under 1024 characters and pass `skill-creator/scripts/quick_validate.py` before it is handed over as a zip — claude.ai rejects the upload otherwise. If the build blew the budget above, add the reason to this skill's "Budget" section so the next plan avoids it.
