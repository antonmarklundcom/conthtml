# Private VenderCRM settings

Place a PHP file at parent(actual public root)/private/vendercrm.php returning an array with VENDERCRM_URL (HTTPS base origin) and VENDERCRM_API_KEY. Keep this file outside the public root and all deployment archives. Optional VENDERCRM_CONFIG_FILE selects an absolute file outside the public root.

A valid shared private file takes precedence over canonical environment variables, legacy VCRM_ENDPOINT/VCRM_SITE_KEY aliases, and config.crm.php. Invalid shared settings disable CRM forwarding and leave other site settings and existing email behavior unchanged. When no shared file exists, the existing environment/root configuration remains supported.

Deploy repository source separately. Confirm the actual public root and PHP read permissions before creating the private file; deployment and live CRM delivery remain unverified.
