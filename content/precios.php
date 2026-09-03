<?php
/**
 * Pricing plans (plan §1.10). Prices are shown only when §7 supplies real
 * guaraní numbers: until then each plan lists its scope and the CTA is a
 * quotation. Never USD, never a placeholder figure.
 *
 *   name      string   plan name
 *   audience  string   who it is for, one line
 *   priceGs   ?int     monthly price in whole guaraníes, or null to hide
 *   includes  string[] scope lines
 *   featured  bool     highlighted card
 *
 * B2 writes the page; the numbers stay null until Anton confirms them.
 */

declare(strict_types=1);

return [
    [
        'name'     => 'Emprendedor',
        'audience' => 'Unipersonales y profesionales independientes.',
        'priceGs'  => null,
        'includes' => [],
        'featured' => false,
    ],
    [
        'name'     => 'Pyme',
        'audience' => 'Empresas con nómina y movimiento mensual constante.',
        'priceGs'  => null,
        'includes' => [],
        'featured' => true,
    ],
    [
        'name'     => 'Empresa',
        'audience' => 'Operaciones con varias sucursales, importación o auditoría.',
        'priceGs'  => null,
        'includes' => [],
        'featured' => false,
    ],
];
