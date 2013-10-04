# DKO WP Config

> My WordPress configuration and mu-plugin helpers. This is how I setup WordPress installs.
  [github.com/davidosomething/dkowpconfig](http://github.com/davidosomething/dkowpconfig)

## About
This is a WordPress config setup that modifies `wp-config.php` to work with
multiple environments. You can specify as many environments as you need, e.g.
prod, dev, local, qa, staging. These are all arbitrary names, but they
correspond to config files you create in the `config` folder.

The default WordPress filesystem has also been decoupled from WordPress so you
can upgrade WordPress using git or just replacing the entire `wp` folder.

Plugins are in the `/plugins` folder.

## Requirements and tooling
I strongly recommend using [composer](http://getcomposer.org/) to manage your
plugins -- and your theme as well.

[wp-cli](http://wp-cli.org/) is a commandline tool for managing WordPress and
can be used in conjunction with composer to add and remove plugins.

### Environment management
It's good practice to not store passwords and API keys in your code. Instead,
store them on the server and read them into your site using getenv(). This means
you may need to add and export variables from your bash profile, which you may
not like if you're running multiple sites.

The cool way to handle your environment is to run your WordPress installs in
virtual machines, preferably managed by Vagrant. The environment variables would
be set by chef or puppet (or other provisioner) from the encrypted data store
(e.g. databags/hiera).

If you want to develop using an http server installed locally check out
[direnv](http://direnv.net/). It's also installable via [homebrew](http://brew.sh/).

## Setup
* If you aren't using composer, edit the `.gitignore` file accordingly to track
  the core, plugins, and themes folders. It's commented.
* Install WordPress into the `wp` folder in the site root (preferably using
  `composer install`)
* Enter in environments into the array in `wp-config.php` by priority.
  Server names may be provided as the array keys to lock a config to a
  server name. You must edit this, it's currently set up with examples for
  various environments that you may or may not have.
* Add your auth keys to `config/common-after.php` (or define per config).
  You can also use getenv() and set them in your server environment.
* There are values in `config/common-before.php` you really should change, such
  as the table prefix.
* Fill in files `config/local-sample.php`, `config/dev-sample.php`, etc. as they
  correlate with the environments you specified in the `wp-config.php` file.
    * Again, using getenv() to retrieve environment variables is recommended. 
    * An example config for deploying to the [OpenShift](http://openshift.redhat.com/)
      PaaS is provided as `config/prod-sample.php`

### Config settings to avoid
The following config constants are known to cause plugin compatibility issues:
```
// These two settings can mess up some plugins since the edit_plugins and
// update_core capabilities will not be created when they are active.
// So don't use them.
define('DISALLOW_FILE_EDIT',  true);  // Turn off file editing menu
define('DISALLOW_FILE_MODS',  true);  // Turn off core/plugin updates
```

## Composer
You only need to run composer once per server: when you first set up the stack.
Afterwards, use wp-cli (or the CMS admin) to manage plugins, themes, and core.

If you're building a site that needs to be rebuilt from scratch or
redistributed, then you can edit the composer.json file and include what you've
added so that someone can run it on a new server to get everything.

### Composer for core
Composer installs WordPress using the [method outlined on the roots theme
site](http://roots.io/using-composer-with-wordpress/).

### Composer for plugins
Plugins are also managed through composer using Outlandish's [wpackagist](http://wpackagist.org/)
repository. The `composer.json` file is set up to install them into `plugins/`
and `content/mu-plugins` as needed.

The following are plugins I commonly use and have included in the
`composer.json` file. You can remove them if you don't want them.

* [Advanced Custom Fields](http://www.advancedcustomfields.com/) allows you to
  easily create custom fields on your post edit.

### Composer for themes
Themes can be installed via composer into `content/themes`.

## About the included mu-plugins
The mu-plugins for this configuration are actually kept in the `dkowpconfig`
folder. This allows you to update all of them by simply overwriting the folder
with the latest content from the repo.

### Compatibility and environment mu-plugin
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
[ -d ${OPENSHIFT_DATA_DIR}uploads ] || mkdir ${OPENSHIFT_DATA_DIR}uploads
ln -sf ${OPENSHIFT_DATA_DIR}uploads ${OPENSHIFT_REPO_DIR}php/content
```

You can probably [enable hot deploys](https://www.openshift.com/kb/kb-e1057-how-can-i-deploy-my-application-without-having-to-restart-it)
as well.

### Todo
* Autorun composer on openshift deploy.
