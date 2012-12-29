<?php
/**
 * Local environment configuration
 */

// Server
define('WP_MEMORY_LIMIT',     '128M');
define('SERVER_ENVIRONMENT',  'DEV');
define('FS_CHMOD_DIR',  02775); // setgid and ug+rw
define('FS_CHMOD_FILE', 0775);  // ug+rw

// Debugging
$debug_on = true; $debug_on_string = $debug_on ? 'On' : 'Off';
define('WP_DEBUG',          $debugon);
define('SAVEQUERIES',       $debugon);
define('SCRIPT_DEBUG',      $debugon);
define('WP_DEBUG_LOG',      $debugon);
define('WP_DEBUG_DISPLAY',  !$debugon);
@ini_set('log_errors',      $debug_on_string);
@ini_set('display_errors',  $debug_on_string);

// Database
define('DB_NAME',     '');
define('DB_USER',     '');
define('DB_PASSWORD', '');
define('DB_HOST',     'localhost');
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');
$table_prefix  = 'wp_';

// Site URLs
define('WP_HOME',    DKO_CONFIG_PROTOCOL . '//' . $_SERVER['SERVER_NAME']); // path to blog root
define('WP_SITEURL', WP_HOME . '/wp'); // path to wordpress

// CMS settings
define('EMPTY_TRASH_DAYS',    0);
define('DISALLOW_FILE_EDIT',  true);
define('WP_POST_REVISIONS',   false);

// Authentication Unique Keys and Salts.
// @link https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         'always regenerate these!');
define('SECURE_AUTH_KEY',  'always regenerate these!');
define('LOGGED_IN_KEY',    'always regenerate these!');
define('NONCE_KEY',        'always regenerate these!');
define('AUTH_SALT',        'always regenerate these!');
define('SECURE_AUTH_SALT', 'always regenerate these!');
define('LOGGED_IN_SALT',   'always regenerate these!');
define('NONCE_SALT',       'always regenerate these!');
