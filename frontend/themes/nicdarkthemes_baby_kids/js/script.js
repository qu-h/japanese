jQuery(document).ready(function() {
				// CUSTOM AJAX CONTENT LOADING FUNCTION
				var ajaxRevslider = function(obj) {

					// obj.type : Post Type
					// obj.id : ID of Content to Load
					// obj.aspectratio : The Aspect Ratio of the Container /
					// Media
					// obj.selector : The Container Selector where the Content
					// of Ajax will be injected. It is done via the Essential
					// Grid on Return of Content

					var content = "";

					data = {};

					data.action = 'revslider_ajax_call_front';
					data.client_action = 'get_slider_html';
					data.token = '26592fa82d';
					data.type = obj.type;
					data.id = obj.id;
					data.aspectratio = obj.aspectratio;

					// SYNC AJAX REQUEST
					jQuery.ajax({
						type:"post",
						url:"http://www.nicdarkthemes.com/themes/baby-kids/wp/demo/wp-admin/admin-ajax.php",
						dataType: 'json',
						data:data,
						async:false,
						success: function(ret, textStatus, XMLHttpRequest) {
							if(ret.success == true)
								content = ret.data;
						},
						error: function(e) {
							console.log(e);
						}
					});

					 // FIRST RETURN THE CONTENT WHEN IT IS LOADED !!
					 return content;
				};

				// CUSTOM AJAX FUNCTION TO REMOVE THE SLIDER
				var ajaxRemoveRevslider = function(obj) {
					return jQuery(obj.selector+" .rev_slider").revkill();
				};

				// EXTEND THE AJAX CONTENT LOADING TYPES WITH TYPE AND FUNCTION
				var extendessential = setInterval(function() {
					if (jQuery.fn.tpessential != undefined) {
						clearInterval(extendessential);
						if(typeof(jQuery.fn.tpessential.defaults) !== 'undefined') {
							jQuery.fn.tpessential.defaults.ajaxTypes.push({type:"revslider",func:ajaxRevslider,killfunc:ajaxRemoveRevslider,openAnimationSpeed:0.3});
							// type: Name of the Post to load via Ajax into the
							// Essential Grid Ajax Container
							// func: the Function Name which is Called once the
							// Item with the Post Type has been clicked
							// killfunc: function to kill in case the Ajax
							// Window going to be removed (before Remove
							// function !
							// openAnimationSpeed: how quick the Ajax Content
							// window should be animated (default is 0.3)
						}
					}
				},30);
});

/*******************************************************************************
 * - PREPARE PLACEHOLDER FOR SLIDER -
 ******************************************************************************/

var setREVStartSize = function() {
	var tpopt = new Object();
	tpopt.startwidth = 1200;
	tpopt.startheight = 650;
	tpopt.container = jQuery('#rev_slider_3_1');
	tpopt.fullScreen = "off";
	tpopt.forceFullWidth = "on";

	tpopt.container.closest(".rev_slider_wrapper").css({
		height : tpopt.container.height()
	});
	tpopt.width = parseInt(tpopt.container.width(), 0);
	tpopt.height = parseInt(tpopt.container.height(), 0);
	tpopt.bw = tpopt.width / tpopt.startwidth;
	tpopt.bh = tpopt.height / tpopt.startheight;
	if (tpopt.bh > tpopt.bw)
		tpopt.bh = tpopt.bw;
	if (tpopt.bh < tpopt.bw)
		tpopt.bw = tpopt.bh;
	if (tpopt.bw < tpopt.bh)
		tpopt.bh = tpopt.bw;
	if (tpopt.bh > 1) {
		tpopt.bw = 1;
		tpopt.bh = 1
	}
	if (tpopt.bw > 1) {
		tpopt.bw = 1;
		tpopt.bh = 1
	}
	tpopt.height = Math.round(tpopt.startheight
			* (tpopt.width / tpopt.startwidth));
	if (tpopt.height > tpopt.startheight && tpopt.autoHeight != "on")
		tpopt.height = tpopt.startheight;
	if (tpopt.fullScreen == "on") {
		tpopt.height = tpopt.bw * tpopt.startheight;
		var cow = tpopt.container.parent().width();
		var coh = jQuery(window).height();
		if (tpopt.fullScreenOffsetContainer != undefined) {
			try {
				var offcontainers = tpopt.fullScreenOffsetContainer.split(",");
				jQuery.each(offcontainers, function(e, t) {
					coh = coh - jQuery(t).outerHeight(true);
					if (coh < tpopt.minFullScreenHeight)
						coh = tpopt.minFullScreenHeight
				})
			} catch (e) {
			}
		}
		tpopt.container.parent().height(coh);
		tpopt.container.height(coh);
		tpopt.container.closest(".rev_slider_wrapper").height(coh);
		tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(
				".tp-fullwidth-forcer").height(coh);
		tpopt.container.css({
			height : "100%"
		});
		tpopt.height = coh;
	} else {
		tpopt.container.height(tpopt.height);
		tpopt.container.closest(".rev_slider_wrapper").height(tpopt.height);
		tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(
				".tp-fullwidth-forcer").height(tpopt.height);
	}
};

