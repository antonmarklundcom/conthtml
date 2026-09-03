<?php
/**
 * The lead form. Posts to /enviar.php, which forwards to VenderCRM.
 *
 * Progressive enhancement (plan §5.1.8): this is an ordinary form. Without JS
 * it does a normal POST and enviar.php redirects to /contacto/?enviado=1.
 * assets/js/lead-form.js upgrades it to an inline success message.
 *
 * The "¿Qué necesita?" chips from 1B are real radio inputs behind styled
 * labels, so the selection survives with JS disabled.
 *
 * Optional variables a caller may set before requiring this partial:
 *   $formId       string  distinguishes this form in the CRM 'source' field
 *   $formNeed     string  pre-selected need key (B3's quiz uses this)
 *   $formHeading  string  visible heading, omitted when empty
 *
 * Locked for B-phases (plan §4.7).
 */

declare(strict_types=1);

$formId      = $formId ?? 'contacto';
$formNeed    = $formNeed ?? '';
$formHeading = $formHeading ?? ui('form.legend');
$sourcePage  = $page['path'] ?? '/';
$whatsapp    = whatsapp_link(ui('cta.consult'));

/* One key per rendered form: a double-click or a retry replays it and VenderCRM
   returns the original lead instead of creating a duplicate. */
$idempotencyKey = bin2hex(random_bytes(16));

$utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid'];
?>
<form class="lead-form" action="/enviar.php" method="post" data-lead-form
      data-whatsapp="<?= e($whatsapp ?? '') ?>">

  <?php if ($formHeading !== ''): ?>
    <h2 class="card-title"><?= e($formHeading) ?></h2>
  <?php endif; ?>

  <div class="lead-form__row">
    <label class="field">
      <span><?= e(ui('form.name')) ?></span>
      <input type="text" name="name" autocomplete="name" required>
    </label>
    <label class="field">
      <span><?= e(ui('form.company')) ?></span>
      <input type="text" name="company" autocomplete="organization">
    </label>
  </div>

  <div class="lead-form__row">
    <label class="field">
      <span><?= e(ui('form.phone')) ?></span>
      <input type="tel" name="phone" inputmode="tel" autocomplete="tel"
             placeholder="<?= e(ui('form.phone_hint')) ?>" required>
    </label>
    <label class="field">
      <span><?= e(ui('form.email')) ?></span>
      <input type="email" name="email" autocomplete="email">
    </label>
  </div>

  <fieldset class="field">
    <legend><?= e(ui('form.need')) ?></legend>
    <div class="chip-row">
      <?php foreach (content('ui')['needs'] as $key => $label): ?>
        <input class="chip-radio" type="radio" name="need"
               id="need-<?= e($formId . '-' . $key) ?>" value="<?= e($key) ?>"
               <?= $formNeed === $key ? 'checked' : '' ?>>
        <label class="chip" for="need-<?= e($formId . '-' . $key) ?>"><?= e($label) ?></label>
      <?php endforeach; ?>
    </div>
  </fieldset>

  <label class="field">
    <span><?= e(ui('form.message')) ?></span>
    <textarea name="message" rows="3" placeholder="<?= e(ui('form.message_hint')) ?>"></textarea>
  </label>

  <!-- Honeypot: bots fill it, humans never see it. -->
  <div class="honeypot" aria-hidden="true">
    <label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
  </div>

  <input type="hidden" name="form_id" value="<?= e($formId) ?>">
  <input type="hidden" name="source_page" value="<?= e($sourcePage) ?>">
  <input type="hidden" name="idempotency_key" value="<?= e($idempotencyKey) ?>">
  <?php foreach ($utmKeys as $key): ?>
    <?php if (!empty($_GET[$key]) && is_string($_GET[$key])): ?>
      <input type="hidden" name="<?= e($key) ?>" value="<?= e(substr($_GET[$key], 0, 200)) ?>">
    <?php endif; ?>
  <?php endforeach; ?>

  <button class="btn btn--primary" type="submit" data-submit
          data-sending="<?= e(ui('form.sending')) ?>"><?= e(ui('form.submit')) ?></button>

  <p class="note">
    <?= e(ui('form.privacy_note')) ?>
    <a href="/privacidad/"><?= e(ui('nav.privacy')) ?></a>.
  </p>

  <p class="form-status form-status--ok" data-form-ok hidden role="status">
    <strong><?= e(ui('form.success_title')) ?></strong>
    <?= e(ui('form.success_text')) ?>
    <?php if ($whatsapp !== null): ?>
      <a href="<?= e($whatsapp) ?>" rel="noopener"><?= e(ui('cta.whatsapp_long')) ?></a>.
    <?php endif; ?>
  </p>

  <p class="form-status form-status--error" data-form-error hidden role="alert">
    <strong><?= e(ui('form.error_title')) ?></strong>
    <?= e(ui('form.error_text')) ?>
  </p>
</form>
