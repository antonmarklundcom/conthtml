<?php
/**
 * Política de privacidad — real Spanish legal text for a Paraguayan accounting
 * firm (plan §6.2.4). Cites Ley 1682/2001 (protección de datos personales) y
 * su modificación por Ley 6534/2020, más "la normativa vigente" para lo que
 * cambie sin que este texto tenga que reescribirse. No cita ninguna ley que
 * no pueda verificarse.
 */

require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/privacidad/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/privacidad/',
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/privacidad/']],
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
        <h2>1. Qué datos recopilamos</h2>
        <p>Cuando usted nos escribe por WhatsApp, completa el formulario de contacto o nos contrata como
          su estudio contable, podemos recopilar su nombre, empresa o rubro, teléfono, correo electrónico
          y una breve descripción de su consulta. Si se convierte en cliente, además tratamos la
          documentación tributaria, contable, laboral y societaria que usted nos confía para prestar el
          servicio: comprobantes, libros, RUC, clave de acceso a sistemas de la DNIT que usted nos
          autorice a usar en su representación, y documentación similar.</p>
      </div>

      <div>
        <h2>2. Para qué usamos sus datos</h2>
        <p>Usamos sus datos únicamente para responder su consulta, prestarle el servicio contable
          contratado, cumplir las obligaciones legales y tributarias que ese servicio implica ante la
          DNIT, el IPS y otros organismos, y comunicarnos con usted sobre vencimientos, presentaciones y
          novedades de su cuenta. No usamos su información para fines distintos a estos sin su
          autorización.</p>
      </div>

      <div>
        <h2>3. Marco legal</h2>
        <p>Tratamos sus datos personales conforme a la Ley N.º 1682/2001, que reglamenta la información
          de carácter privado, con las modificaciones introducidas por la Ley N.º 6534/2020, y demás
          normativa vigente en materia de protección de datos personales en Paraguay.</p>
      </div>

      <div>
        <h2>4. Confidencialidad y secreto profesional</h2>
        <p>La información tributaria y financiera de su empresa está protegida por el secreto profesional
          propio de la actividad contable. Las credenciales de acceso a sistemas de la DNIT u otros
          organismos que usted nos confíe se usan exclusivamente para gestionar sus trámites y nunca se
          comparten con terceros ajenos a su empresa.</p>
      </div>

      <div>
        <h2>5. Con quién compartimos su información</h2>
        <p>Compartimos su información con terceros solo en dos casos: cuando la ley nos obliga a
          presentarla ante un organismo como la DNIT o el IPS en el marco de su servicio, o cuando usted
          nos autoriza expresamente a hacerlo. Los datos que usted deja en nuestro formulario de contacto
          se registran en un sistema de gestión de consultas para poder darle seguimiento; ese sistema no
          publica ni vende su información a terceros.</p>
      </div>

      <div>
        <h2>6. Cómo protegemos sus datos</h2>
        <p>Aplicamos medidas razonables de seguridad para proteger su información contra accesos no
          autorizados, pérdida o alteración, tanto en nuestros sistemas internos como en los formularios
          de este sitio.</p>
      </div>

      <div>
        <h2>7. Sus derechos</h2>
        <p>Puede solicitarnos el acceso, la corrección o la eliminación de sus datos personales en
          cualquier momento, salvo la documentación que estemos legalmente obligados a conservar por
          nuestra relación con la DNIT u otros organismos. Para ejercer estos derechos, escríbanos desde
          nuestra <a href="/contacto/">página de contacto</a><?php if (site('email')): ?> o al correo
          <a href="mailto:<?= e(site('email')) ?>"><?= e(site('email')) ?></a><?php endif; ?>.</p>
      </div>

      <div>
        <h2>8. Cambios a esta política</h2>
        <p>Podemos actualizar esta política cuando cambie la normativa vigente o la forma en que
          prestamos nuestros servicios. La fecha de la última actualización se indica al pie de esta
          página.</p>
      </div>

      <p class="note">Última actualización: 4 de septiembre de 2026.</p>
    </div>
  </section>

  <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
</main>
<?php require ROOT_DIR . '/partials/footer.php'; ?>
