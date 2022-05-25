
(function($, fnFrontend){
	"use strict";
	
	
	
	var FrenifyArtemiz = {
		
		isAdmin: false,
		adminBarH: 0,
		
		init: function() {
			
			if($('body').hasClass('admin-bar')){
				FrenifyArtemiz.isAdmin 	= true;
				FrenifyArtemiz.adminBarH 	= $('#wpadminbar').height();
			}

			var widgets = {
				'frel-posts-slider.default' : FrenifyArtemiz.postsSlider,
				'frel-gallery.default' : FrenifyArtemiz.allGalleryFunctions,
			};

			$.each( widgets, function( widget, callback ) {
				fnFrontend.hooks.addAction( 'frontend/element_ready/' + widget, callback );
			});
		},
		
		allGalleryFunctions: function(){
			FrenifyArtemiz.justifiedGallery();
			FrenifyArtemiz.galleryMasonry();
			FrenifyArtemiz.BgImg();
			FrenifyArtemiz.gallerySlider();
		},
		
		gallerySlider: function(){
			$('.fn_cs_gallery_slider .inner').each(function(){
				var element 	= $(this);
				var container 	= element.find('.swiper-container');
				var mySwiper 	= new Swiper (container, {
					loop: true,
					slidesPerView: 1,
					spaceBetween: 100,
					speed: 800,
//					loopAdditionalSlides: 50,
					autoplay: {
						delay: 8000,
					},
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
				  	},
					on: {
						init: function(){
							element.closest('.fn_cs_gallery_slider').addClass('ready');
						},
						autoplayStop: function(){
							mySwiper.autoplay.start();
						},
				  	},
					pagination: {
						el: '.fn_cs_swiper_progress',
						type: 'custom', // progressbar
						renderCustom: function (swiper,current,total) {
							
							// progress animation
							var scale,translateX;
							var progressDOM	= container.find('.fn_cs_swiper_progress');
							if(progressDOM.hasClass('fill')){
								translateX 	= '0px';
								scale		= parseInt((current/total)*100)/100;
							}else{
								scale 		= parseInt((1/total)*100)/100;
								translateX 	= (current-1) * parseInt((100/total)*100)/100 + 'px';
							}
							
							
							progressDOM.find('.all span').css({transform:'translate3d('+translateX+',0px,0px) scaleX('+scale+') scaleY(1)'});
							if(current<10){current = '0' + current;}
							if(total<10){total = '0' + total;}
							progressDOM.find('.current').html(current);
							progressDOM.find('.total').html(total);
						}
				  	}
			  	});
			});
			FrenifyArtemiz.BgImg();
		},
		
		galleryMasonry: function(){
			FrenifyArtemiz.lightGallery();
			FrenifyArtemiz.isotopeFunction();
		},
		
		justifiedGallery: function(){
			FrenifyArtemiz.lightGallery();
			var justified = $(".fn_cs_gallery_justified");
			justified.each(function(){
				var element 	= $(this);
				var height		= parseInt(element.attr('data-height'));
				var gutter		= parseInt(element.attr('data-gutter'));
				if(!height || height === 0){height = 400;}
				if(!gutter || gutter === 0){gutter = 10;}
				if($().justifiedGallery){
					element.justifiedGallery({
						rowHeight : height,
						lastRow : 'nojustify',
						margins : gutter,
						refreshTime: 500,
						refreshSensitivity: 0,
						maxRowHeight: null,
						border: 0,
						captions: false,
						randomize: false
					});
				}
			});
		},
		
		postsSlider: function(){
			FrenifyArtemiz.BgImg();
			$('.fn_cs_posts_slider').each(function(){
				var element 	= $(this);
				var container 	= element.find('.swiper-container');
				var mySwiper 	= new Swiper (container, {
					loop: true,
//					effect: 'fade',
					slidesPerView: 1,
					spaceBetween: 0,
					speed: 1600,
					loopAdditionalSlides: 20,
					hashNavigation: {
						watchState: true,
					},
					pagination: {
						el: '.fn_cs_swiper_number_progress',
						type: 'custom', // progressbar
						renderCustom: function (swiper,current,total) {
							var progressDOM	= container.find('.fn_cs_swiper_number_progress');
							progressDOM.find('.progress_wrap').removeClass('active');
							progressDOM.find('.progress_wrap').eq(current-1).addClass('active');
						}
					},
					autoplay: {
						delay: 7000,
						disableOnInteraction: false
					},
				});
			});
		},
		
		
		
		
		blogGroup: function(){
			FrenifyArtemiz.BgImg();
			FrenifyArtemiz.ImgToSVG();
			FrenifyArtemiz.isotopeFunction();
		},
		
		
		
		/* COMMMON FUNCTIONS */
		BgImg: function(){
			var div = $('*[data-fn-bg-img]');
			div.each(function(){
				var element = $(this);
				var attrBg	= element.attr('data-fn-bg-img');
				var dataBg	= element.data('fn-bg-img');
				if(typeof(attrBg) !== 'undefined'){
					element.css({backgroundImage:'url('+dataBg+')'});
				}
			});
		},
		
		ImgToSVG: function(){
			
			$('img.artemiz_fn_svg,img.artemiz_w_fn_svg').each(function(){
				var $img 		= $(this);
				var imgClass	= $img.attr('class');
				var imgURL		= $img.attr('src');

				$.get(imgURL, function(data) {
					var $svg = $(data).find('svg');
					if(typeof imgClass !== 'undefined') {
						$svg = $svg.attr('class', imgClass+' replaced-svg');
					}
					$img.replaceWith($svg);

				}, 'xml');

			});
		},
		
		jarallaxEffect: function(){
			$('.jarallax').each(function(){
				var element			= $(this);
				var	customSpeed		= element.data('speed');

				if(customSpeed !== "undefined" && customSpeed !== ""){
					customSpeed = customSpeed;
				}else{
					customSpeed 	= 0.5;
				}
				element.jarallax({
					speed: customSpeed,
					automaticResize: true
				});
			});
		},
		isotopeFunction: function(){
			var masonry = $('.fn_cs_masonry');
			if($().isotope){
				masonry.each(function(){
					$(this).isotope({
					  itemSelector: '.fn_cs_masonry_in',
					  masonry: {

					  }
					});
				});
			}
		},
		
		lightGallery: function(){
			if($().lightGallery){
				// FIRST WE SHOULD DESTROY LIGHTBOX FOR NEW SET OF IMAGES

				var gallery = $('.fn_cs_lightgallery');

				gallery.each(function(){
					var element = $(this);
					element.lightGallery(); // binding
					if(element.length){element.data('lightGallery').destroy(true); }// destroying
					$(this).lightGallery({
						selector: ".lightbox",
						thumbnail: 1,
						loadYoutubeThumbnail: !1,
						loadVimeoThumbnail: !1,
						showThumbByDefault: !1,
						mode: "lg-fade",
						download:!1,
						getCaptionFromTitleOrAlt:!1,
					});
				});
			}	
		},
	};
	
	$( window ).on( 'elementor/frontend/init', FrenifyArtemiz.init );
	
	
	$( window ).on('resize',function(){
		setTimeout(function(){
			FrenifyArtemiz.isotopeFunction();
		},700);
	});
	$( window ).on('load',function(){
		FrenifyArtemiz.isotopeFunction();
	});
	
})(jQuery, window.elementorFrontend);