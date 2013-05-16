include apt
include php
include mysql

group { 'puppet':
	ensure => present,
}

host { 'onedayofmine.dev':
    ip => '127.0.0.1',
    host_aliases => 'api.onedayofmine.dev',
}

exec { 'apt-get update':
	command => '/usr/bin/apt-get update',
}

package { 'git':
	ensure => present,
	require => Exec['apt-get update'],
}

###### nginx
package { 'nginx':
	ensure => present,
	require => Exec['apt-get update'],
}

service { 'nginx':
	ensure => running,
	require => Package['nginx']
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

###### php

class php {

	apt::ppa { "ppa:ondrej/php5": }

	package { 'php5-fpm': ensure => installed }
	package { 'php5-curl': ensure => installed }
	package { 'php5-imagick': ensure => installed }
	package { 'php5-memcached': ensure => installed }
	package { 'php5-mysqlnd': ensure => installed }

	class {
		'php::cli': ensure => installed;
		'php::dev': ensure => installed;
		'php::pear': ensure => installed;
	}

	package { 'libcurl3-openssl-dev': ensure => installed }
	package { 'pecl_http':
		ensure   => installed,
		provider => pecl;
	}
	file { "/etc/php5/conf.d/20-http.ini":
      ensure  => "present",
      content => "extension=http.so",
      mode    => 644,
      notify => Service['php5-fpm']
  }

	service { 'php5-fpm':
		ensure => running,
		require => Package['php5-fpm'],
	}
}

######## mysql

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
