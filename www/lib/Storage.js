var Storage = {
  set: function(key, value) {
    try {
      localStorage.setItem(key, JSON.stringify(value));
    } catch(e) {
      Storage.clear();
      // Retry
      localStorage.setItem(key, JSON.stringify(value));
    }
  },

  get: function(key) {
    var value = localStorage.getItem(key);
    return value && JSON.parse(value);
  },

  remove: function(key) {
    localStorage.removeItem(key);
  },

  clear: function() {
    localStorage.clear();
  }
};
