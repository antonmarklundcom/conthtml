<?php
/**
 * Site header: wordmark, primary nav with the Servicios mega-menu, and the two
 * action pills. Every link comes from content/nav.php — B-phases add links by
 * extending that file, never by editing this partial (plan §4.13, §4.7).
 *
 * The mega panel is plain markup that assets/js/site.js hides on load, so a
 * visitor without JS still gets all 14 service links.
 */

declare(strict_types=1);

/* An include shares the scope of whatever required it, so every local in this
   partial is prefixed to avoid shadowing a caller's variable — $service in
   templates/service.php was a real casualty of getting this wrong. */
$navCurrentPath = $page['path'] ?? '/';
$navWhatsapp    = whatsapp_link(ui('cta.consult'));
?>
<header class="site-header" data-header>
  <div class="container site-header__bar">

    <a class="wordmark" href="/">
      <span class="wordmark__mark" aria-hidden="true"></span>
      <span class="wordmark__text">contador.com.py</span>
    </a>

    <button class="nav-toggle" type="button"
            data-nav-toggle
            aria-expanded="false"
            aria-controls="site-nav"
            data-label-open="<?= e(ui('nav.menu')) ?>"
            data-label-close="<?= e(ui('nav.close')) ?>"><?= e(ui('nav.menu')) ?></button>

    <div class="site-header__nav" id="site-nav" data-nav>
      <ul class="site-nav">
        <?php foreach (nav('primary') as $navItem): ?>
          <?php if (!empty($navItem['mega'])): ?>
            <li>
              <button type="button" data-mega-toggle aria-expanded="true" aria-controls="mega-servicios">
                <?= e($navItem['label']) ?>
                <span class="site-nav__caret" aria-hidden="true"></span>
              </button>

              <div class="mega" id="mega-servicios" data-mega>
                <?php foreach (nav('mega') as $navCluster): ?>
                  <?php if ($navCluster['items'] === []) { continue; } ?>
                  <div>
                    <p class="mega__col-title"><?= e($navCluster['label']) ?></p>
                    <ul>
                      <?php foreach ($navCluster['items'] as $navService): ?>
                        <li<?= $navService['parent'] ? ' data-child' : '' ?>>
                          <a href="<?= e($navService['path']) ?>"
                             <?= is_current($navService['path'], $navCurrentPath) ? 'aria-current="page"' : '' ?>><?= e($navService['label']) ?></a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                <?php endforeach; ?>
                <div class="mega__foot">
                  <a href="<?= e($navItem['path']) ?>"><?= e(ui('nav.all_services')) ?> →</a>
                </div>
              </div>
            </li>
          <?php else: ?>
            <li>
              <a href="<?= e($navItem['path']) ?>"
                 <?= is_current($navItem['path'], $navCurrentPath) ? 'aria-current="page"' : '' ?>><?= e($navItem['label']) ?></a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>

      <div class="nav-drawer-cta">
        <a class="btn btn--whatsapp" href="<?= e($navWhatsapp ?? '/contacto/') ?>"<?= $navWhatsapp ? ' rel="noopener"' : '' ?>>
          <?= e($navWhatsapp ? ui('cta.whatsapp_long') : ui('cta.contact')) ?>
        </a>
        <a class="btn btn--primary" href="/contacto/"><?= e(ui('cta.quote')) ?></a>
      </div>
    </div>

    <div class="site-header__actions">
      <a class="btn btn--secondary" href="<?= e($navWhatsapp ?? '/contacto/') ?>"<?= $navWhatsapp ? ' rel="noopener"' : '' ?>>
        <?= e($navWhatsapp ? ui('cta.whatsapp') : ui('cta.contact')) ?>
      </a>
      <a class="btn btn--primary" href="/contacto/"><?= e(ui('cta.quote')) ?></a>
    </div>

  </div>
</header>
