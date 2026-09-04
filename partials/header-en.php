<?php
/**
 * Site header for the /en/ section only (plan §6.8.2, C5) — English strings
 * and the reduced nav (Services, Open a company, Taxes, Contact) from
 * content/nav.php's 'primary_en' key.
 *
 * A NEW, additive file, not an edit to the locked partials/header.php (plan
 * §4.7): that partial renders content/nav.php's Spanish 'primary' tree with
 * paths into the Spanish site, which a reduced English nav cannot reuse
 * without also carrying English-only paths — so every /en/ route requires
 * this file instead of partials/header.php. Same markup classes
 * (site-header, wordmark, site-nav, btn--*) as the Spanish header, so
 * assets/css/site.css needs no new rules.
 */

declare(strict_types=1);

$navCurrentPath = $page['path'] ?? '/en/';
$navWhatsapp    = whatsapp_link(whatsapp_text_for_page());
?>
<header class="site-header" data-header>
  <div class="container site-header__bar">

    <a class="wordmark" href="/en/">
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
        <?php foreach (nav('primary_en') as $navItem): ?>
          <li>
            <a href="<?= e($navItem['path']) ?>"
               <?= is_current($navItem['path'], $navCurrentPath) ? 'aria-current="page"' : '' ?>><?= e($navItem['label']) ?></a>
          </li>
        <?php endforeach; ?>
        <li><a href="/">Español</a></li>
      </ul>

      <div class="nav-drawer-cta">
        <a class="btn btn--whatsapp" href="<?= e($navWhatsapp ?? '/en/contact/') ?>" rel="noopener">
          <?= e($navWhatsapp ? ui('cta.whatsapp_long') : ui('cta.contact')) ?>
        </a>
        <a class="btn btn--primary" href="/en/contact/"><?= e(ui('cta.quote')) ?></a>
      </div>
    </div>

    <div class="site-header__actions">
      <a class="btn btn--secondary" href="<?= e($navWhatsapp ?? '/en/contact/') ?>" rel="noopener">
        <?= e($navWhatsapp ? ui('cta.whatsapp') : ui('cta.contact')) ?>
      </a>
      <a class="btn btn--primary" href="/en/contact/"><?= e(ui('cta.quote')) ?></a>
    </div>

  </div>
</header>
