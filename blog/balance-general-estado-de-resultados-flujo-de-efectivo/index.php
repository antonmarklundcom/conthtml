<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'balance-general-estado-de-resultados-flujo-de-efectivo';

$sections = [
    [
        'h2'   => 'Tres estados, tres preguntas distintas',
        'body' => [
            'Muchos dueños de empresa reciben sus estados financieros todos los meses y los archivan sin '
                . 'leerlos a fondo, porque a simple vista parecen tres versiones de la misma información. '
                . 'No lo son: el balance general, el estado de resultados y el flujo de efectivo responden '
                . 'a tres preguntas distintas, y leerlos juntos —no cada uno por separado— es lo que da una '
                . 'foto real de la salud financiera de la empresa.',
            'Esta guía explica qué muestra cada uno, cómo se relacionan entre sí, y por qué una empresa '
                . 'puede tener ganancias en el papel y aun así quedarse sin efectivo para pagar sus '
                . 'obligaciones del mes.',
        ],
    ],
    [
        'h2'   => 'Balance general: qué tiene la empresa y qué debe',
        'body' => [
            'El balance general es una fotografía de la empresa en un momento puntual —por ejemplo, al '
                . 'cierre del mes o del ejercicio— que responde a la pregunta "¿qué tiene y qué debe la '
                . 'empresa hoy?". Se ordena en tres bloques: el activo (todo lo que la empresa posee, desde '
                . 'el efectivo en caja hasta sus cuentas por cobrar y sus bienes), el pasivo (todo lo que '
                . 'debe a terceros, como proveedores, préstamos y obligaciones fiscales) y el patrimonio '
                . '(lo que queda para los socios una vez descontado el pasivo del activo).',
            'La relación entre los tres bloques es siempre la misma: activo es igual a pasivo más '
                . 'patrimonio. Si esa ecuación no cierra, hay un error en la contabilidad que se arrastra '
                . 'de algún registro anterior, y conviene detectarlo antes de que se acumule mes tras mes.',
        ],
    ],
    [
        'h2'   => 'Estado de resultados: si la empresa ganó o perdió en el período',
        'body' => [
            'El estado de resultados —también llamado estado de pérdidas y ganancias— responde a una '
                . 'pregunta distinta: "¿la empresa ganó o perdió dinero durante el mes o el año?". Parte de '
                . 'los ingresos por ventas, resta los costos directos de esas ventas y los gastos operativos '
                . 'del período, y llega a un resultado neto: ganancia o pérdida.',
            'A diferencia del balance, que es una fotografía de un instante, el estado de resultados es una '
                . 'película de un período completo. Por eso dos empresas con el mismo balance al cierre de '
                . 'diciembre pueden haber tenido trayectorias muy distintas durante el año: una puede haber '
                . 'llegado ahí después de un año parejo, y la otra después de un primer semestre en pérdida '
                . 'y una recuperación fuerte en el segundo.',
        ],
    ],
    [
        'h2'   => 'Flujo de efectivo: por qué se puede ganar y aun así no tener plata',
        'body' => [
            'El flujo de efectivo es, para la mayoría de las pymes, el estado más importante del día a día '
                . 'y el menos mirado. Responde a la pregunta "¿de dónde entró y hacia dónde salió el '
                . 'efectivo real de la empresa?", separando los movimientos de las actividades operativas, '
                . 'de inversión y de financiamiento.',
            'Es perfectamente posible que una empresa muestre ganancia en su estado de resultados y aun así '
                . 'se quede sin efectivo para pagar sueldos o proveedores en un mes puntual. Esto ocurre '
                . 'cuando las ventas se registran como ingreso apenas se facturan, pero el cliente todavía '
                . 'no pagó: la ganancia contable ya está registrada, pero el efectivo todavía no entró a la '
                . 'cuenta de la empresa. El flujo de efectivo es el estado que expone ese desfase antes de '
                . 'que se convierta en un problema de caja.',
        ],
    ],
    [
        'h2'   => 'Cómo leerlos juntos, en la práctica',
        'body' => [
            'Un dueño de empresa que quiere entender su negocio en cinco minutos por mes puede hacerse tres '
                . 'preguntas en orden: primero, según el estado de resultados, ¿el mes cerró en ganancia o '
                . 'en pérdida? Segundo, según el flujo de efectivo, ¿esa ganancia (o pérdida) se tradujo en '
                . 'efectivo real disponible en la cuenta, o quedó principalmente en cuentas por cobrar? '
                . 'Tercero, según el balance general, ¿cómo quedó la posición general de la empresa después '
                . 'de ese mes: más sólida, más endeudada, o igual?',
            'Ninguno de los tres estados por separado da esa respuesta completa. Un informe mensual útil no '
                . 'es una planilla con números sueltos: es la lectura conjunta de los tres, en lenguaje '
                . 'simple, para que la decisión sobre el mes siguiente se tome con el número por delante y '
                . 'no meses después, cuando ya es tarde para corregir el rumbo.',
        ],
    ],
    [
        'h2'   => 'Cuándo pedir ayuda profesional para leerlos',
        'body' => [
            'Muchas pymes en Paraguay reciben sus tres estados financieros como un requisito para un '
                . 'trámite —una declaración de IRE General, una presentación bancaria— y nunca los usan '
                . 'como herramienta de gestión durante el año. La diferencia entre una empresa que crece '
                . 'de forma ordenada y una que se sorprende con un problema de caja suele estar, '
                . 'precisamente, en si alguien revisó estos tres estados juntos cada mes o si solo se '
                . 'armaron una vez al año para cumplir con la DNIT.',
            'Nuestro informe mensual entrega estos tres estados en lenguaje claro, con las alertas que '
                . 'importan —una caída en el margen, un flujo de efectivo negativo dos meses seguidos, un '
                . 'pasivo que crece más rápido que el activo— resaltadas en lugar de escondidas en una '
                . 'planilla de cien filas. Es la diferencia entre recibir un documento contable y recibir '
                . 'información que efectivamente sirve para decidir.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Cuál es la diferencia entre el balance general y el estado de resultados?',
        'a' => 'El balance general es una fotografía de lo que la empresa tiene y debe en un momento '
             . 'puntual. El estado de resultados muestra si ganó o perdió dinero durante un período '
             . 'completo, como un mes o un año.',
    ],
    [
        'q' => '¿Por qué mi empresa gana dinero pero no tiene efectivo disponible?',
        'a' => 'Suele ocurrir cuando las ventas se registran como ingreso al facturarse, pero el cliente '
             . 'todavía no pagó. El estado de resultados ya muestra la ganancia, mientras que el flujo de '
             . 'efectivo revela que ese dinero todavía no entró a la cuenta.',
    ],
    [
        'q' => '¿Con qué frecuencia debería revisar estos tres estados?',
        'a' => 'Idealmente todos los meses, junto con el cierre contable. Revisarlos solo una vez al año '
             . 'suele significar detectar un problema de caja o de rentabilidad varios meses después de que '
             . 'empezó.',
    ],
];

require ROOT_DIR . '/templates/article.php';
