<?php
/**
 * DKO WordPress Configuration file
 * This file is included AFTER the environment specific config
 */

// Auth Keys
// DO THIS! Adds an extra security layer since if DB gets hacked at least your
// login salts (and user passwords) will be safe.
// https://api.wordpress.org/secret-key/1.1/salt/
defined('AUTH_KEY')         or define('AUTH_KEY',         'put your unique phrase here');
defined('SECURE_AUTH_KEY')  or define('SECURE_AUTH_KEY',  'put your unique phrase here');
defined('LOGGED_IN_KEY')    or define('LOGGED_IN_KEY',    'put your unique phrase here');
defined('NONCE_KEY')        or define('NONCE_KEY',        'put your unique phrase here');
defined('AUTH_SALT')        or define('AUTH_SALT',        'put your unique phrase here');
defined('SECURE_AUTH_SALT') or define('SECURE_AUTH_SALT', 'put your unique phrase here');
defined('LOGGED_IN_SALT')   or define('LOGGED_IN_SALT',   'put your unique phrase here');
defined('NONCE_SALT')       or define('NONCE_SALT',       'put your unique phrase here');

defined('WPLANG')   or define('WPLANG', '');

// turn on cache on prod config
defined('WP_CACHE') or define('WP_CACHE', false);

// use system cron instead
defined('DISABLE_WP_CRON') or define('DISABLE_WP_CRON', true);

// default to jetpack offline mode
defined('JETPACK_DEV_DEBUG') or define('JETPACK_DEV_DEBUG', true);

// Site URLs -- these should be manually set for Production
defined('DKO_SITE_DIR')     or define('DKO_SITE_DIR', dirname(__DIR__)); // path of folder site begins
defined('DKO_CORE_FOLDER')  or define('DKO_CORE_FOLDER', '/wp');         // path of folder WP is in
defined('WP_HOME')    or define('WP_HOME',    DKO_CONFIG_PROTOCOL . '//' . $_SERVER['SERVER_NAME']); // path to blog root
defined('WP_SITEURL') or define('WP_SITEURL', WP_HOME . DKO_CORE_FOLDER); // path to wordpress

defined('WP_CONTENT_DIR') or define('WP_CONTENT_DIR', DKO_SITE_DIR . '/content');
defined('WP_CONTENT_URL') or define('WP_CONTENT_URL', WP_HOME . '/content');

// support symlinked plugins folders -- some plugins may still have problems if
// they aren't using WordPress constants though
if (is_link(dirname(__DIR__) . '/plugins')) {
  defined('WP_PLUGIN_DIR')  or define('WP_PLUGIN_DIR', realpath(DKO_SITE_DIR . '/plugins'));
  defined('PLUGINDIR')      or define('PLUGINDIR', realpath(DKO_SITE_DIR . '/plugins')); // compatibility
}
else {
  defined('WP_PLUGIN_DIR')  or define('WP_PLUGIN_DIR', DKO_SITE_DIR . '/plugins');
  defined('PLUGINDIR')      or define('PLUGINDIR', DKO_SITE_DIR . '/plugins'); // compatibility
}
defined('WP_PLUGIN_URL') or define('WP_PLUGIN_URL', WP_HOME . '/plugins');
