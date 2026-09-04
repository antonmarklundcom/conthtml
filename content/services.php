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
 *   excludes         string[] the "Qué no incluye" checklist (B1, optional)
 *   weNeed           string[] the "Qué necesitamos de usted" checklist (B1, optional)
 *   sections         array    [['h2' => ..., 'body' => [paragraph, ...],
 *                              'items' => [['title' => ..., 'text' => ...]]], ...]
 *   benefits         array    [['title' => ..., 'text' => ...], ...]
 *   faq              array    [['q' => ..., 'a' => ...], ...] → FAQPage JSON-LD
 *   cta              array    label (the button text). `whatsappText` is kept
 *                             for shape compatibility but is EMPTY and unused
 *                             since C1: every wa.me prefill on the site now
 *                             comes from content/lead-values.php through
 *                             whatsapp_text_for_page() (plan §5.3.8a), so there
 *                             is exactly one copy of each message.
 *   toolLinks        array    [['path' => '/herramientas/<slug>/', 'label' => ...,
 *                              'text' => ...], ...] — calculator callouts (B4,
 *                              optional; plan §6.4 review decision 3)
 *   related          string[] sibling slugs, 3 per page
 *   guides           string[] guide slugs from content/guias.php (C2, optional;
 *                             plan §6.5.3) — rendered as a small "Guía
 *                             relacionada" block by templates/service.php,
 *                             additive next to the existing related section
 *   articles         string[] blog article slugs from content/blog.php (C4,
 *                             optional; plan §6.7's internal-link pass) —
 *                             rendered as an "Artículo relacionado" block,
 *                             same additive pattern as `guides`. Curated by
 *                             topic, independent of a blog entry's own
 *                             `service` field (an article can be the natural
 *                             read for more than one service page).
 *
 * B1 (plan §6.1) wrote hero/includes/excludes/weNeed/sections/benefits/faq/cta
 * for all 14 pages, rewriting the legacy scan copy in "usted" per the copy
 * brief in prompts/sonnet-1-services.md. Every legal number, rate or deadline
 * quoted below is logged in docs/facts-to-verify.md.
 */

declare(strict_types=1);

return [

    // === Soluciones digitales de cumplimiento ===============================

    'ekuatia' => [
        'path'            => '/ekuatia/',
        'title'           => 'Ekuatia',
        'navLabel'        => 'Ekuatia',
        'cluster'         => 'digital',
        'parent'          => null,
        'seoTitle'        => "Ekuatia'i y factura electrónica",
        'metaDescription' => 'Habilitación en SIFEN y puesta en marcha de la factura electrónica con '
                           . "Ekuatia'i, para que emita comprobantes válidos desde el primer día.",
        'hero'            => [
            'eyebrow' => '',
            'h1'      => "Ekuatia'i: facturación electrónica en Paraguay (SIFEN)",
            'h2'      => 'Cuando la DNIT lo designa emisor electrónico obligatorio, sus facturas en '
                       . 'papel pierden validez legal apenas se cumple el plazo de transición.',
            'lead'    => 'Lo habilitamos en SIFEN, elegimos con usted entre Ekuatia y Ekuatia\'i según '
                       . 'su operación, y dejamos su primer comprobante electrónico emitido.',
        ],
        'includes' => [
            'Habilitación como emisor electrónico ante la DNIT (SIFEN)',
            'Elección entre Ekuatia\'i o integración Ekuatia según su volumen',
            'Gestión de la firma digital para validar sus comprobantes',
            'Capacitación a su equipo en la emisión y recepción de documentos',
            'Migración desde talonarios preimpresos, sin cortar la facturación',
        ],
        'excludes' => [
            'No desarrollamos software de facturación a medida',
            'No administramos su sistema de ventas o punto de venta',
            'No incluye la inscripción de RUC si todavía no lo tiene (ver RUC)',
        ],
        'weNeed' => [
            'RUC y cédula de identidad vigente',
            'Datos de sus establecimientos y puntos de expedición',
            'Definición de si factura desde un solo punto o necesita integración con software',
        ],
        'sections' => [
            [
                'h2'   => "Ekuatia y Ekuatia'i no son lo mismo",
                'body' => [
                    'Ekuatia es el nombre general del sistema de facturación electrónica que la DNIT '
                        . 'valida dentro de SIFEN. Ekuatia\'i es la herramienta gratuita de la DNIT para '
                        . 'emitir comprobantes uno por uno desde el navegador: sirve mientras factura '
                        . 'desde un único establecimiento y un único punto de expedición.',
                    'Cuando su operación crece —más de un punto de venta, integración con su sistema de '
                        . 'gestión— el camino es Ekuatia con un desarrollo propio o un software homologado '
                        . 'que se conecta a SIFEN. Le decimos en qué punto conviene pasar de uno a otro '
                        . 'antes de que la falta de historial de clientes o de productos le complique el día a día.',
                ],
            ],
            [
                'h2'   => 'Habilitación paso a paso',
                'body' => [
                    'El proceso tiene cuatro partes y las coordinamos todas para que no dependa de '
                        . 'usted ir de un trámite a otro.',
                ],
                'items' => [
                    ['title' => 'Firma digital', 'text' => 'Lo asesoramos en la obtención del certificado que valida legalmente cada comprobante.'],
                    ['title' => 'Habilitación en SIFEN', 'text' => 'Gestionamos la solicitud ante la DNIT para convertirlo en emisor electrónico.'],
                    ['title' => 'Elección de sistema', 'text' => 'Ekuatia\'i o una integración Ekuatia, según sus puntos de expedición y volumen.'],
                    ['title' => 'Capacitación', 'text' => 'Entrenamos a quien emite y recibe comprobantes en su equipo.'],
                ],
            ],
            [
                'h2'   => 'Qué es SIFEN y qué pasa si se cae el internet',
                'body' => [
                    'SIFEN es el sistema de la DNIT que recibe, valida y da constancia legal de cada '
                        . 'documento electrónico: facturas, notas de crédito y débito, autofacturas. '
                        . 'Contempla planes de contingencia, así que si se corta la conexión puede seguir '
                        . 'emitiendo y sincronizar los comprobantes apenas la recupere; nosotros dejamos '
                        . 'ese procedimiento por escrito para su equipo.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Ahorro operativo', 'text' => 'Sin timbrados que vencen ni talonarios impresos que almacenar.'],
            ['title' => 'Validez inmediata', 'text' => 'El comprobante llega a la DNIT y a su cliente en segundos.'],
            ['title' => 'Documentos que no se pierden', 'text' => 'Firmados digitalmente, respaldados y verificables en cualquier momento.'],
        ],
        'faq' => [
            ['q' => '¿Qué es SIFEN?', 'a' => 'Es el sistema con el que la DNIT recibe, valida y da constancia legal de cada documento electrónico: facturas, autofacturas, notas de crédito y débito. Toda factura electrónica en Paraguay pasa por SIFEN antes de llegar a su cliente.'],
            ['q' => "¿Cuál es la diferencia entre Ekuatia y Ekuatia'i?", 'a' => 'Ekuatia\'i es la herramienta gratuita de la DNIT para emitir uno por uno desde el navegador, con un solo establecimiento y punto de expedición. Ekuatia es el sistema general: si su operación crece, se factura mediante una integración con software propio o de terceros conectada a SIFEN.'],
            ['q' => '¿Puedo seguir usando facturas preimpresas?', 'a' => 'Una vez que la DNIT lo designa emisor electrónico obligatorio, tiene un plazo de transición para migrar. Pasado ese plazo, sus comprobantes en papel dejan de tener validez legal, así que conviene habilitarse antes de esa fecha, no después.'],
            ['q' => '¿Qué pasa si se cae el internet?', 'a' => 'El sistema SIFEN contempla planes de contingencia, así que puede seguir emitiendo sus comprobantes sin conexión y sincronizarlos con la DNIT apenas la recupere. Dejamos ese procedimiento documentado y a mano de su equipo, para que la emisión no se detenga el día que falle el internet en su local.'],
        ],
        'cta'     => ['label' => 'Habilitar mi facturación electrónica', 'whatsappText' => ''],
        'related' => ['marangatu', 'ruc', 'iva'],
        'guides'  => ['ekuatiai-paso-a-paso', 'que-es-sifen'],
        'articles' => ['como-habilitarse-en-sifen-factura-electronica-ekuatia'],
    ],

    'marangatu' => [
        'path'            => '/marangatu/',
        'title'           => 'Marangatu',
        'navLabel'        => 'Marangatu',
        'cluster'         => 'digital',
        'parent'          => null,
        'seoTitle'        => 'Marangatu: gestión ante la DNIT',
        'metaDescription' => 'Gestionamos su cuenta en el Sistema Marangatu ante la DNIT: declaraciones, '
                           . 'saneamiento de cuenta corriente y certificados al día.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Marangatu: gestión de su cuenta ante la DNIT',
            'h2'      => 'Un olvido de 24 horas en el Sistema Marangatu se traduce en multa automática, '
                       . 'bloqueo de timbrado o un RUC que pasa a estado inconsistente.',
            'lead'    => 'Presentamos sus declaraciones antes del vencimiento y depuramos su cuenta '
                       . 'corriente para que no arrastre errores de ejercicios anteriores.',
        ],
        'includes' => [
            'Monitoreo del buzón electrónico tributario',
            'Presentación de declaraciones juradas dentro del plazo',
            'Depuración de saldos y errores de cuenta corriente',
            'Actualización de RUC (domicilio, actividad, sucursales)',
            'Gestión del Certificado de Cumplimiento Tributario (CCT)',
            'Alertas preventivas antes de cada vencimiento',
        ],
        'excludes' => [
            'No presentamos una declaración sin la documentación que usted nos envía',
            'No lo representamos ante una fiscalización sin un mandato firmado (eso es Auditoría o Asesoría)',
            'No usamos su clave de acceso para nada fuera de los trámites que autorizó por escrito',
        ],
        'weNeed' => [
            'RUC y clave de acceso, o una autorización para operar en su nombre',
            'Comprobantes de compras y ventas del período',
            'Cualquier notificación que reciba de la DNIT, apenas la reciba',
        ],
        'sections' => [
            [
                'h2'   => 'Guía rápida de Marangatu',
                'body' => [
                    'Si llegó buscando cómo entrar al sistema o qué cambió con la versión nueva, esto es '
                        . 'lo que necesita saber antes de perder tiempo con la interfaz.',
                ],
                'items' => [
                    ['title' => 'Ingresar a Marangatu', 'text' => 'El acceso es con su RUC y clave a través del módulo ESET del sistema (marangatu.set.gov.py). Verifique la URL vigente en dnit.gov.py antes de ingresar sus datos.'],
                    ['title' => 'Marangatu 2.0: qué cambió', 'text' => 'La DNIT renovó la interfaz del sistema; los trámites son los mismos, pero varios accesos y pantallas se reorganizaron. Si algo que antes encontraba ya no está donde recuerda, dígannos y se lo ubicamos.'],
                    ['title' => 'Recuperar su clave de acceso', 'text' => 'Se solicita el cambio por olvido desde el propio sistema, con un enlace que la DNIT envía al correo declarado. Si ese correo ya no es el suyo, primero hay que actualizarlo.'],
                    ['title' => 'Consulta de RUC', 'text' => 'Cualquiera puede verificar el estado de un RUC (activo, inconsistente, cancelado) desde la consulta pública del sistema, sin necesidad de clave.'],
                ],
            ],
            [
                'h2'   => 'Certificado de Cumplimiento Tributario',
                'body' => [
                    'El CCT es la constancia de que está al día con sus obligaciones y lo piden bancos, '
                        . 'licitaciones y muchos proveedores antes de cerrar una operación. Se bloquea '
                        . 'apenas hay una declaración vencida sin presentar o una multa firme sin pagar, '
                        . 'así que lo gestionamos como parte del seguimiento mensual, no como un trámite aparte.',
                ],
            ],
            [
                'h2'   => 'RUC "inconsistente": qué significa',
                'body' => [
                    'Significa que hay una diferencia entre lo que usted declaró y lo que el sistema '
                        . 'registra como pagado o informado por terceros. Mientras esté en ese estado, no '
                        . 'puede emitir comprobantes con normalidad. Revisamos sus declaraciones anteriores '
                        . 'para encontrar el origen del error y corregirlo.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Menos multas', 'text' => 'Procesamos su información antes del vencimiento, no el mismo día.'],
            ['title' => 'Cuenta corriente depurada', 'text' => 'Corregimos saldos y créditos fiscales mal aplicados de ejercicios anteriores.'],
            ['title' => 'Reporte mensual', 'text' => 'Ve su situación real cada mes, no se entera por una notificación sorpresa.'],
        ],
        'faq' => [
            ['q' => '¿Cómo sé si tengo multas pendientes de la DNIT?', 'a' => 'Como parte de nuestro servicio mensual le enviamos un reporte de su situación real en Marangatu. Si prefiere confirmarlo usted mismo, la consulta de RUC y el estado de cuenta del sistema muestran las obligaciones vencidas sin necesidad de esperar una notificación.'],
            ['q' => '¿Qué significa tener el RUC en estado "inconsistente"?', 'a' => 'Significa que hay una diferencia entre lo que usted declaró y lo que Marangatu registra como pagado o informado por terceros, y eso bloquea la emisión normal de comprobantes hasta que se resuelva. Auditamos sus declaraciones anteriores, encontramos el origen del error y lo corregimos ante la DNIT.'],
            ['q' => '¿Es seguro delegar mi clave de acceso a un estudio contable?', 'a' => 'Es una práctica habitual, pero requiere confianza absoluta. Manejamos las credenciales de nuestros clientes bajo protocolos estrictos de confidencialidad y ética profesional, y las usamos únicamente para los trámites que usted autorizó por escrito, nunca para gestiones fuera de ese alcance.'],
            ['q' => '¿Qué cambió con Marangatu 2.0?', 'a' => 'La DNIT renovó la interfaz del sistema y reorganizó varios accesos y pantallas, aunque los trámites de fondo —declaraciones, cuenta corriente, certificados— siguen siendo los mismos. Si busca algo que antes encontraba fácilmente y ya no aparece donde recuerda, coméntenos y se lo ubicamos de inmediato.'],
        ],
        'cta'     => ['label' => 'Ordenar mi cuenta en Marangatu', 'whatsappText' => ''],
        'toolLinks' => [
            ['path' => '/herramientas/vencimientos/', 'label' => 'Calendario de vencimientos', 'text' => 'Ingrese la terminación de su RUC y vea la fecha de este mes y el próximo para IVA, IRE e IPS.'],
        ],
        'related' => ['iva', 'ire-simple', 'ekuatia'],
        'guides'  => ['como-ingresar-a-marangatu', 'certificado-de-cumplimiento-tributario'],
        'articles' => ['marangatu-2-0-que-cambio', 'certificado-de-cumplimiento-tributario-marangatu'],
    ],

    'ruc' => [
        'path'            => '/ruc/',
        'title'           => 'RUC',
        'navLabel'        => 'RUC',
        'cluster'         => 'digital',
        'parent'          => null,
        'seoTitle'        => 'Inscripción de RUC en Paraguay',
        'metaDescription' => 'Inscripción de RUC en Paraguay para empresas y profesionales independientes: '
                           . 'documentación, alta ante la DNIT y actualización de datos.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Inscripción de RUC en Paraguay',
            'h2'      => 'Un RUC inscripto con el régimen o la actividad económica equivocada le genera '
                       . 'declaraciones innecesarias, o le cierra beneficios fiscales que sí le correspondían.',
            'lead'    => 'Analizamos su actividad antes de dar el clic final y gestionamos el trámite de '
                       . 'forma digital ante la DNIT, de principio a fin.',
        ],
        'includes' => [
            'Análisis de su actividad económica y del régimen que le conviene',
            'Armado del expediente y carga en el sistema de la DNIT',
            'Seguimiento diario hasta la aprobación',
            'Gestión de clave de acceso y firma digital',
            'Habilitación en Ekuatia\'i cuando corresponde',
        ],
        'excludes' => [
            'No tramitamos RUC sin una cédula de identidad vigente',
            'No incluye habilitaciones sectoriales previas que su actividad pueda requerir (salud, alimentos, etc.)',
            'No incluye la constitución de una EAS o sociedad (ver EAS)',
        ],
        'weNeed' => [
            'Cédula de identidad vigente',
            'Una factura de servicio para acreditar el domicilio fiscal',
            'Para empresas: estatutos sociales y acta de designación de autoridades',
        ],
        'sections' => [
            [
                'h2'   => 'Cómo inscribirse al RUC',
                'body' => [
                    'El trámite se presenta ante la DNIT con la documentación en regla: cédula vigente y '
                        . 'comprobante de domicilio para personas físicas; estatutos y acta de designación '
                        . 'de autoridades cuando es una sociedad. Antes de cargarlo, definimos con usted la '
                        . 'actividad económica y el régimen impositivo, porque esa elección define su carga '
                        . 'administrativa de los próximos años.',
                ],
            ],
            [
                'h2'   => 'Qué régimen le conviene: IVA, IRE General o Simple',
                'body' => [
                    'Todo RUC activo tributa IVA sobre sus ventas y algún régimen de renta: IRE General, '
                        . 'IRE Simple o Resimple según su facturación proyectada. Elegir mal en el alta '
                        . 'puede obligarlo a declaraciones que no necesitaba, o dejarlo fuera de un régimen '
                        . 'más simple al que sí calificaba. Vea el detalle en IVA e IRE Simple.',
                ],
            ],
            [
                'h2'   => 'RUC activo, presentaciones en cero',
                'body' => [
                    'Tener RUC activo obliga a presentar declaraciones juradas aunque no haya movimiento: '
                        . 'se presentan "en cero" o informativas. Las dejamos automatizadas dentro de su '
                        . 'plan mensual para que su historial nunca se manche por una presentación olvidada.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Régimen correcto desde el día uno', 'text' => 'Evaluamos IRE Resimple, Simple o General según su facturación proyectada.'],
            ['title' => 'Trámite 100% remoto', 'text' => 'Coordinamos la verificación de documentos sin que tenga que hacer fila.'],
            ['title' => 'Seguimiento diario', 'text' => 'Ante cualquier observación de la DNIT, intervenimos de inmediato.'],
        ],
        'faq' => [
            ['q' => '¿Cuánto tiempo tarda el proceso de inscripción?', 'a' => 'Con la documentación completa y en regla, la DNIT suele aprobar el RUC en un plazo de 24 a 72 horas hábiles. Hacemos seguimiento diario del expediente desde que lo presentamos, para que no queden pausas innecesarias en el proceso ni demoras evitables.'],
            ['q' => '¿Qué documentos necesito para empezar?', 'a' => 'Para personas físicas, cédula de identidad vigente y una factura de servicios para validar el domicilio fiscal declarado. Para empresas, sumamos los estatutos sociales y el acta de designación de autoridades. Revisamos que todo esté en regla antes de presentar el expediente ante la DNIT.'],
            ['q' => '¿Tener RUC me obliga a declarar aunque no venda nada?', 'a' => 'Sí. Un RUC activo obliga a presentar sus declaraciones juradas incluso sin movimiento, en cuyo caso se presentan en cero. Automatizamos esas presentaciones dentro de su plan mensual, para que su historial ante la DNIT nunca caiga en mora por falta de una declaración.'],
            ['q' => '¿Qué régimen me conviene?', 'a' => 'Depende de su facturación proyectada y de su actividad: Resimple, IRE Simple o IRE General cambian tanto el impuesto que paga como la carga administrativa mensual que asume. Lo evaluamos con usted antes de inscribirlo, no después de que ya eligió el régimen equivocado.'],
        ],
        'cta'     => ['label' => 'Inscribir mi RUC', 'whatsappText' => ''],
        'related' => ['eas', 'marangatu', 'ekuatia'],
        'guides'  => ['inscripcion-de-ruc-paso-a-paso', 'consulta-de-ruc'],
        'articles' => ['marangatu-2-0-que-cambio'],
    ],

    // === Gestión empresarial ================================================

    'contabilidad' => [
        'path'            => '/contabilidad/',
        'title'           => 'Contabilidad mensual',
        'navLabel'        => 'Contabilidad mensual',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'Contabilidad mensual para empresas',
        'metaDescription' => 'Contabilidad mensual para empresas en Paraguay: libros, conciliaciones y '
                           . 'estados financieros, con cierre antes del día 5 de cada mes.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Contabilidad mensual para empresas en Paraguay',
            'h2'      => 'Un balance que se arma recién en marzo no sirve para decidir en enero: para '
                       . 'entonces ya tomó esas decisiones sin los números.',
            'lead'    => 'Llevamos sus libros al día durante el mes y le entregamos el cierre y un '
                       . 'informe antes del día 5.',
        ],
        'includes' => [
            'Registro contable mensual (libro diario y mayor)',
            'Conciliaciones bancarias',
            'Balance general y estado de resultados cada mes',
            'Flujo de efectivo mensual',
            'Informe ejecutivo con lectura simple de sus números',
            'Coordinación con la liquidación de IVA e IRE',
        ],
        'excludes' => [
            'No incluye la liquidación de sueldos e IPS (ver IPS)',
            'No incluye la auditoría externa obligatoria si su facturación la exige (ver Auditoría)',
            'No cobramos ni pagamos en su nombre, solo registramos sus movimientos',
        ],
        'weNeed' => [
            'Comprobantes de compras y ventas del mes',
            'Extractos bancarios',
            'Planilla de sueldos, si tiene empleados',
            'Acceso de solo lectura o copia de su sistema de facturación',
        ],
        'sections' => [
            [
                'h2'   => 'Balance general y estado de resultados',
                'body' => [
                    'El balance general muestra qué tiene y qué debe su empresa en una fecha puntual: '
                        . 'activos, pasivos y patrimonio. El estado de resultados muestra si esa operación '
                        . 'dio ganancia o pérdida durante el mes. Se los entregamos juntos, porque uno sin '
                        . 'el otro solo cuenta la mitad de la historia.',
                ],
            ],
            [
                'h2'   => 'Flujo de efectivo: para qué sirve mes a mes',
                'body' => [
                    'Una empresa puede mostrar ganancia en el estado de resultados y quedarse sin efectivo '
                        . 'el mismo mes, si sus cobros llegan más lento que sus pagos. El flujo de efectivo '
                        . 'es lo que le avisa eso antes de que sea un problema de caja, no después.',
                ],
            ],
            [
                'h2'   => 'Cierre antes del día 5',
                'body' => [
                    'Recibimos su documentación durante el mes, no toda junta al final. Eso nos permite '
                        . 'cerrar y entregarle el informe antes del día 5 del mes siguiente, a tiempo para '
                        . 'que sus liquidaciones de IVA e IRE salgan de números ya conciliados.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Cierre antes del día 5', 'text' => 'Recibe sus estados financieros a tiempo para decidir con el mes fresco.'],
            ['title' => 'Números que puede leer', 'text' => 'Informe ejecutivo en lenguaje simple, no solo planillas contables.'],
            ['title' => 'Base ordenada para sus impuestos', 'text' => 'Sus libros conciliados alimentan directamente el IVA, el IRE y el IRP.'],
        ],
        'faq' => [
            ['q' => '¿Qué es el balance general?', 'a' => 'Es la fotografía de su empresa en una fecha puntual: qué activos tiene, qué debe (pasivos) y qué les queda a los dueños (patrimonio). Se lo entregamos cada mes, no solo al cierre del ejercicio, para que pueda decidir con información actualizada y no con datos de hace un año.'],
            ['q' => '¿Qué es el estado de resultados?', 'a' => 'Muestra si su operación dio ganancia o pérdida durante el período, restando los costos y gastos de sus ingresos del mes. Junto con el balance general, forma la base de cualquier decisión financiera seria sobre su empresa, desde un préstamo hasta una nueva inversión.'],
            ['q' => '¿Para qué sirve el flujo de efectivo?', 'a' => 'Le muestra cuándo entra y cuándo sale el dinero, no solo cuánto gana en el papel. Una empresa rentable puede quedarse sin caja si sus cobros tardan más que sus pagos; el flujo de efectivo se lo anticipa.'],
            ['q' => '¿Puedo cambiarme de contador a mitad de año?', 'a' => 'Sí, y es más simple de lo que parece. Solicitamos sus libros y declaraciones presentadas hasta la fecha, verificamos que estén al día ante la DNIT y continuamos desde ahí, sin reiniciar el ejercicio ni perder historial ni presentaciones ya realizadas por su contador anterior.'],
        ],
        'cta'     => ['label' => 'Ordenar mi contabilidad mensual', 'whatsappText' => ''],
        'related' => ['iva', 'ire-simple', 'asesoria'],
        'guides'   => ['formulario-120-paso-a-paso'],
        'articles' => ['balance-general-estado-de-resultados-flujo-de-efectivo'],
    ],

    'iva' => [
        'path'            => '/iva/',
        'title'           => 'IVA',
        'navLabel'        => 'IVA',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'Liquidación y declaración de IVA',
        'metaDescription' => 'Liquidación mensual de IVA y presentación de la declaración jurada ante la '
                           . 'DNIT, con el libro de compras y ventas siempre conciliado.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'IVA: liquidación y declaración jurada mensual',
            'h2'      => 'Presentar el Formulario 120 fuera del plazo que le corresponde según la '
                       . 'terminación de su RUC genera multa automática, aunque la declaración esté en cero.',
            'lead'    => 'Conciliamos su libro de compras y ventas y presentamos su declaración dentro '
                       . 'del plazo, todos los meses.',
        ],
        'includes' => [
            'Recepción digital de sus comprobantes de compra y venta',
            'Conciliación del libro de compras y ventas',
            'Clasificación de gastos deducibles según la ley',
            'Presentación del Formulario 120',
            'Declaración en cero cuando no hubo movimiento',
            'Reporte mensual de crédito y débito fiscal',
        ],
        'excludes' => [
            'No incluye la liquidación de IRE (ver IRE Simple o IRP)',
            'No aprobamos como deducible un gasto sin factura legal a su nombre y RUC',
            'No cargamos comprobantes que lleguen después del día 5 en la liquidación de ese mes',
        ],
        'weNeed' => [
            'Fotos o archivos digitales legibles de sus facturas de compra y venta, antes del día 5',
            'Aclaración de gastos mixtos (personales y del negocio)',
        ],
        'sections' => [
            [
                'h2'   => 'Declaración jurada de IVA (Formulario 120)',
                'body' => [
                    'El Formulario 120 es donde se liquida y presenta el IVA mensual ante la DNIT, con el '
                        . 'crédito fiscal de sus compras contra el débito fiscal de sus ventas. El '
                        . 'vencimiento depende de la terminación de su RUC, así que el calendario cambia '
                        . 'de contribuyente a contribuyente; se lo confirmamos como parte del servicio, mes a mes.',
                ],
            ],
            [
                'h2'   => 'IVA general del 10% y el reducido del 5%',
                'body' => [
                    'La mayoría de los bienes y servicios pagan el 10%; algunos rubros —como ciertos '
                        . 'productos de la canasta básica y arrendamientos— tienen la tasa reducida del '
                        . '5%. Clasificar bien cada comprobante según su tasa es lo que evita que pague de '
                        . 'más o declare de menos crédito fiscal del que le corresponde.',
                ],
            ],
            [
                'h2'   => 'Si no vendió nada, igual debe declarar',
                'body' => [
                    'La obligación de presentar el Formulario 120 no depende de haber facturado. Sin '
                        . 'movimiento, se presenta como declaración informativa en cero; nos encargamos de '
                        . 'esto automáticamente para que su historial ante la DNIT no se manche por una '
                        . 'presentación olvidada.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Crédito fiscal bien aplicado', 'text' => 'Clasificamos sus gastos según la ley, sin dejar crédito sobre la mesa.'],
            ['title' => 'Cero declaraciones en mora', 'text' => 'Incluso en los meses sin ventas, la declaración en cero sale a tiempo.'],
            ['title' => 'Reporte mensual claro', 'text' => 'Vea sus ingresos y egresos del mes en un resumen, no en una planilla cruda.'],
        ],
        'faq' => [
            ['q' => '¿Hasta qué fecha tengo tiempo de enviar mis facturas?', 'a' => 'Solicitamos su documentación hasta el día 5 de cada mes, para tener margen de revisión y conciliación antes del vencimiento que le corresponde según la terminación de su RUC. Enviarlas antes de esa fecha evita apuros de último momento.'],
            ['q' => '¿Qué pasa si un mes no tuve ventas?', 'a' => 'Igual existe la obligación de presentar la declaración jurada en cero o informativa ante la DNIT. Nos encargamos de esto automáticamente todos los meses, para que su historial de cumplimiento no se manche por una presentación olvidada.'],
            ['q' => '¿Puedo deducir gastos personales en mi IVA?', 'a' => 'No: la ley exige que el gasto esté directamente relacionado con la generación de su renta para poder deducirlo del IVA. Le indicamos con precisión qué rubros son aceptados para su actividad específica, así evita observaciones y ajustes de la DNIT.'],
            ['q' => '¿Cuándo vence mi IVA según mi RUC?', 'a' => 'La DNIT asigna la fecha de vencimiento mensual del Formulario 120 según la terminación numérica de su RUC, y ese calendario puede variar entre contribuyentes. Se lo confirmamos apenas empieza a trabajar con nosotros y se lo recordamos cada mes.'],
        ],
        'cta'     => ['label' => 'Poner mi IVA al día', 'whatsappText' => ''],
        'toolLinks' => [
            ['path' => '/herramientas/calculadora-iva/', 'label' => 'Calculadora de IVA', 'text' => 'Calcule el 10 % o el 5 % sobre un monto, incluido o excluido del precio, en segundos.'],
            ['path' => '/herramientas/vencimientos/', 'label' => 'Calendario de vencimientos', 'text' => 'Ingrese la terminación de su RUC y vea cuándo vence su Formulario 120 este mes.'],
        ],
        'related' => ['ire-simple', 'contabilidad', 'marangatu'],
        'guides'  => ['formulario-120-paso-a-paso'],
        'articles' => ['iva-10-y-5-que-lleva-cada-uno'],
    ],

    'ire-simple' => [
        'path'            => '/ire-simple/',
        'title'           => 'IRE-simple',
        'navLabel'        => 'IRE-simple',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'IRE Simple, Resimple y F. 120',
        'metaDescription' => 'Liquidación de IRE Simple, Resimple e IRE General con la presentación del '
                           . 'Formulario 120 en Marangatu, dentro de los plazos de la DNIT.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'IRE Simple, Resimple e IRE General: liquidación y Formulario 120',
            'h2'      => 'Superar el tope de facturación de su régimen sin darse cuenta lo saca de él, '
                       . 'con recategorización de oficio y una declaración anual que ya no aplica.',
            'lead'    => 'Revisamos en qué régimen está, liquidamos su IRE y presentamos el Formulario '
                       . '120 dentro del plazo anual.',
        ],
        'includes' => [
            'Revisión de sus libros de ventas y compras del ejercicio',
            'Verificación del régimen correcto (Resimple, Simple o General)',
            'Liquidación anual del impuesto',
            'Presentación del Formulario 120',
            'Alerta cuando su facturación se acerca al tope de su régimen',
            'Proyección del paso al Régimen General cuando corresponde',
        ],
        'excludes' => [
            'No incluye la liquidación de IVA mensual, aunque coordinamos ambas (ver IVA)',
            'No cubre el IRP de socios o del titular (ver IRP)',
            'No presentamos una declaración sin sus comprobantes de respaldo',
        ],
        'weNeed' => [
            'Libro de ventas y compras del ejercicio',
            'Comprobantes de gastos deducibles con factura y RUC',
            'Notificaciones previas de la DNIT, si las hubiera',
        ],
        'sections' => [
            [
                'h2'   => 'Resimple',
                'body' => [
                    'Es el régimen para quienes facturan hasta Gs. 80.000.000 al año: se paga una cuota '
                        . 'fija mensual según una escala, sin necesidad de llevar contabilidad completa. '
                        . 'Le conviene si su facturación es estable y baja, pero superar el tope lo saca '
                        . 'automáticamente del régimen.',
                ],
            ],
            [
                'h2'   => 'IRE Simple',
                'body' => [
                    'Para quienes facturan hasta Gs. 2.000.000.000 al año y pagan sobre su ganancia real, '
                        . 'no sobre una cuota fija. Exige llevar el libro de ventas y compras al día, '
                        . 'porque de ahí sale la base imponible que se declara en el Formulario 120.',
                ],
            ],
            [
                'h2'   => 'IRE General',
                'body' => [
                    'Es el régimen para empresas que superan el tope del IRE Simple o que llevan '
                        . 'contabilidad completa por su estructura. Requiere balance general y estado de '
                        . 'resultados formales; coordinamos esta liquidación junto con su contabilidad mensual.',
                ],
            ],
            [
                'h2'   => 'Formulario 120: cuándo y cómo se presenta',
                'body' => [
                    'Es el formulario donde se liquida y presenta el IRE anual en Marangatu, con base en '
                        . 'sus libros del ejercicio. El plazo de presentación cae en los primeros meses del '
                        . 'año siguiente al cierre; lo monitoreamos para que su presentación no dependa de '
                        . 'que usted recuerde la fecha.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Base imponible bien calculada', 'text' => 'Revisamos que no esté pagando de más por desconocer gastos deducibles.'],
            ['title' => 'Sin sorpresas de recategorización', 'text' => 'Le avisamos antes de que su facturación supere el tope de su régimen.'],
            ['title' => 'Proyección de crecimiento', 'text' => 'Si va camino al Régimen General, lo preparamos con tiempo, no de golpe.'],
        ],
        'faq' => [
            ['q' => '¿Cuál es la diferencia real entre IRE Simple y Resimple?', 'a' => 'El Resimple es para quienes facturan hasta Gs. 80.000.000 anuales y pagan una cuota fija. El IRE Simple es para quienes facturan hasta Gs. 2.000.000.000 y pagan sobre su ganancia real. Revisamos sus números para confirmar en cuál encaja mejor.'],
            ['q' => '¿Qué gastos puedo deducir en el IRE Simple?', 'a' => 'Los gastos relacionados directamente con su actividad comercial, siempre que cuenten con factura legal a su nombre y RUC. Le entregamos una guía clara de qué pedir a sus proveedores, para bajar legalmente su impuesto sin arriesgarse a un rechazo de la DNIT.'],
            ['q' => '¿Qué pasa si me olvido de presentar mi declaración anual?', 'a' => 'La DNIT aplica multas automáticas y bloquea su Certificado de Cumplimiento Tributario, lo que le impide operar con normalidad frente a bancos y proveedores. Nuestro servicio incluye alertas preventivas para que esta situación simplemente no llegue a ocurrir.'],
            ['q' => '¿Cuándo se presenta el Formulario 120 del IRE?', 'a' => 'El plazo cae dentro de los primeros meses del año siguiente al cierre de su ejercicio, y la fecha exacta depende de la terminación de su RUC. Se lo confirmamos con anticipación como parte de nuestro servicio, para que nunca dependa de que usted recuerde la fecha.'],
        ],
        'cta'     => ['label' => 'Revisar mi régimen de IRE', 'whatsappText' => ''],
        'toolLinks' => [
            ['path' => '/herramientas/vencimientos/', 'label' => 'Calendario de vencimientos', 'text' => 'Ingrese la terminación de su RUC y vea cuándo vence su IRE anual.'],
        ],
        'related' => ['iva', 'contabilidad', 'irp'],
        'guides'   => ['formulario-120-paso-a-paso'],
        'articles' => ['ire-simple-resimple-ire-general-formulario-120'],
    ],

    'irp' => [
        'path'            => '/irp/',
        'title'           => 'IRP — Impuesto a la Renta Personal',
        'navLabel'        => 'IRP',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'IRP: Impuesto a la Renta Personal',
        'metaDescription' => 'IRP en Paraguay: definimos si le corresponde inscribirse, qué puede deducir '
                           . 'y presentamos su liquidación anual ante la DNIT.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'IRP: Impuesto a la Renta Personal en Paraguay',
            'h2'      => 'Muchos profesionales independientes no saben si les corresponde inscribirse al '
                       . 'IRP hasta que la DNIT se los notifica.',
            'lead'    => 'Le decimos si le corresponde, qué puede deducir, y presentamos su liquidación anual.',
        ],
        'includes' => [
            'Diagnóstico de si le corresponde inscribirse al IRP',
            'Armado del expediente de deducciones (facturas personales)',
            'Liquidación y presentación de la declaración anual',
            'Seguimiento del plazo de presentación',
        ],
        'excludes' => [
            'No reemplaza la liquidación de IRE de su empresa (ver IRE Simple)',
            'No incluye la contabilidad mensual de un negocio (ver Contabilidad mensual)',
            'No presentamos su declaración sin las facturas de sus gastos deducibles',
        ],
        'weNeed' => [
            'Comprobantes de sus ingresos del ejercicio',
            'Facturas de gastos personales deducibles que la ley permita',
            'Su RUC, si ya lo tiene',
        ],
        'sections' => [
            [
                'h2'   => '¿Quién debe inscribirse al IRP?',
                'body' => [
                    'El IRP alcanza a las personas físicas cuyos ingresos superan los tramos que fija la '
                        . 'ley: sueldos, honorarios profesionales, alquileres y otras rentas personales. '
                        . 'Si su actividad combina relación de dependencia con trabajo independiente, la '
                        . 'evaluación se hace sobre el total de sus ingresos, no solo sobre uno de ellos.',
                ],
            ],
            [
                'h2'   => 'Deducciones y gastos que reducen su base imponible',
                'body' => [
                    'La ley permite descontar determinados gastos personales de su base imponible, '
                        . 'siempre con factura legal a su nombre. Armamos ese expediente con usted durante '
                        . 'el año, no en marzo con las facturas ya perdidas.',
                ],
            ],
            [
                'h2'   => 'Presentación anual: plazo y Formulario',
                'body' => [
                    'La declaración del IRP se presenta una vez al año en Marangatu, con el detalle de sus '
                        . 'ingresos y deducciones del ejercicio. Consulte el monto vigente de los tramos y '
                        . 'tasas antes de estimar su impuesto: cambian con la reglamentación y preferimos '
                        . 'confirmarlo caso por caso a arriesgar una cifra desactualizada.',
                ],
            ],
            [
                'h2'   => 'Servicio de liquidación: qué hacemos por usted',
                'body' => [
                    'Reunimos sus ingresos y sus comprobantes deducibles, calculamos su base imponible y '
                        . 'presentamos la declaración dentro del plazo. Si todavía no tiene RUC como '
                        . 'persona física, lo inscribimos primero (ver RUC).',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Certeza sobre si le corresponde', 'text' => 'Se lo confirmamos con un diagnóstico, no con una suposición.'],
            ['title' => 'Deducciones bien aprovechadas', 'text' => 'Armamos su expediente de gastos durante el año, no en el último momento.'],
            ['title' => 'Presentación dentro del plazo', 'text' => 'Su declaración anual sale a tiempo, sin depender de que usted recuerde la fecha.'],
        ],
        'faq' => [
            ['q' => '¿Quiénes deben inscribirse al IRP?', 'a' => 'Las personas físicas cuyos ingresos —sueldos, honorarios profesionales, alquileres u otras rentas personales— superan los tramos que fija la ley. Si combina relación de dependencia con trabajo independiente, revisamos el total de sus ingresos del ejercicio y se lo confirmamos con precisión.'],
            ['q' => '¿Qué puedo deducir en el IRP?', 'a' => 'Determinados gastos personales con factura legal a su nombre, dentro de los límites que fija la reglamentación vigente. Le indicamos con anticipación qué comprobantes juntar durante el año, para que la deducción sea válida cuando llegue el momento de presentar la declaración.'],
            ['q' => '¿Cuándo se presenta la declaración anual del IRP?', 'a' => 'Se presenta una vez al año en Marangatu, con el detalle de sus ingresos y deducciones del ejercicio completo. El plazo exacto se confirma según el calendario vigente que publica la DNIT cada año, y se lo recordamos con anticipación.'],
            ['q' => '¿Qué pasa si tengo IRP y también soy dueño de una empresa?', 'a' => 'Son dos obligaciones separadas: el IRP grava sus ingresos personales y el IRE grava la renta de su empresa como persona jurídica o unipersonal. Coordinamos ambas liquidaciones para que no haya inconsistencias entre lo que declara como persona y lo que declara su empresa.'],
        ],
        'cta'     => ['label' => 'Consultar si debo presentar IRP', 'whatsappText' => ''],
        'related' => ['ire-simple', 'asesoria', 'ruc'],
        'guides'  => ['irp-quien-debe-pagar'],
        'articles' => ['irp-2026-quien-paga-y-como-se-liquida'],
    ],

    'ips' => [
        'path'            => '/ips/',
        'title'           => 'IPS',
        'navLabel'        => 'IPS',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'IPS y planilla de sueldos',
        'metaDescription' => 'Gestión de IPS y planilla de sueldos: altas y bajas, aportes mensuales, '
                           . 'planillas del MTESS y recibos listos para firmar.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'IPS: gestión de aportes y planilla de sueldos',
            'h2'      => 'Una comunicación de alta que llega tarde a IPS, o un aporte patronal vencido, '
                       . 'genera intereses moratorios y puede dejar a su empleado sin cobertura médica.',
            'lead'    => 'Gestionamos las altas y bajas, calculamos el aporte obrero del 9% y el '
                       . 'patronal del 16,5%, y presentamos sus planillas al MTESS.',
        ],
        'includes' => [
            'Alta y baja de empleados en IPS',
            'Cálculo del aporte obrero (9%) y patronal (16,5%)',
            'Liquidación de sueldos, aguinaldo y vacaciones',
            'Planillas anuales ante el MTESS',
            'Recibos de sueldo listos para firmar',
        ],
        'excludes' => [
            'No incluye la redacción de contratos laborales complejos (derivamos a asesoría legal)',
            'No gestionamos juicios laborales',
            'No sustituye la liquidación de un finiquito por despido, que requiere revisión caso por caso',
        ],
        'weNeed' => [
            'Listado de empleados con datos de alta o baja',
            'Salarios y novedades del mes (horas extra, licencias)',
            'Cédula de los nuevos ingresos',
        ],
        'sections' => [
            [
                'h2'   => 'Aporte obrero y patronal',
                'body' => [
                    'Todo empleado en relación de dependencia aporta el 9% de su salario a IPS; la '
                        . 'empresa aporta el 16,5% adicional como aporte patronal. Ambos se calculan y '
                        . 'presentan juntos cada mes, y se lo mostramos como una línea separada en el '
                        . 'recibo de sueldo, no como un descuento genérico.',
                ],
            ],
            [
                'h2'   => 'Alta y baja de empleados: plazos ante IPS',
                'body' => [
                    'El alta debe comunicarse antes de que el empleado inicie funciones, para que la '
                        . 'cobertura patronal esté vigente desde el primer día. Una demora en esa '
                        . 'comunicación deja al empleado sin respaldo si ocurre un accidente o una consulta '
                        . 'médica en ese período.',
                ],
            ],
            [
                'h2'   => 'Planilla anual ante el MTESS',
                'body' => [
                    'Toda empresa con empleados debe presentar la planilla anual (Resumen General) ante el '
                        . 'Ministerio de Trabajo dentro de los primeros meses del año. Consolidamos su '
                        . 'información y hacemos la presentación digital por usted.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Cero atrasos patronales', 'text' => 'El aporte del 16,5% se presenta dentro de plazo, sin intereses moratorios.'],
            ['title' => 'Recibos exactos', 'text' => 'Retenciones y bonificaciones calculadas sin errores que generen reclamos.'],
            ['title' => 'Legajos digitales', 'text' => 'Disponibles para una inspección del MTESS o un trámite bancario, sin buscar papeles.'],
        ],
        'faq' => [
            ['q' => '¿Cuál es el plazo para dar de alta a un empleado en IPS?', 'a' => 'La comunicación debe hacerse antes de que el empleado inicie funciones, para que su cobertura patronal esté activa desde el primer día de trabajo. Gestionamos esta alta de forma digital y ágil, sin dejar ese trámite librado al último momento.'],
            ['q' => '¿Qué pasa si me atraso en el aporte obrero-patronal?', 'a' => 'IPS genera intereses moratorios diarios sobre el monto adeudado, y sus empleados pueden perder temporalmente el acceso a ciertos beneficios médicos y subsidios. Nuestro sistema de alertas le avisa con anticipación, para que ese atraso simplemente no llegue a producirse.'],
            ['q' => '¿Es obligatorio presentar planillas anuales al MTESS?', 'a' => 'Sí, toda empresa con empleados debe presentar la planilla anual (Resumen General) dentro de los primeros meses del año ante el Ministerio de Trabajo. Consolidamos su información y hacemos esa presentación digital obligatoria en su nombre, dentro del plazo.'],
            ['q' => '¿Cuánto aporta el empleado y cuánto la empresa?', 'a' => 'El empleado aporta el 9% de su salario bruto y la empresa suma un 16,5% adicional como aporte patronal, sobre la misma base salarial. Ambos montos se calculan y presentan juntos cada mes ante IPS, y se lo mostramos como una línea separada y clara en cada recibo de sueldo.'],
        ],
        'cta'     => ['label' => 'Poner mi nómina al día', 'whatsappText' => ''],
        'toolLinks' => [
            ['path' => '/herramientas/calculadora-aguinaldo/', 'label' => 'Calculadora de aguinaldo', 'text' => 'Calcule el aguinaldo de un empleado, completo o proporcional, en guaraníes.'],
            ['path' => '/herramientas/liquidacion-de-salario/', 'label' => 'Calculadora de liquidación de salario', 'text' => 'Estime un finiquito por renuncia o despido, con el aporte del 9 % al IPS como línea aparte.'],
        ],
        'related' => ['contabilidad', 'asesoria', 'eas'],
        'guides'  => ['inscripcion-patronal-ips'],
        'articles' => ['como-se-calcula-el-aguinaldo-en-paraguay', 'aguinaldo-cuando-se-cobra-y-proporcional', 'liquidacion-por-despido-vs-renuncia', 'inscripcion-patronal-ips-paso-a-paso'],
    ],

    'eas' => [
        'path'            => '/eas/',
        'title'           => 'EAS',
        'navLabel'        => 'EAS',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'Abrir una EAS en Paraguay',
        'metaDescription' => 'Abrir una EAS en Paraguay con acompañamiento completo: constitución, RUC, '
                           . 'patente y registro patronal, operativa en semanas y no en meses.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Abrir una EAS en Paraguay',
            'h2'      => 'Una EAS con estatutos genéricos o capital mal declarado le complica abrir una '
                       . 'cuenta bancaria o presentarse a una licitación el día que más lo necesita.',
            'lead'    => 'Gestionamos todo el trámite digital ante el SUACE, con estatutos redactados a '
                       . 'la medida de su operación.',
        ],
        'includes' => [
            'Redacción de estatutos a medida de su operación',
            'Reserva de nombre y trámite completo en el SUACE',
            'Obtención de RUC',
            'Registro patronal en IPS',
            'Timbrado y habilitación inicial',
        ],
        'excludes' => [
            'No incluye la contabilidad mensual posterior a la apertura (ver Contabilidad mensual)',
            'No cubre la transformación de una EAS ya existente hacia otra figura societaria',
            'No gestionamos su capital ni su cuenta bancaria, solo la documentación que el banco le pedirá',
        ],
        'weNeed' => [
            'Cédula de identidad vigente',
            'Descripción de su actividad económica',
            'Definición de capital y de los socios, si hay más de uno',
        ],
        'sections' => [
            [
                'h2'   => 'Constitución por SUACE: qué es y cómo funciona',
                'body' => [
                    'El SUACE es el sistema unificado que centraliza la apertura de empresas en Paraguay: '
                        . 'reserva de nombre, estatutos, RUC y registro patronal en un solo trámite digital, '
                        . 'sin necesidad de escritura notarial para la EAS. Cargamos y seguimos cada paso '
                        . 'del expediente hasta la aprobación.',
                ],
            ],
            [
                'h2'   => 'EAS unipersonal: puede ser el único dueño',
                'body' => [
                    'La Empresa por Acciones Simplificada admite un solo socio: usted puede constituirse '
                        . 'como único dueño con la estructura de una sociedad —patrimonio separado del '
                        . 'personal— sin necesidad de sumar un socio solo para cumplir un requisito formal.',
                ],
            ],
            [
                'h2'   => 'De la reserva del nombre al RUC',
                'body' => [
                    'El proceso empieza con la reserva del nombre en el SUACE, sigue con la carga de '
                        . 'estatutos y termina con la obtención del RUC y el registro patronal en IPS. Le '
                        . 'entregamos todo listo: RUC, timbrado y los registros que el banco le va a pedir '
                        . 'en su primera reunión.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Socio único, estructura de sociedad', 'text' => 'Puede ser el único dueño y aun así separar su patrimonio personal del de la empresa.'],
            ['title' => 'Trámite 100% digital', 'text' => 'Sin protocolos notariales extensos ni publicaciones en diarios físicos.'],
            ['title' => 'Lista para el banco', 'text' => 'Entregamos los registros que necesita para abrir cuenta y presentarse a licitaciones.'],
        ],
        'faq' => [
            ['q' => '¿Necesito un capital mínimo para abrir una EAS?', 'a' => 'No existe un capital mínimo obligatorio por ley para constituir una EAS. Puede definir el capital que realmente requiere su operativa inicial, lo que la hace una figura práctica para independientes, startups y proyectos que recién están arrancando.'],
            ['q' => '¿Puedo transformar mi Unipersonal actual en una EAS?', 'a' => 'Sí. Es un paso habitual para separar sus finanzas personales de las del negocio y mejorar su perfil ante bancos e inversores. Gestionamos toda la transición, desde la baja de la Unipersonal hasta el alta de la nueva estructura.'],
            ['q' => '¿Qué documentos necesito para empezar hoy?', 'a' => 'Solo su cédula de identidad vigente y una descripción básica de su actividad comercial. El resto del proceso —reserva del nombre, redacción de estatutos, obtención del RUC— lo llevamos nosotros de forma remota, sin que tenga que presentarse en ninguna oficina.'],
            ['q' => '¿Cuánto tarda la apertura de una EAS?', 'a' => 'Al ser un trámite digital por el SUACE, se resuelve en semanas y no en meses como los modelos societarios tradicionales. El plazo exacto depende de la carga del sistema y de que la documentación llegue completa desde el inicio.'],
        ],
        'cta'     => ['label' => 'Iniciar mi apertura', 'whatsappText' => ''],
        'toolLinks' => [
            ['path' => '/herramientas/comparador-eas-srl-unipersonal/', 'label' => 'Comparador EAS / SRL / Unipersonal', 'text' => 'Compare las tres estructuras y responda tres preguntas para saber cuál le conviene.'],
        ],
        'related' => ['ruc', 'ekuatia', 'contabilidad'],
        'guides'   => ['inscripcion-de-ruc-paso-a-paso'],
        'articles' => ['abrir-una-eas-en-paraguay', 'eas-vs-srl-vs-unipersonal-cual-conviene'],
    ],

    'asesoria' => [
        'path'            => '/asesoria/',
        'title'           => 'Asesoría',
        'navLabel'        => 'Asesoría',
        'cluster'         => 'gestion',
        'parent'          => null,
        'seoTitle'        => 'Asesoría tributaria y planificación',
        'metaDescription' => 'Asesoría tributaria y planificación fiscal para empresas paraguayas: '
                           . 'revisamos su carga impositiva y prevenimos contingencias con la DNIT.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Asesoría tributaria y planificación fiscal',
            'h2'      => 'Operar sin revisar antes su carga tributaria suele significar pagar de más, o '
                       . 'descubrir un riesgo recién cuando llega una fiscalización.',
            'lead'    => 'Revisamos su estructura fiscal y anticipamos decisiones antes de que la DNIT '
                       . 'las convierta en un problema.',
        ],
        'includes' => [
            'Diagnóstico de su carga tributaria actual',
            'Evaluación de régimen (IRE Simple, General o Resimple)',
            'Proyección del impacto fiscal de decisiones de inversión',
            'Asesoría para inversión extranjera (remesas, maquila)',
            'Acompañamiento ante consultas puntuales a la DNIT',
        ],
        'excludes' => [
            'No reemplaza la contabilidad mensual ni la liquidación de impuestos (son servicios aparte)',
            'No incluye representación legal en juicios',
            'No diseñamos estructuras para ocultar ingresos, solo planificación dentro de la ley',
        ],
        'weNeed' => [
            'Sus últimos estados financieros o declaraciones presentadas',
            'Una descripción de la decisión que está evaluando',
            'Plazos, si hay una fecha límite involucrada',
        ],
        'sections' => [
            [
                'h2'   => 'Planificación fiscal según la Ley 6380/19',
                'body' => [
                    'La reforma tributaria (Ley 6380/2019) y sus reglamentaciones definen el marco actual '
                        . 'de IVA e IRE. Evaluamos su modelo de negocio dentro de ese marco —distribución de '
                        . 'utilidades, estructura de costos— para que use las herramientas legales '
                        . 'disponibles, no para evadir nada.',
                ],
            ],
            [
                'h2'   => 'Decisiones que conviene revisar antes de tomarlas',
                'body' => [
                    '¿Le conviene comprar un activo fijo ahora o el próximo ejercicio? ¿Es momento de abrir '
                        . 'una sucursal o cambiar de régimen? Le entregamos la proyección del impacto fiscal '
                        . 'de cada movimiento antes de que lo ejecute, no un análisis posterior.',
                ],
            ],
            [
                'h2'   => 'Inversión extranjera y remesas de utilidades',
                'body' => [
                    'Asesoramos a inversores sobre el tratamiento tributario de remesas de utilidades, '
                        . 'regímenes de maquila y otros incentivos legales para capital del exterior, para '
                        . 'que la entrada al mercado paraguayo no tropiece con una lectura tardía de la '
                        . 'normativa.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Decisiones con el número por delante', 'text' => 'El impacto fiscal se calcula antes de invertir, no después.'],
            ['title' => 'Menor exposición a multas', 'text' => 'Cada decisión pasa por un filtro técnico antes de ejecutarse.'],
            ['title' => 'Régimen alineado a su facturación real', 'text' => 'Revisamos si sigue en el régimen correcto a medida que su empresa crece.'],
        ],
        'faq' => [
            ['q' => '¿Cuál es la diferencia entre evasión y planificación fiscal?', 'a' => 'La evasión es ilegal: consiste en ocultar ingresos o falsear información ante la DNIT. La planificación fiscal es completamente legal y consiste en organizar su actividad de la forma más eficiente entre las opciones que la propia ley tributaria paraguaya ofrece.'],
            ['q' => '¿Cuándo conviene hacer una planificación fiscal?', 'a' => 'Lo ideal es antes de iniciar el ejercicio fiscal o antes de ejecutar una inversión importante, cuando todavía puede elegir entre alternativas. Sin embargo, un diagnóstico a mitad de año también puede salvar el cierre anual si detectamos ineficiencias a tiempo.'],
            ['q' => '¿Asesoran a inversores extranjeros?', 'a' => 'Sí, asesoramos sobre el tratamiento tributario de remesas de utilidades, regímenes de maquila y otros incentivos legales disponibles para capital del exterior que decide invertir en el mercado paraguayo, desde la estructura inicial hasta la operación en marcha.'],
            ['q' => '¿Con qué frecuencia debería revisar mi estructura fiscal?', 'a' => 'Al menos una vez al año, junto con el cierre de su ejercicio, o antes de cualquier decisión importante: una inversión relevante, un cambio de régimen o la apertura de una nueva sucursal en otra ciudad.'],
        ],
        'cta'     => ['label' => 'Agendar una revisión fiscal', 'whatsappText' => ''],
        'related' => ['contabilidad', 'ire-simple', 'auditoria'],
        'guides'   => ['multas-dnit-como-regularizar'],
        'articles' => ['multas-dnit-cuanto-son-y-como-evitarlas'],
    ],

    // === Auditoría ==========================================================

    'auditoria' => [
        'path'            => '/auditoria/',
        'title'           => 'Auditoría',
        'navLabel'        => 'Auditoría',
        'cluster'         => 'auditoria',
        'parent'          => null,
        'seoTitle'        => 'Auditoría para empresas en Paraguay',
        'metaDescription' => 'Servicios de auditoría en Paraguay: auditoría externa obligatoria, auditoría '
                           . 'interna y auditoría forense, con informes claros y accionables.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Auditoría en Paraguay: externa, interna y forense',
            'h2'      => 'Sin un dictamen a tiempo, una empresa obligada a auditar externamente enfrenta '
                       . 'sanciones y pierde perfil crediticio ante bancos y licitaciones.',
            'lead'    => 'Cubrimos las tres especialidades —externa obligatoria, interna y forense— con '
                       . 'informes que puede presentar donde se los pidan.',
        ],
        'includes' => [
            'Diagnóstico de si su empresa está obligada a auditar externamente',
            'Planificación y ejecución de las pruebas de auditoría',
            'Emisión del dictamen correspondiente',
            'Informe de control interno o pericial, según el caso',
        ],
        'excludes' => [
            'No reemplaza la contabilidad mensual, que debe estar al día antes de auditar (ver Contabilidad mensual)',
            'No lo representamos en un juicio, aunque el informe pericial sirve como prueba',
            'No emitimos dictamen sin acceso completo a sus registros contables',
        ],
        'weNeed' => [
            'Estados financieros completos del ejercicio',
            'Libros de compras y ventas de IVA',
            'Libro diario y mayor',
            'Inventarios, cuando corresponda',
        ],
        'sections' => [
            [
                'h2'   => '¿Quién está obligado a auditar externamente?',
                'body' => [
                    'Según la normativa vigente, están obligados los contribuyentes que hayan facturado en '
                        . 'el ejercicio anterior un monto igual o superior a Gs. 9.201.143.662 (consulte el '
                        . 'monto vigente para el ejercicio en curso). Muchas empresas la contratan '
                        . 'voluntariamente para mejorar su perfil crediticio, sin estar obligadas.',
                ],
            ],
            [
                'h2'   => 'Auditoría interna: no es solo para grandes empresas',
                'body' => [
                    'Cualquier empresa que maneje inventario, personal o varios flujos de caja se '
                        . 'beneficia de una revisión de sus controles internos, aunque no la exija ningún '
                        . 'organismo. El alcance se adapta al tamaño real de su operación.',
                ],
            ],
            [
                'h2'   => 'Cuándo conviene una auditoría forense',
                'body' => [
                    'Ante sospecha de fraude, malversación o un conflicto entre socios, un peritaje '
                        . 'contable con validez legal reconstruye los hechos financieros y sostiene su '
                        . 'posición en una negociación o un proceso judicial.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Menos riesgo de fiscalización intrusiva', 'text' => 'Un dictamen respaldado por una firma matriculada reduce las probabilidades de una revisión a fondo.'],
            ['title' => 'Controles internos más sólidos', 'text' => 'Identificamos dónde se filtran recursos antes de que sea una pérdida significativa.'],
            ['title' => 'Informes con validez ante terceros', 'text' => 'Bancos, socios y organismos de control aceptan un dictamen o peritaje de una firma matriculada.'],
        ],
        'faq' => [
            ['q' => '¿Quiénes están obligados a presentar el dictamen de auditoría externa?', 'a' => 'Según la normativa vigente, están obligados los contribuyentes que hayan facturado en el ejercicio anterior un monto igual o superior a Gs. 9.201.143.662; confirme el monto actualizado con nosotros, porque puede ajustarse año a año, antes de asumir que no le corresponde.'],
            ['q' => '¿Cuánto dura un proceso de auditoría completo?', 'a' => 'Depende del volumen de sus operaciones y del estado en que se encuentre su contabilidad al momento de empezar, entre otros factores propios de cada empresa. Se lo confirmamos con precisión en el diagnóstico inicial, antes de firmar cualquier propuesta de trabajo.'],
            ['q' => '¿Qué diferencia hay entre auditoría externa e interna?', 'a' => 'La externa certifica sus estados financieros ante terceros —la DNIT, bancos, inversores— y puede ser obligatoria según su facturación. La interna evalúa sus procesos y controles para que la empresa opere mejor, sin que ningún organismo se la exija.'],
            ['q' => '¿La auditoría es solo un trámite obligatorio?', 'a' => 'No siempre, y conviene no verla solo así. Muchas empresas la contratan sin estar obligadas, porque un dictamen limpio facilita el acceso a créditos bancarios y da respaldo frente a socios, proveedores e inversores potenciales que piden números certificados antes de negociar.'],
        ],
        'cta'     => ['label' => 'Solicitar diagnóstico de auditoría', 'whatsappText' => ''],
        'related' => [
            'auditoria-auditoria-impositiva',
            'auditoria-auditoria-interna',
            'auditoria-auditoria-forense',
        ],
        'guides'   => ['certificado-de-cumplimiento-tributario'],
        'articles' => ['multas-dnit-cuanto-son-y-como-evitarlas'],
    ],

    'auditoria-auditoria-impositiva' => [
        'path'            => '/auditoria-auditoria-impositiva/',
        'title'           => 'Auditoría Impositiva',
        'navLabel'        => 'Auditoría Impositiva',
        'cluster'         => 'auditoria',
        'parent'          => 'auditoria',
        'seoTitle'        => 'Auditoría Impositiva (externa)',
        'metaDescription' => 'Auditoría Impositiva y auditoría externa obligatoria: revisamos su situación '
                           . 'tributaria y emitimos el informe que exige la DNIT.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Auditoría Impositiva: dictamen de auditoría externa obligatoria',
            'h2'      => 'Facturar por encima del umbral que exige dictamen y no presentarlo expone a la '
                       . 'empresa a sanciones, con el auditor asumiendo responsabilidad solidaria por lo declarado.',
            'lead'    => 'Ejecutamos el Dictamen de Auditoría Externa Impositiva (DAEI) dentro del '
                       . 'cronograma que exige la DNIT.',
        ],
        'includes' => [
            'Revisión del balance general y el estado de resultados',
            'Conciliación de las declaraciones de IVA e IRE del ejercicio',
            'Verificación del cumplimiento de retenciones',
            'Emisión del Dictamen de Auditoría Impositiva',
        ],
        'excludes' => [
            'No sustituye la auditoría interna de procesos (ver Auditoría Interna)',
            'No incluye la contabilidad mensual previa, que debe estar cerrada antes de auditar',
            'No cubre peritajes por sospecha de fraude (ver Auditoría Forense)',
        ],
        'weNeed' => [
            'Estados financieros completos del ejercicio',
            'Libros de compras y ventas de IVA',
            'Libro diario y mayor, e inventarios detallados',
        ],
        'sections' => [
            [
                'h2'   => '¿Qué es el Dictamen de Auditoría Externa Impositiva (DAEI)?',
                'body' => [
                    'Es el informe que exige la normativa impositiva a las empresas con facturación '
                        . 'elevada, sobre la razonabilidad de su situación tributaria. El auditor asume '
                        . 'responsabilidad solidaria sobre esa razonabilidad, así que no es un trámite para '
                        . 'tomar a la ligera ni para dejar para el último mes.',
                ],
            ],
            [
                'h2'   => 'Qué revisamos: balance, resultados y conciliaciones impositivas',
                'body' => [
                    'Analizamos el balance general, el estado de resultados y las conciliaciones entre lo '
                        . 'declarado en IVA e IRE y lo que muestran sus libros contables, verificando que '
                        . 'cada crédito fiscal y cada gasto deducible cumpla con los criterios de '
                        . 'causalidad y legalidad vigentes.',
                ],
            ],
            [
                'h2'   => 'Documentación que la empresa debe preparar',
                'body' => [
                    'Estados financieros completos, libros de compras y ventas de IVA, libro diario y '
                        . 'mayor, e inventarios detallados. Al ser un estudio digital, recibimos estos '
                        . 'documentos por canales seguros, sin que tenga que acercar carpetas físicas.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Créditos fiscales validados', 'text' => 'Verificamos que cada deducción cumpla los criterios de causalidad y legalidad exigidos.'],
            ['title' => 'Dictamen dentro del cronograma', 'text' => 'Trabajamos con un calendario que minimiza el impacto en su operativa diaria.'],
            ['title' => 'Respaldo ante bancos y terceros', 'text' => 'Un dictamen firmado facilita líneas de crédito y negociaciones con proveedores.'],
        ],
        'faq' => [
            ['q' => '¿Cuál es el monto de facturación que obliga a la auditoría este año?', 'a' => 'Según la normativa vigente, están obligados los contribuyentes que hayan facturado en el ejercicio anterior un monto igual o superior a Gs. 9.201.143.662. Confírmelo con nosotros antes de asumir que no le corresponde, porque el monto puede actualizarse de un ejercicio a otro.'],
            ['q' => '¿Qué documentos debe preparar la empresa?', 'a' => 'Estados financieros completos, libros de compras y ventas de IVA, libro diario y mayor, e inventarios detallados del ejercicio a revisar. Al ser un estudio digital, facilitamos la recepción de todo por canales seguros y encriptados, sin que tenga que acercar carpetas físicas a nuestra oficina.'],
            ['q' => '¿Cuál es la fecha límite para presentar el informe a la DNIT?', 'a' => 'El plazo depende del cierre de su ejercicio fiscal y del calendario de vencimientos vigente de la DNIT, así que varía de una empresa a otra según cuándo cierra su ejercicio. Se lo confirmamos con precisión según su caso particular apenas iniciamos el trabajo de auditoría.'],
            ['q' => '¿Qué pasa si estoy obligado y no presento el dictamen?', 'a' => 'La DNIT puede aplicar sanciones administrativas y bloquear su Certificado de Cumplimiento Tributario, lo que le complica operar con bancos, proveedores y licitaciones hasta que regularice la situación. Por eso conviene planificar el dictamen con anticipación, no dejarlo para el último mes del plazo.'],
        ],
        'cta'     => ['label' => 'Solicitar el dictamen de auditoría', 'whatsappText' => ''],
        'related' => ['auditoria', 'auditoria-auditoria-interna', 'asesoria'],
        'guides'   => ['multas-dnit-como-regularizar'],
        'articles' => ['multas-dnit-cuanto-son-y-como-evitarlas'],
    ],

    'auditoria-auditoria-interna' => [
        'path'            => '/auditoria-auditoria-interna/',
        'title'           => 'Auditoría Interna',
        'navLabel'        => 'Auditoría Interna',
        'cluster'         => 'auditoria',
        'parent'          => 'auditoria',
        'seoTitle'        => 'Auditoría Interna y control',
        'metaDescription' => 'Auditoría Interna y control de gestión: evaluamos sus procesos y controles '
                           . 'para reducir riesgos operativos y pérdidas evitables.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Auditoría Interna y control de gestión',
            'h2'      => 'Cuando una empresa crece más rápido que su organización, se filtran recursos '
                       . 'por falta de segregación de funciones, sin que nadie lo note a tiempo.',
            'lead'    => 'Revisamos sus procesos de compras, pagos, inventario y caja, y le entregamos '
                       . 'una hoja de ruta para cerrar esas brechas.',
        ],
        'includes' => [
            'Evaluación de controles en el ciclo de compras y pagos',
            'Revisión de inventarios y caja',
            'Verificación de la segregación de funciones',
            'Informe con hallazgos y plan de acción',
        ],
        'excludes' => [
            'No es el dictamen que exige la DNIT (ver Auditoría Impositiva)',
            'No incluye la investigación de un fraude puntual (ver Auditoría Forense)',
            'No implementamos los cambios, solo entregamos la recomendación técnica',
        ],
        'weNeed' => [
            'Acceso a sus procesos de compras, pagos e inventario',
            'Organigrama o descripción de roles, si existe',
            'Reportes de caja del período a revisar',
        ],
        'sections' => [
            [
                'h2'   => 'Qué evaluamos: compras, pagos, inventario y caja',
                'body' => [
                    'Revisamos cómo entra y sale el dinero y la mercadería de su empresa: autorización de '
                        . 'compras, ciclo de pagos, control físico de inventario y arqueos de caja. Son los '
                        . 'puntos donde más comúnmente se filtran recursos sin que nadie lo detecte a tiempo.',
                ],
            ],
            [
                'h2'   => 'No buscamos culpables, buscamos procesos',
                'body' => [
                    'El objetivo no es señalar a una persona, sino identificar dónde el proceso permite que '
                        . 'un error o un desvío pase inadvertido. Al terminar, tiene una hoja de ruta clara '
                        . 'para mitigar riesgos operativos y financieros concretos.',
                ],
            ],
            [
                'h2'   => 'Con qué frecuencia conviene auditar internamente',
                'body' => [
                    'Depende de la complejidad de su operación: puede ser una revisión anual profunda o '
                        . 'seguimientos trimestrales de los puntos más críticos, como caja e inventario. Se '
                        . 'lo recomendamos según lo que encontremos en la primera revisión.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Detección temprana', 'text' => 'Identificamos fugas de recursos antes de que se conviertan en una pérdida grande.'],
            ['title' => 'Procesos más ágiles', 'text' => 'Menos tareas duplicadas y roles más claros dentro de su organización.'],
            ['title' => 'Mejor preparación para la auditoría externa', 'text' => 'Si su empresa está obligada a auditar externamente, llega con menos sorpresas.'],
        ],
        'faq' => [
            ['q' => '¿Es necesario ser una gran empresa para tener auditoría interna?', 'a' => 'No. Cualquier empresa que maneje inventarios, personal o varios flujos de caja se beneficia del orden que aporta una revisión de sus controles. Adaptamos el alcance del trabajo a la realidad de su pyme o empresa familiar, sin sobredimensionarlo.'],
            ['q' => '¿Qué diferencia hay con la auditoría de la DNIT?', 'a' => 'La auditoría externa de la DNIT certifica su cumplimiento tributario ante terceros y puede ser obligatoria según su facturación. La interna es para que su negocio sea más rentable, seguro y eficiente desde adentro, sin que ningún organismo se la exija.'],
            ['q' => '¿Con qué frecuencia se debe realizar?', 'a' => 'Depende de la complejidad de su operación: puede ser una revisión anual profunda o seguimientos trimestrales de los puntos más críticos, como caja, cobranzas e inventario. Se lo recomendamos con precisión según lo que encontremos en la primera revisión.'],
            ['q' => '¿Cuánto dura una auditoría interna?', 'a' => 'Depende del alcance que definamos juntos: una revisión puntual de un proceso específico toma menos tiempo que una evaluación integral de toda la operación de la empresa. Se lo precisamos por escrito en la propuesta inicial, antes de empezar.'],
        ],
        'cta'     => ['label' => 'Fortalecer mis controles internos', 'whatsappText' => ''],
        'related' => ['auditoria', 'auditoria-auditoria-forense', 'contabilidad'],
        'guides'   => ['certificado-de-cumplimiento-tributario'],
        'articles' => ['balance-general-estado-de-resultados-flujo-de-efectivo'],
    ],

    'auditoria-auditoria-forense' => [
        'path'            => '/auditoria-auditoria-forense/',
        'title'           => 'Auditoría Forense',
        'navLabel'        => 'Auditoría Forense',
        'cluster'         => 'auditoria',
        'parent'          => 'auditoria',
        'seoTitle'        => 'Auditoría Forense y peritajes',
        'metaDescription' => 'Auditoría Forense y peritajes contables: investigamos fraudes, desvíos y '
                           . 'diferencias patrimoniales con informes de validez pericial.',
        'hero' => [
            'eyebrow' => '',
            'h1'      => 'Auditoría Forense y peritajes contables',
            'h2'      => 'Ante una sospecha de fraude entre socios o empleados, cada día sin evidencia '
                       . 'ordenada reduce las posibilidades de recuperar lo perdido.',
            'lead'    => 'Reconstruimos los hechos financieros con técnicas de investigación contable y '
                       . 'entregamos un informe con validez pericial.',
        ],
        'includes' => [
            'Análisis de flujos de fondos y transacciones',
            'Verificación de autenticidad de documentos',
            'Rastreo de activos',
            'Informe pericial con validez legal',
        ],
        'excludes' => [
            'No reemplaza a un abogado en el juicio, aunque el informe se usa como prueba',
            'No es la auditoría anual obligatoria (ver Auditoría Impositiva)',
            'No iniciamos una investigación sin un encargo formal y un acuerdo de confidencialidad firmado',
        ],
        'weNeed' => [
            'Descripción de la sospecha o el conflicto',
            'Acceso a los registros contables y bancarios involucrados',
            'Un acuerdo de confidencialidad firmado antes de empezar',
        ],
        'sections' => [
            [
                'h2'   => 'Qué hacemos ante una sospecha de fraude',
                'body' => [
                    'Un conflicto societario o una fuga de capital por falta de control interno puede '
                        . 'paralizar una empresa entera si no se investiga con método. Rastreamos '
                        . 'transacciones y analizamos patrones de comportamiento financiero que una '
                        . 'revisión contable convencional no está diseñada para detectar.',
                ],
            ],
            [
                'h2'   => 'Rastreo de fondos y verificación de documentos',
                'body' => [
                    'Analizamos flujos de fondos, verificamos la autenticidad de documentos y rastreamos '
                        . 'activos para determinar el alcance real de una irregularidad. El resultado es un '
                        . 'informe pericial que puede usarse en un proceso judicial o en un acuerdo extrajudicial.',
                ],
            ],
            [
                'h2'   => 'Confidencialidad durante la investigación',
                'body' => [
                    'Trabajamos bajo un acuerdo de secreto profesional estricto desde el primer contacto, '
                        . 'para proteger la reputación de la empresa mientras dura la investigación, '
                        . 'independientemente del resultado final.',
                ],
            ],
        ],
        'benefits' => [
            ['title' => 'Base técnica para un juicio o negociación', 'text' => 'El informe pericial da sustento objetivo a un reclamo, en lugar de versiones enfrentadas.'],
            ['title' => 'Confidencialidad estricta', 'text' => 'Trabajamos bajo secreto profesional desde el primer contacto.'],
            ['title' => 'Validez ante la justicia paraguaya', 'text' => 'Como contadores matriculados, nuestros informes tienen valor de prueba pericial.'],
        ],
        'faq' => [
            ['q' => '¿Qué tan confidencial es este proceso?', 'a' => 'Es máxima. Trabajamos bajo un acuerdo de secreto profesional estricto desde el primer contacto, que protege la reputación de la empresa mientras dura toda la investigación, independientemente de lo que se encuentre o del resultado final del proceso.'],
            ['q' => '¿Sus informes sirven para juicios en Paraguay?', 'a' => 'Sí, y con frecuencia son la base de la posición de la empresa en ese proceso. Como contadores matriculados, nuestros informes y peritajes tienen validez ante la justicia paraguaya como prueba pericial técnica, con el respaldo de nuestra matrícula profesional y la metodología documentada en cada paso de la investigación.'],
            ['q' => '¿Pueden ayudar a prevenir fraudes antes de que ocurran?', 'a' => 'Sí. Antes de que haya una sospecha concreta, una revisión de controles internos (ver Auditoría Interna) detecta las brechas que suelen derivar en fraude: falta de segregación de funciones, accesos compartidos o conciliaciones que nadie revisa. Prevenir sale más barato que investigar después.'],
            ['q' => '¿Qué necesito tener listo para la primera reunión?', 'a' => 'Una descripción de la sospecha o el conflicto y, si es posible, acceso a los registros contables y bancarios involucrados en el caso. El acuerdo de confidencialidad se firma antes de compartir con nuestro equipo cualquier documento sensible, para que pueda hablar con libertad desde la primera reunión.'],
        ],
        'cta'     => ['label' => 'Solicitar una consultoría confidencial', 'whatsappText' => ''],
        'related' => ['auditoria', 'auditoria-auditoria-impositiva', 'auditoria-auditoria-interna'],
        'guides'   => ['multas-dnit-como-regularizar'],
        'articles' => ['multas-dnit-cuanto-son-y-como-evitarlas'],
    ],
];
