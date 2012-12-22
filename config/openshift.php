<?php

// https://github.com/openshift/wordpress-example/blob/master/php/wp-config.php
// This function gets called by openshift_secure and passes an array
function make_secure_key($args) {
  $hash = $args['hash'];
  $key  = $args['variable'];
  $original = $args['original'];

  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $chars .= '!@#$%^&*()';
  $chars .= '-_ []{}<>~`+=,.;:/?|';

  // Convert the hash to an int to seed the RNG
  srand(hexdec(substr($hash,0,8)));
  // Create a random string the same length as the default
  $val = '';
  for($i = 1; $i <= strlen($original); $i++){
    $val .= substr( $chars, rand(0,strlen($chars))-1, 1);
  }
  // Reset the RNG
  srand();
  // Set the value
  return $val;
}


// Generate OpenShift secure keys (or return defaults if not on OpenShift)
$array = openshift_secure($_default_keys,'make_secure_key');

// Loop through returned values and define them
foreach ($array as $key => $value) {
  define($key,$value);
}
// Gets the secret token provided by OpenShift 
// Or generates one (this is slightly less secure, but good enough for now)
function get_openshift_secret_token() {
  $my_token = null;

  $token = getenv('OPENSHIFT_SECRET_TOKEN');
  $name  = getenv('OPENSHIFT_APP_NAME');
  $uuid  = getenv('OPENSHIFT_APP_UUID');

  if ($token)
    $my_token = $token;
  elseif ($name && $uuid)
    $my_token = hash('sha256',"$name-$uuid");

  return $my_token;
}

// Loop through all provided variables and generate secure versions
// If not running on OpenShift, returns defaults and logs an error message
//
// This function calls secure_function and passes an array of:
//  { 
//    'hash'     => generated sha hash,
//    'variable' => name of variable,
//    'original' => original value
//  }
function openshift_secure($default_keys,$secure_function = null) {
  // Attempts to get secret token
  $my_token = get_openshift_secret_token();

  // Only generate random values if on OpenShift
  $array = $default_keys;

  // This is the same function run by includes/install.core.inc#install_settings_form_submit
  if ($my_token){
    // Loop over each default_key and set the new value
    foreach ($default_keys as $key => $value) {
      // Create hash out of token and this key's name
      $sha = hash('sha256',"$my_token-$key");
      // Pass an array so we can add stuff without breaking existing calls
      $vals = array(
        'hash' => $sha,
        'variable'  => $key,
        'original'  => $value
      );
      // Call user specified function or just return hash
      $array[$key] = ($secure_function ? call_user_func($secure_function,$vals) : $sha);
    }
  } else {
    // Get the relative path for a more meaningful error message
    $t = debug_backtrace();
    $calling_file = $t[0]['file'];
    // Remove directory to give relative dir for file
    if (getenv('OPENSHIFT_REPO_DIR')) {
      $base = getenv('OPENSHIFT_REPO_DIR');
      $calling_file = str_replace($base,'',$calling_file);
    }
    error_log("OPENSHIFT WARNING: Using default values for secure variables, please manually modify in $calling_file", 0);
  }
  return $array;
}
