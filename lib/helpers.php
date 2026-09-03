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
 * A UI string from content/ui.php. Dot notation reaches into nested groups:
 * ui('form.submit').
 */
function ui(string $key, string $default = ''): string
{
    $value = content('ui');
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
function whatsapp_link(?string $text = null): ?string
{
    $number = phone_digits(site('whatsapp'));
    if ($number === '') {
        return null;
    }

    $link = 'https://wa.me/' . $number;
    if ($text !== null && $text !== '') {
        $link .= '?text=' . rawurlencode($text);
    }

    return $link;
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
