<?php
class DKOMigration
{
  public function __construct() {
    $this->migrations_file_basename = strtolower(SERVER_ENVIRONMENT);
    $this->migrations_file = DKO_SITE_DIR . "/migrations/options-{$this->migrations_file_basename}.php";
    if ($this->is_update_required()) {
      add_action('init', array(&$this, 'update_options'));
    }
  }

  private function is_update_required() {
    if (!file_exists($this->migrations_file)) {
      return false;
    }

    $database_timestamp = get_option('dkomigrate_timestamp');
    $actual_timestamp   = filemtime($this->migrations_file);
    return $database_timestamp != $actual_timestamp;
  }

  public function update_options() {

    // load the migrations file
    include $this->migrations_file;

    // default settings to use for updating options
    $settings_defaults = array(
      'serialized'  => false,
      'mode'        => 'update',
      'options'     => '',
    );

    // make the migrations
    foreach ($options_to_update as $option_name => $settings) {
      $settings = wp_parse_args($settings, $defaults);
      $option   = get_option($option_name);
      $new_data = array();
      $updated_data = null;

      // data is serialized
      if ($settings['serialized']) {
        $old_data = maybe_unserialize($option);
        $new_data = maybe_unserialize($settings['data']);

        // update options
        if ($data['mode'] == 'update') {
          $updated_data = serialize(wp_parse_args($new_data, $old_data));
        }

        // completely replace options
        else {
          $updated_data = serialize($new_data);
        }
      }

      // data is int/string/bool
      else {
        $updated_data = $settings['data'];
      }

      if ($updated_data) {
        update_option($option_name, $updated_data);
      }
    }

    update_option('dkomigrate_timestamp', filemtime($this->migrations_file));
    add_action('admin_notices', array(&$this, 'show_updated_notice'));
  }

  public function show_updated_notice() {
    echo '<div id="message" class="updated fade">
  <p><strong>
    The WordPress Options table has been successfully migrated for the ', SERVER_ENVIRONMENT, ' server. Last update: ', filemtime($this->migrations_file), '
  </strong></p>
</div>';
  }


}
if (!empty($_GET['dkomigration']) || is_admin()) {
  new DKOMigration;
}
