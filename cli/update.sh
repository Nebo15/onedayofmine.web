#!/bin/bash

PROJECT_DIR=$(realpath $(dirname $0)/../)
cd $PROJECT_DIR
git pull origin master
rm -rf ./var/*
./lib/limb/limb migrate_run
./lib/limb/limb od_calc_interest

