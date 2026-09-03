<?php
require __DIR__ . '/../lib/bootstrap.php';

$meta = page_meta('/blog/');
$page = [
    'title'       => $meta['title'],
    'description' => $meta['description'],
    'path'        => '/blog/',
    'noindex'     => $meta['stub'],
    'breadcrumbs' => [['label' => $meta['h1'], 'path' => '/blog/']],
];

require ROOT_DIR . '/templates/page-stub.php';
