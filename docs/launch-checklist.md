# Launch checklist (B4, plan §6.4.4)

Numbered manual steps for Anton. Everything the site can do on its own is
already done — degraded gracefully where an input in plan §7 is still
missing. This is the list of things only a human with Hostinger, DNS, GA4 and
GBP access can do.

Each phase's PR carries a deployable zip recipe (`deploy/make-zip.sh`), so the
site has been previewable on the Hostinger staging subdomain since A1 — this
checklist is what turns that preview into the live, indexed site.

## 1. Content inputs still open (plan §7)

Nothing below blocks a technical launch — the site degrades honestly without
these — but filling them in switches on real functionality with no code
change (see each field's comment in `content/site.php` / `content/precios.php`):

- [x] ~~WhatsApp number~~ — confirmed 2026-09-04 (`+595 995 628 862`), merged
      into `content/site.php` alongside phone and `contacto@contador.com.py`.
      Every WhatsApp button, the header pill and the footer NAP are live.
- [ ] Street address, hours
- [ ] Firm legal name, matrícula number(s), founding year, team size
- [ ] Real stats/testimonials/credentials/team, or explicit confirmation
      there are none to publish
- [ ] Plan prices in ₲ for Emprendedor / Pyme / Empresa (`content/precios.php`
      → `priceGs`), or confirmation that "Cotización en 48 h" stays permanent
- [ ] Social profile URLs, or none
- [ ] `docs/facts-to-verify.md` — legal figures, rates and deadlines logged by
      B1–B3 that should get a primary-source check before launch (IRP tax
      brackets are the one page that currently states no figure at all
      because this build could not confidently source one)

## 2. Imagery (plan §6.4.1)

Nine images were generated via the Higgsfield MCP this phase but could not be
downloaded from this session (network policy — see
`docs/imagery-manifest.md` for the full explanation, job IDs and prompts).

- [ ] Follow `docs/imagery-manifest.md`'s "To finish" steps: download the 9
      PNGs, run `deploy/optimize-images.mjs`, apply the 4 code snippets
      listed there (fills `content/site.php`'s `photos`, adds the six
      service-card icon CSS rules, replaces `assets/img/og-default.png`)
- [ ] Re-run `./verify.sh` and re-check Lighthouse after (image weight
      affects the performance budget — plan §6.4.2's ≤ 120 KB hero rule)

## 3. VenderCRM and lead email (plan §1.6, §7)

- [ ] `config.php` → `VENDERCRM_URL` and `VENDERCRM_API_KEY`. Until both are
      set, `/enviar.php` logs leads to `logs/leads.log` and still shows the
      visitor a success state pointing at WhatsApp (`degraded: true` in the
      JSON response) — functional, but leads aren't reaching the CRM.
- [ ] `config.php` → `RESEND_API_KEY`, `LEAD_NOTIFY_TO` (e.g.
      `contacto@contador.com.py`), `LEAD_FROM` — optional, independent of
      VenderCRM: when both `RESEND_API_KEY` and `LEAD_NOTIFY_TO` are set,
      every accepted lead is also emailed. `LEAD_FROM`'s domain needs SPF +
      DKIM records in Hostinger DNS (Resend's dashboard shows the exact
      records once the sending domain is added there).

## 4. Analytics (plan §6.4.3)

- [ ] `config.php` → `GA4_ID` (e.g. `G-XXXXXXX`) and `ADS_ID` (e.g.
      `AW-XXXXXXX`), if Anton wants conversion tracking at launch. The gtag.js
      snippet in `partials/head.php` is a no-op — nothing loads or fires —
      until at least one of these is set. Events already wired end to end:
      `whatsapp_click`, `phone_click`, `lead_submit`, `tool_used`
      (`assets/js/analytics.js`, `lead-form.js`, `tools/tools-shared.js`).
- [ ] If Google Ads conversion actions (not just the base tag) are wanted,
      add the conversion label(s) — this build wires the base `gtag('config',
      ADS_ID)` call only; a specific conversion action ID/label per goal
      (e.g. WhatsApp click, lead submit) needs a decision only Anton or
      whoever owns the Ads account can make, then a one-line addition next to
      each `track()` call.

## 5. Hostinger deploy

- [ ] Create/confirm the Hostinger shared-hosting account and note the
      staging subdomain (e.g. `staging.contador.com.py` or a temp
      `*.hostingersite.com` URL) — plan §7 still lists this as pending
- [ ] `./deploy/make-zip.sh` → upload `dist/contador-<date>.zip` via hPanel
      File Manager (or use Git deploy — see README.md "Deploy to Hostinger")
      and extract into `public_html/` on the staging subdomain
- [ ] `cp config.example.php config.php` on the server, fill in the values
      from sections 3–4 above
- [ ] Set the PHP version to **8.2** in hPanel (Advanced → PHP Configuration)
- [ ] Visit the staging URL — header/footer/WhatsApp button/hero should match
      the screenshots in `docs/screenshots/*/`
- [ ] `./deploy/verify-live.sh https://<staging-url>` from your own machine —
      it curls every route and asserts the status plan §5.1.6 requires,
      confirms `.htaccess`-protected paths aren't publicly readable, and
      checks the sitemap/robots wiring

## 6. DNS cutover

- [ ] Point `contador.com.py`'s DNS (A/CNAME records) at the Hostinger
      account, or move the domain into Hostinger if it isn't already there
- [ ] Wait for DNS propagation, then confirm HTTPS is active (Hostinger's
      free SSL, auto-issued once DNS resolves to it)
- [ ] `./deploy/verify-live.sh https://contador.com.py` — same checks against
      the production domain, including the `/wp-sitemap.xml` → 301 redirect
      that keeps the old WordPress sitemap URL from 404ing for anyone who
      still has it bookmarked or indexed

## 7. Turn WordPress off

- [ ] Once the new site verifies clean on the production domain, disable or
      remove the WordPress installation (whichever hosting it was on) — do
      **not** leave both live at the same URL
- [ ] Confirm no leftover WordPress-only URLs (`/wp-admin/`, `/wp-json/`,
      `/wp-content/`) are still reachable on the new host after cutover

## 8. Search Console and sitemap resubmission

- [ ] Add/verify the production domain in Google Search Console if not
      already verified
- [ ] Submit `https://contador.com.py/sitemap.xml`
- [ ] Use the URL Inspection tool to request re-indexing of `/` and a couple
      of the highest-traffic legacy URLs (e.g. `/marangatu/`, `/iva/`)
- [ ] Watch the Coverage report over the following days for the legacy
      placeholder URLs (`/single-service/`, `/hello-world/`,
      `/category/uncategorized/`) — they should show as excluded (410/301),
      not as errors

## 9. Google Business Profile

- [ ] See `docs/gbp.md` for the NAP consistency check, category
      recommendation and post drafts
- [ ] Update the GBP website URL to `https://contador.com.py`
- [ ] Confirm the GBP-listed phone/address match `content/site.php` exactly
      once section 1's inputs are filled in

## 10. Final smoke test

- [ ] Submit the real contact form once on the live site and confirm the
      lead reaches VenderCRM (or `logs/leads.log`, if still in degraded mode)
- [ ] Click through all six `/herramientas/` calculators on a real phone
- [ ] Open the site in an incognito/private window and confirm GA4 Realtime
      shows the visit (if `GA4_ID` is set)
