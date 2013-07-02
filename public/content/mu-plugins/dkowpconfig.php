<?php
/**
 * Plugin Name: dkowpconfig mu-plugin loader
 * Plugin URI: https://github.com/davidosomething/dkowpconfig
 * Description: Load MU plugins bundled with http://github.com/davidosomething/dkowpconfig
 * Version: 0.1
 * Author: David O'Trakoun (@davidosomething)
 * Author URI: http://www.davidosomething.com
 */

require WPMU_PLUGIN_DIR . '/dkowpconfig/display-environment.php';
require WPMU_PLUGIN_DIR . '/dkowpconfig/register-theme-directory.php';
require WPMU_PLUGIN_DIR . '/dkowpconfig/remove-dashboard-widgets.php';
