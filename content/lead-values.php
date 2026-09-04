<?php
/**
 * The lead value model (plan §5.3.1). ONE record per source — every service
 * slug, every tool slug, every "¿Qué necesita?" chip — plus the neutral
 * default for pages that are none of those.
 *
 * `docs/lead-value.md` is the binding reasoning behind the tiers; this file is
 * the machine-readable form of it. Nothing else on the site decides a tier, a
 * conversion value or a WhatsApp prefill: pages read this through
 * lib/helpers.php's lead_value() / whatsapp_text_for_page(), so retuning the
 * model after four weeks of GA4 data (docs/lead-value.md rule 6) is one edit
 * here and no page changes.
 *
 * Record shape (every key required unless noted):
 *
 *   menuLabel     string   the short human name this source goes by in the
 *                          WhatsApp menu and in the CRM's `servicio` field. The
 *                          legacy page titles are frozen for SEO and terse
 *                          ("EAS", "RUC", "IVA"); a menu and a salesperson both
 *                          need "Abrir una EAS" (plan §5.3.8b names these four)
 *   need          string   key into ui('needs') — the chip this source maps to,
 *                          or a key in 'needLabels' below for sources with no
 *                          chip of their own (e.g. 'recordatorio')
 *   tier          string   'A' | 'B' | 'C' per docs/lead-value.md
 *   whatsappText  string   the wa.me prefill. Names the service the visitor was
 *                          reading about — never "consulta gratis" (plan §5.3.8)
 *   nextStep      string[] 2–3 lines shown after submit: what to have ready.
 *                          This is the second touch; it is worth reading
 *   crmTag        string   lands on the VenderCRM timeline as fields.etiqueta —
 *                          see the note on tags in enviar.php
 *   nextLink      ?array   optional ['path' => ..., 'label' => ...] tool or guide
 *                          offered alongside the thank-you text
 *
 * Adding a source: add a record keyed by its slug. Pages resolve by slug, so a
 * C2 guide or a C3 segment page joins the model by adding a key here.
 */

declare(strict_types=1);

/* The Google Ads conversion value per tier, in guaraníes. These are
   OPTIMISATION PROXIES, not revenue estimates (docs/lead-value.md): they exist
   so smart bidding favours a retainer lead over a calculator lead by 10:1.
   Changing the ratio is a one-line edit and needs no page change. */
$tierValues = [
    'A' => 1000000,
    'B' => 400000,
    'C' => 100000,
];

/* Labels for `need` keys that are not one of the six form chips, so the CRM
   reads "Recordatorio de vencimientos" instead of the raw key. */
$needLabels = [
    'recordatorio' => 'Recordatorio de vencimientos',
];

