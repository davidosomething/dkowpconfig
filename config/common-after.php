<?php
/**
 * DKO WordPress Configuration file
 * This file is included AFTER the environment specific config
 */

defined('WPLANG')   or define('WPLANG', '');

// turn on cache on prod config
defined('WP_CACHE') or define('WP_CACHE', false);

// use system cron instead
defined('DISABLE_WP_CRON') or define('DISABLE_WP_CRON', true);

// default to jetpack offline mode
defined('JETPACK_DEV_DEBUG') or define('JETPACK_DEV_DEBUG', true);

// Site URLs -- these should be manually set for Production
defined('DKO_CORE_FOLDER') or define('DKO_CORE_FOLDER', '/wp'); // name of folder WP is in
defined('WP_HOME')    or define('WP_HOME',    DKO_CONFIG_PROTOCOL . '//' . $_SERVER['SERVER_NAME']); // path to blog root
defined('WP_SITEURL') or define('WP_SITEURL', WP_HOME . DKO_CORE_FOLDER); // path to wordpress

defined('WP_CONTENT_DIR') or define('WP_CONTENT_DIR', dirname(__DIR__) . '/content');
defined('WP_CONTENT_URL') or define('WP_CONTENT_URL', WP_HOME . '/content');

defined('WP_PLUGIN_DIR')  or define('WP_PLUGIN_DIR', dirname(__DIR__) . '/plugins');
defined('WP_PLUGIN_URL')  or define('WP_PLUGIN_URL', WP_HOME . '/plugins');
defined('PLUGINDIR')      or define('PLUGINDIR', dirname(__DIR__) . '/plugins'); // compatibility

// Don't touch if WordPress lives in the wp folder
defined('ABSPATH') or define('ABSPATH', dirname(__DIR__) . DKO_CORE_FOLDER . '/');
require_once(ABSPATH . 'wp-settings.php');
