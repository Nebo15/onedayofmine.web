#!/bin/bash

PROJECT_DIR=$(realpath $(dirname $0)/../)
cd $PROJECT_DIR
git pull origin master
rm -rf ./var/*
./lib/limb/limb od_fill_from_lj

