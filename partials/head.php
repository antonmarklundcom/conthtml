<?php
/**
 * Opens the document: <head> metadata, JSON-LD, font preloads and the skip
 * link. Every page requires this after setting $page (see lib/seo.php for the
 * keys it understands), then partials/header.php.
 *
 * Locked for B-phases (plan §4.7).
 */

declare(strict_types=1);

/** @var array $page */
$page        = $page ?? [];
$currentPath = $page['path'] ?? '/';
$ga4         = cfg('GA4_ID', '');
?>
<!doctype html>
<html lang="es-PY">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(seo_title($page)) ?></title>
<?php if (!empty($page['description'])): ?>
<meta name="description" content="<?= e($page['description']) ?>">
<?php endif; ?>
<link rel="canonical" href="<?= e(seo_canonical($page)) ?>">
<?php if (!empty($page['noindex'])): ?>
<meta name="robots" content="noindex, follow">
<?php endif; ?>

<meta property="og:type" content="<?= e($page['ogType'] ?? 'website') ?>">
<meta property="og:site_name" content="<?= e(site('name')) ?>">
<meta property="og:locale" content="es_PY">
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
</head>
<body data-ga4="<?= e($ga4 ?? '') ?>">
<a class="skip-link" href="#main"><?= e(ui('nav.skip')) ?></a>
