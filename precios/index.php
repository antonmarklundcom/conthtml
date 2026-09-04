<?php
/**
 * Precios — three plans from content/precios.php (plan §1.10, §6.2.3). Prices
 * render only when a plan's priceGs is set; until then every plan shows its
 * scope and the CTA is a quotation. Never USD, never a placeholder figure.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/precios/');
$preciosFaq = [
    ['q' => '¿Por qué no publican precios en guaraníes?', 'a' => 'Porque el honorario mensual depende del volumen de comprobantes, del régimen tributario y de si la empresa tiene nómina. Preferimos cotizar a medida antes que publicar una cifra genérica que después no aplica a su caso.'],
    ['q' => '¿La cotización tiene costo?', 'a' => 'No. La conversación inicial y la propuesta por escrito no tienen costo ni compromiso.'],
    ['q' => '¿Puedo cambiar de plan si mi empresa crece?', 'a' => 'Sí. El honorario se revisa cuando cambia su volumen de operaciones o suma servicios como nómina o auditoría, siempre con el alcance nuevo acordado por escrito.'],
];
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/precios/',
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/precios/']],
    'faq'         => $preciosFaq,
];

$plans = content('precios');

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
        <?php foreach ($plans as $plan): ?>
          <div class="card<?= !empty($plan['featured']) ? ' card--ink' : '' ?>">
            <h2 class="card-title"><?= e($plan['name']) ?></h2>
            <p class="card__text"><?= e($plan['audience']) ?></p>
            <?php if (!empty($plan['priceGs'])): ?>
              <p class="stat__value"><?= e(fmt_gs((int) $plan['priceGs'])) ?> <span class="note">/mes</span></p>
            <?php else: ?>
              <p class="card-title">Cotización en 48 h</p>
            <?php endif; ?>
            <?php if (!empty($plan['includes'])): ?>
              <ul class="checklist mt-3">
                <?php foreach ($plan['includes'] as $item): ?>
                  <li><span><?= e($item) ?></span></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            <div class="btn-row mt-4">
              <a class="btn <?= !empty($plan['featured']) ? 'btn--primary' : 'btn--secondary' ?>" href="/contacto/">
                <?= e(ui('cta.consult')) ?>
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <p class="note mt-4">Los planes definen el alcance del servicio, no un monto cerrado: cada
        propuesta se ajusta a su volumen de comprobantes, su régimen tributario y si tiene nómina, y se
        entrega por escrito antes de empezar. Sin letra chica ni cargos ocultos.</p>
    </div>
  </section>

  <section class="section section--surface">
    <div class="container">
      <?php $faqItems = $preciosFaq; ?>
      <?php require ROOT_DIR . '/partials/faq.php'; ?>
    </div>
  </section>

  <?php
    $ctaTitle = 'Cuéntenos su volumen y le proponemos un plan.';
    require ROOT_DIR . '/partials/cta-band.php';
  ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
