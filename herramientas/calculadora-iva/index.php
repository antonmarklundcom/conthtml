<?php
/**
 * Calculadora de IVA (10 % / 5 % / exento, incluido o excluido) — plan §6.3.3.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'calculadora-iva';
$tool = content('tools')[$slug];

ob_start();
?>
<div class="tool card" data-tool="<?= e($slug) ?>">
  <form class="tool-form" id="iva-form" novalidate>
    <div class="tool-form__row">
      <label class="field">
        <span>Monto (₲)</span>
        <input type="number" inputmode="numeric" min="0" step="1" name="monto" id="iva-monto" required>
      </label>
      <label class="field">
        <span>Tasa de IVA</span>
        <select name="tasa" id="iva-tasa">
          <option value="10">10 % (tasa general)</option>
          <option value="5">5 % (tasa reducida)</option>
          <option value="0">Exento</option>
        </select>
      </label>
    </div>
    <fieldset class="field">
      <legend>¿El monto ya incluye el IVA?</legend>
      <div class="chip-row">
        <input class="chip-radio" type="radio" name="sentido" id="iva-incluido" value="incluido" checked>
        <label class="chip" for="iva-incluido">Sí, incluido</label>
        <input class="chip-radio" type="radio" name="sentido" id="iva-excluido" value="excluido">
        <label class="chip" for="iva-excluido">No, es la base</label>
      </div>
    </fieldset>

    <div class="btn-row">
      <button class="btn btn--primary" type="submit"><?= e(ui('tools.calculate')) ?></button>
    </div>
  </form>

  <div class="tool-result" id="iva-result" hidden aria-live="polite">
    <h2 class="card-title"><?= e(ui('tools.result_title')) ?></h2>
    <dl class="tool-result__lines">
      <dt>Base imponible</dt>
      <dd id="iva-base"></dd>
      <dt>IVA</dt>
      <dd id="iva-monto-iva"></dd>
      <dt>Total</dt>
      <dd id="iva-total"></dd>
    </dl>
    <div class="btn-row mt-3">
      <button class="btn btn--secondary" type="button" id="iva-use-result"><?= e(ui('tools.use_result')) ?></button>
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
