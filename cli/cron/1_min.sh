#!/bin/bash

PROJECT_DIR=$(realpath $(dirname $0)/../../)

# Sphinx
## Users
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf --rotate --quiet users_delta
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf --rotate --quiet --merge users users_delta

## Days
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf --rotate --quiet days_delta
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf --rotate --quiet --merge days days_delta
