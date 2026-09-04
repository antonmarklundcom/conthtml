<?php
/**
 * Calculadora de aguinaldo (plan §6.3.1b). Real form markup, progressively
 * enhanced by assets/js/tools/calculadora-aguinaldo.js — the copy above and
 * below the calculator (templates/tool.php) reads fine with JS disabled, the
 * calculation itself needs JS because there is no server-side computation.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'calculadora-aguinaldo';
$tool = content('tools')[$slug];

$meses = [
    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
    7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre',
];

ob_start();
?>
<div class="tool card" data-tool="<?= e($slug) ?>">
  <form class="tool-form" id="aguinaldo-form" novalidate>
    <label class="field">
      <span>¿Cobró el mismo salario todos los meses trabajados?</span>
      <select name="modo" id="aguinaldo-modo">
        <option value="mismo">Sí, el mismo salario</option>
        <option value="detalle">No, cambió mes a mes</option>
      </select>
    </label>

    <div class="tool-form__row" id="aguinaldo-mismo">
      <label class="field">
        <span>Salario mensual (₲)</span>
        <input type="number" inputmode="numeric" min="0" step="1" name="salario" id="aguinaldo-salario">
      </label>
      <label class="field">
        <span>Meses trabajados en el año (para el aguinaldo proporcional)</span>
        <input type="number" inputmode="numeric" min="1" max="12" step="1" name="meses" id="aguinaldo-meses" value="12">
      </label>
    </div>

    <div id="aguinaldo-detalle" class="tool-form__months" hidden>
      <p class="note mt-0">Cargue el monto percibido en cada mes trabajado; deje en blanco los meses que no trabajó.</p>
      <div class="grid grid--4">
        <?php foreach ($meses as $num => $label): ?>
          <label class="field">
            <span><?= e($label) ?></span>
            <input type="number" inputmode="numeric" min="0" step="1" class="aguinaldo-mes-input" data-mes="<?= (int) $num ?>">
          </label>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="btn-row">
      <button class="btn btn--primary" type="submit"><?= e(ui('tools.calculate')) ?></button>
    </div>
  </form>

  <div class="tool-result" id="aguinaldo-result" hidden aria-live="polite">
    <h2 class="card-title"><?= e(ui('tools.result_title')) ?></h2>
    <p class="tool-result__value" id="aguinaldo-result-value"></p>
    <p class="note" id="aguinaldo-result-detail"></p>
    <div class="btn-row mt-3">
      <button class="btn btn--secondary" type="button" id="aguinaldo-use-result"><?= e(ui('tools.use_result')) ?></button>
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
