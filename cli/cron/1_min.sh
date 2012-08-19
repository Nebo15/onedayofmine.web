#!/bin/bash

PROJECT_DIR=$(realpath $(dirname $0)/../../)
$PROJECT_DIR/lib/limb/limb od_amazon_cloudwatch_update
$PROJECT_DIR/lib/limb/limb od_amazon_s3_upload
