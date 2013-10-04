<?php
/**
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

// Development
define('JETPACK_DEV_DEBUG', true);

////////////////////////////////////////////////////////////////////////////////
// For all of the following:
// Ideally you should be using getenv() to read these values from the
// server environment.
// e.g. add to bash:
// export MYSITE_WP_DB_NAME="mywpdb"
// and here:
// define('DB_NAME', getenv('MYSITE_WP_DB_NAME'));

// Database
define('DB_NAME',     '');
define('DB_USER',     '');
define('DB_PASSWORD', '');
define('DB_HOST',     'localhost');

// API Keys
