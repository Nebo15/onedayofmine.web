// Global helpers
(function () {
	String.prototype.hashCode = function () {
		var hash = 0, i, char;

		if (this.length === 0) return hash;

		for (i = 0; i < this.length; i++) {
			char = this.charCodeAt(i);
			hash = ((hash << 5) - hash) + char;
			hash = hash & hash; // Convert to 32bit integer
		}

		return hash;
	};

	$.isMobile = function () {
		var userAgent = window.navigator.userAgent;

		return userAgent.match(/iPad/i) || userAgent.match(/iPhone/i) || userAgent.match(/iPod/i);
	};
})();

// Tools
var Tools = {
	resetToggle: function (toggle, active) {
		var handle = toggle.find('.toggle-handle');
		if (active === true) {
			toggle.addClass('active');
			handle.css('-webkit-transform', 'translate3d(47px,0,0)');
		} else {
			toggle.removeClass('active');
			handle.css('-webkit-transform', 'translate3d(0,0,0)');
		}
	},

	getISODate: function (date) {
		if (undefined == date)
			date = new Date();

		var pad = function (number) {
			var str = "" + number;
			while (str.length < 2) {
				str = '0' + str;
			}
			return str;
		};

		var timezone_offset = date.getTimezoneOffset();
		var offset = ((timezone_offset < 0 ? '+' : '-') + // Note the reversed sign!
				pad(parseInt(Math.abs(timezone_offset / 60))) + ':' +
				pad(Math.abs(timezone_offset % 60)));

		return date.getFullYear() + '-' + pad(date.getMonth() + 1) + '-' + pad(date.getDate()) +
				'T' + pad(date.getHours()) + ':' + pad(date.getMinutes()) + ':' + pad(date.getSeconds()) + offset;
	},

	prettyDate: function (time) {
		console.log(time);
		var date = new Date(time),
				diff = (((new Date()).getTime() - date.getTime()) / 1000),
				day_diff = Math.floor(diff / 86400);

		if (isNaN(day_diff) || day_diff < 0)
			return;

		return day_diff == 0 && (
				diff < 60 && "just now" ||
						diff < 120 && "1 minute ago" ||
						diff < 3600 && Math.floor(diff / 60) + " minutes ago" ||
						diff < 7200 && "1 hour ago" ||
						diff < 86400 && Math.floor(diff / 3600) + " hours ago") ||
				day_diff == 1 && "Yesterday" ||
				day_diff < 7 && day_diff + " days ago" ||
				Math.ceil(day_diff / 7) + " weeks ago";
	},

	createDateObject: function (date, time, timezone) {
		var date_pieces = date.split('-');
		var time_pieces = time.split(':');
		var timezone_pieces = timezone.split(':');

		// Returns in UTC Timezone
		var obj = new Date();

		obj.setUTCFullYear(parseInt(date_pieces[0], 10));
		obj.setUTCMonth(parseInt(date_pieces[1], 10) - 1);
		obj.setUTCDate(parseInt(date_pieces[2], 10));

		if (timezone.substring(0, 1) == '+') {
			obj.setUTCHours(parseInt(time_pieces[0], 10) - Math.abs(parseInt(timezone_pieces[0], 10)));
			obj.setUTCMinutes(parseInt(time_pieces[1], 10) - Math.abs(parseInt(timezone_pieces[1], 10)));
		} else {
			obj.setUTCHours(parseInt(time_pieces[0], 10) + Math.abs(parseInt(timezone_pieces[0], 10)));
			obj.setUTCMinutes(parseInt(time_pieces[1], 10) + Math.abs(parseInt(timezone_pieces[1], 10)));
		}
		obj.setUTCSeconds(parseInt(time_pieces[2], 10));

		return obj;
	},

	addPrefixZeros: function (number) {
		if (number < 10) {
			number = '0' + number;
		}
		return number;
	},

	getDate: function (obj) {
		if (obj === undefined) {
			obj = new Date();
		}
		var dd = Tools.addPrefixZeros(obj.getDate());
		var mm = Tools.addPrefixZeros(obj.getMonth() + 1); //January is 0!
		var yyyy = obj.getFullYear();
		return yyyy + '-' + mm + '-' + dd;
	},

	getTime: function (obj) {
		if (obj === undefined) {
			obj = new Date();
		}
		var hh = Tools.addPrefixZeros(obj.getHours());
		var mm = Tools.addPrefixZeros(obj.getMinutes());
		return hh + ':' + mm;
	},

	getSeconds: function (obj) {
		if (obj === undefined) {
			obj = new Date();
		}
		return Tools.addPrefixZeros(obj.getSeconds());
	},

	getTimezone: function (obj) {
		if (obj === undefined) {
			obj = new Date();
		}
		return Tools.minutesToHours(-1 * obj.getTimezoneOffset());
	},

	minutesToHours: function (minutes) {
		minutes = minutes.toString();
		var sign = minutes.substring(0, 1);
		if (sign != '-') {
			sign = '+';
		}

		minutes = Math.abs(parseInt(minutes, 10));
		var hours = Math.floor(minutes / 60);
		minutes = minutes % 60;

		return sign + Tools.addPrefixZeros(hours) + ':' + Tools.addPrefixZeros(minutes);
	},

	getRemoteImageContent: function (url, callback) {
		var img = new Image();
		img.src = url;
		img.onload = function () {
			var canvas = document.createElement("canvas");
			canvas.width = img.width;
			canvas.height = img.height;
			var ctx = canvas.getContext("2d");
			ctx.drawImage(img, 0, 0);
			var encoded = canvas.toDataURL("image/jpg");
			callback(encoded.substring(encoded.indexOf('base64,') + 7));
		};
	}
};
