---
name: fable-directs-sonnet-builds
description: Cost-efficient build workflow where a director session writes the spec and reviews, and Sonnet (or Opus) subagents do the bulk coding — including the fan-out pattern for same-shaped work (N service pages, N articles, N guides as parallel subagents inside one session, one verify, one PR). Use whenever the user asks to build a site, page, feature, or port/reskin of existing code and mentions saving Fable usage, "use sonnet/opus as subagent", "fable directs", "fan out", or when the task is a well-specifiable build of more than ~3 files; also used by phased-autonomous-build sessions (Opus/Sonnet directors) for their in-phase subagents. Fable writes the delta-spec, spawns the builder agent, then reviews and fixes the result itself.
---

# Fable directs, Sonnet builds

The division of labor that keeps quality while minimizing Fable token burn:
**the director does the two ends (spec + review), a cheaper model does the middle (bulk code).**

The director is Fable only in an interactive conversation Anton opened himself. Inside a
`phased-autonomous-build` phase the director is that phase's own Opus/Sonnet session — same
pattern, same rules, no Fable anywhere (see `fable-cost-guardrail`, which governs).

Proven result (2026-08-29, sitiosweb-hero): Sonnet one-shotted a full Vite+React+TS+Tailwind
port from a Fable-written delta-spec — ~81k Sonnet tokens, zero build errors, zero logic bugs.
The spec quality is WHY it went cleanly. Never skip the spec to save time.

## When to use which model

- **Sonnet subagent (default):** complete spec exists, or working reference code exists to
  copy/port/reskin. CRUD, forms, scaffolds, applying a styleguide, content units against an
  existing exemplar.
- **Opus subagent:** spec is ~80% complete and the builder must fill gaps sensibly
  (naming, minor API design), but nothing is genuinely ambiguous.
- **Director inline (no subagent):** tiny edits (a handoff costs more than the edit),
  genuinely ambiguous design work, debugging with misleading symptoms, or writing
  the spec/review itself.
- **NEVER set a subagent's model to Fable** without the user's explicit fresh "yes"
  in the current conversation (the `fable-cost-guardrail` skill governs).

## The workflow

1. **Write a delta-spec, not a full spec, whenever reference code exists.**
   Point the builder at exact file paths of working code ("copy, do not reinvent")
   and enumerate ONLY what changes: brand tokens, copy strings, media URLs, framework
   conversions. Pre-decide every value — a bracket like [ACCENT] left unfilled becomes
   the builder's guess.
2. **Spec must include a definition of done the agent can self-verify:**
   e.g. "run npm install and npm run build, fix errors until clean, do NOT start a
   dev server, report files + deviations". Builders that can't self-verify return
   broken work with confidence.
3. **Spawn with the Agent tool**, `model: "sonnet"` (or `"opus"`), background is fine.
   One agent per coherent build; don't shard one page across agents. Sharding ACROSS
   pages is the fan-out pattern below.
4. **Review on completion — never skip:**
   - Read the core logic files (not every file) for the classic gaps: unstated intent
     the spec implied but didn't spell out, z-index/opacity interactions, pointer-events
     on overlays, stale-state on scroll handlers.
   - Run it (preview_start via .claude/launch.json, or the repo's verify script) and check
     live: console errors, key interactions, key scroll phases. DOM inspection beats
     screenshots when the preview pane's compositor glitches on video-heavy fixed-position
     pages (known artifact: mid-scroll screenshots show only the body background —
     verify via getComputedStyle/element inspection before "fixing" anything).
   - One review round. Small findings are fixed inline; a second full review is polish.
5. **The director fixes small findings itself** (cheaper than a round-trip);
   sends the agent back via SendMessage only for large rework.

## Fan-out: same-shaped units as parallel subagents

Use when a phase has **N ≥ 4 units of the same shape** — service pages, blog articles,
how-to guides, segment landings, calculator FAQ blocks — each written into its own file or
its own array entry, against a content-file shape and a template that already exist.
Do NOT fan out when the units differ in logic (conthtml's six calculators were six bespoke
forms; one session building them in sequence was right), when a unit's decisions feed the
next unit's, or when N ≤ 3 (the spec costs more than the pages).

Mechanics:
1. **Exemplar first.** The director builds (or confirms) the template, the content-file
   shape, and ONE finished unit, and runs the verify script green on it. The exemplar is
   the spec: subagents copy its shape, register, length and structure.
2. **One file per unit.** Each subagent writes exactly one file it owns
   (`content/guias/<slug>.php` returning an array, `blog/<slug>/index.php`, …); the
   aggregator (`content/guias.php`) globs them. Never have N agents edit one array file —
   that is a merge race inside one session.
3. **Spawn 3–5 Sonnet subagents in parallel**, each with 2–4 units, via the Agent tool in
   one message. The subagent prompt contains: the exemplar's path, the shape contract (key
   list with one-line meanings), the copy brief verbatim, its slug list with per-slug
   inputs (keyword, legacy title, source section), the fact-discipline rule ("every legal
   figure into docs/facts-to-verify.md or write 'consulte el monto vigente'"), and the
   self-check ("php -l each file; curl each of your routes on the local php -S and check title length, description length and one H1; report deviations"). Only the director runs the full verify script.
   **Subagents do not read plan.md, the build logs or KNOWN-ISSUES** — the director already
   distilled what they need. That is where the saving is: N units × zero orientation reads.
4. **One verify, one screenshot pass, one PR.** The director runs the full verify script
   once after all subagents return, fixes shape drift itself (a missing key, an
   over-length title), and opens the phase's single PR. No per-unit PRs, no per-unit
   screenshots.
5. **Cost shape:** roughly the same tokens as writing the units sequentially, ~1/3 the
   wall-clock, and no per-unit session tax. Per unit, the work is commodity-priced Sonnet.

## Orientation rule for builder sessions

A builder session (a phase session, a subagent, or a director inside a phased build) reads
**only the plan sections it needs**: its prompt file, plan §1 (locked decisions), §4
(protocol), its own section(s), the phase table, and the logs of the phases it depends on.
Never "read plan.md in full". A full read of conthtml's plan + logs + known issues was ~27k
tokens per fresh session, paid ~10 times, and its main effect was sessions re-deciding
things earlier phases had settled. If a needed fact is missing from those sections, the
plan is wrong — note it in the phase log; do not go looking through history for it.

## Cost shape (for explaining to the user)

Director spec (~500–1500 words) + director review (~few file reads + one live check)
≈ a small fraction of the build. The builder's tokens are commodity-priced.
"Fable does the full build" only wins when the task is small or the ambiguity
IS the work. "Fable watches the build" never wins — see `phased-autonomous-build`
§Supervision.
