<?php
/**
 * DKO WordPress Configuration file
 * This file is included AFTER the environment specific config
 */

// Site URLs -- these should be manually set for Production
if (!defined('WP_HOME')) define('WP_HOME',    DKO_CONFIG_PROTOCOL . '//' . $_SERVER['SERVER_NAME']); // path to blog root
if (!defined('WP_SITEURL')) define('WP_SITEURL', WP_HOME . '/wp'); // path to wordpress

if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', dirname(__DIR__) . '/content');
if (!defined('WP_CONTENT_URL')) define('WP_CONTENT_URL', WP_HOME . '/content');

if (!defined('WP_PLUGIN_DIR')) define('WP_PLUGIN_DIR', dirname(__DIR__) . '/plugins');
if (!defined('WP_PLUGIN_URL')) define('WP_PLUGIN_URL', WP_HOME . '/plugins');
if (!defined('PLUGINDIR')) define('PLUGINDIR', dirname(__DIR__) . '/plugins'); // compatibility

define('WPLANG', '');
if (!defined('ABSPATH')) define('ABSPATH', dirname(__DIR__) . '/wp/');
require_once(ABSPATH . 'wp-settings.php');
