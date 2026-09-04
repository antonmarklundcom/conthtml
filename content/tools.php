<?php
/**
 * The six tools under /herramientas/ (plan §6.3), keyed by slug — same shape
 * discipline as content/services.php: B3 fills every key here and future
 * phases may add optional ones, but never rename or remove one.
 *
 *   path             string   URL, trailing slash
 *   title            string   visible H1-adjacent concept, used as fallback title
 *   navLabel         string   short label for the herramientas hub, nav and footer
 *   seoTitle         string   <title> without the site suffix, <= 41 chars
 *   metaDescription  string   120–155 chars, unique across the whole site
 *   hero             array    eyebrow, h1, lead
 *   intro            string[] 200–300 words of SEO copy, readable without JS
 *                             (rendered above the calculator, per plan §6.3.1)
 *   faq              array    [['q' => ..., 'a' => ...], ...] → FAQPage JSON-LD
 *   related          string[] related service slugs (content/services.php)
 *   ctaWhatsapp      string   EMPTY and unused since C1 — the wa.me prefill for
 *                             every tool now comes from content/lead-values.php
 *                             through whatsapp_text_for_page() (plan §5.3.8a).
 *                             The key is kept so the record shape is stable.
 *   formNeed         string   pre-selected chip key in content/ui.php 'needs'
 *   analyticsTool    string   tool_used event name (assets/js/analytics.js)
 *
 * Order matches the keyword-volume priority in plan §6.3.1 (aguinaldo,
 * liquidación, vencimientos, IVA, comparador, quiz) — content('tools')
 * preserves insertion order, and content/nav.php and herramientas/index.php
 * both iterate it as-is.
 */

declare(strict_types=1);

