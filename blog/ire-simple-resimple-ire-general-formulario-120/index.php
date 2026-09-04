<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'ire-simple-resimple-ire-general-formulario-120';

$sections = [
    [
        'h2'   => 'Tres regímenes, un mismo impuesto',
        'body' => [
            'El Impuesto a la Renta Empresarial (IRE) grava las ganancias de toda actividad comercial, '
                . 'industrial o de servicios en Paraguay, pero no se liquida de la misma forma para todos. '
                . 'La ley organiza a los contribuyentes en tres regímenes —Resimple, IRE Simple e IRE '
                . 'General— según su nivel de facturación anual, y cada uno cambia tanto el impuesto que '
                . 'se paga como la carga administrativa mensual que la empresa asume.',
            'Elegir el régimen equivocado, o no darse cuenta de que su facturación ya superó el tope del '
                . 'régimen en el que está inscripto, es uno de los motivos más frecuentes de recategorización '
                . 'de oficio por parte de la DNIT, con el recálculo retroactivo del impuesto que eso implica.',
        ],
    ],
    [
        'h2'   => 'Resimple: para facturación baja y estable',
        'body' => [
            'El Resimple está pensado para contribuyentes que facturan hasta Gs. 80.000.000 al año. Se '
                . 'paga una cuota fija mensual según una escala, sin necesidad de llevar contabilidad '
                . 'completa ni presentar balances. Es el régimen más simple de administrar, y conviene a '
                . 'quien tiene una facturación baja y previsible.',
            'Su límite es justamente ese: si la facturación crece y supera el tope anual, el contribuyente '
                . 'sale del régimen automáticamente y debe recategorizarse, con las obligaciones —y el '
                . 'impuesto— del régimen que le corresponda a partir de ese momento.',
        ],
    ],
    [
        'h2'   => 'IRE Simple: se paga sobre la ganancia real',
        'body' => [
            'El IRE Simple aplica a quienes facturan hasta Gs. 2.000.000.000 al año. A diferencia del '
                . 'Resimple, aquí el impuesto se calcula sobre la ganancia real del ejercicio —ingresos '
                . 'menos gastos deducibles— y no sobre una cuota fija. Esto exige llevar el libro de ventas '
                . 'y compras al día durante todo el año, porque de ahí sale la base imponible que después '
                . 'se declara.',
            'La ventaja de este régimen es que, si la empresa tiene gastos deducibles importantes, el '
                . 'impuesto termina siendo proporcional a la ganancia efectiva y no a un monto fijo '
                . 'desconectado del resultado real del negocio.',
        ],
    ],
    [
        'h2'   => 'IRE General: contabilidad completa y balance formal',
        'body' => [
            'El IRE General es el régimen para empresas que superan el tope del IRE Simple, o que por su '
                . 'estructura societaria están obligadas a llevar contabilidad completa desde el inicio '
                . '—como ocurre, en general, con las sociedades anónimas y las S.R.L. de cierto tamaño. '
                . 'Requiere balance general y estado de resultados formales, preparados según las normas '
                . 'contables vigentes.',
            'Pasar de IRE Simple a IRE General no es solo un cambio de casillero: implica ordenar la '
                . 'contabilidad con un criterio distinto desde el primer día del ejercicio, no a último '
                . 'momento cuando ya se superó el tope. Por eso conviene proyectar la facturación con '
                . 'tiempo, en lugar de reaccionar cuando la DNIT ya recategorizó de oficio.',
        ],
    ],
    [
        'h2'   => 'El Formulario 120: cuándo y cómo se presenta',
        'body' => [
            'Sea cual sea el régimen, la liquidación anual del IRE se presenta en Marangatu a través del '
                . 'Formulario 120, con base en los libros y comprobantes del ejercicio. El plazo de '
                . 'presentación cae dentro de los primeros meses del año siguiente al cierre del ejercicio, '
                . 'y la fecha exacta depende de la terminación numérica del RUC del contribuyente.',
            'No presentar el Formulario 120 dentro de plazo genera multas automáticas y bloquea el '
                . 'Certificado de Cumplimiento Tributario de la empresa, lo que en la práctica le impide '
                . 'operar con normalidad frente a bancos, proveedores y licitaciones públicas hasta '
                . 'regularizar la situación.',
        ],
    ],
    [
        'h2'   => 'Cómo saber en qué régimen está y si le conviene cambiar',
        'body' => [
            'La forma más confiable de saber en qué régimen corresponde estar es proyectar la facturación '
                . 'del ejercicio en curso contra los topes de cada régimen, y revisar esa proyección varias '
                . 'veces al año, no solo al momento de inscribirse. Una empresa que crece rápido puede '
                . 'acercarse al tope de su régimen actual sin que nadie lo note hasta que la DNIT recategoriza '
                . 'de oficio, con el recálculo retroactivo del impuesto que eso trae.',
            'Revisamos la facturación proyectada de cada cliente contra los tres regímenes, confirmamos '
                . 'cuál corresponde y liquidamos el Formulario 120 dentro del plazo, para que el cambio de '
                . 'régimen —si llega— sea una decisión planificada y no una sorpresa de la DNIT.',
        ],
    ],
    [
        'h2'   => 'Documentación que necesita tener ordenada',
        'body' => [
            'Sea cual sea el régimen, la liquidación del IRE depende de que la documentación del ejercicio '
                . 'esté completa y ordenada, no solo al momento de presentar el Formulario 120.',
        ],
        'items' => [
            ['title' => 'Libro de ventas y compras', 'text' => 'Con todos los comprobantes del ejercicio cargados y conciliados, mes a mes y no de golpe en enero del año siguiente.'],
            ['title' => 'Comprobantes de gastos deducibles', 'text' => 'Con factura legal a nombre de la empresa y RUC del proveedor, requisito para que un gasto reduzca la base imponible.'],
            ['title' => 'Estados financieros del ejercicio', 'text' => 'Balance general y estado de resultados, obligatorios en IRE General y recomendables incluso en IRE Simple para tener una base sólida.'],
            ['title' => 'Notificaciones previas de la DNIT', 'text' => 'Cualquier observación o requerimiento anterior del organismo, que puede afectar cómo se presenta la declaración de este ejercicio.'],
        ],
    ],
    [
        'h2'   => 'Por qué conviene revisar el régimen antes de fin de año',
        'body' => [
            'Muchos contribuyentes revisan su régimen de IRE una sola vez, al inscribirse, y no vuelven a '
                . 'compararlo con su facturación real hasta que la DNIT los recategoriza de oficio. Ese '
                . 'orden invertido es lo que convierte un cambio de régimen —algo previsible si la empresa '
                . 'está creciendo— en una sorpresa administrativa con recálculo retroactivo.',
            'Revisar la facturación proyectada del ejercicio en curso al menos dos veces al año, no solo '
                . 'en el mes de la inscripción, es la forma más simple de anticipar el cambio de régimen '
                . 'antes de que ocurra de oficio y de llegar al cierre del ejercicio sabiendo con certeza '
                . 'qué Formulario 120 corresponde presentar.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Cuál es la diferencia real entre IRE Simple y Resimple?',
        'a' => 'El Resimple es para quienes facturan hasta Gs. 80.000.000 anuales y pagan una cuota fija '
             . 'mensual. El IRE Simple es para quienes facturan hasta Gs. 2.000.000.000 y pagan sobre su '
             . 'ganancia real. Conviene revisar sus números concretos para confirmar en cuál encaja mejor.',
    ],
    [
        'q' => '¿Qué pasa si mi facturación supera el tope de mi régimen a mitad de año?',
        'a' => 'La DNIT puede recategorizarlo de oficio en cuanto detecta que superó el tope, con el ajuste '
             . 'retroactivo del impuesto correspondiente. Proyectar la facturación con anticipación permite '
             . 'anticipar el cambio de régimen antes de que ocurra de oficio.',
    ],
    [
        'q' => '¿Cuándo se presenta el Formulario 120 del IRE?',
        'a' => 'El plazo cae dentro de los primeros meses del año siguiente al cierre del ejercicio, y la '
             . 'fecha exacta depende de la terminación del RUC de cada contribuyente. Se confirma con el '
             . 'calendario que publica la DNIT cada año.',
    ],
];

require ROOT_DIR . '/templates/article.php';
