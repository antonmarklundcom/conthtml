<?php
/**
 * Calendario de vencimientos por terminación de RUC (plan §6.3.2). The
 * Calendario Perpetuo table and the IRE/IPS notes live in
 * content/vencimientos.php and are embedded here as JSON for
 * assets/js/tools/vencimientos.js to read — this is a data table, not a
 * formula, so it stays in one place instead of being duplicated in JS.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug         = 'vencimientos';
$tool         = content('tools')[$slug];
$vencimientos = content('vencimientos');

$vencimientosBase = $tool['ctaWhatsapp'];
$vencimientosLink = whatsapp_link($vencimientosBase);

ob_start();
?>
<div class="tool card" data-tool="<?= e($slug) ?>">
  <form class="tool-form" id="vencimientos-form" novalidate>
    <label class="field">
      <span>Terminación de su RUC (último dígito, sin el verificador)</span>
      <select name="terminacion" id="vencimientos-terminacion" required>
        <option value="">Seleccione un dígito</option>
        <?php for ($d = 0; $d <= 9; $d++): ?>
          <option value="<?= $d ?>"><?= $d ?></option>
        <?php endfor; ?>
      </select>
    </label>
    <div class="btn-row">
      <button class="btn btn--primary" type="submit"><?= e(ui('tools.calculate')) ?></button>
    </div>
  </form>

  <div class="tool-result" id="vencimientos-result" hidden aria-live="polite">
    <h2 class="card-title"><?= e(ui('tools.result_title')) ?></h2>
    <dl class="tool-result__lines">
      <dt>IVA mensual (Formulario 120) — este mes</dt>
      <dd id="vencimientos-iva-este-mes"></dd>
      <dt>IVA mensual (Formulario 120) — próximo mes</dt>
      <dd id="vencimientos-iva-proximo-mes"></dd>
      <dt>Aportes IPS</dt>
      <dd id="vencimientos-ips"></dd>
      <dt>IRE anual</dt>
      <dd id="vencimientos-ire"></dd>
    </dl>
    <div class="btn-row mt-3">
      <a class="btn btn--whatsapp" id="vencimientos-recordar" rel="noopener"
         href="<?= e($vencimientosLink ?? '/contacto/') ?>"
         data-wa-configured="<?= $vencimientosLink !== null ? '1' : '0' ?>"
         data-wa-number="<?= e(phone_digits(site('whatsapp'))) ?>">
        Recordarme por WhatsApp
      </a>
    </div>
  </div>

  <noscript><p class="note"><?= e(ui('tools.need_js')) ?></p></noscript>

  <script type="application/json" id="vencimientos-data"><?= json_encode(
      $vencimientos,
      JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG
  ) ?></script>
</div>

<?php
$formId      = $slug;
$formNeed    = $tool['formNeed'];
$formHeading = ui('form.legend');
require ROOT_DIR . '/partials/lead-form.php';
?>
<?php
$toolCalcHtml = ob_get_clean();

require ROOT_DIR . '/templates/tool.php';
