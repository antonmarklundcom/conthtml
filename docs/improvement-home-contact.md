# Homepage and contact improvement

Scope approved by Anton: inspect → plan → code → test → preview → PR, without merging or deploying. Preserve the existing SEO pages and URL structure.

## Evidence and baseline

`conthtml` is the PHP implementation; the separate `contador` repository contains planning documents. Anton supplied current live homepage text matching the baseline. After network access became available, fresh HTTPS/browser inspection confirmed the same homepage on mobile and desktop. The live SEO comparison passed for all 69 pages, sitemap membership, metadata, internal links and public route/redirect behavior. Hostinger denies `/config.example.php` with 403 while the local router returns 404; both protect the internal file. Live headers report PHP 8.3.33; CI verifies compatibility with PHP 8.2. The requested Windows-local generator file was unavailable; Anton subsequently authorized executing this tailored plan.

Before implementation, `./verify.sh` passed 83 route checks and metadata on 69 pages. `tests/fixtures/seo-contract.json` captures the original route statuses/redirect targets, titles, descriptions, canonicals, language alternates, indexability, H1s, schema types, sitemap membership and internal links.

## Selected changes

- Homepage: retain the navy/amber palette and fonts; shorten the hero; put WhatsApp beside service discovery; align the example report beside the promise. New H1: “Estudio contable en Asunción. Su empresa, en orden.” The lead still names contabilidad, impuestos, nómina, Marangatu and SIFEN.
- Service directory: show the same six groups and every existing primary/secondary service link in concise rows. Keep the service pages and their copy/metadata intact.
- Credibility: replace unverified portrait/team imagery on the homepage with an illustrative document workflow. Describe the process without inventing people, credentials, metrics or deadlines. Preserve `/nosotros/` and its existing H1/content.
- Mobile: use a compact timeline, tighter industry links, and optional form details. Preserve meaningful content and links in the DOM.
- Progressive enhancement: keep navigation in document flow until its drawer script is available. The previous no-JS mobile overlay covered the form button. Match font preload URLs to the CSS URLs to avoid downloading both fonts twice.
- Forms: name and phone first; mark optional fields; retain values and the submission key when delivery is uncertain; offer an accessible error and WhatsApp recovery. Keep Spanish/English forms, service tiers, tool results and no-JS POST behavior.
- Attribution: load the supported VenderCRM attribution script only for a configured HTTPS CRM origin. Prefer captured first-touch fields over a later campaign query. No credentials or new advertising tags in browser code.

## Boundaries and verification

No route removals, redirect changes, service/article/guide/tool rewrites, new framework, hosting migration or deployment. Titles, descriptions, canonicals, hreflang, robots directives and sitemap URLs must remain identical. Existing internal links must remain present. Homepage H1 may be tightened while retaining “estudio contable en Asunción”; all other H1s stay identical.

Validation:

- Existing verifier passes against source and the extracted deploy ZIP: PHP syntax, 83 route statuses, 69 unique metadata records, lead tiers/tool results, bilingual forms and internal-link mesh.
- SEO contract passes locally and against the current live baseline: all 69 pages and sitemap URLs retained; existing titles, descriptions, canonical paths, hreflang, robots directives, schema types, non-home H1s and crawlable internal links preserved.
- Eight browser checks pass: 40 page/viewport combinations at 360/390/768/1024/1440 px, keyboard menu/Escape, optional-field validation, localized recovery, lost-response idempotency, first-touch attribution, English routing, mobile/desktop no-JS POST and conditional attribution-script loading.
- Local Lighthouse 13.5 mobile audits: homepage performance 94 → 99; accessibility, best practices and SEO remain 100. LCP 2.9 → 2.1 s, CLS 0.004 → 0, TBT 0 ms. Contact page scores 98/100/100/100, LCP 2.3 s. These are local simulated lab measurements, not production field data or ranking predictions.
- Desktop/mobile live baseline and final local previews inspected. Screenshots and Lighthouse reports are ignored/outside-checkout review artifacts.

CRM delivery uses real PHP HTTP forwarding to a local mock endpoint with synthetic leads. The supported attribution script is stubbed to verify wiring and cookie handoff. Authenticated production CRM/email delivery was not exercised; no production leads were submitted. No merge or deployment is part of this change.

Higgsfield is unavailable in this task. Use lightweight HTML/CSS illustration; credits spent: 0 of the 50-credit cap.
