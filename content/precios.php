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
        'includes' => [
            'Libro de compras y ventas al día',
            'Declaración jurada de IVA (Formulario 120) mensual',
            'Presentación anual de su régimen (Resimple, IRE Simple o IRP)',
            'Un contador asignado, no una mesa de entrada',
        ],
        'featured' => false,
    ],
    [
        'name'     => 'Pyme',
        'audience' => 'Empresas con nómina y movimiento mensual constante.',
        'priceGs'  => null,
        'includes' => [
            'Todo lo del plan Emprendedor',
            'Liquidación de nómina, aguinaldo y aportes IPS',
            'Conciliaciones y estados financieros mensuales',
            'Alertas de vencimientos por RUC y control de su Certificado de Cumplimiento Tributario',
        ],
        'featured' => true,
    ],
    [
        'name'     => 'Empresa',
        'audience' => 'Operaciones con varias sucursales, importación o auditoría.',
        'priceGs'  => null,
        'includes' => [
            'Todo lo del plan Pyme',
            'Contabilidad consolidada de varias sucursales o rubros',
            'Coordinación con auditoría impositiva, interna o externa',
            'Asesoría tributaria dedicada para decisiones de inversión y crecimiento',
        ],
        'featured' => false,
    ],
];
