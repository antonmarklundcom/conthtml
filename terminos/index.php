<?php
require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/terminos/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/terminos/',
    'noindex'     => $meta['stub'],
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/terminos/']],
];

require ROOT_DIR . '/templates/page-stub.php';
