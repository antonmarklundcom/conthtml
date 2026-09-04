<?php
/**
 * Servicios hub (plan §5.2.4). The three clusters are the legacy information
 * architecture (plan §1.9) and the internal-link structure the old site already
 * ranks on, so they stay as section headings — and every one of the 14 service
 * pages is reachable from here in one click.
 *
 * The cluster grids are data-driven from content/services.php: B1 adds copy, B3
 * adds tools, and this page picks both up without an edit.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/servicios/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/servicios/',
    'breadcrumbs' => [['label' => ui('nav.services'), 'path' => '/servicios/']],
];

$hubLeads = content('ui')['cluster_leads'];

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
        <div class="btn-row">
          <a class="btn btn--primary" href="/contacto/"><?= e(ui('cta.consult')) ?></a>
          <a class="btn btn--secondary" href="#como-trabajamos"><?= e(ui('process.eyebrow')) ?></a>
        </div>
      </div>
    </div>
  </section>

  <?php $hubBand = 0; ?>
  <?php foreach (nav('mega') as $hubKey => $hubCluster): ?>
    <?php if ($hubCluster['items'] === []) { continue; } ?>
    <section class="section<?= $hubBand++ % 2 ? ' section--surface' : '' ?>" id="<?= e($hubKey) ?>">
      <div class="container">
        <div class="section-head section-head--split">
          <div class="section-head__text">
            <h2><?= e($hubCluster['label']) ?></h2>
          </div>
          <?php if (!empty($hubLeads[$hubKey])): ?>
            <p class="section-head__aside"><?= e($hubLeads[$hubKey]) ?></p>
          <?php endif; ?>
        </div>
        <?php
        $gridSlugs = array_column($hubCluster['items'], 'slug');
        require ROOT_DIR . '/partials/service-card-grid.php';
        ?>
      </div>
    </section>
  <?php endforeach; ?>

  <section class="section">
    <div class="container">
      <div class="unsure">
        <div class="unsure__copy">
          <h3 class="card-title"><?= e(ui('services_hub.unsure_title')) ?></h3>
          <p><?= e(ui('services_hub.unsure_text')) ?></p>
        </div>
        <a class="btn btn--primary" href="/herramientas/que-necesita/"><?= e(ui('services_hub.unsure_cta')) ?></a>
      </div>
    </div>
  </section>

  <?php
  /* The Auditoría cluster above is white and the closing CTA band below is ink:
     a surface band here keeps the three apart instead of merging the last two
     into one dark slab. */
  $processTone = 'surface';
  $processId   = 'como-trabajamos';
  require ROOT_DIR . '/partials/process.php';
  ?>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
