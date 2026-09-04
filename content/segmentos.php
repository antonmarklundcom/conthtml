<?php
/**
 * Segment landing pages (plan §6.6): `/contador-para/<slug>/` for eight rubros,
 * plus `/cambiar-de-contador/` as a ninth record with no rubro of its own.
 * Rendered by templates/segment.php; one 3-line route file per slug.
 *
 * A segment page does not carry its own tier or WhatsApp message — it presets
 * the visitor into the real service that anchors its bundle
 * (`leadSlug`, an existing key in content/lead-values.php's 'services'), so
 * the lead form, the WhatsApp CTA and the CRM tag all resolve through the one
 * lead value model C1 built rather than a second copy of it (docs/lead-value.md).
 *
 * Record shape:
 *
 *   path             string   '/contador-para/<slug>/' or '/cambiar-de-contador/'
 *   navLabel         string   short label for the homepage rubros band
 *   seoTitle         string   <title> without the site suffix, <= 42 chars
 *   metaDescription  string   120-155 chars, unique site-wide
 *   hero             array    eyebrow, h1, lead
 *   leadSlug         string   the bundle's tier-A service slug (an existing key
 *                             in content/lead-values.php['services']) — every
 *                             WhatsApp link and the lead form on this page
 *                             preset to it
 *   bundle           string[] service slugs shown as the "lo que armamos" grid
 *   traps            array    [] for /cambiar-de-contador/; elsewhere 3 named
 *                             tax mechanics specific to the rubro (no stats)
 *   sections         array    optional prose blocks, same shape as
 *                             content/services.php's 'sections' — used by
 *                             /cambiar-de-contador/ for the handover explainer
 *   weNeed           string[] "Qué necesitamos de usted" checklist
 *   faq              array    [['q' => ..., 'a' => ...], ...], 3-5 items
 *
 * Adding a rubro: add a record here, then a 3-line route file, then a line in
 * deploy/routes.php and sitemap.php's segmentos loops (both already read this
 * file — see the C3 additions there).
 */

declare(strict_types=1);

