#!/bin/bash

PROJECT_DIR=$(dirname $0)/../
test -d $PROJECT_DIR || exit 0
cd $PROJECT_DIR
cp ./www/off_tpl.html ./www/off.html
git pull origin develop
rm -rf ./var/compiled
rm -rf ./var/db_info
rm -rf ./var/default
rm -rf ./var/fb_cache
rm -rf ./var/sessions
test -d ./var/logs || mkdir ./var/logs
./limb migrate_run
./limb od_calc_interest
./limb od_deploy
rm ./www/off.html
