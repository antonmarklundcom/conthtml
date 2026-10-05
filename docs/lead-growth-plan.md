# Paraguay accounting lead growth — execution plan

Repository: `antonmarklundcom/conthtml`. PR #33 is merged into `main` at `3f73d8c`. The growth pass is on `improve/accounting-lead-growth`, based on that tested revision, for a separate reviewable PR. Keep all 69 SEO pages, indexed URLs, titles, descriptions, H1s on existing service pages, redirects, canonicals and internal links.

The reported 403 did not reproduce on HTTPS home/contact/sitemap, www, HTTP redirect or a mobile browser check. The live site showed the completed first pass while main was still at the earlier commit, indicating branch/manual deployment. Main now contains that first pass. No Hostinger credentials are available in this task; the hosting Git configuration must use this repository's `main` branch. A 403 on another path needs its exact URL to diagnose.

## What the audit found

- The first improvement pass shortened the homepage, improved service discovery and form recovery, fixed the no-JS menu, preserved SEO, and raised local mobile performance from 94 to 99.
- A service hero sends the quote button to generic `/contacto/`, losing the selected service. Its correctly tagged form is far below the first screen.
- The pricing cards do not carry the selected plan into the enquiry.
- Analytics pushes plain objects into `dataLayer` even though the site uses `gtag.js`, and counts a WhatsApp menu opener as a chat click. These are weak signals for judging acquisition performance.
- The initial consultation and written proposal are already described as free on `/precios/`; that offer can be more visible without inventing a price or discount.
- Service pages lack a separate `Service` entity linked to the accounting firm. The homepage can answer buying questions with visible FAQ content and matching structured data.
- The fallback handler currently reports success even if it cannot store a lead. Accept only when the CRM, local log or notification email actually accepts it.

## Implement now

1. Put a short, service-specific quote form in each service hero and keep the longer page content and lower form. Use direct WhatsApp actions for visitors already reading a service.
2. Carry validated service/plan selections into `/contacto/`, the WhatsApp message and CRM enquiry. Keep canonical URLs free of query parameters. Explain what determines the quote; publish no invented prices, deadline guarantees or credentials.
3. Make the free initial consultation and written scope visible on the homepage. Add buyer FAQs covering fees, documents, changing accountants and service selection. Tighten the mobile persona links.
4. Add truthful Service structured data for the 14 service pages and matching FAQ data on home. Preserve existing schema types and SEO signals; permit only those documented additions in the regression check.
5. Send configured analytics events through the gtag event API. Separate opening a menu from a click that navigates to WhatsApp. Verify lead events with synthetic data; include no names, phone numbers or emails in analytics.
6. Preserve retry details when all delivery channels fail; test this fault locally. Keep successful CRM delivery successful even if the local log is unavailable.
7. Test responsive and no-JS journeys, service/plan routing, tracking and schema. Rebuild/extract the ZIP, measure local mobile performance, create a matched desktop/mobile comparison, and create the growth PR.

The initial mobile audit exposed a pricing-page layout shift (CLS 0.903) while the deferred navigation collapsed the no-JS header. Navigation now initializes inline directly after the header, before main content can paint, preserving the no-JS flow. The new white hero form explicitly resets inherited dark-band text and button colors; the contact hero image is loaded eagerly as an above-the-fold asset.

## Next growth work requiring business/account access

- Confirm accountant identity/matrícula, address or remote coverage, hours, real reviews and consultation response time. Add real proof and Google Business Profile details once verified.
- Use Search Console queries and GA4/CRM outcomes to prioritize accounting retainers, EAS/RUC openings and suitable company segments. These are opportunity hypotheses, not measured keyword/ranking claims.
- Track qualified leads and won clients, not just form submissions or WhatsApp taps. Treat the existing tier values as bidding proxies, not actual revenue.
- Launch service-specific Search ads only after tracking and CRM delivery are verified in production, with an explicit ad budget. No ads or messages are sent in this task.
- Expand useful local/industry content only from genuine services, expertise and search evidence. Avoid cloned city pages or fabricated local offices.

## Imagery and budget

No new image is needed for these changes. Reuse the lightweight workflow illustration and existing legitimate assets. A Higgsfield tool is not callable in this cloud session; no substitute paid generation is authorized. Additional budget: 50 credits; spend: 0. Real staff/office photos are the useful future trust assets.

## Release

PR #33 is already merged. Review the growth PR diff and comparison, merge it into `main` when ready, then deploy `main` from `conthtml` (or its deploy ZIP) to Hostinger. Preserve the server's private `config.php` and logs. Use the production hostname in `SITE_URL`; verify HTTPS, public routes, sitemap, a controlled CRM/email lead, and Search Console indexing after deployment. Ranking and lead gains must be measured after release.

## Validation and preview (2026-10-05)

- Source and deploy-package verification: 83 routes, 69 unique page titles/descriptions, service/tool routing, ordinary POST, English section and internal-link mesh. The ZIP contains 237 files and excludes private config, lead logs, tests and docs.
- SEO baseline: all 69 page metadata records, 69 sitemap URLs and existing internal links preserved; only the documented home FAQ and 14 service entities are added.
- Browser integration: 12 checks, including 45 layouts over five viewport widths, keyboard navigation, mobile/desktop no-JS forms, duplicate retry, first-touch attribution, plan/service context, matching structured data, gtag command delivery and all-channel failure recovery. Uses isolated PHP and a local CRM stub, not production contacts or credentials.
- Final local Lighthouse mobile results: home 99 performance; monthly accounting, pricing and contact 98. All four score 100 accessibility, best practices and SEO, with CLS 0 and TBT 0 ms. Local results are comparisons, not field Core Web Vitals or ranking guarantees. Original homepage performance was 94 under the earlier local baseline run.
- Matched original/growth desktop and mobile screenshots and a standalone slider comparison are saved locally at `/workspace/scratch/contador-comparison/index.html`. Original revision: `a1ea6c2`; growth proposal includes merged PR #33 plus this pass. Full-page captures are ignored review artifacts under `docs/screenshots/lead-growth-final/`.
- HTTPS production home rechecked at 200 and still shows PR #33's shorter heading. The reported public-page 403 remains unreproduced; hosting Git settings and production credentials cannot be changed from this session.
- Remote Actions results for this growth head must be checked separately; local validation does not imply a GitHub CI pass.
