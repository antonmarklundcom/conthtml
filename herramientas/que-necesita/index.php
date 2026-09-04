<?php
/**
 * "¿Qué necesita?" — 4-question quiz that recommends services and prefills
 * the lead form (plan §6.3.5).
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'que-necesita';
$tool = content('tools')[$slug];

ob_start();
?>
<div class="tool card" data-tool="<?= e($slug) ?>">
  <form class="tool-form" id="quenecesita-form" novalidate>
    <fieldset class="field">
      <legend>1. ¿Qué es usted?</legend>
      <div class="chip-row">
        <input class="chip-radio" type="radio" name="quien" id="qn-quien-persona" value="persona_fisica" checked>
        <label class="chip" for="qn-quien-persona">Persona física / profesional</label>
        <input class="chip-radio" type="radio" name="quien" id="qn-quien-empresa" value="empresa_constituida">
        <label class="chip" for="qn-quien-empresa">Empresa ya constituida</label>
        <input class="chip-radio" type="radio" name="quien" id="qn-quien-abrir" value="quiero_abrir">
        <label class="chip" for="qn-quien-abrir">Quiero abrir una empresa</label>
      </div>
    </fieldset>

    <fieldset class="field">
      <legend>2. ¿Qué le preocupa más ahora mismo?</legend>
      <div class="chip-row">
        <input class="chip-radio" type="radio" name="preocupacion" id="qn-preo-impuestos" value="impuestos_dnit" checked>
        <label class="chip" for="qn-preo-impuestos">Impuestos y la DNIT</label>
        <input class="chip-radio" type="radio" name="preocupacion" id="qn-preo-nomina" value="nomina">
        <label class="chip" for="qn-preo-nomina">Nómina y empleados</label>
        <input class="chip-radio" type="radio" name="preocupacion" id="qn-preo-sifen" value="facturacion_electronica">
        <label class="chip" for="qn-preo-sifen">Facturación electrónica</label>
        <input class="chip-radio" type="radio" name="preocupacion" id="qn-preo-auditoria" value="auditoria">
        <label class="chip" for="qn-preo-auditoria">Auditoría o control</label>
      </div>
    </fieldset>

    <fieldset class="field">
      <legend>3. ¿Tiene contador actualmente?</legend>
      <div class="chip-row">
        <input class="chip-radio" type="radio" name="contador" id="qn-contador-cambiar" value="cambiar">
        <label class="chip" for="qn-contador-cambiar">Sí, pero quiero cambiar</label>
        <input class="chip-radio" type="radio" name="contador" id="qn-contador-primera" value="primera_vez" checked>
        <label class="chip" for="qn-contador-primera">No, es la primera vez</label>
      </div>
    </fieldset>

    <fieldset class="field">
      <legend>4. ¿Cuándo necesita empezar?</legend>
      <div class="chip-row">
        <input class="chip-radio" type="radio" name="cuando" id="qn-cuando-ya" value="ya" checked>
        <label class="chip" for="qn-cuando-ya">Ya</label>
        <input class="chip-radio" type="radio" name="cuando" id="qn-cuando-mes" value="este_mes">
        <label class="chip" for="qn-cuando-mes">Este mes</label>
        <input class="chip-radio" type="radio" name="cuando" id="qn-cuando-averiguando" value="averiguando">
        <label class="chip" for="qn-cuando-averiguando">Estoy averiguando</label>
      </div>
    </fieldset>

    <div class="btn-row">
      <button class="btn btn--primary" type="submit">Ver mi recomendación</button>
    </div>
  </form>

  <div class="tool-result" id="quenecesita-result" hidden aria-live="polite">
    <h2 class="card-title"><?= e(ui('tools.result_title')) ?></h2>
    <p class="note" id="quenecesita-text"></p>
    <ul class="checklist mt-3" id="quenecesita-links"></ul>
    <div class="btn-row mt-3">
      <button class="btn btn--secondary" type="button" id="quenecesita-use-result"><?= e(ui('tools.use_result')) ?></button>
    </div>
  </div>

  <noscript><p class="note"><?= e(ui('tools.need_js')) ?></p></noscript>
</div>

<?php
$formId      = $slug;
$formService = $slug;
$formNeed    = $tool['formNeed'];
$formHeading = ui('form.legend');
/* The form is buffered into $toolCalcHtml BEFORE templates/tool.php sets
   $page, so it cannot read the path from there (plan §5.3.2). */
$formSourcePage = $tool['path'];
require ROOT_DIR . '/partials/lead-form.php';
?>
<?php
$toolCalcHtml = ob_get_clean();

require ROOT_DIR . '/templates/tool.php';
