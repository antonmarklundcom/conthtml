<?php
/**
 * Article index. The body of each article lives in its own
 * /blog/<slug>/index.php rendered through templates/article.php; this file is
 * the index the blog listing and sitemap.php read.
 *
 *   slug         string   directory name under /blog/
 *   title        string   H1 and card title — may run longer than the <title>
 *   seoTitle     string   <title>, <= 41 chars so it fits the 60-char budget
 *                         with the ' | Contador.com.py' suffix; '' falls back
 *                         to title (same pattern as content/services.php)
 *   description  string   meta description, 120–155 chars, unique site-wide
 *   date         string   YYYY-MM-DD, publication date
 *   updated      ?string  YYYY-MM-DD, when meaningfully revised
 *   tags         string[] free-form
 *   service      ?string  slug of the service this article links to
 */

declare(strict_types=1);

return [
    [
        'slug'        => 'como-se-calcula-el-aguinaldo-en-paraguay',
        'title'       => 'Cómo se calcula el aguinaldo en Paraguay (con ejemplos)',
        'seoTitle'    => 'Cómo se calcula el aguinaldo en Paraguay',
        'description' => 'Cómo se calcula el aguinaldo o décimo tercer salario en Paraguay, con ejemplos '
                       . 'de sueldo fijo, sueldo variable y aguinaldo proporcional.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['Aguinaldo', 'Nómina', 'IPS'],
        'service'     => 'ips',
    ],
    [
        'slug'        => 'ire-simple-resimple-ire-general-formulario-120',
        'title'       => 'IRE Simple vs Resimple vs IRE General: cuál le corresponde y el Formulario 120',
        'seoTitle'    => 'IRE Simple, Resimple o IRE General',
        'description' => 'Diferencias entre Resimple, IRE Simple e IRE General según su facturación anual, '
                       . 'y cómo se presenta el Formulario 120 en Marangatu.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['IRE', 'Formulario 120', 'Impuestos'],
        'service'     => 'ire-simple',
    ],
    [
        'slug'        => 'como-habilitarse-en-sifen-factura-electronica-ekuatia',
        'title'       => "Cómo habilitarse en SIFEN y emitir factura electrónica con Ekuatia'i",
        'seoTitle'    => 'Habilitarse en SIFEN: guía paso a paso',
        'description' => "Los pasos para habilitarse en SIFEN y empezar a emitir factura electrónica con "
                       . "Ekuatia'i: firma digital, timbrado electrónico y primeros comprobantes.",
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['SIFEN', "Ekuatia'i", 'Factura electrónica'],
        'service'     => 'ekuatia',
    ],
    [
        'slug'        => 'certificado-de-cumplimiento-tributario-marangatu',
        'title'       => 'Cómo obtener el Certificado de Cumplimiento Tributario en Marangatu',
        'seoTitle'    => 'Certificado de Cumplimiento Tributario',
        'description' => 'Qué es el Certificado de Cumplimiento Tributario, quién lo exige y los pasos '
                       . 'para obtenerlo y mantenerlo vigente en Marangatu.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['Marangatu', 'DNIT', 'Certificado de Cumplimiento'],
        'service'     => 'marangatu',
    ],
    [
        'slug'        => 'abrir-una-eas-en-paraguay',
        'title'       => 'Abrir una EAS en Paraguay: pasos, costos y plazos',
        'seoTitle'    => 'Abrir una EAS en Paraguay: pasos y plazos',
        'description' => 'Cómo constituir una Empresa por Acciones Simplificada en Paraguay: requisitos, '
                       . 'trámite por SUACE, plazos habituales y qué esperar del proceso.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['EAS', 'Apertura de empresa'],
        'service'     => 'eas',
    ],
    [
        'slug'        => 'balance-general-estado-de-resultados-flujo-de-efectivo',
        'title'       => 'Balance general, estado de resultados y flujo de efectivo: cómo leer los '
                       . 'estados financieros de su empresa',
        'seoTitle'    => 'Cómo leer sus estados financieros',
        'description' => 'Qué muestra cada estado financiero — balance general, estado de resultados y '
                       . 'flujo de efectivo — y cómo usarlos para decidir sobre su empresa.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['Estados financieros', 'Contabilidad'],
        'service'     => 'contabilidad',
    ],

    // === Round 2 (phase C4) ===================================================

    [
        'slug'        => 'liquidacion-por-despido-vs-renuncia',
        'title'       => 'Liquidación por despido vs. renuncia: qué cambia en el finiquito',
        'seoTitle'    => 'Liquidación: despido vs. renuncia',
        'description' => 'Qué conceptos cobra un trabajador según renuncie o sea despedido en Paraguay: '
                       . 'preaviso, indemnización y qué queda igual en los dos casos.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['Liquidación', 'Despido', 'IPS'],
        'service'     => 'ips',
    ],
    [
        'slug'        => 'aguinaldo-cuando-se-cobra-y-proporcional',
        'title'       => '¿Cuándo se cobra el aguinaldo y cómo se calcula el proporcional?',
        'seoTitle'    => 'Aguinaldo: cuándo se cobra y proporcional',
        'description' => 'La fecha límite del aguinaldo en Paraguay y cómo se calcula el aguinaldo '
                       . 'proporcional cuando no se trabajó el año completo.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['Aguinaldo', 'Nómina'],
        'service'     => 'ips',
    ],
    [
        'slug'        => 'multas-dnit-cuanto-son-y-como-evitarlas',
        'title'       => 'Multas de la DNIT: cómo se generan y cómo evitarlas',
        'seoTitle'    => 'Multas DNIT: cómo evitarlas',
        'description' => 'Por qué la DNIT aplica multas aunque su declaración esté en cero, cómo saber '
                       . 'si tiene una pendiente y los pasos para evitarlas.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['DNIT', 'Multas', 'Cumplimiento'],
        'service'     => 'asesoria',
    ],
    [
        'slug'        => 'marangatu-2-0-que-cambio',
        'title'       => 'Marangatu 2.0: qué cambió y cómo encontrar lo de siempre',
        'seoTitle'    => 'Marangatu 2.0: qué cambió',
        'description' => 'Qué es Marangatu 2.0, qué se reorganizó en el menú y dónde quedaron la consulta '
                       . 'de RUC, el Formulario 120 y el Certificado de Cumplimiento Tributario.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['Marangatu', 'DNIT'],
        'service'     => 'marangatu',
    ],
    [
        'slug'        => 'eas-vs-srl-vs-unipersonal-cual-conviene',
        'title'       => 'EAS vs. SRL vs. Unipersonal: cuál le conviene',
        'seoTitle'    => 'EAS, SRL o Unipersonal: cuál elegir',
        'description' => 'Diferencias entre EAS, SRL y Unipersonal en socios, responsabilidad y trámite '
                       . 'de constitución, para elegir la estructura que le corresponde.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['EAS', 'SRL', 'Unipersonal', 'Apertura de empresa'],
        'service'     => 'eas',
    ],
    [
        'slug'        => 'iva-10-y-5-que-lleva-cada-uno',
        'title'       => 'IVA 10% y 5%: qué lleva cada tasa',
        'seoTitle'    => 'IVA 10% y 5%: qué lleva cada uno',
        'description' => 'Qué bienes y servicios pagan el IVA general del 10% y cuáles la tasa reducida '
                       . 'del 5% en Paraguay, y cómo evitar el error más común al clasificarlos.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['IVA', 'Formulario 120'],
        'service'     => 'iva',
    ],
    [
        'slug'        => 'irp-2026-quien-paga-y-como-se-liquida',
        'title'       => 'IRP en 2026: quién paga y cómo se liquida',
        'seoTitle'    => 'IRP 2026: quién paga y cómo se liquida',
        'description' => 'Quién debe inscribirse al IRP en Paraguay, qué ingresos se suman y cómo es el '
                       . 'proceso de liquidación anual ante la DNIT.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['IRP', 'Impuestos'],
        'service'     => 'irp',
    ],
    [
        'slug'        => 'inscripcion-patronal-ips-paso-a-paso',
        'title'       => 'Inscripción patronal en el IPS, paso a paso',
        'seoTitle'    => 'Inscripción patronal IPS, paso a paso',
        'description' => 'Cómo inscribirse como empleador en el IPS al contratar a su primer trabajador '
                       . 'en Paraguay: documentos, plazos y los aportes que empiezan a correr.',
        'date'        => '2026-09-04',
        'updated'     => null,
        'tags'        => ['IPS', 'Nómina', 'Empleador'],
        'service'     => 'ips',
    ],
];
