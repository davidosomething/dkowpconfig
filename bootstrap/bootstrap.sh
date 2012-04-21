#!/bin/bash

# helpers from http://serverwizard.heroku.com/script/
status()     { echo -e "\033[0;34m==>\033[0;32m $*\033[0;m"; }
status_()    { echo -e "\033[0;32m    $*\033[0;m"; }
err()        { echo -e "\033[0;31m==> \033[0;33mERROR: \033[0;31m$*\033[0;m"; }
err_()       { echo -e "\033[0;31m    $*\033[0;m"; }
die()        { echo -e "\033[0;31m==> \033[0;33mFATAL: \033[0;31m$*\033[0;m"; exit 1; }

echo "Enter the name of the temporary folder you cloned to:"
read TEMPDIR

echo "Enter the name of the destination folder you want this site to exist in."
echo "This folder should not exist yet:"
read DESTDIR

# you messed up, but it's ok, I'll just suffix the tempdir
if [ "$TEMPDIR" = "$DESTDIR" ]; then
  mv $TEMPDIR "$TEMPDIR-temp"
  TEMPDIR="$TEMPDIR-temp"
fi

if [ ! -d "$TEMPDIR/.git" ]; then
  err   "Somehow you got this file without cloning the git repo. Do this instead:"
  err_  "git clone --recursive MYREPO.git $TEMPDIR && $TEMPDIR/bootstrap/bootstrap.sh"
  exit 1
fi

if [ -d "$DESTDIR" ]; then
  err   "A $DESTDIR/ folder already exists in this folder. Move, rename, or"
  err_  "delete it to continue."
  exit 1
fi

echo "OK, press [enter] to continue, or Ctrl-C to abort."
read

set -e # die on error

# get the latest wordpress and extract it into a new folder called wordpress
wget http://wordpress.org/latest.tar.gz || die "Couldn't download WordPress"

WORDPRESS_FOLDER_EXISTS=0
if [ -d "wordpress" ]; then
  # hope to god you don't have a folder with this name already
  mv wordpress wordpress-dko-temp || die "WordPress folder exists and couldn't move it."
  WORDPRESS_FOLDER_EXISTS=1
fi
tar -xzvf latest.tar.gz && rm latest.tar.gz
mv wordpress $DESTDIR
if [ "$WORDPRESS_FOLDER_EXISTS" = 1 ]; then
  mv wordpress-dko-temp wordpress     # hope to god you don't have a folder with
fi
status "Got WordPress, extracted to wordpress/ folder and renamed to $DESTDIR/"

# get the latest truth2012 code and move it all into that wordpress folder
mv $TEMPDIR/.git $DESTDIR/
status  "Moved repo into the $DESTDIR/ folder."

# reset repo inside folder
pushd $DESTDIR
git reset HEAD --hard
status  "Reset the repo so you have the latest files combined with WordPress"

# init and prep submodules
git submodule update --init --recursive
git submodule foreach git pull --recurse-submodules -u origin master
status  "Initialized and updated submodules to their HEADs"

# remove original clone
popd
rm -rf $TEMPDIR
status  "Deleted initial repo clone $TEMPDIR"

cd $DESTDIR
status  "CD'ed into $DESTDIR folder. Happy hacking!"

