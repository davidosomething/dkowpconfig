<?php
/**
 * DKO WordPress Configuration file
 */

if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] !== 'off') {
  define('DKO_CONFIG_PROTOCOL', 'https:');
}
else {
  define('DKO_CONFIG_PROTOCOL', 'http:');
}

define('DKO_SITE_DIR',   dirname(__FILE__));
define('DKO_CONFIG_DIR', DKO_SITE_DIR . '/config');

$environments = array(
  'local',
  'dev',
  // array('dev.mysite.com' => 'dev'), // this is an example servername specific config
  'qa',
  'stage',
  'prod',
);

include DKO_CONFIG_DIR . '/common-before.php';
foreach ($environments as $environment) {
  // config is server specific
  if (is_array($environment)) {
    $key = key($environment);
    if ($key === $_SERVER['SERVER_NAME']) {
      $environment = $environment[$key];
    }
    else { // ignore this config
      continue;
    }
  }

  // use this config if it exists on server
  $config_file = DKO_CONFIG_DIR . '/' . $environment . '.php';
  if (file_exists($config_file)) {
    include $config_file;
    break;
  }
}
include DKO_CONFIG_DIR . '/common-after.php';
