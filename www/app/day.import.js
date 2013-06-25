$(function() {
  if(import_data) {
    var $import_btn = $('.action-import');
    $import_btn.click(function() {
      if($import_btn.hasClass('disabled')) {
        return;
      }

      $import_btn.addClass('disabled');

      var messages = [
        //"Calculating white pixels…",
        //"It's better to don't know, trust me",
        //"Closed for dinner",
        "It's gonna be legen… wait for it…"
      ];

      var animations_speed = 400;

      var modal_template = $('#template_day_import_modal').html();
      var $modal = $($.parseHTML(modal_template)).filter('.day-import-modal');
      var $body = $modal.find('.modal-body');
      var $progress = $body.find('.import-progress');
      var $progress_message = $body.find('.text');
      var $progress_bar = $progress.find('.bar');

      function setProgress(percents, message, callback) {
        $progress_bar.css('width', percents + '%');
				$progress_message.text(message);

        if(percents === 100) {
          setTimeout(function() {
            $progress.slideUp(animations_speed, callback);
          }, 500);
        } else if($progress.css('display') == 'none') {
          $progress.slideDown(animations_speed);
        }
      }

      $('body').append($modal);
      $modal.modal('show');
      setProgress(0, "Let the carnage begin!");

      API.post('days/start', { title: import_data.title, type:'Working day' }).success(function(resp) {
        var day = resp.data.result;
        var step_percentage = 100/(import_data.moments.length+1);
        setProgress(step_percentage, messages[Math.floor(Math.random()*messages.length)]);
        var finished_count = 1;

        var index = 0;
        var iterative_resuest = function() {
          console.log('importing');
          if(import_data.moments.length > 0) {
            var moment = import_data.moments.shift();
            console.log(moment);

            var moment_create_request = API.request('POST', 'days/' + day.id + '/add_moment', {
              time:         import_data.date + 'T' + moment.time + ':' + '00' + Tools.getTimezone(),
              position:     index,
              image_url:    moment.image_532,
              description:  moment.description
            });

            moment_create_request.success(function (response) {
              finished_count++;
              setProgress(finished_count*step_percentage+1, messages[Math.floor(Math.random()*messages.length)]);
              index++;
              iterative_resuest();
            });

            moment_create_request.send();
          } else {
            window.location.href = "/pages/" + day.id + '/day';
          }
        };

        // Start importing
        iterative_resuest();
      }).send();
    });
  }
});
