<?php
/**
 * Calculadora de aporte IPS (keyword round 2026-10-17: "calculador de ips",
 * "calcular ips", "aporte ips"). The rates and the salario mínimo come from
 * content/laboral.php through data attributes, so the JS never holds its own
 * copy of a legal figure.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug    = 'calculadora-ips';
$tool    = content('tools')[$slug];
$laboral = content('laboral');

ob_start();
?>
<div class="tool card" data-tool="<?= e($slug) ?>"
     data-ips-obrero="<?= e((string) $laboral['ips']['obrero']) ?>"
     data-ips-patronal="<?= e((string) $laboral['ips']['patronal']) ?>"
     data-salario-minimo="<?= e((string) $laboral['salarioMinimo']['mensual']) ?>">
  <form class="tool-form" id="ips-form" novalidate>
    <label class="field">
      <span>Salario mensual bruto (₲)</span>
      <input type="number" inputmode="numeric" min="0" step="1" name="salario" id="ips-salario" required>
    </label>
    <p class="note mt-0">El salario que figura en el recibo, antes de descuentos.</p>

    <div class="btn-row">
      <button class="btn btn--primary" type="submit"><?= e(ui('tools.calculate')) ?></button>
      <button class="btn btn--secondary" type="button" id="ips-usar-minimo">
        Usar el salario mínimo (<?= e(fmt_gs((int) $laboral['salarioMinimo']['mensual'])) ?>)
      </button>
    </div>
  </form>

  <div class="tool-result" id="ips-result" hidden aria-live="polite">
    <h2 class="card-title"><?= e(ui('tools.result_title')) ?></h2>
    <dl class="tool-result__lines">
      <dt>Aporte del trabajador (9 %)</dt>
      <dd id="ips-obrero"></dd>
      <dt>Salario neto después del IPS</dt>
      <dd id="ips-neto"></dd>
      <dt>Aporte de la empresa (16,5 %)</dt>
      <dd id="ips-patronal"></dd>
      <dt>Total que se paga al IPS (25,5 %)</dt>
      <dd id="ips-total"></dd>
      <dt>Costo mensual para la empresa</dt>
      <dd id="ips-costo"></dd>
    </dl>
    <p class="note" id="ips-note" hidden></p>
    <div class="btn-row mt-3">
      <button class="btn btn--secondary" type="button" id="ips-use-result"><?= e(ui('tools.use_result')) ?></button>
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
