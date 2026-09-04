<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'inscripcion-patronal-ips-paso-a-paso';

$sections = [
    [
        'h2'   => 'Empleador y trabajador: una obligación con dos partes',
        'body' => [
            'La inscripción patronal cubre al empleador, pero el objetivo final es la cobertura del '
                . 'trabajador: acceso a salud, licencias por enfermedad y aportes hacia una futura '
                . 'jubilación. Por eso el IPS trata la falta de inscripción con la misma seriedad que una '
                . 'declaración tributaria no presentada: no es un trámite administrativo secundario, es la '
                . 'puerta de entrada a los derechos laborales del trabajador.',
        ],
    ],
    [
        'h2'   => '¿Cuándo hay que inscribirse como empleador en el IPS?',
        'body' => [
            'La inscripción patronal en el IPS es obligatoria desde el momento en que contrata a su '
                . 'primer trabajador en relación de dependencia, sin importar el tamaño de la empresa ni '
                . 'su régimen tributario. Es una obligación independiente de la inscripción de RUC: tener '
                . 'RUC no lo inscribe automáticamente como empleador ante el IPS.',
        ],
    ],
    [
        'h2'   => 'No espere a tener varios empleados',
        'body' => [
            'Un error frecuente en empresas nuevas es postergar la inscripción patronal hasta tener un '
                . 'equipo más grande, con la idea de resolver "todo junto" más adelante. La obligación '
                . 'nace con el primer contrato, no con un número mínimo de trabajadores, así que cuanto '
                . 'más tiempo pasa entre la contratación real y la inscripción formal, mayor es la '
                . 'diferencia de aportes que después hay que regularizar de una sola vez.',
        ],
    ],
    [
        'h2'   => 'Documentos que necesita para inscribirse',
        'body' => [
            'Para la inscripción patronal se necesita, en general, el RUC de la empresa o de la persona '
                . 'física empleadora, los datos del o los trabajadores a inscribir (cédula, datos de '
                . 'contacto) y la información de la actividad económica del empleador. El detalle exacto '
                . 'puede variar según el tipo societario, así que conviene confirmar la lista completa '
                . 'antes de presentarse.',
        ],
    ],
    [
        'h2'   => 'Los pasos del trámite',
        'body' => [
            'El trámite empieza con el registro del empleador dentro del sistema del IPS, seguido de la '
                . 'carga de los datos del primer trabajador a inscribir. Una vez aprobada la inscripción '
                . 'patronal, cada trabajador nuevo, cada salida y cada cambio de salario se reflejan en la '
                . 'planilla mensual correspondiente, no en un trámite aparte cada vez.',
        ],
    ],
    [
        'h2'   => 'Los aportes que empiezan a correr',
        'body' => [
            'Desde la inscripción, corren dos aportes sobre el salario de cada trabajador: el 9% obrero, '
                . 'que se descuenta del sueldo del trabajador, y el 16,5% patronal, que paga la empresa '
                . 'además del sueldo. Ambos se liquidan mensualmente a través de la planilla de aportes, '
                . 'con una fecha de pago que no depende de la terminación del RUC como los otros impuestos, '
                . 'sino de un calendario propio del IPS.',
        ],
    ],
    [
        'h2'   => 'Planilla mensual: la obligación que sigue después de inscribirse',
        'body' => [
            'La inscripción patronal es solo el primer trámite; después queda la obligación mensual de '
                . 'presentar la planilla de aportes, con el detalle de cada trabajador activo, su salario '
                . 'del período y los aportes correspondientes. Un trabajador nuevo se agrega en la '
                . 'planilla del mes en que ingresa, una salida se refleja en la planilla del mes en que '
                . 'ocurre, y un cambio de salario se actualiza desde el mes en que rige, no de forma '
                . 'retroactiva.',
        ],
    ],
    [
        'h2'   => 'El calendario de pago del IPS es propio, no el de la DNIT',
        'body' => [
            'A diferencia del IVA o el IRE, cuyo vencimiento depende de la terminación numérica de su '
                . 'RUC, los aportes al IPS se pagan dentro de un plazo fijo del mes siguiente, igual para '
                . 'todos los empleadores. Confundir el calendario del IPS con el de la DNIT es un error '
                . 'habitual en empresas que recién empiezan a manejar ambos a la vez.',
        ],
    ],
    [
        'h2'   => 'Qué pasa si contrata sin inscribirse',
        'body' => [
            'Un empleador que contrata sin inscribirse en el IPS deja al trabajador sin cobertura de '
                . 'salud ni de jubilación, y expone a la empresa a una regularización con aportes '
                . 'retroactivos si el IPS detecta la relación laboral no declarada. Inscribirse desde el '
                . 'primer contrato, en lugar de esperar a tener varios empleados, evita ese riesgo desde '
                . 'el inicio.',
        ],
    ],
];

$sections[] = [
    'h2'   => 'Cambios de salario y bajas: se reflejan en el mismo mes',
    'body' => [
        'Un aumento de salario, una reducción de jornada o la salida de un trabajador se reflejan en la '
            . 'planilla del mes en que ocurren, no de forma retroactiva ni acumulada para el mes '
            . 'siguiente. Llevar esta actualización al día es lo que evita que una empresa termine '
            . 'pagando aportes sobre un salario que ya cambió, o dejando de declarar la baja de un '
            . 'trabajador que ya no forma parte del equipo.',
    ],
];

$faq = [
    [
        'q' => '¿Cuándo debo inscribirme como empleador en el IPS?',
        'a' => 'Desde el momento en que contrata a su primer trabajador en relación de dependencia. Es '
             . 'una obligación separada del RUC: tener RUC no lo inscribe automáticamente como empleador '
             . 'ante el IPS.',
    ],
    [
        'q' => '¿Qué aportes empiezan a correr al inscribirme?',
        'a' => 'El 9% obrero, que se descuenta del salario del trabajador, y el 16,5% patronal, que paga '
             . 'la empresa además del sueldo. Ambos se liquidan mensualmente en la planilla de aportes.',
    ],
    [
        'q' => '¿Qué documentos necesito para la inscripción patronal?',
        'a' => 'En general, el RUC del empleador, los datos del trabajador a inscribir y la información '
             . 'de su actividad económica. El detalle puede variar según el tipo societario —Unipersonal, '
             . 'EAS o SRL— así que conviene confirmar la lista completa antes de presentarse.',
    ],
    [
        'q' => '¿Qué pasa si contrato sin inscribirme en el IPS?',
        'a' => 'El trabajador queda sin cobertura de salud ni de jubilación, y la empresa se expone a una '
             . 'regularización con aportes retroactivos si el IPS detecta la relación laboral no '
             . 'declarada.',
    ],
    [
        'q' => '¿Cuándo se actualiza un cambio de salario en la planilla del IPS?',
        'a' => 'Desde el mes en que el nuevo salario rige, no de forma retroactiva. Lo mismo aplica para '
             . 'una salida: se refleja en la planilla del mes en que efectivamente ocurre.',
    ],
];

$toolLink = [
    [
        'path'  => '/guias/inscripcion-patronal-ips/',
        'label' => 'Guía: inscripción patronal IPS',
        'text'  => 'El paso a paso completo para inscribirse como empleador al contratar a su primer '
                 . 'trabajador.',
    ],
];

require ROOT_DIR . '/templates/article.php';
