<?php
/**
 * wp-config-dev.php
 * Development configuration - DELETE THIS FILE ON PRODUCTION!
 */
define('SERVER_ENVIRONMENT', 'DEV');

define('WP_DEBUG',      true);
define('SAVEQUERIES',   true);
define('SCRIPT_DEBUG',  true);

define('DB_NAME',     'REPLACEME');
define('DB_USER',     'REPLACEME');
define('DB_PASSWORD', 'REPLACEME');
define('DB_HOST',     'localhost');
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');

define('WP_SITEURL', $protocol . $_SERVER['SERVER_NAME']); // path to wordpress
define('WP_HOME',    $protocol . $_SERVER['SERVER_NAME']); // path to blog root
define('WP_MEMORY_LIMIT', '128M');
