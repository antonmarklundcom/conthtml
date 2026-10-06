<?php
/**
 * Every UI string on the site, in one file — the single-locale i18n layer
 * (plan §2). Copy is Spanish (Paraguay), formal "usted" throughout: the legacy
 * site mixed "vos" and none of that carries over (plan §1.3).
 *
 * Nothing here may name a month, a year, a price or a client: strings must stay
 * true without anyone remembering to edit them.
 */

declare(strict_types=1);

return [

    // Cluster labels, in the order the mega-menu and the /servicios/ hub use.
    // The grouping is the legacy information architecture (plan §1.9).
    'clusters' => [
        'digital'   => 'Soluciones digitales de cumplimiento',
        'gestion'   => 'Gestión empresarial',
        'auditoria' => 'Auditoría',
    ],

    // One line under each cluster heading on /servicios/. Keyed by cluster id.
    'cluster_leads' => [
        'digital'   => 'Todo lo que la DNIT le exige hacer en línea: facturación electrónica '
                     . 'en SIFEN, su cuenta en Marangatu y la inscripción de RUC.',
        'gestion'   => 'La operación mensual y anual de su empresa: contabilidad, IVA, IRE, IRP, '
                     . 'nómina e IPS, apertura de sociedades y asesoría tributaria.',
        'auditoria' => 'Informes con respaldo profesional para bancos, socios y organismos de '
                     . 'control, y peritajes cuando hay algo que probar.',
    ],

    'nav' => [
        'home'        => 'Inicio',
        'services'    => 'Servicios',
        'pricing'     => 'Precios',
        'tools'       => 'Herramientas',
        'guides'      => 'Guías',
        'about'       => 'Nosotros',
        'blog'        => 'Blog',
        'contact'     => 'Contacto',
        'privacy'     => 'Privacidad',
        'terms'       => 'Términos',
        'menu'        => 'Menú',
        'close'       => 'Cerrar',
        'open_menu'   => 'Abrir el menú',
        'close_menu'  => 'Cerrar el menú',
        'skip'        => 'Ir al contenido principal',
        'firm'        => 'Firma',
        'all_services' => 'Ver todos los servicios',
    ],

    'cta' => [
        'quote'        => 'Pedí tu propuesta',
        'whatsapp'     => 'WhatsApp',
        'whatsapp_long' => 'Escribinos por WhatsApp',
        'consult'      => 'Consultá sin costo',
        'contact'      => 'Contactar',
        'see_included' => 'Ver servicios',
        'talk'         => 'Hablemos de tu empresa',
    ],

    // The WhatsApp menu (plan §5.3.8b). These are BUTTON LABELS only — the
    // message that actually reaches WhatsApp always comes from
    // content/lead-values.php and names a service, never "consulta gratis".
    'whatsapp' => [
        'menu_title'   => '¿Qué necesitás resolver?',
        'menu_note'    => 'Elegí un servicio para continuar por WhatsApp. Podés editar el mensaje antes de enviarlo.',
        'other'        => 'Otra consulta',
        'this_page'    => 'Tu consulta',
        'open_menu'    => 'Abrir opciones de WhatsApp',
        'close_menu'   => 'Cerrar',
        'groups' => [
            'contabilidad' => ['label' => 'Contabilidad e impuestos', 'description' => 'Contabilidad mensual, IVA, IRE y Marangatu.'],
            'eas' => ['label' => 'Abrir empresa o RUC', 'description' => 'EAS, SRL, SA e inscripción de RUC.'],
            'ips' => ['label' => 'Sueldos, nómina e IPS', 'description' => 'Salarios, aguinaldo y planillas de personal.'],
            'ekuatia' => ['label' => 'Facturación electrónica', 'description' => "SIFEN, timbrado y Ekuatia'i."],
            'other' => ['label' => 'Otra consulta', 'description' => 'Auditoría, asesoría o ayuda para elegir.'],
        ],
    ],

    'home' => [
        // Month-neutral by design: the 1B mock said "cierre de septiembre",
        // which would be wrong eleven months a year.
        'eyebrow' => 'Contabilidad para empresas en Paraguay',
        // Plan §5.2.6: 1B's promise headline, rebuilt around "estudio contable" —
        // the highest-volume commercial term in docs/keyword-research.md, and the
        // keyword the H1 has to carry (plan §4.11).
        'h1_lead'   => 'Estudio contable en Asunción. ',
        'h1_accent' => 'Su empresa, en orden.',
        'lead'    => 'Nos ocupamos de tu contabilidad, impuestos y nómina para que puedas enfocarte '
                   . 'en tus clientes, tu operación y el crecimiento de tu negocio. '
                   . 'Un contacto, obligaciones organizadas y una propuesta clara por escrito.',
        'report_note' => 'Un ejemplo de cómo puede ver sus libros, impuestos y nómina en un informe claro.',
        'contact_title' => 'Hablemos de lo que necesita tu empresa',
        'contact_lead' => 'Contanos qué querés resolver. Empezamos con una consulta inicial sin costo '
                        . 'y definimos una propuesta por escrito para simplificar tu gestión contable.',
        'contact_steps' => [
            'Tu nombre, WhatsApp y el servicio que buscás alcanzan para iniciar.',
            'Revisamos tu caso y qué información hace falta.',
            'Recibís el alcance y los honorarios por escrito antes de empezar.',
        ],
        'process_title' => 'De la consulta a una propuesta concreta',
        'process_steps' => [
            ['title' => 'Contanos qué necesitás', 'text' => 'Tu nombre, WhatsApp y una descripción breve de tu actividad alcanzan para empezar.'],
            ['title' => 'Revisamos el alcance', 'text' => 'Definimos qué hacemos nosotros, qué información necesitamos de vos y cuáles son los próximos pasos.'],
            ['title' => 'Acordamos la propuesta', 'text' => 'Recibís el alcance y los honorarios por escrito. Empezamos cuando estés de acuerdo.'],
        ],

        // Persona switcher (redesign pass, 2026-09): a one-click jump from the
        // hero to the segment page that already exists for that audience
        // (content/segmentos.php, phase C3) or to the English section (C5).
        // Kept to four — the ones with a real page behind them and the
        // clearest "younger/digital" read; adding a fifth (e.g. real estate)
        // means writing that segmentos.php entry first, not just a link.
        'persona_eyebrow' => 'Contabilidad según tu actividad',
        'personas' => [
            ['label' => 'Ecommerce y comercio',      'href' => '/contador-para/comercios/'],
            ['label' => 'Startup y emprendimiento',  'href' => '/contador-para/emprendedores/'],
            ['label' => 'Profesional independiente', 'href' => '/contador-para/profesionales-independientes/'],
            ['label' => 'Extranjero en Paraguay',    'href' => '/en/'],
        ],

        // The homepage services band. Its own copy, so the /servicios/ hub can
        // say something different without either page losing its voice.
        'services_eyebrow' => 'Servicios',
        'services_title'   => '¿Qué necesitás resolver?',
        'services_lead'    => 'Contabilidad, impuestos y gestión empresarial. Empezá por lo que necesitás hoy; '
                            . 'acordamos el alcance antes de comenzar.',

        // The six cards of plan §1.8: the five from the 1B mock plus Auditoría.
        // 'path' is the card's own page; 'links' are the sibling legacy pages the
        // card covers, so every URL the old site ranks on stays one click away.
        'cards' => [
            [
                'title' => 'Contabilidad mensual',
                'text'  => 'Comprobantes, libros y declaraciones organizados. Información clara para decidir y concentrarte en tu negocio.',
                'path'  => '/contabilidad/',
                'links' => [],
            ],
            [
                'title' => 'Impuestos: IVA e IRE',
                'text'  => 'Liquidación de IVA e IRE, control de vencimientos y gestión en Marangatu ante la DNIT.',
                'path'  => '/iva/',
                'links' => [
                    ['label' => 'IRE Simple', 'path' => '/ire-simple/'],
                    ['label' => 'IRP',        'path' => '/irp/'],
                    ['label' => 'Marangatu',  'path' => '/marangatu/'],
                    ['label' => 'Asesoría',   'path' => '/asesoria/'],
                ],
            ],
            [
                'title' => 'Sueldos, nómina e IPS',
                'text'  => 'Salarios, aguinaldo, vacaciones y planillas de IPS y MTESS.',
                'path'  => '/ips/',
                'links' => [],
            ],
            [
                'title' => 'Abrir una EAS o inscribir mi RUC',
                'text'  => 'E.A.S., S.R.L. o S.A., inscripción de RUC y seguimiento de los trámites de apertura.',
                'path'  => '/eas/',
                'links' => [
                    ['label' => 'Inscripción de RUC', 'path' => '/ruc/'],
                ],
            ],
            [
                'title' => 'Facturación electrónica',
                'text'  => "Habilitación en SIFEN, timbrado y puesta en marcha de Ekuatia'i.",
                'path'  => '/ekuatia/',
                'links' => [],
            ],
            [
                'title' => 'Auditoría',
                'text'  => 'Auditoría impositiva, interna y forense, con el alcance definido para cada caso.',
                'path'  => '/auditoria/',
                'links' => [
                    ['label' => 'Impositiva', 'path' => '/auditoria-auditoria-impositiva/'],
                    ['label' => 'Interna',    'path' => '/auditoria-auditoria-interna/'],
                    ['label' => 'Forense',    'path' => '/auditoria-auditoria-forense/'],
                ],
            ],
        ],

        // The strip under the service grid. In the 1B mock this was a seventh
        // tile; with six real services it reads better as a full-width band.
        'unsure_title' => '¿No sabés por dónde empezar?',
        'unsure_text'  => 'Contanos tu situación. Te orientamos sobre el servicio y el alcance para tu caso.',
    ],

    // The hero panel. It illustrates what the monthly report covers — it is not
    // a client portal (plan §8 parks that) and never shows a client name or an
    // invented figure. Labels only; no amounts, no dates, no percentages.
    'panel' => [
        'title' => 'Su cierre mensual, a la vista',
        'badge' => 'Al día',
        'tiles' => [
            ['label' => 'IVA mensual',                'value' => 'Presentado'],
            ['label' => 'Nómina e IPS',               'value' => 'Liquidada'],
            ['label' => 'Libro de compras y ventas',  'value' => 'Conciliado'],
        ],
        'foot'  => 'Próximo vencimiento: IRE · F.120',
        'note'  => 'Ejemplo del informe mensual',
    ],

    // "Quiénes somos" on the homepage. Every line here is a commitment about how
    // we work, never a claim about size, seniority or results — those would need
    // Anton's confirmation (plan §7) and none has arrived.
    'about' => [
        'eyebrow' => 'Una forma clara de trabajar',
        'title'   => 'Su información organizada. Sus próximos pasos, claros.',
        'text'    => 'Llevamos la contabilidad, los impuestos y la nómina de empresas de comercio, '
                   . 'servicios, construcción e importación. El trabajo comienza con un alcance '
                   . 'por escrito y sigue con documentación ordenada e informes que pueda entender.',
        // Shown when content/site.php has no credentials[] yet (plan §1.4).
        'credentials' => [
            'Contadores públicos matriculados',
            'Un contador asignado a su empresa, no una mesa de entrada',
            'Cada comprobante se registra una sola vez, sin doble carga',
            'Honorario mensual fijo, con el alcance acordado por escrito',
        ],
        'home_credentials' => [
            'Un contacto para coordinar su consulta',
            'Documentación y obligaciones organizadas',
            'Informes en lenguaje claro',
            'Alcance y honorarios acordados por escrito',
        ],
        'badge_note'     => 'de ejercicio profesional',
        'badge_fallback' => 'Contadores públicos matriculados',
        'link'           => 'Conocer nuestro estudio',
        'workflow_title' => 'De los comprobantes al informe',
        'workflow_note'  => 'Así se organiza el trabajo contable',
        'workflow_steps' => ['Documentación', 'Gestión contable', 'Informe y próximos pasos'],
    ],

    // The four-step "Cómo trabajamos" block, reused on service pages (plan §5.2.3).
    // Timings follow the A1 house rule: "siguiente día hábil" and "por escrito",
    // never an SLA in hours or days that nobody has confirmed.
    'process' => [
        'eyebrow' => 'Cómo trabajamos',
        'title'   => 'De la primera conversación al primer cierre, con fechas acordadas.',
        'steps'   => [
            [
                'title' => 'Conversación inicial',
                'text'  => 'Media hora para entender su rubro, su volumen y su situación actual '
                         . 'ante la DNIT y el IPS.',
            ],
            [
                'title' => 'Propuesta por escrito',
                'text'  => 'Alcance detallado y honorario mensual fijo, con lo que está incluido '
                         . 'y lo que no. Sin letra chica.',
            ],
            [
                'title' => 'Traspaso',
                'text'  => 'Recibimos su documentación, regularizamos lo pendiente y cargamos su '
                         . 'historial antes del primer cierre.',
            ],
            [
                'title' => 'Cierre mensual',
                'text'  => 'Un contador asignado, cierre antes del día 5 e informe mensual en '
                         . 'lenguaje claro.',
            ],
        ],
    ],

    // Rendered in place of the "Casos" band while content/site.php has no
    // testimonials (plan §5.2.1). Rubros, not clients: nothing to verify.
    //
    // Since C3, each item links to its real /contador-para/<slug>/ page
    // (plan §6.6.1) — content/segmentos.php is the source, this array only
    // orders and labels them for the band. partials/industries.php still
    // accepts a plain string with no path, for anyone reusing it elsewhere.
    'industries' => [
        'eyebrow' => 'Rubros',
        'title'   => 'Rubros que atendemos',
        'lead'    => 'Cada rubro tiene sus propias trampas tributarias. Estos son los que '
                   . 'trabajamos todos los meses.',
        'items'   => [
            ['label' => 'Comercios',                     'path' => '/contador-para/comercios/'],
            ['label' => 'Importadores',                  'path' => '/contador-para/importadores/'],
            ['label' => 'Construcción',                  'path' => '/contador-para/construccion/'],
            ['label' => 'Gastronomía',                    'path' => '/contador-para/gastronomia/'],
            ['label' => 'Profesionales independientes',  'path' => '/contador-para/profesionales-independientes/'],
            ['label' => 'Unipersonales',                  'path' => '/contador-para/unipersonales/'],
            ['label' => 'Emprendedores',                  'path' => '/contador-para/emprendedores/'],
            ['label' => 'Empresas extranjeras',           'path' => '/contador-para/empresas-extranjeras/'],
        ],
    ],

    // The band renders only when content/site.php has testimonials (plan §1.4).
    'testimonials' => [
        'eyebrow' => 'Casos',
        'title'   => 'Lo que dicen las empresas que atendemos',
    ],

    'services_hub' => [
        'eyebrow' => 'Servicios',
        'title'   => 'Servicios contables en Paraguay, de la apertura al cierre anual.',
        'lead'    => 'Contrate lo que necesita hoy y sume servicios cuando su empresa crezca. '
                   . 'Los tres bloques de abajo son la forma en que trabajamos: cumplimiento '
                   . 'digital ante la DNIT, gestión mensual de su empresa y auditoría.',
        // B4 review decision 3 (prompts/sonnet-4-polish-launch.md): the hub's
        // "¿No sabe qué necesita?" strip points at the quiz, not WhatsApp —
        // the homepage's own strip (home.unsure_*) already covers the direct
        // human-contact path.
        'unsure_title' => '¿No sabe qué necesita?',
        'unsure_text'  => 'Responda 4 preguntas y le decimos qué servicios le corresponden, con un enlace directo a cada uno.',
        'unsure_cta'   => 'Hacer el test',
    ],

    'cta_band' => [
        'eyebrow' => 'Más foco en tu negocio',
        'title'   => 'La contabilidad en orden. Tu atención, en hacer crecer tu negocio.',
        'lead'    => 'Contanos qué necesitás. Acordamos el alcance y los honorarios por escrito para que tengas claro el próximo paso.',
    ],

    'form' => [
        'legend'        => 'Pedí tu propuesta',
        'name'          => 'Nombre',
        'company'       => 'Empresa o rubro (opcional)',
        'phone'         => 'WhatsApp o teléfono',
        'phone_hint'    => 'Ej.: 0981 123 456',
        'email'         => 'Correo (opcional)',
        'need'          => '¿Qué necesitás?',
        'message'       => 'Contanos brevemente (opcional)',
        'required_note' => 'Nombre y WhatsApp o teléfono son obligatorios. Los demás datos son opcionales.',
        'optional'      => 'Agregar empresa, correo o mensaje',
        'plan_context'  => 'Plan consultado:',
        'message_hint'  => 'Rubro, cantidad de empleados, situación actual ante la DNIT…',
        'submit'        => 'Pedí tu propuesta',
        'sending'       => 'Enviando…',
        'privacy_note'  => 'Usamos tus datos para responder a tu consulta.',
        'success_title' => 'Recibimos su consulta.',
        'success_text'  => 'Le respondemos dentro del siguiente día hábil. Si prefiere, escríbanos ahora.',
        'error_title'   => 'Revise su consulta.',
        'error_text'    => 'No pudimos confirmar la recepción. Sus datos siguen aquí: puede volver a intentar o escribirnos por WhatsApp.',
        'error_phone'   => 'Necesitamos un teléfono o WhatsApp válido para responderle.',
        'error_email'   => 'Revise el correo o déjelo vacío si prefiere que le respondamos por WhatsApp.',
        'error_rate'    => 'Hubo varios intentos seguidos. Espere un momento antes de volver a intentar o escríbanos por WhatsApp.',
        'error_origin'  => 'Recargue la página antes de volver a intentar. También puede escribirnos por WhatsApp.',
        'error_whatsapp' => 'Escribir directamente por WhatsApp',
        'recovery_title' => 'Mi consulta desde el sitio:',
        'required'      => 'obligatorio',
        // The per-service thank-you state (plan §5.3.4). The lines under it come
        // from content/lead-values.php's nextStep, so the second touch says
        // something specific instead of "gracias".
        'thanks_next'     => 'Qué sigue',
        'thanks_whatsapp' => 'Si prefiere no esperar, escríbanos ahora por WhatsApp.',
        // The vencimientos reminder capture (plan §5.3.6).
        'remind_title'  => 'Que le avisemos antes de cada vencimiento',
        'remind_text'   => 'Le anotamos su terminación de RUC y le escribimos por WhatsApp unos días antes.',
        'remind_phone'  => 'Su WhatsApp',
        'remind_submit' => 'Quiero que me recuerden',
        'remind_ok'     => 'Anotado. Le escribimos antes del próximo vencimiento.',
    ],

    // The chip selector from 1B. Values travel to VenderCRM in fields.necesita.
    'needs' => [
        'contabilidad' => 'Contabilidad e impuestos',
        'apertura'     => 'Abrir empresa',
        'nomina'       => 'Nómina',
        'sifen'        => 'SIFEN',
        'cambio'       => 'Cambiar de contador',
        'otro'         => 'Otro',
    ],

    'contact' => [
        'eyebrow' => 'Contacto',
        'title'   => 'Hablemos de su empresa.',
        'lead'    => 'Escríbanos por WhatsApp o déjenos sus datos y le respondemos dentro '
                   . 'del siguiente día hábil.',
        'address' => 'Dirección',
        'hours'   => 'Horario',
        'phone'   => 'Teléfono',
        'email'   => 'Correo',
        'expect'  => 'Qué pasa después',
        // The three steps of 1B's "Cómo trabajamos" block, as commitments about
        // the process — not claims about clients, staff or results.
        'steps'   => [
            'Le respondemos dentro del siguiente día hábil.',
            'Coordinamos una llamada de 30 minutos, sin costo ni compromiso.',
            'Recibe una propuesta con el alcance y el honorario mensual por escrito.',
        ],
    ],

    'service' => [
        'includes'  => 'Qué incluye',
        'excludes'  => 'Qué no incluye',
        'we_need'   => 'Qué necesitamos de usted',
        'benefits'  => 'Beneficios',
        'faq'       => 'Preguntas frecuentes',
        'related'   => 'Servicios relacionados',
        'guides'    => 'Guía relacionada',
        'articles'  => 'Artículo relacionado',
        // The service-page lead form (plan §5.3.2): every service page carries
        // a form of its own so the lead arrives tagged with that service.
        'form_eyebrow' => 'Cotización',
        'form_lead'    => 'Déjenos sus datos y le respondemos con una propuesta concreta, '
                        . 'sin costo y sin compromiso.',
        'breadcrumb' => 'Ruta de navegación',
    ],

    // Segment landing pages, /contador-para/<slug>/ and /cambiar-de-contador/
    // (plan §6.6). Reuses 'service.we_need', 'service.faq' and 'form.legend'
    // rather than duplicating them.
    'segment' => [
        'traps_title'  => 'Los errores que más le cuestan en su rubro',
        'bundle_title' => 'Lo que armamos para su rubro',
        'form_eyebrow' => 'Cotización para su rubro',
        'form_lead'    => 'Cuéntenos su rubro y su volumen; le respondemos con una propuesta concreta, '
                        . 'sin costo y sin compromiso.',
    ],

    // Shared microcopy across the six /herramientas/ tools (plan §6.3).
    // Calculator-specific labels (field names, quiz questions) live in each
    // tool's own PHP/JS; only the strings repeated on every tool page are here.
    'tools' => [
        'reviewed_prefix' => 'Datos legales revisados el',
        'orientativo'     => 'Los resultados son orientativos y no reemplazan una liquidación oficial.',
        'calculate'       => 'Calcular',
        'result_title'    => 'Resultado',
        'use_result'      => 'Usar este resultado en el formulario',
        'need_js'         => 'Esta calculadora necesita JavaScript activado en su navegador.',
        'restart'         => 'Volver a empezar',
    ],

    // Shared microcopy across the ten /guias/ pages (plan §6.5).
    'guide' => [
        'reviewed_prefix'       => 'Revisado el',
        'orientativo'           => 'Es una guía general: para su caso puntual, confírmelo con nosotros.',
        'delegate_eyebrow'      => 'Delegarlo',
        'delegate_title'        => '¿Prefiere que lo hagamos nosotros?',
        'delegate_lead'         => 'Le respondemos dentro del siguiente día hábil con los pasos exactos '
                                  . 'para su caso.',
        'delegate_form_heading' => 'Pedir que nos encarguemos',
        'related'               => 'Otras guías',
    ],

    'placeholder' => [
        // Shown on the A1 stub pages until the phase that owns each one writes it.
        'notice' => 'Estamos preparando esta página.',
        'action' => 'Mientras tanto, escríbanos y le respondemos por WhatsApp.',
    ],

    'error404' => [
        'title' => 'No encontramos esta página',
        'lead'  => 'Puede que el enlace haya cambiado. Estas son las secciones más buscadas.',
    ],

    'footer' => [
        'blurb'   => 'Estudio contable en Asunción. Contabilidad, impuestos y nómina para que puedas '
                   . 'enfocarte en tu empresa y su crecimiento.',
        'rights'  => 'Todos los derechos reservados.',
        'contact' => 'Contacto',
    ],
];