return [

    'tierValues' => $tierValues,
    'needLabels' => $needLabels,

    /* The neutral fallback: an article, a legal page, /nosotros/, anything with
       no service of its own. Still names a reason to write — just not a
       service the visitor never asked about. */
    'default' => [
        'need'         => 'otro',
        'tier'         => 'C',
        'whatsappText' => 'Hola, quiero hablar con un contador sobre mi empresa.',
        'nextStep'     => [
            'Le respondemos dentro del siguiente día hábil.',
            'Si quiere adelantar: tenga a mano su RUC (o el de la empresa) y el régimen en el que está inscripto.',
        ],
        'crmTag'   => 'web-general',
        'nextLink' => ['path' => '/herramientas/que-necesita/', 'label' => 'Ver qué necesita en 4 preguntas'],
    ],

    /* The four options the WhatsApp menu offers after the current page's own
       service (plan §5.3.8b), in this order. Anton's two priority services
       first (docs/lead-value.md). Slugs, resolved against the records below. */
    'whatsappMenu' => ['eas', 'ruc', 'contabilidad', 'ekuatia'],

    /* -------------------------------------------------------------- services */

    'services' => [

        /* --- Tier A: retainer or retainer-adjacent ------------------------ */

        'contabilidad' => [
            'menuLabel'    => 'Contabilidad mensual',
            'need'         => 'contabilidad',
            'tier'         => 'A',
            'whatsappText' => 'Hola, quiero ordenar la contabilidad mensual de mi empresa.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con una propuesta por escrito.',
                'Tenga a mano: RUC de la empresa, régimen (IRE Simple o General) y el último mes declarado.',
                'Si viene de otro contador, avísenos: pedimos el traspaso nosotros y usted no queda sin cobertura.',
            ],
            'crmTag'   => 'contabilidad-mensual',
            'nextLink' => ['path' => '/precios/', 'label' => 'Ver qué incluye cada plan'],
        ],

        'eas' => [
            'menuLabel'    => 'Abrir una EAS',
            'need'         => 'apertura',
            'tier'         => 'A',
            'whatsappText' => 'Hola, quiero abrir una EAS.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con el presupuesto y el plazo de la apertura.',
                'Tenga a mano: cédula de cada socio, el domicilio de la empresa y una idea del capital inicial.',
                '¿Ya tiene contador para después de la apertura? Una EAS declara desde el primer mes; podemos '
                    . 'dejar la contabilidad mensual armada junto con la constitución.',
            ],
            'crmTag'   => 'apertura-eas',
            'nextLink' => [
                'path'  => '/herramientas/comparador-eas-srl-unipersonal/',
                'label' => 'Comparar EAS, SRL y unipersonal',
            ],
        ],

        'ruc' => [
            'menuLabel'    => 'Inscribir mi RUC',
            'need'         => 'apertura',
            'tier'         => 'A',
            'whatsappText' => 'Hola, quiero inscribir mi RUC.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con la lista exacta de documentos para su caso.',
                'Tenga a mano: cédula vigente, un comprobante de domicilio y, si es empresa, el acta de constitución.',
                '¿Ya tiene contador? Desde el mes de la inscripción corren sus obligaciones ante la DNIT; '
                    . 'podemos encargarnos de las declaraciones desde la primera.',
            ],
            'crmTag'   => 'inscripcion-ruc',
            'nextLink' => ['path' => '/eas/', 'label' => 'Si además va a constituir una empresa'],
        ],

        'auditoria' => [
            'menuLabel'    => 'Auditoría',
            'need'         => 'otro',
            'tier'         => 'A',
            'whatsappText' => 'Hola, quiero un diagnóstico de auditoría para mi empresa.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil para acordar el diagnóstico inicial.',
                'Tenga a mano: los estados financieros de los últimos dos ejercicios y quién lleva hoy la contabilidad.',
            ],
            'crmTag' => 'auditoria',
        ],

        'auditoria-auditoria-impositiva' => [
            'menuLabel'    => 'Auditoría impositiva',
            'need'         => 'otro',
            'tier'         => 'A',
            'whatsappText' => 'Hola, necesito el dictamen de Auditoría Impositiva de mi empresa.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con el alcance y el plazo del dictamen.',
                'Tenga a mano: su RUC, el ejercicio a dictaminar y las declaraciones ya presentadas de ese período.',
            ],
            'crmTag' => 'auditoria-impositiva',
        ],

        'auditoria-auditoria-interna' => [
            'menuLabel'    => 'Auditoría interna',
            'need'         => 'otro',
            'tier'         => 'A',
            'whatsappText' => 'Hola, quiero una auditoría interna para mi empresa.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil para acordar el alcance.',
                'Tenga a mano: cuántas personas intervienen en compras, caja y facturación, y qué se controla hoy.',
            ],
            'crmTag' => 'auditoria-interna',
        ],

        'auditoria-auditoria-forense' => [
            'menuLabel'    => 'Auditoría forense',
            'need'         => 'otro',
            'tier'         => 'A',
            'whatsappText' => 'Hola, necesito una consultoría confidencial de auditoría forense.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil. La primera conversación es confidencial y sin cargo.',
                'No hace falta que reúna documentación todavía: primero acordamos el alcance y cómo preservar la evidencia.',
            ],
            'crmTag' => 'auditoria-forense',
        ],

        /* --- Tier B: a real business with a concrete compliance need ------- */

        'ekuatia' => [
            'menuLabel'    => 'Facturación electrónica (SIFEN)',
            'need'         => 'sifen',
            'tier'         => 'B',
            'whatsappText' => "Hola, quiero habilitarme en SIFEN / Ekuatia'i.",
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con los pasos de la habilitación en su caso.',
                'Tenga a mano: su RUC, su clave de acceso a Marangatu y si ya tiene o no certificado digital.',
            ],
            'crmTag'   => 'sifen-habilitacion',
            'nextLink' => ['path' => '/herramientas/vencimientos/', 'label' => 'Ver sus vencimientos por terminación de RUC'],
        ],

        'iva' => [
            'menuLabel'    => 'Declaraciones de IVA',
            'need'         => 'contabilidad',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quiero poner mi liquidación de IVA al día.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil.',
                'Tenga a mano: su RUC, los meses que faltan declarar y sus libros de compras y ventas del período.',
            ],
            'crmTag'   => 'iva',
            'nextLink' => ['path' => '/herramientas/calculadora-iva/', 'label' => 'Calculadora de IVA 10 % y 5 %'],
        ],

        'ire-simple' => [
            'menuLabel'    => 'IRE — renta empresarial',
            'need'         => 'contabilidad',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quiero revisar mi régimen de IRE.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con el régimen que le corresponde y por qué.',
                'Tenga a mano: su facturación del último ejercicio y su RUC.',
            ],
            'crmTag'   => 'ire',
            'nextLink' => ['path' => '/herramientas/vencimientos/', 'label' => 'Ver sus vencimientos por terminación de RUC'],
        ],

        'ips' => [
            'menuLabel'    => 'Nómina e IPS',
            'need'         => 'nomina',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quiero poner al día la nómina y el IPS de mi empresa.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil.',
                'Tenga a mano: cuántas personas tiene en planilla, desde cuándo, y si ya está inscripto como patronal en el IPS.',
            ],
            'crmTag'   => 'nomina-ips',
            'nextLink' => ['path' => '/herramientas/liquidacion-de-salario/', 'label' => 'Calculadora de liquidación de salario'],
        ],

        'asesoria' => [
            'menuLabel'    => 'Asesoría tributaria',
            'need'         => 'otro',
            'tier'         => 'B',
            'whatsappText' => 'Hola, quiero agendar una revisión de mi situación fiscal.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil para agendar la revisión.',
                'Tenga a mano: su RUC y las declaraciones de los últimos doce meses; con eso ya vemos dónde está parado.',
            ],
            'crmTag' => 'asesoria',
        ],

        'marangatu' => [
            'menuLabel'    => 'Mi cuenta en Marangatu',
            'need'         => 'contabilidad',
            'tier'         => 'B',
            'whatsappText' => 'Hola, necesito ayuda con mi cuenta en Marangatu.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil.',
                'Tenga a mano: su RUC y qué necesita hacer en Marangatu (recuperar la clave, declarar, actualizar datos).',
            ],
            'crmTag'   => 'marangatu',
            'nextLink' => ['path' => '/herramientas/vencimientos/', 'label' => 'Ver sus vencimientos por terminación de RUC'],
        ],

        /* --- Tier C: individuals, seasonal, list-building ------------------ */

        'irp' => [
            'menuLabel'    => 'IRP — renta personal',
            'need'         => 'otro',
            'tier'         => 'C',
            'whatsappText' => 'Hola, quiero saber si me corresponde presentar el IRP.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil y le decimos si le corresponde declarar.',
                'Tenga a mano: sus ingresos del año pasado y si ya está inscripto en el IRP.',
                'Si además tiene una empresa o factura por su cuenta, avísenos: la contabilidad mensual '
                    . 'suele salir más barata que resolver el IRP suelto cada marzo.',
            ],
            'crmTag' => 'irp',
        ],

        /* --- /en/ (C5): foreign founders opening a company in Paraguay ------
           Tier A per docs/lead-value.md ("Foreign founders are the highest
           ticket of all"). The only lead-values record whose whatsappText and
           menuLabel are English, not Spanish — the only pages that ever
           resolve to this slug are the /en/ ones (content/en.php,
           partials/lead-form-en.php), which never render through the Spanish
           WhatsApp menu (plan §5.3.8b's whatsappMenu[] does not list it). */
        'empresas-extranjeras' => [
            'menuLabel'    => 'Open a company in Paraguay',
            'need'         => 'apertura',
            'tier'         => 'A',
            'whatsappText' => 'Hello, I am opening a company in Paraguay as a foreign founder and would like to talk to an accountant.',
            'nextStep'     => [
                "We reply within the next business day with the entity type, timeline and budget for your case.",
                'Have ready: passports/IDs of every shareholder, a resident legal representative in Paraguay (or tell us if you need one), and an idea of your planned activity.',
                'If you already have a Paraguayan bank account or a local partner in mind, mention it — it changes the timeline.',
            ],
            'crmTag' => 'en-empresas-extranjeras',
        ],
    ],

    /* ----------------------------------------------------------------- tools */

    'tools' => [

        'calculadora-aguinaldo' => [
            'menuLabel'    => 'Calculadora de aguinaldo',
            'need'         => 'nomina',
            'tier'         => 'C',
            'whatsappText' => 'Hola, calculé mi aguinaldo en la página y quiero confirmar el monto con un contador.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con el cálculo revisado.',
                '¿Es empleador? Avísenos y le cotizamos la planilla completa; la liquidación de una sola persona no tiene costo.',
            ],
            'crmTag'   => 'herramienta-aguinaldo',
            'nextLink' => ['path' => '/ips/', 'label' => 'Nómina e IPS para empresas'],
        ],

        'liquidacion-de-salario' => [
            'menuLabel'    => 'Liquidación de salario',
            'need'         => 'nomina',
            'tier'         => 'C',
            'whatsappText' => 'Hola, calculé un finiquito en la página y quiero confirmar el monto con un contador.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con la liquidación revisada.',
                '¿Es empleador? Le preparamos la liquidación firmada y la comunicación al MTESS junto con la planilla del mes.',
            ],
            'crmTag'   => 'herramienta-liquidacion',
            'nextLink' => ['path' => '/ips/', 'label' => 'Nómina e IPS para empresas'],
        ],

        'vencimientos' => [
            'menuLabel'    => 'Recordatorio de vencimientos',
            'need'         => 'contabilidad',
            'tier'         => 'C',
            'whatsappText' => 'Hola, quiero que me recuerden mis vencimientos de la DNIT y el IPS por WhatsApp.',
            'nextStep'     => [
                'Anotamos su terminación de RUC y le avisamos antes de cada vencimiento.',
                'Si prefiere no acordarse nunca más: la contabilidad mensual presenta las declaraciones por usted.',
            ],
            'crmTag'   => 'herramienta-vencimientos',
            'nextLink' => ['path' => '/contabilidad/', 'label' => 'Contabilidad mensual'],
        ],

        'calculadora-iva' => [
            'menuLabel'    => 'Calculadora de IVA',
            'need'         => 'contabilidad',
            'tier'         => 'C',
            'whatsappText' => 'Hola, usé la calculadora de IVA y quiero ayuda con mi declaración jurada.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil.',
                'Tenga a mano: su RUC y los meses de IVA que le faltan presentar.',
            ],
            'crmTag'   => 'herramienta-iva',
            'nextLink' => ['path' => '/iva/', 'label' => 'Declaraciones de IVA'],
        ],

        /* The comparador is the "abrir empresa" branch: same tier as /eas/ and
           /ruc/, because someone comparing figuras jurídicas is opening one
           (docs/lead-value.md, Anton's priority services). */
        'comparador-eas-srl-unipersonal' => [
            'menuLabel'    => 'Comparar EAS, SRL y unipersonal',
            'need'         => 'apertura',
            'tier'         => 'A',
            'whatsappText' => 'Hola, usé el comparador de EAS/SRL/Unipersonal y quiero asesoría para abrir mi empresa.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con la figura que le conviene y el presupuesto.',
                'Tenga a mano: cuántos socios son, a qué se va a dedicar la empresa y una idea del capital inicial.',
                '¿Ya tiene contador para después de la apertura? Podemos dejar la contabilidad mensual armada '
                    . 'junto con la constitución.',
            ],
            'crmTag'   => 'herramienta-comparador',
            'nextLink' => ['path' => '/eas/', 'label' => 'Abrir una EAS'],
        ],

        /* The quiz reports the branch the visitor landed on through its own
           `need` chip; the record here is the floor when it lands on "otro". */
        'que-necesita' => [
            'menuLabel'    => 'Cuestionario "¿Qué necesita?"',
            'need'         => 'otro',
            'tier'         => 'C',
            'whatsappText' => 'Hola, completé el cuestionario "¿Qué necesita?" y quiero una consulta.',
            'nextStep'     => [
                'Le respondemos dentro del siguiente día hábil con lo que le corresponde y el presupuesto.',
                'Tenga a mano: su RUC (o el de la empresa) y el régimen en el que está inscripto.',
            ],
            'crmTag' => 'herramienta-quiz',
        ],
    ],

    /* --------------------------------------------------------- form chips ---
       A /contacto/ or homepage lead has no service page behind it, so it takes
       the tier of its "¿Qué necesita?" chip (docs/lead-value.md rule 1). Keys
       are ui('needs') keys; `service` names the record whose thank-you text and
       WhatsApp prefill the chip borrows, so there is still exactly one copy of
       each. */
    'needs' => [
        'contabilidad' => ['tier' => 'A', 'service' => 'contabilidad', 'crmTag' => 'contabilidad-mensual'],
        'apertura'     => ['tier' => 'A', 'service' => 'eas',          'crmTag' => 'apertura-empresa'],
        'cambio'       => ['tier' => 'A', 'service' => 'contabilidad', 'crmTag' => 'cambiar-de-contador'],
        'sifen'        => ['tier' => 'B', 'service' => 'ekuatia',      'crmTag' => 'sifen-habilitacion'],
        'nomina'       => ['tier' => 'B', 'service' => 'ips',          'crmTag' => 'nomina-ips'],
        'otro'         => ['tier' => 'C', 'service' => null,           'crmTag' => 'web-general'],
        'recordatorio' => ['tier' => 'C', 'service' => 'vencimientos', 'crmTag' => 'recordatorio-vencimientos'],
    ],
];
