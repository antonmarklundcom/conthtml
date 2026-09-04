<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'irp-2026-quien-paga-y-como-se-liquida';

$sections = [
    [
        'h2'   => 'Un impuesto sobre la persona, no sobre el empleador',
        'body' => [
            'El IRP no lo retiene ni lo paga su empleador por usted como una carga social más; es un '
                . 'impuesto que la persona física declara y liquida directamente ante la DNIT, sobre el '
                . 'total de sus propios ingresos del ejercicio. Un empleado que solo cobra sueldo y no '
                . 'supera los tramos que fija la ley puede no tener obligación alguna; el mismo empleado '
                . 'con honorarios adicionales de otra fuente sí puede pasar a estar alcanzado, aunque su '
                . 'sueldo principal no haya cambiado.',
        ],
    ],
    [
        'h2'   => '¿Qué es el IRP?',
        'body' => [
            'El IRP (Impuesto a la Renta Personal) grava los ingresos de las personas físicas en '
                . 'Paraguay: sueldos, honorarios profesionales, alquileres y otras rentas personales. Es '
                . 'un impuesto separado del IRE, que grava la renta de las empresas: una persona puede '
                . 'estar alcanzada por los dos al mismo tiempo, uno por sus ingresos personales y otro por '
                . 'su empresa.',
        ],
    ],
    [
        'h2'   => '¿Quién debe inscribirse y pagar?',
        'body' => [
            'El IRP alcanza a las personas físicas cuyos ingresos superan los tramos que fija la ley. Si '
                . 'su actividad combina relación de dependencia con trabajo independiente —por ejemplo, un '
                . 'sueldo fijo más honorarios por consultorías— la evaluación se hace sobre el total de '
                . 'sus ingresos del ejercicio, no sobre cada fuente por separado.',
            'Los tramos y las tasas vigentes cambian con la reglamentación, así que preferimos confirmar '
                . 'con precisión su caso concreto antes de estimar si le corresponde inscribirse, en lugar '
                . 'de arriesgar una cifra que puede haber cambiado desde la última actualización.',
        ],
    ],
    [
        'h2'   => 'Qué ingresos se suman a la base',
        'body' => [
            'La base imponible del IRP suma todas las fuentes de ingreso personal del ejercicio: sueldos, '
                . 'honorarios profesionales, alquileres percibidos y otras rentas de origen personal. No '
                . 'es un impuesto que grave una sola de esas fuentes de forma aislada; la evaluación toma '
                . 'el conjunto del año.',
        ],
    ],
    [
        'h2'   => 'Alquileres percibidos: un ingreso que se olvida con frecuencia',
        'body' => [
            'Los alquileres que una persona física recibe por una propiedad propia entran a la base del '
                . 'IRP igual que un sueldo o un honorario, y es uno de los ingresos que con más frecuencia '
                . 'se omite al calcular si corresponde inscribirse: quien alquila una propiedad no siempre '
                . 'lo relaciona con una obligación tributaria personal, hasta que la evaluación de todos '
                . 'sus ingresos del año lo pone en evidencia.',
        ],
    ],
    [
        'h2'   => 'Deducciones: qué reduce la base imponible',
        'body' => [
            'La ley permite descontar determinados gastos personales de la base imponible, siempre con '
                . 'factura legal a nombre de la persona que declara. El expediente de deducciones se arma '
                . 'mejor durante el año, guardando cada comprobante a medida que se genera el gasto, que '
                . 'en marzo con facturas ya perdidas o traspapeladas.',
        ],
    ],
    [
        'h2'   => 'El caso más frecuente: sueldo más honorarios',
        'body' => [
            'El caso que más dudas genera es el de una persona con un sueldo fijo en relación de '
                . 'dependencia que además cobra honorarios por consultorías o trabajos independientes '
                . 'fuera de su empleo principal. Ninguna de las dos fuentes se evalúa sola: la DNIT mira '
                . 'el total del ejercicio, y es ese total el que determina si corresponde inscribirse y '
                . 'declarar el IRP, no cada ingreso considerado por separado.',
        ],
    ],
    [
        'h2'   => 'Por qué conviene revisarlo antes de que la DNIT lo notifique',
        'body' => [
            'Muchos profesionales independientes descubren que les corresponde el IRP recién cuando la '
                . 'DNIT se los notifica, después de cruzar sus ingresos con los comprobantes electrónicos '
                . 'emitidos a su nombre durante el año. Llegar a ese punto sin haber armado el expediente '
                . 'de deducciones durante el ejercicio significa presentar la declaración con menos '
                . 'respaldo del que en realidad tenía derecho a usar. Revisarlo antes, con el año todavía '
                . 'en curso, permite planificar qué comprobantes guardar y decidir con tiempo si conviene '
                . 'inscribirse de forma preventiva.',
        ],
    ],
    [
        'h2'   => 'Cómo se liquida: el proceso anual',
        'body' => [
            'La declaración del IRP se presenta una vez al año en Marangatu, con el detalle de los '
                . 'ingresos y las deducciones del ejercicio completo. El plazo exacto lo confirma la DNIT '
                . 'cada año según el calendario vigente; quien ya tiene RUC como persona física recibe el '
                . 'recordatorio dentro de su propia cuenta corriente tributaria.',
            'Quien todavía no tiene RUC como persona física necesita inscribirse primero, antes de poder '
                . 'presentar la declaración.',
        ],
    ],
];

