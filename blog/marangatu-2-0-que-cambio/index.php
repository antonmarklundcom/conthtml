<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'marangatu-2-0-que-cambio';

$sections = [
    [
        'h2'   => '¿Qué es Marangatu 2.0?',
        'body' => [
            'Marangatu 2.0 es la actualización del sistema en línea que la DNIT usa para que los '
                . 'contribuyentes presenten declaraciones, consulten su cuenta corriente tributaria y '
                . 'gestionen su RUC. No es un sistema nuevo ni reemplaza a Marangatu: es una '
                . 'reorganización del mismo sistema, con el menú y algunas pantallas rediseñadas.',
            'Si usted ya usaba Marangatu antes de la actualización, todo lo que hacía sigue estando '
                . 'disponible; lo que cambió es dónde encontrarlo, no qué se puede hacer.',
        ],
    ],
    [
        'h2'   => '¿Por qué la DNIT actualizó Marangatu?',
        'body' => [
            'Un sistema tributario que procesa millones de declaraciones necesita revisiones periódicas '
                . 'de interfaz y de rendimiento, no solo por estética sino para sostener el volumen de '
                . 'contribuyentes que lo usan a diario. Marangatu 2.0 es esa clase de actualización: '
                . 'mantiene el mismo motor de datos y las mismas obligaciones detrás, con una capa '
                . 'renovada por delante.',
        ],
    ],
    [
        'h2'   => 'Lo que se reorganizó, no lo que se eliminó',
        'body' => [
            'El cambio más notorio es el menú principal: las opciones se agruparon de otra manera, así '
                . 'que un trámite que antes estaba a un clic puede requerir ahora dos pasos, o estar bajo '
                . 'un nombre distinto. Ninguna funcionalidad desapareció; lo que genera confusión es no '
                . 'encontrar de inmediato algo que antes se ubicaba de memoria.',
        ],
    ],
    [
        'h2'   => 'Consulta de RUC en Marangatu 2.0',
        'body' => [
            'La consulta de RUC —para verificar el suyo propio o el de otra persona o empresa antes de '
                . 'una operación comercial— sigue disponible dentro del sistema, ahora dentro de la nueva '
                . 'organización del menú. Es una de las funciones más buscadas después de la actualización, '
                . 'junto con el acceso al Formulario 120.',
        ],
    ],
    [
        'h2'   => 'Recuperar la clave en la nueva versión',
        'body' => [
            'La opción para recuperar una clave olvidada sigue disponible dentro del flujo de acceso de '
                . 'Marangatu 2.0, con el mismo criterio de siempre: si sus datos de contacto registrados '
                . '—correo, teléfono— siguen vigentes, la recuperación es en gran parte autogestionada. Si '
                . 'esos datos quedaron desactualizados, la recuperación suele requerir un trámite presencial '
                . 'o el acompañamiento de un contador matriculado que pueda validar su identidad ante la '
                . 'DNIT.',
        ],
    ],
    [
        'h2'   => 'ESET: el módulo de acceso',
        'body' => [
            'El ingreso a Marangatu se hace a través del módulo ESET, que es la puerta de autenticación '
                . 'del sistema: usuario y clave, más la validación que corresponda según su tipo de '
                . 'contribuyente. Es el mismo mecanismo de acceso de siempre, con la interfaz actualizada.',
        ],
    ],
    [
        'h2'   => 'Certificado de Cumplimiento Tributario, en el mismo lugar de siempre',
        'body' => [
            'El Certificado de Cumplimiento Tributario se solicita desde dentro de Marangatu, igual que '
                . 'antes de la actualización. Si el sistema no se lo emite, la causa no es la versión del '
                . 'sistema: es una declaración pendiente, un saldo impago o una inconsistencia de datos '
                . 'que hay que resolver primero.',
        ],
    ],
    [
        'h2'   => 'Formulario 120 en la nueva versión',
        'body' => [
            'El Formulario 120, con el que se liquida y presenta el IVA mensual, también sigue disponible '
                . 'dentro de Marangatu 2.0. Sigue exigiendo la misma información —crédito fiscal de sus '
                . 'compras contra débito fiscal de sus ventas— y sigue requiriendo declaración en cero en '
                . 'los meses sin movimiento; lo único que cambia es el camino de clics para llegar hasta '
                . 'él dentro del menú reorganizado.',
        ],
    ],
    [
        'h2'   => 'Por qué tantas búsquedas por "Marangatu 2.0"',
        'body' => [
            'El interés por "Marangatu 2.0" creció con fuerza apenas la DNIT desplegó la actualización, '
                . 'lo que es habitual: cualquier cambio de interfaz en un sistema que miles de '
                . 'contribuyentes usan a diario genera una ola de búsquedas de gente que no encuentra algo '
                . 'donde lo dejó. Pasado ese período inicial de adaptación, el sistema vuelve a usarse con '
                . 'la misma naturalidad de antes: lo que cambió es la ubicación de las opciones, no la '
                . 'lógica del sistema.',
        ],
    ],
    [
        'h2'   => 'Un cambio de interfaz, no de obligaciones',
        'body' => [
            'Vale la pena repetirlo con claridad: Marangatu 2.0 no cambió ningún plazo, ninguna tasa ni '
                . 'ninguna obligación tributaria. Sus vencimientos de IVA, IRE, IRP e IPS siguen siendo '
                . 'exactamente los mismos que antes de la actualización, calculados de la misma manera. Lo '
                . 'único que cambió es la interfaz con la que se cumplen esas obligaciones, no las '
                . 'obligaciones en sí.',
        ],
    ],
    [
        'h2'   => 'Qué hacer si no encuentra algo',
        'body' => [
            'Antes de asumir que una función desapareció, conviene revisar el menú reorganizado con '
                . 'calma: casi todo lo que existía en la versión anterior sigue estando, solo que agrupado '
                . 'de otra manera. Si después de buscar sigue sin encontrarlo, o si el sistema le da un '
                . 'error que no entiende, ese es el momento de pedir ayuda en lugar de perder tiempo '
                . 'probando por su cuenta.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Marangatu 2.0 es un sistema nuevo?',
        'a' => 'No. Es una actualización del mismo sistema, con el menú y algunas pantallas '
             . 'reorganizadas. Todo lo que se podía hacer antes sigue disponible; cambió principalmente '
             . 'dónde se encuentra cada trámite, no la lógica ni los datos que el sistema guarda.',
    ],
    [
        'q' => '¿Dónde está la consulta de RUC en la nueva versión?',
        'a' => 'Sigue disponible dentro de Marangatu, dentro de la nueva organización del menú. Es una de '
             . 'las funciones más buscadas tras la actualización.',
    ],
    [
        'q' => '¿Qué es ESET en Marangatu?',
        'a' => 'Es el módulo de acceso al sistema: usuario, clave y la validación que corresponda según '
             . 'su tipo de contribuyente. Es el mismo mecanismo de siempre, con la pantalla actualizada.',
    ],
    [
        'q' => '¿Recuperar la clave cambió con Marangatu 2.0?',
        'a' => 'La lógica es la misma: si sus datos de contacto registrados siguen vigentes, la '
             . 'recuperación es en gran parte autogestionada. Si están desactualizados, suele requerir un '
             . 'trámite presencial o el acompañamiento de un contador matriculado.',
    ],
    [
        'q' => '¿Por qué no me emite el Certificado de Cumplimiento Tributario después de la actualización?',
        'a' => 'La actualización del sistema no es la causa: si no se lo emite, casi siempre hay una '
             . 'declaración pendiente, un saldo impago o una inconsistencia de datos que hay que resolver '
             . 'primero, igual que antes de Marangatu 2.0.',
    ],
];

$toolLink = [
    [
        'path'  => '/guias/como-ingresar-a-marangatu/',
        'label' => 'Guía: cómo ingresar a Marangatu',
        'text'  => 'El paso a paso para acceder, recuperar la clave y ubicarse en el menú reorganizado '
                 . 'de Marangatu 2.0.',
    ],
];

require ROOT_DIR . '/templates/article.php';
