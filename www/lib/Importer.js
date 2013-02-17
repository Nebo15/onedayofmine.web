var Importer = {

    photos_count:0,
    photos:[],
    $days:$('.days'),
    $progress:$('.progress'),
    days:[],
    instagram_user:'self',

    import:function (hash) {
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

    setProgress:function (percents) {
        Importer.$progress.show();
        Importer.$progress.find('.bar-danger').css('width', "" + (percents > 50 ? 50 : percents) + "%");
        percents -= 50;
        Importer.$progress.find('.bar-warning').css('width', "" + (percents > 25 ? 25 : percents) + "%");
        percents -= 25;
        Importer.$progress.find('.bar-success').css('width', "" + (percents > 25 ? 25 : percents) + "%");
        if(100 == percents)
            Importer.$progress.hide();
    },

    exportPhotos:function (user_response) {
        photos_count = user_response.data.counts.media;
        Importer.setProgress(5);
        Importer.getPhotos(photos_count, 'https://api.instagram.com/v1/users/' + Importer.instagram_user + '/media/recent/?access_token=' + hash + '&count=40&callback=?', function () {
            console.log(Importer.photos[0]);
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
            if (cant_assemble) {
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
            time:current_day[0] ? Importer.formatDate(current_day[0]) : '',
            moments:current_day,
            day_position:day_position
        };

        var $day = $($.trim(template(view)));
        var $out = $days.append($day.hide());

        $day.find('button.remove-photo-action').click(function (event)
        {
            var day_pos = $(this).attr('day_pos');
            var moment_id = $(this).attr('moment_id');

            if($(this).hasClass('btn-info'))
            {
                $(this).removeClass('btn-info').addClass('btn-primary').html('Restore');
                $(this).parent().parent().find('img').css('opacity', '0.3');

                $.each(Importer.days[day_pos], function(i, moment) {
                    if(moment.id == moment_id)
                        Importer.days[day_pos][i].skip = true;
                });
            }
            else
            {
                $(this).removeClass('btn-primary').addClass('btn-info').html('Skip');
                $(this).parent().parent().find('img').css('opacity', '1');

                $.each(Importer.days[day_pos], function(i, moment) {
                    if(moment.id == moment_id)
                        Importer.days[day_pos][i].skip = false;
                });
            }
        });

        $day.find('button.analyze-action').click(function (event) {
            $(this).addClass('disabled');
            $(this).html('<i class="icon-large icon-refresh icon-spin"></i> Analyze...');
            var _day = Importer.days[$(this).parents('.well').attr('day_pos')];
            Importer.showAnalyzeStep($day, _day);
        });

        $day.slideDown('slow');
    },

    showAnalyzeStep:function ($day, moments) {
        $(window).scrollTo($day, 300);
        Importer.setProgress(55);
        var analyze_request = API.request('POST', 'days/analyze_instagram_day', {moments:moments});
        analyze_request.success(function(response) {
            var result = response.data.result;
            $day.find('.type').val(result.type);
            $day.find('.title').val(result.title);
            $day.find('.desc').val(result.description);
            $day.find('.export-action').click(function (event) {
                $(this).addClass('disabled');
                $(this).html('<i class="icon-large icon-refresh icon-spin"></i> Sending...');
                if (!$day.find('.title').val()) {
                    $day.find('.title').parent().parent().addClass('error');
                    return;
                }
                var moments_to_export = [];
                $.each(moments, function(i, moment) {
                   if(moment.skip == undefined || moment.skip == false)
                     moments_to_export.push(moment);
                });
                Importer.postDay($day, {
                    type:$day.find('.type').val(),
                    title:$day.find('.title').val(),
                    desc:$day.find('.desc').val(),
                    moments:moments_to_export
                });
                return false;
            });
            Importer.setProgress(75);
            $day.find('.step2').hide('slow');
            $day.find('.step3').show('slow');
        });

        analyze_request.send();
    },

    postDay:function ($day, day_data) {
        var day_request = API.request('POST', 'days/start', {
            title:day_data.title,
            type:day_data.type,
            final_description:day_data.desc
        }).success(function(response) {
            var day = response.data.result;
            var defs = [];
            var is_sended = false;
            var defs_finished = 0;
            $.each(day_data.moments, function (i, photo_data) {
                var moment_request = API.request('POST', 'days/' + day.id + '/add_moment', {
                    time:Tools.getISODate(new Date(photo_data.created_time * 1000)),
                    image_url:photo_data.images.standard_resolution.url,
                    description:photo_data.caption ? photo_data.caption.text : ''
                });

                moment_request.success(function(response) {
                  defs_finished++;
                  Importer.setProgress(75 + (defs_finished / defs.length) * 25);
                });

                defs.push(moment_request.send());
            });
            $.when.apply(null, defs).then(function () {
                $day.html('<div class="alert alert-success">'+
                    'Day successfully imported. View <a href="/pages/'+response.data.result.id+'/day">result</a>.'+
                '</div>').removeClass('well');
                Importer.$progress.hide();
            });
        }).send();
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
        };
    }
};
