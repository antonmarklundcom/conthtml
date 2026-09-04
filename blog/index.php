<?php
require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/blog/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/blog/',
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/blog/']],
];

$articles = content('blog');
usort($articles, static fn ($a, $b) => strcmp($b['date'], $a['date']));

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
      <?php if ($articles === []): ?>
        <p class="lead"><?= e(ui('placeholder.notice')) ?></p>
      <?php else: ?>
        <div class="grid grid--3">
          <?php foreach ($articles as $article): ?>
            <a class="card card--link" href="/blog/<?= e($article['slug']) ?>/">
              <?php if (!empty($article['tags'][0])): ?>
                <span class="eyebrow"><?= e($article['tags'][0]) ?></span>
              <?php endif; ?>
              <h2 class="card-title"><?= e($article['title']) ?></h2>
              <p class="card__text"><?= e($article['description']) ?></p>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
