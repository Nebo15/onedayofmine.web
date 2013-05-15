#!/usr/bin/env bash

rm -rf /var/www
mkdir -p /www/
ln -fs /vagrant/odom/ /www/onedayofmine
chown -R www-data:www-data /www/onedayofmine/*

# Need conditionals around `mesg n` so that Chef doesn't throw
# `stdin: not a tty`
sed -i '$d' /root/.profile
cat << 'EOH' >> /root/.profile
if `tty -s`; then
  mesg n
fi
EOH

echo '#!/bin/sh' > /bin/puppet-update.sh
echo "cd /tmp/vagrant-puppet/manifests" >> /bin/puppet-update.sh
echo "/opt/ruby/bin/puppet apply --modulepath  '/etc/puppet/modules:/tmp/vagrant-puppet/modules-0' site.pp --detailed-exitcodes" >> /bin/puppet-update.sh
chmod 755 /bin/puppet-update.sh

echo '#!/bin/sh' > /bin/puppet-debug-update.sh
echo "cd /tmp/vagrant-puppet/manifests" >> /bin/puppet-debug-update.sh
echo "/opt/ruby/bin/puppet apply --verbose --debug --modulepath  '/etc/puppet/modules:/tmp/vagrant-puppet/modules-0' site.pp --detailed-exitcodes" >> /bin/puppet-debug-update.sh
chmod 755 /bin/puppet-debug-update.sh
