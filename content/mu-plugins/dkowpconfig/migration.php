<?php
class DKOMigration
{
  public function __construct() {
    $this->migrations_file_basename = strtolower(SERVER_ENVIRONMENT);
    $this->migrations_file          = DKO_SITE_DIR . "/migrations/options-{$this->migrations_file_basename}.php";

    // do nothing if no migrations file. Filesystem checks should be superfast.
    if (!file_exists($this->migrations_file)) {
      return false;
    }

    $this->migrations_file_mtime    = filemtime($this->migrations_file);
    if (!empty($_GET['dkomigration']) && $this->is_update_required()) {
      add_action('init', array($this, 'update_options'));
    }
    elseif ($this->is_update_required()) {
      add_action('admin_notices', array($this, 'notice_migration_required'));
    }
  }

  private function is_update_required() {
    $this->last_migration = get_option('dkomigrate_timestamp');
    return $this->last_migration != $this->migrations_file_mtime;
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

    update_option('dkomigrate_timestamp', $this->migrations_file_mtime);
    add_action('admin_notices', array($this, 'notice_migration_successful'));
  }

  public function notice_migration_successful() {
    echo '<div id="message" class="updated fade">
  <p><strong>
    The WordPress Options table has been successfully migrated for the ', SERVER_ENVIRONMENT, ' server. Last update: ', filemtime($this->migrations_file), '
  </strong></p>
</div>';
  }

  public function notice_migration_required() {
    echo '<div id="message" class="updated fade">';
    echo '<p><strong>The DKOMigrations mu-plugin has detected that an options migration is required.</strong></p>';
    echo '<ul>';
    echo "  <li>{$this->migrations_file} was last updated {$this->migrations_file_mtime}</li>";
    echo "  <li>The last migration was performed on {$this->last_migration}</li>";
    echo '</ul><p><a href="', admin_url('/?dkomigration=true'), '">Click here to migrate your options.</a></p></div>';
  }
}
new DKOMigration;
