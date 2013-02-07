// Global helpers
(function() {
  String.prototype.hashCode = function() {
    var hash = 0, i, char;

    if (this.length === 0) return hash;

    for (i = 0; i < this.length; i++) {
      char = this.charCodeAt(i);
      hash = ((hash<<5)-hash)+char;
      hash = hash & hash; // Convert to 32bit integer
    }

    return hash;
  };

  $.isMobile = function() {
    var userAgent = window.navigator.userAgent;

    if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i) || userAgent.match(/iPod/i)) {
      return true;
    } else {
      return false;
    }
  };
})();

// Tools
var Tools = {
    resetToggle: function(toggle, active) {
        var handle = toggle.find('.toggle-handle');
        if(active === true) {
            toggle.addClass('active');
            handle.css('-webkit-transform', 'translate3d(47px,0,0)');
        } else {
            toggle.removeClass('active');
            handle.css('-webkit-transform', 'translate3d(0,0,0)');
        }
    },

    getISODate: function(date)
    {
        if(undefined == date)
            date = new Date();

        var pad = function(number) {
            var str = "" + number;
            while (str.length < 2) {
                str = '0'+str;
            }
            return str;
        };

        var timezone_offset = date.getTimezoneOffset();
        var offset = ((timezone_offset < 0 ? '+':'-') + // Note the reversed sign!
            pad(parseInt(Math.abs(timezone_offset/60))) + ':' +
            pad(Math.abs(timezone_offset%60)));

        return date.getUTCFullYear() + '-' + pad(date.getUTCMonth() + 1) + '-' +  pad(date.getUTCDate())  +
            'T' + pad(date.getUTCHours()) + ':' + pad(date.getUTCMinutes()) + ':' + pad(date.getUTCSeconds()) + offset;
    },

    prettyDate: function(time){
        var date = new Date(time),
            diff = (((new Date()).getTime() - date.getTime()) / 1000),
            day_diff = Math.floor(diff / 86400);

        if ( isNaN(day_diff) || day_diff < 0 || day_diff >= 31 )
            return;

        return day_diff == 0 && (
            diff < 60 && "just now" ||
                diff < 120 && "1 minute ago" ||
                diff < 3600 && Math.floor( diff / 60 ) + " minutes ago" ||
                diff < 7200 && "1 hour ago" ||
                diff < 86400 && Math.floor( diff / 3600 ) + " hours ago") ||
            day_diff == 1 && "Yesterday" ||
            day_diff < 7 && day_diff + " days ago" ||
            day_diff < 31 && Math.ceil( day_diff / 7 ) + " weeks ago";
    }
};
