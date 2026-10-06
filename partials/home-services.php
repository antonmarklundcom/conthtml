<?php
/** Compact homepage directory. Every legacy service link stays crawlable. */
declare(strict_types=1);
?>
<ul class="home-services">
  <?php foreach (content('ui')['home']['cards'] as $homeServiceIndex => $homeServiceCard): ?>
    <li class="home-service">
      <span class="home-service__number" aria-hidden="true"><?= e(str_pad((string) ($homeServiceIndex + 1), 2, '0', STR_PAD_LEFT)) ?></span>
      <div class="home-service__copy">
        <h3><a href="<?= e($homeServiceCard['path']) ?>"><?= e($homeServiceCard['title']) ?></a></h3>
        <p><?= e($homeServiceCard['text']) ?></p>
        <?php if (!empty($homeServiceCard['links'])): ?>
          <ul class="home-service__links">
            <?php foreach ($homeServiceCard['links'] as $homeServiceLink): ?>
              <li><a href="<?= e($homeServiceLink['path']) ?>"><?= e($homeServiceLink['label']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <?php
        $homeServiceSlug = trim($homeServiceCard['path'], '/');
        $homeServiceWhatsapp = whatsapp_link(lead_value($homeServiceSlug)['whatsappText']);
        ?>
        <?php if ($homeServiceWhatsapp !== null): ?>
          <a class="editorial-link home-service__enquiry" href="<?= e($homeServiceWhatsapp) ?>" rel="noopener" data-service="<?= e($homeServiceSlug) ?>">Consultar por este servicio <span aria-hidden="true">&rarr;</span></a>
        <?php endif; ?>
      </div>
    </li>
  <?php endforeach; ?>
</ul>
<?php unset($homeServiceIndex, $homeServiceCard, $homeServiceLink, $homeServiceSlug, $homeServiceWhatsapp); ?>
