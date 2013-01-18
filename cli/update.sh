#!/bin/bash

PROJECT_DIR=$(realpath $(dirname $0)/../)
cd $PROJECT_DIR
git pull origin develop
rm -rf ./var/compiled
rm -rf ./var/db_info
rm -rf ./var/default
rm -rf ./var/fb_cache
rm -rf ./var/sessions
mkdir ./var/logs
./lib/limb/limb migrate_run
./lib/limb/limb od_calc_interest
