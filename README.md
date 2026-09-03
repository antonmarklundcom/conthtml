# conthtml — contador.com.py rebuild (HTML + PHP)

Static HTML + PHP site for contador.com.py, design direction **1B "Firma moderna"**,
hosted on Hostinger shared hosting.

Plain PHP 8 used as a templating layer: no framework, no build step, no database,
no Node at runtime. `npm` appears only inside `tests/` for the Playwright
screenshots, and the site never depends on it.

Start here: `plan.md`. Phases run from `prompts/`. Reference inputs in `docs/`.

## Preview locally

```sh
php -S localhost:8080 router.php
```

`router.php` exists only for the built-in server — Apache never sees it. It
mirrors every routing rule in `.htaccess` (410s for the dead WordPress URLs, the
`?page_id=3` redirect, `sitemap.xml`, trailing-slash enforcement, the denied
directories, the 404 document), so what you see locally is what production does.

Nothing needs configuring: with no `config.php` the site renders and the lead
form still accepts submissions in degraded mode.

## Verify

```sh
./verify.sh                       # the repository
./verify.sh --root dist/<name>    # an unzipped deploy artifact
```

Runs `php -l` over every PHP file, checks the PHP helpers, boots `php -S`, asserts
the status of every URL in the route contract (all 21 URLs from the live-site scan
plus everything the content arrays define), fails on any PHP warning, checks that
every page has a unique non-empty title and description with the title under 60
characters, and exercises `enviar.php` in degraded mode. GitHub Actions runs the
same script on every PR, then rebuilds the deploy zip and runs it again against
the unzipped artifact.

Screenshots for a PR body:

```sh
cd tests && npm ci
node screenshots.mjs --phase a1 --base http://127.0.0.1:8080 / /servicios/ /contacto/
```

It also fails if any page scrolls horizontally.

## Deploy to Hostinger

Shared hosting, PHP 8.2, no Node, no database.

```sh
./deploy/make-zip.sh       # → dist/contador-YYYY-MM-DD.zip
```

The zip holds exactly what belongs in `public_html/` — no `docs/`, `prompts/`,
`tests/`, `deploy/`, git metadata, `config.php` or logs.

1. hPanel → **File Manager** → open `public_html/` and upload the zip, then
   *Extract*. (Or use hPanel's **Git** deploy pointed at this repository; the
   excluded directories are harmless there, `.htaccess` already denies them.)
2. Copy `config.example.php` to `config.php` **on the server** and fill it in.
   `config.php` is gitignored and must never be committed.
3. Make sure `logs/` exists and is writable (the zip creates it, with its own
   `.htaccess` denying web access). The lead handler writes there.
4. hPanel → **PHP Configuration** → PHP **8.2**, with `curl` enabled.
5. Check `https://<domain>/` and `https://<domain>/sitemap.xml`, then submit a
   test lead and confirm it reaches VenderCRM → **Contactos**.

`config.php` values, all optional:

| Key | Effect when empty |
|---|---|
| `SITE_URL` | canonical/OG URLs fall back to the request host |
| `VENDERCRM_URL`, `VENDERCRM_API_KEY` | the lead form runs in degraded mode: submissions are appended to `logs/leads.log`, the visitor still gets a success state |
| `GA4_ID`, `ADS_ID` | `assets/js/analytics.js` is a silent no-op |

## Content model

No database. Every piece of content is a PHP array under `content/`, loaded once
per request by `content('<name>')` and reached through the helpers in
`lib/helpers.php`. Identifiers are English; slugs and copy are Spanish.

| File | Holds |
|---|---|
| `content/site.php` | firm facts: name, phone, whatsapp, email, address, hours, matrícula, foundedYear, teamSize, socials, stats, testimonials, team, credentials |
| `content/services.php` | the 14 service pages, keyed by slug |
| `content/pages.php` | the static pages, keyed by path |
| `content/nav.php` | header and footer link trees, derived from the two above |
| `content/ui.php` | every UI string (the single-locale i18n layer) and the cluster labels |
| `content/precios.php` | pricing plans |
| `content/blog.php` | the article index (bodies live in `/blog/<slug>/index.php`) |

### `content/services.php`

The shape below is the contract later phases consume. **B-phases fill the empty
keys and may add optional ones, but never rename or remove a key**, and never
change a `path` — the legacy URLs are frozen for SEO (plan §1.2).

```php
'marangatu' => [
    'path'            => '/marangatu/',        // frozen; trailing slash
    'title'           => 'Marangatu',          // the legacy H1 label
    'navLabel'        => 'Marangatu',          // mega-menu and footer
    'cluster'         => 'digital',            // key into ui('clusters')
    'parent'          => null,                 // sub-hub slug, for breadcrumbs
    'seoTitle'        => '…',                  // ≤ 42 chars (suffix takes 18)
    'metaDescription' => '…',                  // 120–155 chars, unique site-wide
    'hero'     => ['eyebrow' => '', 'h1' => '', 'h2' => '', 'lead' => ''],
    'includes' => [],                          // "Qué incluye" checklist
    'excludes' => [],                          // "Qué no incluye" checklist (optional, B1)
    'weNeed'   => [],                          // "Qué necesitamos de usted" checklist (optional, B1)
    'sections' => [],                          // [['h2', 'body' => [...], 'items' => [...]]]
    'benefits' => [],                          // [['title', 'text']]
    'faq'      => [],                          // [['q', 'a']] → FAQPage JSON-LD
    'cta'      => ['label' => '', 'whatsappText' => ''],
    'related'  => ['iva', 'ire-simple', 'ekuatia'],
],
```

Each `/<slug>/index.php` is three lines — set `$slug`, require
`templates/service.php` — and every block of that template renders only when its
data exists, so a half-filled record still produces a coherent page.

### `content/pages.php`

Static pages keyed by path, with `title`, `description`, `h1`, `lead`, sitemap
hints, and `stub`. While `stub` is `true` the page renders through
`templates/page-stub.php`, is marked `noindex` and is left out of `sitemap.xml`;
the phase that writes the page sets it to `false`.

### Adding things

Navigation is data, not markup (plan §4.13). `partials/header.php` and
`partials/footer.php` render whatever `content/nav.php` returns, and empty lists
render nothing — so a B-phase adds a tool, a legal page or an article by
extending the content arrays, never by editing the partials. `sitemap.xml`,
`verify.sh`'s URL list and the footer all follow automatically.

### Two things to know before editing a partial

A PHP `include` shares the scope of whatever required it, so every local in a
partial is prefixed (`$navService`, `$gridSlug`, `$bcCrumb`). An unprefixed loop
variable will silently overwrite the caller's.

All output goes through `e()`. Money uses `fmt_gs()` (whole guaraníes, dots for
thousands); tax ids use `validate_ruc()`, with the same two functions available
to the browser as `PY.fmtGs()` and `PY.validateRuc()` in `assets/js/py.js`.

## Layout of the repository

```
index.php  404.php  enviar.php  sitemap.php  robots.txt   the site's entry points
router.php  .htaccess                                     routing (kept in sync)
<slug>/index.php                                          one directory per route
assets/{css,js,fonts,img}                                 one CSS file, vanilla JS
content/                                                  all content, as arrays
lib/{bootstrap,helpers,seo}.php                           config, helpers, metadata
partials/                                                 header, footer, form, …
templates/{service,page-stub}.php                         page shells
deploy/{make-zip.sh,routes.php}                           deploy artifact, route contract
tests/                                                    Playwright screenshots only
docs/                                                     scan, keyword research, canvas
```
