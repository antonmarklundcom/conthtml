<?php
/**
 * Escaping, URL and formatting helpers. Every value that reaches the page goes
 * through e().
 */

declare(strict_types=1);

/**
 * Escape for HTML text and attribute context.
 */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * The site origin without a trailing slash. Falls back to the current request
 * host so local preview and the staging subdomain work with no config.php.
 */
function site_origin(): string
{
    $configured = cfg('SITE_URL');
    if ($configured !== null) {
        return rtrim($configured, '/');
    }

    $https  = ($_SERVER['HTTPS'] ?? '') === 'on' || ($_SERVER['SERVER_PORT'] ?? '') === '443';
    $host   = $_SERVER['HTTP_HOST'] ?? 'contador.com.py';

    return ($https ? 'https://' : 'http://') . $host;
}

/**
 * Absolute URL for a site-root-relative path. Used for canonical, OG and the
 * sitemap; in-page links use the bare path.
 */
function url(string $path = '/'): string
{
    return site_origin() . '/' . ltrim($path, '/');
}

/**
 * Asset path with a cache-busting stamp taken from the file's mtime, so a
 * changed CSS or JS file is picked up without touching the filename.
 */
function asset(string $path): string
{
    $path = '/' . ltrim($path, '/');
    $file = ROOT_DIR . $path;

    return is_file($file) ? $path . '?v=' . filemtime($file) : $path;
}

/**
 * Firm facts from content/site.php. Values that Anton has not supplied yet are
 * null, and every partial hides rather than inventing a value.
 */
function site(?string $key = null)
{
    $site = content('site');

    return $key === null ? $site : ($site[$key] ?? null);
}

/**
 * A UI string from content/ui.php — or, on an /en/ page, from
 * content/ui.en.php. Dot notation reaches into nested groups: ui('form.submit').
 *
 * The one sanctioned additive touch to lib/* for phase C5 (plan §6.8.1,
 * prompts/sonnet-8-english-founders.md): a page opts into the English lookup
 * by defining the UI_LANG constant as 'en' before this is first called (the
 * /en/ route files do, right after bootstrap.php — see templates/en-page.php).
 * No Spanish page defines it, so every existing page's ui() call resolves
 * exactly as before this constant existed; nothing else in this function
 * changed. content/ui.en.php mirrors content/ui.php's keys, so a caller never
 * has to know which language is active.
 */
function ui(string $key, string $default = ''): string
{
    $value = content(defined('UI_LANG') && UI_LANG === 'en' ? 'ui.en' : 'ui');
    foreach (explode('.', $key) as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return $default;
        }
        $value = $value[$segment];
    }

    return is_string($value) ? $value : $default;
}

/**
 * All services keyed by slug, or one service record.
 */
function services(?string $slug = null): ?array
{
    $services = content('services');

    return $slug === null ? $services : ($services[$slug] ?? null);
}

/**
 * A static page record from content/pages.php, keyed by path.
 */
function page_meta(string $path): array
{
    return content('pages')[$path] ?? [];
}

/**
 * Cluster labels keyed by cluster id, in menu order.
 */
function clusters(): array
{
    return content('ui')['clusters'];
}

/**
 * The header/footer link trees from content/nav.php.
 */
function nav(?string $key = null)
{
    $nav = content('nav');

    return $key === null ? $nav : ($nav[$key] ?? []);
}

/**
 * Digits-only phone, suitable for wa.me and tel:.
 */
function phone_digits(?string $phone): string
{
    return preg_replace('/\D+/', '', (string) $phone) ?? '';
}

/**
 * wa.me deep link with a prefilled message, or null when no WhatsApp number is
 * configured yet. Callers fall back to /contacto/.
 */
function whatsapp_link(?string $text = null, ?string $sourcePage = null): ?string
{
    $number = phone_digits(site('whatsapp'));
    if ($number === '') {
        return null;
    }

    $link = 'https://wa.me/' . $number;
    $link .= '?text=' . rawurlencode(whatsapp_message($text, $sourcePage));

    return $link;
}

/** Keep the website and originating page on every chat, without campaign/PII query strings. */
function whatsapp_message(?string $text = null, ?string $sourcePage = null): string
{
    $source = $sourcePage ?? ($GLOBALS['page']['path'] ?? ($_SERVER['REQUEST_URI'] ?? '/'));
    $path = parse_url($source, PHP_URL_PATH);
    $path = is_string($path) && str_starts_with($path, '/') ? mb_substr($path, 0, 500) : '/';
    $path = preg_replace('/[\x00-\x1F\x7F]/', '', $path) ?? '/';
    $english = str_starts_with($path, '/en/') || (($GLOBALS['page']['lang'] ?? '') === 'en');
    $message = trim((string) $text);
    if ($message === '') {
        $message = $english ? 'Hello, I would like accounting advice for my business.' : 'Hola, quiero hablar con un contador sobre mi empresa.';
    }
    return $message . "\n\n" . ($english ? 'Website' : 'Web') . ': contador.com.py'
        . "\n" . ($english ? 'Page' : 'Página') . ': ' . $path;
}

