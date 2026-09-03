<?php
/**
 * sitemap.xml, generated from the content arrays. Served at /sitemap.xml by the
 * rewrite in .htaccess (and by router.php locally).
 *
 * Pages still marked 'stub' in content/pages.php are excluded: they are noindex
 * until the phase that owns them writes the content, and a sitemap should not
 * advertise a placeholder. Blog articles and tools appear automatically as B2
 * and B3 add them to content/blog.php and content/nav.php.
 */

declare(strict_types=1);

require __DIR__ . '/lib/bootstrap.php';

$today = date('Y-m-d');
$urls  = [];

foreach (content('pages') as $path => $meta) {
    if (!empty($meta['stub'])) {
        continue;
    }
    $urls[] = [
        'loc'        => url($path),
        'changefreq' => $meta['changefreq'] ?? 'monthly',
        'priority'   => $meta['priority'] ?? '0.5',
    ];
}

foreach (services() as $service) {
    $urls[] = [
        'loc'        => url($service['path']),
        'changefreq' => 'monthly',
        'priority'   => '0.8',
    ];
}

foreach (nav('tools') as $tool) {
    $urls[] = ['loc' => url($tool['path']), 'changefreq' => 'monthly', 'priority' => '0.7'];
}

foreach (content('blog') as $article) {
    $urls[] = [
        'loc'        => url('/blog/' . $article['slug'] . '/'),
        'lastmod'    => $article['updated'] ?? $article['date'] ?? null,
        'changefreq' => 'yearly',
        'priority'   => '0.6',
    ];
}

header('Content-Type: application/xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>', "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $url): ?>
  <url>
    <loc><?= e($url['loc']) ?></loc>
    <lastmod><?= e($url['lastmod'] ?? $today) ?></lastmod>
    <changefreq><?= e($url['changefreq']) ?></changefreq>
    <priority><?= e($url['priority']) ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
