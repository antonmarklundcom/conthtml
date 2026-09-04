<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'certificado-de-cumplimiento-tributario-marangatu';

$sections = [
    [
        'h2'   => '¿Qué es el Certificado de Cumplimiento Tributario?',
        'body' => [
            'El Certificado de Cumplimiento Tributario (CCT) es el documento que emite la DNIT para '
                . 'confirmar que un contribuyente está al día con sus obligaciones fiscales: declaraciones '
                . 'presentadas dentro de plazo, sin deudas firmes pendientes ni incumplimientos formales '
                . 'abiertos. Es, en la práctica, la constancia de "buena conducta tributaria" de una '
                . 'empresa o de una persona física.',
            'No es un trámite opcional para quien participa activamente en la vida comercial y financiera '
                . 'del país: bancos, licitaciones públicas y muchas empresas grandes lo exigen como '
                . 'requisito previo antes de operar, y por eso la demanda de búsquedas sobre este trámite '
                . 'viene creciendo con fuerza en los últimos meses.',
        ],
    ],
    [
        'h2'   => 'Quién lo exige y para qué se usa',
        'body' => [
            'El CCT aparece como requisito en varios trámites habituales: apertura de cuentas corrientes '
                . 'empresariales, solicitud de créditos bancarios, presentación a licitaciones y '
                . 'contrataciones con el Estado, y en algunos casos como condición para operar con '
                . 'proveedores o clientes grandes que exigen verificar la situación fiscal de sus '
                . 'contrapartes antes de cerrar una relación comercial.',
            'Un CCT no vigente no significa necesariamente que la empresa tenga una deuda: a veces basta '
                . 'con una declaración jurada presentada fuera de plazo, o con un dato no actualizado en '
                . 'Marangatu, para que el sistema no lo emita como vigente hasta que se regularice el punto '
                . 'puntual que lo bloquea.',
        ],
    ],
    [
        'h2'   => 'Cómo se obtiene en Marangatu',
        'body' => [
            'El certificado se consulta y descarga directamente desde Marangatu, el sistema de la DNIT, '
                . 'ingresando con RUC y clave de acceso a través del módulo de autenticación del sistema.',
        ],
        'items' => [
            ['title' => '1. Verificar declaraciones pendientes', 'text' => 'Antes de solicitar el certificado, conviene revisar que todas las declaraciones juradas —IVA mensual, IRE anual, y las que correspondan según su régimen— estén presentadas y sin observaciones abiertas.'],
            ['title' => '2. Confirmar que no haya deuda firme', 'text' => 'Cualquier deuda tributaria firme y exigible bloquea la emisión del certificado hasta que se regularice o se acuerde un plan de pago.'],
            ['title' => '3. Solicitar el certificado en Marangatu', 'text' => 'Una vez en regla, el certificado se genera desde el propio sistema, sin necesidad de presentarse en una oficina de la DNIT.'],
            ['title' => '4. Controlar la vigencia', 'text' => 'El certificado tiene un período de validez limitado, por lo que hay que volver a solicitarlo periódicamente si el trámite que lo exige lo requiere de forma recurrente.'],
        ],
    ],
    [
        'h2'   => 'Qué hacer si el certificado no sale vigente',
        'body' => [
            'Cuando Marangatu no emite el certificado como vigente, el sistema suele señalar el motivo: '
                . 'una declaración pendiente, una diferencia detectada por la DNIT o una deuda registrada. '
                . 'El primer paso es identificar exactamente cuál de esos puntos está bloqueando la '
                . 'emisión, en lugar de asumir que se trata de una deuda cuando muchas veces es solo una '
                . 'presentación atrasada que se puede regularizar en el mismo día.',
            'Si la causa es una deuda firme, existe la posibilidad de acordar un plan de facilidades de '
                . 'pago con la DNIT; una vez formalizado el plan y al día con las cuotas, el certificado '
                . 'vuelve a emitirse como vigente en la mayoría de los casos.',
        ],
    ],
    [
        'h2'   => 'Cómo mantenerlo vigente sin sobresaltos',
        'body' => [
            'La forma más simple de no depender de un trámite de urgencia cada vez que un banco o una '
                . 'licitación lo exige es mantener las declaraciones al día durante todo el año, en lugar '
                . 'de revisar la situación tributaria solo cuando alguien pide el certificado. Un '
                . 'contribuyente con su contabilidad, su IVA mensual y su declaración anual presentados en '
                . 'tiempo prácticamente nunca tiene sorpresas al momento de solicitar el CCT.',
            'Llevamos el seguimiento de vencimientos y presentaciones de cada cliente durante todo el año, '
                . 'precisamente para que el Certificado de Cumplimiento Tributario esté disponible el día '
                . 'que una operación bancaria o una licitación lo pida, sin trámites de emergencia de último '
                . 'momento.',
        ],
    ],
    [
        'h2'   => 'Cuánto tarda el trámite en la práctica',
        'body' => [
            'Cuando la situación tributaria está efectivamente en regla, el certificado se emite en el '
                . 'momento, apenas se solicita en Marangatu: no requiere un plazo de espera adicional ni '
                . 'una revisión manual de la DNIT. El tiempo real que toma "conseguir el certificado" casi '
                . 'siempre corresponde a resolver lo que lo está bloqueando —presentar una declaración '
                . 'atrasada, corregir un dato o negociar un plan de pago— y no al trámite de emisión en sí.',
            'Por eso conviene distinguir entre dos situaciones distintas: pedir el certificado como '
                . 'trámite de rutina, cuando todo está al día, y pedirlo bajo presión porque un banco lo '
                . 'exige para mañana. La primera situación no tiene sobresaltos; la segunda es la que '
                . 'conviene evitar manteniendo las presentaciones al día durante todo el año, en lugar de '
                . 'revisarlas recién cuando alguien pide el certificado con urgencia.',
        ],
    ],
    [
        'h2'   => 'Un chequeo rápido antes de solicitarlo',
        'body' => [
            'Antes de pedir el Certificado de Cumplimiento Tributario para una operación puntual —una '
                . 'línea de crédito, una licitación, la apertura de una cuenta corriente— conviene hacer un '
                . 'chequeo de tres puntos: que la última declaración jurada que corresponda a su régimen '
                . 'esté efectivamente presentada, que no haya una deuda firme sin plan de pago vigente, y '
                . 'que los datos de contacto y domicilio fiscal en Marangatu estén actualizados.',
            'Ese chequeo de tres puntos, hecho con unos días de anticipación, es lo que evita que un '
                . 'trámite bancario o una licitación quede detenido a última hora por un certificado que no '
                . 'salió vigente. Es exactamente el tipo de revisión que incorporamos al seguimiento mensual '
                . 'de cada cliente, para que nunca sea una sorpresa.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Para qué sirve el Certificado de Cumplimiento Tributario?',
        'a' => 'Confirma ante terceros —bancos, licitaciones, proveedores— que el contribuyente está al día '
             . 'con sus obligaciones fiscales ante la DNIT, sin deudas firmes ni presentaciones pendientes.',
    ],
    [
        'q' => '¿Por qué mi certificado no sale vigente si no tengo deudas?',
        'a' => 'Puede deberse a una declaración jurada presentada fuera de plazo o a un dato desactualizado '
             . 'en Marangatu, y no necesariamente a una deuda. Conviene revisar el motivo puntual que '
             . 'señala el sistema antes de asumir que se trata de dinero adeudado.',
    ],
    [
        'q' => '¿El certificado tiene vencimiento?',
        'a' => 'Sí, tiene un período de validez limitado. Si el trámite que lo exige es recurrente —como '
             . 'una licitación anual o una renovación bancaria— hay que volver a solicitarlo cada vez que '
             . 'corresponda.',
    ],
];

require ROOT_DIR . '/templates/article.php';
