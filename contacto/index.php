<?php
/**
 * Contacto — the site's conversion page and the only one A1 builds for real,
 * because enviar.php redirects here with ?enviado=1 when a visitor submits the
 * form without JS.
 *
 * B2 (plan §6.2.2) adds the full 1B contact split, the map embed and the NAP
 * once Anton confirms the address. Everything contact-related below renders
 * only when content/site.php actually has the value.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/contacto/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/contacto/',
    'breadcrumbs' => [['label' => ui('nav.contact'), 'path' => '/contacto/']],
];

$sent     = isset($_GET['enviado']);
$whatsapp = whatsapp_link(ui('cta.consult'));

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main">

  <section class="page-hero">
    <div class="container">
      <?php require ROOT_DIR . '/partials/breadcrumbs.php'; ?>
      <div class="page-hero__inner">
        <p class="eyebrow"><?= e(ui('contact.eyebrow')) ?></p>
        <h1><?= e(ui('contact.title')) ?></h1>
        <p class="lead"><?= e(ui('contact.lead')) ?></p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container split split--top">

      <div class="stack">
        <?php if ($sent): ?>
          <p class="form-status form-status--ok" role="status">
            <strong><?= e(ui('form.success_title')) ?></strong>
            <?= e(ui('form.success_text')) ?>
          </p>
        <?php endif; ?>

        <div class="btn-row">
          <?php if ($whatsapp !== null): ?>
            <a class="btn btn--whatsapp" href="<?= e($whatsapp) ?>" rel="noopener">
              <?= e(ui('cta.whatsapp_long')) ?>
            </a>
          <?php endif; ?>
          <?php if (site('phone')): ?>
            <a class="btn btn--secondary" href="tel:+<?= e(phone_digits(site('phone'))) ?>">
              <?= e(site('phone')) ?>
            </a>
          <?php endif; ?>
        </div>

        <div>
          <h2 class="card-title"><?= e(ui('contact.expect')) ?></h2>
          <ul class="checklist mt-3">
            <?php foreach (content('ui')['contact']['steps'] as $step): ?>
              <li><span><?= e($step) ?></span></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <dl class="contact-facts">
          <?php if (site('email')): ?>
            <div>
              <dt><?= e(ui('contact.email')) ?></dt>
              <dd><a href="mailto:<?= e(site('email')) ?>"><?= e(site('email')) ?></a></dd>
            </div>
          <?php endif; ?>
          <?php if (site('street')): ?>
            <div>
              <dt><?= e(ui('contact.address')) ?></dt>
              <dd><?= e(site('street')) ?>, <?= e(site('city')) ?>, <?= e(site('country')) ?></dd>
            </div>
          <?php endif; ?>
          <?php if (site('hours')): ?>
            <div>
              <dt><?= e(ui('contact.hours')) ?></dt>
              <dd><?= e(site('hours')) ?></dd>
            </div>
          <?php endif; ?>
        </dl>
      </div>

      <?php
      $formId      = 'contacto';
      $formHeading = ui('form.legend');
      require ROOT_DIR . '/partials/lead-form.php';
      ?>

    </div>
  </section>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
