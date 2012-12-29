DKO WP Config
=============

My WordPress configuration and mu-plugin helpers. This is how I setup WordPress
installs.

http://github.com/davidosomething/dkowpconfig.git

About
=====

This is a WordPress config setup that modifies wp-config.php to work with
multiple environments. You can specify as many environments as you need, e.g.
prod, dev, local, qa, staging. These are all arbitrary names, but they
correspond to config files you create in the ````config```` folder.

The default WordPress filesystem has also been decoupled from WordPress so you
can upgrade WordPress using git or just replacing the entire ````wp```` folder.

Plugins are in the root ````/plugins```` folder, uploads should be symlinked to
the root ````/uploads```` folder. Of course you can change all this by setting
the constants in each environment config file.

About the MU-plugin
-------------------

This configuration also includes a MU ("must use") plugin that:

* Re-enables the WordPress default themes
* Displays the current environment in the admin bar

The plugin is found in ````/content/mu-plugins```` and can be disabled by
deleting the folder ````dkowpconfig.php```` file and ````dkowpconfig````
folder.

Configuring
===========

* Assume WordPress is in ````wp```` folder in root.
* Enter in environments into the array in ````wp-config.php```` by priority
* Fill in files ````config/local.php````, ````config/dev.php````, etc.
    * An example config for an OpenShift deployment is provided as
      ````config/prod.php````

Deploying on OpenShift
======================

In your /.openshift/action_hooks/deploy hook file, add this:
````
rm $OPENSHIFT_REPO_DIR/php/config/local.php && echo "[DEPLOY]--> Deleted local config"
rm $OPENSHIFT_REPO_DIR/php/config/dev.php   && echo "[DEPLOY]--> Deleted dev config"
[ -d ${OPENSHIFT_DATA_DIR}uploads ] || mkdir ${OPENSHIFT_DATA_DIR}uploads
ln -sf ${OPENSHIFT_DATA_DIR}uploads ${OPENSHIFT_REPO_DIR}php/content && echo "[DEPLOY]--> Symlinked uploads folder"
````
