<?php
/**
 * A grid of service cards.
 *
 *   $gridSlugs     string[]  slugs from content/services.php, in display order
 *   $gridNumbered  bool      show the 01–06 numerals from 1B
 *   $gridStart     int       first numeral when $gridNumbered
 *
 * Cards show the service's navLabel and its metaDescription, so the grid stays
 * correct as B1 rewrites the copy.
 */

declare(strict_types=1);

/* Prefixed locals: an include shares the caller's scope (see header.php). */
$gridSlugs    = $gridSlugs ?? array_keys(services());
$gridNumbered = $gridNumbered ?? false;
$gridStart    = $gridStart ?? 1;
$gridN        = $gridStart;
?>
<div class="grid grid--3">
  <?php foreach ($gridSlugs as $gridSlug): ?>
    <?php $gridService = services($gridSlug); ?>
    <?php if ($gridService === null) { continue; } ?>
    <a class="card card--link" href="<?= e($gridService['path']) ?>">
      <?php if ($gridNumbered): ?>
        <span class="card__num" aria-hidden="true"><?= e(str_pad((string) $gridN++, 2, '0', STR_PAD_LEFT)) ?></span>
      <?php endif; ?>
      <h3 class="card-title"><?= e($gridService['navLabel']) ?></h3>
      <p class="card__text"><?= e($gridService['metaDescription']) ?></p>
    </a>
  <?php endforeach; ?>
</div>
