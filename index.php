<?php
/**
 * Homepage — A1 foundation version.
 *
 * A2 (plan §5.2) ports the full 1B homepage section by section: hero panel,
 * six numbered service cards, credibilidad, proceso, casos, contacto split.
 * What is here now is the hero band, the service grid and the CTA band, so the
 * design tokens and the shared partials are exercised end to end and the local
 * preview is a real page rather than a stub.
 *
 * No stats, no testimonials, no invented figures: content/site.php has none yet
 * and nothing on this page fabricates any (plan §1.4).
 */

require __DIR__ . '/lib/bootstrap.php';

$meta = page_meta('/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/',
];

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">

  <section class="hero">
    <div class="container">
      <div class="hero__copy">
        <span class="pill">
          <span class="pill__dot" aria-hidden="true"></span>
          <?= e(ui('home.eyebrow')) ?>
        </span>
        <h1>
          <?= e(ui('home.h1_lead')) ?><span class="accent"><?= e(ui('home.h1_accent')) ?></span>
        </h1>
        <p class="lead hero__lead"><?= e(ui('home.lead')) ?></p>
        <div class="btn-row">
          <a class="btn btn--primary" href="/contacto/"><?= e(ui('cta.consult')) ?></a>
          <a class="btn btn--secondary" href="/servicios/"><?= e(ui('cta.see_included')) ?></a>
        </div>
      </div>
    </div>
  </section>

  <section class="section section--surface">
    <div class="container">
      <div class="section-head section-head--split">
        <div class="section-head__text">
          <p class="eyebrow"><?= e(ui('services_hub.eyebrow')) ?></p>
          <h2><?= e(ui('services_hub.title')) ?></h2>
        </div>
        <p class="section-head__aside"><?= e(ui('services_hub.lead')) ?></p>
      </div>

      <?php
      $gridSlugs    = ['contabilidad', 'iva', 'ips', 'eas', 'ekuatia', 'auditoria'];
      $gridNumbered = true;
      require ROOT_DIR . '/partials/service-card-grid.php';
      ?>

      <p class="mt-4"><a href="/servicios/"><?= e(ui('nav.all_services')) ?> →</a></p>
    </div>
  </section>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
