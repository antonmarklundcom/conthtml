<?php
/**
 * Términos de servicio — real Spanish legal text for a Paraguayan accounting
 * firm (plan §6.2.4). No number, deadline or law is stated unless it is
 * general and verifiable (the applicable-law clause names Paraguay, not a
 * specific unconfirmed statute).
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/terminos/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/terminos/',
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/terminos/']],
];

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
        <h2>1. Objeto y alcance</h2>
        <p>Estos términos rigen la prestación de servicios de contabilidad, impuestos, nómina, apertura
          de empresas, facturación electrónica y auditoría por parte de <?= e(site('name') ?? 'nuestro estudio') ?>.
          El alcance específico de cada servicio —qué incluye, qué no incluye y qué necesitamos de usted—
          se define por escrito en la propuesta que le entregamos antes de empezar, y prevalece sobre la
          descripción general de cada servicio en este sitio.</p>
      </div>

      <div>
        <h2>2. Honorarios y forma de pago</h2>
        <p>El honorario mensual y su forma de pago se acuerdan por escrito antes de iniciar el servicio,
          según el alcance definido en la propuesta. Un cambio en el volumen de operaciones, en el
          régimen tributario o en los servicios contratados puede implicar una revisión del honorario,
          siempre acordada con usted por escrito antes de aplicarse.</p>
      </div>

      <div>
        <h2>3. Obligaciones del cliente</h2>
        <p>Usted se compromete a entregarnos la documentación y la información necesaria para prestar el
          servicio dentro de los plazos que acordemos, y a que esa información sea veraz y completa.
          Nuestro trabajo depende directamente de los comprobantes, libros y datos que usted nos
          proporciona: una demora o una inexactitud en esa entrega puede afectar los plazos de
          presentación ante la DNIT, el IPS u otros organismos.</p>
      </div>

      <div>
        <h2>4. Obligaciones del estudio</h2>
        <p>Nos comprometemos a prestar el servicio contratado con diligencia profesional, dentro de los
          plazos acordados por escrito, y a mantener la confidencialidad de toda la información que usted
          nos confía, conforme a nuestra <a href="/privacidad/">política de privacidad</a>.</p>
      </div>

      <div>
        <h2>5. Secreto profesional y confidencialidad</h2>
        <p>Toda la documentación tributaria, contable, laboral y societaria de su empresa se trata bajo
          secreto profesional. No compartimos esa información con terceros salvo que la ley nos obligue a
          presentarla ante un organismo público en el marco de su servicio, o que usted nos autorice
          expresamente a hacerlo.</p>
      </div>

      <div>
        <h2>6. Responsabilidad</h2>
        <p>Nuestra responsabilidad se limita a la correcta gestión de la información y documentación que
          usted efectivamente nos entrega dentro de los plazos acordados. No respondemos por multas,
          recargos o consecuencias derivadas de documentación incompleta, inexacta o entregada fuera de
          plazo por parte del cliente.</p>
      </div>

      <div>
        <h2>7. Duración y terminación</h2>
        <p>El servicio se presta de forma mensual y se renueva automáticamente salvo que alguna de las
          partes comunique su intención de terminarlo, con el aviso previo que se acuerde en la propuesta
          escrita. Al finalizar la relación, le entregamos la documentación y los registros contables
          correspondientes a su empresa.</p>
      </div>

      <div>
        <h2>8. Modificaciones a estos términos</h2>
        <p>Podemos actualizar estos términos cuando cambie la normativa vigente o la forma en que
          prestamos nuestros servicios. Los cambios no aplican de forma retroactiva a propuestas ya
          acordadas por escrito.</p>
      </div>

      <div>
        <h2>9. Ley aplicable</h2>
        <p>Estos términos se rigen por las leyes de la República del Paraguay.</p>
      </div>

      <p class="note">Última actualización: 4 de septiembre de 2026.</p>
    </div>
  </section>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
