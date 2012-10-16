#!/bin/bash

PROJECT_DIR=$(realpath $(dirname $0)/../../)

# Sphinx
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf --rotate --quiet days
indexer --config $PROJECT_DIR/settings/third-party/sphinx/sphinx.conf --rotate --quiet users
