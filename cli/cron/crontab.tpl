* *	* * *	www-data cd /www/onedayofmine/; ./cli/cron/1_min.sh >> ./var/logs/cron.log 2>&1
*/5 *	* * *	www-data cd /www/onedayofmine/; ./cli/cron/5_min.sh >> ./var/logs/cron.log 2>&1
1 *	* * *	www-data cd /www/onedayofmine/; ./cli/cron/hourly.sh >> ./var/logs/cron.log 2>&1
1 4	* * *	www-data cd /www/onedayofmine/; ./cli/cron/daily.sh >> ./var/logs/cron.log 2>&1
