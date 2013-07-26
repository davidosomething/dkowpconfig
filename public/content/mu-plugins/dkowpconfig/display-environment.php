<?php
/**
 * Display the SERVER_ENVIRONMENT constant in the Admin Bar
 */
add_action('admin_bar_menu', 'dkowpconfig_admin_bar_environment', 21);

function dkowpconfig_admin_bar_environment() {
  global $wp_admin_bar;

  if (!is_admin_bar_showing()) return;

  $args = array(
    'id'    => 'dkowpconfig_display_environment',
    'title' => '<b style="font-weight:700;">' . SERVER_ENVIRONMENT . '</b>',
    'href'  => admin_url()
  );
  $wp_admin_bar->add_node($args);
}
