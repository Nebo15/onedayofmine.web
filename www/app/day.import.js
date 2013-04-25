$(function() {
  if(day_data.is_template) {
    var $import_btn = $('.action-import');
    $import_btn.click(function() {
      if($import_btn.hasClass('disabled')) {
        return;
      }

      $import_btn.addClass('disabled');

      var messages = [
        "Calculating white pixels…",
        "It's better to dont know, trust me",
        "Closed for dinner",
        "It's gonna be legen… wait for it…"
      ];

      var animations_speed = 400;

      var modal_template = $('#template_day_import_modal').html();
      var $modal = $($.parseHTML(modal_template)).filter('.day-import-modal');
      var $body = $modal.find('.modal-body');
      var $progress = $body.find('.import-progress');
      var $progress_message = $body.find('.text');
      var $progress_bar = $progress.find('.bar');

      function setProgress(percents, callback) {
        $progress_bar.css('width', percents + '%');

        if(percents === 100) {
          setTimeout(function() {
            $progress.slideUp(animations_speed, callback);
          }, 500);
        } else if($progress.css('display') == 'none') {
          $progress_message.text(messages[Math.floor(Math.random()*messages.length)]);
          $progress.slideDown(animations_speed);
        }
      }

      $('body').append($modal);
      $modal.modal('show');
      setProgress(0);

      API.post('days/start', { title: day_data.title, type:'Working day' }).success(function(resp) {
        var day = resp.data.result;
        var step_percentage = 100/(day_data.moments.length+1);
        setProgress(step_percentage);

        var requests = [];
        var finished_count = 1;

        $.each(day_data.moments, function(index, moment) {
          var moment_data = {
            time:         day_data.date + 'T' + moment.time + ':' + '00' + Tools.getTimezone(),
            image_url:    moment.image_532,
            description:  moment.description
          };

          var moment_create_request = API.request('POST', 'days/' + day.id + '/add_moment', moment_data);

          moment_create_request.success(function (response) {
            finished_count++;
            setProgress(finished_count*step_percentage+1);
          });

          requests.push(moment_create_request.send());
        });

        $.when.apply($, requests).then(function() {
          window.location.href = "/pages/" + day.id + '/day';
        });
      }).send();
    });
  }
});
