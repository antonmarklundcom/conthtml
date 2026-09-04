<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'multas-dnit-cuanto-son-y-como-evitarlas';

$sections = [
    [
        'h2'   => 'Por qué la DNIT aplica una multa',
        'body' => [
            'Una multa de la DNIT casi nunca aparece de la nada: se genera por una declaración jurada no '
                . 'presentada, presentada fuera de plazo, o presentada con datos inconsistentes frente a '
                . 'lo que la DNIT ya tiene registrado de otras fuentes (comprobantes electrónicos, otras '
                . 'declaraciones del mismo contribuyente). El punto en común de los tres casos es que la '
                . 'obligación existía y no se cumplió como correspondía, no que la DNIT haya actuado sin '
                . 'motivo.',
            'El caso más frecuente y el más evitable es el primero: no presentar el Formulario 120 en un '
                . 'mes sin ventas, porque la obligación de declarar no depende de haber facturado. Una '
                . 'declaración en cero presentada a tiempo cuesta lo mismo que no presentar nada, pero '
                . 'solo la primera evita la multa.',
        ],
    ],
    [
        'h2'   => '¿Cuánto son las multas de la DNIT?',
        'body' => [
            'El monto exacto de cada multa depende del tipo de infracción, de si es la primera vez o una '
                . 'reincidencia, y de cuánto tiempo pasó sin regularizar. No es un número fijo que se '
                . 'pueda dar de memoria sin revisar el caso concreto: preferimos confirmarle el monto '
                . 'exacto que le corresponde en Marangatu antes que arriesgar una cifra desactualizada.',
            'Lo que sí es consistente en todos los casos es que la mora se acumula mientras la situación '
                . 'no se regulariza: cuanto más tiempo pasa desde el vencimiento original, más cara resulta '
                . 'la regularización en comparación con haberla resuelto apenas se detectó.',
        ],
    ],
    [
        'h2'   => 'Cómo saber si tiene multas pendientes',
        'body' => [
            'La forma más directa es revisar su cuenta corriente tributaria dentro de Marangatu, donde '
                . 'figuran las obligaciones vencidas y cualquier multa asociada. El Certificado de '
                . 'Cumplimiento Tributario también funciona como una señal indirecta: si la DNIT no se lo '
                . 'emite, casi siempre hay una declaración pendiente, un saldo impago o una inconsistencia '
                . 'de datos detrás.',
        ],
    ],
    [
        'h2'   => 'Los tres orígenes más frecuentes, en detalle',
        'body' => [
            'La declaración no presentada es el caso más simple de explicar y el más fácil de evitar: '
                . 'ocurre cuando vence el plazo de un período —mensual, como el Formulario 120, o anual, '
                . 'como el IRE o el IRP— y nadie la presenta, con o sin movimiento.',
            'La declaración presentada fuera de plazo genera mora incluso si el monto declarado es '
                . 'correcto: la DNIT no distingue entre "no declaré" y "declaré tarde" para efectos de la '
                . 'multa, aunque el cálculo puede diferir.',
            'La inconsistencia de datos es la más difícil de detectar sin revisar la cuenta a fondo: '
                . 'ocurre cuando lo que usted declaró no coincide con lo que la DNIT ya sabe por otra vía, '
                . 'típicamente por los comprobantes electrónicos que sus proveedores o clientes emitieron '
                . 'a su nombre y que el sistema cruza automáticamente.',
        ],
    ],
    [
        'h2'   => 'Cómo se regulariza una multa',
        'body' => [
            'El primer paso es siempre presentar la declaración que falta o corregir la que tiene el dato '
                . 'inconsistente: la DNIT no calcula ni permite pagar una multa sobre una obligación que '
                . 'todavía no está declarada. Recién con la declaración presentada aparece el monto exacto '
                . 'a pagar, y desde ahí se gestiona el pago o, si corresponde, un plan de facilidades.',
            'Cuanto antes se presente la declaración pendiente, menor es la mora acumulada. Postergarlo '
                . 'con la idea de "resolverlo más adelante" es lo que convierte una multa manejable en un '
                . 'problema de cuenta corriente tributaria más grande.',
        ],
    ],
    [
        'h2'   => 'Plan de facilidades: cuando el monto es grande',
        'body' => [
            'Cuando el monto a regularizar es alto, en muchos casos existe la posibilidad de gestionar un '
                . 'plan de facilidades de pago en lugar de afrontar todo de una vez. No es una opción '
                . 'automática ni aplica a todas las situaciones por igual; conviene evaluarla junto con la '
                . 'presentación de la declaración pendiente, no como un paso separado después.',
        ],
    ],
    [
        'h2'   => 'Cómo evitar que vuelva a pasar',
        'body' => [
            'La mayoría de las multas que revisamos no vienen de un desconocimiento de la ley, sino de un '
                . 'vencimiento que nadie tenía en el calendario: la fecha varía según la terminación de su '
                . 'RUC, y un mes sin movimiento se olvida con más facilidad que un mes con ventas. '
                . 'Integrar sus vencimientos dentro de un calendario que alguien revisa activamente, en '
                . 'lugar de confiar en recordarlo, es lo que evita que la próxima multa se genere igual '
                . 'que la anterior.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Cuánto es una multa de la DNIT?',
        'a' => 'Depende del tipo de infracción, de si es la primera vez y del tiempo transcurrido sin '
             . 'regularizar. No es un monto fijo: se lo confirmamos con precisión revisando su cuenta '
             . 'corriente tributaria en Marangatu.',
    ],
    [
        'q' => '¿Me pueden multar si no vendí nada en el mes?',
        'a' => 'Sí, si no presentó la declaración en cero correspondiente. La obligación de declarar no '
             . 'depende de haber facturado; presentar el Formulario 120 en cero dentro del plazo evita la '
             . 'multa aunque no haya habido movimiento.',
    ],
    [
        'q' => '¿Cómo sé si tengo multas de la DNIT?',
        'a' => 'Revisando su cuenta corriente tributaria en Marangatu, donde figuran las obligaciones '
             . 'vencidas. Si la DNIT no le emite el Certificado de Cumplimiento Tributario, casi siempre '
             . 'hay una declaración pendiente o un saldo impago detrás.',
    ],
    [
        'q' => '¿Puedo pagar una multa antes de presentar la declaración pendiente?',
        'a' => 'No. La DNIT calcula la multa sobre la obligación declarada, así que el primer paso es '
             . 'siempre presentar o corregir la declaración; el monto a pagar aparece recién después.',
    ],
    [
        'q' => '¿Existe un plan de facilidades de pago para multas grandes?',
        'a' => 'En muchos casos sí, aunque no aplica automáticamente a toda situación. Conviene '
             . 'evaluarlo junto con la presentación de la declaración pendiente, no como un trámite '
             . 'separado después.',
    ],
];

$toolLink = [
    [
        'path'  => '/guias/multas-dnit-como-regularizar/',
        'label' => 'Guía: multas de la DNIT, cómo regularizar',
        'text'  => 'Los pasos concretos para revisar su situación en Marangatu y regularizar antes de que '
                 . 'la mora se acumule más.',
    ],
];

require ROOT_DIR . '/templates/article.php';