/* CALL PLACEHOLDER */
setREVStartSize();

var tpj = jQuery;
tpj.noConflict();
var revapi3;

tpj(document).ready(function() {

	if (tpj('#rev_slider_3_1').revolution == undefined) {
		revslider_showDoubleJqueryError('#rev_slider_3_1');
	} else {
		revapi3 = tpj('#rev_slider_3_1').show().revolution({
			dottedOverlay : "none",
			delay : 2000,
			startwidth : 1200,
			startheight : 650,
			hideThumbs : 0,

			thumbWidth : 100,
			thumbHeight : 50,
			thumbAmount : 2,

			simplifyAll : "off",

			navigationType : "none",
			navigationArrows : "solo",
			navigationStyle : "preview2",

			touchenabled : "on",
			onHoverStop : "on",
			nextSlideOnWindowFocus : "off",

			swipe_threshold : 75,
			swipe_min_touches : 1,
			drag_block_vertical : false,

			keyboardNavigation : "off",

			navigationHAlign : "center",
			navigationVAlign : "bottom",
			navigationHOffset : 0,
			navigationVOffset : 20,

			soloArrowLeftHalign : "left",
			soloArrowLeftValign : "center",
			soloArrowLeftHOffset : 20,
			soloArrowLeftVOffset : 0,

			soloArrowRightHalign : "right",
			soloArrowRightValign : "center",
			soloArrowRightHOffset : 20,
			soloArrowRightVOffset : 0,

			shadow : 0,
			fullWidth : "on",
			fullScreen : "off",

			spinner : "spinner2",

			stopLoop : "on",
			stopAfterLoops : 0,
			stopAtSlide : 1,

			shuffle : "off",

			autoHeight : "off",
			forceFullWidth : "on",

			hideTimerBar : "on",
			hideThumbsOnMobile : "off",
			hideNavDelayOnMobile : 1500,
			hideBulletsOnMobile : "off",
			hideArrowsOnMobile : "off",
			hideThumbsUnderResolution : 0,

			hideSliderAtLimit : 0,
			hideCaptionAtLimit : 0,
			hideAllCaptionAtLilmit : 0,
			startWithSlide : 0
		});

	}


	/******************************************
	-	PREPARE PLACEHOLDER FOR SLIDER	-
******************************************/


var setREVStartSize = function() {
	var	tpopt = new Object();
		tpopt.startwidth = 1200;
		tpopt.startheight = 650;
		tpopt.container = jQuery('#rev_slider_6_1');
		tpopt.fullScreen = "off";
		tpopt.forceFullWidth="off";

	tpopt.container.closest(".rev_slider_wrapper").css({height:tpopt.container.height()});tpopt.width=parseInt(tpopt.container.width(),0);tpopt.height=parseInt(tpopt.container.height(),0);tpopt.bw=tpopt.width/tpopt.startwidth;tpopt.bh=tpopt.height/tpopt.startheight;if(tpopt.bh>tpopt.bw)tpopt.bh=tpopt.bw;if(tpopt.bh<tpopt.bw)tpopt.bw=tpopt.bh;if(tpopt.bw<tpopt.bh)tpopt.bh=tpopt.bw;if(tpopt.bh>1){tpopt.bw=1;tpopt.bh=1}if(tpopt.bw>1){tpopt.bw=1;tpopt.bh=1}tpopt.height=Math.round(tpopt.startheight*(tpopt.width/tpopt.startwidth));if(tpopt.height>tpopt.startheight&&tpopt.autoHeight!="on")tpopt.height=tpopt.startheight;if(tpopt.fullScreen=="on"){tpopt.height=tpopt.bw*tpopt.startheight;var cow=tpopt.container.parent().width();var coh=jQuery(window).height();if(tpopt.fullScreenOffsetContainer!=undefined){try{var offcontainers=tpopt.fullScreenOffsetContainer.split(",");jQuery.each(offcontainers,function(e,t){coh=coh-jQuery(t).outerHeight(true);if(coh<tpopt.minFullScreenHeight)coh=tpopt.minFullScreenHeight})}catch(e){}}tpopt.container.parent().height(coh);tpopt.container.height(coh);tpopt.container.closest(".rev_slider_wrapper").height(coh);tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(coh);tpopt.container.css({height:"100%"});tpopt.height=coh;}else{tpopt.container.height(tpopt.height);tpopt.container.closest(".rev_slider_wrapper").height(tpopt.height);tpopt.container.closest(".forcefullwidth_wrapper_tp_banner").find(".tp-fullwidth-forcer").height(tpopt.height);}
};



});

