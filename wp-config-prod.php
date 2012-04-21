<?php
/**
 * wp-config-prod.php
 * Production configuration - DON'T VERSION THIS
 */
define('SERVER_ENVIRONMENT', 'PROD');

define('WP_DEBUG',      false);
define('SAVEQUERIES',   false);
define('SCRIPT_DEBUG',  false);

define('DB_NAME',     'REPLACEME');
define('DB_USER',     'REPLACEME');
define('DB_PASSWORD', 'REPLACEME');
define('DB_HOST',     'localhost');
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');

define('WP_SITEURL', $protocol . $_SERVER['SERVER_NAME']); // path to wordpress
define('WP_HOME',    $protocol . $_SERVER['SERVER_NAME']); // path to blog root
// define('WP_MEMORY_LIMIT', '128M');
