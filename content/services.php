<?php
/**
 * The 14 service pages, keyed by slug. THIS SHAPE IS THE CONTRACT (plan §2):
 * B-phases fill the empty keys and may add optional ones, but never rename or
 * remove a key. README.md ("Content model") documents it for later phases.
 *
 *   path             string   URL, always with a trailing slash. Legacy paths are
 *                             frozen for SEO (plan §1.2) — never change one.
 *   title            string   the legacy H1 label. The concept is frozen; the
 *                             surrounding copy is not.
 *   navLabel         string   short label for the mega-menu and footer
 *   cluster          string   key into ui('clusters')
 *   parent           ?string  slug of the sub-hub this page sits under, if any
 *   seoTitle         string   <title> without the ' | Contador.com.py' suffix,
 *                             <= 42 chars so the full title stays under 60
 *   metaDescription  string   120–155 chars, unique across the whole site
 *   hero             array    eyebrow, h1, h2, lead
 *   includes         string[] the "Qué incluye" checklist
 *   sections         array    [['h2' => ..., 'body' => [paragraph, ...],
 *                              'items' => [['title' => ..., 'text' => ...]]], ...]
 *   benefits         array    [['title' => ..., 'text' => ...], ...]
 *   faq              array    [['q' => ..., 'a' => ...], ...] → FAQPage JSON-LD
 *   cta              array    label + whatsappText (the wa.me prefill)
 *   related          string[] sibling slugs, 3 per page
 *
 * A1 seeds path/title/navLabel/cluster/seoTitle/metaDescription/related only.
 * The provisional descriptions exist so the duplicate-metadata check in
 * verify.sh has something real to check; B1 rewrites all of them.
 */

declare(strict_types=1);

/**
 * Everything a B-phase has not written yet, so each record below stays readable.
 */
$empty = [
    'hero'     => ['eyebrow' => '', 'h1' => '', 'h2' => '', 'lead' => ''],
    'includes' => [],
    'sections' => [],
    'benefits' => [],
    'faq'      => [],
    'cta'      => ['label' => '', 'whatsappText' => ''],
];

