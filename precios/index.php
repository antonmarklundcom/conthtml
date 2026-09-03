<?php
require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/precios/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/precios/',
    'noindex'     => $meta['stub'],
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/precios/']],
];

require ROOT_DIR . '/templates/page-stub.php';
