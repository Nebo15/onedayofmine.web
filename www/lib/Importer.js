var Importer = {

	chunk_size:3,
	photos_in_day_min:3,
	photos_count:0,
	photos:[],
	$days:$('.days'),
	$progress:$('.progress'),
	days:[],
	instagram_hash:null,
	instagram_user:'self',
	instagram_url:null,

	instagramUrl:function (url) {
		if (url)
			Importer.instagram_url = url;
		else {
			if (Importer.instagram_url)
				return Importer.instagram_url
			else
				return 'https://api.instagram.com/v1/users/' + Importer.instagram_user +
						'/media/recent/?access_token=' + Importer.hash + '&count=40&callback=?';
		}
	},

	findUser:function (name, callback) {
		$.ajax({
			dataType:"json",
			url:'https://api.instagram.com/v1/users/search/?callback=?',
			data:{access_token:hash, q:name},
			cache:true,
			success:function (user_response) {
				callback(user_response.data[0]);
			}
		});
	},

	import:function (hash) {
		Importer.hash = hash;
		$.ajax({
			dataType:"json",
			url:'https://api.instagram.com/v1/users/' + Importer.instagram_user + '/?callback=?',
			data:{access_token:hash},
			cache:true,
			success:function (user_response) {
				Importer.exportPhotos(user_response);
				if(Importer.days.length == 0)
        	$('.cant').show();
			}
		});
	},

	formatDate:function (photo) {
		return (new Date(photo.created_time * 1000)).toLocaleString();
	},

	setProgress:function (percents) {
		percents = parseInt(percents);
		Importer.$progress.show();
		if (100 == percents)
			Importer.$progress.hide();
		Importer.$progress.find('.bar-success').css('width', "" + percents + "%");
	},

	isRequestNeeded:function (photos) {
		photos = Importer.photos.concat(photos);
		var days_counter = Importer.chunk_size;
		var current_day = [photos.shift()];
		while (photos.length != 0) {
			prev_photo = current_day[current_day.length - 1];
			var photo = photos.shift();
			if ((prev_photo.created_time - photo.created_time) < 4 * 60 * 60)
				current_day.push(photo);
			else {
				if (current_day.length >= 3) {
					Importer.drawDay(Importer.$days, current_day, Importer.days.length);
					Importer.days.push(current_day);
					days_counter--;
				}
				current_day = [photo];
			}
		}
		if (current_day.length >= 3) {
			Importer.drawDay(Importer.$days, current_day, Importer.days.length);
			Importer.days.push(current_day);
			days_counter--;
			current_day = [];
		}
		Importer.photos = current_day.length && current_day[0] ? current_day : [];
		if (days_counter <= 0)
			return false;
		else
			return true;
	},

	exportPhotos:function () {
		if (true == Importer.isRequestNeeded(Importer.photos)) {
			Importer.getPhotos(function (photos) {
				return Importer.isRequestNeeded(photos);
			});
		}
	},

	getPhotos:function (callback) {
		$.ajax({
			dataType:"json",
			url:Importer.instagramUrl(),
			cache:true,
			success:function (photos_resp) {
				Importer.instagramUrl(Importer.instagramUrl() + '&max_id=' + photos_resp.pagination.next_max_id);
				var photos = photos_resp.data;
				$.each(photos, function (i, photo) {
					photos[i].likes = null;
					photos[i].user = null;
					photos[i].comments = null;
				});
				if (typeof photos_resp.pagination.next_max_id == 'undefined')
					callback(photos);
				else if (false == callback(photos))
					return;
				else {
					Importer.getPhotos(callback);
				}
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

		$day.find('.remove-photo-action').click(function (event) {
			var day_pos = $(this).attr('day_pos');
			var moment_id = $(this).attr('moment_id');
			var $img = $(this).find('img');
			console.log(event);

			if ($img.css('opacity') == '1') {
				$img.css('opacity', '0.3');
				$.each(Importer.days[day_pos], function (i, moment) {
					if (moment.id == moment_id)
						Importer.days[day_pos][i].skip = true;
				});
			}
			else {
				$img.css('opacity', '1');
				$.each(Importer.days[day_pos], function (i, moment) {
					if (moment.id == moment_id)
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
		$('.export-action').show();
	},

	showAnalyzeStep:function ($day, moments) {
		$(window).scrollTo($day, 300);
		var analyze_request = API.request('POST', 'days/analyze_instagram_day', {moments:moments});
		analyze_request.success(function (response) {
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
				$.each(moments, function (i, moment) {
					if (moment.skip == undefined || moment.skip == false)
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
		}).success(function (response) {
					var day = response.data.result;
					var defs = [];
					var is_sended = false;
					var defs_finished = 0;
					$.each(day_data.moments, function (i, photo_data) {
						var moment_request = API.request('POST', 'days/' + day.id + '/add_moment', {
							time:Tools.getISODate(new Date(photo_data.created_time * 1000)),
							image_url:photo_data.images.standard_resolution.url,
							description:photo_data.caption ? photo_data.caption.text : '',
							instagram_id:photo_data.id
						});

						moment_request.success(function (response) {
							defs_finished++;
						});

						defs.push(moment_request.send());
					});
					$.when.apply(null, defs).then(function () {
						$day.html('<div class="alert alert-success">' +
								'Day successfully imported. View <a href="/pages/' + response.data.result.id + '/day">result</a>.' +
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
