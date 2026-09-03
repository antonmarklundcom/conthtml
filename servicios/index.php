<?php
/**
 * Servicios hub. The three clusters are the legacy information architecture
 * (plan §1.9) and the internal-link structure the old site already ranks on, so
 * they stay as section headings.
 *
 * A2 (plan §5.2.4) adds the hero panel, the proceso block and the full copy;
 * the cluster grids below are already data-driven from content/services.php.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/servicios/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/servicios/',
    'breadcrumbs' => [['label' => ui('nav.services'), 'path' => '/servicios/']],
];

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">

  <section class="page-hero">
    <div class="container">
      <?php require ROOT_DIR . '/partials/breadcrumbs.php'; ?>
      <div class="page-hero__inner">
        <p class="eyebrow"><?= e(ui('services_hub.eyebrow')) ?></p>
        <h1><?= e(ui('services_hub.title')) ?></h1>
        <p class="lead"><?= e(ui('services_hub.lead')) ?></p>
      </div>
    </div>
  </section>

  <?php $band = 0; ?>
  <?php foreach (nav('mega') as $key => $cluster): ?>
    <?php if ($cluster['items'] === []) { continue; } ?>
    <section class="section<?= $band++ % 2 ? ' section--surface' : '' ?>" id="<?= e($key) ?>">
      <div class="container">
        <div class="section-head">
          <h2><?= e($cluster['label']) ?></h2>
        </div>
        <?php
        $gridSlugs    = array_column($cluster['items'], 'slug');
        $gridNumbered = false;
        require ROOT_DIR . '/partials/service-card-grid.php';
        ?>
      </div>
    </section>
  <?php endforeach; ?>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
