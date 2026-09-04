<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'eas-vs-srl-vs-unipersonal-cual-conviene';

$sections = [
    [
        'h2'   => 'Por qué esta decisión conviene tomarla antes de facturar, no después',
        'body' => [
            'Elegir la figura societaria equivocada no es un error que se corrige con un simple cambio de '
                . 'papeles: pasar de una a otra implica dar de baja la estructura existente y constituir '
                . 'una nueva, con su propio RUC y su propio trámite. Empezar con la figura que realmente '
                . 'corresponde a su situación —número de socios, apetito de riesgo patrimonial, formalidad '
                . 'que espera el mercado en el que opera— evita ese doble trámite más adelante.',
        ],
    ],
    [
        'h2'   => 'Las tres opciones, en una frase',
        'body' => [
            'La Unipersonal es un solo dueño operando con su propia cédula, sin separación patrimonial. '
                . 'La EAS (Empresa por Acciones Simplificada) también admite un solo dueño, pero con '
                . 'estructura de sociedad: su patrimonio personal queda separado del de la empresa. La '
                . 'SRL requiere dos o más socios y se constituye por escritura pública. Ninguna es "mejor" '
                . 'en abstracto: la que le conviene depende de cuántos socios tiene y de si quiere separar '
                . 'su patrimonio personal del de su negocio.',
        ],
    ],
    [
        'h2'   => 'Qué figura elige la mayoría al empezar',
        'body' => [
            'La Unipersonal suele ser la puerta de entrada más común para quien recién empieza, porque el '
                . 'trámite es el más simple de los tres. El costo de esa simplicidad es la responsabilidad '
                . 'ilimitada: si el negocio crece rápido o empieza a manejar contratos de mayor volumen, '
                . 'muchos emprendedores terminan migrando a una EAS precisamente para dejar de exponer su '
                . 'patrimonio personal a las obligaciones del negocio.',
        ],
    ],
    [
        'h2'   => 'Socios y responsabilidad',
        'body' => [
            'La Unipersonal responde con el patrimonio personal del dueño: si el negocio tiene una deuda, '
                . 'esa deuda alcanza también sus bienes personales. La EAS y la SRL limitan la '
                . 'responsabilidad al capital aportado por cada socio, lo que las hace más adecuadas '
                . 'cuando el negocio maneja compromisos financieros de cierto volumen. La diferencia entre '
                . 'ambas es el número de socios: la EAS permite uno solo, la SRL exige dos o más.',
        ],
    ],
    [
        'h2'   => 'Trámite de constitución',
        'body' => [
            'La Unipersonal se constituye con la inscripción de RUC como persona física, el trámite más '
                . 'simple de los tres. La EAS se constituye por el SUACE (Sistema Unificado de Apertura y '
                . 'Cierre de Empresas), un trámite digital que no requiere escritura pública notarial. La '
                . 'SRL, en cambio, exige escritura pública e inscripción en el Registro Público de '
                . 'Comercio, un proceso más formal y con más pasos.',
            'Ninguna de las tres exige un capital mínimo por ley: puede definir el capital que realmente '
                . 'necesita su operativa inicial, en cualquiera de las tres figuras.',
        ],
    ],
    [
        'h2'   => 'Cuándo conviene cada una',
        'body' => [
            'La Unipersonal conviene para empezar rápido con bajo riesgo patrimonial percibido, aunque '
                . 'sin la protección de separar su patrimonio. La EAS conviene cuando es un solo dueño que '
                . 'quiere esa separación patrimonial y un trámite ágil, sin necesidad de sumar un socio '
                . 'solo para cumplir un requisito formal. La SRL conviene cuando ya hay dos o más socios '
                . 'reales desde el inicio, o cuando el modelo de negocio necesita la formalidad adicional '
                . 'de la escritura pública frente a bancos o inversores conservadores.',
        ],
    ],
    [
        'h2'   => 'Tributación: las tres pagan según su régimen de IRE',
        'body' => [
            'Las tres figuras se ubican dentro del régimen de IRE —Resimple, IRE Simple o IRE General— '
                . 'según su nivel de facturación anual, y la Unipersonal además puede quedar alcanzada por '
                . 'el IRP si sus ingresos combinan renta empresarial con renta personal. La figura '
                . 'societaria que elija no cambia el tributo en sí, pero sí influye en cómo se organiza la '
                . 'contabilidad detrás de cada declaración.',
        ],
    ],
    [
        'h2'   => 'Un caso concreto para decidir',
        'body' => [
            'Un profesional independiente que factura solo y quiere separar sus gastos personales de los '
                . 'del negocio, sin sumar un socio artificial, suele encontrar en la EAS el punto justo '
                . 'entre simplicidad y protección patrimonial. Dos socios que arrancan un negocio juntos '
                . 'desde el primer día, en cambio, tienen en la SRL una figura pensada exactamente para '
                . 'esa situación, con reglas claras de participación entre ambos desde la escritura de '
                . 'constitución.',
        ],
    ],
    [
        'h2'   => '¿Puede cambiar de una a otra más adelante?',
        'body' => [
            'Sí. Es habitual empezar como Unipersonal y luego constituir una EAS o una SRL cuando el '
                . 'negocio crece o suma socios. No es una simple modificación del registro existente: '
                . 'implica dar de baja la estructura anterior y constituir la nueva, con su propio trámite '
                . 'y su propio RUC.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Cuántos socios necesita una SRL?',
        'a' => 'Dos o más. Es la diferencia principal frente a la EAS, que admite un solo accionista, y '
             . 'frente a la Unipersonal, que por definición es un solo dueño sin figura societaria.',
    ],
    [
        'q' => '¿La EAS necesita capital mínimo?',
        'a' => 'No existe un capital mínimo obligatorio por ley para constituir una EAS. Tampoco lo exige '
             . 'la SRL como mínimo legal; puede definir el capital que corresponde a su operativa real.',
    ],
    [
        'q' => '¿Puedo pasar de Unipersonal a EAS más adelante?',
        'a' => 'Sí, es habitual empezar como Unipersonal y constituir una EAS o una SRL cuando el negocio '
             . 'crece. Implica un trámite nuevo y un RUC nuevo, no una modificación de la Unipersonal '
             . 'existente.',
    ],
    [
        'q' => '¿Cuál es la opción más rápida para empezar?',
        'a' => 'La Unipersonal y la EAS son las más rápidas: la primera con la inscripción de RUC como '
             . 'persona física, la segunda por el SUACE sin escritura pública notarial. La SRL, al '
             . 'requerir escritura pública, es la que más tiempo suele tomar.',
    ],
    [
        'q' => '¿Qué figura protege mejor mi patrimonio personal?',
        'a' => 'La EAS y la SRL, porque limitan la responsabilidad al capital aportado por cada socio. '
             . 'La Unipersonal, al no tener esa separación, expone también el patrimonio personal del '
             . 'dueño frente a las deudas del negocio.',
    ],
];

$toolLink = [
    [
        'path'  => '/herramientas/comparador-eas-srl-unipersonal/',
        'label' => 'Comparador EAS / SRL / Unipersonal',
        'text'  => 'Compare las tres estructuras en una tabla y responda tres preguntas para saber cuál '
                 . 'le conviene.',
    ],
];

require ROOT_DIR . '/templates/article.php';
