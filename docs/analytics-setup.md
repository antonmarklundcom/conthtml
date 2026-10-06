# Analytics setup — measure enquiries and qualified clients

`assets/js/analytics.js` sends `gtag('event', name, parameters)` commands when
`GA4_ID` or `ADS_ID` is configured in the server's private `config.php`.
`partials/head.php` loads and configures the corresponding Google tag. With
neither ID, no analytics requests or event commands are sent.

## Events and their limits

| Event | Trigger | Parameters |
|---|---|---|
| `lead_submit` | `enviar.php` confirms that CRM, local storage or notification email accepted the enquiry | `form_id`, `service`, `value_tier`, `value`, `currency`, `degraded` |
| `whatsapp_menu_open` | The enhanced service chooser opens | `page_path` |
| `whatsapp_click` | A link actually opens WhatsApp, including a selected chooser option | `service`, `page_path`, `link_text` |
| `phone_click` | A telephone link is clicked | `page_path`, `link_text` |
| `tool_used` | A calculator produces a result | `tool` and calculator parameters |

Opening the chooser is not a chat click. A chat click does not prove a message
was sent or a client was won. Lead events include no name, phone or email.
The accepted form's tier/value comes from the PHP handler's published service
model, not a browser-supplied amount. A degraded acceptance needs the firm's
follow-up from its local record or notification rather than assuming a CRM deal.

| Tier | Proxy value (PYG) | Examples |
|---|---|---|
| A | 1,000,000 | Monthly accounting, EAS, RUC, audit |
| B | 400,000 | Ekuatia, IVA, IRE, payroll, advisory |
| C | 100,000 | IRP, calculators, reminders |

These are prioritisation proxies, not revenue or expected lifetime value.
See `content/lead-values.php` and `docs/lead-value.md` for the complete mapping.

## Configure and verify production

Set the real `GA4_ID` and/or `ADS_ID` in private server configuration. Use PYG
as the reporting currency if these proxy values are used. The task's browser
tests use mocked tags and a local CRM; they do not establish that production
credentials, Google imports or production CRM delivery are working.

1. Check a controlled enquiry with the firm's approval in GA4 Realtime/DebugView
   and the actual CRM or fallback record. The form must produce one accepted
   event; an error must produce none. Inspect `degraded` when troubleshooting.
2. Check that opening the generic homepage WhatsApp chooser produces only
   `whatsapp_menu_open`; selecting a service produces `whatsapp_click` with its
   service. A service page's direct link should produce one chat click.
3. Register `service`, `value_tier` and `degraded` as event-scoped custom
   dimensions where useful. Verify value/currency in the received event.
4. Mark `lead_submit` as a GA4 key event. Keep menu opens informational. Track
   WhatsApp taps as a secondary intent measure until qualified conversations
   can be measured reliably. Avoid counting a tap and its later enquiry as two
   acquired clients.
5. If importing into Google Ads, verify the conversion action, attribution,
   value settings and count setting in the actual account before bidding on it.
   Prefer qualified-lead/won-client outcomes as the primary bidding signal once
   those imports exist. An `ADS_ID` alone does not configure a conversion label.

## Growth measurement

Use Search Console landing pages/queries together with GA4 service and source
reports. Compare qualified enquiries and won clients in VenderCRM by service
and campaign. Keep the captured first-touch attribution with the enquiry;
import approved offline outcomes using GCLID when that process is configured.
Select ad budgets and bidding from measured volume and client economics.

The handler attempts to append accepted enquiries to private `logs/leads.log`.
CRM acceptance remains valid if that log fails; if all delivery channels fail,
the form retains the enquiry and shows recovery actions. A downloaded local log
can be exported with `php deploy/leads-to-csv.php logs/leads.log`; keep its
personal data private. No production enquiries or external account changes
were sent by the automated tests.