/* CALL PLACEHOLDER */
setREVStartSize();



tpj.noConflict();
var revapi6;

jQuery(document).ready(function() {

	if(tpj('#rev_slider_6_1').revolution == undefined){
		revslider_showDoubleJqueryError('#rev_slider_6_1');
	}else{
	   revapi6 = tpj('#rev_slider_6_1').show().revolution(
		{
								dottedOverlay:"none",
		delay:2000,
		startwidth:1200,
		startheight:650,
		hideThumbs:0,

		thumbWidth:100,
		thumbHeight:50,
		thumbAmount:2,


		simplifyAll:"off",

		navigationType:"none",
		navigationArrows:"solo",
		navigationStyle:"preview2",

		touchenabled:"on",
		onHoverStop:"on",
		nextSlideOnWindowFocus:"off",

		swipe_threshold: 75,
		swipe_min_touches: 1,
		drag_block_vertical: false,

								parallax:"mouse",
		parallaxBgFreeze:"on",
		parallaxLevels:[1,2,3,4,5,6,7,8,9,10],
								parallaxDisableOnMobile:"on",

									panZoomDisableOnMobile:"on",

		keyboardNavigation:"off",

		navigationHAlign:"center",
		navigationVAlign:"bottom",
		navigationHOffset:0,
		navigationVOffset:20,

		soloArrowLeftHalign:"left",
		soloArrowLeftValign:"center",
		soloArrowLeftHOffset:20,
		soloArrowLeftVOffset:0,

		soloArrowRightHalign:"right",
		soloArrowRightValign:"center",
		soloArrowRightHOffset:20,
		soloArrowRightVOffset:0,

		shadow:0,
		fullWidth:"on",
		fullScreen:"off",

								spinner:"off",

		stopLoop:"on",
		stopAfterLoops:0,
		stopAtSlide:1,

		shuffle:"off",

		autoHeight:"off",
		forceFullWidth:"off",


		hideTimerBar:"on",
		hideThumbsOnMobile:"on",
		hideBulletsOnMobile:"on",
		hideArrowsOnMobile:"on",
		hideThumbsUnderResolution:0,

								hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		startWithSlide:0					});



					}
});	/*ready*/

(function($) { "use strict"; $("#count-paral2").parallax("50%", 0.3); })(jQuery);
