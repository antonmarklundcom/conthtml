<?php
/**
 * The closing "solicitar consulta" band. Reused at the foot of every service
 * page and hub.
 *
 *   $ctaTitle     string  defaults to ui('cta_band.title')
 *   $ctaLead      string  defaults to ui('cta_band.lead')
 *   $ctaWhatsapp  string  wa.me prefill text for this page
 */

declare(strict_types=1);

$ctaTitle    = $ctaTitle ?? ui('cta_band.title');
$ctaLead     = $ctaLead ?? ui('cta_band.lead');
$ctaWhatsapp = $ctaWhatsapp ?? ui('cta.consult');
$ctaLink     = whatsapp_link($ctaWhatsapp);
?>
<section class="section section--ink">
  <div class="container stack">
    <p class="eyebrow"><?= e(ui('cta_band.eyebrow')) ?></p>
    <h2 class="d2"><?= e($ctaTitle) ?></h2>
    <p class="lead"><?= e($ctaLead) ?></p>
    <div class="btn-row">
      <a class="btn btn--primary" href="/contacto/"><?= e(ui('cta.consult')) ?></a>
      <?php if ($ctaLink !== null): ?>
        <a class="btn btn--whatsapp" href="<?= e($ctaLink) ?>" rel="noopener"><?= e(ui('cta.whatsapp_long')) ?></a>
      <?php endif; ?>
    </div>
  </div>
</section>
