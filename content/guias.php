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
        'seoTitle'        => 'Consulta de RUC en Paraguay: cómo hacerla',
        'metaDescription' => 'Cómo consultar un RUC en Paraguay — el propio o el de otra persona o '
                            . 'empresa — y qué datos puede ver en cada caso. Guía paso a paso.',
        'lastReviewed'    => '2026-09-04',
        'hero' => [
            'eyebrow' => 'Guías',
            'h1'      => 'Cómo hacer una consulta de RUC',
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

];
