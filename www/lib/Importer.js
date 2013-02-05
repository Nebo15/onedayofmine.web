var Importer = {

    photos_count:0,
    photos:[],
    $days:$('.days'),
    $progress:$('.progress'),
    days:[],
    instagram_user:'self',

    import:function (hash) {
        Importer.$progress.show();

        $.ajax({
            dataType:"json",
            url:'https://api.instagram.com/v1/users/' + Importer.instagram_user + '/?callback=?',
            data:{access_token:hash},
            cache:true,
            success:function (user_response) {
                Importer.exportPhotos(user_response);
            }
        });
    },

    formatDate:function (photo) {
        return (new Date(photo.created_time * 1000)).toLocaleString();
    },

    setProgress:function(percents) {
        Importer.$progress.find('.bar').css('width', "" + percents + "%");
    },

    exportPhotos:function (user_response) {
        photos_count = user_response.data.counts.media;
        Importer.setProgress(5);
        Importer.getPhotos(photos_count, 'https://api.instagram.com/v1/users/' + Importer.instagram_user + '/media/recent/?access_token=' + hash + '&count=40&callback=?', function () {
            var cant_assemble = true;
            var current_day = [Importer.photos.shift()];
            for (i in Importer.photos) {
                prev_photo = current_day[current_day.length - 1];
                var photo = Importer.photos[i];
                if ((prev_photo.created_time - photo.created_time) < 4 * 60 * 60)
                    current_day.push(photo);
                else {
                    Importer.setProgress((95 + ((photos_count - Importer.photos.length) / photos_count * 0.1)) * 0.5);
                    if (current_day.length > 2) {
                        cant_assemble = false;
                        Importer.drawDay(Importer.$days, current_day, Importer.days.length);
                        Importer.days.push(current_day);
                    }
                    current_day = [Importer.photos[i]];
                }
            }
            if (current_day.length > 2) {
                cant_assemble = false;
                Importer.drawDay(Importer.$days, current_day, Importer.days.length);
                Importer.days.push(current_day);
            }
            Importer.photos = [];
            $('.carousel').carousel({interval:false});
            if (cant_assemble)
            {
                Importer.$progress.hide();
                $('.cant').show();
            }
        });
    },

    getPhotos:function (photos_count, url, callback) {
        $.ajax({
            dataType:"json",
            url:url,
            cache:true,
            success:function (photos_resp) {
                Importer.photos = Importer.photos.concat(photos_resp.data);
                Importer.setProgress((5 + Importer.photos.length / photos_count * 70) * 0.3);
                if (typeof photos_resp.pagination.next_max_id != 'undefined')
                    Importer.getPhotos(photos_count, url + '&max_id=' + photos_resp.pagination.next_max_id, callback);
                else
                    callback();
            }
        });
    },

    drawDay:function ($days, current_day, day_position) {
        var template = Handlebars.compile($("#day-item").html().split('[[').join('{{').split(']]').join('}}'));
        var view = {
            time: current_day[0] ? Importer.formatDate(current_day[0]) : '',
            moments: current_day,
            day_position: day_position
        };

        var $day = $($.trim(template(view)));
        var $out = $days.append($day.hide());

        $day.find('button.remove-photo-action').click(function(event) {
          console.log('remove: ' + $(this).attr('moment_id'));
        });

        $day.find('button.analyze-action').click(function(event) {
            var _day = Importer.days[$(this).parents('.well').attr('day_pos')];
            $days.hide();
            Importer.showAnalyzeStep($day, _day);
        });

        $day.slideDown('slow');
    },

    showAnalyzeStep:function($day, moments)
    {
        Importer.setProgress(55);
        Backend.PostRequest('days/analyze_instagram_day', {moments: moments}).done(function(response) {
            $day.find('.type').val(response.result.type);
            $day.find('.title').val(response.result.title);
            $day.find('.desc').val(response.result.description);
            $day.find('.export-action').click(function() {
               Importer.postDay({
                   type: $day.find('.type').val(),
                   title: $day.find('.title').val(),
                   desc: $day.find('.desc').val(),
                   moments: moments
               });
            });
            Importer.setProgress(75);
            $day.find('.step2').hide('slow');
            $day.find('.step3').show('slow');
        });
    },

    postDay:function (day_data) {
        FB.login(function (response) {
            if (!response.authResponse) return;
            Backend.Login(function () {
                Backend.PostRequest('days/start', {
                    title:day_data.title, type: day_data.type, final_description: day_data.desc
                }).done(function (day_response) {
                        var day = day_response.result;
                        var defs = [];
                        var is_sended = false;
                        $.each(day_data.moments, function (i, photo_data) {
                            defs.push(Backend.PostRequest('days/' + day.id + '/add_moment', {
                                time:Tools.getISODate(new Date(photo_data.created_time * 1000)),
                                image_url:photo_data.images.standard_resolution.url,
                                description:photo_data.caption ? photo_data.caption.text : ''
                            }));
                        });
                        $.when.apply(null, defs).then(function () {
                            window.location.href = '/pages/' + day.id + '/day';
                        });
                    });
            });
        });
    },

    getRemoteImageContent:function (url, callback) {
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
        }
    }
}
