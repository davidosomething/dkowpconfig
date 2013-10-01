<?php
/**
 * Local environment configuration
 *
 * Remove values from common-before.php if you want them to be config specific.
 */

// Server
define('SERVER_ENVIRONMENT',  'LOCAL');

// Filesystem
define('FS_METHOD',     'direct');
define('FS_CHMOD_DIR',  02775); // setgid and ug+rw
define('FS_CHMOD_FILE', 0664);  // ug+rw

// Debugging
define('WP_DEBUG',          true);
define('SAVEQUERIES',       true);
define('WP_DEBUG_LOG',      true);
@ini_set('log_errors',      'On');
define('WP_DEBUG_DISPLAY',  true);
@ini_set('display_errors',  'On');
define('SCRIPT_DEBUG',      false);

// Database
define('DB_NAME',     '');
define('DB_USER',     '');
define('DB_PASSWORD', '');
define('DB_HOST',     'localhost');

// Development
define('JETPACK_DEV_DEBUG', true);

// API Keys
