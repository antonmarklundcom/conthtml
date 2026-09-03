<?php
require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/nosotros/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/nosotros/',
    'noindex'     => $meta['stub'],
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/nosotros/']],
];

require ROOT_DIR . '/templates/page-stub.php';
