var Storage = {
  set: function(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
  },

  get: function(key) {
    var value = localStorage.getItem(key);
    return value && JSON.parse(value);
  },

  clear: function() {
    localStorage.clear();
  }
};
