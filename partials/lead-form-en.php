<?php
/**
 * The lead form for the /en/ section (plan §6.8.1, C5). Posts to the same
 * /enviar.php as every other form on the site — its contract is locked (plan
 * §4.7) and nothing here changes it.
 *
 * A new, additive file rather than a reuse of the locked partials/lead-form.php,
 * for one concrete reason: that partial's "¿Qué necesita?" chip fieldset reads
 * `content/ui')['needs']` directly (not through ui()), so it always renders
 * Spanish chip labels regardless of UI_LANG — a partial-language leak that
 * cannot be fixed without editing the locked file. The /en/ section also has
 * exactly one persona (a foreign founder), so a needs selector adds nothing:
 * every /en/ form is preset to `service=empresas-extranjeras` (tier A per
 * content/lead-values.php) and carries `lang=en` as an extra field enviar.php
 * does not read but degrades gracefully on (plan §6.8.1) — English leads are
 * told apart in logs/leads.log by `form_id=contacto-en` instead, a field
 * enviar.php already accepts and logs (`fields.formulario`).
 *
 * Same field names, honeypot, idempotency key and UTM passthrough as
 * partials/lead-form.php, so enviar.php needs no change at all.
 */

declare(strict_types=1);

$formId      = 'contacto-en';
$formService = 'empresas-extranjeras';
$formLead    = lead_value($formService);
$formTier    = (string) $formLead['tier'];
$sourcePage  = $page['path'] ?? '/en/contact/';
$whatsapp    = whatsapp_link($formLead['whatsappText']);
$idempotencyKey = bin2hex(random_bytes(16));
$utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'gclid', 'fbclid'];
?>
<form class="lead-form" action="/enviar.php" method="post" data-lead-form
      data-whatsapp="<?= e($whatsapp ?? '') ?>">

  <h2 class="card-title"><?= e(ui('form.legend')) ?></h2>

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
  <input type="hidden" name="service" value="<?= e($formService) ?>">
  <input type="hidden" name="value_tier" value="<?= e($formTier) ?>">
  <input type="hidden" name="need" value="apertura">
  <!-- Not part of enviar.php's contract; an extra field it silently ignores
       (plan §6.8.1). form_id=contacto-en above is what actually distinguishes
       an English lead in logs/leads.log. -->
  <input type="hidden" name="lang" value="en">
  <input type="hidden" name="tool_result" value="">
  <?php foreach ($utmKeys as $key): ?>
    <?php if (!empty($_GET[$key]) && is_string($_GET[$key])): ?>
      <input type="hidden" name="<?= e($key) ?>" value="<?= e(substr($_GET[$key], 0, 200)) ?>">
    <?php endif; ?>
  <?php endforeach; ?>

  <button class="btn btn--primary" type="submit" data-submit
          data-sending="<?= e(ui('form.sending')) ?>"><?= e(ui('form.submit')) ?></button>

  <p class="note">
    <?= e(ui('form.privacy_note')) ?>
  </p>

  <?php
    $thanksLead   = $formLead;
    $thanksHidden = true;
    $thanksAttrs  = 'data-form-ok tabindex="-1"';
    require ROOT_DIR . '/partials/lead-thanks.php';
  ?>

  <p class="form-status form-status--error" data-form-error hidden role="alert">
    <strong><?= e(ui('form.error_title')) ?></strong>
    <?= e(ui('form.error_text')) ?>
  </p>
</form>
<?php
unset(
    $formId, $formService, $formLead, $formTier, $sourcePage, $whatsapp,
    $idempotencyKey, $utmKeys, $key
);
