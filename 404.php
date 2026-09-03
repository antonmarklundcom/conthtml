<?php
/**
 * 404 page. Reached through the ErrorDocument directive in .htaccess (and the
 * equivalent branch in router.php), so it is also included directly by
 * templates/service.php for an unknown slug — hence the guard on ROOT_DIR.
 *
 * B2 (plan §6.2.5) adds the fuller "helpful links" treatment.
 */

if (!defined('ROOT_DIR')) {
    require __DIR__ . '/lib/bootstrap.php';
}

if (!headers_sent()) {
    http_response_code(404);
}

$page = [
    'title'       => 'Página no encontrada',
    'description' => 'No encontramos la página que buscaba. Vea nuestros servicios contables o '
                   . 'escríbanos y le indicamos dónde está lo que necesita.',
    'path'        => '/404',
    'noindex'     => true,
];

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">
  <section class="page-hero">
    <div class="container">
      <div class="page-hero__inner">
        <h1><?= e(ui('error404.title')) ?></h1>
        <p class="lead"><?= e(ui('error404.lead')) ?></p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <?php
      $gridSlugs    = ['contabilidad', 'iva', 'marangatu', 'ekuatia', 'ips', 'eas'];
      $gridNumbered = false;
      require ROOT_DIR . '/partials/service-card-grid.php';
      ?>
      <p class="mt-4"><a href="/servicios/"><?= e(ui('nav.all_services')) ?> →</a></p>
    </div>
  </section>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
