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
];
