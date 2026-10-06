# Contador CRM activation

The application forwards forms through `enviar.php` to the tenant/site-scoped
VenderCRM endpoint. Browser code never receives the API key. Existing site
routing, first-touch attribution, service tiers and idempotency are preserved.
A successful fallback (`degraded: true`) means local storage or email accepted
the enquiry, not that a CRM contact/deal was created.

## Deploy from main

Merge the reviewed PR into **antonmarklundcom/conthtml → main**, then deploy
that branch to **contador.com.py → public_html**. The hover and 15 audit fixes
need no manual edits to configuration files. The separate CRM activation file
is ignored by Git and denied over HTTP by both Apache and the local router.

## Activate without editing existing config.php

A private activation ZIP has been prepared locally using only the supplied
contador site key. It is intentionally absent from the repository, PR and
public site deployment archive.

After deploying the code, upload that private ZIP to `public_html` using
Hostinger File Manager and extract it there. It contains exactly one file:
`config.crm.php`. It adds only the endpoint and site key; it preserves existing
email, canonical-domain and analytics settings in `config.php`. Remove the
uploaded ZIP after extraction. If `config.crm.php` already exists, preserve a
private backup before replacing it. Ordinary Git pulls preserve ignored local
configuration; re-upload the private file if hosting recreates the checkout.

Alternatively, install `VCRM_ENDPOINT` and `VCRM_SITE_KEY` as private server
environment variables through hosting settings. Secure hosting/SFTP access can
also be used to install the file directly. Do not paste keys into chat or put
them in HTML, JavaScript, screenshots, Git or public download links.

## Verify actual delivery

1. Confirm the home, contact, service pages and sitemap still load.
2. If SSH is available for a Git deployment, run `php deploy/crm-status.php`.
   It prints readiness booleans, never credentials. Its optional empty auth
   probe cannot establish successful lead delivery.
3. Submit a clearly labelled technical test with a phone number you control.
   Confirm the handler reports `ok: true, degraded: false`, then find the
   corresponding contact and pipeline deal in VenderCRM.
4. Replay the same original submission key and verify no second contact/deal.
   A new successfully completed enquiry must get a new submission key.
5. Test first-touch campaign attribution and service context in the resulting
   CRM record. If Google reporting is wanted, configure real GA4/Ads IDs
   separately; they are currently absent from the observed live page.

## Verification limitation in this workspace

The CRM destination `crm.clientes.com.py` is blocked by the current cloud
network policy. An additive cloud environment draft includes that host, but
saving a draft does not apply it to the running environment. Review/save/
publish the draft in environment settings before running a real round trip
from Codex. This cloud restriction does not establish whether Hostinger can
reach the CRM. No live CRM lead was created and the exported site's key has
not been authenticated here. Hosting credentials are not configured in this
workspace. Local mock-CRM tests are separate evidence, not production proof.
