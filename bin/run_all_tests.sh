#!/bin/bash

PROJECT_DIR=$(realpath $(dirname $0)/../)
php $PROJECT_DIR/lib/limb/runtests.php $PROJECT_DIR/tests
