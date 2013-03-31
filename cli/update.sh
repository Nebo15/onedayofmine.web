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
curl -H "x-api-key:edecea61b9ac0cdf41b5a066429103c3cd9091624038e79" -d "deployment[app_name]=ODOM" https://rpm.newrelic.com/deployments.xml
rm ./www/off.html
