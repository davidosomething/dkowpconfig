<?php
/**
 * Development environment configuration
 *
 * Remove values from common-before.php if you want them to be config specific.
 */

// Server
define('WP_MEMORY_LIMIT',     '128M');
define('SERVER_ENVIRONMENT',  'DEV');

// Debugging
define('WP_DEBUG',          true);
define('SAVEQUERIES',       true);
define('WP_DEBUG_LOG',      true);
@ini_set('log_errors',      true);
define('WP_DEBUG_DISPLAY',  false);
@ini_set('display_errors',  false);
define('SCRIPT_DEBUG',      false);

// Database
define('DB_NAME',     '');
define('DB_USER',     '');
define('DB_PASSWORD', '');
define('DB_HOST',     'localhost');

// CMS settings
define('EMPTY_TRASH_DAYS',    0);
define('WP_POST_REVISIONS',   false);

// API Keys
