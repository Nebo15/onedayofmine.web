#!/usr/bin/env bash

mkdir -p /www/
chown -R www-data:www-data /www/onedayofmine/*

echo '#!/bin/sh' > /bin/puppet-update.sh
echo "cd /tmp/vagrant-puppet/manifests" >> /bin/puppet-update.sh
echo "/opt/ruby/bin/puppet apply --modulepath  '/etc/puppet/modules:/tmp/vagrant-puppet/modules-0' site.pp --detailed-exitcodes" >> /bin/puppet-update.sh
chmod 755 /bin/puppet-update.sh

echo '#!/bin/sh' > /bin/puppet-debug-update.sh
echo "cd /tmp/vagrant-puppet/manifests" >> /bin/puppet-debug-update.sh
echo "/opt/ruby/bin/puppet apply --verbose --debug --modulepath  '/etc/puppet/modules:/tmp/vagrant-puppet/modules-0' site.pp --detailed-exitcodes" >> /bin/puppet-debug-update.sh
chmod 755 /bin/puppet-debug-update.sh
