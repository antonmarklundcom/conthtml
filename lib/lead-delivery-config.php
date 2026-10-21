<?php
declare(strict_types=1);
require_once __DIR__ . '/lead-delivery.php';
$webRoot = dirname(__DIR__);
require_once $webRoot . '/lib/bootstrap.php';
$config = ['url'=>'', 'api_key'=>''];
try {
    $url = (string)cfg('VENDERCRM_URL', '');
    $url = preg_replace('~/api/v1/leads/?$~', '', rtrim($url,'/'));
    $config = ['url'=>$url, 'api_key'=>(string)cfg('VENDERCRM_API_KEY','')];
} catch(Throwable $error) { error_log('CRM settings invalid; enquiry remains pending privately.'); }
$config['site_domain'] = 'contador.com.py';
$config['outbox_dir'] = getenv('VENDERCRM_OUTBOX_DIR') ?: dirname($webRoot) . '/.vendercrm-outbox';
return new VenderCrmDelivery($config, $webRoot);
