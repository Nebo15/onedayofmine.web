$(function () {
  $('.brand').append('<i class="icon-play-circle"></i>');

  $('.icon-play-circle').click(function() {
    var MIN_HEIGHT = 30;
    var MIN_WIDTH = 30;
    var MAX_HEIGHT = 350;
    var MAX_WIDTH = 350;

    var CSS_BASE_CLASS = "mw-harlem_shake_me"
    var CSS_FIRST_CLASS = "im_first";
    var CSS_OTHER_CLASSES = ["im_drunk", "im_baked", "im_trippin", "im_blown", "im_spinning"];

    var CSS_STROBE_CLASS = "mw-strobe_light";

    var PATH_TO_CSS = "//s3.amazonaws.com/moovweb-marketing/playground/harlem-shake-style.css";
    var FILE_ADDED_CLASS = "mw_added_css"

    function addCSS() {
      var css = document.createElement("link");
      css.setAttribute("type", "text/css");
      css.setAttribute("rel", "stylesheet");
      css.setAttribute("href", PATH_TO_CSS);
      css.setAttribute("class", FILE_ADDED_CLASS);

      document.body.appendChild(css);
    }

    function addSound() {
      $('body').append('<div style=" height:0px; width:0px; overflow:hidden;"><audio controls="controls" id="hs-sound"><source src="http://hsmaker.com/sound/harlemshake.ogg" type="audio/ogg" /></audio></div>');
    }

    function removeAddedFiles() {
      var addedFiles = document.getElementsByClassName(FILE_ADDED_CLASS);
      for (var i=0; i<addedFiles.length; i++) {
        document.body.removeChild(addedFiles[i]);
      }
    }

    function flashScreen() {
      var flash = document.createElement("div");
      flash.setAttribute("class", CSS_STROBE_CLASS);
      document.body.appendChild(flash);

      setTimeout(function() {
        document.body.removeChild(flash);
      }, 100);
    }

    function size(node) {
      return {
        height: node.offsetHeight,
        width: node.offsetWidth
      };
    }

    function withinBounds(node) {
      var nodeFrame = size(node);
      return (nodeFrame.height > MIN_HEIGHT &&
              nodeFrame.height < MAX_HEIGHT &&
              nodeFrame.width > MIN_WIDTH &&
              nodeFrame.width < MAX_WIDTH);
    }

    function posY(elm) {
      var test = elm;
      var top = 0;
      while (!!test) {
        top += test.offsetTop;
        test = test.offsetParent;
      }
      return top;
    }

    function viewPortHeight() {
      var de = document.documentElement;
      if (!!window.innerWidth) {
        return window.innerHeight;
      } else if (de && !isNaN(de.clientHeight)) {
        return de.clientHeight;
      }
      return 0;
    }

    function scrollY() {
      if (window.pageYOffset) {
        return window.pageYOffset;
      }
      return Math.max(document.documentElement.scrollTop, document.body.scrollTop);
    }

    var vpH = viewPortHeight();
    var st = scrollY();
    function isVisible(node) {
      var y = posY(node);

      return (y >= st && y <= (vpH + st));
    }

    function playSong() {
        setTimeout(function() {
          shakeFirst(firstNode);
        }, 800);

        // setTimeout
        setTimeout(function() {
          stopShakeAll();
          flashScreen();
          for (var i=0; i<allShakeableNodes.length; i++) {
            shakeOther(allShakeableNodes[i]);
          }
          setTimeout(function() {
            stopShakeAll();
          }, 14300);
        }, 15600);

       }

    function shakeFirst(node) {
      node.className += " "+CSS_BASE_CLASS+" "+CSS_FIRST_CLASS;
    }
    function shakeOther(node) {
      node.className += " "+CSS_BASE_CLASS+" "+CSS_OTHER_CLASSES[Math.floor(Math.random()*CSS_OTHER_CLASSES.length)];
    }

    function stopShakeAll() {
      $('.im_drunk, .im_baked, .im_trippin, .im_blown, .im_first, .im_spinning').removeClass('im_drunk im_baked im_trippin im_blown im_spinning im_first ' + CSS_BASE_CLASS);
    }

    // get first item
    var allNodes = document.getElementsByTagName("*");
    var firstNode = $('a.brand')[0];

    // Play sound
    addSound();

    // insert CSS
    addCSS();

    // play song
    playSong();

    var allShakeableNodes = $('button, a, input, textarea, .bubble, .moment-image-container, h1, h2, h3, b, dl');

    $('#hs-sound')[0].play();

    return false;
  });
});
