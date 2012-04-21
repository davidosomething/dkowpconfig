DKO WP Config
===============================

WordPress config and .gitignore boilerplate, and datadump.sh for creating
MySQL dumps from the commandline based on wp-config-*.php settings.

This is some boilerplate code that allows you to have different environments
in WordPress based on the existence of the configuration file for that
environment.

```.gitignore``` has some useful directives and ignores the production config
so you won't accidentally check in your sensitive database info. The gitignore
causes only the customizable parts of WordPress to be versioned --
```wp-admin``` and ```wp-include``` are completely ignored, while
```wp-content``` is selectively ignored. That means you need to download
WordPress and put your versioned stuff on top of it.


Using this Config and .gitignore
--------------------------------

Don't clone this repository.

1. Download the zip file
2. Extract the contents into your current, unversioned WordPress install
  * It has to be unversioned, otherwise you may have versioned things that
    were supposed to be ignored.
3. ```git init``` your repository and proceed as normal.
4. To clone and deploy your project on another machine, follow the next steps:


(Re)deploying a project that is using this config
-------------------------------------------------

It's good practice to read and understand any scripts you download before
before running them, so I recommend it for ```bootstrap.sh```

This is the proper way to clone and set up a project that uses the included
```.gitignore``` file:

```
git clone MYREPOURL.git TEMPREPO && TEMPREPO/bootstrap/bootstrap.sh
```

Finally, fix any permissions you need to (make sure WordPress can write to
everything, including the ```.htaccess``` files).


Content migration
-----------------

There's a shell script called ```datadump.sh``` in the bootstrap folder.
This script can read the settings in each of the wp-config-*.php files and
do mysql dumps of them. You'll need the ```mysqldump``` program to use it.
The mysql dump can be imported into an existing database on any server.

For asset migration, just use rsync. The ```wp-content/uploads``` folder is not
versioned since it is maintained by WordPress.

**@TODO** script rsync for asset migration FROM production TO dev and local.

