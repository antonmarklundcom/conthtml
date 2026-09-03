<?php
/**
 * The static (non-service) pages, keyed by path. Services live in
 * content/services.php; this is everything else with a URL of its own.
 *
 *   title        string  <title> without the ' | Contador.com.py' suffix
 *   description  string  120–155 chars, unique across the whole site
 *   h1           string  visible heading
 *   lead         string  one-line intro under the H1
 *   stub         bool    true while the page is still an A1 placeholder: it
 *                        renders through templates/page-stub.php, is marked
 *                        noindex and stays out of sitemap.php. The phase that
 *                        writes the page sets this to false.
 *   changefreq   string  sitemap hint
 *   priority     string  sitemap hint
 *
 * B2 writes /nosotros/, /precios/, /blog/, /privacidad/ and /terminos/;
 * B3 writes /herramientas/. Each flips its own 'stub' to false.
 */

declare(strict_types=1);

return [
    '/' => [
        'title'       => 'Estudio contable en Asunción, Paraguay',
        'description' => 'Estudio contable en Asunción: contabilidad mensual, IVA e IRE, nómina e IPS, '
                       . 'apertura de empresas y facturación electrónica en SIFEN para pymes.',
        'h1'          => '',
        'lead'        => '',
        'stub'        => false,
        'changefreq'  => 'weekly',
        'priority'    => '1.0',
    ],

    '/servicios/' => [
        'title'       => 'Servicios contables en Paraguay',
        'description' => 'Todos nuestros servicios: contabilidad mensual, impuestos, nómina e IPS, '
                       . 'apertura de empresas, facturación electrónica y auditoría.',
        'h1'          => '',
        'lead'        => '',
        'stub'        => false,
        'changefreq'  => 'monthly',
        'priority'    => '0.9',
    ],

    '/contacto/' => [
        'title'       => 'Contacto',
        'description' => 'Escríbanos por WhatsApp o déjenos sus datos: le respondemos dentro del '
                       . 'siguiente día hábil con una propuesta concreta para su empresa.',
        'h1'          => '',
        'lead'        => '',
        'stub'        => false,
        'changefreq'  => 'yearly',
        'priority'    => '0.8',
    ],

    // --- still placeholders in A1 -------------------------------------------

    '/nosotros/' => [
        'title'       => 'Nosotros',
        'description' => 'Quiénes somos: contadores públicos matriculados que trabajan con procesos '
                       . 'digitales y explican los impuestos en lenguaje claro.',
        'h1'          => 'Nosotros',
        'lead'        => 'Contadores públicos matriculados, con procesos digitales y trato directo.',
        'stub'        => true,
        'changefreq'  => 'yearly',
        'priority'    => '0.6',
    ],

    '/precios/' => [
        'title'       => 'Precios y planes',
        'description' => 'Planes de honorarios mensuales para unipersonales, pymes y empresas, con el '
                       . 'alcance de cada uno y cotización a medida en 48 horas.',
        'h1'          => 'Precios',
        'lead'        => 'Honorario mensual fijo, con el alcance definido por escrito antes de empezar.',
        'stub'        => true,
        'changefreq'  => 'monthly',
        'priority'    => '0.7',
    ],

    '/herramientas/' => [
        'title'       => 'Herramientas y calculadoras',
        'description' => 'Calculadoras y guías gratuitas: aguinaldo, liquidación de salario, IVA y el '
                       . 'calendario de vencimientos de la DNIT según su terminación de RUC.',
        'h1'          => 'Herramientas',
        'lead'        => 'Calculadoras gratuitas para resolver las cuentas más frecuentes.',
        'stub'        => true,
        'changefreq'  => 'monthly',
        'priority'    => '0.7',
    ],

    '/blog/' => [
        'title'       => 'Blog',
        'description' => 'Guías prácticas sobre impuestos, nómina y facturación electrónica en Paraguay, '
                       . 'escritas por contadores y actualizadas con la normativa vigente.',
        'h1'          => 'Blog',
        'lead'        => 'Guías prácticas sobre impuestos, nómina y facturación electrónica.',
        'stub'        => true,
        'changefreq'  => 'weekly',
        'priority'    => '0.6',
    ],

    '/privacidad/' => [
        'title'       => 'Política de privacidad',
        'description' => 'Cómo tratamos sus datos personales y las credenciales tributarias que nos '
                       . 'confía, y cómo puede solicitar su acceso, corrección o eliminación.',
        'h1'          => 'Política de privacidad',
        'lead'        => 'Cómo tratamos sus datos personales y sus credenciales tributarias.',
        'stub'        => true,
        'changefreq'  => 'yearly',
        'priority'    => '0.3',
    ],

    '/terminos/' => [
        'title'       => 'Términos de servicio',
        'description' => 'Condiciones bajo las que prestamos nuestros servicios contables: alcance, '
                       . 'plazos, responsabilidades de cada parte y secreto profesional.',
        'h1'          => 'Términos de servicio',
        'lead'        => 'Condiciones bajo las que prestamos nuestros servicios contables.',
        'stub'        => true,
        'changefreq'  => 'yearly',
        'priority'    => '0.3',
    ],
];
