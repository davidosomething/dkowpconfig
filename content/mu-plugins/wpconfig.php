<?php
/**
 * Plugin Name: wpconfig mu-plugin loader
 * Plugin URI: https://github.com/WordPress/WordPress.git
 * Description: Load MU plugins bundled with http://github.com/davidosomething/wpconfig
 * Version: 0.1
 * Author: David O'Trakoun (@davidosomething)
 * Author URI: http://www.davidosomething.com
 * see http://codex.wordpress.org/Must_Use_Plugins
 */

require WPMU_PLUGIN_DIR . '/wpconfig/display-environment.php';
require WPMU_PLUGIN_DIR . '/wpconfig/register-theme-directory.php';
