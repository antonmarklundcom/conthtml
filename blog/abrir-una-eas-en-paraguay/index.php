<?php
declare(strict_types=1);

require __DIR__ . '/../../lib/bootstrap.php';

$slug = 'abrir-una-eas-en-paraguay';

$sections = [
    [
        'h2'   => '¿Qué es una EAS y por qué eligen esta figura?',
        'body' => [
            'La Empresa por Acciones Simplificada (EAS) es una figura societaria pensada para constituirse '
                . 'de forma ágil y económica, con un solo socio si así se prefiere. A diferencia de otras '
                . 'estructuras tradicionales, permite separar el patrimonio personal del patrimonio de la '
                . 'empresa desde el primer día, sin exigir un capital mínimo por ley ni una escritura '
                . 'notarial extensa para su constitución.',
            'Es la opción que suele elegir un profesional independiente o un pequeño emprendimiento que '
                . 'quiere operar como empresa formal —emitir factura, contratar, abrir cuenta bancaria a '
                . 'nombre de la sociedad— sin pasar por el proceso más largo y costoso de una S.R.L. o una '
                . 'S.A. tradicional.',
        ],
    ],
    [
        'h2'   => 'El trámite: constitución digital por SUACE',
        'body' => [
            'La EAS se constituye a través del Sistema Unificado de Apertura y Cierre de Empresas (SUACE), '
                . 'que centraliza en un solo trámite digital pasos que antes requerían pasar por varias '
                . 'instituciones por separado.',
        ],
        'items' => [
            ['title' => '1. Reserva del nombre', 'text' => 'Se verifica que la denominación social elegida esté disponible antes de avanzar con el resto del trámite.'],
            ['title' => '2. Redacción de los estatutos', 'text' => 'Se define el objeto social, el capital y la estructura de administración de la empresa, adaptados a la actividad real que va a desarrollar.'],
            ['title' => '3. Constitución en SUACE', 'text' => 'El sistema unifica la inscripción societaria sin necesidad de una escritura notarial extensa ni de publicaciones en diarios físicos.'],
            ['title' => '4. Inscripción de RUC', 'text' => 'Una vez constituida la sociedad, se inscribe el RUC de la empresa ante la DNIT, requisito previo para poder facturar.'],
            ['title' => '5. Patente municipal y registro patronal', 'text' => 'Se completan la patente comercial ante la municipalidad correspondiente y, si va a tener empleados, el registro patronal ante el IPS.'],
        ],
    ],
    [
        'h2'   => 'Costos a tener en cuenta',
        'body' => [
            'El costo de abrir una EAS combina las tasas propias del trámite societario y de RUC, la '
                . 'patente municipal según el municipio y el rubro, y —si se contrata asesoría profesional— '
                . 'el honorario del estudio contable o legal que acompaña el proceso. No existe un capital '
                . 'mínimo exigido por ley para constituir la sociedad, lo que reduce la inversión inicial '
                . 'frente a otras figuras societarias.',
            'El costo real varía según la actividad, el municipio y si la empresa va a tener empleados '
                . 'desde el inicio (lo que suma el registro patronal ante el IPS y la cobertura patronal '
                . 'correspondiente). Conviene pedir una cotización a medida en lugar de guiarse por una '
                . 'cifra genérica, porque cada expediente tiene variables distintas.',
        ],
    ],
    [
        'h2'   => 'Plazos habituales',
        'body' => [
            'Al tratarse de un trámite centralizado y en gran parte digital, los plazos de una EAS suelen '
                . 'ser considerablemente más cortos que los de una constitución societaria tradicional. El '
                . 'tiempo real depende de que la documentación esté completa desde el inicio —cédula de '
                . 'identidad vigente, definición clara del objeto social y de la estructura de socios— y de '
                . 'los tiempos de respuesta de cada organismo involucrado.',
            'La causa más frecuente de demora no es el sistema en sí, sino expedientes que se presentan '
                . 'incompletos y vuelven observados: una descripción de actividad ambigua, datos '
                . 'inconsistentes entre documentos o un nombre societario que termina rechazado por no '
                . 'estar disponible.',
        ],
    ],
    [
        'h2'   => 'Errores frecuentes al abrir una EAS',
        'body' => [
            'El primero es no evaluar el régimen tributario antes de constituir: la EAS por sí sola no '
                . 'define si conviene tributar bajo Resimple, IRE Simple o IRE General, y elegir mal ese '
                . 'punto de partida obliga a recategorizarse después. El segundo es redactar un objeto '
                . 'social demasiado genérico o demasiado restrictivo, que después complica facturar '
                . 'actividades que la empresa efectivamente realiza.',
            'El tercero es subestimar las obligaciones que empiezan el mismo día de la constitución: desde '
                . 'ese momento la empresa tiene que presentar declaraciones aunque todavía no facture, y '
                . 'muchos emprendimientos recién constituidos se llevan la sorpresa de una declaración en '
                . 'cero atrasada por no saber que ya corría el plazo.',
        ],
    ],
    [
        'h2'   => 'Qué sigue después de constituir la empresa',
        'body' => [
            'Tener el RUC de la EAS inscripto es el punto de partida, no el final del trámite. En las '
                . 'semanas siguientes conviene definir el régimen tributario (Resimple, IRE Simple o IRE '
                . 'General, según la facturación proyectada), habilitarse para emitir factura si la '
                . 'actividad lo requiere, y —si va a tener empleados desde el día uno— completar el '
                . 'registro patronal ante el IPS antes de que empiece la relación laboral, no después.',
            'Una empresa recién constituida que ordena estos pasos desde el principio evita el escenario '
                . 'más común entre emprendimientos nuevos: descubrir meses después que quedó en el régimen '
                . 'equivocado, que nunca se habilitó correctamente para facturar, o que acumuló '
                . 'declaraciones en cero sin presentar porque nadie le avisó que la obligación ya corría '
                . 'desde la constitución.',
        ],
    ],
    [
        'h2'   => '¿EAS o S.R.L.? Cómo decidir',
        'body' => [
            'La pregunta que más se repite antes de constituir una empresa es si conviene una EAS o una '
                . 'S.R.L. tradicional. En términos generales, la EAS gana en velocidad y costo inicial '
                . 'cuando el emprendimiento tiene uno o pocos socios y busca empezar a operar rápido; la '
                . 'S.R.L. sigue siendo la opción habitual cuando hay varios socios con reglas societarias '
                . 'más complejas, o cuando el rubro o el cliente exigen específicamente esa figura.',
            'No es una decisión que convenga tomar solo por el costo del trámite: el régimen tributario '
                . 'que va a aplicar, la forma en que va a facturar y si va a necesitar financiamiento '
                . 'bancario en el corto plazo también entran en esa evaluación. Por eso la revisamos junto '
                . 'con cada cliente antes de iniciar la constitución, no después.',
        ],
    ],
];

$faq = [
    [
        'q' => '¿Necesito un socio para abrir una EAS?',
        'a' => 'No. La EAS permite constituirse con un solo socio, que puede ser el único dueño y aun así '
             . 'mantener el patrimonio de la empresa separado del patrimonio personal.',
    ],
    [
        'q' => '¿Hay un capital mínimo para constituir una EAS?',
        'a' => 'No existe un capital mínimo exigido por ley para esta figura, lo que reduce la inversión '
             . 'inicial frente a otras estructuras societarias.',
    ],
    [
        'q' => '¿Qué documentos necesito para empezar el trámite?',
        'a' => 'Su cédula de identidad vigente y una descripción clara de la actividad comercial que va a '
             . 'desarrollar. El resto del proceso —reserva del nombre, redacción de estatutos y '
             . 'constitución en SUACE— se coordina de forma remota.',
    ],
];

require ROOT_DIR . '/templates/article.php';
