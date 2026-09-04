<?php
/**
 * DNIT and IPS due-date rules for the vencimientos calculator (plan §6.3.2).
 * No scraping (plan §6.3): this is the published perpetual calendar, not a
 * live feed. lastReviewed is shown on the page next to the "orientativo"
 * disclaimer.
 */

declare(strict_types=1);

return [

    'lastReviewed' => '2026-09-04',

    // Calendario Perpetuo de Vencimientos (Resolución General Nº 38/2020,
    // que confirma el esquema de la Resolución General Nº 01/2007): cada
    // dígito final del RUC, sin contar el dígito verificador, tiene un día
    // fijo de vencimiento entre el 7 y el 25 de cada mes. Se usa para IVA
    // mensual (Formulario 120) y para las presentaciones anuales de IRE e
    // IRP dentro del mes que la DNIT fija para cada régimen.
    'calendarioPerpetuo' => [
        0 => 7,  1 => 9,  2 => 11, 3 => 13, 4 => 15,
        5 => 17, 6 => 19, 7 => 21, 8 => 23, 9 => 25,
    ],
    'calendarioSource' => 'Resolución General DNIT Nº 38/2020 (Calendario Perpetuo de Vencimientos)',

    // IRE anual (ejercicios cerrados al 31/12): la DNIT ubica la
    // presentación del Formulario 120 dentro de los primeros meses del año
    // siguiente, con el día exacto según el Calendario Perpetuo. IRE Simple
    // e IRP suelen caer en marzo; IRE General, en abril — pero el mes
    // definitivo lo fija la DNIT cada año, así que aquí se muestra como un
    // rango orientativo, no una fecha cerrada.
    'ireAnual' => [
        'meses' => [3, 4],
        'nota'  => 'El mes exacto lo confirma la DNIT cada año según su régimen (IRE Simple/IRP suelen '
                 . 'vencer en marzo, IRE General en abril); el día del mes sigue el Calendario Perpetuo.',
    ],

    // Aportes IPS (obrero-patronal): se presentan y pagan del día 1 al 10
    // del mes siguiente al periodo liquidado — no depende de la
    // terminación de RUC.
    'ipsMensual' => [
        'diaDesde' => 1,
        'diaHasta' => 10,
        'nota'     => 'Del día 1 al 10 del mes siguiente al mes liquidado, para todos los empleadores '
                    . 'por igual (no depende de la terminación de su RUC).',
    ],
];
