<?php
/**
 * Nosotros — rewritten from the live-site scan §4.2 in "usted" (plan §6.2.1).
 * The scan's brand-philosophy content was real and well written; this keeps
 * its structure (filosofía, valores) but drops the leftover English demo
 * quote and the unconfirmed WhatsApp claim the scan flagged, and adds the
 * 1B "Quiénes somos" credentials/team/CTA shape.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/nosotros/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/nosotros/',
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/nosotros/']],
];

$team        = site('team');
$credentials = site('credentials') !== [] ? site('credentials') : content('ui')['about']['credentials'];

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
    <div class="container prose stack">
      <div>
        <h2>Sobre nosotros</h2>
        <p>No somos solo números: somos el respaldo que su empresa necesita para crecer tranquila.
          Sabemos que detrás de cada RUC hay un proyecto, una familia o una idea que busca crecer, y
          por eso convertimos la contabilidad tradicional en un proceso claro, ágil y sin sobresaltos.</p>
      </div>
    </div>
  </section>

  <section class="section section--surface">
    <div class="container">
      <div class="section-head">
        <p class="eyebrow">Nuestra filosofía</p>
        <h2>Eficiencia para que usted recupere su tiempo.</h2>
        <p class="lead">Creemos que la tecnología debe trabajar para nosotros, no al revés. Nuestra
          forma de trabajar se apoya en tres pilares que se apartan del contador tradicional.</p>
      </div>
      <div class="grid grid--3 mt-4">
        <div class="card">
          <h3 class="card-title">Claridad radical</h3>
          <p class="card__text">Evitamos el lenguaje técnico innecesario. Le explicamos sus impuestos de
            forma que los entienda, sin vueltas.</p>
        </div>
        <div class="card">
          <h3 class="card-title">Mentalidad paperless</h3>
          <p class="card__text">Somos nativos digitales. Si algo puede resolverse en la nube, se
            resuelve en la nube: menos papeleo, más agilidad.</p>
        </div>
        <div class="card">
          <h3 class="card-title">Compromiso real</h3>
          <p class="card__text">No somos simples cargadores de facturas. Somos consultores que cuidan la
            salud financiera de su empresa como si fuera propia.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-head">
        <p class="eyebrow">Valores</p>
        <h2>Lo que no negociamos.</h2>
      </div>
      <div class="grid grid--3 mt-4">
        <div class="card">
          <h3 class="card-title">Integridad matriculada</h3>
          <p class="card__text">Nuestra firma no es un trámite: es un respaldo de responsabilidad legal y
            ética ante la DNIT.</p>
        </div>
        <div class="card">
          <h3 class="card-title">Innovación constante</h3>
          <p class="card__text">El sistema tributario paraguayo cambia — Ekuatia'i, SIFEN, Marangatu 2.0.
            Nos mantenemos un paso adelante para que usted no tenga que correr detrás de cada
            actualización.</p>
        </div>
        <div class="card">
          <h3 class="card-title">Cercanía real</h3>
          <p class="card__text">La contabilidad no tiene por qué ser fría ni distante. Está a una
            consulta de distancia, por WhatsApp o por nuestro formulario de contacto, sin
            intermediarios.</p>
        </div>
      </div>
    </div>
  </section>

  <?php if ($team !== []): ?>
    <section class="section section--surface">
      <div class="container">
        <div class="section-head">
          <p class="eyebrow">Equipo</p>
          <h2>Quién lleva su cuenta.</h2>
        </div>
        <div class="grid grid--3 mt-4">
          <?php foreach ($team as $member): ?>
            <div class="card">
              <h3 class="card-title"><?= e($member['name'] ?? '') ?></h3>
              <?php if (!empty($member['role'])): ?>
                <p class="card__text"><strong><?= e($member['role']) ?></strong></p>
              <?php endif; ?>
              <?php if (!empty($member['credentials'])): ?>
                <p class="card__text"><?= e($member['credentials']) ?></p>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($credentials !== []): ?>
    <section class="section">
      <div class="container">
        <div class="section-head">
          <p class="eyebrow">Credenciales</p>
          <h2>Con qué respaldo trabajamos.</h2>
        </div>
        <ul class="checklist mt-4">
          <?php foreach ($credentials as $credential): ?>
            <li><span><?= e($credential) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
  <?php endif; ?>

  <?php
    $ctaTitle = 'Dejemos que su contabilidad deje de ser una carga.';
    $ctaLead  = 'No le ofrecemos promesas vacías: le ofrecemos un proceso que funciona y un equipo que responde.';
    require ROOT_DIR . '/partials/cta-band.php';
  ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
