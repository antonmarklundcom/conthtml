<?php
/**
 * Renders one /en/ page from content/en.php (plan §6.8, C5). Every
 * /en/<slug>/index.php (and /en/index.php for the hub) is:
 *
 *     define('UI_LANG', 'en');
 *     $slug = '...';
 *     require ROOT_DIR . '/templates/en-page.php';
 *
 * after the usual `require __DIR__.'/../lib/bootstrap.php';` first line — the
 * same three/four-line route-file discipline templates/service.php,
 * templates/guide.php and templates/segment.php use (plan §4.7's precedent
 * for a new, additive template).
 *
 * UI_LANG must be defined BEFORE lib/helpers.php's ui() is first called on
 * this request — every /en/ route file does that immediately after bootstrap,
 * before this template runs. The Spanish site never defines it, so ui() and
 * every page that predates C5 render exactly as before this file existed.
 *
 * partials/head.php, breadcrumbs.php, faq.php, cta-band.php and
 * lead-thanks.php are reused unmodified — they already resolve every string
 * through ui(), so they render in English here for free. Only
 * partials/header.php and partials/footer.php are NOT reused (they render
 * content/nav.php's Spanish 'primary' tree, whose paths lead back into the
 * Spanish site) — partials/header-en.php and partials/footer-en.php replace
 * them, additive new files, per plan §6.8.2.
 */

declare(strict_types=1);

if (!defined('UI_LANG')) {
    define('UI_LANG', 'en');
}

/** @var string $slug */
$enRecord = content('en')[$slug ?? ''] ?? null;

if ($enRecord === null) {
    http_response_code(404);
    require ROOT_DIR . '/404.php';
    return;
}

/* Every /en/ page (including the hub) is preset to the one English-speaking
   lead-values record: a foreign founder is tier A regardless of which page
   they came from (docs/lead-value.md: "Foreign founders are the highest
   ticket of all"). */
$enLeadSlug = 'empresas-extranjeras';

$page = [
    'title'       => $enRecord['seoTitle'],
    'description' => $enRecord['metaDescription'],
    'path'        => $enRecord['path'],
    'lang'        => 'en',
    'hreflang'    => [
        'es'         => $enRecord['hreflangEs'],
        'en'         => $enRecord['path'],
        'x-default'  => $enRecord['hreflangEs'],
    ],
    'breadcrumbs' => $enRecord['kind'] === 'hub'
        ? []
        : [
            ['label' => 'For foreign founders', 'path' => '/en/'],
            ['label' => $enRecord['navLabel'],   'path' => $enRecord['path']],
        ],
    'faq'      => $enRecord['faq'],
    'leadSlug' => $enLeadSlug,
];

require ROOT_DIR . '/partials/head.php';
require ROOT_DIR . '/partials/header-en.php';
?>
<main id="main">

  <?php $enHeroImage = $enRecord['heroImage'] ?? null; ?>
  <section class="page-hero<?= $enHeroImage ? ' page-hero--photo' : '' ?>">
    <div class="container">
      <?php if ($enRecord['kind'] !== 'hub'): ?>
        <?php require ROOT_DIR . '/partials/breadcrumbs.php'; ?>
      <?php endif; ?>
      <div class="page-hero__grid">
        <div class="page-hero__inner">
          <p class="eyebrow"><?= e($enRecord['hero']['eyebrow']) ?></p>
          <h1><?= e($enRecord['hero']['h1']) ?></h1>
          <p class="lead"><?= e($enRecord['hero']['lead']) ?></p>
          <?php if ($enRecord['path'] !== '/en/contact/'): ?>
            <div class="btn-row">
              <a class="btn btn--primary" href="/en/contact/"><?= e(ui('cta.consult')) ?></a>
              <?php if (($enWa = whatsapp_link(whatsapp_text_for_page($page))) !== null): ?>
                <a class="btn btn--secondary" href="<?= e($enWa) ?>" rel="noopener"><?= e(ui('cta.whatsapp')) ?></a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
        <?php if ($enHeroImage): ?>
          <img class="page-hero__photo" src="<?= e(asset($enHeroImage['src'])) ?>"
               alt="<?= e($enHeroImage['alt']) ?>" loading="lazy" width="800" height="600">
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php if ($enRecord['highlights'] !== []): ?>
    <section class="section">
      <div class="container">
        <ul class="checklist mt-4">
          <?php foreach ($enRecord['highlights'] as $enHighlight): ?>
            <li><span><?= e($enHighlight) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($enRecord['kind'] === 'hub'): ?>
    <section class="section section--surface">
      <div class="container">
        <h2>Where to start</h2>
        <div class="grid grid--3 mt-4">
          <?php foreach (content('en') as $enOtherSlug => $enOther): ?>
            <?php if ($enOther['kind'] === 'hub') { continue; } ?>
            <a class="card card--link" href="<?= e($enOther['path']) ?>">
              <h3 class="card-title"><?= e($enOther['navLabel']) ?></h3>
              <p class="card__text"><?= e($enOther['hero']['lead']) ?></p>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php $enBand = 1; /* the highlights/hub band above already used index 0 */ ?>
  <?php foreach ($enRecord['sections'] as $enSection): ?>
    <section class="section<?= $enBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container prose">
        <h2><?= e($enSection['h2']) ?></h2>
        <?php foreach ($enSection['body'] as $enParagraph): ?>
          <p><?= e($enParagraph) ?></p>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endforeach; ?>

  <?php if ($enRecord['faq'] !== []): ?>
    <section class="section<?= $enBand++ % 2 ? ' section--surface' : '' ?>">
      <div class="container">
        <?php $faqItems = $enRecord['faq']; ?>
        <?php require ROOT_DIR . '/partials/faq.php'; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($enRecord['path'] === '/en/contact/'): ?>
    <section class="section<?= $enBand % 2 ? '' : ' section--surface' ?>" id="solicitar">
      <div class="container split split--top">
        <div class="stack">
          <p class="eyebrow">Contact</p>
          <h2>Send us your details</h2>
          <p class="lead">We reply within the next business day.</p>
          <?php if (site('phone')): ?>
            <p class="note">Phone / WhatsApp: <a href="tel:+<?= e(phone_digits(site('phone'))) ?>"><?= e(site('phone')) ?></a></p>
          <?php endif; ?>
          <?php if (site('email')): ?>
            <p class="note">Email: <a href="mailto:<?= e(site('email')) ?>"><?= e(site('email')) ?></a></p>
          <?php endif; ?>
        </div>
        <div>
          <?php require ROOT_DIR . '/partials/lead-form-en.php'; ?>
        </div>
      </div>
    </section>
  <?php else: ?>
    <?php $ctaTitle = 'Ready to open your company in Paraguay?'; ?>
    <?php $ctaLead  = 'No cost, no obligation. We reply with a concrete next step within the next business day.'; ?>
    <?php $ctaContactPath = '/en/contact/'; ?>
    <?php require ROOT_DIR . '/partials/cta-band.php'; ?>
  <?php endif; ?>

</main>
<?php require ROOT_DIR . '/partials/footer-en.php'; ?>
