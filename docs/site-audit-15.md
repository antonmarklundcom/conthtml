# Contador audit — contrast, CRM and 15 further improvements

Base: main after merged PR #35 (`ff02b6b`). The live SEO scan passes all 83 route checks, 69 page metadata records and 69 sitemap URLs. Keep those URLs, titles, descriptions, H1s, canonicals, redirects and links. No new business credentials, prices, reviews or response guarantees are assumed.

## Immediate fixes

The Services dropdown inherits the header's white hover text on its pale background. Fix hover, focus and current-page contrast for desktop and mobile, with a browser contrast check.

The uploaded endpoint reference provides a contador-only key for `https://crm.clientes.com.py/api/v1/leads`. The current live page has no CRM attribution script and no enabled Google tag. The PHP bridge exists, but live CRM delivery is unverified. Add compatible server environment/endpoint configuration, a private CRM-only override that preserves existing configuration, and a safe CLI diagnostic. Never commit the key. The CRM host is currently denied by the cloud egress proxy; an additive allowlist draft has been prepared. Activation on Hostinger also requires hosting access or a one-time private configuration upload; Git deployment alone cannot install secrets.

## Fifteen additional changes implemented

| # | Finding | Change and benefit |
|---|---|---|
| 1 | The full-screen mobile drawer covers the header's Close button. | Keep Close visible above the drawer so touch users can dismiss it. |
| 2 | Tab can escape the open mobile drawer into obscured page content. | Keep keyboard focus within the open drawer and its Close control. |
| 3 | Clicking a mobile navigation link leaves the scroll lock active until navigation completes. | Close the drawer and restore scrolling when a link is selected. |
| 4 | Long articles provide no section navigation. | Add a server-rendered contents list with stable section anchors. |
| 5 | Sticky-header offsets cover only section IDs. | Offset article headings, calculator results and lead forms too. |
| 6 | A stalled form fetch keeps the button disabled indefinitely. | Bound the request time, retain enquiry/key and show recovery. |
| 7 | The thank-you's WhatsApp service attribute stays at the form's initial context. | Update service context from the accepted server result. |
| 8 | Delivery-recovery WhatsApp links omit the enquiry the visitor just typed. | Prepare a recovery message from the current service/plan and entered details. |
| 9 | Server phone/email errors focus only the generic alert. | Identify the invalid field, describe its error and move focus there. |
| 10 | About uses unconfirmed credential fallback copy while the fact record is empty. | Gate professional credential claims on the verified fact record and use neutral values copy. |
| 11 | The contact hero's generated people image looks like an actual client/staff photo. | Label the image as illustrative and avoid identity claims in its alt text. |
| 12 | Fixed menus/forms make printed tools and guides hard to use. | Provide clean print styles and an enhanced print action on results/guides. |
| 13 | Calculator results appear without a consistent focus target. | Make result regions focusable and announce/bring the new answer into view. |
| 14 | Changing calculator inputs leaves an old result available to attach to an enquiry. | Hide stale results and clear only previously generated attachments. |
| 15 | No-JS visitors can submit calculator controls but receive no calculation. | Explain the requirement and provide useful guide/contact alternatives. |

Validate the shared changes across Spanish/English forms, hover/focus/current states, mobile keyboard/touch, no-JS routes, timed-out requests and calculator recalculation. Use isolated PHP/local mock CRM for regression tests. Production CRM acceptance and contact/deal deduplication require an allowed CRM destination and a controlled, clearly labelled test enquiry; report those separately from local tests.

The extra Higgsfield budget remains unused: no new image is needed. Future business growth work is verified accountant identity, real reviews/photos, GBP and Search Console/qualified-lead data. Those facts/account changes are not invented or published by this audit.

## Review and validation

- Before/after screenshots compare the current live PR #35 with proposed desktop hover, mobile menu, article body and calculator result states. The live main-service hover computes white on RGB(244,246,250); the fix computes RGB(15,27,45) on that same background.
- Repository and flat deployment archive pass PHP, routing, metadata and service-lead checks. The SEO contract preserves 83 route responses, 69 page records and 69 sitemap URLs without refreshing its baseline.
- Local mobile Lighthouse: Contact 97 performance; article 99 performance; both 100 accessibility, best practices and technical SEO, with CLS 0. These are local audits, not field rankings or production speed measurements.
- See [CRM activation](crm-activation.md) for the one-time private upload, unchanged production deployment target and the exact remaining live-verification prerequisite.

The private activation archive was validated in an isolated temporary directory: valid PHP, endpoint/key/curl ready, no outbound call. The real key never entered the working tree. A pipe handling defect in verify.sh was corrected so a passing service form no longer intermittently fails from SIGPIPE.

The final browser/form contract passes 21 scenario groups, including 45 layouts, eight desktop menu widths, mobile focus/touch/scroll, accepted and duplicate CRM responses, HTTP 401/403/422/429/500 fallback, complete endpoint support, private-file denial, payload bounds, stale quiz/calc cleanup, no-JS forms/tools and timed-out request recovery. All submissions used synthetic local test data and a local CRM stub.
