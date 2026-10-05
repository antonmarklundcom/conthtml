<?php
/**
 * Homepage: concise service discovery and contact, with an illustrative
 * report/workflow instead of unverified portraits or invented firm metrics.
 */

require __DIR__ . '/lib/bootstrap.php';

$meta = page_meta('/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/',
    'faq'         => content('conversion')['home_faq'],
];

/* Only real, confirmed figures reach the hero. Anything without a value and a
   label is dropped rather than padded out. */
$homeStats = array_values(array_filter(
    (array) site('stats'),
    static fn ($s) => is_array($s) && !empty($s['value']) && !empty($s['label'])
));

$homeCredentials = array_values(array_filter((array) site('credentials')));
if ($homeCredentials === []) {
    $homeCredentials = content('ui')['about']['home_credentials'];
}

/* The same predicate partials/testimonials.php uses, so the page never ends up
   choosing the testimonials band and then rendering neither of the two. */
$homeTestimonials = array_filter(
    (array) site('testimonials'),
    static fn ($t) => is_array($t) && !empty($t['quote'])
);

/* The homepage names no single service, so this is the model's neutral
   default — still a message about the visitor's company, never the button's
   own label (plan §5.3.8a). */
$homeWhatsapp = whatsapp_link(whatsapp_text_for_page());

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main" class="home-page">

  <!-- Hero ------------------------------------------------------------- -->
  <section class="hero hero--home">
    <div class="container hero__grid">

      <div class="hero__copy">
        <span class="pill">
          <span class="pill__dot" aria-hidden="true"></span>
          <?= e(ui('home.eyebrow')) ?>
        </span>

        <h1><?= e(ui('home.h1_lead')) ?><span class="accent"><?= e(ui('home.h1_accent')) ?></span></h1>

        <p class="lead hero__lead"><?= e(ui('home.lead')) ?></p>

        <div class="btn-row">
          <a class="btn <?= $homeWhatsapp ? 'btn--whatsapp' : 'btn--primary' ?>" href="<?= e($homeWhatsapp ?? '/contacto/') ?>"<?= $homeWhatsapp ? ' rel="noopener" data-service=""' : '' ?>>
            <?= e($homeWhatsapp ? ui('cta.whatsapp_long') : ui('cta.consult')) ?>
          </a>
          <a class="btn btn--secondary" href="#servicios"><?= e(ui('cta.see_included')) ?></a>
        </div>

        <p class="hero__offer"><?= e(content('conversion')['offer_note']) ?></p>

        <?php if (site('phone')): ?>
          <p class="hero__phone"><a href="tel:+<?= e(phone_digits(site('phone'))) ?>"><?= e(site('phone')) ?></a> · <?= e(site('city')) ?></p>
        <?php endif; ?>

        <?php if ($homeStats !== []): ?>
          <div class="stat-row">
            <?php foreach ($homeStats as $homeStat): ?>
              <div class="stat">
                <span class="stat__value"><?= e($homeStat['value']) ?></span>
                <span class="stat__label"><?= e($homeStat['label']) ?></span>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <?php $homePersonas = content('ui')['home']['personas'] ?? []; ?>
        <?php if ($homePersonas !== []): ?>
          <div class="persona-strip">
            <span class="persona-strip__label"><?= e(ui('home.persona_eyebrow')) ?></span>
            <div class="persona-strip__chips">
              <?php foreach ($homePersonas as $homePersona): ?>
                <a class="persona-chip" href="<?= e($homePersona['href']) ?>"><?= e($homePersona['label']) ?></a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <div class="hero__panel">
        <?php require ROOT_DIR . '/partials/status-panel.php'; ?>
        <p class="hero__panel-note"><?= e(ui('home.report_note')) ?></p>
      </div>

    </div>
  </section>

  <!-- Servicios -------------------------------------------------------- -->
  <section class="section section--surface" id="servicios">
    <div class="container">
      <div class="section-head section-head--split">
        <div class="section-head__text">
          <p class="eyebrow"><?= e(ui('home.services_eyebrow')) ?></p>
          <h2><?= e(ui('home.services_title')) ?></h2>
        </div>
        <p class="section-head__aside"><?= e(ui('home.services_lead')) ?></p>
      </div>

      <?php require ROOT_DIR . '/partials/home-services.php'; ?>

      <div class="unsure">
        <div class="unsure__copy">
          <h3 class="card-title"><?= e(ui('home.unsure_title')) ?></h3>
          <p><?= e(ui('home.unsure_text')) ?></p>
        </div>
        <a class="btn btn--primary" href="<?= e($homeWhatsapp ?? '/contacto/') ?>"<?= $homeWhatsapp ? ' rel="noopener"' : '' ?>>
          <?= e(ui('cta.talk')) ?>
        </a>
      </div>

      <p class="mt-4"><a href="/servicios/"><?= e(ui('nav.all_services')) ?> &rarr;</a></p>
    </div>
  </section>

  <!-- Credibilidad ------------------------------------------------------ -->
  <section class="section home-overview">
    <div class="container split">

      <div class="work-preview">
        <span class="work-preview__mark" aria-hidden="true">C.</span>
        <p class="eyebrow"><?= e(ui('about.workflow_note')) ?></p>
        <h3><?= e(ui('about.workflow_title')) ?></h3>
        <ol class="work-preview__steps">
          <?php foreach (content('ui')['about']['workflow_steps'] as $workIndex => $workStep): ?>
            <li><span class="work-preview__number" aria-hidden="true"><?= $workIndex + 1 ?></span><?= e($workStep) ?></li>
          <?php endforeach; ?>
        </ol>
      </div>

      <div class="stack">
        <p class="eyebrow"><?= e(ui('about.eyebrow')) ?></p>
        <h2><?= e(ui('about.title')) ?></h2>
        <div class="prose"><p><?= e(ui('about.text')) ?></p></div>
        <ul class="checklist">
          <?php foreach ($homeCredentials as $homeCredential): ?>
            <li><span><?= e($homeCredential) ?></span></li>
          <?php endforeach; ?>
        </ul>
        <p class="mt-0"><a href="/nosotros/"><?= e(ui('about.link')) ?> &rarr;</a></p>
      </div>

    </div>
  </section>

  <!-- Proceso ----------------------------------------------------------- -->
  <?php
  $processCompact = true;
  $processTitle = ui('home.process_title');
  $processSteps = content('ui')['home']['process_steps'];
  require ROOT_DIR . '/partials/process.php';
  ?>

  <!-- Casos, or the rubros band while there are no testimonials ---------- -->
  <?php if ($homeTestimonials !== []): ?>
    <?php require ROOT_DIR . '/partials/testimonials.php'; ?>
  <?php else: ?>
    <?php require ROOT_DIR . '/partials/industries.php'; ?>
  <?php endif; ?>

  <section class="section section--surface home-faq">
    <div class="container">
      <?php
      $faqItems = content('conversion')['home_faq'];
      $faqTitle = content('conversion')['home_faq_title'];
      require ROOT_DIR . '/partials/faq.php';
      unset($faqTitle);
      ?>
      <p class="note mt-4">Vea <a href="/precios/">el alcance de nuestros planes</a> o <a href="/cambiar-de-contador/">cómo consultar por un cambio de contador</a>.</p>
    </div>
  </section>

  <!-- Contacto ---------------------------------------------------------- -->
  <section class="section" id="contacto">
    <div class="container split">

      <div class="stack">
        <p class="eyebrow"><?= e(ui('cta_band.eyebrow')) ?></p>
        <h2 class="d2"><?= e(ui('home.contact_title')) ?></h2>
        <div class="prose"><p><?= e(ui('home.contact_lead')) ?></p></div>

        <div class="btn-row">
          <?php if ($homeWhatsapp !== null): ?>
            <a class="btn btn--whatsapp" href="<?= e($homeWhatsapp) ?>" rel="noopener"><?= e(ui('cta.whatsapp_long')) ?></a>
          <?php endif; ?>
          <?php if (site('phone')): ?>
            <a class="btn btn--secondary" href="tel:+<?= e(phone_digits(site('phone'))) ?>"><?= e(site('phone')) ?></a>
          <?php else: ?>
            <a class="btn btn--secondary" href="/contacto/"><?= e(ui('nav.contact')) ?></a>
          <?php endif; ?>
        </div>

        <?php
        $homeNap = array_values(array_filter([
            site('street') ? trim(site('street') . ', ' . site('city'), ', ') : site('city'),
            site('hours'),
        ]));
        ?>
        <?php if ($homeNap !== []): ?>
          <p class="note"><?= e(implode(' · ', $homeNap)) ?></p>
        <?php endif; ?>

        <ul class="checklist">
          <?php foreach (content('ui')['home']['contact_steps'] as $homeStep): ?>
            <li><span><?= e($homeStep) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <?php
        $formId      = 'home';
        $formHeading = '';
        require ROOT_DIR . '/partials/lead-form.php';
        ?>
      </div>

    </div>
  </section>

</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
