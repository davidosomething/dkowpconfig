DKO WP Config
===============================

Configuring
===========

* Assume WordPress is in ````wp```` folder in root.
* Enter in environments into the array in ````wp-config.php```` by priority
* Fill in files ````config/local.php````, ````config/dev.php````, etc.

Deploying
=========

````
rm $OPENSHIFT_REPO_DIR/php/config/local.php && echo "[DEPLOY]--> Deleted local config"
rm $OPENSHIFT_REPO_DIR/php/config/dev.php   && echo "[DEPLOY]--> Deleted dev config"
ln -sf ${OPENSHIFT_DATA_DIR}uploads ${OPENSHIFT_REPO_DIR}php/content && echo "[DEPLOY]--> Symlinked uploads folder"
````
