<?php
/**
 * The ten how-to guides under /guias/ (plan §6.5), keyed by slug — same shape
 * discipline as content/services.php and content/tools.php: C2 fills every key
 * here and future phases may add optional ones, but never rename or remove one.
 *
 * Why this content type exists: "marangatu" (165 000/mo), "ekuatia i" (22 200,
 * +309 %), "sifen" (2 900), "inscripción ruc" (2 400, +50 %), "certificado
 * cumplimiento tributario" (+136 %) and "multas dnit" (+22 %) are how-to
 * intent a service page only partly answers. A guide answers the question in
 * full, then offers the "Cuándo conviene delegarlo" box to hand the task over.
 * Guides are organic-only (docs/lead-value.md rule 4: never bid on the
 * navigational giants) and are tier C sources in content/lead-values.php,
 * except where the delegate-it intent is real (CCT, multas) and the matching
 * service is tier B.
 *
 *   path             string   URL, trailing slash
 *   title            string   visible H1-adjacent concept, used as fallback title
 *   navLabel         string   short label for the /guias/ hub, nav and footer
 *   seoTitle         string   <title> without the site suffix, <= 41 chars
 *   metaDescription  string   120–155 chars, unique across the whole site
 *   lastReviewed     string   ISO date, shown next to the "orientativo" note
 *                             (same convention as content/laboral.php and
 *                             content/vencimientos.php)
 *   hero             array    eyebrow, h1, lead
 *   intro            string[] 2–3 paragraphs read before the numbered steps
 *   steps            array    [['title' => ..., 'body' => string[]], ...] →
 *                             both the visible numbered list and the HowTo
 *                             JSON-LD steps (templates/guide.php builds both
 *                             from this one array)
 *   faq              array    [['q' => ..., 'a' => ...], ...] → FAQPage JSON-LD
 *   relatedService   ?string  slug into content/services.php AND
 *                             content/lead-values.php — the "Cuándo conviene
 *                             delegarlo" box's form, WhatsApp prefill and
 *                             next-step text all resolve from this one slug
 *   toolLink         ?array   ['path' => '/herramientas/<slug>/', 'label' =>
 *                             ..., 'text' => ...] — one tool link where a
 *                             matching calculator exists (plan §6.5.1), null
 *                             otherwise
 *   related          string[] 2–3 sibling guide slugs
 *   thumbnail        ?array   optional ['src' => ..., 'alt' => ...] rendered
 *                             as a card thumbnail by templates/guide.php when
 *                             present; guides without one render no image
 *
 * Every legal number, deadline, system name or process detail stated below is
 * logged in docs/facts-to-verify.md with its source and confidence, per the
 * copy brief in prompts/sonnet-1-services.md (binding for C2 too, per
 * prompts/sonnet-5-guias.md). Nothing here was scraped from dnit.gov.py or
 * ips.gov.py — general knowledge and the facts already checked in B1/B2/B3 are
 * reused where they apply to the same system (Marangatu, Ekuatia/Ekuatia'i,
 * the Calendario Perpetuo), and anything new is hedged the same way those
 * phases hedge: "consulte el monto/plazo vigente" instead of a number nobody
 * verified this phase.
 */

declare(strict_types=1);

