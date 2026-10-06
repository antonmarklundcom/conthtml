<?php
/** Editorial homepage. Existing metadata, service paths and lead delivery stay intact. */
require __DIR__ . '/lib/bootstrap.php';

$meta = page_meta('/');
$page = [
    'title' => $meta['title'],
    'description' => $meta['description'],
    'path' => '/',
    'faq' => content('conversion')['home_faq'],
];
$homeWhatsapp = whatsapp_link(whatsapp_text_for_page());
$homeTestimonials = array_filter((array) site('testimonials'), static fn ($t) => is_array($t) && !empty($t['quote']));
require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header.php';
?>
<main id="main" class="home-page">
  <section class="hero hero--home">
    <div class="container hero__grid">
      <div class="hero__copy">
        <p class="eyebrow"><?= e(ui('home.eyebrow')) ?></p>
        <h1><?= e(ui('home.h1_lead')) ?><span class="accent"><?= e(ui('home.h1_accent')) ?></span></h1>
        <p class="lead hero__lead"><?= e(ui('home.lead')) ?></p>
        <div class="btn-row">
          <a class="btn <?= $homeWhatsapp ? 'btn--whatsapp' : 'btn--primary' ?>" href="<?= e($homeWhatsapp ?? '/contacto/') ?>"<?= $homeWhatsapp ? ' rel="noopener" data-service=""' : '' ?>>
            <?php if ($homeWhatsapp): ?><?php require ROOT_DIR . '/partials/whatsapp-icon.php'; ?><?php endif; ?>
            <?= e($homeWhatsapp ? ui('cta.whatsapp_long') : ui('cta.consult')) ?>
          </a>
          <a class="btn btn--secondary" href="#servicios"><?= e(ui('cta.see_included')) ?> <span aria-hidden="true">&rarr;</span></a>
        </div>
        <p class="hero__offer"><?= e(content('conversion')['offer_note']) ?></p>
        <?php if (site('phone')): ?>
          <p class="hero__phone"><a href="tel:+<?= e(phone_digits(site('phone'))) ?>"><?= e(site('phone')) ?></a> <span>· <?= e(site('city')) ?></span></p>
        <?php endif; ?>
      </div>
      <figure class="home-portrait">
        <picture>
          <source type="image/avif" srcset="<?= e(asset('/assets/img/consulta-contable-conversacion-cliente-640.avif')) ?> 640w, <?= e(asset('/assets/img/consulta-contable-conversacion-cliente-1280.avif')) ?> 1280w" sizes="(max-width: 1024px) calc(100vw - 40px), 490px">
          <img src="<?= e(asset('/assets/img/consulta-contable-conversacion-cliente-1280.webp')) ?>" srcset="<?= e(asset('/assets/img/consulta-contable-conversacion-cliente-640.webp')) ?> 640w, <?= e(asset('/assets/img/consulta-contable-conversacion-cliente-1280.webp')) ?> 1280w" sizes="(max-width: 1024px) calc(100vw - 40px), 490px" width="1280" height="960" alt="Imagen ilustrativa de una consulta sobre la gestión contable de una empresa" fetchpriority="high" loading="eager">
        </picture>
        <figcaption><span>Imagen ilustrativa</span><span><?= e(site('city')) ?> · Paraguay</span></figcaption>
      </figure>
    </div>
  </section>

  <section class="section home-service-section" id="servicios">
    <div class="container">
      <div class="section-head section-head--split">
        <div class="section-head__text"><p class="eyebrow"><?= e(ui('home.services_eyebrow')) ?></p><h2><?= e(ui('home.services_title')) ?></h2></div>
        <p class="section-head__aside"><?= e(ui('home.services_lead')) ?></p>
      </div>
      <?php require ROOT_DIR . '/partials/home-services.php'; ?>
      <div class="unsure">
        <div class="unsure__copy"><h3 class="card-title"><?= e(ui('home.unsure_title')) ?></h3><p><?= e(ui('home.unsure_text')) ?></p></div>
        <a class="btn <?= $homeWhatsapp ? 'btn--whatsapp' : 'btn--primary' ?>" href="<?= e($homeWhatsapp ?? '/contacto/') ?>"<?= $homeWhatsapp ? ' rel="noopener"' : '' ?>><?= e(ui('cta.talk')) ?></a>
      </div>
      <p class="mt-4"><a class="editorial-link" href="/servicios/"><?= e(ui('nav.all_services')) ?> <span aria-hidden="true">&rarr;</span></a></p>
    </div>
  </section>

  <section class="section home-scope">
    <div class="container home-scope__grid">
      <div>
        <p class="eyebrow">Contabilidad que simplifica tu día a día</p>
        <h2>Menos trámites.<br>Más foco en hacer crecer tu negocio.</h2>
        <p class="lead mt-4">Nos ocupamos de la gestión contable acordada para que puedas dedicar más tiempo a tus clientes y a tu operación. Definimos qué hacemos nosotros, qué necesitamos de vos y los próximos pasos.</p>
        <ul class="home-benefits">
          <li><h3>Obligaciones organizadas</h3><p>Comprobantes, declaraciones y pendientes según tu régimen, con una forma clara de entregar la documentación.</p></li>
          <li><h3>Información para decidir</h3><p>Te explicamos los resultados y lo que necesita tu atención en un lenguaje que puedas entender.</p></li>
          <li><h3>Un contacto para coordinar</h3><p>Consultas sobre contabilidad, impuestos y nómina dentro del alcance acordado, sin tener que organizar todo por tu cuenta.</p></li>
        </ul>
        <a class="editorial-link" href="/nosotros/">Conocé cómo trabajamos <span aria-hidden="true">&rarr;</span></a>
      </div>
      <aside class="home-proposal">
        <p class="eyebrow">Un alcance claro, desde el inicio</p>
        <h3>Tu propuesta considera</h3>
        <p>El servicio se adapta a las necesidades de tu empresa.</p>
        <dl><div><dt>Régimen tributario</dt><dd>Las obligaciones de tu actividad.</dd></div><div><dt>Volumen de comprobantes</dt><dd>La documentación de cada mes.</dd></div><div><dt>Cantidad de empleados</dt><dd>La nómina y los aportes aplicables.</dd></div></dl>
        <p class="note">Alcance y honorarios por escrito antes de empezar.</p>
        <a class="editorial-link" href="/precios/">Ver cómo se prepara la propuesta <span aria-hidden="true">&rarr;</span></a>
      </aside>
    </div>
  </section>

  <?php
  $processCompact = true;
  $processTone = 'plain';
  $processEyebrow = 'Cómo empezamos';
  $processTitle = ui('home.process_title');
  $processSteps = content('ui')['home']['process_steps'];
  require ROOT_DIR . '/partials/process.php';
  ?>

  <section class="section home-resources">
    <div class="container">
      <div class="section-head section-head--split"><div class="section-head__text"><p class="eyebrow">Recursos útiles</p><h2>Guías y herramientas<br>para tu empresa</h2></div><a class="editorial-link" href="/herramientas/">Ver todas las herramientas <span aria-hidden="true">&rarr;</span></a></div>
      <div class="home-resources__grid">
        <a href="/herramientas/calculadora-aguinaldo/"><h3>Calculadora de aguinaldo <span aria-hidden="true">&rarr;</span></h3><p>Estimá el aguinaldo a partir de los ingresos del año.</p></a>
        <a href="/herramientas/vencimientos/"><h3>Vencimientos por RUC <span aria-hidden="true">&rarr;</span></h3><p>Consultá las fechas para organizar tus obligaciones tributarias.</p></a>
        <a href="/guias/"><h3>Guías para empresas <span aria-hidden="true">&rarr;</span></h3><p>EAS, impuestos, nómina y facturación electrónica, paso a paso.</p></a>
      </div>
    </div>
  </section>

  <?php if ($homeTestimonials !== []): ?><?php require ROOT_DIR . '/partials/testimonials.php'; ?><?php endif; ?>
  <section class="section home-activities">
    <div class="container">
      <div class="section-head"><p class="eyebrow"><?= e(ui('home.persona_eyebrow')) ?></p><h2>Una forma de trabajar que se adapta a tu empresa</h2></div>
      <ul class="home-activities__links">
        <?php foreach (content('ui')['industries']['items'] as $homeIndustry): ?><li><a href="<?= e($homeIndustry['path']) ?>"><?= e($homeIndustry['label']) ?> <span aria-hidden="true">&rarr;</span></a></li><?php endforeach; ?>
      </ul>
      <div class="persona-strip"><div class="persona-strip__chips">
        <?php foreach (content('ui')['home']['personas'] as $homePersona): ?><a class="persona-chip" href="<?= e($homePersona['href']) ?>"><?= e($homePersona['label']) ?></a><?php endforeach; ?>
      </div></div>
    </div>
  </section>

  <section class="section home-faq">
    <div class="container home-faq__grid">
      <div><p class="eyebrow">Antes de escribirnos</p><h2>Resolvamos tus primeras dudas</h2><p class="lead mt-4">La consulta inicial sirve para entender qué necesitás y definir el próximo paso.</p></div>
      <div><div class="faq">
        <?php foreach (content('conversion')['home_faq'] as $homeFaqIndex => $homeFaq): ?><details<?= $homeFaqIndex === 0 ? ' open' : '' ?>><summary><?= e($homeFaq['q']) ?></summary><p><?= e($homeFaq['a']) ?></p></details><?php endforeach; ?>
      </div><p class="note mt-4">Consultá <a href="/precios/">el alcance de los planes</a> o <a href="/cambiar-de-contador/">cómo coordinar un cambio de contador</a>.</p></div>
    </div>
  </section>

  <section class="section section--ink home-contact" id="contacto">
    <div class="container split split--top">
      <div class="stack">
        <p class="eyebrow">Tu próximo paso</p>
        <h2><?= e(ui('home.contact_title')) ?></h2>
        <p class="lead"><?= e(ui('home.contact_lead')) ?></p>
        <div class="btn-row">
          <?php if ($homeWhatsapp !== null): ?><a class="btn btn--whatsapp" href="<?= e($homeWhatsapp) ?>" rel="noopener"><?php require ROOT_DIR . '/partials/whatsapp-icon.php'; ?><?= e(ui('cta.whatsapp_long')) ?></a><?php endif; ?>
          <?php if (site('phone')): ?><a class="home-contact__phone" href="tel:+<?= e(phone_digits(site('phone'))) ?>"><?= e(site('phone')) ?></a><?php endif; ?>
        </div>
        <p class="home-contact__privacy"><?= e(content('conversion')['privacy_hint']) ?></p>
      </div>
      <div><?php $formId = 'home'; $formHeading = ui('form.legend'); require ROOT_DIR . '/partials/lead-form.php'; ?></div>
    </div>
  </section>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
