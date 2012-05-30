#!/bin/bash

PROJECT_DIR=$(realpath $(dirname $0)/../)
cd $PROJECT_DIR
git pull origin master
./lib/limb/limb migrate_run
rm -rf ./var/*
service iodocs-odom restart

