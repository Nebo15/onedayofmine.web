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
class { 'apt':
  always_apt_update => true,
}

package { 'git':
	ensure => present,
	require => Exec['apt-get update'],
}

class odom-nginx
{
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
		 notify => Service['nginx'],
	}

	file { '/etc/nginx/sites-enabled/onedayofmine':
		 target => '/www/onedayofmine/settings/third-party/front/nginx/oneday-dev.conf',
		 ensure => 'link',
		 require => Package['nginx'],
		 notify => Service['nginx'],
	}

	file { 'default-nginx-disable':
		path => '/etc/nginx/sites-enabled/default',
		ensure => absent,
		require => Package['nginx'],
		notify => Service['nginx'],
	}
}

class odom-php
{

	package { ['php5', 'php5-fpm', 'php5-cli', 'php5-curl', 'php5-imagick', 'php5-mysqlnd', 'php-pear']:
		ensure => installed,
	}

	package { 'libcurl3-openssl-dev': ensure => installed }
	exec { 'install_pecl_http':
		command => '/usr/bin/pecl install pecl_http',
		onlyif => '/usr/bin/pecl shell-test pecl_http | !',
		require => [Package['libcurl3-openssl-dev'], Package['php-pear']],
	}
	file { "/etc/php5/conf.d/20-http.ini":
      ensure  => "present",
      content => "extension=http.so",
      mode    => 644,
      notify => Service['php5-fpm'],
      require => Exec['install_pecl_http'],
  }

	service { 'php5-fpm':
		ensure => running,
		require => Package['php5-fpm'],
	}
}


class odom-mysql
{
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
}

class odom-sphinx
{
	package { ['sphinxsearch', 'libsphinxbase-dev']:
		ensure => present,
		require => Exec['apt-get update'],
	}

	service { 'sphinxsearch':
		ensure => running,
		require => Package['sphinxsearch']
	}

	file { '/etc/sphinxsearch/sphinx.conf':
		target => '/www/onedayofmine/settings/third-party/sphinx/sphinx.conf',
		ensure => 'link',
		require => Package['sphinxsearch'],
		notify => Service['sphinxsearch'],
  }
}

node default
{
	include odom-nginx
	include odom-php
	include odom-mysql
	include odom-sphinx

	exec { 'install crons':
  	command => '/usr/bin/php /www/onedayofmine/lib/limb/limb.php od_create_crontab /etc/cron.d/onedayofmine',
  	require => Package['php5-cli'],
  }
}