#!/bin/sh

s3cmd sync --bucket-location=US --exclude 'sqldump/*' /www/backups/files /www/backups/mysql s3://onedayofmine-backup