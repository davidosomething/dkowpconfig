<?php
/**
 * DKO WordPress Configuration file
 * This file is included AFTER the environment specific config
 */

if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
if (!defined('WP_CONTENT_URL')) define('WP_CONTENT_URL', WP_HOME . '/content');

define('WPLANG', '');
if (!defined('ABSPATH')) define('ABSPATH', dirname(__FILE__) . '/wp/');
require_once(ABSPATH . 'wp-settings.php');
