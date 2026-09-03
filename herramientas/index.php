<?php
require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/herramientas/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/herramientas/',
    'noindex'     => $meta['stub'],
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/herramientas/']],
];

require ROOT_DIR . '/templates/page-stub.php';
