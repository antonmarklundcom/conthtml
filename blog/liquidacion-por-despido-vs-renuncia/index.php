<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'liquidacion-por-despido-vs-renuncia';

$sections = [
    [
        'h2'   => 'Lo que cobra un trabajador siempre, sin importar el motivo',
        'body' => [
            'Renuncie o sea despedido, hay tres conceptos que un trabajador cobra siempre, porque no '
                . 'dependen del motivo de la salida: el salario proporcional de los días trabajados en el '
                . 'mes, las vacaciones proporcionales no gozadas y el aguinaldo proporcional del año en '
                . 'curso. Estos tres se calculan igual en cualquiera de los dos casos.',
            'Lo que sí cambia según el motivo son el preaviso y la indemnización, y ahí es donde aparecen '
                . 'la mayoría de las dudas y de los reclamos mal resueltos.',
        ],
    ],
    [
        'h2'   => 'Renuncia: qué cobra el trabajador',
        'body' => [
            'Cuando el trabajador renuncia por su propia voluntad, la liquidación se limita a los tres '
                . 'conceptos proporcionales: salario, vacaciones y aguinaldo. No corresponde preaviso a '
                . 'cargo de la empresa ni indemnización, porque ninguno de los dos está pensado para una '
                . 'salida decidida por el propio trabajador.',
            'El trabajador que renuncia sí debe respetar su propio preaviso hacia la empresa —el plazo de '
                . 'anticipación que le corresponde según su antigüedad— si no quiere exponerse a un '
                . 'descuento equivalente en su liquidación.',
        ],
    ],
    [
        'h2'   => 'Despido sin causa justificada: qué se suma',
        'body' => [
            'Cuando la empresa despide a un trabajador sin una causa justificada por el Código del '
                . 'Trabajo, a los tres conceptos proporcionales se suman dos más: el preaviso y la '
                . 'indemnización.',
            'El preaviso son 30, 45, 60 o 90 días de salario según la antigüedad del trabajador (hasta 1, '
                . 'hasta 5, hasta 10 o más de 10 años), a cargo de la empresa cuando no avisó con esa '
                . 'anticipación. La indemnización equivale a 15 salarios diarios por cada año de servicio '
                . 'o fracción superior a seis meses (Art. 91, Código del Trabajo). Son los dos conceptos '
                . 'que multiplican el costo de un despido sin causa frente a una renuncia.',
        ],
    ],
    [
        'h2'   => 'Despido con causa justificada: el punto medio',
        'body' => [
            'Cuando existe una causa justificada por el Código del Trabajo —una falta grave probada por '
                . 'la empresa— no corresponde preaviso ni indemnización, igual que en una renuncia. La '
                . 'diferencia con la renuncia es que aquí la decisión de terminar la relación laboral la '
                . 'toma la empresa, no el trabajador, así que conviene documentar bien la causa antes de '
                . 'notificar el despido: una causa mal probada puede terminar tratándose como despido sin '
                . 'causa justificada en un reclamo posterior.',
        ],
    ],
    [
        'h2'   => 'La deducción del 9% al IPS, en ambos casos',
        'body' => [
            'El aporte obrero del 9% al IPS se descuenta del salario y de las vacaciones proporcionales '
                . 'en cualquiera de los dos motivos, porque son conceptos remunerativos ordinarios. El '
                . 'aguinaldo proporcional, el preaviso y la indemnización no llevan ese descuento: son '
                . 'conceptos de otra naturaleza, no un sueldo del período.',
            'Ver esta línea desglosada, y no como un descuento genérico "menos aportes", es lo que permite '
                . 'a ambas partes verificar que la liquidación esté bien hecha.',
        ],
    ],
    [
        'h2'   => 'Ejemplo numérico: el mismo trabajador, dos motivos distintos',
        'body' => [
            'Tome un trabajador con 6 años de antigüedad y un salario mensual de Gs. 4.000.000 que se '
                . 'desvincula el 15 de un mes cualquiera. En una renuncia, cobra el salario proporcional '
                . 'de esos 15 días, las vacaciones proporcionales que le correspondan por sus 6 años '
                . '(dentro del tramo "más de 5 y hasta 10 años", 18 días de vacaciones anuales) y el '
                . 'aguinaldo proporcional del año en curso. Nada más.',
            'En un despido sin causa justificada, a esos mismos tres conceptos se suman el preaviso —60 '
                . 'días de salario, porque su antigüedad de 6 años cae en el tramo "más de 5 y hasta 10 '
                . 'años"— y la indemnización de 15 salarios diarios por cada uno de sus 6 años completos '
                . 'de servicio. La diferencia entre ambos finiquitos no está en los conceptos '
                . 'proporcionales, que son idénticos, sino en estos dos últimos, que solo aparecen cuando '
                . 'la empresa termina la relación sin causa justificada.',
            'Esa diferencia es exactamente la que hace que definir bien el motivo antes de liquidar no '
                . 'sea un detalle administrativo: cambia el resultado del cálculo, no solo el papeleo.',
        ],
    ],
    [
        'h2'   => 'El error que más reclamos genera',
        'body' => [
            'El error más frecuente no está en la fórmula, está en la calificación del motivo: tratar '
                . 'como renuncia lo que en los hechos fue una presión para que el trabajador se fuera, o '
                . 'invocar una causa justificada sin poder probarla si el caso llega al Ministerio de '
                . 'Trabajo. La liquidación puede estar matemáticamente correcta y aun así generar un '
                . 'reclamo si el motivo elegido no resiste una revisión.',
            'Por eso conviene definir el motivo con criterio jurídico antes de calcular, no calcular '
                . 'primero y justificar el motivo después.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Se cobra indemnización si el trabajador renuncia?',
        'a' => 'No. La indemnización por despido sin causa justificada solo corresponde cuando la empresa '
             . 'termina la relación laboral sin una causa que lo justifique. Quien renuncia cobra el '
             . 'salario, las vacaciones y el aguinaldo proporcionales, pero no indemnización ni preaviso '
             . 'a cargo de la empresa.',
    ],
    [
        'q' => '¿Qué pasa si el trabajador renuncia sin avisar con anticipación?',
        'a' => 'El trabajador que renuncia también debe respetar el plazo de preaviso que le corresponde '
             . 'según su antigüedad. Si no lo hace, la empresa puede descontar un monto equivalente de su '
             . 'liquidación final.',
    ],
    [
        'q' => '¿Cómo sé si un despido fue con o sin causa justificada?',
        'a' => 'La diferencia la marca si existe una causa contemplada por el Código del Trabajo y si la '
             . 'empresa puede probarla. Una causa invocada sin sustento suficiente suele terminar '
             . 'tratándose como despido sin causa justificada si el trabajador reclama, con preaviso e '
             . 'indemnización incluidos.',
    ],
    [
        'q' => '¿Un jubilado que se desvincula tiene la misma liquidación?',
        'a' => 'El régimen de un trabajador jubilado que continúa en relación de dependencia tiene '
             . 'particularidades propias que no cubre este artículo; conviene revisarlo caso por caso con '
             . 'nosotros antes de liquidar.',
    ],
    [
        'q' => '¿Se puede negociar una liquidación distinta a la que marca la ley?',
        'a' => 'Las partes pueden acordar condiciones dentro de lo que la ley permite, pero los mínimos '
             . 'legales —proporcionales, y preaviso e indemnización cuando corresponden— no son '
             . 'renunciables por el trabajador. Un acuerdo que baje esos mínimos queda expuesto a un '
             . 'reclamo posterior.',
    ],
];

$toolLink = [
    [
        'path'  => '/herramientas/liquidacion-de-salario/',
        'label' => 'Calculadora de liquidación de salario',
        'text'  => 'Elija renuncia o despido y obtenga el finiquito completo: proporcionales, preaviso e '
                 . 'indemnización si corresponden, con el aporte del 9 % al IPS como línea aparte.',
    ],
];

require ROOT_DIR . '/templates/article.php';
