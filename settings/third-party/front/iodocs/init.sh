#!/bin/sh

PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin
DAEMON=/usr/bin/node
NAME="iodocs-odom"
DESC="iodocs for onedayofmine.com"

test -x $DAEMON || exit 0

set -e

iodoc_start() {
	start-stop-daemon --start -v --chdir /www/iodocs --background --make-pidfile --chuid www-data:www-data \
	--pidfile /var/run/$NAME.pid --exec $DAEMON -- "app.js" || true
}

iodocs_stop() {
	start-stop-daemon --stop --pidfile /var/run/$NAME.pid || true
}

case "$1" in
	start)
		iodoc_start
		;;

	stop)		
		iodocs_stop
		;;

	restart)
		iodocs_stop
		iodoc_start
		;;	
	*)
		echo "Usage: $NAME {start|stop|restart}" >&2
		exit 1
		;;
esac

exit 0
