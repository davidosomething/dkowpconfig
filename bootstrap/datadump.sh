#!/bin/bash

# takes optional argument environment prod|dev
# defaults to local
# does a mysqldump of the database for importing

function wordpress_mysqldump() {
  case $1 in
    prod|PROD)  local config="../wp-config-prod.php"
                local dump="prod.sql"
                ;;
    dev|dev)    local config="../wp-config-dev.php"
                local dump="dev.sql"
                ;;
    *)          local config="../wp-config-local.php"
                local dump="local.sql"
                ;;
  esac

  local database="`awk '/DB_NAME/ {print $2}' $config | sed "s/'\([a-z0-9_-]*\)');/\1/"`"
  local username="`awk '/DB_USER/ {print $2}' $config | sed "s/'\([a-z0-9_-]*\)');/\1/"`"
  local password="`awk '/DB_PASS/ {print $2}' $config | sed "s/'\([a-z0-9_-]*\)');/\1/"`"

  mysqldump --opt -u $username -p$password $database > $dump
}
wordpress_mysqldump $1
