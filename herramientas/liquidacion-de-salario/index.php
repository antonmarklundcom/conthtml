<?php
/**
 * Calculadora de liquidación de salario / finiquito (plan §6.3.1c). The rule
 * tables (IPS 9 %, vacaciones, preaviso, indemnización) live in
 * content/laboral.php; assets/js/tools/liquidacion-de-salario.js mirrors the
 * same figures in JS, since there is no server round-trip for the calculation
 * — both files carry the exact same numbers documented there and in
 * docs/facts-to-verify.md.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'liquidacion-de-salario';
$tool = content('tools')[$slug];

ob_start();
?>
<div class="tool card" data-tool="<?= e($slug) ?>">
  <form class="tool-form" id="finiquito-form" novalidate>
    <div class="tool-form__row">
      <label class="field">
        <span>Fecha de ingreso</span>
        <input type="date" name="ingreso" id="finiquito-ingreso" required>
      </label>
      <label class="field">
        <span>Fecha de egreso</span>
        <input type="date" name="egreso" id="finiquito-egreso" required>
      </label>
    </div>
    <div class="tool-form__row">
      <label class="field">
        <span>Salario mensual (₲)</span>
        <input type="number" inputmode="numeric" min="0" step="1" name="salario" id="finiquito-salario" required>
      </label>
      <label class="field">
        <span>Motivo de la salida</span>
        <select name="motivo" id="finiquito-motivo">
          <option value="renuncia">Renuncia</option>
          <option value="despido_injustificado">Despido sin causa justificada</option>
          <option value="despido_justificado">Despido con causa justificada</option>
        </select>
      </label>
    </div>

    <div class="btn-row">
      <button class="btn btn--primary" type="submit"><?= e(ui('tools.calculate')) ?></button>
    </div>
  </form>

  <div class="tool-result" id="finiquito-result" hidden aria-live="polite">
    <h2 class="card-title"><?= e(ui('tools.result_title')) ?></h2>
    <dl class="tool-result__lines" id="finiquito-lines"></dl>
    <p class="tool-result__value" id="finiquito-total"></p>
    <p class="note" id="finiquito-note"></p>
    <div class="btn-row mt-3">
      <button class="btn btn--secondary" type="button" id="finiquito-use-result"><?= e(ui('tools.use_result')) ?></button>
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
