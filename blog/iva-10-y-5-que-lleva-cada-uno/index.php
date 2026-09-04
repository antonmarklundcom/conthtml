<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'iva-10-y-5-que-lleva-cada-uno';

$sections = [
    [
        'h2'   => 'Por qué existen dos tasas',
        'body' => [
            'La tasa reducida del 5% existe para aliviar el costo de determinados bienes considerados de '
                . 'primera necesidad y de ciertas operaciones específicas que la ley identifica por su '
                . 'función económica, no por su precio. No es una tasa promocional que una empresa pueda '
                . 'elegir aplicar: depende exclusivamente de qué es lo que se está vendiendo, según lo '
                . 'define la normativa vigente.',
        ],
    ],
    [
        'h2'   => 'Dos tasas, una sola declaración',
        'body' => [
            'El IVA en Paraguay tiene dos tasas vigentes: el 10% general y el 5% reducido. Ambas se '
                . 'liquidan dentro del mismo Formulario 120 mensual; no son dos declaraciones separadas, '
                . 'sino dos columnas dentro de la misma. El error de clasificación —cargar un comprobante '
                . 'con la tasa que no le corresponde— es lo que más ajustes genera cuando la DNIT revisa '
                . 'una declaración.',
        ],
    ],
    [
        'h2'   => 'Qué paga el 10% general',
        'body' => [
            'La mayoría de los bienes y servicios que se venden en Paraguay pagan la tasa general del '
                . '10%. Es la tasa por defecto: si un producto o servicio no está específicamente incluido '
                . 'en la lista reducida, se factura al 10%.',
        ],
    ],
    [
        'h2'   => 'Qué paga el 5% reducido',
        'body' => [
            'La tasa reducida del 5% alcanza a un listado acotado de bienes de la canasta familiar y a '
                . 'ciertas operaciones inmobiliarias y financieras. La lista exacta puede cambiar por '
                . 'reglamentación, así que conviene confirmar el listado vigente antes de facturar un '
                . 'producto nuevo a esta tasa en lugar de asumirlo por comparación con otro similar.',
        ],
    ],
    [
        'h2'   => 'Cómo se ve reflejado en el Formulario 120',
        'body' => [
            'El Formulario 120 separa el débito y el crédito fiscal según la tasa a la que corresponde '
                . 'cada comprobante, así que un mismo período puede tener movimiento en la columna del 10% '
                . 'y en la del 5% al mismo tiempo, sin que eso implique ningún error. Lo que sí genera una '
                . 'inconsistencia es cargar un comprobante en la columna que no le corresponde a su tasa '
                . 'real.',
        ],
    ],
    [
        'h2'   => 'El error más común: clasificar por el nombre del producto',
        'body' => [
            'El error habitual es asumir la tasa por el tipo general de producto en lugar de verificar si '
                . 'ese comprobante específico está en el listado reducido. Dos productos que parecen '
                . 'similares pueden tener tasas distintas según cómo la ley los clasifica, y facturar la '
                . 'tasa equivocada —de más o de menos— genera una diferencia que la DNIT detecta al '
                . 'cruzar la información con otros comprobantes electrónicos del mismo período.',
        ],
    ],
    [
        'h2'   => 'IVA incluido o excluido: dos formas de mostrar el mismo monto',
        'body' => [
            'El precio de un producto puede mostrarse con el IVA ya incluido —lo que suele verse en un '
                . 'comercio minorista— o con el IVA excluido, mostrado aparte del precio base, más '
                . 'habitual en operaciones entre empresas. Ambas formas representan el mismo monto de '
                . 'impuesto; la diferencia es solo de presentación, y confundirlas al facturar es otro de '
                . 'los errores frecuentes al armar una factura o al conciliar un comprobante recibido.',
        ],
    ],
    [
        'h2'   => 'Exento no es lo mismo que 5%',
        'body' => [
            'Un tercer caso, distinto de las dos tasas, es la exención: ciertos bienes y servicios no '
                . 'pagan IVA en absoluto, ni al 10% ni al 5%. Tratar un comprobante exento como si llevara '
                . 'la tasa reducida del 5% —o al revés— genera el mismo tipo de descuadre que confundir el '
                . '10% con el 5%, así que conviene distinguir los tres casos con la misma atención.',
        ],
    ],
    [
        'h2'   => 'Cómo afecta al crédito y al débito fiscal',
        'body' => [
            'Cada comprobante de compra entra a su crédito fiscal con la tasa a la que efectivamente fue '
                . 'facturado, y cada venta entra a su débito fiscal de la misma manera. Si carga un '
                . 'crédito fiscal con una tasa distinta a la del comprobante original, el Formulario 120 '
                . 'queda con un saldo que no coincide con lo que la DNIT ya tiene registrado por el lado '
                . 'del emisor, lo que puede derivar en una observación.',
        ],
    ],
];

$sections[] = [
    'h2'   => 'Por qué conviene revisar esto antes de que la DNIT lo haga',
    'body' => [
        'La DNIT cruza automáticamente los comprobantes electrónicos emitidos y recibidos, así que una '
            . 'tasa mal aplicada de un lado de la operación se detecta con facilidad del otro. Revisar la '
            . 'clasificación de sus comprobantes de forma periódica, antes de presentar cada Formulario '
            . '120, es más simple y más barato que corregir una observación después de presentada la '
            . 'declaración.',
    ],
];

$faq = [
    [
        'q' => '¿Cuáles son las tasas de IVA en Paraguay?',
        'a' => 'Dos: el 10% general, que aplica por defecto a la mayoría de bienes y servicios, y el 5% '
             . 'reducido, que aplica a un listado acotado de productos de la canasta básica y a ciertas '
             . 'operaciones inmobiliarias y financieras. Ninguna empresa elige libremente cuál aplicar: '
             . 'depende del bien o servicio concreto que está vendiendo.',
    ],
    [
        'q' => '¿Cómo sé si un producto paga 10% o 5%?',
        'a' => 'La tasa depende de si el producto está específicamente incluido en el listado reducido, '
             . 'no del tipo general al que pertenece. Ante la duda, conviene confirmar la tasa antes de '
             . 'facturar, en lugar de asumirla por comparación con un producto similar.',
    ],
    [
        'q' => '¿Se declaran juntas las tasas del 10% y del 5%?',
        'a' => 'Sí, dentro del mismo Formulario 120 mensual, separadas en columnas distintas. Un mismo '
             . 'período puede tener movimiento en las dos columnas a la vez, sin que eso sea un error.',
    ],
    [
        'q' => '¿Un producto exento de IVA es lo mismo que uno al 5%?',
        'a' => 'No. Un producto exento no paga IVA en absoluto, mientras que uno con la tasa reducida sí '
             . 'paga, solo que al 5% en lugar del 10%. Son dos tratamientos distintos y confundirlos '
             . 'genera el mismo tipo de descuadre que equivocar el 10% con el 5%.',
    ],
    [
        'q' => '¿Qué pasa si facturo con la tasa equivocada?',
        'a' => 'Genera un descuadre entre el débito fiscal que usted declara y lo que la DNIT tiene '
             . 'registrado del lado del comprador, lo que puede derivar en una observación o un ajuste '
             . 'posterior. Conviene corregirlo apenas se detecta, en la declaración correspondiente.',
    ],
];

$toolLink = [
    [
        'path'  => '/herramientas/calculadora-iva/',
        'label' => 'Calculadora de IVA',
        'text'  => 'Calcule el 10 % o el 5 % sobre un monto, incluido o excluido del precio, en segundos.',
    ],
];

require ROOT_DIR . '/templates/article.php';
