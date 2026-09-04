<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'como-se-calcula-el-aguinaldo-en-paraguay';

$sections = [
    [
        'h2'   => '¿Qué es el aguinaldo y quién lo cobra?',
        'body' => [
            'El aguinaldo, también llamado décimo tercer salario, es una remuneración adicional que '
                . 'todo empleador debe pagar una vez al año a cada trabajador en relación de dependencia. '
                . 'No depende del tipo de contrato ni de la antigüedad: un empleado con un mes de antigüedad '
                . 'tiene derecho al aguinaldo igual que uno con diez años, aunque el monto sea distinto '
                . 'porque se calcula sobre lo efectivamente trabajado en el año.',
            'La obligación alcanza a toda empresa que tenga al menos un trabajador dependiente, sin '
                . 'importar su tamaño o su régimen tributario. Es un derecho laboral, no un beneficio '
                . 'discrecional, y su liquidación incorrecta o su pago fuera de plazo puede derivar en '
                . 'reclamos ante el Ministerio de Trabajo.',
        ],
    ],
    [
        'h2'   => 'La fórmula: cómo se calcula el aguinaldo',
        'body' => [
            'El cálculo parte de un principio simple: se suman todas las remuneraciones percibidas por '
                . 'el trabajador durante el año calendario (de enero a diciembre) y ese total se divide '
                . 'entre doce.',
            'El punto donde más se equivocan las liquidaciones caseras es la base del cálculo. La ley '
                . 'toma la totalidad de lo percibido —sueldo básico, horas extra, comisiones y '
                . 'bonificaciones habituales— y no solamente el sueldo del mes de diciembre. Si el sueldo '
                . 'del trabajador varió durante el año, ya sea porque tuvo un aumento, cobró comisiones '
                . 'variables o hizo horas extra en algunos meses, el aguinaldo tiene que reflejar esa '
                . 'variación real, no un promedio estimado a ojo.',
        ],
    ],
    [
        'h2'   => 'Ejemplo con sueldo fijo todo el año',
        'body' => [
            'El caso más simple es el de un trabajador con el mismo sueldo básico los doce meses del año. '
                . 'Si su sueldo mensual fue de Gs. 3.000.000 durante todo el año, la suma de lo percibido '
                . 'es Gs. 36.000.000. Dividido entre doce, el aguinaldo es Gs. 3.000.000: exactamente un '
                . 'sueldo mensual, que es lo que se espera intuitivamente cuando no hubo cambios en el año.',
        ],
    ],
    [
        'h2'   => 'Ejemplo con sueldo variable',
        'body' => [
            'La cuenta cambia cuando el sueldo no fue el mismo todos los meses. Suponga un trabajador que '
                . 'cobró Gs. 2.800.000 durante los primeros seis meses del año y Gs. 3.200.000 en los '
                . 'seis restantes, tras un aumento. La suma de lo percibido es Gs. 36.000.000 (6 × '
                . 'Gs. 2.800.000 más 6 × Gs. 3.200.000), y el aguinaldo vuelve a ser Gs. 3.000.000: el '
                . 'promedio real de lo cobrado en el año, no el último sueldo ni el primero.',
            'Si además cobró comisiones variables o horas extra en meses puntuales, esos montos también '
                . 'entran a la suma anual antes de dividir entre doce. Ignorarlos es el error más frecuente '
                . 'en las liquidaciones que revisamos: subestima el aguinaldo y deja a la empresa expuesta '
                . 'a un reclamo por diferencia.',
        ],
    ],
    [
        'h2'   => 'Aguinaldo proporcional: cuando no se trabajó el año completo',
        'body' => [
            'Un trabajador que ingresó, renunció o fue desvinculado durante el año no pierde el derecho al '
                . 'aguinaldo: lo cobra en forma proporcional a los meses efectivamente trabajados. La '
                . 'fórmula es la misma —suma de lo percibido dividido entre doce— solo que la suma abarca '
                . 'únicamente los meses en los que hubo relación laboral.',
            'Por ejemplo, un trabajador que ingresó en julio y cobró Gs. 3.000.000 mensuales durante los '
                . 'seis meses restantes del año percibió en total Gs. 18.000.000. Ese monto, dividido entre '
                . 'doce, da un aguinaldo proporcional de Gs. 1.500.000: la mitad de un sueldo, porque '
                . 'trabajó la mitad del año. El mismo criterio se aplica en la liquidación final cuando el '
                . 'contrato termina antes de fin de año.',
        ],
    ],
    [
        'h2'   => '¿Cuándo se paga el aguinaldo?',
        'body' => [
            'El plazo legal es hasta el 31 de diciembre de cada año. Si la relación laboral termina antes '
                . 'de esa fecha, el aguinaldo proporcional se liquida junto con el resto de la liquidación '
                . 'final del trabajador, sin esperar a fin de año.',
            'En general, el aguinaldo está exceptuado del aporte obrero del 9 % al IPS, a diferencia del '
                . 'sueldo mensual. Si su empresa tiene un régimen especial de aportes, conviene confirmar '
                . 'este punto antes de liquidar, porque una excepción mal aplicada también genera diferencias '
                . 'que hay que corregir después.',
        ],
    ],
    [
        'h2'   => 'Qué pasa cuando el cálculo sale mal',
        'body' => [
            'Un aguinaldo mal calculado no siempre se nota de inmediato. El problema típico aparece meses '
                . 'después, cuando el trabajador compara lo que cobró con lo que efectivamente percibió '
                . 'durante el año y detecta una diferencia, o cuando una inspección del Ministerio de '
                . 'Trabajo revisa las liquidaciones de varios períodos a la vez. En ambos casos, corregir '
                . 'un aguinaldo de un año anterior es más costoso —en tiempo y en plata— que calcularlo '
                . 'bien la primera vez.',
            'Para una empresa con varios empleados y sueldos que varían por comisiones, horas extra o '
                . 'aumentos a mitad de año, llevar esta cuenta a mano en una planilla suelta es donde '
                . 'suelen aparecer los errores: un mes olvidado, una comisión que no se sumó, un empleado '
                . 'que ingresó a mitad de año y quedó calculado como si hubiera trabajado el año completo. '
                . 'Integrar el cálculo del aguinaldo dentro de la liquidación mensual de nómina, en lugar '
                . 'de tratarlo como un cálculo aparte de fin de año, es lo que evita este tipo de errores '
                . 'de forma sistemática, no solo en el mes en que alguien se acuerda de revisarlo.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Todos los trabajadores tienen derecho al aguinaldo?',
        'a' => 'Sí. Todo trabajador en relación de dependencia lo cobra, sin importar el tipo de contrato '
             . 'ni la antigüedad. Quien no completó el año calendario lo cobra en forma proporcional a los '
             . 'meses trabajados, como se explica arriba.',
    ],
    [
        'q' => '¿El aguinaldo paga aporte al IPS?',
        'a' => 'En general el aguinaldo está exceptuado del aporte obrero del 9 % al IPS, a diferencia del '
             . 'sueldo mensual. Confirme su caso particular con nosotros si su empresa tiene un régimen '
             . 'especial de aportes.',
    ],
    [
        'q' => '¿Qué pasa si la empresa paga el aguinaldo después del 31 de diciembre?',
        'a' => 'El pago fuera de plazo expone a la empresa a un reclamo laboral por parte del trabajador y '
             . 'a una eventual intervención del Ministerio de Trabajo. Liquidarlo con anticipación, sobre '
             . 'los sueldos reales del año, evita tanto el atraso como los recálculos de último momento.',
    ],
];

$toolLink = [
    [
        'path'  => '/herramientas/calculadora-aguinaldo/',
        'label' => 'Calcule su aguinaldo',
        'text'  => 'Cargue sus salarios y obtenga el monto en guaraníes, con el aguinaldo proporcional '
                 . 'ya calculado si no trabajó el año completo.',
    ],
    [
        'path'  => '/herramientas/liquidacion-de-salario/',
        'label' => 'Calculadora de liquidación de salario',
        'text'  => 'Si además dejó su empleo, calcule el finiquito completo: salario, vacaciones y '
                 . 'aguinaldo proporcionales, preaviso e indemnización si corresponde.',
    ],
];

require ROOT_DIR . '/templates/article.php';
