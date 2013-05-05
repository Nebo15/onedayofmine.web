#!/usr/bin/env bash

apt-get update
apt-get install -y nginx php5-fpm 
rm -rf /var/www
ln -fs /vagrant/odom /var/www