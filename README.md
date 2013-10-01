# DKO WP Config

> My WordPress configuration and mu-plugin helpers. This is how I setup WordPress installs.
  [Original source: http://github.com/davidosomething/dkowpconfig.git](http://github.com/davidosomething/dkowpconfig.git)

## About
This is a WordPress config setup that modifies `wp-config.php` to work with
multiple environments. You can specify as many environments as you need, e.g.
prod, dev, local, qa, staging. These are all arbitrary names, but they
correspond to config files you create in the `config` folder.

The default WordPress filesystem has also been decoupled from WordPress so you
can upgrade WordPress using git or just replacing the entire `wp` folder.

Plugins are in the `/plugins` folder.

## Setup
* Assume WordPress is in `wp` folder in root.
* Enter in environments into the array in `wp-config.php` by priority.
  Server names may be provided as the array keys to lock a config to a
  server name.
* Add your auth keys to `config/common-after.php` (or define per config).
* There are values in `config/common-before.php` you really should change, such
  as the table prefix.
* Fill in files `config/local-sample.php`, `config/dev-sample.php`, etc. as they
  correlate with the environments you specified in the `wp-config.php` file.
    * An example config for deploying to the [OpenShift](http://openshift.redhat.com/)
      PaaS is provided as `config/prod-sample.php`

### Config settings to avoid
The following config constants are known to cause plugin compatibility issues:
```
// These two mess with the edit_plugins and update_core capabilities
define('DISALLOW_FILE_EDIT',  true);  // Turn off file editing menu
define('DISALLOW_FILE_MODS',  true);  // Turn off core/plugin updates
```

## About the included MU-plugins
The mu-plugins for this configuration are actually kept in the `dkowpconfig`
folder. This allows you to update all of them by simply overwriting the folder
with the latest content from the repo.

### Compatibility and Environment mu-plugin
This configuration also includes a MU ("must use") plugin that:

* Re-enables the WordPress default themes
* Displays the current environment in the admin bar

The plugin is found in `/content/mu-plugins` and can be disabled by
deleting the folder `dkowpconfig.php` file and `dkowpconfig`
folder.

### Options migration mu-plugin
To deactivate, delete `dkomigration.php` from `/content/mu-plugins`.

This plugin reads an `options-_environment_.php` file from the `/migrations`
folder found in the site root. If there are new migrations that have not been
performed (determined by comparing file modified time) the mu-plugin updates
alerts the admin to perform a migration by clicking a link. The migration is
performed on the WordPress Options table (typically `wp_options`) with the
values defined in the file in associative array format.

#### Migration files syntax
There can be an `options-`_environment_`.php` file for each server
environment defined in `wp-config.php`. So you can have `options-dev.php`,
`options-prod.php` and so on. These files are all optional.

The structure of the options migration files is a simple PHP file with arrays
in it for each option. See `options-prod-sample.php` for an example of setting
up migrations for the [Nextend Facebook Connect plugin](http://wordpress.org/extend/plugins/nextend-facebook-connect/).

There are settings for how to update the options:
```
  'serialized'  => true,
  'mode'        => 'update',
```

`serialized` means that the option exists as a serialized array and should be
written back to the wp_options table as such. This should be a boolean.

`mode` is whether to `update` the current options, leaving unspecified parts
of a serialized array alone, or to completely `replace` the option with what
you enter. This should be entered as a string.

## Appendix

### Deploying on RedHat OpenShift
In your /.openshift/action_hooks/deploy hook file, add this:
```
rm $OPENSHIFT_REPO_DIR/php/config/local.php && echo "[DEPLOY]--> Deleted local config"
rm $OPENSHIFT_REPO_DIR/php/config/dev.php   && echo "[DEPLOY]--> Deleted dev config"
[ -d ${OPENSHIFT_DATA_DIR}uploads ] || mkdir ${OPENSHIFT_DATA_DIR}uploads
ln -sf ${OPENSHIFT_DATA_DIR}uploads ${OPENSHIFT_REPO_DIR}php/content && echo "[DEPLOY]--> Symlinked uploads folder"
```

You can probably enable hot deploys as well.
