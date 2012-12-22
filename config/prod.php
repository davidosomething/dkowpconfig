<?php
/**
 * Production environment configuration
 */

// Server
define('WP_MEMORY_LIMIT',     '128M');
define('SERVER_ENVIRONMENT',  'PROD');
define('FS_CHMOD_DIR',  02775); // setgid and ug+rw
define('FS_CHMOD_FILE', 0775);  // ug+rw

// Debugging
$debug_on = false;
define('WP_DEBUG',          $debugon);
define('SAVEQUERIES',       $debugon);
define('SCRIPT_DEBUG',      $debugon);
define('WP_DEBUG_LOG',      $debugon);
define('WP_DEBUG_DISPLAY',  !$debugon);
@ini_set('log_errors',      'Off');
@ini_set('display_errors',  'Off');

// Database
define('DB_NAME',     $_ENV['OPENSHIFT_APP_NAME']);
define('DB_USER',     $_ENV['OPENSHIFT_MYSQL_DB_USERNAME']);
define('DB_PASSWORD', $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD']);
define('DB_HOST',     $_ENV['OPENSHIFT_MYSQL_DB_HOST'] . ':' . $_ENV['OPENSHIFT_MYSQL_DB_PORT']);
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');
$table_prefix  = 'wp_';

// Site URLs -- these should be manually set for Production, local can fall
// back to common-after.php's version:
// define('WP_HOME',    DKO_CONFIG_PROTOCOL . '//' . $_SERVER['SERVER_NAME']); // path to blog root
// define('WP_SITEURL', WP_HOME . '/wp'); // path to wordpress

// Authentication Unique Keys and Salts.
// @link https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         'CHANGEME!!!');
define('SECURE_AUTH_KEY',  'CHANGEME!!!');
define('LOGGED_IN_KEY',    'CHANGEME!!!');
define('NONCE_KEY',        'CHANGEME!!!');
define('AUTH_SALT',        'CHANGEME!!!');
define('SECURE_AUTH_SALT', 'CHANGEME!!!');
define('LOGGED_IN_SALT',   'CHANGEME!!!');
define('NONCE_SALT',       'CHANGEME!!!');

// CMS settings
define('EMPTY_TRASH_DAYS',    0);
define('DISALLOW_FILE_EDIT',  true);
define('WP_POST_REVISIONS',   false);
define('DISALLOW_FILE_MODS',  true); // we deploy with git!

// This is where we define the OpenShift specific secure variable functions
// https://github.com/openshift/wordpress-example/blob/master/php/wp-config.php
require 'openshift.php'; // combined with openshift.inc
