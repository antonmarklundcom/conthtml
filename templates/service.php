<?php
/**
 * Renders one service from content/services.php. Every /<slug>/index.php is
 * three lines: require bootstrap, set $slug, require this file.
 *
 * B1 fills the empty content keys and adds CSS below the tokens block; the
 * section order and the markup structure here stay as they are (plan §4.7).
 * Each block renders only when its data exists, so the page is coherent while
 * A1's seed data is all it has.
 */

declare(strict_types=1);

/** @var string $slug */
$service = services($slug ?? '');

if ($service === null) {
    http_response_code(404);
    require ROOT_DIR . '/404.php';
    return;
}

$clusterLabel = clusters()[$service['cluster']] ?? '';

/* Inicio › Servicios › [Auditoría ›] Title — the audit children sit under their
   sub-hub (plan §6.1.1). */
$breadcrumbs = [['label' => ui('nav.services'), 'path' => '/servicios/']];
if (!empty($service['parent']) && ($parent = services($service['parent'])) !== null) {
    $breadcrumbs[] = ['label' => $parent['navLabel'], 'path' => $parent['path']];
}
$breadcrumbs[] = ['label' => $service['title'], 'path' => $service['path']];

$page = [
    'title'       => $service['seoTitle'] !== '' ? $service['seoTitle'] : $service['title'],
    'description' => $service['metaDescription'],
    'path'        => $service['path'],
    'breadcrumbs' => $breadcrumbs,
    'faq'         => $service['faq'],
];

$hero        = $service['hero'];
$ctaWhatsapp = $service['cta']['whatsappText'] !== ''
    ? $service['cta']['whatsappText']
    : ui('cta.consult');

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">

  <section class="page-hero">
    <div class="container">
      <?php require ROOT_DIR . '/partials/breadcrumbs.php'; ?>
      <div class="page-hero__inner">
        <p class="eyebrow"><?= e($hero['eyebrow'] !== '' ? $hero['eyebrow'] : $clusterLabel) ?></p>
        <h1><?= e($hero['h1'] !== '' ? $hero['h1'] : $service['title']) ?></h1>
        <?php if ($hero['h2'] !== ''): ?>
          <p class="lead"><?= e($hero['h2']) ?></p>
        <?php endif; ?>
        <?php if ($hero['lead'] !== ''): ?>
          <p class="lead"><?= e($hero['lead']) ?></p>
        <?php elseif ($hero['h2'] === ''): ?>
          <p class="lead"><?= e($service['metaDescription']) ?></p>
        <?php endif; ?>
        <div class="btn-row">
          <a class="btn btn--primary" href="/contacto/">
            <?= e($service['cta']['label'] !== '' ? $service['cta']['label'] : ui('cta.consult')) ?>
          </a>
          <?php if (($wa = whatsapp_link($ctaWhatsapp)) !== null): ?>
            <a class="btn btn--secondary" href="<?= e($wa) ?>" rel="noopener"><?= e(ui('cta.whatsapp')) ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <?php if ($service['includes'] !== []): ?>
    <section class="section">
      <div class="container">
        <h2><?= e(ui('service.includes')) ?></h2>
        <ul class="checklist mt-4">
          <?php foreach ($service['includes'] as $item): ?>
            <li><span><?= e($item) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($service['sections'] !== []): ?>
    <section class="section section--surface">
      <div class="container stack">
        <?php foreach ($service['sections'] as $block): ?>
          <div class="prose">
            <h2><?= e($block['h2'] ?? '') ?></h2>
            <?php foreach ($block['body'] ?? [] as $paragraph): ?>
              <p><?= e($paragraph) ?></p>
            <?php endforeach; ?>
            <?php if (!empty($block['items'])): ?>
              <div class="grid grid--2 mt-4">
                <?php foreach ($block['items'] as $item): ?>
                  <div class="card">
                    <h3 class="card-title"><?= e($item['title'] ?? '') ?></h3>
                    <p class="card__text"><?= e($item['text'] ?? '') ?></p>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($service['benefits'] !== []): ?>
    <section class="section">
      <div class="container">
        <h2><?= e(ui('service.benefits')) ?></h2>
        <div class="grid grid--3 mt-4">
          <?php foreach ($service['benefits'] as $benefit): ?>
            <div class="card">
              <h3 class="card-title"><?= e($benefit['title'] ?? '') ?></h3>
              <p class="card__text"><?= e($benefit['text'] ?? '') ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($service['faq'] !== []): ?>
    <section class="section section--surface">
      <div class="container">
        <?php $faqItems = $service['faq']; ?>
        <?php require ROOT_DIR . '/partials/faq.php'; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($service['related'] !== []): ?>
    <section class="section">
      <div class="container">
        <h2><?= e(ui('service.related')) ?></h2>
        <div class="mt-4">
          <?php $gridSlugs = $service['related']; ?>
          <?php require ROOT_DIR . '/partials/service-card-grid.php'; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
