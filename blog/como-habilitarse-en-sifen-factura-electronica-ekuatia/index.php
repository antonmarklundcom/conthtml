<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'como-habilitarse-en-sifen-factura-electronica-ekuatia';

$sections = [
    [
        'h2'   => '¿Qué es SIFEN?',
        'body' => [
            'SIFEN (Sistema Integrado de Facturación Electrónica Nacional) es la plataforma de la DNIT '
                . 'que recibe, valida y almacena los comprobantes electrónicos emitidos por los '
                . 'contribuyentes paraguayos. Cuando una empresa "se habilita en SIFEN", lo que hace en la '
                . 'práctica es autorizarse ante la DNIT para emitir factura electrónica en lugar de la '
                . 'factura preimpresa o autoimpresora tradicional.',
            'La factura electrónica no es un PDF cualquiera: es un documento firmado digitalmente que la '
                . 'DNIT valida en el momento de la emisión y queda registrado en SIFEN de forma inmediata, '
                . 'con validez legal desde ese instante para el emisor y para quien la recibe.',
        ],
    ],
    [
        'h2'   => "Ekuatia'i vs Ekuatia: cuál le corresponde",
        'body' => [
            "La DNIT ofrece dos caminos para emitir factura electrónica. Ekuatia'i es la herramienta "
                . 'gratuita de la propia DNIT, pensada para contribuyentes con uno o pocos puntos de '
                . 'expedición y un volumen de facturación moderado: se emite directamente desde el '
                . "portal, sin necesidad de un sistema propio. Ekuatia, en cambio, es el término que "
                . 'engloba la integración de un sistema de facturación propio —o de un proveedor— con '
                . 'SIFEN mediante web services, pensada para empresas con mayor volumen o con varios '
                . 'puntos de expedición que necesitan emitir automáticamente desde su propio software.',
            "Para la mayoría de los unipersonales, profesionales independientes y pymes que están "
                . "habilitándose por primera vez, Ekuatia'i es el punto de partida más práctico: no "
                . 'requiere inversión en un sistema de facturación y cubre perfectamente un volumen '
                . 'mensual moderado de comprobantes.',
        ],
    ],
    [
        'h2'   => 'Los pasos para habilitarse',
        'body' => [
            'El proceso de habilitación tiene un orden que conviene respetar para no perder tiempo yendo '
                . 'y viniendo entre trámites.',
        ],
        'items' => [
            ['title' => '1. Firma digital', 'text' => 'Se obtiene el certificado que valida legalmente cada comprobante que la empresa emita. Sin firma digital vigente, no hay forma de firmar los documentos electrónicos.'],
            ['title' => '2. Solicitud de habilitación en la DNIT', 'text' => 'Se presenta la solicitud para convertirse en emisor electrónico, indicando los puntos de expedición del contribuyente.'],
            ['title' => "3. Elección del sistema", 'text' => "Ekuatia'i para uno o pocos puntos de expedición y volumen moderado, o una integración vía Ekuatia si la empresa ya usa (o va a usar) un sistema de facturación propio."],
            ['title' => '4. Ambiente de prueba', 'text' => 'Antes de emitir comprobantes con validez fiscal, la DNIT exige comprobar el correcto funcionamiento del sistema en un ambiente de prueba.'],
            ['title' => '5. Primeros comprobantes reales', 'text' => 'Una vez aprobada la prueba, la empresa queda habilitada para emitir factura electrónica con validez legal inmediata.'],
        ],
    ],
    [
        'h2'   => 'Qué cambia frente a la factura preimpresa',
        'body' => [
            'Con la factura preimpresa, el timbrado tiene una vigencia que hay que renovar y los '
                . 'talonarios físicos hay que imprimirlos, almacenarlos y cuidar que no se pierdan. Con '
                . 'factura electrónica, el comprobante nace firmado digitalmente, llega a la DNIT y al '
                . 'cliente en segundos, y queda respaldado y verificable en SIFEN en cualquier momento, sin '
                . 'depender de un archivo físico.',
            'Esto también simplifica la contabilidad mensual: los comprobantes electrónicos son más fáciles '
                . 'de conciliar contra el libro de compras y ventas que los talonarios en papel, porque ya '
                . 'nacen en formato digital y estructurado.',
        ],
    ],
    [
        'h2'   => 'Errores frecuentes al habilitarse',
        'body' => [
            'El error más común es dejar la firma digital para último momento, cuando ya se necesita '
                . 'facturar: el trámite de obtención no es instantáneo y conviene iniciarlo con anticipación. '
                . 'El segundo error frecuente es elegir un sistema sobredimensionado —una integración '
                . 'compleja para un volumen que Ekuatia\'i cubriría sin costo— o, al revés, subestimar el '
                . 'volumen real y quedar limitado por un sistema pensado para un solo punto de expedición.',
            'También es común no capacitar a quien emite y recibe comprobantes en la empresa: el sistema '
                . 'puede estar técnicamente habilitado y aun así generar errores de carga si el equipo no '
                . 'sabe qué datos son obligatorios en cada tipo de comprobante.',
        ],
    ],
    [
        'h2'   => 'Qué gana su contabilidad al facturar electrónicamente',
        'body' => [
            'Más allá del cumplimiento ante la DNIT, habilitarse en SIFEN simplifica el trabajo mensual de '
                . 'cierre contable. Cada comprobante electrónico ya nace estructurado y firmado, con fecha, '
                . 'monto y RUC del receptor validados por la DNIT en el mismo momento de la emisión, lo que '
                . 'reduce el trabajo de digitación manual que antes exigía cargar cada factura preimpresa '
                . 'una por una para armar el libro de ventas.',
            'Para una empresa que además liquida IVA mensualmente, esto tiene un efecto directo: menos '
                . 'diferencias entre lo facturado y lo declarado, porque el comprobante que respalda cada '
                . 'venta o compra ya está validado por el mismo sistema que recibe la declaración jurada. '
                . 'Es una de las razones por las que recomendamos avanzar hacia la factura electrónica '
                . 'incluso a quien todavía no está obligado por su volumen o su rubro.',
        ],
    ],
    [
        'h2'   => 'Cuánto tiempo suele tomar el proceso completo',
        'body' => [
            'El tiempo real varía según cuánto tarde en resolverse la firma digital —el paso que más '
                . 'depende de un trámite externo— y según si la empresa elige Ekuatia\'i, que se activa '
                . 'directamente desde el portal de la DNIT, o una integración vía Ekuatia con un sistema '
                . 'propio, que además requiere tiempo de configuración técnica antes del ambiente de '
                . 'prueba.',
            'Iniciar el trámite de firma digital apenas se decide habilitarse, en lugar de dejarlo para '
                . 'cuando ya urge emitir el primer comprobante electrónico, es lo que marca la diferencia '
                . 'entre un proceso ordenado y uno hecho contra reloj. Acompañamos cada uno de estos pasos '
                . '—firma digital, solicitud ante la DNIT, elección de sistema y ambiente de prueba— para '
                . 'que la habilitación no dependa de que el cliente entienda por su cuenta la secuencia '
                . 'correcta.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Qué es SIFEN?',
        'a' => 'Es el Sistema Integrado de Facturación Electrónica Nacional de la DNIT: la plataforma que '
             . 'recibe, valida y almacena todos los comprobantes electrónicos emitidos en Paraguay.',
    ],
    [
        'q' => "¿Cuál es la diferencia entre Ekuatia y Ekuatia'i?",
        'a' => "Ekuatia'i es la herramienta gratuita de la DNIT para emitir factura electrónica desde el "
             . 'portal, pensada para uno o pocos puntos de expedición. Ekuatia es la integración de un '
             . 'sistema propio o de un proveedor con SIFEN mediante web services, para mayor volumen o '
             . 'varios puntos de expedición.',
    ],
    [
        'q' => '¿Puedo seguir usando factura preimpresa después de habilitarme en SIFEN?',
        'a' => 'La DNIT define plazos y grupos de contribuyentes obligados a migrar a factura electrónica. '
             . 'Confirmamos su situación puntual antes de decidir si conviene mantener el timbrado vigente '
             . 'en paralelo durante la transición.',
    ],
];

require ROOT_DIR . '/templates/article.php';
