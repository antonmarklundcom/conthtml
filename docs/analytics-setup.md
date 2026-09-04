# Analytics setup — GA4 → Google Ads, with lead value

What the site already sends, and the ten minutes of clicking in GA4 and Google
Ads that turns it into conversion bidding. Written for phase C1 (plan §5.3.5).

Nothing here needs a code change. The site pushes the events either way; this
document is about making Google listen to them.

---

## 1. What the site sends

`assets/js/analytics.js` pushes to `dataLayer` and is a **silent no-op until
`config.php` sets `GA4_ID`** — so none of this leaks or breaks before the tag
exists. `partials/head.php` loads `gtag.js` under the same condition.

| Event | When | Parameters |
|---|---|---|
| `lead_submit` | The lead form (or the vencimientos reminder) is accepted by `enviar.php` | `form_id`, `service`, `value_tier`, `value`, `currency`, `degraded` |
| `whatsapp_click` | Any `wa.me` link is clicked — header pill, floating button, each WhatsApp-menu option, CTA band, thank-you | `service`, `page_path`, `link_text` |
| `phone_click` | Any `tel:` link | `page_path`, `link_text` |
| `tool_used` | A calculator produces a result | `tool`, plus that tool's own inputs |

**`value` and `value_tier` come from the server, not the browser.** `enviar.php`
resolves them from `content/lead-values.php` and returns them in its JSON
response; `assets/js/lead-form.js` reports exactly what came back. So the value
Google bids on is always the value the CRM recorded — there is no second copy of
the tier logic to drift.

### The values

| Tier | `value` (PYG) | Sources |
|---|---|---|
| A | 1 000 000 | contabilidad, EAS, RUC, auditoría, the comparador |
| B | 400 000 | SIFEN/Ekuatia'i, IVA, IRE, nómina/IPS, asesoría, Marangatu |
| C | 100 000 | IRP, the calculators, vencimientos reminders, quiz "otro" |

These are **optimisation proxies, not revenue estimates** — they exist so smart
bidding prefers a retainer lead over a calculator lead by 10:1. The reasoning is
in `docs/lead-value.md`; the numbers are one edit in `content/lead-values.php`
and need no deploy of anything else.

---

## 2. Turn it on

### 2.1 `config.php` (on the server)

```php
'GA4_ID' => 'G-XXXXXXXXXX',
'ADS_ID' => 'AW-XXXXXXXXX',
```

Both are optional and independent. With neither set, nothing loads.

### 2.2 GA4: register the events as conversions

GA4 does not need custom code for these — `gtag.js` picks up `dataLayer` pushes
through the tag's own listener. What it needs is to be told they matter.

1. **Admin → Data display → Events**, wait for one real `lead_submit` to appear
   (submit the form yourself once; the site is live, so it will be within
   minutes), then toggle **Mark as key event**.
2. Do the same for `whatsapp_click`. It is the site's *other* primary
   conversion — plan §1.6 makes WhatsApp the main path, and on a Paraguayan
   site most people will use it instead of the form.
3. **Admin → Custom definitions → Create custom dimension** for each of
   `service` and `value_tier`, scope **Event**, event parameter with the same
   name. Without this the parameters are collected but never appear in a report.
4. **Admin → Custom definitions → Custom metrics** is *not* needed for `value`:
   GA4 reads `value` + `currency` as the event's monetary value automatically,
   which is the whole reason those two parameter names were chosen.

Set the property's currency to **PYG** (Admin → Property details) so the
reported totals are guaraníes, not dollars.

### 2.3 Google Ads: import them as conversion actions

1. **Tools → Data manager → Google Analytics 4** → import `lead_submit` and
   `whatsapp_click`.
2. For each imported action, open it and set:
   - **Value: Use the value from the GA4 event** (not "the same value for every
     conversion"). This is the point of the whole exercise — with a fixed value,
     tier A and tier C bid the same and the campaign optimises toward the
     cheapest lead, which is the least valuable one.
   - **Count: One** for `lead_submit`; **One** for `whatsapp_click` too, so a
     visitor who taps WhatsApp three times is one conversion.
   - **Primary action** for `lead_submit`. Keep `whatsapp_click` primary as
     well while WhatsApp is the main conversion path.
3. Bidding: start on **Maximise conversions** while volume is low; move to
   **Maximise conversion value** (or tROAS) once there are ~30 conversions in
   30 days, which is when the tiers start doing real work.

### 2.4 Verify before trusting it

- GA4 **Realtime → Event count by Event name** while you submit the form once:
  `lead_submit` should appear with `value` 1000000 on `/eas/` and 100000 on
  `/irp/`.
- Google Ads → the conversion action's **Status** must read "Recording
  conversions". "No recent conversions" after 24 hours means the import, not the
  site — check step 2.2.1 first.
- `logs/leads.log` on the server is the independent record: every accepted lead
  is there with its `fields.valor`, whether or not Google saw it.

---

## 3. Reading the leads without Google

`enviar.php` appends every accepted lead to `logs/leads.log` (JSON, one object
per line) even when the CRM took it. To turn that into a spreadsheet:

```bash
# download logs/leads.log from hPanel File Manager into the repo, then:
php deploy/leads-to-csv.php logs/leads.log > leads.csv
php deploy/leads-to-csv.php logs/leads.log --tier=A > tier-a.csv
```

The script is CLI-only and refuses to run over HTTP — the log holds the name and
phone number of everyone who ever filled in the form. `deploy/` is excluded from
the deploy zip and denied in `.htaccess`, so it is not on the server at all;
this runs against a downloaded copy.

Columns: timestamp, CRM outcome, tier, service, tag, name, phone, email,
company, need, message, tool result, page, source, plus any UTM parameters that
came with the lead.

---

## 4. What is deliberately not here

- **No cookie banner.** The site sets no cookies of its own; `gtag.js` does, and
  Paraguay has no consent-banner requirement equivalent to the EU's. If the firm
  starts advertising to EU visitors, this needs revisiting — noted in
  `KNOWN-ISSUES.md`.
- **No offline conversion import.** The honest measure of a lead is whether it
  became a client, which lives in VenderCRM, not on the site. Uploading
  won/lost outcomes back to Google Ads (via GCLID, which `enviar.php` already
  captures and forwards) is the natural next step once there is enough history
  to be worth it.
- **No per-conversion Ads labels in the code.** The GA4 import above covers both
  goals. A direct `gtag('event', 'conversion', {send_to: 'AW-…/label'})` call
  would need a label only whoever owns the Ads account can create; if that route
  is preferred later, it is one line next to each existing `track()` call.
