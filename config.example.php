<?php
/**
 * Default configuration. Copy to config.php on the server and fill in.
 *
 *   cp config.example.php config.php
 *
 * config.php is gitignored and never committed. Every value here is optional:
 * the site renders and the lead form still accepts submissions when they are
 * empty — see "degraded mode" in enviar.php.
 */

declare(strict_types=1);

return [
    // Absolute origin, no trailing slash. Used for canonical URLs, OG tags and
    // the sitemap. Falls back to the request host when empty.
    'SITE_URL' => '',

    // VenderCRM (Sitios → this site). Without both values the lead form runs in
    // degraded mode: submissions are appended to logs/leads.log and the visitor
    // still gets a success state pointing at WhatsApp.
    'VENDERCRM_URL'     => '',
    'VENDERCRM_API_KEY' => '',

    // Analytics. assets/js/analytics.js is a no-op until GA4_ID is set.
    'GA4_ID' => '',
    'ADS_ID' => '',
];
