<?php
/**
 * DKO WordPress Configuration file
 * This file is included AFTER the environment specific config
 */

if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', DKO_SITE_DIR . '/content');
if (!defined('WP_CONTENT_URL')) define('WP_CONTENT_URL', WP_HOME . '/content');

if (!defined('WP_PLUGIN_DIR')) define('WP_PLUGIN_DIR', DKO_SITE_DIR . '/plugins');
if (!defined('WP_PLUGIN_URL')) define('WP_PLUGIN_URL', WP_HOME . '/plugins');

// Uploads dir is stored in database as a CMS setting

define('WPLANG', '');
if (!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/wp/');
require_once(ABSPATH . 'wp-settings.php');
