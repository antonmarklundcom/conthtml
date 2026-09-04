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
        'quote'        => 'Pedir cotización',
        'whatsapp'     => 'WhatsApp',
        'whatsapp_long' => 'Escribir por WhatsApp',
        'consult'      => 'Solicitar consulta gratis',
        'contact'      => 'Contactar',
        'see_included' => 'Ver qué incluye',
        'talk'         => 'Hablar con un contador',
    ],

    // The WhatsApp menu (plan §5.3.8b). These are BUTTON LABELS only — the
    // message that actually reaches WhatsApp always comes from
    // content/lead-values.php and names a service, never "consulta gratis".
    'whatsapp' => [
        'menu_title'   => '¿Sobre qué quiere escribirnos?',
        'menu_note'    => 'Abrimos WhatsApp con el mensaje ya escrito. Puede cambiarlo antes de enviarlo.',
        'other'        => 'Otra consulta',
        'this_page'    => 'Lo que está viendo',
        'open_menu'    => 'Abrir opciones de WhatsApp',
        'close_menu'   => 'Cerrar',
    ],

    'home' => [
        // Month-neutral by design: the 1B mock said "cierre de septiembre",
        // which would be wrong eleven months a year.
        'eyebrow' => 'Aceptamos nuevas empresas este mes',
        // Plan §5.2.6: 1B's promise headline, rebuilt around "estudio contable" —
        // the highest-volume commercial term in docs/keyword-research.md, and the
        // keyword the H1 has to carry (plan §4.11).
        'h1_lead'   => 'Estudio contable en Asunción: impuestos, contabilidad y nómina ',
        'h1_accent' => 'sin llegar tarde.',
        'lead'    => 'Contadores matriculados que llevan sus libros, presentan IVA y renta, '
                   . 'liquidan la nómina y lo dejan habilitado en SIFEN. Un solo contacto.',

        // The homepage services band. Its own copy, so the /servicios/ hub can
        // say something different without either page losing its voice.
        'services_eyebrow' => 'Servicios',
        'services_title'   => 'Seis servicios. Un solo equipo responsable.',
        'services_lead'    => 'Contrate lo que necesita hoy y sume servicios cuando su empresa '
                            . 'crezca. Todo bajo el mismo honorario mensual.',

        // The six cards of plan §1.8: the five from the 1B mock plus Auditoría.
        // 'path' is the card's own page; 'links' are the sibling legacy pages the
        // card covers, so every URL the old site ranks on stays one click away.
        'cards' => [
            [
                'title' => 'Contabilidad mensual',
                'text'  => 'Libro de compras y ventas, conciliaciones y estados financieros. '
                         . 'Cierre antes del día 5, con un informe en lenguaje claro.',
                'path'  => '/contabilidad/',
                'links' => [],
            ],
            [
                'title' => 'Impuestos: IVA e IRE',
                'text'  => 'Liquidación mensual de IVA y presentación anual del IRE (F.120) en '
                         . 'Marangatu, control de vencimientos y respuesta ante la DNIT.',
                'path'  => '/iva/',
                'links' => [
                    ['label' => 'IRE Simple', 'path' => '/ire-simple/'],
                    ['label' => 'IRP',        'path' => '/irp/'],
                    ['label' => 'Marangatu',  'path' => '/marangatu/'],
                    ['label' => 'Asesoría',   'path' => '/asesoria/'],
                ],
            ],
            [
                'title' => 'Nómina',
                'text'  => 'Salarios, aguinaldo, vacaciones, planillas de IPS y MTESS, altas y '
                         . 'bajas. Recibos listos para firmar todos los meses.',
                'path'  => '/ips/',
                'links' => [],
            ],
            [
                'title' => 'Apertura de empresas y RUC',
                'text'  => 'E.A.S., S.R.L. o S.A. constituida, inscripción de RUC, patente y '
                         . 'registro patronal, con el seguimiento de cada trámite.',
                'path'  => '/eas/',
                'links' => [
                    ['label' => 'Inscripción de RUC', 'path' => '/ruc/'],
                ],
            ],
            [
                'title' => 'Facturación electrónica',
                'text'  => "Habilitación en SIFEN, timbrado y puesta en marcha de Ekuatia'i. "
                         . 'Emita factura electrónica válida desde el primer día.',
                'path'  => '/ekuatia/',
                'links' => [],
            ],
            [
                'title' => 'Auditoría',
                'text'  => 'Auditoría impositiva, interna y forense, con informes que resisten '
                         . 'la lectura de un banco, un socio o un organismo de control.',
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
        'unsure_title' => '¿No sabe qué necesita?',
        'unsure_text'  => 'Cuéntenos su situación y le decimos qué corresponde, sin costo.',
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
        'eyebrow' => 'Quiénes somos',
        'title'   => 'Contadores de verdad, con procesos digitales que un despacho tradicional '
                   . 'no tiene.',
        'text'    => 'Somos contadores públicos matriculados. Llevamos la contabilidad, los '
                   . 'impuestos y la nómina de empresas de comercio, servicios, construcción e '
                   . 'importación, con un proceso digital en el que cada comprobante se registra '
                   . 'una sola vez: menos errores de carga, cierres en días y su información '
                   . 'disponible cuando la pida.',
        // Shown when content/site.php has no credentials[] yet (plan §1.4).
        'credentials' => [
            'Contadores públicos matriculados',
            'Un contador asignado a su empresa, no una mesa de entrada',
            'Cada comprobante se registra una sola vez, sin doble carga',
            'Honorario mensual fijo, con el alcance acordado por escrito',
        ],
        'badge_note'     => 'de ejercicio profesional',
        'badge_fallback' => 'Contadores públicos matriculados',
        'link'           => 'Conocer al equipo',
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
    'industries' => [
        'eyebrow' => 'Rubros',
        'title'   => 'Rubros que atendemos',
        'lead'    => 'Cada rubro tiene sus propias trampas tributarias. Estos son los que '
                   . 'trabajamos todos los meses.',
        'items'   => [
            'Comercio',
            'Servicios',
            'Construcción',
            'Importación',
            'Profesionales independientes',
            'Gastronomía',
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
        'eyebrow' => 'Solicitar consulta',
        'title'   => 'Empecemos con una conversación de 30 minutos.',
        'lead'    => 'Sin costo y sin compromiso. Le respondemos con una propuesta concreta.',
    ],

    'form' => [
        'legend'        => 'Solicitar una consulta',
        'name'          => 'Nombre',
        'company'       => 'Empresa o rubro',
        'phone'         => 'WhatsApp o teléfono',
        'phone_hint'    => 'Ej.: 0981 123 456',
        'email'         => 'Correo (opcional)',
        'need'          => '¿Qué necesita?',
        'message'       => 'Cuéntenos brevemente',
        'message_hint'  => 'Rubro, cantidad de empleados, situación actual ante la DNIT…',
        'submit'        => 'Solicitar consulta gratis',
        'sending'       => 'Enviando…',
        'privacy_note'  => 'Usamos sus datos solo para responderle. Ver la política de privacidad.',
        'success_title' => 'Recibimos su consulta.',
        'success_text'  => 'Le respondemos dentro del siguiente día hábil. Si prefiere, escríbanos ahora.',
        'error_title'   => 'No pudimos enviar el formulario.',
        'error_text'    => 'Vuelva a intentarlo en un momento o escríbanos directamente.',
        'error_phone'   => 'Necesitamos un teléfono o WhatsApp válido para responderle.',
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
        // The service-page lead form (plan §5.3.2): every service page carries
        // a form of its own so the lead arrives tagged with that service.
        'form_eyebrow' => 'Cotización',
        'form_lead'    => 'Déjenos sus datos y le respondemos con una propuesta concreta, '
                        . 'sin costo y sin compromiso.',
        'breadcrumb' => 'Ruta de navegación',
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
        'blurb'   => 'Estudio contable en Asunción. Contabilidad, impuestos, nómina, apertura de '
                   . 'empresas y facturación electrónica para pymes de todo el país.',
        'rights'  => 'Todos los derechos reservados.',
        'contact' => 'Contacto',
    ],
];
