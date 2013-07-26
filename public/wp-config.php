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
  // this is an example servername specific config, you can also match against $_ENV
  'dev'   => array('match' => array('myserver.com', $_SERVER['SERVER_NAME'])),
  'qa',
  'stage',
  'prod',
);

include DKO_CONFIG_DIR . '/common-before.php';
foreach ($environments as $file => $conditions) {
  if (!is_array($conditions)) {
    $environment = $conditions;
  }
  else {
    $is_condition_met = false;
    foreach ($conditions as $condition => $values) {
      if ($condition === 'match') {
        $is_condition_met = ($values[0] === $values[1]);
      }
    }

    if ($is_condition_met) {
      $environment = $file;
    }
    else { // failed condition, skip this config
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

// Don't touch if WordPress lives in the wp folder
defined('ABSPATH') or define('ABSPATH', dirname(__DIR__) . DKO_CORE_FOLDER . '/');
require_once(ABSPATH . 'wp-settings.php');
