<?php
/**
 * DKO WordPress Configuration file
 * This file is included BEFORE the environment specific config
 */

if (!defined('WP_CONTENT_DIR')) define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
if (!defined('WP_CONTENT_URL')) define('WP_CONTENT_URL', WP_HOME . '/content');
