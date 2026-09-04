<?php
/**
 * Firm facts. Everything the site says about itself comes from here.
 *
 * RULE (plan §1.4): no fabricated facts. A value Anton has not confirmed stays
 * null / empty, and the partial that would show it hides instead or falls back
 * to neutral phrasing. Never a placeholder number, never a demo name.
 *
 * The nulls below are the items still open in plan §7 (human-inputs checklist).
 * Filling one in here switches the matching UI on everywhere at once — the
 * WhatsApp button, the footer NAP, the JSON-LD, the contact page.
 */

declare(strict_types=1);

return [
    // --- identity -----------------------------------------------------------
    'name'        => 'Contador.com.py',
    'legalName'   => null,                       // §7: firm legal name
    'description' => 'Estudio contable en Asunción: contabilidad, impuestos, '
                   . 'nómina, apertura de empresas y facturación electrónica.',

    // --- contact (§7: WhatsApp/phone confirmed 2026-09-04; email pending) ---------------------------------------------
    // 'phone' and 'whatsapp' in international form, e.g. '+595 981 123 456'.
    // While both are null the header pill, the floating button and every
    // service CTA point at /contacto/ instead of wa.me. See partials/whatsapp-fab.php.
    'phone'    => '+595 995 628 862',
    'whatsapp' => '+595 995 628 862',
    'email'    => null,

    // --- address (§7: "Edificio Skytower, Asunción" unconfirmed, scan §6.3) --
    'street'  => null,
    'city'    => 'Asunción',
    'country' => 'Paraguay',
    'hours'   => null,                           // display string, e.g. 'Lun–Vie 8:00–17:30'

    // schema.org openingHoursSpecification entries, added when hours are confirmed
    'openingHours' => [],

    // --- credentials and scale (§7: pending) --------------------------------
    'matricula'   => null,                       // matrícula number(s)
    'foundedYear' => null,                       // int — drives the "N años" badge in A2
    'teamSize'    => null,                       // int

    // --- imagery (§7 / plan §6.4.1: B4 supplies the files) -------------------
    // While these are null the homepage "Quiénes somos" slots render as neutral
    // decorative panels — never a broken image, never a captioned identity claim.
    'photos' => [
        'portrait' => null,                      // ['src' => '/assets/img/...', 'alt' => '...']
        'team'     => null,
    ],

    // --- collections: every one of these renders only when non-empty ---------
    'socials'      => [],                        // ['https://www.facebook.com/...', ...]
    'stats'        => [],                        // [['value' => '100 %', 'label' => '...'], ...]
    'testimonials' => [],                        // [['quote','name','business','city','since'], ...]
    'team'         => [],                        // [['name','role','credentials','photo'], ...]
    'credentials'  => [],                        // ['Contadores públicos matriculados', ...]
];
