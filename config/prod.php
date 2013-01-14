<?php
/**
 * Production environment configuration
 */

// Server
define('WP_MEMORY_LIMIT',     '128M');
define('SERVER_ENVIRONMENT',  'PROD');
define('FS_CHMOD_DIR',  02775); // setgid and ug+rw
define('FS_CHMOD_FILE', 0775);  // ug+rw

// Debugging
$debug_on = false; $debug_on_string = $debug_on ? 'On' : 'Off';
define('WP_DEBUG',          $debugon);
define('SAVEQUERIES',       $debugon);
define('SCRIPT_DEBUG',      $debugon);
define('WP_DEBUG_LOG',      $debugon);
define('WP_DEBUG_DISPLAY',  !$debugon);
@ini_set('log_errors',      $debug_on_string);
@ini_set('display_errors',  $debug_on_string);

// Database
define('DB_NAME',     $_ENV['OPENSHIFT_APP_NAME']);
define('DB_USER',     $_ENV['OPENSHIFT_MYSQL_DB_USERNAME']);
define('DB_PASSWORD', $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD']);
define('DB_HOST',     $_ENV['OPENSHIFT_MYSQL_DB_HOST'] . ':' . $_ENV['OPENSHIFT_MYSQL_DB_PORT']);
define('DB_CHARSET',  'utf8');
define('DB_COLLATE',  '');
$table_prefix  = 'wp_';

// Site URLs -- these should be manually set for Production, local can fall
  // back to common-after.php's version:
  // define('WP_HOME',    DKO_CONFIG_PROTOCOL . '//' . $_SERVER['SERVER_NAME']); // path to blog root
  // define('WP_SITEURL', WP_HOME . '/wp'); // path to wordpress

// CMS settings
define('EMPTY_TRASH_DAYS',    0);
define('DISALLOW_FILE_EDIT',  true);
define('WP_POST_REVISIONS',   false);
define('DISALLOW_FILE_MODS',  true); // we deploy with git!

// API Keys

// OpenShift
// This is where we define the OpenShift specific secure variable functions
// https://github.com/openshift/wordpress-example/blob/master/php/wp-config.php

// Authentication Unique Keys and Salts.
// Make sure you generate these for OpenShift! The defaults here are from the
// WordPress example repo on OpenShift's github.
// @link https://api.wordpress.org/secret-key/1.1/salt/
$_default_keys = array(
  'AUTH_KEY'          => ' w*lE&r=t-;!|rhdx5}vlF+b=+D>a)R:nTY1Kdrw[~1,xDQS]L&PA%uyZ2:w6#ec',
  'SECURE_AUTH_KEY'   => '}Sd%ePgS5R[KwDxdBt56(DM:0m1^4)-k6_p8}|C:[-ei:&qA)j!X`:7d-krLZM*5',
  'LOGGED_IN_KEY'     => '$l^J?o)!zhp6s[-x^ckF}|BjU4d+(g1as)n/Q^s+k|,ZZc@E^h%Rx@VTm|0|?]6R',
  'NONCE_KEY'         => '#f^JM8d^!sVsq]~|4flCZHdaTy.-I.f+1tc[!h?%-+]U}|_8qc K=k;]mXePl-4v',
  'AUTH_SALT'         => 'I_wL2t!|mSw_z_ zyIY:q6{IHw:R1yTPAO^%!5,*bF5^VX`5aO4]D=mtu~6]d}K?',
  'SECURE_AUTH_SALT'  => '&%j?6!d<3IR%L[@iz=^OH!oHRXs4W|D,VCD7w%TC.uUa`NpOH_XXpGtL$A]{+pv9',
  'LOGGED_IN_SALT'    => 'N<mft[~OZp0&Sn#t(IK2px0{KloRcjvIJ1+]:,Ye]>tb*_aM8P&2-bU~_Z>L/n(k',
  'NONCE_SALT'        => 'u E-DQw%[k7l8SX=fsAVT@|_U/~_CUZesq{v(=y2}#X&lTRL{uOVzw6b!]`frTQ|'
);

require 'openshift.php'; // combined with openshift.inc
