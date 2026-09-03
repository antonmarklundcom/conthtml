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

    'nav' => [
        'home'        => 'Inicio',
        'services'    => 'Servicios',
        'pricing'     => 'Precios',
        'tools'       => 'Herramientas',
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

    'home' => [
        // Month-neutral by design: the 1B mock said "cierre de septiembre",
        // which would be wrong eleven months a year.
        'eyebrow' => 'Aceptamos nuevas empresas este mes',
        'h1_lead' => 'Deje los impuestos y la contabilidad a un equipo que ',
        'h1_accent' => 'nunca llega tarde.',
        'lead'    => 'Contadores matriculados que llevan sus libros, presentan IVA y renta, '
                   . 'liquidan la nómina y lo dejan habilitado en SIFEN. Un solo contacto.',
    ],

    'services_hub' => [
        'eyebrow' => 'Servicios',
        'title'   => 'Un solo equipo para todo su cumplimiento.',
        'lead'    => 'Contrate lo que necesita hoy y sume servicios cuando su empresa crezca.',
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
        'benefits'  => 'Beneficios',
        'faq'       => 'Preguntas frecuentes',
        'related'   => 'Servicios relacionados',
        'breadcrumb' => 'Ruta de navegación',
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
