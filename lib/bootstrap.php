<?php
/**
 * Loaded first by every page: `require __DIR__.'/../lib/bootstrap.php';`
 *
 * Defines ROOT_DIR, loads configuration (config.php if present, otherwise the
 * committed defaults) and pulls in the helper and SEO layers. Content arrays
 * are loaded lazily by content() the first time a page asks for them.
 */

declare(strict_types=1);

if (defined('ROOT_DIR')) {
    return;
}

define('ROOT_DIR', dirname(__DIR__));

/**
 * A configuration value, or $default when unset or blank.
 */
function cfg(string $key, ?string $default = null): ?string
{
    static $config = null;

    if ($config === null) {
        $defaults = require ROOT_DIR . '/config.example.php';
        $local    = is_file(ROOT_DIR . '/config.php') ? require ROOT_DIR . '/config.php' : [];
        $crmLocal = is_file(ROOT_DIR . '/config.crm.php') ? require ROOT_DIR . '/config.crm.php' : [];
        // A private CRM-only file can be installed without replacing config.php.
        $crmKeys = is_array($crmLocal) ? array_intersect_key($crmLocal, array_flip(['VENDERCRM_URL', 'VENDERCRM_API_KEY'])) : [];
        $config = array_merge($defaults, is_array($local) ? $local : [], $crmKeys);
    }

    $aliases = [
        'VENDERCRM_URL' => ['VENDERCRM_URL', 'VCRM_ENDPOINT'],
        'VENDERCRM_API_KEY' => ['VENDERCRM_API_KEY', 'VCRM_SITE_KEY'],
    ];
    foreach ($aliases[$key] ?? [$key] as $name) {
        $environment = getenv($name);
        if (is_string($environment) && trim($environment) !== '') {
            return trim($environment);
        }
    }

    $value = $config[$key] ?? '';

    return $value === '' ? $default : (string) $value;
}

/**
 * A content array from content/<name>.php, loaded once per request.
 *
 * The shape of each file is documented in README.md ("Content model"). B-phases
 * extend these arrays; they do not change the keys A1 defined.
 */
function content(string $name): array
{
    static $cache = [];

    if (!isset($cache[$name])) {
        $path = ROOT_DIR . '/content/' . $name . '.php';
        if (!is_file($path)) {
            throw new RuntimeException("Unknown content file: {$name}");
        }
        $cache[$name] = require $path;
    }

    return $cache[$name];
}

require_once ROOT_DIR . '/lib/helpers.php';
require_once ROOT_DIR . '/lib/seo.php';