$sections[] = [
    'h2'   => 'Coordinar el IRP con el IRE de su empresa',
    'body' => [
        'Si además de tener ingresos personales usted es dueño de una empresa —unipersonal, EAS o SRL— '
            . 'coordinar ambas declaraciones evita inconsistencias entre lo que declara como persona y lo '
            . 'que declara su empresa. No son la misma obligación ni se presentan en el mismo formulario, '
            . 'pero un dato mal reflejado en una puede generar una observación en la otra si la DNIT los '
            . 'cruza.',
    ],
];

$faq = [
    [
        'q' => '¿Quién debe pagar el IRP en Paraguay?',
        'a' => 'Las personas físicas cuyos ingresos —sueldos, honorarios profesionales, alquileres u '
             . 'otras rentas personales— superan los tramos que fija la ley vigente. Confirmamos su caso '
             . 'concreto con precisión, ya que los tramos cambian con la reglamentación.',
    ],
    [
        'q' => '¿El IRP es lo mismo que el IRE?',
        'a' => 'No. El IRP grava los ingresos personales de una persona física; el IRE grava la renta de '
             . 'una empresa como persona jurídica o unipersonal. Una persona puede estar alcanzada por '
             . 'ambos a la vez, por fuentes de ingreso distintas.',
    ],
    [
        'q' => '¿Cómo se calcula el IRP en 2026?',
        'a' => 'Se suman todos los ingresos personales del ejercicio y se aplican las deducciones que la '
             . 'ley permite, según los tramos y tasas vigentes ese año. No indicamos un monto genérico '
             . 'aquí porque cambia con la reglamentación; confirmamos el cálculo exacto caso por caso.',
    ],
    [
        'q' => '¿Cuándo se presenta la declaración anual del IRP?',
        'a' => 'Una vez al año en Marangatu, con el detalle de los ingresos y deducciones del ejercicio '
             . 'completo. El plazo exacto lo confirma la DNIT cada año según su calendario vigente.',
    ],
];

$toolLink = [
    [
        'path'  => '/guias/irp-quien-debe-pagar/',
        'label' => 'Guía: IRP, quién debe pagar',
        'text'  => 'Cómo saber si le corresponde inscribirse y presentar el IRP, y qué hacer si no está '
                 . 'seguro de su caso.',
    ],
];

require ROOT_DIR . '/templates/article.php';
