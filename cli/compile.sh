#!/bin/bash

PROJECT_DIR=$(dirname $0)/../
test -d $PROJECT_DIR || exit 0
cd $PROJECT_DIR

uglifyjs ./www/lib/*.js \
         ./www/lib/vendor/jquery.min.js \
         ./www/lib/vendor/bootstrap.min.js \
         ./www/lib/vendor/handlebars.js \
         ./www/lib/vendor/jquery.scrollTo-1.4.3.1-min.js \
         ./www/lib/vendor/jquery.cookie.js \
         ./www/lib/vendor/jquery.masonry.min.js \
        -o ./www/lib/compiled/compiled.js \
        -c
