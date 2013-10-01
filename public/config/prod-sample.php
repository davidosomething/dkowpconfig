<?php
/**
 * Production environment configuration
 *
 * Remove values from common-before.php if you want them to be config specific.
 */

// Server
define('WP_MEMORY_LIMIT',     '128M');
define('SERVER_ENVIRONMENT',  'PROD');

// Debugging
define('WP_DEBUG',          false);
define('SAVEQUERIES',       false);
define('WP_DEBUG_LOG',      true);
@ini_set('log_errors',      true);
define('WP_DEBUG_DISPLAY',  false);
@ini_set('display_errors',  false);
define('SCRIPT_DEBUG',      false);

// Database
define('DB_NAME',     getenv('OPENSHIFT_APP_NAME'));
define('DB_USER',     getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
define('DB_PASSWORD', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
define('DB_HOST',     getenv('OPENSHIFT_MYSQL_DB_HOST') . ':' . getenv('OPENSHIFT_MYSQL_DB_PORT'));

// CMS
define('FORCE_SSL_ADMIN', true); // openshift admin in SSL

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
