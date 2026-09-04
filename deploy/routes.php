<?php
/**
 * Prints the route contract as "<path><TAB><expected status>" lines, one per
 * URL. verify.sh consumes this, so later phases extend the smoke test simply by
 * adding content — a new service, article or tool appears here automatically.
 *
 *     php deploy/routes.php [site-root]
 *
 * The site root defaults to the repository root; verify.sh passes the unzipped
 * dist/ directory when checking the deploy artifact.
 *
 * The legacy list below is frozen: it is every URL in the live-site scan
 * (docs/reference/site-scan-2026-09-02.md §2) with the status plan §5.1.6
 * requires, which is what keeps the rebuild's SEO promises honest.
 */

declare(strict_types=1);

$root = $argv[1] ?? dirname(__DIR__);
require rtrim($root, '/') . '/lib/bootstrap.php';

$routes = [];

/* Static pages, including the ones still marked as stubs — they must respond
   200 even while their content belongs to a later phase. */
foreach (array_keys(content('pages')) as $path) {
    $routes[$path] = 200;
}

/* The 14 service pages. */
foreach (services() as $service) {
    $routes[$service['path']] = 200;
}

/* Tools (B3), guides (C2) and blog articles (B2) as they are added. */
foreach (nav('tools') as $tool) {
    $routes[$tool['path']] = 200;
}
foreach (nav('guias') as $guide) {
    $routes[$guide['path']] = 200;
}
foreach (content('blog') as $article) {
    $routes['/blog/' . $article['slug'] . '/'] = 200;
}

/* Segment landing pages (C3): the eight rubros plus /cambiar-de-contador/. */
foreach (content('segmentos') as $segmento) {
    $routes[$segmento['path']] = 200;
}

/* Non-page endpoints. */
$routes['/robots.txt'] = 200;
$routes['/sitemap.xml'] = 200;

/* Legacy URLs from the scan that must NOT come back as pages (plan §5.1.6). */
$routes['/single-service/']         = 410;
$routes['/hello-world/']            = 410;
$routes['/category/uncategorized/'] = 410;
$routes['/wp-sitemap.xml']          = 301;
$routes['/?page_id=3']              = 301;

/* A path that does not exist must be a 404, not a soft 200. */
$routes['/esta-pagina-no-existe/'] = 404;

/* Internals must never be readable over HTTP. */
foreach ([
    '/lib/helpers.php',
    '/content/site.php',
    '/partials/header.php',
    '/templates/service.php',
    '/config.example.php',
    '/logs/leads.log',
] as $path) {
    $routes[$path] = 404;
}

foreach ($routes as $path => $status) {
    echo $path, "\t", $status, "\n";
}
