include apt
include mysql

group { 'puppet':
	ensure => present,
}

host { 'onedayofmine.dev':
    ip => '127.0.0.1',
    host_aliases => 'api.onedayofmine.dev',
}

apt::ppa { "ppa:ondrej/php5": }

exec { 'apt-get update':
	command => '/usr/bin/apt-get update',
}

package { ['git', 'nginx', 'php5-fpm', 'php5-cli', 'php5-curl', 'php5-imagick', 'php5-memcached', 'php5-mysqlnd']:
	ensure => present,
	require => Exec['apt-get update'],
}

service { 'nginx':
	ensure => running,
	require => Package['nginx']
}

service { 'php5-fpm':
	ensure => running,
	require => Package['php5-fpm'],
}

file { '/etc/nginx/nginx.conf':
	 target => '/www/onedayofmine/settings/third-party/front/nginx/nginx.conf',
   ensure => 'link',
   require => Package['nginx'],
}

file { '/etc/nginx/sites-enabled/onedayofmine':
	 target => '/www/onedayofmine/settings/third-party/front/nginx/oneday-dev.conf',
   ensure => 'link',
   require => Package['nginx'],
}

file { 'default-nginx-disable':
	path => '/etc/nginx/sites-enabled/default',
	ensure => absent,
	require => Package['nginx'],
}

class { 'mysql::server':
  config_hash => { 'root_password' => 'test' }
}

mysql::db { 'one_day':
	user     => 'root',
	password => 'test',
	host     => 'localhost',
	grant    => ['all'],
	require => Class['mysql::server'],
}
