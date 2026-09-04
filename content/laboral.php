<?php
/**
 * Labour-law rule tables for the aguinaldo and liquidación/finiquito
 * calculators (plan §6.3.1b, §6.3.1c). Every figure here is a rate or a
 * legal tier, not a client fact, so it is safe to keep in content/ rather
 * than hand-typing it into two JS files that could drift apart — the JS
 * calculators mirror these numbers exactly (see assets/js/tools/*.js) and
 * both the PHP copy and the JS logic must be updated together.
 *
 * lastReviewed is shown on every calculator page next to the "orientativo"
 * disclaimer the plan requires (plan §6.3): these are Paraguayan Código del
 * Trabajo figures, sourced during B3 (docs/facts-to-verify.md), not the
 * firm's own numbers, and they change only when the law changes.
 */

declare(strict_types=1);

return [

    'lastReviewed' => '2026-09-04',

    // Ley Nº 417 / Art. 243 Código del Trabajo: el aguinaldo equivale a la
    // doceava parte de las remuneraciones devengadas durante el año civil,
    // y se abona antes del 31 de diciembre (o al terminar la relación
    // laboral, si eso ocurre antes).
    'aguinaldo' => [
        'divisor'  => 12,
        'deadline' => 'antes del 31 de diciembre de cada año, o al finalizar la relación laboral si esto ocurre antes',
        'source'   => 'Ley Nº 417/1973 y Art. 243 del Código del Trabajo (Ley Nº 213/1993)',
        'ipsExempt' => true, // en general — ver nota de confianza en docs/facts-to-verify.md
    ],

    // Aporte IPS al régimen general de trabajadores dependientes (ya usado
    // en /ips/): 9 % obrero, 16,5 % patronal, sobre el salario y otros
    // conceptos remunerativos.
    'ips' => [
        'obrero'   => 0.09,
        'patronal' => 0.165,
    ],

    // Art. 218 Código del Trabajo: días de vacaciones según antigüedad.
    // Los rangos son "hasta 5 años", "más de 5 y hasta 10", "más de 10".
    'vacaciones' => [
        ['hastaAnios' => 5,   'dias' => 12],
        ['hastaAnios' => 10,  'dias' => 18],
        ['hastaAnios' => null, 'dias' => 30],
    ],

    // Art. 87 Código del Trabajo: días de preaviso según antigüedad, a
    // cargo de quien despide sin causa justificada.
    'preaviso' => [
        ['hastaAnios' => 1,    'dias' => 30],
        ['hastaAnios' => 5,    'dias' => 45],
        ['hastaAnios' => 10,   'dias' => 60],
        ['hastaAnios' => null, 'dias' => 90],
    ],

    // Art. 91 Código del Trabajo: indemnización por despido sin causa
    // justificada — 15 salarios diarios por cada año de servicio o
    // fracción superior a seis meses.
    'indemnizacion' => [
        'diasPorAnio'        => 15,
        'fraccionMinimaMeses' => 6,
    ],

    // Convención de liquidación: el mes se toma como 30 días para calcular
    // el salario diario y los proporcionales, tal como lo hace la práctica
    // de nómina paraguaya habitual.
    'diasPorMes' => 30,
];
