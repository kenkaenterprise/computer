/*
 * Copyright (c) 2020 Frenify
 * Author: Frenify
 * This file is made for CURRENT THEME
*/


/*

	@Author: Frenify
	@URL: http://themeforest.net/user/frenify


	This file contains the jquery functions for the actual theme, this
	is the file you need to edit to change the structure of the
	theme.

	This files contents are outlined below.

*/




(function ($){

	"use strict";
	
    var ArtemizInit 		= {
		
		myLocation: '^http://artemiz.frenify.com/1/',
		
		
		pageNumber: 1,
		
        init: function () {
			
			
			this.middleLogoFixer();
			this.searchboxOpener();
			this.hamburgerOpener__Mobile();
			this.submenu__Mobile();
			this.like();
			this.openShare();
			// global functions
			this.imgToSVG();
			this.isotopeMasonry();
			this.dataFnBgImg();
			
			
			// работа с виджетами
			this.estimateWidgetHeight();
			
			this.runPlayer();
			this.newPlayer();
			this.toTopJumper();
			this.fixedTotopScroll();
			
			this.interactivePodcast();
			this.getDuration();
        },
		
		interactivePodcast: function(){
			var time				= null;
			$('.artemiz_fn_podcast__list.fn_interactive .item').on('mouseenter',function(){
				var element 		= $(this);
				var parent			= element.closest('li');
				var index			= parent.index();
				clearTimeout(time);
				element.closest('.artemiz_fn_podcast__list').find('.overlay').removeClass('hovered');
				element.closest('.artemiz_fn_podcast__list').find('.overlay').eq(index).addClass('hovered');
			}).on('mouseleave',function(){
				time = setTimeout(function(){
					var item		= $('.artemiz_fn_podcast__list.fn_interactive ul > .active');
					var parent		= item.closest('li');
					var index		= parent.index();
					item.closest('.artemiz_fn_podcast__list').find('.overlay').removeClass('hovered');
					item.closest('.artemiz_fn_podcast__list').find('.overlay').eq(index).addClass('hovered');
				},500);
			});
		},
		
		
		getDuration: function(){
			$('.artemiz_fn_podcast__list .artemiz_fn_audio_button').each(function(){
				var element 		= $(this);
				var audio 			= document.createElement('audio');
				var item			= element.closest('.item');
				var duration_DOM	= item.find('.podcast__duration');
				var min				= duration_DOM.attr('data-min');
				audio.src 			= element.attr('data-mp3');
				// Once the metadata has been loaded, display the duration in the console
				audio.addEventListener('loadedmetadata', function(){
					var duration 	= parseInt(audio.duration);
					var minutes 	= Math.floor(duration / 60);
					var seconds 	= duration - minutes * 60;
					minutes = minutes < 10 ? '0' + minutes : minutes;
					seconds = seconds < 10 ? '0' + seconds : seconds;
					duration_DOM.html(minutes + ':' + seconds + ' ' + min);
				},false);
			});
		},
		
		fixedTotopScroll: function(){
			var totop			= $('a.artemiz_fn_totop');
			var height 			= parseInt(totop.find('input').val());
			if(totop.length){
				if($(window).scrollTop() > height){
					totop.addClass('scrolled');
				}else{
					totop.removeClass('scrolled');
				}
			}
		},
		
		toTopJumper: function(){
			var totop		= $('a.artemiz_fn_totop');
			if(totop.length){
				totop.on('click', function(e) {
					e.preventDefault();		
					$("html, body").animate(
						{ scrollTop: 0 }, 'slow');
					return false;
				});
			}
		},
		
		
		runPlayer: function(){
			var parent		= $('.artemiz_fn_main_audio');
			var audioVideo 	= parent.find('audio,video');
			audioVideo.each(function(){
				var element = $(this);
				element.mediaelementplayer({
					// Do not forget to put a final slash (/)
					pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
					// this will allow the CDN to use Flash without restrictions
					// (by default, this is set as `sameDomain`)
					shimScriptAccess: 'always',
					success: function(mediaElement, domObject) {
						mediaElement.addEventListener('play', function() {
							parent.removeClass('fn_pause').addClass('fn_play');
						}, false);
						mediaElement.addEventListener('pause', function() {
							parent.removeClass('fn_play').addClass('fn_pause');
						}, false);
					},
				});
			});
		},
		
		newPlayer: function(){
			var parent		= $('.artemiz_fn_main_audio');
			var closer 	  	= parent.find('.fn_closer');
			var audioVideo 	= parent.find('audio,video');
			var icon 		= parent.find('.podcast_icon');
			var audios		= $('.artemiz_fn_audio_button');
			var playButton	= $('.artemiz_fn_audio_button a');
			var self		= this;
			audioVideo.each(function(){
				var element = $(this);
				element.mediaelementplayer({
					// Do not forget to put a final slash (/)
					pluginPath: 'https://cdnjs.com/libraries/mediaelement/',
					// this will allow the CDN to use Flash without restrictions
					// (by default, this is set as `sameDomain`)
					shimScriptAccess: 'always',
					success: function(mediaElement, domObject) {
						mediaElement.addEventListener('pause', function() {
							parent.removeClass('fn_play').addClass('fn_pause');
						}, false);
						mediaElement.addEventListener('play', function() {
							parent.removeClass('fn_pause').addClass('fn_play');
						}, false);
					},
					
				});
			});
			closer.off().on('click', function(){
				if(parent.hasClass('closed')){
					parent.removeClass('closed');
					closer.find('span').html(closer.attr('data-close-text'));
				}else{
					parent.addClass('closed');
					closer.find('span').html(closer.attr('data-open-text'));
				}
			});
			icon.off().on('click', function(){
				if(parent.find('audio,video').length){
					if(parent.hasClass('fn_pause')){
						parent.removeClass('fn_pause').addClass('fn_play').find('audio,video')[0].play();
					}else{
						parent.removeClass('fn_play').addClass('fn_pause').find('audio,video')[0].pause();
					}
				}
			});
			playButton.off().on('click',function(){
				var button		= $(this);
				var wrapper		= button.parent();
				var elLi		= button.closest('li');
				var allLi		= elLi.siblings('li');
				if(!wrapper.hasClass('active')){
					audios.removeClass('active fn_play fn_pause');
					wrapper.addClass('active');
					allLi.removeClass('active');
					elLi.addClass('active');
				}
				if(wrapper.hasClass('fn_pause')){
					wrapper.removeClass('fn_pause').addClass('fn_play');
					parent.find('audio,video')[0].play();
				}else if(wrapper.hasClass('fn_play')){
					wrapper.removeClass('fn_play').addClass('fn_pause');
					parent.find('audio,video')[0].pause();
				}else{
					wrapper.addClass('fn_play');
					var src			= wrapper.attr('data-mp3');
					var audio	 	= '<audio controls><source src="'+src+'" type="audio/mpeg"></audio>';
					$('.artemiz_fn_main_audio .audio_player').html(audio);
					self.runPlayer();
					setTimeout(function(){
						parent.find('audio,video')[0].play();
						parent.removeClass('fn_pause').addClass('fn_play');
						parent.removeClass('closed');
						closer.find('span').html(closer.attr('data-close-text'));
					},50);
				}
				
				return false;
			});
		},
		
		
		middleLogoFixer: function(){
			// middle logo for one line navigation
			var middleLogo1		= $('.artemiz_fn_one_line[data-middle-logo="1"]');
			var hiddenLogo1		= $('.artemiz_fn_one_line .fn_logo');
			if(middleLogo1.length && hiddenLogo1.length){
				var length1		= middleLogo1.find('ul.nav__hor > li').length;
				hiddenLogo1		= hiddenLogo1.html();
				middleLogo1.find('.fn_logo').parent().remove();
				middleLogo1.find('ul.nav__hor > li:nth-child('+parseInt(length1/2)+')').after('<li class="middle_logo"><div class="fn_logo">'+hiddenLogo1+'</div></li>');
			}
		},
		
		searchboxOpener: function(){
			var searchbox 	= $('.artemiz_fn_searchpopup');
			var opener 		= $('.tt_item_search a');
			if(opener.length){
				opener.on('click',function(){
					if($('body').hasClass('open_search_popup')){
						searchbox.removeClass('focused');
						$('body').removeClass('open_search_popup');
					}else{

						$('body').addClass('open_search_popup');
						setTimeout(function(){
							$('.artemiz_fn_searchpopup input[type=text]').focus();
							$('.artemiz_fn_searchpopup input[type=text]').trigger('click');
						},500);
					}
					return false;
				});
			}
			if(searchbox.length){
				var closer  	= searchbox.find('.search_closer');
				var inputText  	= searchbox.find('input[type=text]');
				var inputSubmit	= searchbox.find('input[type=submit]');
				searchbox.find('.search_inner').on('click',function(){
					searchbox.removeClass('focused');
				});
				inputText.on('click',function(event){
					searchbox.addClass('focused');
					event.stopPropagation();
				});
				inputSubmit.on('click',function(event){
					event.stopPropagation();
				});
				closer.on('click',function(event){
					event.stopPropagation();
					searchbox.removeClass('focused');
					$('body').removeClass('open_search_popup');
					closer.addClass('closed');
					setTimeout(function(){
						closer.removeClass('closed');
					},500);
				});
			}	
		},
		
		openShare: function(){
			var allSharebox = $('.artemiz_fn_sharebox');
			var btn 		= $('.artemiz_fn_sharebox .hover_wrapper');
			btn.off().on('click',function(e){
				var element = $(this),
					parent	= element.closest('.artemiz_fn_sharebox');
				e.stopPropagation();
				allSharebox.removeClass('opened');
				parent.addClass('opened');
				parent.find('a').each(function(){
					var eachA 	= $(this),
						href 	= eachA.attr('data-href');
					eachA.attr('href',href);
				});
			});
			allSharebox.on('click',function(e){
				e.stopPropagation();
			});
			$(window).on('click',function(){
				allSharebox.removeClass('opened');
				allSharebox.find('a').each(function(){
					$(this).removeAttr('href');
				});
			});
		},
		
		submenu__Mobile: function(){
			var nav 						= $('ul.vert_menu_list, .widget_nav_menu ul.menu');
			var mobileAutoCollapse			= $('.artemiz-fn-wrapper').data('mobile-autocollapse');
			nav.each(function(){
				$(this).find('a').on('click', function(e){
					var element 			= $(this);
					var parentItem			= element.parent('li');
					var parentItems			= element.parents('li');
					var parentUls			= parentItem.parents('ul.sub-menu');
					var subMenu				= element.next();
					var allSubMenusParents 	= nav.find('li');

					allSubMenusParents.removeClass('opened');

					if(subMenu.length){
						e.preventDefault();

						if(!(subMenu.parent('li').hasClass('active'))){
							if(!(parentItems.hasClass('opened'))){parentItems.addClass('opened');}

							allSubMenusParents.each(function(){
								var el = $(this);
								if(!el.hasClass('opened')){el.find('ul.sub-menu').slideUp();}
							});

							allSubMenusParents.removeClass('active');
							parentUls.parent('li').addClass('active');
							subMenu.parent('li').addClass('active');
							subMenu.slideDown();


						}else{
							subMenu.parent('li').removeClass('active');
							subMenu.slideUp();
						}
						return false;
					}
					if(mobileAutoCollapse === 'enable'){
						if(nav.parent().parent().hasClass('opened')){
							nav.parent().parent().removeClass('opened').slideUp();
							$('.artemiz_fn_mobilemenu_wrap .hamburger').removeClass('is-active');
						}
					}
				});
			});
		},
		
		hamburgerOpener__Mobile: function(){
			var hamburger		= $('.artemiz_fn_mobilemenu_wrap .hamburger');
			hamburger.on('click',function(){
				var element 	= $(this);
				var menupart	= $('.artemiz_fn_mobilemenu_wrap .mobilemenu');
				if(element.hasClass('is-active')){
					element.removeClass('is-active');
					menupart.removeClass('opened');
					menupart.slideUp(500);
				}else{
					element.addClass('is-active');
					menupart.addClass('opened');
					menupart.slideDown(500);
				}return false;
			});
		},
		
		like: function(){
			var svg;
			var self	= this;
			if($('.artemiz-fn-wrapper').length){
				svg = $('.artemiz-fn-wrapper').data('like-url');
			}
			var ajaxRunningForLike = false;
			$('.artemiz_fn_like').off().on('click', function(e) {
				e.preventDefault();

				var likeLink 		= $(this),
					ID 				= $(this).attr('id'),
					likeAction,addAction;

				if(ajaxRunningForLike === true) {return false;}
				
				if(likeLink.hasClass('liked')){
					likeAction 		= 'liked';
					addAction		= 'not-rated';
				}else{
					likeAction 		= 'not-rated';
					addAction		= 'liked';
				}
				ajaxRunningForLike 	= true;
				
				var requestData 	= {
					action: 'artemiz_fn_like', 
					ID: ID,
					likeAction: likeAction
				};
				
				$.ajax({
					type: 'POST',
					url: fn_ajax_object.fn_ajax_url,
					cache: false,
					data: requestData,
					success: function(data) {
						var fnQueriedObj 	= $.parseJSON(data); //get the data object
						likeLink.removeClass('animate ' + likeAction).addClass(addAction);
						likeLink.find('.artemiz_w_fn_svg').remove();
						likeLink.find('.artemiz_fn_like_count').before('<img src="'+fnQueriedObj.svg+'" class="artemiz_w_fn_svg" alt="" />');
						self.imgToSVG();
						likeLink.find('.artemiz_fn_like_count span').html(fnQueriedObj.count);
						likeLink.attr('title',fnQueriedObj.title);
						likeLink.addClass('animate');
						ajaxRunningForLike = false;
					},
					error: function(MLHttpRequest, textStatus, errorThrown) {
						console.log(MLHttpRequest);
						console.log(textStatus);
						console.log(errorThrown);
					}
				});	

				return false;
			});
		},
		
		
		imgToSVG: function(){
			$('img.artemiz_fn_svg,img.artemiz_w_fn_svg').each(function(){
				var img 		= $(this);
				var imgClass	= img.attr('class');
				var imgURL		= img.attr('src');

				$.get(imgURL, function(data) {
					var svg 	= $(data).find('svg');
					if(typeof imgClass !== 'undefined') {
						svg 	= svg.attr('class', imgClass+' replaced-svg');
					}
					img.replaceWith(svg);

				}, 'xml');

			});	
		},
		
		
		dataFnBgImg: function(){
			var bgImage 	= $('*[data-fn-bg-img]');
			bgImage.each(function(){
				var element = $(this);
				var attrBg	= element.attr('data-fn-bg-img');
				var bgImg	= element.data('fn-bg-img');
				if(typeof(attrBg) !== 'undefined'){
					element.css({backgroundImage:'url('+bgImg+')'});
				}
			});
		},
		
		isotopeMasonry: function(){
			var masonry = $('.artemiz_fn_masonry');
			if($().isotope){
				masonry.each(function(){
					$(this).isotope({
						itemSelector: '.artemiz_fn_masonry_in',
						masonry: {
							columnWidth: '.grid-sizer'
						}
					});
				});
			}
			var masonry2 = $('.fn_masonry');
			if($().isotope){
				masonry2.each(function(){
					$(this).isotope({
						itemSelector: '.fn_masonry_in',
					});
				});
			}
		},
		
		estimateWidgetHeight: function(){
			var est 	= $('.artemiz_fn_widget_estimate');
			est.each(function(){
				var el 	= $(this);
				var h1 	= el.find('.helper1');
				var h2 	= el.find('.helper2');
				var h3 	= el.find('.helper3');
				var h4 	= el.find('.helper4');
				var h5 	= el.find('.helper5');
				var h6 	= el.find('.helper6');
				var eW 	= el.outerWidth();
				var w1 	= Math.floor((eW * 80) / 300);
				var w2 	= eW-w1;
				var e1 	= Math.floor((w1 * 55) / 80);
				h1.css({borderLeftWidth:	w1+'px', borderTopWidth: e1+'px'});
				h2.css({borderRightWidth:	w2+'px', borderTopWidth: e1+'px'});
				h3.css({borderLeftWidth:	w1+'px', borderTopWidth: w1+'px'});
				h4.css({borderRightWidth:	w2+'px', borderTopWidth: w1+'px'});
				h5.css({borderLeftWidth:	w1+'px', borderTopWidth: w1+'px'});
				h6.css({borderRightWidth:	w2+'px', borderTopWidth: w1+'px'});
			});
		},
    };
	
	
	
	// ready functions
	$(document).ready(function(){
		ArtemizInit.init();
	});
	
	// resize functions
	$(window).on('resize',function(e){
		e.preventDefault();
		ArtemizInit.estimateWidgetHeight();
	});
	
	// scroll functions
	$(window).on('scroll', function(e) {
		e.preventDefault();
		ArtemizInit.fixedTotopScroll();
    });
	
	// load functions
	$(window).on('load', function(e) {
		e.preventDefault();
		ArtemizInit.isotopeMasonry();
		setTimeout(function(){
			ArtemizInit.isotopeMasonry();
		},100);
	});
	
})(jQuery);