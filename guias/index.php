<?php
/**
 * /guias/ — the hub for the ten how-to guides built in C2 (plan §6.5.1). Lists
 * every entry in content/guias.php as a card, in the same order the content
 * file defines. content/pages.php sets this page's 'stub' to false, so it is
 * indexed and in the sitemap from this phase on.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/guias/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/guias/',
    'noindex'     => $meta['stub'],
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/guias/']],
];

$guides = content('guias');

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
        <?php foreach ($guides as $guide): ?>
          <a class="card card--link" href="<?= e($guide['path']) ?>">
            <h2 class="card-title"><?= e($guide['navLabel']) ?></h2>
            <p class="card__text"><?= e($guide['metaDescription']) ?></p>
          </a>
        <?php endforeach; ?>
      </div>

      <p class="note mt-4">
        Guías gratuitas, sin registro. Explican el trámite paso a paso; si prefiere que nos encarguemos
        nosotros, cada guía tiene un formulario al final para pedirlo.
      </p>
    </div>
  </section>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
