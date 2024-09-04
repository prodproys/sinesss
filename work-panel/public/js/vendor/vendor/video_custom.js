
var video_holder = null;//cache jquery object

/**polyfill Android that doesnt have canPlayType() */
var ua = window.navigator.userAgent.toLowerCase();
if (ua.match(/android 2\.[12]/) !== null) {
	HTMLMediaElement.prototype.canPlayType = function(type) {
		return (type.match(/video\/(mp4|m4v)/gi) !== null) ? 'maybe' : '';
	}
}


/** on page load*/
// function ready(id) {

// 	video_holder = $('#video_holder');
// 	load_showreel("sd", id);

// }

/** add hd button to the video js control*/
function addHDButton(nextQuality) {

	$(".vjs-controls").append(
			'<div class="vjs-hd-control" title="Switch to High Definition"><span>'
					+ nextQuality + '</span></div>');

	var hd = $(".vjs-hd-control span");
	if (nextQuality == "hd") {
		hd.removeClass("hd_on");
		hd.attr("title", "Switch to High Definition");
	} else {
		hd.addClass("hd_on");
		hd.attr("title", "Switch to Low Definition");
	}

}

/**Load a new video with 3 != sources in a @quality and 3 != optional sources in the other quality to an empty div video container #idvideocontainer */
function loadVideo(idvideocontainer, quality, autoplay, 
		elem,
		poster,
		title,
		mp4_bis, ogg_bis, webm_bis,
		mp4, ogg, webm
		) {

		// mp4='http://videos_test.qualitri-dev.com/FRGGG_Parent_V2_VDBD.mp4';
		// mp4='http://videonostream.tenlight.com/FR/Public/FRGGG_Parent_V2_VDBD.mp4';
		//mp4='http://videos_test.qualitri-dev.com/big_buck_bunny.mp4';

	//var poster='';

	/** Add video tag*/
	var tagname = +new Date();
	tagname = "video" + tagname;

	var container = document.getElementById(idvideocontainer);
	var $container = $(container);
	container.innerHTML = '<video id="' + tagname
			+ '" class="video-js" width="' + $container.width()
			+ '" height="' + $container.height()
			+ '" controls preload="auto" poster="'+poster+'"></video>';

	var videodom = document.getElementById(tagname);
	var video = $(videodom);

	/**selected button*/
	$(elem).parent().parent().children().removeClass('on');
	$(elem).parent().addClass('on');

	/**add sources*/

	var sources = "";
	if (mp4 != null)
		sources += '<source src="' + mp4 + '" type="video/mp4">';
	if (ogg != null)
		sources += '<source src="' + ogg + '" type="video/ogg">';
	if (webm != null)
		sources += '<source src="' + webm + '" type="video/webm">';
		video.append(sources);
	if (!video.children('source').length) { // set src&type attribute for ie9/android3.1 because it does not add the source child-elements
		video.attr('src', mp4).attr('type', 'video/mp4');
	}

	/* video js */
	var idvideo = video.attr('id');
	//console.log(idvideo);

	var ready = function() {
		if (autoplay)
			this.play();
	};

	if (mp4_bis || ogg_bis || webm_bis) {

		ready = function() {
                   
            $("#video").append('<div class="title">'+title+'</div>');		

			if (autoplay)
				this.play();

			$(".vjs-fullscreen-control").attr("title",
					"Fullscreen/Standart View");

			var nextQuality = quality == "sd" ? "hd" : "sd";
			addHDButton(nextQuality);
			$(".vjs-hd-control")
					.click(
							function() {				
								videodom.pause();
								container.innerHTML = "";
								loadVideo(idvideocontainer, nextQuality,true, 	
										elem,
										poster,
										title,
										mp4, ogg, webm,
										mp4_bis, ogg_bis, webm_bis
										);

							});

			this.addEvent("pause", function(){ 
				$('#'+idvideo+' video').hide(); 
			});

			this.addEvent("play", function(){ 
			 	$('#'+idvideo+' video').show();
			});			

		}
	}

	_V_(idvideo).ready(ready);

}

// function load_showreel(quality, id) {
// 	if ($("#videotag"))
// 		$("#videotag").remove();
// 	video_holder.html("Loading Video...");
// 	video_holder.show();
// 	var tagname = +new Date();
// 	tagname = "video" + tagname;
// 	$.ajax({
// 		type : "POST",
// 		url : "video.php",
// 		data : "tagname=" + tagname + "&quality=" + quality + "&id=" + id,
// 		success : function(msg) {
// 			video_holder.html(msg);

// 			_V_(tagname).ready(
// 					function() {

// 						addHDButton(quality);

// 						$(".vjs-hd-control").click(function() {
// 							pauseVideo();
// 							if (quality == "sd")
// 								load_showreel("hd");
// 							else
// 								load_showreel("sd");
// 						}

// 						);

// 						$(".vjs-fullscreen-control").attr("title",
// 								"Fullscreen/Standart View");

// 						if (window.played_before)
// 							playVideo();

// 						window.played_before = 1;
// 					});

// 		}
// 	});
// }

	function loadVideo2(idvideocontainer, quality, autoplay, mp4, ogg, webm,
			mp4_bis, ogg_bis, webm_bis) {

		/** Add video tag*/
		var tagname = +new Date();
		tagname = "video" + tagname;

		var container = document.getElementById(idvideocontainer);
		var $container = $(container);
		container.innerHTML = '<video id="' + tagname
				+ '" class="video-js" width="' + $container.width()
				+ '" height="' + $container.height()
				+ '" controls preload="auto" poster=""></video>';

		var videodom = document.getElementById(tagname);
		var video = $(videodom);

		/**add sources*/

		var sources = "";
		if (mp4 != null)
			sources += '<source src="' + mp4 + '" type="video/mp4">';
		if (ogg != null)
			sources += '<source src="' + ogg + '" type="video/ogg">';
		if (webm != null)
			sources += '<source src="' + webm + '" type="video/webm">';
		video.append(sources);
		if (!video.children('source').length) { // set src&type attribute for ie9/android3.1 because it does not add the source child-elements
			video.attr('src', mp4).attr('type', 'video/mp4');
		}

		/* video js */
		var idvideo = video.attr('id');
		//console.log(idvideo);

		var ready = function() {
			if (autoplay)
				this.play();
		};

		if (mp4_bis || ogg_bis || webm_bis) {

			ready = function() {

				if (autoplay)
					this.play();

				$(".vjs-fullscreen-control").attr("title",
						"Fullscreen/Standart View");

				var nextQuality = quality == "sd" ? "hd" : "sd";
				addHDButton(nextQuality);

				$(".vjs-hd-control")
						.click(
								function() {									
									videodom.pause();
									container.innerHTML = "";
									loadVideo2(idvideocontainer, nextQuality,
											true, mp4_bis, ogg_bis, webm_bis,
											mp4, ogg, webm);

								});

			}
		}

		_V_(idvideo).ready(ready);

	}