return [

    'calculadora-aguinaldo' => [
        'path'            => '/herramientas/calculadora-aguinaldo/',
        'title'           => 'Calculadora de aguinaldo',
        'navLabel'        => 'Calculadora de aguinaldo',
        'seoTitle'        => 'Calculadora de aguinaldo Paraguay',
        'metaDescription' => 'Calcule su aguinaldo en guaraníes con sus propios salarios, con aguinaldo '
                            . 'proporcional incluido. Herramienta gratuita, según el Código del Trabajo.',
        'hero' => [
            'eyebrow' => 'Herramientas',
            'h1'      => 'Calculadora de aguinaldo en Paraguay',
            'lead'    => 'Calcule cuánto le corresponde cobrar, incluido el aguinaldo proporcional si '
                        . 'trabajó solo una parte del año.',
        ],
        'intro' => [
            'El aguinaldo, o sueldo anual complementario, es un derecho laboral obligatorio en Paraguay: '
                . 'equivale a la doceava parte de todas las remuneraciones que usted percibió durante el '
                . 'año calendario (salario, horas extraordinarias, comisiones y otros conceptos habituales). '
                . 'La ley exige que el empleador lo abone antes del 31 de diciembre de cada año, o antes si '
                . 'la relación laboral termina primero.',
            'Esta calculadora suma sus salarios del año y los divide entre 12, exactamente como lo indica '
                . 'la Ley Nº 417 y el Código del Trabajo. Si cobró el mismo sueldo todos los meses, cargue '
                . 'un solo monto y la cantidad de meses trabajados; si sus ingresos variaron mes a mes, '
                . 'cargue el detalle de cada mes y el resultado sale automáticamente proporcional a lo que '
                . 'realmente trabajó — no necesita activar nada aparte para el cálculo proporcional.',
            'El resultado es orientativo: no reemplaza la liquidación oficial de su empleador ni considera '
                . 'situaciones particulares como comisiones variables no habituales o regímenes especiales. '
                . 'Si necesita la liquidación de nómina de su empresa mes a mes, con el aguinaldo y los '
                . 'aportes de IPS ya calculados, escríbanos por WhatsApp.',
        ],
        'faq' => [
            ['q' => '¿Cuándo se cobra el aguinaldo?', 'a' => 'Antes del 31 de diciembre de cada año, o en el momento en que termina la relación laboral si eso ocurre antes de esa fecha.'],
            ['q' => '¿Qué pasa si trabajé solo unos meses del año?', 'a' => 'Cobra el aguinaldo proporcional a lo trabajado: la doceava parte de la suma de lo que efectivamente percibió, no del año completo. Cargue el detalle mensual o indique cuántos meses trabajó con el mismo salario.'],
            ['q' => '¿El aguinaldo paga aporte del 9 % al IPS?', 'a' => 'En general, el aguinaldo está exceptuado del aporte obrero del 9 % al IPS. Si su empresa tiene un régimen especial, confírmelo con nosotros.'],
            ['q' => '¿Qué conceptos entran en el cálculo?', 'a' => 'El salario ordinario, las horas extraordinarias y las comisiones u otros conceptos remunerativos habituales. Viáticos y beneficios no remunerativos no forman parte de la base.'],
        ],
        'related'       => ['ips', 'contabilidad', 'asesoria'],
        'ctaWhatsapp'   => '',
        'formNeed'      => 'nomina',
        'analyticsTool' => 'calculadora-aguinaldo',
    ],

    'liquidacion-de-salario' => [
        'path'            => '/herramientas/liquidacion-de-salario/',
        'title'           => 'Liquidación de salario y finiquito',
        'navLabel'        => 'Liquidación de salario',
        'seoTitle'        => 'Liquidación de salario y finiquito',
        'metaDescription' => 'Calcule su finiquito en Paraguay: salario proporcional, aporte IPS, '
                            . 'vacaciones, aguinaldo, preaviso e indemnización según el motivo de salida.',
        'hero' => [
            'eyebrow' => 'Herramientas',
            'h1'      => 'Calculadora de liquidación de salario y finiquito',
            'lead'    => 'Estime lo que le corresponde cobrar al terminar una relación laboral, según el '
                        . 'motivo: renuncia, despido justificado o injustificado.',
        ],
        'intro' => [
            'El finiquito es la liquidación final que recibe un trabajador al terminar su relación laboral: '
                . 'reúne el salario de los días trabajados, las vacaciones y el aguinaldo proporcionales, y — '
                . 'solo en un despido sin causa justificada — el preaviso no otorgado y la indemnización del '
                . 'Código del Trabajo. Una renuncia o un despido con causa justificada no generan preaviso ni '
                . 'indemnización a cargo del empleador.',
            'Esta calculadora toma su fecha de ingreso, su fecha de egreso, su salario mensual y el motivo '
                . 'de la salida, y arma cada línea por separado: el salario proporcional del último mes, la '
                . 'deducción del aporte obrero del 9 % al IPS, las vacaciones y el aguinaldo proporcionales a '
                . 'su antigüedad y, cuando corresponde, el preaviso (30 a 90 días según su antigüedad) y la '
                . 'indemnización (15 salarios diarios por año de servicio, según el Art. 91 del Código del '
                . 'Trabajo).',
            'El resultado usa un mes de 30 días, la convención habitual de nómina en Paraguay, y es un '
                . 'valor orientativo: la liquidación real depende de su recibo de sueldo, de conceptos '
                . 'variables y de acuerdos particulares. Para una liquidación exacta, escríbanos por '
                . 'WhatsApp con su caso.',
        ],
        'faq' => [
            ['q' => '¿Una renuncia se liquida igual que un despido?', 'a' => 'No. En una renuncia, el trabajador cobra el salario, las vacaciones y el aguinaldo proporcionales, pero no hay preaviso ni indemnización a cargo del empleador. En un despido sin causa justificada sí corresponden ambos.'],
            ['q' => '¿Qué es el preaviso y cuándo se paga?', 'a' => 'Es el aviso previo que debe dar quien despide sin causa justificada: 30 días de antigüedad hasta 1 año, 45 días de 1 a 5 años, 60 días de 5 a 10 años y 90 días de más de 10 años (Art. 87, Código del Trabajo). Si no se otorgó el aviso, se paga en dinero junto con el finiquito.'],
            ['q' => '¿Cómo se calcula la indemnización por despido?', 'a' => 'Quince salarios diarios por cada año de servicio, o fracción superior a seis meses, según el Art. 91 del Código del Trabajo. Solo corresponde cuando el despido no tiene causa justificada.'],
            ['q' => '¿Se descuenta el 9 % del IPS del finiquito?', 'a' => 'Sí, sobre los conceptos remunerativos (salario y vacaciones); el aguinaldo, la indemnización y el preaviso no forman parte de esa base según la práctica general.'],
        ],
        'related'       => ['ips', 'asesoria', 'contabilidad'],
        'ctaWhatsapp'   => '',
        'formNeed'      => 'nomina',
        'analyticsTool' => 'liquidacion-de-salario',
    ],

    'vencimientos' => [
        'path'            => '/herramientas/vencimientos/',
        'title'           => 'Calendario de vencimientos',
        'navLabel'        => 'Vencimientos',
        'seoTitle'        => 'Calendario de vencimientos DNIT e IPS',
        'metaDescription' => 'Vea sus próximas fechas de IVA, IRE e IPS según la terminación de su RUC, '
                            . 'con el Calendario Perpetuo de la DNIT. Consulte y reciba el recordatorio.',
        'hero' => [
            'eyebrow' => 'Herramientas',
            'h1'      => 'Calendario de vencimientos según su RUC',
            'lead'    => 'Indique la terminación de su RUC y vea sus próximas fechas de IVA, IRE e IPS.',
        ],
        'intro' => [
            'La DNIT asigna una fecha fija de vencimiento mensual a cada contribuyente según el último '
                . 'dígito de su RUC (sin contar el dígito verificador): es el Calendario Perpetuo de '
                . 'Vencimientos, vigente desde 2007 y confirmado por la Resolución General Nº 38/2020. Los '
                . 'vencimientos corren del día 7 al día 25 de cada mes, y se usan tanto para la declaración '
                . 'jurada mensual de IVA (Formulario 120) como para las presentaciones anuales de IRE e '
                . 'IRP.',
            'Elija la terminación de su RUC y esta herramienta calcula la fecha de este mes y del próximo '
                . 'para su IVA mensual, además de una referencia para el IRE anual y para los aportes de '
                . 'IPS, que se pagan del 1 al 10 del mes siguiente por igual para todos los empleadores, sin '
                . 'depender del RUC. Cuando una fecha cae sábado, domingo o feriado, la DNIT la traslada al '
                . 'siguiente día hábil — algo que esta calculadora no verifica automáticamente porque no '
                . 'consulta el calendario de feriados en tiempo real.',
            'Use el resultado como referencia, no como notificación oficial: la DNIT puede publicar '
                . 'calendarios especiales para determinados períodos o regímenes. Si prefiere que se lo '
                . 'recordemos nosotros cada mes por WhatsApp, use el botón de abajo.',
        ],
        'faq' => [
            ['q' => '¿Qué es el Calendario Perpetuo de la DNIT?', 'a' => 'Un esquema fijo que asigna a cada terminación de RUC (del 0 al 9) un día del mes, entre el 7 y el 25, para presentar y pagar sus obligaciones mensuales — principalmente el IVA en el Formulario 120.'],
            ['q' => '¿Qué pasa si el vencimiento cae fin de semana o feriado?', 'a' => 'La DNIT lo traslada al siguiente día hábil. Esta calculadora muestra la fecha del calendario sin ese ajuste; confirme el día hábil exacto cerca de la fecha.'],
            ['q' => '¿El vencimiento del IPS también depende de mi RUC?', 'a' => 'No. Los aportes obrero-patronales al IPS se presentan y pagan del día 1 al 10 del mes siguiente, igual para todos los empleadores.'],
            ['q' => '¿Cuándo vence el IRE anual?', 'a' => 'Dentro de los primeros meses del año siguiente al cierre de su ejercicio: IRE Simple e IRP suelen vencer en marzo e IRE General en abril, con el día exacto según su terminación de RUC. La DNIT confirma el mes preciso cada año.'],
        ],
        'related'       => ['iva', 'ire-simple', 'ips', 'marangatu'],
        'ctaWhatsapp'   => '',
        'formNeed'      => 'contabilidad',
        'analyticsTool' => 'vencimientos',
    ],

    'calculadora-iva' => [
        'path'            => '/herramientas/calculadora-iva/',
        'title'           => 'Calculadora de IVA',
        'navLabel'        => 'Calculadora de IVA',
        'seoTitle'        => 'Calculadora de IVA Paraguay (10 % y 5 %)',
        'metaDescription' => 'Calcule el IVA incluido o excluido de un monto en guaraníes, con la tasa '
                            . 'del 10 %, el 5 % o exento. Herramienta gratuita para facturas y cotizaciones.',
        'hero' => [
            'eyebrow' => 'Herramientas',
            'h1'      => 'Calculadora de IVA en Paraguay',
            'lead'    => 'Calcule el IVA incluido o excluido de un monto, con la tasa del 10 %, el 5 % o '
                        . 'exento.',
        ],
        'intro' => [
            'El IVA en Paraguay tiene dos tasas y un régimen exento: 10 % es la tasa general, que aplica a '
                . 'la mayoría de bienes y servicios; 5 % es la tasa reducida, que aplica a un listado '
                . 'acotado de bienes de consumo básico y a determinadas operaciones inmobiliarias y '
                . 'financieras; y hay operaciones exentas por ley. Confirme siempre la tasa que corresponde '
                . 'a su producto o servicio antes de facturar.',
            'Esta calculadora trabaja en los dos sentidos que más se usan en el día a día: monto IVA '
                . 'incluido (el precio final que paga el cliente, del que hay que separar cuánto es '
                . 'impuesto) y monto IVA excluido (la base imponible, a la que hay que sumarle el impuesto '
                . 'para llegar al precio final). Elija la tasa, cargue el monto y el sentido del cálculo, y '
                . 'obtiene la base imponible, el IVA y el total, en guaraníes.',
            'El resultado es un cálculo aritmético directo sobre el monto que usted cargó: no reemplaza su '
                . 'declaración jurada de IVA (Formulario 120), que suma todas sus operaciones del período y '
                . 'sus créditos fiscales. Si quiere que nos encarguemos de su liquidación mensual completa, '
                . 'escríbanos por WhatsApp.',
        ],
        'faq' => [
            ['q' => '¿Qué productos llevan IVA del 5 %?', 'a' => 'Un listado acotado de bienes de la canasta familiar y ciertas operaciones inmobiliarias y financieras. El listado puede cambiar por reglamentación: consulte el vigente en la DNIT o con nosotros antes de facturar.'],
            ['q' => '¿Cómo se calcula el IVA cuando el monto ya lo incluye?', 'a' => 'El impuesto es el monto multiplicado por la tasa y dividido por (100 + la tasa). Por ejemplo, con 10 %: IVA = monto × 10 ÷ 110.'],
            ['q' => '¿Este resultado sirve para mi factura?', 'a' => 'Sirve como referencia de cálculo, no como declaración jurada. Su Formulario 120 mensual se arma con el detalle de todas sus operaciones del período, créditos y débitos incluidos.'],
        ],
        'related'       => ['iva', 'ire-simple', 'asesoria'],
        'ctaWhatsapp'   => '',
        'formNeed'      => 'contabilidad',
        'analyticsTool' => 'calculadora-iva',
    ],

    'comparador-eas-srl-unipersonal' => [
        'path'            => '/herramientas/comparador-eas-srl-unipersonal/',
        'title'           => 'Comparador EAS, SRL y Unipersonal',
        'navLabel'        => 'EAS vs SRL vs Unipersonal',
        'seoTitle'        => 'Comparador: EAS, SRL o Unipersonal',
        'metaDescription' => 'Compare EAS, SRL y Unipersonal en Paraguay: responsabilidad, socios, '
                            . 'trámite y tributación, y responda 3 preguntas para ver cuál le conviene.',
        'hero' => [
            'eyebrow' => 'Herramientas',
            'h1'      => 'EAS, SRL o Unipersonal: ¿cuál le conviene?',
            'lead'    => 'Compare las tres formas más comunes de constituir una empresa en Paraguay y '
                        . 'responda tres preguntas para ver cuál se ajusta a su caso.',
        ],
        'intro' => [
            'Al abrir una empresa en Paraguay, las tres formas más habituales son la Unipersonal (una '
                . 'persona física que factura a su propio nombre), la EAS (Empresa por Acciones '
                . 'Simplificada, creada por la Ley Nº 6480/2020, con responsabilidad limitada y trámite por '
                . 'SUACE sin escritura pública) y la SRL (Sociedad de Responsabilidad Limitada, con dos o '
                . 'más socios y constitución por escritura pública). Ninguna de las tres es "mejor" en '
                . 'general: cada una resuelve una necesidad distinta.',
            'La tabla de abajo compara socios, responsabilidad patrimonial, capital mínimo, trámite de '
                . 'constitución y tributación de las tres. Si prefiere una recomendación rápida, responda '
                . 'las tres preguntas del mini cuestionario: cuántos socios tendrá la empresa, cuál es su '
                . 'facturación anual estimada y si quiere separar su patrimonio personal del de la empresa.',
            'La recomendación es orientativa y no sustituye un análisis de su caso concreto — el rubro, la '
                . 'proyección de crecimiento y la forma de facturar también influyen en la decisión '
                . 'correcta. Nos encargamos de la constitución completa, la inscripción de RUC y la puesta '
                . 'en marcha, cualquiera sea la forma que elija.',
        ],
        'faq' => [
            ['q' => '¿Puedo cambiar de Unipersonal a EAS o SRL más adelante?', 'a' => 'Sí. Es habitual empezar como Unipersonal y luego constituir una EAS o una SRL cuando la empresa crece o suma socios; implica un trámite nuevo, no una simple modificación.'],
            ['q' => '¿La EAS necesita escritura pública notarial?', 'a' => 'No. Se constituye a través del Sistema Unificado de Apertura y Cierre de Empresas (SUACE), sin necesidad de escritura pública, lo que la hace más rápida que una SRL.'],
            ['q' => '¿Cuál de las tres paga menos impuestos?', 'a' => 'La forma societaria en sí no define una tasa distinta: las tres tributan IRE (o IRP, la Unipersonal) según su régimen y su facturación anual, no según si son EAS, SRL o Unipersonal.'],
        ],
        'related'       => ['eas', 'ruc', 'asesoria'],
        'ctaWhatsapp'   => '',
        'formNeed'      => 'apertura',
        'analyticsTool' => 'comparador-eas-srl-unipersonal',
        // Static comparison table (plan §6.3.4), rendered by templates/tool.php
        // above the 3-question mini quiz.
        'table' => [
            'headers' => ['', 'Unipersonal', 'EAS', 'SRL'],
            'rows'    => [
                ['label' => 'Socios', 'values' => ['Uno (persona física)', 'Uno o más', 'Dos o más']],
                ['label' => 'Responsabilidad', 'values' => ['Ilimitada: responde con su patrimonio personal', 'Limitada al capital aportado', 'Limitada al aporte de cada socio']],
                ['label' => 'Capital mínimo', 'values' => ['No exige', 'Sin mínimo legal', 'Sin mínimo legal']],
                ['label' => 'Trámite de constitución', 'values' => ['Inscripción de RUC como persona física', 'SUACE, sin escritura pública notarial', 'Escritura pública e inscripción en el Registro Público de Comercio']],
                ['label' => 'Tributación', 'values' => ['IRE (Resimple/Simple/General) o IRP', 'IRE según su régimen', 'IRE según su régimen']],
                ['label' => 'Indicado para', 'values' => ['Un solo dueño, inicio rápido', 'Un solo dueño que quiere separar su patrimonio', 'Dos o más socios']],
            ],
        ],
    ],

    'que-necesita' => [
        'path'            => '/herramientas/que-necesita/',
        'title'           => '¿Qué necesita?',
        'navLabel'        => '¿Qué necesita?',
        'seoTitle'        => '¿Qué necesita? Guía de servicios',
        'metaDescription' => 'Responda 4 preguntas breves y le mostramos qué servicios contables le '
                            . 'corresponden, con el formulario de consulta ya prellenado.',
        'hero' => [
            'eyebrow' => 'Herramientas',
            'h1'      => '¿Qué necesita?',
            'lead'    => 'Responda cuatro preguntas breves y le mostramos qué servicios se ajustan a su '
                        . 'situación, listos para pedir cotización.',
        ],
        'intro' => [
            'No siempre es obvio por dónde empezar: puede que necesite contabilidad mensual, ponerse al '
                . 'día con la DNIT, liquidar la nómina de sus empleados, habilitarse en SIFEN o encargar una '
                . 'auditoría. Este cuestionario de cuatro pasos le hace las preguntas mínimas para orientarlo '
                . '— quién es, qué le preocupa hoy, si ya tiene contador y cuándo necesita empezar — y le '
                . 'muestra los servicios que corresponden a su respuesta.',
            'Al final, puede abrir el formulario de consulta con la opción correcta ya marcada, para no '
                . 'tener que explicar todo desde cero: solo complete sus datos de contacto y le respondemos '
                . 'con una propuesta concreta dentro del siguiente día hábil.',
            'Esto es una guía, no un diagnóstico completo: la recomendación se basa únicamente en sus '
                . 'cuatro respuestas y puede que su situación necesite más de un servicio a la vez. La '
                . 'conversación inicial con un contador, sin costo, sigue siendo el paso más preciso.',
        ],
        'faq' => [
            ['q' => '¿Esto reemplaza una consulta con un contador?', 'a' => 'No. Es una guía orientativa para saber por dónde empezar; la conversación inicial, sin costo, es la que confirma exactamente qué necesita su empresa.'],
            ['q' => '¿Mis respuestas quedan guardadas en algún lado?', 'a' => 'No. Las respuestas solo se usan en su navegador para armar la recomendación y, si usted lo decide, prellenar el formulario de consulta.'],
        ],
        'related'       => [],
        'ctaWhatsapp'   => '',
        'formNeed'      => 'otro',
        'analyticsTool' => 'que-necesita',
    ],
];