return [

    'importadores' => [
        'path'            => '/contador-para/importadores/',
        'navLabel'        => 'Importadores',
        'seoTitle'        => 'Contador para importadores en Paraguay',
        'metaDescription' => 'Contador para importadores en Paraguay: crédito fiscal de aduana, diferencia '
                           . 'de cambio y facturación electrónica, con contabilidad mensual al día.',
        'hero' => [
            'eyebrow' => 'Contador para',
            'h1'      => 'Contador para importadores en Paraguay',
            'lead'    => 'El despacho aduanero, el tipo de cambio y el IVA de sus compras al exterior '
                       . 'entran todos al mismo libro. Los llevamos juntos, no por separado.',
        ],
        'leadSlug' => 'contabilidad',
        'bundle'   => ['contabilidad', 'iva', 'ire-simple'],
        'traps' => [
            [
                'title' => 'Crédito fiscal de aduana que no coincide con el libro de compras',
                'text'  => 'El IVA pagado en el despacho aduanero (DUA) debe entrar a su libro de compras '
                         . 'en el período correcto. Si no coincide con lo declarado en el Formulario 120, '
                         . 'la DNIT observa la diferencia.',
            ],
            [
                'title' => 'Diferencia de cambio sin registrar',
                'text'  => 'Una deuda en dólares con su proveedor del exterior cambia de valor en guaraníes '
                         . 'entre la compra y el pago. Esa diferencia de cambio es un resultado impositivo '
                         . 'que su balance debe mostrar, no una nota al margen.',
            ],
            [
                'title' => 'Facturación electrónica obligatoria sin habilitación a tiempo',
                'text'  => 'La DNIT asigna la obligatoriedad de Ekuatia\'i por cronograma según su '
                         . 'facturación. Superar el umbral sin estar habilitado bloquea su timbrado, '
                         . 'justo cuando más factura.',
            ],
        ],
        'sections' => [],
        'weNeed' => [
            'Facturas de compra y documentación de despacho aduanero (DUA) del período',
            'Extractos bancarios y detalle de pagos a proveedores del exterior',
            'Comprobantes de venta y su régimen de facturación electrónica actual',
            'Última declaración jurada de IVA presentada',
        ],
        'faq' => [
            [
                'q' => '¿El IVA de la aduana se recupera igual que el de una factura local?',
                'a' => 'Se declara como crédito fiscal en su Formulario 120, sí, pero con el respaldo del '
                     . 'despacho aduanero en lugar de una factura de un proveedor local. Conciliamos ambos '
                     . 'documentos antes de presentar su declaración.',
            ],
            [
                'q' => '¿Debo declarar la diferencia de cambio aunque no haya vendido nada?',
                'a' => 'Sí, si tiene una deuda en moneda extranjera al cierre del período: la diferencia de '
                     . 'cambio se calcula sobre el saldo pendiente, no sobre sus ventas.',
            ],
            [
                'q' => '¿Cuándo me obliga la DNIT a facturar electrónicamente?',
                'a' => 'Según el cronograma de Ekuatia\'i por facturación anual, que la DNIT actualiza. '
                     . 'Revisamos su situación y lo habilitamos antes de que el cronograma se lo exija.',
            ],
        ],
    ],

    'comercios' => [
        'path'            => '/contador-para/comercios/',
        'navLabel'        => 'Comercios',
        'seoTitle'        => 'Contador para comercios en Paraguay',
        'metaDescription' => 'Contador para comercios en Paraguay: costo de mercadería, facturación '
                           . 'electrónica y conciliación de IVA, con contabilidad mensual y cierre puntual.',
        'hero' => [
            'eyebrow' => 'Contador para',
            'h1'      => 'Contador para comercios en Paraguay',
            'lead'    => 'Entre el punto de venta, el stock y el IVA a fin de mes hay más lugares para '
                       . 'perder margen que para ganarlo. Los cerramos todos juntos, cada mes.',
        ],
        'heroImage' => [
            'src' => '/assets/img/emprendedora-ecommerce-paraguay-1280.avif',
            'alt' => 'Emprendedora paraguaya empacando pedidos de su tienda online en un espacio de trabajo luminoso',
        ],
        'leadSlug' => 'contabilidad',
        'bundle'   => ['contabilidad', 'ekuatia', 'iva'],
        'traps' => [
            [
                'title' => 'Costo de mercadería vendida sin control de inventario',
                'text'  => 'Sin un registro de entradas y salidas de stock, el costo que se resta de sus '
                         . 'ventas queda estimado en lugar de calculado, y su estado de resultados muestra '
                         . 'una ganancia que no es real.',
            ],
            [
                'title' => 'Facturación electrónica por cronograma sin timbrado vigente',
                'text'  => 'La DNIT va incorporando comercios a Ekuatia\'i por facturación anual. Si su '
                         . 'timbrado vence antes de habilitarse al sistema nuevo, no puede emitir '
                         . 'comprobantes válidos hasta resolverlo.',
            ],
            [
                'title' => 'IVA de ventas al contado y a crédito declarado distinto',
                'text'  => 'Lo que factura en el punto de venta y lo que efectivamente cobra no siempre '
                         . 'coincide en el mismo período. Si el Formulario 120 no separa ambos flujos '
                         . 'correctamente, la DNIT observa la diferencia.',
            ],
        ],
        'sections' => [],
        'weNeed' => [
            'Reporte de ventas del punto de venta (o planilla, si aún no factura por sistema)',
            'Facturas de compra a proveedores del período',
            'Inventario o última toma de stock',
            'Extractos bancarios',
        ],
        'faq' => [
            [
                'q' => '¿Necesito llevar un control de stock formal para declarar impuestos?',
                'a' => 'La DNIT no exige un sistema en particular, pero sí que su costo de mercadería '
                     . 'vendida sea verificable. Le armamos un control simple si todavía no lo tiene.',
            ],
            [
                'q' => '¿Qué pasa si no vendí nada en el mes?',
                'a' => 'Igual presenta la declaración jurada de IVA en cero. No presentarla, aunque no haya '
                     . 'tenido movimiento, genera una multa automática por omisión.',
            ],
            [
                'q' => '¿Puedo seguir facturando en talonario mientras me habilito a Ekuatia\'i?',
                'a' => 'Depende de su timbrado actual y del cronograma que la DNIT le asignó. Revisamos su '
                     . 'situación puntual antes de que el vencimiento lo tome por sorpresa.',
            ],
        ],
    ],

    'unipersonales' => [
        'path'            => '/contador-para/unipersonales/',
        'navLabel'        => 'Unipersonales',
        'seoTitle'        => 'Contador para unipersonales en Paraguay',
        'metaDescription' => 'Contador para empresas unipersonales en Paraguay: Resimple, IRE Simple e IVA, '
                           . 'sin mezclar gastos personales con los del negocio.',
        'hero' => [
            'eyebrow' => 'Contador para',
            'h1'      => 'Contador para unipersonales en Paraguay',
            'lead'    => 'Como unipersonal, usted y su negocio comparten el mismo RUC pero no el mismo '
                       . 'régimen tributario si no lo revisa cada año. Se lo confirmamos antes de que '
                       . 'cambie de categoría sin darse cuenta.',
        ],
        'leadSlug' => 'contabilidad',
        'bundle'   => ['contabilidad', 'ire-simple', 'irp'],
        'traps' => [
            [
                'title' => 'Superar el tope de Resimple sin cambiar de régimen',
                'text'  => 'Resimple tiene un tope de facturación anual. Superarlo sin pasar a IRE Simple '
                         . 'a tiempo deja a su empresa presentando en el régimen equivocado, con la '
                         . 'diferencia de impuesto a cargo suyo.',
            ],
            [
                'title' => 'Gastos personales mezclados en el libro de compras',
                'text'  => 'Una factura del supermercado o del taller del auto particular no es un gasto '
                         . 'deducible del negocio. La DNIT observa esas facturas cuando cruza su declaración, '
                         . 'no cuando usted las carga.',
            ],
            [
                'title' => 'Inscribirse en el régimen que no corresponde desde el inicio',
                'text'  => 'Resimple, IRE Simple e IRP tienen requisitos distintos. Elegir mal al abrir el '
                         . 'RUC significa volver a inscribirse después, con presentaciones atrasadas de por '
                         . 'medio.',
            ],
        ],
        'sections' => [],
        'weNeed' => [
            'Facturas de compras y ventas del período',
            'Su RUC y el régimen en el que está inscripto actualmente',
            'Extracto bancario de la cuenta que usa para el negocio',
            'Última declaración presentada, si ya tiene una',
        ],
        'faq' => [
            [
                'q' => '¿Cómo sé si me conviene Resimple o IRE Simple?',
                'a' => 'Depende de su facturación anual y de si puede documentar sus gastos con factura. '
                     . 'Se lo confirmamos en la primera conversación, sin costo.',
            ],
            [
                'q' => '¿Puedo deducir gastos personales si los pago con la cuenta del negocio?',
                'a' => 'No: la deducción depende de que el gasto esté directamente relacionado con su '
                     . 'actividad, no de qué cuenta lo paga. Le indicamos con precisión qué entra y qué no.',
            ],
            [
                'q' => '¿Un unipersonal también presenta IRP?',
                'a' => 'Puede corresponderle además del régimen de la empresa, según sus ingresos '
                     . 'personales totales. Lo revisamos junto con su presentación anual.',
            ],
        ],
    ],

    'profesionales-independientes' => [
        'path'            => '/contador-para/profesionales-independientes/',
        'navLabel'        => 'Profesionales independientes',
        'seoTitle'        => 'Contador para profesionales independientes',
        'metaDescription' => 'Contador para profesionales independientes en Paraguay: recibos de '
                           . 'honorarios, retenciones de IVA e IRP anual, sin sorpresas en marzo.',
        'hero' => [
            'eyebrow' => 'Contador para',
            'h1'      => 'Contador para profesionales independientes',
            'lead'    => 'Cada recibo de honorarios que emite tiene una retención, un timbrado y una '
                       . 'declaración detrás. Se los ordenamos durante el año para que marzo no lo '
                       . 'sorprenda.',
        ],
        'heroImage' => [
            'src' => '/assets/img/profesional-independiente-freelance-exitoso-1280.avif',
            'alt' => 'Profesional independiente paraguaya trabajando en su laptop en un espacio luminoso',
        ],
        'leadSlug' => 'contabilidad',
        'bundle'   => ['irp', 'iva', 'contabilidad'],
        'traps' => [
            [
                'title' => 'Recibos de honorarios con timbrado vencido',
                'text'  => 'Un recibo emitido con timbrado vencido no es válido para su cliente ni para '
                         . 'la DNIT, aunque el cobro sea real. Controlamos su vigencia antes de que emita, '
                         . 'no después.',
            ],
            [
                'title' => 'Retenciones de IVA que el cliente aplica y usted no concilia',
                'text'  => 'Cuando su cliente le retiene IVA sobre el honorario, esa retención debe '
                         . 'reflejarse en su Formulario 120 del mes. Si no la concilia, su saldo de IVA '
                         . 'queda mal calculado.',
            ],
            [
                'title' => 'IRP anual presentado sin las deducciones que corresponden',
                'text'  => 'Aportes a la seguridad social, gastos vinculados a su actividad y otras '
                         . 'deducciones bajan la base del IRP. Presentar sin identificarlas significa '
                         . 'pagar más de lo que corresponde.',
            ],
        ],
        'sections' => [],
        'weNeed' => [
            'Recibos de honorarios emitidos en el período',
            'Comprobantes de retenciones que le aplicaron sus clientes',
            'Gastos vinculados a su actividad profesional',
            'Su régimen actual (IRP u otro) si ya está inscripto',
        ],
        'faq' => [
            [
                'q' => '¿Qué deducciones puedo aplicar en mi IRP?',
                'a' => 'Aportes a la seguridad social, gastos directamente relacionados con su actividad '
                     . 'y otros conceptos que la ley admite. Revisamos su caso concreto antes de presentar.',
            ],
            [
                'q' => '¿Tengo que declarar IVA aunque solo emita recibos de honorarios?',
                'a' => 'Sí, si está inscripto en el régimen general de IVA sobre servicios profesionales. '
                     . 'Confirmamos su situación exacta en la primera conversación.',
            ],
            [
                'q' => '¿Cuándo se presenta el IRP anual?',
                'a' => 'La DNIT fija el plazo cada año, generalmente entre marzo y abril según su régimen. '
                     . 'Le avisamos con anticipación y armamos la presentación con usted.',
            ],
        ],
    ],

    'construccion' => [
        'path'            => '/contador-para/construccion/',
        'navLabel'        => 'Construcción',
        'seoTitle'        => 'Contador para construcción en Paraguay',
        'metaDescription' => 'Contador para empresas de construcción en Paraguay: personal de obra en IPS, '
                           . 'facturación por avance y retenciones a subcontratistas, sin atrasos.',
        'hero' => [
            'eyebrow' => 'Contador para',
            'h1'      => 'Contador para empresas de construcción',
            'lead'    => 'Personal que entra y sale por obra, facturación por avance y subcontratistas '
                       . 'con su propio RUC: le ordenamos los tres frentes cada mes, no solo al cierre.',
        ],
        'leadSlug' => 'contabilidad',
        'bundle'   => ['contabilidad', 'ips', 'iva'],
        'traps' => [
            [
                'title' => 'Personal de obra sin alta en IPS desde el primer día',
                'text'  => 'El aporte IPS empieza a correr desde el día en que la persona empieza a '
                         . 'trabajar, aunque sea por una obra puntual. Dar de alta tarde deja a la empresa '
                         . 'expuesta ante una fiscalización o un accidente laboral.',
            ],
            [
                'title' => 'Facturación por avance de obra sin certificado respaldado',
                'text'  => 'Cobrar un anticipo o un avance sin el certificado de obra correspondiente '
                         . 'complica la conciliación entre lo facturado y el estado real del contrato, y '
                         . 'la DNIT lo observa como un ingreso sin sustento.',
            ],
            [
                'title' => 'Retenciones a subcontratistas mal aplicadas',
                'text'  => 'Un subcontratista con su propio RUC igual puede estar sujeto a retención según '
                         . 'su régimen. No aplicarla correctamente traslada esa obligación a su empresa.',
            ],
        ],
        'sections' => [],
        'weNeed' => [
            'Planilla de personal de obra, incluido el temporal',
            'Certificados de avance de obra y facturas emitidas',
            'Facturas y contratos de subcontratistas',
            'Extractos bancarios del período',
        ],
        'faq' => [
            [
                'q' => '¿Debo dar de alta en IPS a un obrero contratado por una semana?',
                'a' => 'Sí. El IPS no tiene un mínimo de días: el aporte corresponde desde el primer día '
                     . 'trabajado, sea la obra corta o larga.',
            ],
            [
                'q' => '¿Cómo facturo un avance de obra antes de terminarla?',
                'a' => 'Con el certificado de avance como respaldo del monto facturado. Lo alineamos con '
                     . 'su contrato para que la DNIT no lo observe como un ingreso sin sustento.',
            ],
            [
                'q' => '¿Tengo que retener a un subcontratista que ya tiene RUC propio?',
                'a' => 'Depende de su régimen tributario y del tipo de servicio. Revisamos cada '
                     . 'subcontratista antes de que la retención quede mal aplicada.',
            ],
        ],
    ],

    'gastronomia' => [
        'path'            => '/contador-para/gastronomia/',
        'navLabel'        => 'Gastronomía',
        'seoTitle'        => 'Contador para gastronomía en Paraguay',
        'metaDescription' => 'Contador para restaurantes y bares en Paraguay: facturación electrónica en '
                           . 'caja, IVA conciliado y aportes IPS de personal por turnos.',
        'hero' => [
            'eyebrow' => 'Contador para',
            'h1'      => 'Contador para gastronomía en Paraguay',
            'lead'    => 'Caja abierta todos los días, personal por turnos y facturación electrónica en '
                       . 'cada mesa: le llevamos los números al día para que el cierre de mes no sea una '
                       . 'sorpresa.',
        ],
        'leadSlug' => 'contabilidad',
        'bundle'   => ['contabilidad', 'ekuatia', 'ips'],
        'traps' => [
            [
                'title' => 'Facturación electrónica en el punto de venta sin plan de contingencia',
                'text'  => 'Si el sistema de facturación cae a mitad del servicio, sin un procedimiento de '
                         . 'contingencia autorizado su local queda sin poder emitir comprobantes válidos.',
            ],
            [
                'title' => 'IVA mal conciliado entre lo facturado y lo cobrado',
                'text'  => 'Con alta rotación de caja diaria, lo que el sistema registra como facturado y '
                         . 'lo que efectivamente ingresó no siempre coincide. Esa diferencia infla o reduce '
                         . 'su IVA a pagar sin que se note en el momento.',
            ],
            [
                'title' => 'Personal por turnos con aportes IPS mal liquidados',
                'text'  => 'Personal de medio tiempo, fin de semana o por evento sigue generando obligación '
                         . 'de IPS proporcional a lo trabajado. Liquidarlo como si fuera jornada completa '
                         . '(o no liquidarlo) es un error frecuente en el rubro.',
            ],
        ],
        'sections' => [],
        'weNeed' => [
            'Reporte de ventas del sistema de punto de venta del período',
            'Planilla de personal, incluidos turnos parciales',
            'Facturas de compra de insumos y proveedores',
            'Extractos bancarios',
        ],
        'faq' => [
            [
                'q' => '¿Qué hago si se cae el sistema de facturación electrónica en pleno servicio?',
                'a' => 'Existe un procedimiento de contingencia autorizado por la DNIT para seguir '
                     . 'operando. Se lo dejamos documentado y listo antes de que lo necesite.',
            ],
            [
                'q' => '¿Cómo liquido a un mozo que trabaja solo los fines de semana?',
                'a' => 'El aporte IPS se calcula proporcional a los días y horas efectivamente trabajados, '
                     . 'no como si fuera jornada completa. Se lo mostramos línea por línea.',
            ],
            [
                'q' => '¿Por qué mi IVA a pagar varía tanto de un mes a otro?',
                'a' => 'Con caja diaria de alta rotación, pequeñas diferencias entre lo facturado y lo '
                     . 'cobrado se acumulan rápido. Conciliamos ambos números cada mes antes de declarar.',
            ],
        ],
    ],

    'emprendedores' => [
        'path'            => '/contador-para/emprendedores/',
        'navLabel'        => 'Emprendedores',
        'seoTitle'        => 'Contador para emprendedores en Paraguay',
        'metaDescription' => 'Contador para emprendedores en Paraguay: elegir entre EAS, unipersonal o '
                           . 'SRL, inscribir el RUC en el régimen correcto y arrancar sin errores.',
        'hero' => [
            'eyebrow' => 'Contador para',
            'h1'      => 'Contador para emprendedores en Paraguay',
            'lead'    => 'La decisión que más le cuesta corregir después es la primera: qué forma '
                       . 'jurídica elegir y en qué régimen inscribirse. Se la resolvemos antes de que '
                       . 'firme nada.',
        ],
        'heroImage' => [
            'src' => '/assets/img/fundadores-startup-oficina-digital-1280.avif',
            'alt' => 'Dos jóvenes fundadores de una startup paraguaya colaborando en una oficina digital moderna',
        ],
        'leadSlug' => 'eas',
        'bundle'   => ['eas', 'ruc', 'contabilidad'],
        'traps' => [
            [
                'title' => 'Elegir la forma jurídica equivocada',
                'text'  => 'EAS, unipersonal y SRL tienen requisitos, costos y responsabilidades distintos. '
                         . 'Constituir la que no corresponde a su plan de crecimiento significa un cambio '
                         . 'de estructura después, con costo y tiempo de por medio.',
            ],
            [
                'title' => 'Abrir el RUC en el régimen que no corresponde',
                'text'  => 'Resimple, IRE Simple e IRE General exigen requisitos distintos desde el día uno. '
                         . 'Inscribirse en el que no corresponde a su actividad real obliga a corregirlo '
                         . 'más adelante, con presentaciones de por medio.',
            ],
            [
                'title' => 'No prever el IPS ni el aguinaldo desde el primer empleado',
                'text'  => 'En cuanto contrata a la primera persona, corren el aporte IPS y el aguinaldo '
                         . 'proporcional. Muchos emprendimientos lo descubren recién cuando llega el primer '
                         . 'vencimiento.',
            ],
        ],
        'sections' => [],
        'weNeed' => [
            'Cédula de identidad de los socios o del titular',
            'Una descripción breve de la actividad y el plan de facturación esperado',
            'Definición de si tendrá socios, y si alguno es extranjero',
            'Domicilio donde funcionará el negocio',
        ],
        'faq' => [
            [
                'q' => '¿EAS, unipersonal o SRL: cuál me conviene?',
                'a' => 'Depende de si tendrá socios, del capital que piensa aportar y de su responsabilidad '
                     . 'ante deudas del negocio. Se lo comparamos en la primera conversación, sin costo.',
            ],
            [
                'q' => '¿Cuánto tarda en estar lista mi empresa para facturar?',
                'a' => 'Depende del trámite elegido y de que la documentación esté completa desde el '
                     . 'inicio. Le damos un cronograma con fechas acordadas antes de empezar.',
            ],
            [
                'q' => '¿Necesito contador desde el primer día o puedo esperar?',
                'a' => 'Cuanto antes definamos su régimen y su forma jurídica, menos corrige después. La '
                     . 'primera conversación es sin costo, así que no hay razón para esperar.',
            ],
        ],
    ],

    'empresas-extranjeras' => [
        'path'            => '/contador-para/empresas-extranjeras/',
        'navLabel'        => 'Empresas extranjeras',
        'seoTitle'        => 'Contador para inversores extranjeros',
        'metaDescription' => 'Contador para empresas e inversores extranjeros que abren en Paraguay: EAS '
                           . 'o SRL con socio no residente, RUC y remesas al exterior, de punta a punta.',
        'hero' => [
            'eyebrow' => 'Contador para',
            'h1'      => 'Contador para empresas extranjeras en Paraguay',
            'lead'    => 'Abrir una empresa desde afuera tiene un paso más que abrirla siendo residente: '
                       . 'representante legal, documentación consular y remesas que el fisco revisa '
                       . 'distinto. Lo llevamos de punta a punta.',
        ],
        'leadSlug' => 'eas',
        'bundle'   => ['eas', 'ruc', 'contabilidad'],
        'traps' => [
            [
                'title' => 'Constituir sin representante legal en Paraguay',
                'text'  => 'Una EAS o una SRL con socio extranjero necesita un representante legal '
                         . 'domiciliado en el país para los trámites ante la DNIT. Sin eso, la constitución '
                         . 'queda trabada.',
            ],
            [
                'title' => 'RUC como no residente sin la documentación consular exigida',
                'text'  => 'La DNIT pide documentación apostillada o legalizada por vía consular para '
                         . 'inscribir a un socio extranjero. Presentarla incompleta atrasa la apertura '
                         . 'semanas, no días.',
            ],
            [
                'title' => 'Remesas al exterior con retenciones mal calculadas',
                'text'  => 'Girar utilidades o pagos a la casa matriz en el exterior activa retenciones de '
                         . 'IRE que dependen del tipo de operación y del convenio (si existe) con el país de '
                         . 'destino. Calcularlas mal es un ajuste que aparece recién en una fiscalización.',
            ],
        ],
        'sections' => [],
        'weNeed' => [
            'Documentación de los socios, apostillada o legalizada según corresponda',
            'Datos del representante legal en Paraguay',
            'Plan de actividad y de remesas previsto para los primeros meses',
            'Contrato social o estatuto de la casa matriz, si ya existe',
        ],
        'faq' => [
            [
                'q' => '¿Un extranjero puede ser el único dueño de una EAS en Paraguay?',
                'a' => 'Sí, la EAS admite un accionista único sin importar su nacionalidad. Necesita sí un '
                     . 'representante legal domiciliado en el país para los trámites ante la DNIT.',
            ],
            [
                'q' => '¿Qué documentación consular necesito para inscribir el RUC?',
                'a' => 'Depende del país de origen y de si el socio es persona física o jurídica. Se lo '
                     . 'detallamos en la primera conversación para que no le falte nada al presentar.',
            ],
            [
                'q' => '¿Cómo se calculan las retenciones al remesar utilidades al exterior?',
                'a' => 'Depende del tipo de remesa y de si existe convenio para evitar la doble '
                     . 'tributación con el país de destino. Lo calculamos antes de cada giro, no después.',
            ],
        ],
    ],

    'cambiar-de-contador' => [
        'path'            => '/cambiar-de-contador/',
        'navLabel'        => '',
        'seoTitle'        => 'Cambiar de contador en Paraguay',
        'metaDescription' => 'Cómo cambiar de contador en Paraguay sin perder historial ni presentaciones: '
                           . 'qué le pedimos a su contador actual y el traspaso con fechas acordadas.',
        'hero' => [
            'eyebrow' => 'Cambiar de contador',
            'h1'      => 'Cambiar de contador, sin perder historial ni presentaciones',
            'lead'    => 'El traspaso es más simple de lo que parece: solicitamos su documentación al '
                       . 'contador actual, verificamos que esté al día ante la DNIT y continuamos desde '
                       . 'ahí, sin reiniciar el ejercicio.',
        ],
        'leadSlug' => 'contabilidad',
        'bundle'   => ['contabilidad', 'iva', 'ire-simple'],
        'traps'    => [],
        'sections' => [
            [
                'h2'   => 'Cómo funciona el traspaso',
                'body' => [
                    'Primero conversamos media hora para entender su situación actual: qué régimen '
                        . 'tiene, si sus presentaciones están al día y qué lo motiva a cambiar. No necesita '
                        . 'traer nada a esa primera conversación.',
                    'Con su autorización, solicitamos a su contador actual los libros, las declaraciones '
                        . 'presentadas y cualquier trámite pendiente. Es un pedido estándar entre '
                        . 'profesionales: no requiere que usted intervenga en el intercambio.',
                    'Verificamos que su empresa esté al día ante la DNIT y el IPS antes de asumir. Si '
                        . 'encontramos algo pendiente, se lo mostramos con claridad antes de continuar, no '
                        . 'después.',
                    'Le proponemos una fecha de traspaso acordada por escrito, normalmente coincidiendo '
                        . 'con el cierre de un período, para no dividir un mes entre dos contadores.',
                ],
            ],
        ],
        'weNeed' => [
            'Autorización simple para solicitar su documentación al contador actual',
            'Su RUC y el régimen en el que está inscripto',
            'Últimas declaraciones presentadas, si las tiene a mano',
            'Una fecha de corte de su preferencia, si ya tiene una en mente',
        ],
        'faq' => [
            [
                'q' => '¿Pierdo historial contable al cambiar de contador?',
                'a' => 'No, si el traspaso se hace bien: solicitamos sus libros y declaraciones presentadas '
                     . 'hasta la fecha y continuamos desde ahí, sin reiniciar el ejercicio.',
            ],
            [
                'q' => '¿Qué le pedimos exactamente a mi contador actual?',
                'a' => 'Los libros contables del ejercicio en curso, copia de las últimas declaraciones '
                     . 'presentadas (IVA, IRE o IRP según su régimen) y el estado de cualquier trámite '
                     . 'abierto ante la DNIT o el IPS.',
            ],
            [
                'q' => '¿En qué momento del mes conviene cambiar?',
                'a' => 'Lo ideal es coincidir con el cierre de un período (mensual o del ejercicio anual), '
                     . 'para no dividir declaraciones a mitad de camino. Le proponemos la fecha con usted.',
            ],
            [
                'q' => '¿Mi contador actual se entera de que estoy cambiando?',
                'a' => 'Sí: el pedido de documentación se hace a su nombre y con su autorización. Es un '
                     . 'trámite habitual entre profesionales, no una situación incómoda.',
            ],
        ],
    ],

];
