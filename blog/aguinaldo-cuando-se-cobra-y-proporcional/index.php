<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'aguinaldo-cuando-se-cobra-y-proporcional';

$sections = [
    [
        'h2'   => '¿Cuándo se cobra el aguinaldo?',
        'body' => [
            'El plazo legal para pagar el aguinaldo en Paraguay es hasta el 31 de diciembre de cada año. '
                . 'No es una fecha orientativa: si la empresa lo paga después, el trabajador puede '
                . 'reclamar ante el Ministerio de Trabajo, sin importar el motivo del atraso.',
            'Muchas empresas lo pagan antes, junto con el aguinaldo escolar o el fin de año, pero la '
                . 'única fecha que la ley exige respetar es el 31 de diciembre. Cuando el vínculo laboral '
                . 'termina antes de esa fecha, el aguinaldo se liquida junto con el resto del finiquito, '
                . 'sin esperar a fin de año.',
        ],
    ],
    [
        'h2'   => '¿Cada cuánto se cobra?',
        'body' => [
            'El aguinaldo se cobra una vez al año, correspondiente al año calendario que va de enero a '
                . 'diciembre. No es un pago mensual ni trimestral: se acumula durante todo el año y se '
                . 'liquida en una sola vez, con base en la totalidad de lo percibido en esos doce meses.',
        ],
    ],
    [
        'h2'   => 'Todo trabajador tiene derecho, sin excepción por antigüedad',
        'body' => [
            'El derecho al aguinaldo no depende de cuánto tiempo lleva el trabajador en la empresa: un '
                . 'empleado con un mes de antigüedad lo cobra igual que uno con diez años, aunque el monto '
                . 'sea distinto porque se calcula sobre lo efectivamente trabajado en el año. Tampoco '
                . 'depende del tipo de contrato: alcanza por igual a un contrato indefinido y a uno a '
                . 'plazo fijo, mientras exista relación de dependencia.',
        ],
    ],
    [
        'h2'   => 'Aguinaldo proporcional: la fórmula',
        'body' => [
            'Un trabajador que no completó el año calendario —porque ingresó, renunció o fue '
                . 'desvinculado en algún momento del año— no pierde el derecho al aguinaldo: lo cobra en '
                . 'forma proporcional. La fórmula es la misma que la del aguinaldo completo (suma de lo '
                . 'percibido dividido entre doce), con la diferencia de que la suma abarca solo los meses '
                . 'en los que hubo relación laboral.',
            'Por ejemplo, un trabajador que ingresó en abril y cobró Gs. 2.500.000 mensuales durante los '
                . 'nueve meses restantes del año percibió Gs. 22.500.000 en total. Dividido entre doce, el '
                . 'aguinaldo proporcional es Gs. 1.875.000: nueve doceavas partes de un sueldo mensual, '
                . 'porque trabajó nueve de los doce meses del año.',
        ],
    ],
    [
        'h2'   => 'Sueldo variable: comisiones y horas extra también cuentan',
        'body' => [
            'La base del cálculo no se limita al sueldo básico fijo. Si el trabajador cobró comisiones '
                . 'variables por ventas, horas extra en meses puntuales o cualquier otra bonificación '
                . 'habitual, esos montos entran a la suma anual antes de dividir entre doce, igual que el '
                . 'sueldo básico. Dejarlos afuera —tratando el aguinaldo como si el trabajador solo '
                . 'hubiera cobrado su básico todo el año— subestima el monto y deja a la empresa expuesta '
                . 'a un reclamo por la diferencia.',
        ],
    ],
    [
        'h2'   => 'El error más común al calcular el proporcional',
        'body' => [
            'El error habitual es dividir el sueldo mensual entre doce y multiplicar por los meses '
                . 'trabajados, en lugar de sumar primero lo efectivamente percibido en esos meses y '
                . 'dividir después entre doce. Si el sueldo fue el mismo todos los meses, ambos caminos '
                . 'dan el mismo resultado; si hubo un aumento, comisiones variables u horas extra en '
                . 'algunos meses, el segundo camino es el único correcto, porque toma lo que el trabajador '
                . 'realmente cobró y no un promedio estimado.',
        ],
    ],
    [
        'h2'   => 'Ejemplo con un aumento a mitad de año',
        'body' => [
            'Suponga un trabajador con el año completo trabajado, que cobró Gs. 3.500.000 mensuales de '
                . 'enero a julio y Gs. 4.000.000 de agosto a diciembre, tras un aumento. La suma de lo '
                . 'percibido es Gs. 44.500.000 (7 × Gs. 3.500.000 más 5 × Gs. 4.000.000). Dividido entre '
                . 'doce, el aguinaldo es Gs. 3.708.333: ni el sueldo de enero ni el de diciembre, sino el '
                . 'promedio real de los doce meses.',
            'Calcularlo tomando solo el último sueldo del año —el error más frecuente en liquidaciones '
                . 'hechas a mano— habría dado Gs. 4.000.000, casi Gs. 300.000 de más frente al monto '
                . 'correcto. La diferencia parece pequeña en un solo caso, pero se multiplica por cada '
                . 'empleado con un aumento durante el año.',
        ],
    ],
    [
        'h2'   => 'El aporte al IPS y el aguinaldo',
        'body' => [
            'En general, el aguinaldo está exceptuado del aporte obrero del 9% al IPS, a diferencia del '
                . 'sueldo mensual ordinario. Si su empresa tiene un régimen especial de aportes, conviene '
                . 'confirmar este punto antes de liquidar: una excepción mal aplicada genera diferencias '
                . 'que después hay que corregir, con el mismo costo en tiempo que evitar el error desde el '
                . 'inicio.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Cuándo se cobra el aguinaldo en Paraguay?',
        'a' => 'Hasta el 31 de diciembre de cada año. Si la relación laboral termina antes, el aguinaldo '
             . 'proporcional se liquida junto con el resto del finiquito, sin esperar a fin de año.',
    ],
    [
        'q' => '¿Cada cuánto se paga el aguinaldo?',
        'a' => 'Una vez al año, calculado sobre el año calendario completo (enero a diciembre). No es un '
             . 'pago mensual: se acumula durante el año y se paga en una sola vez.',
    ],
    [
        'q' => '¿Cómo se calcula el aguinaldo proporcional?',
        'a' => 'Se suma lo efectivamente percibido durante los meses trabajados en el año y ese total se '
             . 'divide entre doce, igual que el aguinaldo completo. La diferencia es que la suma solo '
             . 'incluye los meses en los que hubo relación laboral, no los doce.',
    ],
    [
        'q' => '¿El aguinaldo paga aporte al IPS?',
        'a' => 'En general el aguinaldo está exceptuado del aporte obrero del 9% al IPS. Confirme su caso '
             . 'particular con nosotros si su empresa tiene un régimen especial de aportes.',
    ],
    [
        'q' => '¿Un trabajador jubilado que sigue trabajando cobra aguinaldo igual?',
        'a' => 'El régimen de un trabajador jubilado en relación de dependencia tiene particularidades '
             . 'propias que no cubre este artículo; revísela con nosotros antes de liquidar, porque no es '
             . 'exactamente el mismo cálculo que el de un trabajador activo sin jubilación.',
    ],
];

$toolLink = [
    [
        'path'  => '/herramientas/calculadora-aguinaldo/',
        'label' => 'Calcule su aguinaldo',
        'text'  => 'Cargue sus salarios y obtenga el monto en guaraníes, con el aguinaldo proporcional ya '
                 . 'calculado si no trabajó el año completo.',
    ],
];

require ROOT_DIR . '/templates/article.php';
