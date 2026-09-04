---
name: php-site-template
description: How to start and build any local-business website — brochure pages, calculators, how-to guides, blog, lead form to VenderCRM — from Anton's GitHub template antonmarklundcom/php-site-template (static HTML + PHP on Hostinger shared hosting, no database, Paraguay and Sweden market modules). Use this skill EVERY time Anton wants a new website for a local business or professional practice (contador, abogado, clínica, taller, byggfirma, redovisningsbyrå, tandläkare, any "sida för…" / "sitio para…"), says "new site", "brochure site", "HTML site", "PHP site", "from the template", "landing + calculators", or asks which template/stack a small business site should use. Also use it when editing any repo created from the template (it has lib/market/, content/lead-values.php and verify.sh). NOT for apps with logins, databases, listings, admin panels, SaaS or national brand sites — those use nodejs-mysql-hostinger-stack / nextjs-national-lead-gen.
---

# php-site-template — the starting point for every local-business site

Repo: `https://github.com/antonmarklundcom/php-site-template` (GitHub template repository).
It is the contador.com.py foundation with every client fact removed: templating layer, design
system with a tokens block, 15 partials, 7 templates (service, article, tool, guide, segment,
page, stub), lead handler → VenderCRM with email and log fallbacks, router + `.htaccess` +
sitemap, `verify.sh` build gate, deploy zip pipeline, CI with PR screenshots, and example
content so it renders green the moment it is cloned. Its README is the authoritative detail;
this skill says when and how to use it.

## Does the project fit?

Use the template when ALL of these hold:
- A local business or professional practice wants a marketing site: pages that sell services,
  maybe calculators/tools, guides, a blog, a contact/lead form. One language per site.
- No user accounts, no database, no admin panel, no listings, no payments.
- Hostinger shared hosting (PHP 8.2) or anything that serves PHP files.
- Market is Paraguay or Sweden (modules exist), or a third market that can be added as one
  `lib/market/<id>.php` + `assets/js/market/<id>.js` pair implementing the README's contract.

Do NOT use it for: directories/listings (propia, alquilar), SaaS or national brands
(`nextjs-national-lead-gen`), invoicing/CRM/admin apps (`nodejs-mysql-hostinger-stack` +
`sweden-business-apps` / `paraguay-business-apps`), scroll-film or diorama microsites
(`mobile-microsite`, `scroll-world`), or programs that are not websites. If a brochure site
later needs a portal or login, that is a separate Next.js app linked from the site, not a
change to the template.

## How a new site starts (the whole flow)

1. **Anton**: GitHub → php-site-template → *Use this template* → new repo named after the
   domain (e.g. `abogado-py`, `bygg-se`). Nothing else by hand.
2. **Fable planning chat** (one, Anton opens it): idea sketch + "phased build, HTML+PHP site".
   Fable follows `phased-autonomous-build` with its Template profile: no A1/A2 foundation phases;
   phases are **T0 Adopt** (Sonnet, ≤ 30 min, the README's 20 steps), **T1 Home** (Opus if the
   design canvas is a new layout, Sonnet if it reuses the template's), then lane 2 in parallel on
   Sonnet (services, pages + blog, tools, guides/segments), then the link pass. Fable writes
   `plan.md` + `prompts/`, opens the plan PR, ends.
3. **Anton**: merge the plan PR, paste `Read prompts/sonnet-0-adopt.md in this repo and execute it.`
   into a fresh Sonnet window on the new repo (permission mode auto-accept), walk away. The
   phases hand off to each other; the watcher Routine (`prompts/_watcher.md`) restarts stalls
   and notifies Anton. Budget for a whole site: ≤ $60 usage-equivalent, ≤ 4 h.

## Rules for any session working in a template-derived repo

- **Content is data.** Every page is a record in `content/<type>.php` plus a three-line route
  file. Never put copy in templates or partials. Key shapes in each file's header comment are a
  contract: fill values, add optional keys, never rename or remove one.
- **Locked files** (lane 2 / Sonnet phases never edit them): the `:root` tokens block of
  `assets/css/site.css`, `partials/header.php`, `partials/footer.php`, `lib/*`, the structure of
  every `templates/*.php`, `enviar.php`, `.htaccess`, `router.php`. New CSS goes in a
  `/* == <phase> == */` block at the end of the file. New partials and content keys are fine.
- **Every service and tool has a `content/lead-values.php` record** (tier, WhatsApp prefill
  naming the service, next step, CRM tag). `verify.sh` fails on a missing or dangling slug.
- **Market functions only.** Money, dates, tax-id validation and reference tables go through
  `fmt_money()`, `validate_tax_id()`, `market_table()` and `window.Market` — never hard-coded per
  site, so a calculator written once works in both markets.
- **No invented facts.** Unconfirmed business facts stay `null` in `content/site.php` and the
  partial hides; legal figures go into `docs/facts-to-verify.md` or read "consulte el monto
  vigente" / "kontrollera aktuellt belopp".
- **Includes share scope.** Prefix partial locals and `unset()` them on the way out; escape every
  value with `e()`. (Both bit conthtml.)
- **Gate before every PR:** `./verify.sh` green on the repo and on the unzipped
  `deploy/make-zip.sh` output. Screenshots come from the CI artifact, never committed.
- **Copy briefs transfer.** contador's service-page brief (fear → mechanism → service, proof by
  specificity, three checklists per page, "usted"/"ni" register, no superlatives) is the default
  for any professional-services site; the planning chat adapts it per vertical.

## Improving the template itself

Fixes that every future site should get (a partial bug, a verify check, a third market) go
into php-site-template through a normal PR, tested by `./verify.sh` with `market` set to each
module. Never fix it in one client repo and forget it. Client copy, tokens and fonts never go
back into the template.
