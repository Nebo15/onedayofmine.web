<?php

$dir = realpath(__DIR__.'/..');
$log_str = " >> $dir/var/logs/cron.log 2>&1\n";

echo "*/5 *	* * *	www-data cd $dir; ./limb od_calc_ratings $log_str";
echo "* *	* * *	www-data cd $dir; ./limb od_job_worker $log_str";

# Sphinx
## Users
$sphinx_config = "--config $dir/settings/third-party/sphinx/sphinx.conf";
echo "* * * * * sphinxsearch indexer $sphinx_config --rotate users_delta $log_str";
echo "* * * * * sphinxsearch indexer $sphinx_config --rotate --merge users users_delta $log_str";
echo "1 4 * * * sphinxsearch indexer $sphinx_config--rotate -users $log_str";
## Days
echo "* * * * * sphinxsearch indexer $sphinx_config --rotate days_delta $log_str";
echo "* * * * * sphinxsearch indexer $sphinx_config --rotate --merge days days_delta $log_str";
echo "1 4	* * *	sphinxsearch indexer $sphinx_config --rotate days $log_str";
