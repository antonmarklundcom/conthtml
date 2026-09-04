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

/* The prefill comes from content/lead-values.php like every other wa.me link
   on the site (plan §5.3.8a). $page is not set yet — this markup is buffered
   into $toolCalcHtml before templates/tool.php runs — so the slug is passed
   explicitly instead of resolved from the page. */
$vencimientosBase = lead_value($slug)['whatsappText'];
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
         data-service="<?= e($slug) ?>"
         data-wa-configured="<?= $vencimientosLink !== null ? '1' : '0' ?>"
         data-wa-number="<?= e(phone_digits(site('whatsapp'))) ?>">
        Recordarme por WhatsApp
      </a>
    </div>

    <!-- Reminder capture (plan §5.3.6). The visitor who does not want to open
         WhatsApp right now still becomes a tier-C `recordatorio` lead — the
         nurture list is the asset here, not the click. There is no backend
         reminder yet (plan §10); this builds the list. -->
    <form class="remind" action="/enviar.php" method="post" id="vencimientos-recordatorio">
      <h3 class="card-title"><?= e(ui('form.remind_title')) ?></h3>
      <p class="note"><?= e(ui('form.remind_text')) ?></p>

      <div class="remind__row">
        <label class="field">
          <span><?= e(ui('form.remind_phone')) ?></span>
          <input type="tel" name="phone" inputmode="tel" autocomplete="tel"
                 placeholder="<?= e(ui('form.phone_hint')) ?>" required>
        </label>
        <button class="btn btn--primary" type="submit"><?= e(ui('form.remind_submit')) ?></button>
      </div>

      <div class="honeypot" aria-hidden="true">
        <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
      </div>

      <input type="hidden" name="form_id" value="recordatorio-vencimientos">
      <input type="hidden" name="source_page" value="<?= e($tool['path']) ?>">
      <input type="hidden" name="need" value="recordatorio">
      <input type="hidden" name="idempotency_key" value="<?= e(bin2hex(random_bytes(16))) ?>">
      <!-- The RUC terminación the visitor picked; vencimientos.js fills it in
           when the calculator runs, and it is empty until then. -->
      <input type="hidden" name="tool_result" value="" id="vencimientos-recordatorio-result">

      <p class="form-status form-status--ok" id="vencimientos-recordatorio-ok" hidden role="status">
        <strong><?= e(ui('form.remind_ok')) ?></strong>
      </p>
      <p class="form-status form-status--error" id="vencimientos-recordatorio-error" hidden role="alert">
        <strong><?= e(ui('form.error_title')) ?></strong> <?= e(ui('form.error_text')) ?>
      </p>
    </form>
  </div>

  <noscript><p class="note"><?= e(ui('tools.need_js')) ?></p></noscript>

  <script type="application/json" id="vencimientos-data"><?= json_encode(
      $vencimientos,
      JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG
  ) ?></script>
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