/**
 * Where the primary "contact us" action points: WhatsApp when a number exists,
 * the contact page until then.
 */
function contact_link(?string $text = null): string
{
    return whatsapp_link($text) ?? '/contacto/';
}

/**
 * Guaraníes, es-PY style: whole numbers, dots for thousands. Never floats —
 * the guaraní has no usable decimal subdivision.
 */
function fmt_gs(int $amount): string
{
    return '₲ ' . number_format($amount, 0, ',', '.');
}

/**
 * Validate a Paraguayan RUC against its dígito verificador (DNIT modulo-11).
 *
 * Accepts "80012345-6" or "800123456". The check digit is the last character;
 * everything before it is the base number.
 */
function validate_ruc(string $ruc): bool
{
    $clean = preg_replace('/[^0-9]/', '', $ruc) ?? '';
    if (strlen($clean) < 2) {
        return false;
    }

    $base = substr($clean, 0, -1);
    $dv   = (int) substr($clean, -1);

    return ruc_check_digit($base) === $dv;
}

/**
 * The dígito verificador for a RUC base number.
 */
function ruc_check_digit(string $base): int
{
    $total = 0;
    $k     = 2;

    for ($i = strlen($base) - 1; $i >= 0; $i--) {
        $total += ((int) $base[$i]) * $k;
        $k++;
        if ($k > 11) {
            $k = 2;
        }
    }

    $remainder = $total % 11;

    return $remainder > 1 ? 11 - $remainder : 0;
}

/**
 * True when $path is the page currently being rendered — used for aria-current
 * in the nav.
 */
function is_current(string $path, string $currentPath): bool
{
    return rtrim($path, '/') === rtrim($currentPath, '/');
}

/* ------------------------------------------------------------------ leads --
   The lead value model (plan §5.3, docs/lead-value.md). content/lead-values.php
   is the single source for tiers, Ads conversion values, WhatsApp prefills and
   thank-you text; nothing below hardcodes any of them. */

/**
 * One resolved lead-value record for a service or tool slug, or the neutral
 * default when the slug is unknown (an article, a legal page, /nosotros/).
 *
 * Service and tool slugs share one namespace here — they do not collide, and a
 * caller that only knows "the page's slug" should not have to know which kind
 * of page it is looking at.
 */
function lead_value(?string $slug = null): array
{
    $model = content('lead-values');

    $record = $model['services'][$slug ?? ''] ?? $model['tools'][$slug ?? ''] ?? null;
    if ($record === null) {
        return $model['default'] + ['slug' => null];
    }

    return $record + ['slug' => $slug];
}

/**
 * The record a "¿Qué necesita?" chip maps to: a /contacto/ or homepage lead has
 * no service page behind it, so it takes the tier of its chip and borrows that
 * chip's service copy (docs/lead-value.md rule 1).
 */
function lead_value_for_need(string $need): array
{
    $model = content('lead-values');
    $chip  = $model['needs'][$need] ?? null;

    if ($chip === null) {
        return lead_value(null);
    }

    $record = $chip['service'] !== null ? lead_value($chip['service']) : $model['default'] + ['slug' => null];

    /* The chip's own tier and tag win — the chip is what the visitor told us. */
    return ['tier' => $chip['tier'], 'crmTag' => $chip['crmTag'], 'need' => $need] + $record;
}

/**
 * The Google Ads conversion value for a tier, in guaraníes. An optimisation
 * proxy, not a revenue estimate — see docs/lead-value.md.
 */
function lead_tier_value(string $tier): int
{
    return (int) (content('lead-values')['tierValues'][$tier] ?? 0);
}

/**
 * The human label for a `need` key: a form chip first, then the extra labels in
 * content/lead-values.php for needs with no chip of their own.
 */
function lead_need_label(string $need): string
{
    return ui('needs.' . $need)
        ?: (string) (content('lead-values')['needLabels'][$need] ?? $need);
}

/**
 * The lead source slug of the page being rendered, or null when it has none.
 *
 * A page may name itself with $page['leadSlug'] (templates/service.php,
 * templates/tool.php and templates/article.php do); otherwise its path is
 * matched against the service and tool records, so a route joins the model by
 * existing rather than by being registered twice.
 */
function current_lead_slug(?array $page = null): ?string
{
    $page = $page ?? ($GLOBALS['page'] ?? []);

    if (!empty($page['leadSlug'])) {
        return (string) $page['leadSlug'];
    }

    $path = rtrim((string) ($page['path'] ?? ''), '/');
    if ($path === '') {
        return null;
    }

    foreach ([services(), content('tools')] as $records) {
        foreach ($records as $slug => $record) {
            if (rtrim((string) ($record['path'] ?? ''), '/') === $path) {
                return (string) $slug;
            }
        }
    }

    return null;
}

/**
 * The wa.me prefill for the page being rendered (plan §5.3.8a). EVERY WhatsApp
 * link on the site goes through this — header pill, floating button, mobile
 * bar, homepage, hub, CTA band, tool CTAs — so a message always names the
 * service the visitor was reading about and never the button's own label.
 */
