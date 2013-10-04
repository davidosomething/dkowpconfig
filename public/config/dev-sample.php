<?php
/**
 * Remove values from common-before.php if you want them to be config specific.
 */
// Server
define('SERVER_ENVIRONMENT',  'DEV');
// define('WP_MEMORY_LIMIT',     '128M');

// Debugging
define('WP_DEBUG',          true);
define('SAVEQUERIES',       true);
define('WP_DEBUG_LOG',      true);
@ini_set('log_errors',      true);
define('WP_DEBUG_DISPLAY',  false);
@ini_set('display_errors',  false);
define('SCRIPT_DEBUG',      false);

////////////////////////////////////////////////////////////////////////////////
// For all of the following:
// Ideally you should be using getenv() to read these values from the
// server environment.

// Database
define('DB_NAME',     '');
define('DB_USER',     '');
define('DB_PASSWORD', '');
define('DB_HOST',     'localhost');

// API Keys
