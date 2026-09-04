<?php
/**
 * Opens the document: <head> metadata, JSON-LD, font preloads and the skip
 * link. Every page requires this after setting $page (see lib/seo.php for the
 * keys it understands), then partials/header.php.
 *
 * Locked for B-phases (plan §4.7), except the gtag.js block below: B4's
 * analytics config wiring is an explicitly named exception (plan §6.4.3,
 * prompts/sonnet-4-polish-launch.md) — nothing else in this file changed
 * until C5, which is a second named exception: an optional $page['lang']
 * (default 'es-PY', unchanged for every page that does not set it) and an
 * optional $page['hreflang'] => [locale => path, ...] that emits one
 * <link rel="alternate" hreflang="..."> per entry, read by the /en/ pages and
 * their Spanish counterparts (plan §6.8.1). No other page sets either key, so
 * every page that predates C5 renders byte-identical to before.
 */

declare(strict_types=1);

/** @var array $page */
$page        = $page ?? [];
$currentPath = $page['path'] ?? '/';
$ga4         = cfg('GA4_ID', '');
$ads         = cfg('ADS_ID', '');
$htmlLang    = $page['lang'] ?? 'es-PY';
?>
<!doctype html>
<html lang="<?= e($htmlLang) ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(seo_title($page)) ?></title>
<?php if (!empty($page['description'])): ?>
<meta name="description" content="<?= e($page['description']) ?>">
<?php endif; ?>
<link rel="canonical" href="<?= e(seo_canonical($page)) ?>">
<?php foreach ($page['hreflang'] ?? [] as $hrefLocale => $hrefPath): ?>
<link rel="alternate" hreflang="<?= e($hrefLocale) ?>" href="<?= e(url($hrefPath)) ?>">
<?php endforeach; ?>
<?php if (!empty($page['noindex'])): ?>
<meta name="robots" content="noindex, follow">
<?php endif; ?>

<meta property="og:type" content="<?= e($page['ogType'] ?? 'website') ?>">
<meta property="og:site_name" content="<?= e(site('name')) ?>">
<meta property="og:locale" content="<?= e($htmlLang === 'en' ? 'en_US' : 'es_PY') ?>">
<meta property="og:title" content="<?= e(seo_title($page)) ?>">
<?php if (!empty($page['description'])): ?>
<meta property="og:description" content="<?= e($page['description']) ?>">
<?php endif; ?>
<meta property="og:url" content="<?= e(seo_canonical($page)) ?>">
<meta property="og:image" content="<?= e(seo_og_image($page)) ?>">
<meta name="twitter:card" content="summary_large_image">

<meta name="theme-color" content="#0F1B2D">
<link rel="icon" href="<?= e(asset('/assets/img/favicon.svg')) ?>" type="image/svg+xml">

<link rel="preload" href="<?= e(asset('/assets/fonts/onest-latin.woff2')) ?>" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?= e(asset('/assets/fonts/bricolage-grotesque-latin.woff2')) ?>" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="<?= e(asset('/assets/css/site.css')) ?>">

<?php foreach (seo_jsonld($page) as $block): ?>
<script type="application/ld+json"><?= json_ld($block) ?></script>
<?php endforeach; ?>

<?php if ($ga4 !== '' || $ads !== ''): ?>
<!-- GA4 / Google Ads (plan §6.4.3). No-op until config.php sets GA4_ID/ADS_ID;
     assets/js/analytics.js's dataLayer.push() calls are inert until this
     snippet is present, so filling in the ids here is what turns them on. -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($ga4 !== '' ? $ga4 : $ads) ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  <?php if ($ga4 !== ''): ?>gtag('config', '<?= e($ga4) ?>');<?php endif; ?>
  <?php if ($ads !== ''): ?>gtag('config', '<?= e($ads) ?>');<?php endif; ?>
</script>
<?php endif; ?>
</head>
<body data-ga4="<?= e($ga4 ?? '') ?>">
<a class="skip-link" href="#main"><?= e(ui('nav.skip')) ?></a>
