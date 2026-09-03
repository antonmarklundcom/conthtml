<?php
/**
 * The floating WhatsApp action. ONE element only: a round pill bottom-right on
 * desktop, a full-width sticky bar at <= 768px — the CSS reshapes it, so a page
 * never shows both (plan §5.1.3).
 *
 * Until content/site.php has a WhatsApp number (plan §7, still pending) it
 * keeps its shape and colour but points at /contacto/ and says "Contactar":
 * degrade, never invent a number (plan §1.4, §4.5).
 *
 * Locked for B-phases (plan §4.7).
 */

declare(strict_types=1);

$link  = whatsapp_link(ui('cta.consult'));
$label = $link ? ui('cta.whatsapp_long') : ui('cta.contact');
?>
<a class="wa-fab" href="<?= e($link ?? '/contacto/') ?>"<?= $link ? ' rel="noopener"' : '' ?>>
  <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
    <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.9 9.9 0 0 0 4.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91C21.96 6.45 17.5 2 12.04 2Zm5.8 14.06c-.24.68-1.4 1.3-1.94 1.35-.5.05-.95.23-3.2-.67-2.7-1.06-4.4-3.8-4.53-3.98-.13-.18-1.08-1.44-1.08-2.75 0-1.3.68-1.95.93-2.21.24-.27.53-.33.7-.33.18 0 .35 0 .5.01.16.01.38-.06.6.46.23.55.77 1.9.84 2.03.07.14.11.3.02.48-.09.18-.13.29-.27.44-.13.16-.28.35-.4.47-.13.13-.27.28-.12.54.15.27.67 1.1 1.44 1.79.99.88 1.82 1.16 2.08 1.29.26.13.41.11.56-.07.15-.18.65-.76.82-1.02.18-.27.35-.22.59-.13.24.09 1.53.72 1.79.85.26.13.44.2.5.31.07.11.07.63-.17 1.31Z"/>
  </svg>
  <span><?= e($label) ?></span>
</a>
