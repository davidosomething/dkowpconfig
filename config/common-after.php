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

// Authentication Keys and Salts
// You actually DON'T need to set these. If WP sees the default string
// "put your unique phrase here" it will automatically generate salts using
// the wp_salt function in wp-includes/pluggable.php and stores the value in
// the database.
foreach (array('AUTH', 'SECURE_AUTH', 'LOGGED_IN', 'NONCE', 'SECRET') as $first) {
  foreach (array('KEY', 'SALT') as $second) {
    if (!defined("{$first}_{$second}")) {
      define("{$first}_{$second}",  'put your unique phrase here');
    }
  }
}

// Default language
if (!defined('WPLANG')) define('WPLANG', '');

// Don't touch if WordPress lives in the wp folder
if (!defined('ABSPATH')) define('ABSPATH', dirname(__DIR__) . '/wp/');
require_once(ABSPATH . 'wp-settings.php');