return [

    // === Soluciones digitales de cumplimiento ===============================

    'ekuatia' => $empty + [
        'path'            => '/ekuatia/',
        'title'           => 'Ekuatia',
        'navLabel'        => 'Ekuatia',
        'cluster'         => 'digital',
        'parent'          => null,
        'seoTitle'        => "Ekuatia'i y factura electrónica",
        'metaDescription' => 'Habilitación en SIFEN y puesta en marcha de la factura electrónica con '
                           . "Ekuatia'i, para que emita comprobantes válidos desde el primer día.",
        'related'         => ['marangatu', 'ruc', 'iva'],
    ],

    'marangatu' => $empty + [
        'path'            => '/marangatu/',
        'title'           => 'Marangatu',
        'navLabel'        => 'Marangatu',
        'cluster'         => 'digital',
        'parent'          => null,
        'seoTitle'        => 'Marangatu: gestión ante la DNIT',
        'metaDescription' => 'Gestionamos su cuenta en el Sistema Marangatu ante la DNIT: declaraciones, '
                           . 'saneamiento de cuenta corriente y certificados al día.',
        'related'         => ['iva', 'ire-simple', 'ekuatia'],
    ],

    'ruc' => $empty + [
        'path'            => '/ruc/',
        'title'           => 'RUC',
        'navLabel'        => 'RUC',
        'cluster'         => 'digital',
        'parent'          => null,
        'seoTitle'        => 'Inscripción de RUC en Paraguay',
        'metaDescription' => 'Inscripción de RUC en Paraguay para empresas y profesionales independientes: '
                           . 'documentación, alta ante la DNIT y actualización de datos.',
        'related'         => ['eas', 'marangatu', 'ekuatia'],
    ],

    // === Gestión empresarial ================================================

    'contabilidad' => $empty + [
        'path'            => '/contabilidad/',
        'title'           => 'Contabilidad mensual',
        'navLabel'        => 'Contabilidad mensual',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'Contabilidad mensual para empresas',
        'metaDescription' => 'Contabilidad mensual para empresas en Paraguay: libros, conciliaciones y '
                           . 'estados financieros, con cierre antes del día 5 de cada mes.',
        'related'         => ['iva', 'ire-simple', 'asesoria'],
    ],

    'iva' => $empty + [
        'path'            => '/iva/',
        'title'           => 'IVA',
        'navLabel'        => 'IVA',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'Liquidación y declaración de IVA',
        'metaDescription' => 'Liquidación mensual de IVA y presentación de la declaración jurada ante la '
                           . 'DNIT, con el libro de compras y ventas siempre conciliado.',
        'related'         => ['ire-simple', 'contabilidad', 'marangatu'],
    ],

    'ire-simple' => $empty + [
        'path'            => '/ire-simple/',
        'title'           => 'IRE-simple',
        'navLabel'        => 'IRE-simple',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'IRE Simple, Resimple y F. 120',
        'metaDescription' => 'Liquidación de IRE Simple, Resimple e IRE General con la presentación del '
                           . 'Formulario 120 en Marangatu, dentro de los plazos de la DNIT.',
        'related'         => ['iva', 'contabilidad', 'irp'],
    ],

    'irp' => $empty + [
        'path'            => '/irp/',
        'title'           => 'IRP — Impuesto a la Renta Personal',
        'navLabel'        => 'IRP',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'IRP: Impuesto a la Renta Personal',
        'metaDescription' => 'IRP en Paraguay: definimos si le corresponde inscribirse, qué puede deducir '
                           . 'y presentamos su liquidación anual ante la DNIT.',
        'related'         => ['ire-simple', 'asesoria', 'ruc'],
    ],

    'ips' => $empty + [
        'path'            => '/ips/',
        'title'           => 'IPS',
        'navLabel'        => 'IPS',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'IPS y planilla de sueldos',
        'metaDescription' => 'Gestión de IPS y planilla de sueldos: altas y bajas, aportes mensuales, '
                           . 'planillas del MTESS y recibos listos para firmar.',
        'related'         => ['contabilidad', 'asesoria', 'eas'],
    ],

    'eas' => $empty + [
        'path'            => '/eas/',
        'title'           => 'EAS',
        'navLabel'        => 'EAS',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'Abrir una EAS en Paraguay',
        'metaDescription' => 'Abrir una EAS en Paraguay con acompañamiento completo: constitución, RUC, '
                           . 'patente y registro patronal, operativa en semanas y no en meses.',
        'related'         => ['ruc', 'ekuatia', 'contabilidad'],
    ],

    'asesoria' => $empty + [
        'path'            => '/asesoria/',
        'title'           => 'Asesoría',
        'navLabel'        => 'Asesoría',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'Asesoría tributaria y planificación',
        'metaDescription' => 'Asesoría tributaria y planificación fiscal para empresas paraguayas: '
                           . 'revisamos su carga impositiva y prevenimos contingencias con la DNIT.',
        'related'         => ['contabilidad', 'ire-simple', 'auditoria'],
    ],

    // === Auditoría ==========================================================

    'auditoria' => $empty + [
        'path'            => '/auditoria/',
        'title'           => 'Auditoría',
        'navLabel'        => 'Auditoría',
        'cluster'         => 'auditoria',
        'parent'          => null,
        'seoTitle'        => 'Auditoría para empresas en Paraguay',
        'metaDescription' => 'Servicios de auditoría en Paraguay: auditoría externa obligatoria, auditoría '
                           . 'interna y auditoría forense, con informes claros y accionables.',
        'related'         => [
            'auditoria-auditoria-impositiva',
            'auditoria-auditoria-interna',
            'auditoria-auditoria-forense',
        ],
    ],

    'auditoria-auditoria-impositiva' => $empty + [
        'path'            => '/auditoria-auditoria-impositiva/',
        'title'           => 'Auditoría Impositiva',
        'navLabel'        => 'Auditoría Impositiva',
        'cluster'         => 'auditoria',
        'parent'          => 'auditoria',
        'seoTitle'        => 'Auditoría Impositiva (externa)',
        'metaDescription' => 'Auditoría Impositiva y auditoría externa obligatoria: revisamos su situación '
                           . 'tributaria y emitimos el informe que exige la DNIT.',
        'related'         => ['auditoria', 'auditoria-auditoria-interna', 'asesoria'],
    ],

    'auditoria-auditoria-interna' => $empty + [
        'path'            => '/auditoria-auditoria-interna/',
        'title'           => 'Auditoría Interna',
        'navLabel'        => 'Auditoría Interna',
        'cluster'         => 'auditoria',
        'parent'          => 'auditoria',
        'seoTitle'        => 'Auditoría Interna y control',
        'metaDescription' => 'Auditoría Interna y control de gestión: evaluamos sus procesos y controles '
                           . 'para reducir riesgos operativos y pérdidas evitables.',
        'related'         => ['auditoria', 'auditoria-auditoria-forense', 'contabilidad'],
    ],

    'auditoria-auditoria-forense' => $empty + [
        'path'            => '/auditoria-auditoria-forense/',
        'title'           => 'Auditoría Forense',
        'navLabel'        => 'Auditoría Forense',
        'cluster'         => 'auditoria',
        'parent'          => 'auditoria',
        'seoTitle'        => 'Auditoría Forense y peritajes',
        'metaDescription' => 'Auditoría Forense y peritajes contables: investigamos fraudes, desvíos y '
                           . 'diferencias patrimoniales con informes de validez pericial.',
        'related'         => ['auditoria', 'auditoria-auditoria-impositiva', 'auditoria-auditoria-interna'],
    ],
];
