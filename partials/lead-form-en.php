<?php
/** English enquiries share the form behavior and keep the founder lead route. */
declare(strict_types=1);

$formId = 'contacto-en';
$formService = 'empresas-extranjeras';
$formNeed = 'apertura';
$formLang = 'en';
$formShowNeeds = false;
$formHeading = ui('form.legend');
$formSourcePage = $page['path'] ?? '/en/contact/';
require ROOT_DIR . '/partials/lead-form.php';
