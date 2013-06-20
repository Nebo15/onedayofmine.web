#!/bin/bash

PROJECT_DIR=$(dirname $0)/../
test -d $PROJECT_DIR || exit 0
cd $PROJECT_DIR
cp ./www/off_tpl.html ./www/off.html
git pull
rm -rf ./var/compiled
rm -rf ./var/db_info
rm -rf ./var/cache_db_info
rm -rf ./var/default
rm -rf ./var/cache_default
rm -rf ./var/fb
rm -rf ./var/cache_fb
rm -rf ./var/sessions
rm -rf ./var/cache_photo_source
rm -rf ./var/cache_i18n

test -d ./var/logs || mkdir ./var/logs
./limb migrate_run
./limb od_calc_interest
./limb od_deploy
./limb od_clear_cache
rm ./www/off.html
