<?php
/**
 * /herramientas/ — the hub for the six tools built in B3 (plan §6.3.1). Lists
 * every entry in content/tools.php as a card, in the same keyword-priority
 * order the content file defines. content/pages.php flips this page's 'stub'
 * to false, so it leaves the sitemap and gets indexed from this phase on.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/herramientas/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/herramientas/',
    'noindex'     => $meta['stub'],
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/herramientas/']],
];

$tools = content('tools');

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">

  <section class="page-hero">
    <div class="container">
      <?php require ROOT_DIR . '/partials/breadcrumbs.php'; ?>
      <div class="page-hero__inner">
        <h1><?= e($meta['h1']) ?></h1>
        <p class="lead"><?= e($meta['lead']) ?></p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="grid grid--3">
        <?php foreach ($tools as $tool): ?>
          <a class="card card--link" href="<?= e($tool['path']) ?>">
            <h2 class="card-title"><?= e($tool['navLabel']) ?></h2>
            <p class="card__text"><?= e($tool['hero']['lead']) ?></p>
          </a>
        <?php endforeach; ?>
      </div>

      <p class="note mt-4">
        Herramientas gratuitas, sin registro. Los resultados son orientativos: para una liquidación o
        una declaración oficial, siempre confirmamos las cifras con usted antes de presentarlas.
      </p>
    </div>
  </section>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
