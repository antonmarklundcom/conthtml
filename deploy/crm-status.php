<?php
/** Private CLI diagnostic; never prints credentials or enquiry data. */
declare(strict_types=1);
if (PHP_SAPI !== 'cli') { http_response_code(404); exit; }
require __DIR__ . '/../lib/bootstrap.php';
$endpoint = crm_endpoint();
$key = cfg('VENDERCRM_API_KEY');
$status = [
    'endpoint_valid' => $endpoint !== null,
    'site_key_present' => $key !== null,
    'curl_available' => function_exists('curl_init'),
    'crm_private_file_present' => is_file(ROOT_DIR . '/config.crm.php'),
    'ga4_configured' => cfg('GA4_ID') !== null,
    'ads_configured' => cfg('ADS_ID') !== null,
    'email_configured' => cfg('RESEND_API_KEY') !== null && cfg('LEAD_NOTIFY_TO') !== null && cfg('LEAD_FROM') !== null,
];
if (in_array('--check-auth', $argv, true) && $endpoint !== null && $key !== null && function_exists('curl_init')) {
    // Missing phone/key fields make this a validation probe, never a test contact.
    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10, CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'X-Api-Key: ' . $key],
        CURLOPT_POSTFIELDS => '{}']);
    curl_exec($ch);
    $status['auth_probe_http'] = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $status['auth_probe_note'] = '422 is the expected validation rejection; contact/deal delivery still needs a controlled round trip.';
    curl_close($ch);
}
echo json_encode($status, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";
exit($endpoint !== null && $key !== null && function_exists('curl_init') ? 0 : 1);
