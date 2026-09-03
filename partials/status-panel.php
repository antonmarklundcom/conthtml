<?php
/**
 * The panel that sits at the foot of the homepage hero (the "Panel del cliente"
 * mock in 1B).
 *
 * Two deliberate departures from the mock. It shows no client name and no
 * figure — the 1B version invented "Distribuidora San Roque S.R.L.", "412
 * comprobantes" and "Lic. R. Cáceres" (plan §1.4). And it is not headed "Panel
 * del cliente": a real client portal is parked in plan §8, so a panel by that
 * name would promise a login that does not exist. It illustrates the monthly
 * report instead, and says so in its own footer.
 *
 *   $panelTitle  string  defaults to ui('panel.title')
 *   $panelTiles  array   [['label' => ..., 'value' => ...], ...]
 */

declare(strict_types=1);

$panelTitle = $panelTitle ?? ui('panel.title');
$panelTiles = $panelTiles ?? content('ui')['panel']['tiles'];
?>
<div class="status-panel">
  <div class="status-panel__head">
    <span><?= e($panelTitle) ?></span>
    <span class="badge-ok"><?= e(ui('panel.badge')) ?></span>
  </div>

  <div class="status-panel__tiles">
    <?php foreach ($panelTiles as $panelTile): ?>
      <div class="status-tile">
        <span class="status-tile__label"><?= e($panelTile['label']) ?></span>
        <span class="status-tile__value"><?= e($panelTile['value']) ?></span>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="status-panel__foot">
    <span><?= e(ui('panel.foot')) ?></span>
    <span class="status-panel__note"><?= e(ui('panel.note')) ?></span>
  </div>
</div>
<?php
unset($panelTitle, $panelTiles, $panelTile);