return [

    'como-ingresar-a-marangatu' => [
        'path'            => '/guias/como-ingresar-a-marangatu/',
        'title'           => 'Cómo ingresar a Marangatu',
        'navLabel'        => 'Cómo ingresar a Marangatu',
        'seoTitle'        => 'Cómo ingresar a Marangatu, paso a paso',
        'metaDescription' => 'Cómo ingresar a Marangatu, recuperar su clave de acceso y entender qué '
                            . 'cambió con Marangatu 2.0. Guía paso a paso, sin costo.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Cómo ingresar a Marangatu',
            'lead'    => 'El paso a paso para entrar a su cuenta en el sistema tributario de la DNIT, '
                        . 'recuperar la clave si la perdió y entender qué cambió con Marangatu 2.0.',
        ],
        'intro' => [
            'Marangatu es el sistema en línea de la DNIT (antes SET) donde cada contribuyente presenta '
                . 'sus declaraciones juradas, consulta su situación tributaria y gestiona los datos de su '
                . 'RUC. Es, junto con Ekuatia, el sistema que más gente busca sin encontrar fácil de usar '
                . 'la primera vez — sobre todo después de la migración a Marangatu 2.0, que cambió la '
                . 'interfaz y reorganizó varios trámites que antes estaban en otro lugar del menú.',
            'Esta guía explica cómo llegar a la pantalla de acceso, qué hacer si no recuerda su clave y '
                . 'qué preguntas resuelve la mayoría de las personas que buscan "marangatu" sin saber '
                . 'exactamente qué necesitan. Si su objetivo final es presentar una declaración o resolver '
                . 'un problema puntual con su cuenta y prefiere que alguien lo haga por usted, la sección '
                . 'del final explica cómo delegarlo.',
        ],
        'steps' => [
            [
                'title' => 'Ubique el acceso a Marangatu',
                'body'  => [
                    'El ingreso se hace desde el sitio institucional de la DNIT, en la sección dedicada al '
                        . 'Sistema Marangatu. Confirme siempre que está en un dominio oficial de la DNIT antes '
                        . 'de escribir su clave — es el paso donde más fraudes de phishing ocurren, porque el '
                        . 'sistema es de acceso masivo y la gente busca el acceso directo en buscadores.',
                ],
            ],
            [
                'title' => 'Ingrese con su RUC y su clave de acceso',
                'body'  => [
                    'El acceso pide su número de RUC (sin dígito verificador en algunas pantallas, con él en '
                        . 'otras) y la clave de acceso que la DNIT le asignó al inscribirse o que usted mismo '
                        . 'configuró después. No es la misma clave que usa para Ekuatia si tiene un usuario '
                        . 'distinto para facturación electrónica.',
                ],
            ],
            [
                'title' => 'Si no recuerda la clave, use la opción de recuperación',
                'body'  => [
                    'La pantalla de acceso tiene una opción para restablecer la clave, que suele pedir datos '
                        . 'de verificación de su RUC. Si la recuperación automática no funciona — pasa seguido '
                        . 'cuando el correo o el teléfono registrado ya no están al día — el trámite se resuelve '
                        . 'presencialmente en una oficina de la DNIT o a través de un contador matriculado '
                        . 'que gestione la cuenta en su nombre.',
                ],
            ],
            [
                'title' => 'Verifique que está en la versión Marangatu 2.0',
                'body'  => [
                    'La DNIT migró el sistema a una nueva versión con una interfaz distinta a la anterior: '
                        . 'el menú se reorganizó y algunos trámites que antes tenían su propia pantalla ahora '
                        . 'están agrupados de otra manera. Si usted usaba Marangatu hace tiempo y no encuentra '
                        . 'algo donde antes estaba, lo más probable es que se haya movido de sección, no que '
                        . 'haya desaparecido.',
                ],
            ],
            [
                'title' => 'Una vez adentro, revise su situación antes de declarar',
                'body'  => [
                    'Antes de presentar cualquier declaración, revise el estado de su cuenta: si tiene '
                        . 'vencimientos pendientes, si hay alguna inconsistencia marcada en su RUC o si le '
                        . 'falta algún dato de contacto actualizado. Resolver eso primero evita errores en la '
                        . 'declaración que después hay que rectificar.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Marangatu y Ekuatia son lo mismo?', 'a' => 'No. Marangatu es el sistema donde presenta declaraciones juradas y gestiona su cuenta tributaria; Ekuatia (y Ekuatia\'i) es el sistema de facturación electrónica. Pueden compartir algunos datos de acceso, pero son sistemas distintos con funciones distintas.'],
            ['q' => '¿Qué es Marangatu 2.0?', 'a' => 'La versión actualizada del sistema, con una interfaz reorganizada. Si usted usaba la versión anterior, algunos trámites cambiaron de ubicación dentro del menú, pero siguen existiendo.'],
            ['q' => '¿Perdí mi clave y no tengo el correo registrado actualizado, qué hago?', 'a' => 'Cuando la recuperación automática no funciona, el trámite se resuelve presencialmente en una oficina de la DNIT o mediante un contador matriculado que gestione el restablecimiento en su nombre.'],
            ['q' => '¿Cómo sé si tengo multas de la DNIT?', 'a' => 'Su situación de cumplimiento se consulta dentro de Marangatu, en la sección de su cuenta tributaria. Si prefiere que lo revisemos nosotros, tiene la guía dedicada a multas y regularización más abajo.'],
        ],
        'relatedService' => 'marangatu',
        'toolLink' => [
            'path'  => '/herramientas/vencimientos/',
            'label' => 'Vea sus próximos vencimientos',
            'text'  => 'Calcule sus fechas de IVA, IRE e IPS según la terminación de su RUC.',
        ],
        'related' => ['certificado-de-cumplimiento-tributario', 'multas-dnit-como-regularizar', 'consulta-de-ruc'],
    ],

    'consulta-de-ruc' => [
        'path'            => '/guias/consulta-de-ruc/',
        'title'           => 'Consulta de RUC',
        'navLabel'        => 'Consulta de RUC',
        'seoTitle'        => 'Consulta de RUC Paraguay: buscar un RUC',
        'metaDescription' => 'Consulta de RUC en Paraguay: cómo buscar un RUC por número o por nombre, '
                            . 'cómo saber su propio RUC y qué datos muestra la DNIT en cada caso.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Consulta de RUC en Paraguay: cómo buscar un RUC',
            'lead'    => 'Verifique su propio RUC o el de un proveedor, cliente o empleador antes de '
                        . 'facturar, firmar un contrato o presentar una declaración.',
        ],
        'intro' => [
            'Consultar un RUC significa verificar los datos públicos asociados a un número de Registro '
                . 'Único del Contribuyente: si está activo, el nombre o razón social registrado y, según el '
                . 'caso, su situación de cumplimiento tributario. Se hace por dos motivos habituales: '
                . 'confirmar el propio RUC antes de un trámite, o verificar el de un tercero antes de '
                . 'facturarle, contratarlo o aceptar un pago.',
            'Esta guía cubre ambos casos: qué necesita para consultar su propio RUC y qué puede — y qué no '
                . 'puede — verificar del RUC de otra persona o empresa antes de hacer negocios.',
        ],
        'steps' => [
            [
                'title' => 'Tenga a mano el número completo',
                'body'  => [
                    'Un RUC paraguayo se compone del número base y un dígito verificador, separados por un '
                        . 'guion (por ejemplo, 80012345-6). Para consultar el suyo, lo encuentra en su '
                        . 'constancia de inscripción o en cualquier documento que la DNIT le haya emitido.',
                ],
            ],
            [
                'title' => 'Ingrese a la consulta pública de RUC de la DNIT',
                'body'  => [
                    'La DNIT ofrece una consulta pública para verificar si un RUC está activo y a nombre de '
                        . 'quién está registrado, sin necesidad de clave de acceso — es distinta de Marangatu, '
                        . 'que sí requiere clave porque muestra datos privados de la cuenta.',
                ],
            ],
            [
                'title' => 'Si solo tiene el nombre: buscar RUC por nombre',
                'body'  => [
                    'Para buscar el RUC de una persona o empresa de la que solo conoce el nombre o la razón '
                        . 'social, la DNIT publica el listado de contribuyentes con su RUC, dígito verificador '
                        . 'y estado, en archivos descargables que se actualizan periódicamente. Para un caso '
                        . 'puntual, lo más simple sigue siendo pedirle el RUC a la persona o empresa: figura '
                        . 'en cualquier factura que haya emitido.',
                ],
            ],
            [
                'title' => 'Interprete el resultado',
                'body'  => [
                    'La consulta pública confirma que el RUC existe, está activo y a qué nombre está '
                        . 'registrado. No muestra el detalle de las declaraciones presentadas ni la situación '
                        . 'de multas de un tercero — esos datos son privados y solo los ve el titular de la '
                        . 'cuenta desde dentro de Marangatu.',
                ],
            ],
            [
                'title' => 'Si el RUC no aparece o figura inactivo',
                'body'  => [
                    'Un RUC inactivo o que no aparece puede significar que el trámite de inscripción todavía '
                        . 'está en proceso, que el número se escribió mal o que la actividad fue clausurada. '
                        . 'Antes de facturar o firmar con esa persona o empresa, confirme directamente con ella '
                        . 'o pida asesoría para verificar la situación.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Puedo ver si un tercero tiene multas de la DNIT solo con su RUC?', 'a' => 'No. La consulta pública muestra si el RUC está activo y a nombre de quién está registrado, pero la situación de multas y declaraciones es información privada, visible solo por el titular dentro de Marangatu.'],
            ['q' => '¿Qué diferencia hay entre consultar el RUC y entrar a Marangatu?', 'a' => 'La consulta de RUC es pública y no requiere clave: solo confirma existencia y titularidad. Marangatu es la cuenta privada donde el titular ve su propia situación completa y presenta declaraciones.'],
            ['q' => '¿Cómo sé cuál es mi RUC?', 'a' => 'Si es persona física, su RUC es su número de cédula seguido de un guion y el dígito verificador (por ejemplo, 1234567-8). Lo confirma en su constancia de inscripción, en cualquier factura que haya emitido o dentro de Marangatu. Si nunca se inscribió, todavía no tiene RUC: vea la guía de inscripción de RUC.'],
            ['q' => '¿La consulta de RUC tiene costo?', 'a' => 'No. La consulta pública de la DNIT es gratuita y no pide clave de acceso.'],
            ['q' => '¿El RUC de una persona física y el de una empresa se consultan igual?', 'a' => 'Sí, la consulta pública funciona igual para ambos: solo cambia si el nombre registrado es el de la persona física o la razón social de la empresa.'],
        ],
        'relatedService' => 'ruc',
        'toolLink' => null,
        'related' => ['inscripcion-de-ruc-paso-a-paso', 'como-ingresar-a-marangatu'],
    ],

    'ekuatiai-paso-a-paso' => [
        'path'            => '/guias/ekuatiai-paso-a-paso/',
        'title'           => "Ekuatia'i paso a paso",
        'navLabel'        => "Ekuatia'i paso a paso",
        'seoTitle'        => "Ekuatia'i paso a paso: habilitación",
        'metaDescription' => "Cómo habilitarse en Ekuatia'i y emitir su primera factura electrónica en "
                            . "Paraguay: requisitos, pasos y la diferencia con Ekuatia. Guía completa.",
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => "Ekuatia'i paso a paso: habilitación y primera factura",
            'lead'    => "Cómo habilitarse en Ekuatia'i, la herramienta gratuita de la DNIT para emitir "
                        . 'factura electrónica, y emitir su primera factura sin errores.',
        ],
        'intro' => [
            "Ekuatia'i es la herramienta gratuita que la DNIT pone a disposición de los contribuyentes "
                . 'para emitir factura electrónica sin necesidad de contratar un proveedor de software '
                . 'externo — pensada para negocios de un solo punto de emisión, con un volumen de '
                . 'facturación que no justifica una integración más compleja. Es distinta de Ekuatia, el '
                . 'sistema más amplio que integra por software a empresas con mayor volumen o múltiples '
                . 'puntos de venta directamente contra SIFEN.',
            "Habilitarse en Ekuatia'i es, en la práctica, el paso que activa el timbrado electrónico para "
                . 'su RUC: desde ese momento, sus facturas dejan de imprimirse en papel autorizado por una '
                . 'imprenta y pasan a emitirse y validarse electrónicamente. Esta guía explica el orden de '
                . 'los pasos, desde tener el RUC al día hasta emitir la primera factura.',
        ],
        'steps' => [
            [
                'title' => 'Confirme que su RUC está activo y sin inconsistencias',
                'body'  => [
                    'La habilitación en facturación electrónica parte de un RUC en orden: sin declaraciones '
                        . 'pendientes que generen una inconsistencia y con los datos de la actividad económica '
                        . 'correctamente registrados en Marangatu.',
                ],
            ],
            [
                'title' => 'Solicite la habilitación como emisor electrónico',
                'body'  => [
                    "El trámite de habilitación se gestiona desde su cuenta en el sistema de la DNIT vinculado "
                        . "a Ekuatia'i. La DNIT revisa la solicitud y, una vez aprobada, activa el RUC para "
                        . 'emitir comprobantes electrónicos.',
                ],
            ],
            [
                'title' => 'Configure los datos de su primera factura',
                'body'  => [
                    "Antes de emitir, cargue correctamente la actividad económica, el punto de expedición y "
                        . 'los datos del cliente. Un error común de quien recién se habilita es dejar campos '
                        . 'con la configuración por defecto en lugar de los datos reales de su negocio.',
                ],
            ],
            [
                'title' => 'Emita y verifique el Kude',
                'body'  => [
                    'Cada factura electrónica genera un Kude — la representación gráfica del comprobante, con '
                        . 'un código QR que permite verificarla contra el registro de la DNIT. Revise que el '
                        . 'Kude se genere correctamente y que el cliente pueda validarlo antes de dar por '
                        . 'cerrado el proceso.',
                ],
            ],
            [
                'title' => 'Guarde el respaldo de cada comprobante',
                'body'  => [
                    "Aunque la factura es electrónica, su empresa sigue obligada a conservar el respaldo "
                        . 'de cada operación para su declaración jurada de IVA y para una eventual '
                        . 'fiscalización. Ordenar este archivo desde el primer mes evita trabajo doble después.',
                ],
            ],
        ],
        'faq' => [
            ["q" => "¿Cuál es la diferencia entre Ekuatia y Ekuatia'i?", "a" => "Ekuatia'i es la herramienta gratuita de la DNIT para negocios con un punto de emisión y volumen moderado. Ekuatia es el sistema más amplio, pensado para empresas que integran su propio software de facturación directamente contra SIFEN."],
            ['q' => '¿Qué es SIFEN?', 'a' => 'Es el Sistema Integrado de Facturación Electrónica Nacional: la infraestructura de la DNIT que valida y registra cada comprobante electrónico emitido en el país, sea a través de Ekuatia\'i o de un proveedor integrado.'],
            ['q' => '¿Sigo pudiendo usar factura de imprenta después de habilitarme?', 'a' => 'Una vez habilitado como emisor electrónico para una actividad, esa actividad pasa a facturar electrónicamente. La DNIT define los plazos y alcances de la migración según el cronograma vigente para cada contribuyente.'],
            ['q' => '¿Qué pasa si no facturé nada en un período?', 'a' => 'Igual corresponde presentar la declaración jurada de IVA del período, aunque sea en cero. No facturar no exime de presentar el Formulario 120 correspondiente.'],
        ],
        'relatedService' => 'ekuatia',
        'toolLink' => null,
        'related' => ['que-es-sifen', 'como-ingresar-a-marangatu'],
        'thumbnail' => [
            'src' => '/assets/img/factura-electronica-sifen-marangatu-1280.avif',
            'alt' => 'Ilustración editorial de un documento digital conectado a una institución que representa la facturación electrónica SIFEN y Marangatu.',
        ],
    ],

    'que-es-sifen' => [
        'path'            => '/guias/que-es-sifen/',
        'title'           => '¿Qué es SIFEN?',
        'navLabel'        => '¿Qué es SIFEN?',
        'seoTitle'        => '¿Qué es SIFEN? Explicación completa',
        'metaDescription' => 'Qué es SIFEN, cómo funciona con Ekuatia y Ekuatia\'i, y qué significa para su '
                            . 'empresa la factura electrónica en Paraguay. Guía sin tecnicismos.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => '¿Qué es SIFEN?',
            'lead'    => 'El sistema detrás de la factura electrónica en Paraguay, explicado sin '
                        . 'tecnicismos: qué hace, quién lo usa y cómo se relaciona con Ekuatia.',
        ],
        'intro' => [
            'SIFEN es la sigla del Sistema Integrado de Facturación Electrónica Nacional, la '
                . 'infraestructura de la DNIT que recibe, valida y registra cada comprobante electrónico '
                . 'emitido en Paraguay. No es una aplicación que usted usa directamente para facturar: es '
                . 'el sistema central contra el que validan tanto Ekuatia\'i (la herramienta gratuita de la '
                . 'DNIT) como cualquier software de facturación de terceros integrado por API.',
            'Cuando alguien busca "sifen" en general está buscando entender qué es este sistema antes de '
                . 'decidir cómo va a facturar electrónicamente su negocio, o quiere confirmar que un '
                . 'comprobante que recibió es válido. Esta guía responde ambas cosas.',
        ],
        'steps' => [
            [
                'title' => 'Entienda el rol de SIFEN',
                'body'  => [
                    'SIFEN valida en tiempo real cada factura electrónica emitida en el país: revisa que los '
                        . 'datos sean correctos, le asigna un CDC (Código de Control) único y devuelve la '
                        . 'aprobación al emisor. Sin esa validación, el comprobante no es una factura legal.',
                ],
            ],
            [
                'title' => 'Identifique las dos formas de conectarse a SIFEN',
                'body'  => [
                    "Un negocio llega a SIFEN de dos maneras: usando Ekuatia'i, la herramienta gratuita de la "
                        . 'DNIT para un solo punto de emisión, o integrando un software de facturación propio '
                        . 'o de un proveedor (Ekuatia) contra la API de SIFEN, más habitual en empresas con '
                        . 'mayor volumen o varios puntos de venta.',
                ],
            ],
            [
                'title' => 'Verifique un comprobante electrónico que recibió',
                'body'  => [
                    'Todo Kude (la representación gráfica de una factura electrónica) incluye un código QR '
                        . 'que permite verificar el comprobante contra el registro de SIFEN. Si el código no '
                        . 'valida, el comprobante no está confirmado como legítimo.',
                ],
            ],
            [
                'title' => 'Decida cómo va a conectar su propio negocio',
                'body'  => [
                    "Si su volumen de facturación es bajo y emite desde un solo punto, Ekuatia'i suele ser "
                        . 'suficiente. Si ya usa un sistema de punto de venta o factura desde varios locales, '
                        . 'una integración directa contra SIFEN a través de un proveedor puede ahorrarle '
                        . 'trabajo manual.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿SIFEN es lo mismo que Ekuatia?', 'a' => 'No. SIFEN es el sistema central de la DNIT que valida las facturas electrónicas. Ekuatia y Ekuatia\'i son las herramientas que se conectan a SIFEN para emitir esas facturas.'],
            ['q' => '¿Antes de SIFEN existía otro sistema?', 'a' => 'La facturación electrónica se implementó de forma gradual bajo la entidad que hoy es la DNIT — antes SET —, ampliando el alcance de contribuyentes obligados con el tiempo.'],
            ['q' => '¿Cómo verifico si una factura que me dieron es válida?', 'a' => 'Escanee el código QR del Kude: lo lleva a la verificación contra el registro de SIFEN, donde puede confirmar que el comprobante fue efectivamente emitido y validado.'],
        ],
        'relatedService' => 'ekuatia',
        'toolLink' => null,
        'related' => ['ekuatiai-paso-a-paso', 'como-ingresar-a-marangatu'],
        'thumbnail' => [
            'src' => '/assets/img/factura-electronica-sifen-marangatu-1280.avif',
            'alt' => 'Ilustración editorial de un documento digital conectado a una institución que representa la facturación electrónica SIFEN y Marangatu.',
        ],
    ],

    'inscripcion-de-ruc-paso-a-paso' => [
        'path'            => '/guias/inscripcion-de-ruc-paso-a-paso/',
        'title'           => 'Inscripción de RUC paso a paso',
        'navLabel'        => 'Inscripción de RUC paso a paso',
        'seoTitle'        => 'Inscripción de RUC, paso a paso',
        'metaDescription' => 'Cómo inscribirse al RUC en Paraguay como persona física o jurídica: '
                            . 'documentos, pasos y plazos habituales. Guía completa y gratuita.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Inscripción de RUC paso a paso',
            'lead'    => 'Los pasos y documentos para inscribirse al RUC, tanto si va a facturar como '
                        . 'persona física como si va a abrir una empresa.',
        ],
        'intro' => [
            'Inscribirse al RUC (Registro Único del Contribuyente) es el trámite que lo habilita a '
                . 'facturar legalmente en Paraguay, sea como persona física que va a trabajar por cuenta '
                . 'propia o como empresa recién constituida. Sin RUC activo no puede emitir comprobantes '
                . 'ni presentar declaraciones — es, literalmente, el primer paso de cualquier actividad '
                . 'económica formal en el país.',
            'El trámite cambia levemente según si inscribe a una persona física o a una persona jurídica '
                . '(una empresa ya constituida, por ejemplo una EAS o una SRL). Esta guía cubre el orden '
                . 'general de los pasos y qué documentos suele pedir cada caso.',
        ],
        'steps' => [
            [
                'title' => 'Defina si se inscribe como persona física o jurídica',
                'body'  => [
                    'Una persona física se inscribe a su propio nombre, con su cédula de identidad. Una '
                        . 'persona jurídica — una empresa ya constituida, sea EAS, SRL u otra forma societaria '
                        . '— se inscribe después de la constitución, con su propio número de RUC distinto al '
                        . 'de sus socios.',
                ],
            ],
            [
                'title' => 'Reúna los documentos base',
                'body'  => [
                    'Para persona física: cédula de identidad vigente y un comprobante de domicilio. Para '
                        . 'persona jurídica: el acta o documento de constitución de la empresa y la cédula de '
                        . 'cada socio o representante. La lista exacta puede variar según el tipo societario y '
                        . 'la actividad declarada.',
                ],
            ],
            [
                'title' => 'Declare la actividad económica correcta',
                'body'  => [
                    'El código de actividad económica que declara al inscribirse determina, entre otras '
                        . 'cosas, el régimen de IVA e IRE que le corresponde. Una actividad mal declarada '
                        . 'puede generar inconsistencias más adelante — vale la pena revisarla con cuidado, '
                        . 'no solo copiar la más parecida.',
                ],
            ],
            [
                'title' => 'Presente la solicitud',
                'body'  => [
                    'La inscripción se presenta ante la DNIT con la documentación reunida. El plazo de '
                        . 'aprobación habitual es de 24 a 72 horas hábiles una vez que la solicitud está '
                        . 'completa, aunque puede extenderse si la DNIT pide alguna aclaración o documento '
                        . 'adicional.',
                ],
            ],
            [
                'title' => 'Active su cuenta en Marangatu y, si va a facturar, en Ekuatia',
                'body'  => [
                    'Con el RUC aprobado, el siguiente paso es configurar el acceso a Marangatu para poder '
                        . 'declarar, y solicitar la habilitación como emisor electrónico si va a facturar '
                        . 'desde el primer mes — casi todos los negocios nuevos lo hacen.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Cuánto tarda la inscripción de RUC?', 'a' => 'El plazo habitual de aprobación es de 24 a 72 horas hábiles con la documentación completa. Puede extenderse si la DNIT solicita alguna aclaración.'],
            ['q' => '¿Necesito un contador para inscribirme al RUC?', 'a' => 'No es obligatorio, pero declarar la actividad económica y el régimen tributario correctos desde el inicio evita correcciones después — por eso muchas personas prefieren que un contador gestione el trámite completo.'],
            ['q' => '¿Puedo inscribirme al RUC y a la vez abrir una EAS?', 'a' => 'Sí: la EAS se constituye y, como parte de ese mismo proceso, se tramita su propio RUC como persona jurídica, distinto del RUC personal de cada socio.'],
            ['q' => '¿Qué pasa si me equivoco en la actividad económica declarada?', 'a' => 'Se puede corregir mediante una actualización de datos ante la DNIT, pero conviene hacerlo cuanto antes: una actividad mal declarada puede afectar el régimen de IVA e IRE que le corresponde mientras tanto.'],
        ],
        'relatedService' => 'ruc',
        'toolLink' => [
            'path'  => '/herramientas/comparador-eas-srl-unipersonal/',
            'label' => 'Compare EAS, SRL y Unipersonal',
            'text'  => 'Vea cuál figura le conviene antes de inscribir el RUC de su empresa.',
        ],
        'related' => ['consulta-de-ruc', 'inscripcion-patronal-ips'],
        'thumbnail' => [
            'src' => '/assets/img/apertura-eas-documentos-paraguay-1280.avif',
            'alt' => 'Ilustración editorial de una puerta de local comercial entreabierta que representa la apertura de una empresa en Paraguay.',
        ],
    ],

    'formulario-120-paso-a-paso' => [
        'path'            => '/guias/formulario-120-paso-a-paso/',
        'title'           => 'Formulario 120 paso a paso',
        'navLabel'        => 'Formulario 120 paso a paso',
        'seoTitle'        => 'Formulario 120 (IVA): cómo presentarlo',
        'metaDescription' => 'Cómo se completa y presenta el Formulario 120 de IVA en Marangatu: qué '
                            . 'datos pide, cuándo vence y qué pasa si no facturó en el período.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Formulario 120 paso a paso',
            'lead'    => 'Cómo se completa la declaración jurada de IVA en Marangatu, mes a mes, y qué '
                        . 'hacer cuando el período no tuvo movimiento.',
        ],
        'intro' => [
            'El Formulario 120 es la declaración jurada mensual de IVA que presenta la mayoría de los '
                . 'contribuyentes inscriptos en Paraguay, dentro de Marangatu. Reúne el débito fiscal (el '
                . 'IVA de sus ventas) y el crédito fiscal (el IVA de sus compras) del período, y determina '
                . 'si corresponde pagar un saldo o si queda un crédito a favor.',
            'Presentarlo bien no es solo cargar números: depende de tener ordenados los comprobantes de '
                . 'compras y ventas del mes antes de sentarse a declarar. Esta guía explica el orden de los '
                . 'pasos y los errores más comunes de quien lo presenta por primera vez.',
        ],
        'steps' => [
            [
                'title' => 'Reúna los comprobantes del período antes de empezar',
                'body'  => [
                    'Ordene todas las facturas de venta y de compra del mes, incluidas las electrónicas. '
                        . 'Declarar sin tener el detalle completo es la causa más común de una rectificativa '
                        . 'posterior.',
                ],
            ],
            [
                'title' => 'Identifique el débito fiscal',
                'body'  => [
                    'Es el IVA generado por sus ventas del período, según la tasa que corresponda a cada '
                        . 'operación: 10 % general, 5 % reducida o exenta según el bien o servicio.',
                ],
            ],
            [
                'title' => 'Identifique el crédito fiscal',
                'body'  => [
                    'Es el IVA que pagó en sus compras y gastos vinculados a la actividad gravada del '
                        . 'período. Solo el crédito fiscal vinculado a operaciones gravadas es deducible en el '
                        . 'formulario.',
                ],
            ],
            [
                'title' => 'Complete el Formulario 120 en Marangatu',
                'body'  => [
                    'Con el débito y el crédito fiscal ya ordenados, la carga en el formulario dentro de '
                        . 'Marangatu es, en general, una cuestión de trasladar esos totales a los campos '
                        . 'correspondientes y confirmar la presentación antes del vencimiento de su terminación '
                        . 'de RUC.',
                ],
            ],
            [
                'title' => 'Presente en cero si no tuvo movimiento',
                'body'  => [
                    'No facturar en un período no exime de presentar el Formulario 120 de ese mes: '
                        . 'corresponde presentarlo igual, declarando débito y crédito fiscal en cero. Omitir la '
                        . 'presentación genera una inconsistencia aunque no haya impuesto a pagar.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Qué pasa si no vendí nada en el mes?', 'a' => 'Igual corresponde presentar el Formulario 120 de ese período, declarándolo en cero. No presentarlo genera una inconsistencia en su cuenta, aunque no haya IVA a pagar.'],
            ['q' => '¿Cuándo vence el Formulario 120?', 'a' => 'Según el Calendario Perpetuo de la DNIT, en una fecha fija entre el día 7 y el 25 del mes siguiente, determinada por la terminación de su RUC. Puede verificar su fecha en la calculadora de vencimientos.'],
            ['q' => '¿Puedo corregir un Formulario 120 ya presentado?', 'a' => 'Sí, mediante una declaración rectificativa. Cuanto antes se detecte el error, más simple es corregirlo antes de que afecte declaraciones posteriores.'],
            ['q' => '¿El Formulario 120 sirve para el IRE también?', 'a' => 'No. El Formulario 120 es específico de IVA, mensual. El IRE se liquida y presenta en sus propios formularios, con periodicidad anual.'],
        ],
        'relatedService' => 'iva',
        'toolLink' => [
            'path'  => '/herramientas/calculadora-iva/',
            'label' => 'Calculadora de IVA',
            'text'  => 'Calcule el IVA incluido o excluido de un monto antes de declarar.',
        ],
        'related' => ['que-es-sifen', 'irp-quien-debe-pagar'],
        'thumbnail' => [
            'src' => '/assets/img/declaracion-ire-iva-paraguay-1280.avif',
            'alt' => 'Ilustración editorial de documentos con una marca de verificación que representan la declaración de IRE e IVA en Paraguay.',
        ],
    ],

    'certificado-de-cumplimiento-tributario' => [
        'path'            => '/guias/certificado-de-cumplimiento-tributario/',
        'title'           => 'Certificado de Cumplimiento Tributario',
        'navLabel'        => 'Certificado de Cumplimiento Tributario',
        'seoTitle'        => 'Cómo obtener el Certificado Tributario',
        'metaDescription' => 'Cómo obtener el Certificado de Cumplimiento Tributario en Marangatu, para '
                            . 'qué se usa y qué hacer si no se lo emiten por una inconsistencia.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Cómo obtener el Certificado de Cumplimiento Tributario',
            'lead'    => 'El paso a paso para emitir su CCT desde Marangatu, y qué hacer si el sistema le '
                        . 'marca una inconsistencia antes de emitirlo.',
        ],
        'intro' => [
            'El Certificado de Cumplimiento Tributario (CCT) es el documento que confirma que un '
                . 'contribuyente está al día con sus obligaciones ante la DNIT. Lo piden habitualmente '
                . 'bancos antes de otorgar un crédito, licitaciones públicas y privadas, y contrapartes '
                . 'comerciales que quieren confirmar la situación fiscal de un proveedor antes de cerrar un '
                . 'contrato importante.',
            'Emitirlo es simple cuando la cuenta está realmente al día; el problema aparece cuando el '
                . 'sistema detecta una inconsistencia — una declaración faltante, un pago pendiente o un dato '
                . 'desactualizado — y no lo emite hasta que se resuelve. Esta guía explica ambos caminos.',
        ],
        'steps' => [
            [
                'title' => 'Ingrese a su cuenta en Marangatu',
                'body'  => [
                    'La emisión del CCT se hace desde la cuenta del contribuyente en Marangatu, con su RUC y '
                        . 'clave de acceso.',
                ],
            ],
            [
                'title' => 'Ubique la opción de emisión del certificado',
                'body'  => [
                    'Dentro del menú de su cuenta hay una sección específica para solicitar y descargar el '
                        . 'Certificado de Cumplimiento Tributario, disponible una vez confirmada su situación.',
                ],
            ],
            [
                'title' => 'Si el sistema no lo emite, revise la causa',
                'body'  => [
                    'Cuando el CCT no se emite, el sistema suele indicar el motivo: una declaración jurada '
                        . 'pendiente de presentar, un saldo impago o una inconsistencia de datos. El certificado '
                        . 'no se emite hasta que esa causa se resuelve.',
                ],
            ],
            [
                'title' => 'Regularice la inconsistencia',
                'body'  => [
                    'Presente la declaración faltante, pague el saldo pendiente o corrija el dato marcado, '
                        . 'según cuál sea la causa. Una vez resuelto, el certificado suele quedar disponible '
                        . 'para su emisión en poco tiempo.',
                ],
            ],
            [
                'title' => 'Descargue y valide el certificado',
                'body'  => [
                    'El CCT se descarga en formato digital y tiene una vigencia limitada — quien se lo pide '
                        . '(un banco, una licitación) suele exigir que esté emitido dentro de un plazo reciente, '
                        . 'no cualquier certificado anterior.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Para qué sirve el Certificado de Cumplimiento Tributario?', 'a' => 'Confirma ante un tercero — un banco, una licitación, una contraparte comercial — que usted está al día con sus obligaciones ante la DNIT. Es un requisito habitual para créditos y licitaciones.'],
            ['q' => '¿Por qué no me emite el certificado si creo estar al día?', 'a' => 'Puede haber una inconsistencia que usted no detectó: una declaración presentada fuera de plazo, un pago parcial o un dato de contacto desactualizado. El sistema muestra el motivo al intentar emitirlo.'],
            ['q' => '¿Cuánto tiempo es válido el certificado?', 'a' => 'Tiene una vigencia limitada; quien lo solicita suele pedir que esté emitido dentro de un período reciente, así que conviene generarlo cerca de la fecha en que lo va a presentar.'],
        ],
        'relatedService' => 'marangatu',
        'toolLink' => null,
        'related' => ['como-ingresar-a-marangatu', 'multas-dnit-como-regularizar'],
    ],

    'multas-dnit-como-regularizar' => [
        'path'            => '/guias/multas-dnit-como-regularizar/',
        'title'           => 'Multas de la DNIT: cómo regularizar',
        'navLabel'        => 'Multas DNIT: cómo regularizar',
        'seoTitle'        => 'Multas DNIT: cómo regularizar',
        'metaDescription' => 'Cómo saber si tiene multas de la DNIT, por qué se generan y los pasos '
                            . 'para regularizar su situación tributaria antes de que se agraven.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Multas de la DNIT: cómo saber si tiene y cómo regularizar',
            'lead'    => 'Por qué se generan las multas más comunes, cómo confirmar si tiene alguna '
                        . 'pendiente y los pasos para ponerse al día.',
        ],
        'intro' => [
            'Las multas de la DNIT casi siempre nacen del mismo lugar: una declaración jurada presentada '
                . 'fuera de plazo, no presentada, o presentada con datos que generan una inconsistencia. '
                . 'Cuanto más tiempo pasa sin regularizar, más se acumulan los intereses y recargos sobre el '
                . 'monto original — por eso conviene actuar apenas se detecta la situación, no esperar a '
                . 'que aparezca en un momento más inoportuno, como al pedir el Certificado de Cumplimiento '
                . 'Tributario.',
            'Esta guía explica cómo confirmar si tiene multas pendientes y el orden general para '
                . 'regularizarlas, sin necesidad de adivinar qué declaración falta.',
        ],
        'steps' => [
            [
                'title' => 'Consulte su situación dentro de Marangatu',
                'body'  => [
                    'Su cuenta muestra las declaraciones pendientes, presentadas fuera de plazo o con saldo '
                        . 'impago. Es el primer lugar para confirmar si hay algo pendiente antes de suponerlo.',
                ],
            ],
            [
                'title' => 'Identifique el tipo de incumplimiento',
                'body'  => [
                    'No es lo mismo una declaración no presentada que una presentada tarde con el impuesto '
                        . 'ya pagado: el cálculo de la multa y del recargo cambia según cuál sea el caso, y '
                        . 'algunas situaciones tienen un tratamiento más simple que otras.',
                ],
            ],
            [
                'title' => 'Presente lo que falta, aunque sea tarde',
                'body'  => [
                    'Si hay una declaración pendiente, presentarla — incluso fuera de plazo — es el primer '
                        . 'paso obligatorio antes de poder regularizar la multa asociada. No presentarla nunca '
                        . 'solo agrava la situación con el tiempo.',
                ],
            ],
            [
                'title' => 'Calcule y pague el monto regularizado',
                'body'  => [
                    'Una vez presentada la declaración faltante, el sistema — o su contador — determina el '
                        . 'monto de la multa y los recargos correspondientes según cuánto tiempo estuvo '
                        . 'pendiente la obligación.',
                ],
            ],
            [
                'title' => 'Verifique que la situación quedó limpia',
                'body'  => [
                    'Después de pagar, confirme en Marangatu que la inconsistencia desapareció de su cuenta '
                        . '— sobre todo si el motivo por el que revisó todo esto era emitir un Certificado de '
                        . 'Cumplimiento Tributario.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Cómo sé si tengo multas de la DNIT?', 'a' => 'Se consulta directamente en su cuenta de Marangatu, en la sección de su situación tributaria. Ahí figuran las declaraciones pendientes, presentadas fuera de plazo o con saldo impago.'],
            ['q' => '¿Las multas se acumulan con el tiempo?', 'a' => 'Sí, en general los recargos e intereses aumentan cuanto más tiempo pasa sin regularizar la obligación pendiente. Por eso conviene resolverlo apenas se detecta, no dejarlo para cuando haga falta un trámite urgente.'],
            ['q' => '¿Puedo regularizar sin presentar la declaración que falta?', 'a' => 'No. Presentar la declaración pendiente — aunque sea fuera de plazo — es el paso previo obligatorio antes de poder calcular y pagar la multa correspondiente.'],
        ],
        'relatedService' => 'asesoria',
        'toolLink' => [
            'path'  => '/herramientas/vencimientos/',
            'label' => 'Calendario de vencimientos',
            'text'  => 'Vea sus próximas fechas para no volver a caer en mora.',
        ],
        'related' => ['certificado-de-cumplimiento-tributario', 'como-ingresar-a-marangatu'],
    ],

    'inscripcion-patronal-ips' => [
        'path'            => '/guias/inscripcion-patronal-ips/',
        'title'           => 'Inscripción patronal en el IPS',
        'navLabel'        => 'Inscripción patronal IPS',
        'seoTitle'        => 'Inscripción patronal en el IPS',
        'metaDescription' => 'Cómo inscribirse como empleador en el IPS al contratar a su primer '
                            . 'empleado en Paraguay: documentos, pasos y aportes obrero-patronales.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Inscripción patronal en el IPS, paso a paso',
            'lead'    => 'El trámite que corresponde apenas contrata a su primer empleado: cómo '
                        . 'inscribirse como empleador y qué aportes empiezan a correr desde ese mes.',
        ],
        'intro' => [
            'Apenas una empresa contrata a su primer empleado en relación de dependencia, está obligada a '
                . 'inscribirse como empleador ante el IPS (Instituto de Previsión Social) y a declarar a ese '
                . 'trabajador dentro de la planilla correspondiente. Es un trámite independiente de la '
                . 'inscripción de RUC ante la DNIT: uno lo habilita a facturar, el otro lo habilita a tener '
                . 'personal en relación de dependencia.',
            'Esta guía cubre el orden de los pasos, desde la inscripción patronal hasta la primera '
                . 'declaración de aportes, y qué pasa si contrata sin haberse inscripto a tiempo.',
        ],
        'steps' => [
            [
                'title' => 'Reúna los datos de la empresa y del RUC',
                'body'  => [
                    'La inscripción patronal parte del RUC de la empresa ya activo, con la actividad '
                        . 'económica correctamente declarada — es el mismo dato que usa el IPS para clasificar '
                        . 'la actividad a efectos de la cobertura de riesgos laborales.',
                ],
            ],
            [
                'title' => 'Presente la solicitud de inscripción patronal',
                'body'  => [
                    'El trámite se presenta ante el IPS con la documentación de la empresa. Una vez '
                        . 'aprobado, la empresa queda registrada como empleador y puede declarar trabajadores '
                        . 'en su planilla.',
                ],
            ],
            [
                'title' => 'Declare a cada trabajador al iniciar la relación laboral',
                'body'  => [
                    'Cada empleado nuevo se declara ante el IPS con sus datos y su salario, dentro de la '
                        . 'planilla mensual del empleador — no basta con la inscripción patronal general.',
                ],
            ],
            [
                'title' => 'Calcule y presente los aportes obrero-patronales',
                'body'  => [
                    'El aporte obrero (a cargo del trabajador, descontado de su salario) y el aporte '
                        . 'patronal (a cargo del empleador) se declaran y pagan del 1 al 10 del mes siguiente '
                        . 'al período trabajado, igual para todos los empleadores, sin depender de la '
                        . 'terminación del RUC.',
                ],
            ],
            [
                'title' => 'Mantenga la planilla al día cada mes',
                'body'  => [
                    'Un empleado nuevo, una baja o un cambio de salario se reflejan en la planilla del mes '
                        . 'correspondiente. Una planilla desactualizada es la causa más frecuente de '
                        . 'inconsistencias con el IPS cuando el trabajador necesita usar la cobertura.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Cuándo debo inscribirme como empleador en el IPS?', 'a' => 'Apenas contrata a su primer trabajador en relación de dependencia. Es un trámite distinto e independiente de la inscripción de RUC ante la DNIT.'],
            ['q' => '¿Cuándo vence el pago de los aportes al IPS?', 'a' => 'Los aportes obrero-patronales se declaran y pagan del día 1 al 10 del mes siguiente al período trabajado, igual para todos los empleadores, sin depender de la terminación del RUC.'],
            ['q' => '¿Qué pasa si contraté sin inscribirme como empleador?', 'a' => 'La obligación de inscribirse y declarar corre desde el momento en que empieza la relación laboral, se haya hecho el trámite o no. Regularizar cuanto antes evita que se acumulen períodos sin declarar.'],
        ],
        'relatedService' => 'ips',
        'toolLink' => [
            'path'  => '/herramientas/liquidacion-de-salario/',
            'label' => 'Calculadora de liquidación de salario',
            'text'  => 'Estime el aporte IPS y las demás líneas de una liquidación.',
        ],
        'related' => ['inscripcion-de-ruc-paso-a-paso', 'formulario-120-paso-a-paso'],
    ],

    'irp-quien-debe-pagar' => [
        'path'            => '/guias/irp-quien-debe-pagar/',
        'title'           => 'IRP: quién debe pagar',
        'navLabel'        => 'IRP: quién debe pagar',
        'seoTitle'        => 'IRP en Paraguay: quién debe pagarlo',
        'metaDescription' => 'Quién debe inscribirse y presentar el IRP en Paraguay, cómo se calcula en '
                            . 'general y qué hacer si no está seguro de si le corresponde declarar.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'IRP: quién debe pagar el Impuesto a la Renta Personal',
            'lead'    => 'Cómo saber si le corresponde inscribirse y presentar el IRP, y qué hacer si no '
                        . 'está seguro de su situación.',
        ],
        'intro' => [
            'El IRP (Impuesto a la Renta Personal) grava los ingresos de las personas físicas en Paraguay '
                . 'que superan determinados montos anuales, ya sea por salario, por el ejercicio '
                . 'profesional independiente, por alquileres u otras rentas. No todo el que factura o '
                . 'recibe un salario está obligado a inscribirse — depende del monto total de ingresos del '
                . 'año y de la categoría en la que encaja.',
            'Esta guía explica el criterio general para saber si le corresponde inscribirse y presentar el '
                . 'IRP, sin entrar en montos exactos que cambian por reglamentación — para esos valores '
                . 'vigentes, la sección final lo conecta con una consulta directa.',
        ],
        'steps' => [
            [
                'title' => 'Identifique de dónde vienen sus ingresos',
                'body'  => [
                    'El IRP considera distintas fuentes: salario en relación de dependencia, honorarios por '
                        . 'ejercicio profesional independiente, alquileres, y otros ingresos personales. La '
                        . 'obligación de inscribirse se evalúa sobre el total de esas rentas del año, no sobre '
                        . 'una sola fuente aislada.',
                ],
            ],
            [
                'title' => 'Compare sus ingresos anuales contra el monto vigente',
                'body'  => [
                    'La ley fija un monto anual de ingresos a partir del cual corresponde inscribirse y '
                        . 'declarar. Ese monto y las deducciones admitidas pueden actualizarse por '
                        . 'reglamentación — consulte el monto vigente antes de decidir si le corresponde.',
                ],
            ],
            [
                'title' => 'Revise qué deducciones puede aplicar',
                'body'  => [
                    'El IRP admite deducir determinados gastos personales y familiares del ingreso bruto '
                        . 'antes de calcular el impuesto. Qué gastos califican y hasta qué monto también se '
                        . 'fija por reglamentación vigente.',
                ],
            ],
            [
                'title' => 'Inscríbase si corresponde, antes del plazo de presentación',
                'body'  => [
                    'Si sus ingresos superan el monto que obliga a declarar, corresponde inscribirse en el '
                        . 'régimen de IRP y presentar la declaración anual dentro del plazo que fija la DNIT '
                        . 'cada año, habitualmente en los primeros meses del año siguiente.',
                ],
            ],
            [
                'title' => 'Si tiene una empresa además de ingresos personales, revise ambos regímenes',
                'body'  => [
                    'Alguien que factura por su cuenta y además tiene una empresa constituida puede tener '
                        . 'obligaciones simultáneas de IRP e IRE. Confundir un régimen con el otro es un error '
                        . 'frecuente que conviene resolver con asesoría antes de la temporada de declaración.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿A partir de qué monto corresponde inscribirse al IRP?', 'a' => 'La ley fija un monto anual de ingresos a partir del cual corresponde inscribirse; ese monto puede actualizarse por reglamentación, así que conviene confirmar el vigente antes de decidir su situación.'],
            ['q' => '¿Los empleados en relación de dependencia pagan IRP?', 'a' => 'Puede corresponder según el total de sus ingresos anuales, no solo el salario: si supera el monto que obliga a declarar, el IRP aplica también a quienes trabajan en relación de dependencia.'],
            ['q' => '¿Si tengo una empresa, pago IRP o IRE?', 'a' => 'Depende: la empresa como persona jurídica tributa IRE; si usted además tiene ingresos personales que superan el monto que obliga a declarar IRP, puede tener ambas obligaciones a la vez, cada una sobre su propia base.'],
            ['q' => '¿Cuándo se presenta la declaración de IRP?', 'a' => 'Anualmente, dentro del plazo que la DNIT fija cada año, habitualmente en los primeros meses del año siguiente al que se declara. Confirme el mes exacto vigente antes de la fecha.'],
        ],
        'relatedService' => 'irp',
        'toolLink' => null,
        'related' => ['formulario-120-paso-a-paso', 'inscripcion-de-ruc-paso-a-paso'],
    ],

    /* === Keyword round 2026-10-17 (KWP export "contador.com.py + EAS") ======
       salario mínimo 33 760/mo, IPS mis aportes 6 600/mo (+50 %), preaviso
       1 300/mo, SUACE 2 900/mo (+50 %). Sources in docs/facts-to-verify.md. */

    'salario-minimo-paraguay' => [
        'path'            => '/guias/salario-minimo-paraguay/',
        'title'           => 'Salario mínimo en Paraguay',
        'navLabel'        => 'Salario mínimo 2026',
        'seoTitle'        => 'Salario mínimo en Paraguay 2026',
        'metaDescription' => 'El salario mínimo en Paraguay es de Gs. 3.044.000 desde julio de 2026. '
                            . 'Jornal diario, descuento del IPS, sueldo neto y costo para la empresa.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Salario mínimo en Paraguay 2026: monto, jornal y sueldo neto',
            'lead'    => 'Gs. 3.044.000 por mes desde el 1 de julio de 2026. Qué cobra el trabajador '
                        . 'después del IPS y cuánto le cuesta a la empresa.',
        ],
        'intro' => [
            'El salario mínimo legal para actividades diversas no especificadas del sector privado es de '
                . 'Gs. 3.044.000 por mes desde el 1 de julio de 2026. Lo fijó el Decreto N.º 6225/2026, '
                . 'que reajustó un 5 % el monto anterior de Gs. 2.899.048. El jornal mínimo diario quedó '
                . 'en Gs. 117.077.',
            'El monto es bruto: de ahí sale el aporte del trabajador al IPS. Para las actividades que '
                . 'tienen un mínimo propio, el Ministerio de Trabajo (MTESS) publica las tablas '
                . 'actualizadas con el mismo porcentaje de reajuste. Abajo, las cuentas que más se buscan, '
                . 'paso a paso.',
        ],
        'steps' => [
            [
                'title' => 'Monto mensual: Gs. 3.044.000',
                'body'  => [
                    'Es lo mínimo que puede ganar por mes un trabajador mensualizado con jornada completa. '
                        . 'Rige desde el 1 de julio de 2026. Hasta el 30 de junio de 2026 el mínimo era de '
                        . 'Gs. 2.899.048, así que los sueldos de julio en adelante ya deben pagarse con el '
                        . 'monto nuevo.',
                ],
            ],
            [
                'title' => 'Jornal mínimo diario: Gs. 117.077',
                'body'  => [
                    'Para quien cobra por día trabajado, el mínimo es de Gs. 117.077 por jornal. Sale de '
                        . 'dividir el mensual por 26 días hábiles. No hay que confundirlo con el salario '
                        . 'diario que se usa en una liquidación, que divide el mensual por 30.',
                ],
            ],
            [
                'title' => 'Descuento del IPS y sueldo neto: Gs. 2.770.040',
                'body'  => [
                    'El trabajador aporta el 9 % de su salario al IPS: Gs. 273.960 sobre el mínimo. Lo que '
                        . 'cobra en mano es Gs. 2.770.040, antes de cualquier otro descuento que figure en su '
                        . 'recibo.',
                ],
            ],
            [
                'title' => 'Costo para la empresa: Gs. 3.546.260 por mes',
                'body'  => [
                    'Además del sueldo, la empresa paga el aporte patronal del 16,5 % al IPS: Gs. 502.260 '
                        . 'sobre el mínimo. El costo mensual de un empleado con salario mínimo es entonces de '
                        . 'Gs. 3.546.260, sin contar el aguinaldo ni las vacaciones.',
                ],
            ],
            [
                'title' => 'Aguinaldo 2026 con salario mínimo: Gs. 2.971.524',
                'body'  => [
                    'El aguinaldo es la doceava parte de lo cobrado en el año. Quien ganó el mínimo todo '
                        . '2026 cobró seis meses a Gs. 2.899.048 y seis a Gs. 3.044.000: Gs. 35.658.288 en '
                        . 'total, y su aguinaldo es de Gs. 2.971.524. Para otros casos, use la calculadora de '
                        . 'aguinaldo.',
                ],
            ],
            [
                'title' => 'Si le pagan menos del mínimo',
                'body'  => [
                    'Pagar menos del mínimo legal a un trabajador de jornada completa es una infracción que '
                        . 'puede denunciarse ante el MTESS. Si es empleador, revise también que el salario '
                        . 'declarado al IPS sea el que realmente paga: el aporte se calcula sobre ese monto.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Cuánto es el salario mínimo en Paraguay en 2026?', 'a' => 'Gs. 3.044.000 por mes desde el 1 de julio de 2026 (Decreto N.º 6225/2026), para actividades diversas no especificadas. Entre enero y junio de 2026 rigió el monto anterior, Gs. 2.899.048.'],
            ['q' => '¿El salario mínimo es bruto o neto?', 'a' => 'Bruto. Del mínimo se descuenta el 9 % de aporte obrero al IPS, así que el trabajador cobra Gs. 2.770.040 antes de otros descuentos.'],
            ['q' => '¿Cuánto es el jornal mínimo?', 'a' => 'Gs. 117.077 por día trabajado, desde el 1 de julio de 2026.'],
            ['q' => '¿Cuándo cambia el salario mínimo?', 'a' => 'El Poder Ejecutivo lo reajusta por decreto, en general una vez al año y con vigencia desde julio. Revisamos esta guía cada vez que sale un decreto nuevo.'],
        ],
        'relatedService' => 'ips',
        'toolLink' => [
            'path'  => '/herramientas/calculadora-ips/',
            'label' => 'Calculadora de aporte IPS',
            'text'  => 'Cargue un salario y vea el 9 % del trabajador, el 16,5 % de la empresa y el sueldo neto.',
        ],
        'related' => ['ver-aportes-ips', 'preaviso-paraguay', 'inscripcion-patronal-ips'],
        'thumbnail' => [
            'src' => '/assets/img/salario-minimo-trabajadora-paraguay-1280.avif',
            'alt' => 'Trabajadora con su sobre de sueldo sube una escalera de monedas hacia una puerta iluminada, junto a un lapacho en flor.',
        ],
    ],

    'ver-aportes-ips' => [
        'path'            => '/guias/ver-aportes-ips/',
        'title'           => 'Cómo ver mis aportes en el IPS',
        'navLabel'        => 'Ver mis aportes IPS',
        'seoTitle'        => 'IPS mis aportes: cómo ver sus aportes',
        'metaDescription' => 'Cómo ver sus aportes al IPS en Mi IPS, con su cédula y PIN o con Identidad '
                            . 'Electrónica, y qué hacer si falta un mes o el salario no coincide.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Cómo ver mis aportes en el IPS',
            'lead'    => 'Revise mes por mes si su empleador está aportando por usted, y con qué salario, '
                        . 'desde el sistema Mi IPS.',
        ],
        'intro' => [
            'El IPS muestra los aportes de cada asegurado en Mi IPS, su sistema en línea. Ahí aparece '
                . 'cada mes aportado, el empleador que lo pagó y el salario declarado. Vale la pena '
                . 'revisarlo: un mes que falta o un salario declarado más bajo que el real afecta su '
                . 'cobertura médica, sus subsidios y, a la larga, su jubilación.',
            'La consulta es gratuita y la hace usted mismo con su cédula. Estos son los pasos.',
        ],
        'steps' => [
            [
                'title' => 'Entre a Mi IPS',
                'body'  => [
                    'Mi IPS está en servicios.ips.gov.py/miips. Desde ahí se consultan los aportes, el estado '
                        . 'de cuenta, las prestaciones médicas, las citas y los reposos.',
                ],
            ],
            [
                'title' => 'Elija cómo ingresar: PIN o Identidad Electrónica',
                'body'  => [
                    'Si ya tiene PIN de Mi IPS, ingrese con su número de cédula, sin puntos ni guiones, y el '
                        . 'PIN. Si no tiene PIN, ingrese con su cuenta de Identidad Electrónica del Gobierno; '
                        . 'si todavía no la tiene, la crea en paraguay.gov.py con su cédula y un correo.',
                ],
            ],
            [
                'title' => 'Abra la sección Aportes',
                'body'  => [
                    'En Aportes ve la consulta de aportes y su estado de cuenta. Revise tres cosas: que '
                        . 'figuren todos los meses que trabajó, que el empleador sea el correcto y que el '
                        . 'salario declarado coincida con el de su recibo.',
                ],
            ],
            [
                'title' => 'Si falta un mes o el salario no coincide',
                'body'  => [
                    'Primero consulte a su empleador: puede ser un pago atrasado que todavía no se registró. '
                        . 'Si no se corrige, puede reclamar ante el IPS o el Ministerio de Trabajo. Guarde sus '
                        . 'recibos de sueldo: son la prueba de lo que cobró.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Puedo ver mis aportes solo con la cédula, sin clave?', 'a' => 'La consulta de asegurado del IPS confirma con la cédula si su seguro está vigente, pero el detalle mes a mes de los aportes se ve dentro de Mi IPS, con PIN o Identidad Electrónica.'],
            ['q' => '¿Olvidé mi PIN de Mi IPS, qué hago?', 'a' => 'Mi IPS permite recuperar la contraseña por correo electrónico desde la misma pantalla de ingreso. Si usa Identidad Electrónica, la recupera desde su propio enlace.'],
            ['q' => '¿Cuánto me tienen que aportar al IPS?', 'a' => 'El 9 % de su salario lo descuenta el empleador de su recibo, y la empresa suma un 16,5 % propio. Los dos aportes deben aparecer juntos sobre el mismo salario declarado.'],
            ['q' => 'Soy empleador, ¿cómo evito que falten aportes?', 'a' => 'Comunicando cada alta antes de que el empleado empiece a trabajar y pagando la planilla dentro del plazo cada mes. Si prefiere no ocuparse, llevamos su nómina e IPS por usted.'],
        ],
        'relatedService' => 'ips',
        'toolLink' => [
            'path'  => '/herramientas/calculadora-ips/',
            'label' => 'Calculadora de aporte IPS',
            'text'  => 'Calcule cuánto deberían aportar usted y su empleador sobre su salario.',
        ],
        'related' => ['salario-minimo-paraguay', 'inscripcion-patronal-ips'],
        'thumbnail' => [
            'src' => '/assets/img/aportes-ips-celular-familia-paraguay-1280.avif',
            'alt' => 'Hombre bajo un lapacho mira su celular, del que surge un paraguas de meses dorados que protege a su familia.',
        ],
    ],

    'preaviso-paraguay' => [
        'path'            => '/guias/preaviso-paraguay/',
        'title'           => 'Preaviso en Paraguay',
        'navLabel'        => 'Preaviso',
        'seoTitle'        => 'Preaviso en Paraguay: cuántos días',
        'metaDescription' => 'Preaviso en Paraguay: 30, 45, 60 o 90 días según la antigüedad (Art. 87 del '
                            . 'Código del Trabajo), cómo se da y cuánto se paga si se omite.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Preaviso en Paraguay: cuántos días corresponden y cómo se paga',
            'lead'    => 'El aviso previo que debe dar quien termina un contrato por tiempo indefinido, '
                        . 'según los artículos 87 a 90 del Código del Trabajo.',
        ],
        'intro' => [
            'En un contrato de trabajo por tiempo indefinido, ninguna de las partes puede terminarlo sin '
                . 'avisar antes a la otra (Art. 87 del Código del Trabajo). Ese aviso es el preaviso, y su '
                . 'duración depende de la antigüedad del trabajador.',
            'Se habla del preaviso sobre todo en los despidos sin causa justificada, porque si la empresa '
                . 'no lo da, lo tiene que pagar en dinero junto con el finiquito. Pero también obliga al '
                . 'trabajador que renuncia. Un despido con causa justificada no lleva preaviso.',
        ],
        'steps' => [
            [
                'title' => 'Cuente la antigüedad exacta',
                'body'  => [
                    'Los plazos del Art. 87 son 30 días con antigüedad de hasta 1 año; 45 días con más de 1 '
                        . 'y hasta 5 años; 60 días con más de 5 y hasta 10 años; y 90 días con más de 10 '
                        . 'años. "Más de un año" significa más de un año cumplido: con exactamente un año, '
                        . 'corresponden 30 días.',
                ],
            ],
            [
                'title' => 'Dé el aviso por escrito',
                'body'  => [
                    'El preaviso puede darse de cualquier forma, pero tiene que poder probarse por escrito '
                        . 'o en forma auténtica. También puede hacerse ante la autoridad administrativa del '
                        . 'trabajo (Art. 88). Una nota firmada con fecha de recibido es lo más simple.',
                ],
            ],
            [
                'title' => 'Durante el preaviso: dos horas libres por día',
                'body'  => [
                    'El trabajador al que se le notificó el despido sigue cobrando su salario completo y '
                        . 'tiene una licencia de dos horas diarias, dentro de su jornada, para buscar otro '
                        . 'empleo. Si prefiere, puede juntarlas en un día libre por semana (Art. 89).',
                ],
            ],
            [
                'title' => 'Si se omite: cuánto se paga',
                'body'  => [
                    'La empresa que despide sin dar el preaviso le paga al trabajador el salario '
                        . 'correspondiente a todo el plazo. El trabajador que renuncia sin avisar le debe a '
                        . 'la empresa la mitad del salario de ese plazo (Art. 90).',
                    'Ejemplo: un trabajador con 3 años de antigüedad y un salario de Gs. 4.500.000, '
                        . 'despedido sin causa y sin aviso, cobra 45 días de preaviso. Su salario diario es '
                        . 'de Gs. 150.000 (el mensual dividido por 30), así que el preaviso es de '
                        . 'Gs. 6.750.000.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Cuántos días de preaviso corresponden en Paraguay?', 'a' => '30 días con hasta 1 año de antigüedad, 45 con más de 1 y hasta 5 años, 60 con más de 5 y hasta 10 años, y 90 con más de 10 años (Art. 87 del Código del Trabajo).'],
            ['q' => '¿El trabajador que renuncia tiene que dar preaviso?', 'a' => 'Sí. El Art. 87 obliga a las dos partes. Si el trabajador renuncia sin avisar, debe a la empresa la mitad del salario del plazo de preaviso (Art. 90).'],
            ['q' => '¿Hay preaviso en un despido con causa justificada?', 'a' => 'No. El despido por una causa justificada del Código del Trabajo no genera preaviso ni indemnización. Si la causa se discute y no se prueba, el despido pasa a tratarse como injustificado.'],
            ['q' => '¿El preaviso pagado lleva descuento del IPS?', 'a' => 'Según la práctica general, el preaviso pagado en dinero no forma parte de la base del aporte del 9 % al IPS, igual que la indemnización. Si el trabajador sigue trabajando durante el preaviso, ese salario sí aporta.'],
        ],
        'relatedService' => 'ips',
        'toolLink' => [
            'path'  => '/herramientas/liquidacion-de-salario/',
            'label' => 'Calculadora de liquidación laboral',
            'text'  => 'Calcule el preaviso, la indemnización, las vacaciones y el aguinaldo de un finiquito.',
        ],
        'related' => ['salario-minimo-paraguay', 'ver-aportes-ips'],
        'thumbnail' => [
            'src' => '/assets/img/preaviso-laboral-reloj-arena-paraguay-1280.avif',
            'alt' => 'Trabajador y empleador se dan la mano frente a un reloj de arena del que sale un camino de calendarios.',
        ],
    ],

    'suace' => [
        'path'            => '/guias/suace/',
        'title'           => 'SUACE',
        'navLabel'        => 'SUACE: abrir una empresa',
        'seoTitle'        => 'SUACE: cómo abrir una empresa paso a paso',
        'metaDescription' => 'Qué es el SUACE y cómo abrir una EAS en línea: identidad electrónica, '
                            . 'estatutos, plazos de 72 horas u 8 días hábiles y qué recibe al final.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'SUACE: cómo abrir una empresa en Paraguay, paso a paso',
            'lead'    => 'El Sistema Unificado de Apertura y Cierre de Empresas del MIC, y el trámite en '
                        . 'línea para constituir una EAS.',
        ],
        'intro' => [
            'El SUACE es el Sistema Unificado de Apertura y Cierre de Empresas del Ministerio de '
                . 'Industria y Comercio (MIC). Une en un solo trámite lo que antes se hacía por separado '
                . 'ante varias oficinas. Para la EAS (Empresa por Acciones Simplificada), todo el proceso '
                . 'es en línea: la apertura, y también los cambios, la disolución y el cierre, se hacen '
                . 'únicamente por el SUACE.',
            'Esta guía sigue el circuito de la EAS, que es el que más se usa hoy. Una SRL o una S.A. '
                . 'siguen otro camino, con escritura pública e inscripción en el Registro Público de '
                . 'Comercio: si duda entre las tres figuras, use el comparador.',
        ],
        'steps' => [
            [
                'title' => 'Identidad electrónica del representante legal',
                'body'  => [
                    'Al SUACE se entra solo con la identidad electrónica del representante legal principal, '
                        . 'que tiene que tener cédula paraguaya. Se crea en paraguay.gov.py. Si los socios '
                        . 'son extranjeros sin cédula, actúan a través de un representante que cumpla ese '
                        . 'requisito.',
                ],
            ],
            [
                'title' => 'Elija el tipo de estatuto',
                'body'  => [
                    'Hay tres opciones: el estatuto proforma que genera el sistema, un instrumento privado '
                        . 'con las firmas certificadas por escribano, o una escritura pública. El proforma es '
                        . 'el más rápido, pero no se puede editar. Un estatuto propio permite adaptar las '
                        . 'reglas de la empresa a su operación.',
                ],
            ],
            [
                'title' => 'Cargue la solicitud y firme',
                'body'  => [
                    'La solicitud se completa en eas.mic.gov.py con los datos de la empresa, los socios y '
                        . 'el capital. El proforma se firma con firma digital, o a mano en cada hoja, '
                        . 'escaneado y subido al sistema. Si hay aporte de capital en efectivo por encima '
                        . 'del monto que fija la ley, se pide un depósito del 20 % en el Banco Nacional de '
                        . 'Fomento.',
                ],
            ],
            [
                'title' => 'Plazos y observaciones',
                'body'  => [
                    'Con el estatuto proforma, el SUACE resuelve en 72 horas hábiles si no hay observaciones; '
                        . 'con otro tipo de estatuto, en 8 días hábiles. Si el sistema hace una observación, '
                        . 'hay 3 días hábiles para corregirla: si no se corrige, el expediente se cierra y hay '
                        . 'que empezar de nuevo.',
                ],
            ],
            [
                'title' => 'Lo que recibe al final, y lo que falta',
                'body'  => [
                    'Al aprobarse, recibe la constancia de constitución, el RUC, la constancia de '
                        . 'beneficiarios finales y la de personas y estructuras jurídicas. La inscripción '
                        . 'patronal en el IPS y el MTESS se completa en los sitios de cada institución.',
                    'Quedan fuera del SUACE la habilitación municipal y la patente comercial (en Asunción, '
                        . 'ante la Municipalidad), la factura electrónica y la rúbrica de los libros '
                        . 'contables. Son los pasos que más se olvidan en el primer mes.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Qué es el SUACE?', 'a' => 'El Sistema Unificado de Apertura y Cierre de Empresas del Ministerio de Industria y Comercio. Concentra en un solo trámite la constitución de la empresa y su inscripción en los organismos del Estado.'],
            ['q' => '¿Cuánto tarda abrir una EAS por el SUACE?', 'a' => '72 horas hábiles con el estatuto proforma y 8 días hábiles con un estatuto propio, si no hay observaciones. Cuente aparte el tiempo para crear la identidad electrónica y preparar los estatutos.'],
            ['q' => '¿Un extranjero puede abrir una EAS por el SUACE?', 'a' => 'Sí, como socio. Pero el trámite lo hace el representante legal principal con cédula paraguaya e identidad electrónica, así que un socio extranjero sin cédula necesita un representante que cumpla ese requisito.'],
            ['q' => '¿El SUACE me da la patente comercial?', 'a' => 'No. La habilitación municipal y la patente comercial se tramitan en la municipalidad donde funcionará el negocio, después de la constitución.'],
        ],
        'relatedService' => 'eas',
        'toolLink' => [
            'path'  => '/herramientas/comparador-eas-srl-unipersonal/',
            'label' => 'Comparador EAS, SRL o Unipersonal',
            'text'  => 'Responda tres preguntas y vea qué figura le conviene antes de entrar al SUACE.',
        ],
        'related' => ['inscripcion-de-ruc-paso-a-paso', 'inscripcion-patronal-ips', 'ekuatiai-paso-a-paso'],
        'thumbnail' => [
            'src' => '/assets/img/suace-apertura-empresa-online-paraguay-1280.avif',
            'alt' => 'Dos emprendedores encajan piezas de rompecabezas que salen de una tableta para armar el frente de su nueva empresa.',
        ],
    ],

    'kude' => [
        'path'            => '/guias/kude/',
        'title'           => 'KuDE de la factura electrónica',
        'navLabel'        => 'KuDE: verificar una factura',
        'seoTitle'        => 'KuDE: qué es y cómo verificar la factura',
        'metaDescription' => 'Qué es el KuDE de la factura electrónica y cómo verificarla con el código QR o el CDC '
                            . 'de 44 dígitos en la consulta pública de Ekuatia.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'KuDE: qué es y cómo verificar una factura electrónica en Paraguay',
            'lead'    => 'La representación gráfica de la factura electrónica, y cómo comprobar con el QR o el '
                        . 'CDC que el documento existe y está aprobado.',
        ],
        'intro' => [
            'El KuDE es la representación gráfica de un documento electrónico del SIFEN: lo que usted '
                . 'recibe impreso o en PDF cuando le emiten una factura electrónica. El documento con valor '
                . 'legal es el archivo XML firmado y aprobado por la DNIT (antes SET); el KuDE es su versión '
                . 'legible.',
            'Si le entregaron un KuDE y quiere saber si la factura es real, no hace falta ser facturador '
                . 'electrónico. Basta con el código QR o con el CDC que figura en el documento.',
        ],
        'steps' => [
            [
                'title' => 'Qué es el KuDE y qué muestra',
                'body'  => [
                    'El KuDE reúne los datos de la operación: el emisor, el comprador, el detalle de '
                        . 'productos o servicios, los totales y el IVA. También trae un código QR y el CDC, '
                        . 'un código de control de 44 dígitos que identifica ese documento.',
                    'El título cambia según el tipo de documento, por ejemplo "KuDE de Factura Electrónica" '
                        . 'o "KuDE de Nota de Crédito Electrónica".',
                ],
            ],
            [
                'title' => 'Para qué se usa',
                'body'  => [
                    'El emisor entrega el KuDE al comprador que no es '
                        . 'facturador electrónico o que es consumidor final, y le sirve como comprobante de '
                        . 'la compra. Si el comprador sí es facturador electrónico, lo habitual es enviarle '
                        . 'el XML.',
                ],
            ],
            [
                'title' => 'Ver la factura electrónica con el código QR',
                'body'  => [
                    'Escanee el QR del KuDE con la cámara o una aplicación lectora del celular. Se abre la '
                        . 'consulta del SIFEN con los datos del documento. Compare el emisor, la fecha y el '
                        . 'total con lo que le entregaron.',
                ],
            ],
            [
                'title' => 'Verificación de la factura electrónica con el CDC',
                'body'  => [
                    'Si no puede leer el QR, entre a la consulta pública de Ekuatia de la DNIT, '
                        . 'escriba los 44 dígitos del CDC sin espacios, complete la verificación de seguridad '
                        . 'y consulte. El CDC está impreso en el KuDE, debajo del QR.',
                    'Si el sistema no encuentra el documento, revise primero que no haya un dígito mal '
                        . 'copiado.',
                ],
            ],
            [
                'title' => 'Qué hacer si algo no coincide',
                'body'  => [
                    'Si el documento no aparece, o los datos no coinciden con lo que le entregaron, pida '
                        . 'una aclaración al emisor antes de usar la factura como respaldo de un gasto. '
                        . 'Guarde el KuDE y, si el emisor se lo envía, también el XML. Por cuánto tiempo '
                        . 'debe conservarlos depende de la reglamentación vigente: consulte con nosotros.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Qué es el KuDE?', 'a' => 'Es la representación gráfica, impresa o en PDF, de un documento electrónico del SIFEN. Lleva un código QR y el CDC de 44 dígitos. El documento legal es el XML firmado y aprobado por la DNIT.'],
            ['q' => '¿Cómo puedo ver si una factura electrónica es válida?', 'a' => 'Escanee el QR del KuDE o ingrese el CDC de 44 dígitos en la consulta pública de Ekuatia de la DNIT. La consulta muestra si el documento existe y sus datos.'],
            ['q' => '¿Dónde está el CDC en la factura electrónica?', 'a' => 'Está impreso en el KuDE, debajo del código QR. Son 44 dígitos; los primeros indican el tipo de documento.'],
            ['q' => '¿Necesito ser facturador electrónico para hacer la verificación de una factura electrónica?', 'a' => 'No. La consulta por QR o por CDC está abierta a cualquier persona que tenga el KuDE.'],
        ],
        'relatedService' => 'ekuatia',
        'toolLink' => null,
        'related' => ['que-es-sifen', 'ekuatiai-paso-a-paso', 'factura-legal-paraguay'],
        'thumbnail' => [
            'src' => '/assets/img/kude-factura-electronica-mercado-paraguay-1280.avif',
            'alt' => 'Cliente escanea con el celular el código QR del comprobante que le entrega un vendedor de chipa en el mercado.',
        ],
    ],

    'nota-de-credito' => [
        'path'            => '/guias/nota-de-credito/',
        'title'           => 'Nota de crédito y nota de débito',
        'navLabel'        => 'Nota de crédito y de débito',
        'seoTitle'        => 'Nota de crédito y nota de débito',
        'metaDescription' => 'Nota de crédito y nota de débito en Paraguay: para qué sirven, cuándo se emiten, '
                            . 'cómo se relacionan con la factura original y un ejemplo.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Nota de crédito y nota de débito: para qué sirven y cuándo se emiten',
            'lead'    => 'Dos documentos que corrigen una factura ya emitida: uno la reduce, el otro la aumenta.',
        ],
        'intro' => [
            'La nota de crédito sirve para reducir o anular, total o parcialmente, una operación que ya '
                . 'tiene factura. Es lo que se emite, por ejemplo, ante una devolución o un descuento '
                . 'posterior a la venta. La nota de débito hace lo contrario: aumenta el importe de una '
                . 'operación ya documentada.',
            'En ambos casos la nota se emite sobre una factura existente y la referencia. Esta guía explica '
                . 'cuándo corresponde cada una, cómo es la nota de crédito electrónica y un ejemplo con IVA.',
        ],
        'steps' => [
            [
                'title' => 'Nota de crédito: para qué sirve',
                'body'  => [
                    'Se usa cuando la factura ya fue emitida y hay que corregirla hacia abajo: el cliente '
                        . 'devuelve mercadería, se otorga un descuento o una bonificación, o se ajusta un '
                        . 'precio. Reduce lo que el cliente debe, sin borrar la factura original.',
                ],
            ],
            [
                'title' => 'Nota de débito: para qué sirve',
                'body'  => [
                    'Se usa cuando hay que corregir la factura hacia arriba, por ejemplo por un ajuste de '
                        . 'precio o por un costo o gasto que se recupera del cliente. Agrega un importe a '
                        . 'una operación ya documentada.',
                ],
            ],
            [
                'title' => 'Nota de crédito electrónica: cómo se relaciona con la factura',
                'body'  => [
                    'En el SIFEN, la nota de crédito electrónica y la de débito se asocian a la factura '
                        . 'original mediante su CDC, el código de 44 dígitos del documento. La factura '
                        . 'tiene que estar aprobada, y la nota no puede acreditar más que su total.',
                    'Los motivos admitidos y los plazos son los que fija la reglamentación vigente: '
                        . 'consulte con nosotros antes de emitir una nota en un caso dudoso.',
                ],
            ],
            [
                'title' => 'Nota de crédito o cancelación de la factura',
                'body'  => [
                    'Una factura electrónica aprobada también puede cancelarse, pero solo dentro de un '
                        . 'plazo corto desde su aprobación. Pasado ese plazo, o si la corrección es '
                        . 'parcial, se emite una nota de crédito. Verifique el plazo vigente en Ekuatia '
                        . 'antes de decidir.',
                ],
            ],
            [
                'title' => 'Ejemplo de nota de crédito',
                'body'  => [
                    'Una factura por Gs. 330.000 incluye tres productos de Gs. 110.000 cada uno, con IVA '
                        . '10 % incluido. El cliente devuelve uno. Se emite una nota de crédito por '
                        . 'Gs. 110.000 que referencia la factura original. El IVA de esa nota es de '
                        . 'Gs. 10.000 (110.000 / 11).',
                    'Para calcular el IVA incluido de cualquier importe, use la calculadora.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Para qué sirve la nota de crédito?', 'a' => 'Para reducir o anular, total o parcialmente, una operación ya facturada: una devolución, un descuento posterior o un ajuste de precio.'],
            ['q' => '¿Nota de débito para qué sirve?', 'a' => 'Para aumentar el importe de una operación ya documentada, por ejemplo un ajuste de precio o un gasto que se recupera del cliente.'],
            ['q' => '¿Qué diferencia hay entre la nota de crédito y la nota de débito?', 'a' => 'La nota de crédito reduce lo facturado y la de débito lo aumenta. Las dos se emiten sobre una factura existente y la referencian.'],
            ['q' => '¿Se puede emitir una nota de crédito electrónica?', 'a' => 'Sí. En el SIFEN existe la nota de crédito electrónica, que se asocia a la factura electrónica original por su CDC. Los detalles y plazos están en la reglamentación vigente.'],
        ],
        'relatedService' => 'ekuatia',
        'toolLink' => [
            'path'  => '/herramientas/calculadora-iva/',
            'label' => 'Calculadora de IVA',
            'text'  => 'Separe el IVA incluido de cualquier importe antes de armar la nota.',
        ],
        'related' => ['kude', 'que-es-sifen', 'factura-legal-paraguay'],
        'thumbnail' => [
            'src' => '/assets/img/nota-de-credito-devolucion-comercio-1280.avif',
            'alt' => 'Cliente devuelve una caja en el mostrador de un comercio mientras las monedas vuelven de la caja, bajo una balanza.',
        ],
    ],

    'factura-legal-paraguay' => [
        'path'            => '/guias/factura-legal-paraguay/',
        'title'           => 'Factura legal en Paraguay',
        'navLabel'        => 'Factura legal y timbrado',
        'seoTitle'        => 'Factura legal Paraguay: requisitos',
        'metaDescription' => 'Qué hace legal a una factura en Paraguay: el timbrado de la DNIT, la factura virtual '
                            . 'en Marangatu y los requisitos para emitirla.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Factura legal en Paraguay: timbrado, factura virtual y requisitos',
            'lead'    => 'Qué hace válida a una factura, cómo se relaciona con el timbrado y dónde se emite la '
                        . 'factura virtual.',
        ],
        'intro' => [
            'Una factura legal en Paraguay es un comprobante emitido con un timbrado autorizado por la DNIT '
                . '(antes SET). Sin timbrado no es un comprobante tributario válido. Hoy conviven la factura '
                . 'virtual, que se emite desde Marangatu, y la factura electrónica del SIFEN.',
            'Esta guía resume los requisitos para tener factura legal, qué es el timbrado y por dónde se '
                . 'empieza. Los detalles cambian con la reglamentación, por eso le decimos dónde confirmarlos.',
        ],
        'steps' => [
            [
                'title' => 'Qué hace legal a una factura',
                'body'  => [
                    'Una factura es legal cuando se emite bajo un timbrado vigente y dentro de la '
                        . 'numeración que ese timbrado autoriza. La norma base es el Decreto 6539/2005, que '
                        . 'aprueba el reglamento general de timbrado y uso de comprobantes de venta.',
                ],
            ],
            [
                'title' => 'Qué es el timbrado',
                'body'  => [
                    'El timbrado es la autorización de la DNIT para emitir comprobantes de venta y '
                        . 'documentos relacionados. Se expresa como un número. Para la factura electrónica, '
                        . 'ese número viaja dentro del documento firmado.',
                    'La vigencia y las condiciones del timbrado de comprobantes en papel dependen de la '
                        . 'reglamentación vigente: consulte con nosotros o revise la sección Facturación y '
                        . 'timbrado del sitio de la DNIT.',
                ],
            ],
            [
                'title' => 'Requisitos para tener factura legal en Paraguay',
                'body'  => [
                    'Hace falta estar inscripto en el RUC y tener las obligaciones tributarias al día; luego '
                        . 'se solicita la autorización y el timbrado en Marangatu. La DNIT puede pedir '
                        . 'condiciones adicionales según su situación, por ejemplo la comunicación de la '
                        . 'numeración ya utilizada.',
                ],
            ],
            [
                'title' => 'Factura virtual en Marangatu',
                'body'  => [
                    'La Resolución General 03/18 aprobó la emisión de facturas virtuales a través de '
                        . 'Marangatu, desde el 1 de noviembre de 2018. La emite el contribuyente, o un '
                        . 'tercero autorizado, con su clave de acceso, y solo si está autorizado y timbrado '
                        . 'para esa modalidad. La DNIT publica guías para solicitarla, emitirla y darla de '
                        . 'baja.',
                    'Si aún no tiene acceso al sistema, empiece por la guía de ingreso a Marangatu.',
                ],
            ],
            [
                'title' => 'Boleta legal y factura electrónica',
                'body'  => [
                    'En el uso corriente, "boleta legal" suele referirse a un comprobante con timbrado '
                        . 'válido, como la factura. La factura electrónica del SIFEN es otra modalidad, con su propio timbrado electrónico y '
                        . 'habilitación. Si no sabe cuál le corresponde, consúltenos antes de cambiar de '
                        . 'sistema.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Qué es una factura legal en Paraguay?', 'a' => 'Es la factura emitida con un timbrado autorizado por la DNIT, dentro de la numeración que ese timbrado habilita. Sin timbrado no es un comprobante válido.'],
            ['q' => '¿Cuáles son los requisitos para tener factura legal en Paraguay?', 'a' => 'Estar inscripto en el RUC, tener las obligaciones al día y solicitar la autorización y el timbrado en Marangatu. La DNIT puede pedir condiciones adicionales; consulte con nosotros su caso.'],
            ['q' => '¿Cómo se emite la factura virtual en Marangatu?', 'a' => 'Con el usuario y la clave de acceso de Marangatu, si el contribuyente está autorizado y timbrado para facturar de forma virtual. La DNIT publica una guía paso a paso.'],
            ['q' => '¿La factura virtual de la SET es lo mismo que la factura electrónica?', 'a' => 'No. La factura virtual se emite desde Marangatu; la factura electrónica pertenece al SIFEN y se firma digitalmente. La SET hoy se llama DNIT.'],
        ],
        'relatedService' => 'ekuatia',
        'toolLink' => null,
        'related' => ['como-ingresar-a-marangatu', 'inscripcion-de-ruc-paso-a-paso', 'kude'],
        'thumbnail' => [
            'src' => '/assets/img/factura-legal-almacen-paraguay-1280.avif',
            'alt' => 'Dueño de un almacén de barrio entrega una factura a una clienta, bajo un sello dorado de ñandutí.',
        ],
    ],

    'libro-diario-y-libro-mayor' => [
        'path'            => '/guias/libro-diario-y-libro-mayor/',
        'title'           => 'Libro diario y libro mayor',
        'navLabel'        => 'Libro diario y libro mayor',
        'seoTitle'        => 'Libro diario y libro mayor: qué son',
        'metaDescription' => 'Qué es el libro diario y el libro mayor, cómo se relacionan y un ejemplo de '
                            . 'asientos en guaraníes, con los libros que se rubrican en Paraguay.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Libro diario y libro mayor: qué son, cómo se llevan y un ejemplo',
            'lead'    => 'Los dos libros base de la contabilidad, con un ejemplo de asientos en guaraníes y '
                        . 'lo que debe saber sobre su rúbrica en Paraguay.',
        ],
        'intro' => [
            'El libro diario es el registro cronológico de todas las operaciones de una empresa: cada '
                . 'venta, compra, cobro o pago se anota en el día en que ocurre, en forma de asiento '
                . 'contable. El libro mayor toma esos mismos asientos y los reúne por cuenta, para ver '
                . 'cuánto entró, cuánto salió y cuánto queda en cada una.',
            'Uno ordena los hechos por fecha y el otro los ordena por cuenta. Con los dos se pueden armar '
                . 'el balance y el estado de resultados. Esta guía explica qué es cada uno, cómo se pasa de '
                . 'uno a otro con un ejemplo corto, y qué libros contables tiene que tener rubricados una '
                . 'empresa en Paraguay.',
        ],
        'steps' => [
            [
                'title' => 'Libro diario: qué es y qué lleva',
                'body'  => [
                    'El libro diario en contabilidad registra cada operación en orden cronológico. Cada '
                        . 'anotación se llama asiento y tiene siempre dos partes que suman lo mismo: lo que '
                        . 'se anota al debe y lo que se anota al haber. Si el asiento no cuadra, hay un error.',
                    'La Ley 1034/83 del Comerciante dice que en el libro diario se asientan en detalle las '
                        . 'operaciones diarias, en el orden en que se hicieron (Art. 80). Cada asiento '
                        . 'necesita su comprobante: factura, recibo, extracto o contrato.',
                ],
            ],
            [
                'title' => 'Ejemplos del libro diario: tres asientos',
                'body'  => [
                    'Asiento 1. Venta de mercaderías al contado por Gs. 1.100.000, con IVA del 10 % '
                        . 'incluido. Al debe: Caja, Gs. 1.100.000. Al haber: Ventas, Gs. 1.000.000, e IVA '
                        . 'débito fiscal, Gs. 100.000.',
                    'Asiento 2. Compra de mercaderías a crédito por Gs. 660.000, con IVA incluido. Al debe: '
                        . 'Mercaderías, Gs. 600.000, e IVA crédito fiscal, Gs. 60.000. Al haber: '
                        . 'Proveedores, Gs. 660.000.',
                    'Asiento 3. Depósito en el banco de Gs. 800.000 retirados de la caja. Al debe: Banco, '
                        . 'Gs. 800.000. Al haber: Caja, Gs. 800.000.',
                    'Los tres asientos suman Gs. 2.560.000 al debe y Gs. 2.560.000 al haber: cuadran. Las '
                        . 'cuentas y los nombres pueden variar según el plan de cuentas de cada empresa.',
                ],
            ],
            [
                'title' => 'Libro mayor contable: pasar los asientos a cada cuenta',
                'body'  => [
                    'El libro mayor tiene una hoja por cuenta. Cada línea del diario se copia en la cuenta '
                        . 'que corresponde, del lado del debe o del haber, y al final se calcula el saldo.',
                    'Ejemplo con la cuenta Caja del punto anterior. Debe: Gs. 1.100.000 (asiento 1). Haber: '
                        . 'Gs. 800.000 (asiento 3). Saldo deudor: Gs. 300.000, que es el efectivo que '
                        . 'queda en la caja. La cuenta Banco muestra Gs. 800.000 al debe, y Proveedores '
                        . 'muestra Gs. 660.000 al haber, que es lo que se debe.',
                    'Al cierre del período se suman los saldos de todas las cuentas del mayor. De ahí sale '
                        . 'el balance de comprobación, que es el punto de partida del balance general.',
                ],
            ],
            [
                'title' => 'Diferencia entre libro diario y libro mayor',
                'body'  => [
                    'El diario responde a la pregunta cuándo y qué pasó, y se escribe en el momento. El '
                        . 'mayor responde cuánto hay en cada cuenta, y se arma a partir del diario. Por eso '
                        . 'los dos tienen que coincidir: el total del debe y del haber del mayor es el '
                        . 'mismo que el del diario.',
                    'Hoy casi todas las empresas llevan ambos libros en un sistema contable. El sistema '
                        . 'pasa los asientos al mayor solo, pero conviene revisar que los saldos tengan '
                        . 'sentido y que cada asiento tenga su comprobante. Si prefiere no hacerlo usted, '
                        . 'en nuestro servicio de contabilidad llevamos los libros todos los meses.',
                ],
            ],
            [
                'title' => 'Libros contables obligatorios y rúbrica en Paraguay',
                'body'  => [
                    'La Ley 1034/83 obliga al comerciante a llevar una contabilidad en orden cronológico y '
                        . 'regular, con los libros necesarios para eso, y a conservarlos cinco años desde la '
                        . 'última anotación (Arts. 11 y 85). Antes de usarse, los libros se presentan al '
                        . 'Registro Público de Comercio para su rúbrica (Art. 78). La ley nombra el libro '
                        . 'diario (Art. 80) y el libro de inventario (Art. 82), y no el libro mayor.',
                    'Para las empresas por acciones simplificadas, la Ley 6.480/2020 pide, entre otros, '
                        . 'libro diario y libro de inventario rubricados. Para una SRL o una S.A., los '
                        . 'libros contables y los libros societarios (actas, registro de acciones) '
                        . 'dependen del tipo de sociedad y de lo que fijen la ley y los estatutos: consulte '
                        . 'con nosotros cuáles le corresponden. Los libros de compras y ventas del IVA son '
                        . 'otro registro, con reglas de la DNIT que se actualizan, y no los reemplaza el '
                        . 'libro diario.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Qué es el libro diario?', 'a' => 'Es el libro donde se anotan, en orden cronológico, todas las operaciones de la empresa en forma de asientos contables, con su debe y su haber. Es la base de la contabilidad.'],
            ['q' => '¿Qué es el libro mayor y para qué sirve?', 'a' => 'Es el libro que agrupa los asientos del diario por cuenta (Caja, Banco, Ventas, Proveedores) y muestra el saldo de cada una. Sirve para armar el balance y controlar las cuentas.'],
            ['q' => '¿Qué libros contables son obligatorios en una SRL o una S.A.?', 'a' => 'La Ley 1034/83 exige llevar los libros necesarios para una contabilidad ordenada y nombra el libro diario y el de inventario. Los demás libros, como los societarios, dependen del tipo de sociedad: consulte con nosotros según su caso.'],
            ['q' => '¿Se puede llevar el libro diario en Excel?', 'a' => 'Muchas empresas lo trabajan en planilla o en un sistema contable. Para que sirva como libro, hay que cumplir las formalidades de la ley, como la rúbrica del Registro Público de Comercio. Consulte cómo hacerlo antes de empezar.'],
        ],
        'relatedService' => 'contabilidad',
        'toolLink' => null,
        'related' => ['conciliacion-bancaria', 'formulario-120-paso-a-paso', 'suace'],
        'thumbnail' => [
            'src' => '/assets/img/libro-diario-libro-mayor-contabilidad-1280.avif',
            'alt' => 'Una fila de personas lleva una cinta de asientos desde el libro diario hasta un libro mayor lleno de cajones ordenados.',
        ],
    ],

    'conciliacion-bancaria' => [
        'path'            => '/guias/conciliacion-bancaria/',
        'title'           => 'Conciliación bancaria',
        'navLabel'        => 'Conciliación bancaria',
        'seoTitle'        => 'Conciliación bancaria: qué es y ejemplo',
        'metaDescription' => 'Conciliación bancaria: qué es, cómo hacerla paso a paso y un ejemplo con depósito en '
                            . 'tránsito, cheque pendiente y comisión del banco, con su asiento.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Conciliación bancaria: qué es, cómo se hace y un ejemplo',
            'lead'    => 'Cómo comparar el extracto del banco con sus libros, explicar la diferencia y '
                        . 'registrar lo que falta.',
        ],
        'intro' => [
            'La conciliación bancaria es la comparación entre el saldo de la cuenta del banco en su '
                . 'contabilidad y el saldo que figura en el extracto del banco. Rara vez coinciden el '
                . 'mismo día, y la conciliación explica por qué: qué partidas están de un lado y todavía '
                . 'no en el otro.',
            'Se hace todos los meses y sirve para detectar errores, comisiones sin registrar y cheques '
                . 'que no se cobraron. Esta guía muestra el método y un ejemplo con cifras que cierran.',
        ],
        'steps' => [
            [
                'title' => 'Junte el extracto y el mayor del banco',
                'body'  => [
                    'Necesita dos documentos del mismo período: el extracto que entrega el banco y la '
                        . 'cuenta Banco del libro mayor de su contabilidad. Anote el saldo final de cada '
                        . 'uno. En el ejemplo de esta guía, el mayor muestra Gs. 10.000.000 y el extracto, '
                        . 'Gs. 8.850.000.',
                ],
            ],
            [
                'title' => 'Marque lo que coincide y detecte las diferencias',
                'body'  => [
                    'Compare movimiento por movimiento, con fecha e importe. Lo que está en los dos lados '
                        . 'queda tildado. Lo que sobra en uno de ellos es una partida conciliatoria. Hay '
                        . 'dos grupos: las que el banco todavía no registró (depósitos en tránsito, '
                        . 'cheques emitidos que no se cobraron) y las que usted todavía no registró '
                        . '(comisiones, intereses, débitos automáticos, errores).',
                ],
            ],
            [
                'title' => 'Conciliación bancaria, ejemplo con cifras',
                'body'  => [
                    'Datos. Saldo según el extracto: Gs. 8.850.000. Depósito en tránsito (hecho el último '
                        . 'día, el banco lo acredita después): Gs. 1.500.000. Cheque emitido que todavía no '
                        . 'se cobró: Gs. 400.000. Comisión de mantenimiento del banco, que no está en los '
                        . 'libros: Gs. 50.000.',
                    'Del lado del banco: Gs. 8.850.000 más el depósito en tránsito de Gs. 1.500.000, menos '
                        . 'el cheque pendiente de Gs. 400.000, da un saldo conciliado de Gs. 9.950.000.',
                    'Del lado de los libros: Gs. 10.000.000 menos la comisión de Gs. 50.000 también da '
                        . 'Gs. 9.950.000. Los dos lados coinciden, entonces la conciliación cierra.',
                ],
            ],
            [
                'title' => 'Asiento de conciliación bancaria',
                'body'  => [
                    'Las partidas del banco (depósito en tránsito, cheque pendiente) no llevan asiento: '
                        . 'se resuelven solas cuando el banco las registra. Solo se asienta lo que falta en '
                        . 'sus libros. En el ejemplo, la comisión: al debe, Gastos bancarios, Gs. 50.000; '
                        . 'al haber, Banco, Gs. 50.000.',
                    'Después del asiento, la cuenta Banco del mayor queda en Gs. 9.950.000, igual al saldo '
                        . 'conciliado. Guarde la planilla de conciliación firmada junto al extracto.',
                ],
            ],
            [
                'title' => 'Conciliación bancaria en Excel y cada cuánto',
                'body'  => [
                    'Una planilla con cuatro bloques alcanza: saldo del extracto, partidas del banco, '
                        . 'saldo de libros y partidas de libros. La diferencia final tiene que ser cero. '
                        . 'Hágala una vez por mes, con cada cuenta bancaria por separado, y antes de '
                        . 'cerrar el mes contable.',
                    'Si la diferencia no cierra, revise primero los importes con cifras invertidas (por '
                        . 'ejemplo, 45.000 en vez de 54.000) y los movimientos de otro mes. Si prefiere no '
                        . 'hacerlo usted, en nuestro servicio de contabilidad conciliamos las cuentas '
                        . 'todos los meses.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Qué es la conciliación bancaria?', 'a' => 'Es el control que compara el saldo de la cuenta del banco en su contabilidad con el del extracto, y explica cada diferencia entre ambos. Se hace una vez por mes.'],
            ['q' => '¿Cómo se hace una conciliación bancaria paso a paso?', 'a' => 'Se toman el extracto y el mayor del banco, se tildan los movimientos que coinciden, se listan las diferencias y se ajusta cada lado hasta llegar al mismo saldo. Lo que falta en libros se registra con un asiento.'],
            ['q' => '¿Qué es un depósito en tránsito?', 'a' => 'Es un depósito que usted ya registró en sus libros, pero que el banco todavía no acreditó en el extracto porque se hizo al cierre del período. No lleva asiento.'],
            ['q' => '¿Con qué frecuencia hay que conciliar el banco?', 'a' => 'Lo habitual es una vez por mes, antes de cerrar la contabilidad. Una empresa con muchos movimientos puede conciliar con más frecuencia.'],
        ],
        'relatedService' => 'contabilidad',
        'toolLink' => null,
        'related' => ['libro-diario-y-libro-mayor', 'formulario-120-paso-a-paso'],
        'thumbnail' => [
            'src' => '/assets/img/conciliacion-bancaria-banco-libros-1280.avif',
            'alt' => 'Contadora con una lupa coloca la moneda que faltaba para unir los movimientos del banco con los del libro contable.',
        ],
    ],

    'registro-mipymes' => [
        'path'            => '/guias/registro-mipymes/',
        'title'           => 'Registro MIPYMES',
        'navLabel'        => 'Registro MIPYMES y cédula',
        'seoTitle'        => 'MIPYMES Paraguay: cédula y registro',
        'metaDescription' => 'MIPYMES en Paraguay: qué categorías existen, cómo obtener la cédula MIPYMES en '
                            . 'mipymes.gov.py, qué beneficios da y qué hacer si su empresa no la recibió.',
        'lastReviewed'    => '2026-10-17',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'MIPYMES en Paraguay: registro y cédula MIPYMES, paso a paso',
            'lead'    => 'Cómo saber si su empresa es micro, pequeña o mediana, cómo descargar la cédula y '
                        . 'qué beneficios trae.',
        ],
        'intro' => [
            'Las MIPYMES (micro, pequeñas y medianas empresas) se rigen por la Ley N.º 4457/2012, '
                . 'modificada por la Ley N.º 7444, publicada en enero de 2025. Las categorías se definen '
                . 'por la cantidad de trabajadores y la facturación anual, y las administra el '
                . 'Viceministerio de MIPYMES del Ministerio de Industria y Comercio (MIC).',
            'Con la ley vigente, el registro ya no es un trámite que cada empresa inicia desde cero: el '
                . 'MIC arma el Registro Nacional de MIPYMES cruzando datos de la DNIT, el IPS y el MTESS. '
                . 'Esta guía explica cómo comprobar si su empresa figura y qué hacer si no. Es orientativa: '
                . 'los topes de facturación pueden actualizarse por decreto.',
        ],
        'steps' => [
            [
                'title' => 'Confirme que su RUC está activo',
                'body'  => [
                    'La base del registro es el RUC. La cédula se genera para empresas con RUC activo; sin '
                        . 'RUC, la empresa no entra. Si todavía no lo tiene, primero hay que inscribirlo.',
                ],
            ],
            [
                'title' => 'Identifique su categoría',
                'body'  => [
                    'La ley define tres categorías: microempresa (hasta diez trabajadores), pequeña (de once '
                        . 'a treinta) y mediana (de treinta y uno a cincuenta), cada una con su tope de '
                        . 'facturación anual. Los topes en guaraníes los fija y actualiza el MIC, y las '
                        . 'cifras publicadas varían entre fuentes: confírmelos en el sitio del MIC antes de '
                        . 'decidir nada.',
                    'Si hay discrepancia entre los parámetros, la ley da prioridad a la facturación bruta '
                        . 'anual. Para empresas recién creadas se toma en cuenta el activo patrimonial '
                        . 'declarado.',
                ],
            ],
            [
                'title' => 'Descargue la cédula MIPYMES en línea',
                'body'  => [
                    'La cédula MIPYMES se obtiene en la página web del MIC, en mipymes.gov.py, y la '
                        . 'inclusión en el registro es gratuita, sin trámites presenciales. Como el registro '
                        . 'se arma con datos de la DNIT, el IPS y el MTESS, su empresa puede figurar ya sin '
                        . 'haberlo pedido.',
                ],
            ],
            [
                'title' => 'Si no figura o la categoría no es la correcta',
                'body'  => [
                    'Verifique que el RUC esté activo y que sus declaraciones y su registro patronal estén '
                        . 'al día, porque el sistema se alimenta de esos datos. Si la categoría asignada no '
                        . 'es la adecuada, la ley permite pedir al Viceministerio de MIPYMES que la '
                        . 'modifique, con la documentación de respaldo.',
                    'La ley deja fuera a las empresas de intermediación financiera y de seguros, y a '
                        . 'ciertas personas físicas contribuyentes del impuesto a la renta personal.',
                ],
            ],
            [
                'title' => 'Aproveche los beneficios y renueve cada año',
                'body'  => [
                    'La ley prevé trato preferencial en contrataciones públicas, descuentos en la patente '
                        . 'comercial y exoneración o descuento de tasas por servicios del Estado para micro '
                        . 'y pequeñas empresas. La cédula se actualiza cada año, y eso puede cambiar su '
                        . 'categoría o sacarla del registro si supera los límites.',
                ],
            ],
        ],
        'faq' => [
            ['q' => '¿Qué es la cédula MIPYMES?', 'a' => 'Es el documento que acredita que una empresa está formalizada y registrada como micro, pequeña o mediana. Según la ley, sirve ante cualquier institución pública o privada como constancia de entidad jurídica formalizada, y se actualiza todos los años.'],
            ['q' => '¿Tiene costo registrarse como MIPYME?', 'a' => 'No. La Ley N.º 7444 establece que la inclusión en el Registro Nacional de MIPYMES es gratuita, y la cédula se descarga sin costo en mipymes.gov.py.'],
            ['q' => '¿Cuál es el tope de facturación de cada categoría?', 'a' => 'Lo fija el MIC y se actualiza según el índice de precios al consumidor, así que cambia. La ley fija los tramos de trabajadores: hasta 10, de 11 a 30 y de 31 a 50. Para los montos en guaraníes, consulte los topes vigentes en el sitio del MIC.'],
            ['q' => '¿Una persona física con RUC puede ser MIPYME?', 'a' => 'Depende de su situación tributaria. La ley excluye a ciertas personas físicas contribuyentes del impuesto a la renta personal. Revise su caso con su contador antes de contar con los beneficios.'],
        ],
        'relatedService' => 'eas',
        'toolLink' => [
            'path'  => '/herramientas/comparador-eas-srl-unipersonal/',
            'label' => 'Comparador EAS, SRL o Unipersonal',
            'text'  => 'Si todavía no tiene empresa, compare las formas de constituirla antes de registrarla como MIPYME.',
        ],
        'related' => ['suace', 'inscripcion-de-ruc-paso-a-paso'],
        'thumbnail' => [
            'src' => '/assets/img/mipymes-comercios-barrio-paraguay-1280.avif',
            'alt' => 'Calle de barrio con panadería de chipa, sastrería, taller de motos y carpintería cada vez más altos, bajo una insignia dorada.',
        ],
    ],

];