function whatsapp_text_for_page(?array $page = null): string
{
    return (string) lead_value(current_lead_slug($page))['whatsappText'];
}

/**
 * Five service groups. The current service keeps its precise prefill within
 * its group; all alternatives carry the page context through whatsapp_link().
 */
function whatsapp_menu(?array $page = null): array
{
    $model   = content('lead-values');
    $current = current_lead_slug($page);
    $language = defined('UI_LANG') && UI_LANG === 'en' ? 'en' : 'es';
    $slugs = array_merge($model['whatsappMenu'], ['other']);
    $needs = array_map(static fn (string $slug) => lead_value($slug)['need'], $model['whatsappMenu']);
    $currentRecord = lead_value($current);
    $currentNeed = $currentRecord['whatsappGroup'] ?? $currentRecord['need'];
    $records = array_merge($model['services'], $model['tools']);

    $options = [];
    foreach ($slugs as $slug) {
        $need = $slug === 'other' ? null : lead_value($slug)['need'];
        $isCurrent = $current !== null && ($need === $currentNeed || ($need === null && !in_array($currentNeed, $needs, true)));
        $text = $isCurrent ? whatsapp_text_for_page($page) : $model['whatsappMenuTexts'][$language][$slug];
        $members = [];
        foreach ($records as $memberSlug => $record) {
            $memberNeed = $record['whatsappGroup'] ?? $record['need'];
            if ($memberNeed === $need || ($need === null && !in_array($memberNeed, $needs, true))) {
                $members[] = $memberSlug;
            }
        }
        $options[] = [
            'slug'    => $isCurrent ? $current : ($slug === 'other' ? '' : $slug),
            'group'   => $slug,
            'members' => $members,
            'label'   => ui('whatsapp.groups.' . $slug . '.label'),
            'description' => ui('whatsapp.groups.' . $slug . '.description'),
            'link'    => whatsapp_link($text),
            'current' => $isCurrent,
        ];
    }

    return $options;
}

/**
 * The short human name a source goes by — in the WhatsApp menu and in the CRM's
 * `servicio` field. content/lead-values.php owns it, because the legacy page
 * titles are frozen for SEO and too terse to read as a menu option ("EAS",
 * "RUC", "IVA"); a service without one falls back to its navLabel.
 */
function lead_label(string $slug): string
{
    $record = lead_value($slug);
    if (!empty($record['menuLabel'])) {
        return (string) $record['menuLabel'];
    }

    $page = services($slug) ?? content('tools')[$slug] ?? null;

    return (string) ($page['navLabel'] ?? $page['title'] ?? $slug);
}

/** Only published plan keys can become enquiry context. */
function quote_plan(?string $key): ?array
{
    foreach (content('precios') as $plan) {
        if ($key !== null && ($plan['key'] ?? '') === $key) {
            return $plan;
        }
    }

    return null;
}

/** Carry a known service/plan into contact without changing its canonical. */
function quote_contact_path(?string $service = null, ?string $plan = null): string
{
    $query = [];
    $lead = lead_value($service);
    if ($lead['slug'] !== null) {
        $query['servicio'] = $lead['slug'];
    }
    if (($record = quote_plan($plan)) !== null) {
        $query['plan'] = $record['key'];
    }

    return '/contacto/' . ($query !== [] ? '?' . http_build_query($query) : '');
}

/** Accept either the documented endpoint or the historical CRM base URL. */
function crm_endpoint(): ?string
{
    $configured = cfg('VENDERCRM_URL');
    if ($configured === null) return null;
    $parts = parse_url($configured);
    if (!is_array($parts) || empty($parts['host']) || isset($parts['user']) || isset($parts['pass'])
        || isset($parts['query']) || isset($parts['fragment'])) return null;
    $scheme = strtolower($parts['scheme'] ?? '');
    $local = in_array(strtolower($parts['host']), ['localhost', '127.0.0.1', '[::1]'], true);
    if ($scheme !== 'https' && !($scheme === 'http' && $local)) return null;
    $url = rtrim($configured, '/');
    return str_ends_with($url, '/api/v1/leads') ? $url : $url . '/api/v1/leads';
}

function crm_base_url(): ?string
{
    $endpoint = crm_endpoint();
    return $endpoint !== null ? substr($endpoint, 0, -strlen('/api/v1/leads')) : null;
}

/** Normalize local Paraguay input; preserve explicit international numbers. */
function lead_phone(string $phone): string
{
    $digits = preg_replace('/\D+/', '', $phone) ?? '';
    if (str_starts_with(trim($phone), '+')) return '+' . $digits;
    if (str_starts_with($digits, '00')) return '+' . substr($digits, 2);
    if (str_starts_with($digits, '595') && strlen($digits) >= 11) return '+' . $digits;
    if (str_starts_with($digits, '0') && strlen($digits) >= 8 && strlen($digits) <= 10) return '+595' . substr($digits, 1);
    if (strlen($digits) === 9) return '+595' . $digits;
    return $phone;
}
