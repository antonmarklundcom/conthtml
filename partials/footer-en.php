<?php
/**
 * Site footer for the /en/ section only (plan §6.8.2, C5) — same reasoning as
 * partials/header-en.php: a new, additive file rather than an edit to the
 * locked partials/footer.php, because the reduced English nav needs English
 * paths the Spanish 'primary'/'firm' trees do not carry. Same markup classes
 * as the Spanish footer.
 */

declare(strict_types=1);
?>
<footer class="site-footer">
  <div class="container">
    <div class="site-footer__cols">

      <div>
        <a class="wordmark wordmark--sm" href="/en/">
          <span class="wordmark__mark" aria-hidden="true"></span>
          <span class="wordmark__text">contador.com.py</span>
        </a>
        <p class="site-footer__blurb mt-3"><?= e(ui('footer.blurb')) ?></p>
      </div>

      <div>
        <h2><?= e(ui('nav.services')) ?></h2>
        <ul>
          <?php foreach (nav('primary_en') as $footEnItem): ?>
            <li><a href="<?= e($footEnItem['path']) ?>"><?= e($footEnItem['label']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <h2><?= e(ui('footer.contact')) ?></h2>
        <ul>
          <?php if (site('phone')): ?>
            <li><a href="tel:+<?= e(phone_digits(site('phone'))) ?>"><?= e(site('phone')) ?></a></li>
          <?php endif; ?>
          <?php if (site('email')): ?>
            <li><a href="mailto:<?= e(site('email')) ?>"><?= e(site('email')) ?></a></li>
          <?php endif; ?>
          <li><a href="/en/contact/"><?= e(ui('nav.contact')) ?></a></li>
          <li><a href="/">Sitio en español</a></li>
        </ul>
      </div>

    </div>

    <div class="site-footer__legal">
      <span>&copy; <?= date('Y') ?> <?= e(site('name')) ?>. <?= e(ui('footer.rights')) ?></span>
      <a href="/privacidad/">Privacy</a>
      <a href="/terminos/">Terms</a>
    </div>
  </div>
</footer>

<?php require ROOT_DIR . '/partials/whatsapp-fab-en.php'; ?>

<script src="<?= e(asset('/assets/js/analytics.js')) ?>" defer></script>
<script src="<?= e(asset('/assets/js/site.js')) ?>" defer></script>
<script src="<?= e(asset('/assets/js/lead-form.js')) ?>" defer></script>
</body>
</html>
