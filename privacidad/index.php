<?php
require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/privacidad/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/privacidad/',
    'noindex'     => $meta['stub'],
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/privacidad/']],
];

require ROOT_DIR . '/templates/page-stub.php';
