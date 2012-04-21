<?php
/**
 * DKO WordPress Configuration file
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 */

$protocol = 'http://';
if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] !== 'off') {
  $protocol = 'https://';
}
define('CONFIG_FILE_LOCAL',  dirname(__FILE__) . '/wp-config-local.php');
define('CONFIG_FILE_DEV',    dirname(__FILE__) . '/wp-config-dev.php');  // template for PROD version
define('CONFIG_FILE_PROD',   dirname(__FILE__) . '/wp-config-prod.php'); // not version controlled!
if (file_exists(CONFIG_FILE_LOCAL)) {
  require_once CONFIG_FILE_LOCAL;
}
elseif (file_exists(CONFIG_FILE_DEV)) {
  require_once CONFIG_FILE_DEV;
}
elseif (file_exists(CONFIG_FILE_PROD)) {
  require_once CONFIG_FILE_PROD;
}
define('WP_CONTENT_URL', WP_SITEURL . '/wp-content');

define('EMPTY_TRASH_DAYS',    0);
define('DISALLOW_FILE_EDIT',  true);
define('WP_POST_REVISIONS',   false);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'always regenerate these!');
define('SECURE_AUTH_KEY',  'always regenerate these!');
define('LOGGED_IN_KEY',    'always regenerate these!');
define('NONCE_KEY',        'always regenerate these!');
define('AUTH_SALT',        'always regenerate these!');
define('SECURE_AUTH_SALT', 'always regenerate these!');
define('LOGGED_IN_SALT',   'always regenerate these!');
define('NONCE_SALT',       'always regenerate these!');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
