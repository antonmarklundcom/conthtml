<?php
/**
 * Comparador EAS / SRL / Unipersonal (plan §6.3.4): a static table from
 * content/tools.php's 'table' key, plus a 3-question mini quiz.
 */

require __DIR__ . '/../../lib/bootstrap.php';

$slug  = 'comparador-eas-srl-unipersonal';
$tool  = content('tools')[$slug];
$table = $tool['table'];

ob_start();
?>
<div class="tool card" data-tool="<?= e($slug) ?>">
  <div class="table-scroll">
    <table class="compare-table">
      <thead>
        <tr>
          <?php foreach ($table['headers'] as $header): ?>
            <th scope="col"><?= e($header) ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($table['rows'] as $row): ?>
          <tr>
            <th scope="row"><?= e($row['label']) ?></th>
            <?php foreach ($row['values'] as $value): ?>
              <td><?= e($value) ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="tool card" data-tool="<?= e($slug) ?>-quiz">
  <h2 class="card-title">¿Cuál le conviene? Responda 3 preguntas</h2>
  <form class="tool-form" id="comparador-form" novalidate>
    <fieldset class="field">
      <legend>¿Cuántos socios tendrá la empresa?</legend>
      <div class="chip-row">
        <input class="chip-radio" type="radio" name="socios" id="comparador-socios-uno" value="uno" checked>
        <label class="chip" for="comparador-socios-uno">Uno solo</label>
        <input class="chip-radio" type="radio" name="socios" id="comparador-socios-varios" value="varios">
        <label class="chip" for="comparador-socios-varios">Dos o más</label>
      </div>
    </fieldset>

    <fieldset class="field">
      <legend>¿Cuál es su facturación anual estimada?</legend>
      <div class="chip-row">
        <input class="chip-radio" type="radio" name="facturacion" id="comparador-fact-baja" value="baja" checked>
        <label class="chip" for="comparador-fact-baja">Menos de ₲ 80.000.000</label>
        <input class="chip-radio" type="radio" name="facturacion" id="comparador-fact-media" value="media">
        <label class="chip" for="comparador-fact-media">₲ 80.000.000 a ₲ 2.000.000.000</label>
        <input class="chip-radio" type="radio" name="facturacion" id="comparador-fact-alta" value="alta">
        <label class="chip" for="comparador-fact-alta">Más de ₲ 2.000.000.000</label>
      </div>
    </fieldset>

    <fieldset class="field">
      <legend>¿Quiere separar su patrimonio personal del de la empresa?</legend>
      <div class="chip-row">
        <input class="chip-radio" type="radio" name="patrimonio" id="comparador-patrimonio-si" value="separar" checked>
        <label class="chip" for="comparador-patrimonio-si">Sí, es importante</label>
        <input class="chip-radio" type="radio" name="patrimonio" id="comparador-patrimonio-no" value="no_importa">
        <label class="chip" for="comparador-patrimonio-no">No es prioridad</label>
      </div>
    </fieldset>

    <div class="btn-row">
      <button class="btn btn--primary" type="submit">Ver recomendación</button>
    </div>
  </form>

  <div class="tool-result" id="comparador-result" hidden aria-live="polite">
    <h2 class="card-title" id="comparador-result-title"></h2>
    <p class="note" id="comparador-result-text"></p>
    <div class="btn-row mt-3">
      <button class="btn btn--secondary" type="button" id="comparador-use-result"><?= e(ui('tools.use_result')) ?></button>
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
