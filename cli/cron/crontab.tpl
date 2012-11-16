* *	* * *	www-data cd /www/onedayofmine/; ./cli/cron/1_min.sh >> ./var/logs/cron.log 2>&1
*/5 *	* * *	www-data cd /www/onedayofmine/; ./cli/cron/5_min.sh >> ./var/logs/cron.log 2>&1
1 *	* * *	www-data cd /www/onedayofmine/; ./cli/cron/hourly.sh >> ./var/logs/cron.log 2>&1
1 4	* * *	www-data cd /www/onedayofmine/; ./cli/cron/daily.sh >> ./var/logs/cron.log 2>&1

# Sphinx
## Users
* * * * * sphinxsearch indexer --config /www/onedayofmine/settings/third-party/sphinx/sphinx.conf --rotate --quiet users_delta
* * * * * sphinxsearch indexer --config /www/onedayofmine/settings/third-party/sphinx/sphinx.conf --rotate --quiet --merge users users_delta
1 4 * * * sphinxsearch indexer --config /www/onedayofmine/settings/third-party/sphinx/sphinx.conf --rotate --quiet users
## Days
* * * * * sphinxsearch indexer --config /www/onedayofmine/settings/third-party/sphinx/sphinx.conf --rotate --quiet days_delta
* * * * * sphinxsearch indexer --config /www/onedayofmine/settings/third-party/sphinx/sphinx.conf --rotate --quiet --merge days days_delta
1 4	* * *	sphinxsearch indexer --config /www/onedayofmine/settings/third-party/sphinx/sphinx.conf --rotate --quiet days
