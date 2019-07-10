//@prepros-prepend vendor/modernizr-custom.js
//@prepros-prepend vendor/jquery.min.js
//@prepros-prepend vendor/foundation/foundation.min.js
//@prepros-prepend vendor/imagesloaded.pkgd.min.js
//@prepros-prepend vendor/barba.min.js
//@prepros-prepend vendor/SmoothScroll.js
//@prepros-prepend vendor/blazy.min.js
//@prepros-prepend vendor/wow.min.js
//@*prepros-prepend vendor/slick/slick.js
//@*prepros-prepend vendor/select2.js
//@prepros-prepend vendor/takeover.js
//@prepros-prepend vendor/masonry.pkgd.min.js

// Greensock
// @prepros-prepend vendor/greensock/TweenMax.min.js
//@*prepros-prepend vendor/greensock/plugins/CSSRulePlugin.js
//@*prepros-prepend vendor/greensock/plugins/SplitText.js
//@*prepros-prepend vendor/greensock/plugins/MorphSVGPlugin.js
//@prepros-prepend vendor/greensock/TimelineMax.min.js

// ScrollMagic
// @prepros-prepend vendor/scrollmagic/ScrollMagic.min.js
// @prepros-prepend vendor/scrollmagic/plugins/animation.gsap.min.js

// DOM Ready
(function($) {
	'use strict';

	_dg.foundation = function(){

		// load foundation
		$(document).foundation();

	};

	// functions that are re-used elsewhere
	_dg.common = function(){

		$.fn.isScrolledIntoView = function () {
			var docViewTop = $(window).scrollTop();
			var docViewBottom = docViewTop + $(window).height();

			var elemTop = $(this).offset().top;
			var elemBottom = elemTop + $(this).height();

			return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
		};

		$.fn.serializeObject = function () {
			var o = {};
			var a = this.serializeArray();
			$.each(a, function () {
				if (o[this.name] !== undefined) {
					if (!o[this.name].push) {
						o[this.name] = [o[this.name]];
					}
					o[this.name].push(this.value || '');
				} else {
					o[this.name] = this.value || '';
				}
			});
			return o;
		};

		window.dg_smooth_scroll = function( $target, $top_section, speed, easing ) {
			var $window_width = $( window ).width();
			var $menu_offset, $scroll_position;

			if ( $( '.site-header' ).hasClass( 'fixed-nav' ) && $window_width > 980 ) {
				$menu_offset = $( '.site-header' ).outerHeight() - 1;
			} else {
				$menu_offset = 70;
			}

			if ( $ ('#wpadminbar').length && $window_width > 600 ) {
				$menu_offset += $( '#wpadminbar' ).outerHeight();
			}

			//fix sidenav scroll to top
			if ( $top_section ) {
				$scroll_position = 0;
			} else {
				$scroll_position = $target.offset().top - $menu_offset;
			}

			// set swing (animate's scrollTop default) as default value
			if( typeof easing === 'undefined' ){
				easing = 'swing';
			}

			$( 'html, body' ).animate( { scrollTop :  $scroll_position }, speed, easing );
		}	

	};

	// social sharing popup window
	_dg.social_popup = function(){

		/**
		* jQuery function to prevent default anchor event and take the href * and the title to make a share popup
		*
		* @param  {[object]} e           [Mouse event]
		* @param  {[integer]} intWidth   [Popup width defalut 500]
		* @param  {[integer]} intHeight  [Popup height defalut 400]
		* @param  {[boolean]} blnResize  [Is popup resizeabel default true]
		*/
		$.fn.socialPopup = function (e, intWidth, intHeight, blnResize) {

			// Prevent default anchor event
			e.preventDefault();

			// Set values for window
			intWidth = intWidth || '600';
			intHeight = intHeight || '500';
			var strResize = (blnResize ? 'yes' : 'no');

			// Set title and open popup with focus on it
			var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
			strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
			objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
		}

		$(document).on("click", '.sharing a.social', function(e) {
			$(this).socialPopup(e);
		});	

	};

	// navigational takeover
	// https://github.com/DurkanGroup/takeover
	_dg.takeover = function(){

		// init takeover
		$(document).takeover();

	};

	// adds class when user has scrolled down
	_dg.has_scrolled = function(){

		// Fixed nav trigger
		$(window).on("load scroll resize",function(e){
			var header_height = 85;
			var delay_height = 0;

			if ($(this).scrollTop() > (header_height + delay_height)) {
				$('body').addClass('has-scrolled');
			} else {
				$('body').removeClass('has-scrolled');
			}

		});

	};

	// adds smooth scroll for anchor links
	_dg.anchor_scroll = function(){

		// anchor smooth scroll
		$(document).on('click', 'a[href*="#"]:not([href="#"]):not(.noscroll)', function() {
			if ( location.pathname.replace( /^\//,'' ) == this.pathname.replace( /^\//,'' ) && location.hostname == this.hostname ) {
				var target = $( this.hash );
				target = target.length ? target : $( '[name=' + this.hash.slice(1) +']' );
				if ( target.length ) {

					dg_smooth_scroll( target, false, 800 );

					return false;
				}
			}
		});

		// scroll to hash on page load
		if (window.location.hash) {
			setTimeout(function() { dg_smooth_scroll( $(window.location.hash), false, 400 ); }, 400);
		}

	};

	// alternative to foundations equalize
	_dg.equal = function(){

		// similar to foundations equalizer
		function equal(){
			$("[data-equal]").each(function(){
				var parent = $(this);
				var type = parent.attr('data-equal');
				var array = type.split(",");

				$.each(array,function(i,e){
					var H = 0;
					parent.find( "[data-equal-watch="+e+"]" ).each(function(){
						var h = $(this).outerHeight();
						if( h > H ){ H = h; }
					});

					parent.find( "[data-equal-watch="+e+"]" ).each(function(){
						var h = $(this).outerHeight();
						if( h < H ){ $(this).height(H); }
					});
				});
			});
		}

		$(window).on('resize load takeover nav-takeover', function(event) {
			$('.canvas-wrapper').imagesLoaded( function() {
				equal();
			});
		});

	};

	// Replacement for select fields
	// https://select2.github.io/
	_dg.select2 = function() {

		$('select').select2();

	};

	// image lazy load
	// http://dinbror.dk/blazy/
	_dg.blazy = function(){

		// load blazy
		var bLazy = new Blazy({
			loadInvisible:true,
			breakpoints: [{
					width: 640, // max-width
					src: 'data-src-small'
				},
				{
					width: 1024, // max-width
					src: 'data-src-medium'
				}]
			});

		// revalidate blazy on some events
		$(document).on('reveal-loaded blazy-revalidate', function(event) {
			bLazy.revalidate();
		});

	};
	

	// WOW animations
	// http://mynameismatthieu.com/WOW/
	_dg.wow = function(){

		// load wow
		new WOW().init();

	};

	// GSAP animations
	_dg.gsap = function(){
		// setup global controller
		// gets destroyed on barba page change
		if (controller) {
			controller = controller.destroy(true);
		}
		controller = new ScrollMagic.Controller();

		// animations for all
		_dg.gsap_sg_all();

		// load different stacks on mobile vs desktop
		var window_width = $( window ).width();
		if (!Modernizr.touch && window_width > 800) {
			_dg.gsap_sg_full();
		} else {
			_dg.gsap_sg_lite();
		}

	}

	_dg.gsap_sg_all = function(){

		/**
		 * Put stuff in here for now
		 */
		// move bcg container when intro gets out of the the view
		var bannnerFX = new TimelineMax();
		 
		bannnerFX
		    .to($('.banner'), 1.4, {y: '20%', ease:Power1.easeOut}, '-=0.2')
		 
		var introScene = new ScrollMagic.Scene({
		    triggerElement: '.banner',
		    triggerHook: 0,
		    duration: "100%"
		})
		.setTween(bannnerFX)
		.addTo(controller);
		
		
		
		if($("body").is(".home, .page-template-template-models, .page-template-template-single-model, .page-template-template-about")) {
			var modelFX = new TimelineMax();
			
			modelFX
			    .to($('.model-cube-img-wrap'), 1.4, {y: '20%', ease:Power1.easeOut}, '-=0.2')
			 
			var introScene = new ScrollMagic.Scene({
			    triggerElement: '.model-cube-img-wrap',
			    triggerHook: 0,
			    duration: "100%"
			})
			.setTween(modelFX)
			.addTo(controller);
			
			var modelFX2 = new TimelineMax();

			modelFX2
			    .to($('.hp-model-cube-img-wrap'), 1.4, {y: '20%', ease:Power1.easeOut}, '-=0.2')
			 
			var introScene = new ScrollMagic.Scene({
			    triggerElement: '.hp-model-cube-img-wrap',
			    triggerHook: 0,
			    duration: "100%"
			})
			.setTween(modelFX2)
			.addTo(controller);			
			
			
			
		}
	}
	

	_dg.gsap_sg_lite = function(){

		
	}

	_dg.gsap_sg_full = function(){
			

		/* Hover - bounce icon left */
			$(document).on('mouseenter', '.bounce-left', function(event) {
				var duration = 1;
				TweenMax.to($(this).find('i'), duration / 4, {x:15, ease:Power2.easeOut});
				TweenMax.to($(this).find('i'), duration / 2, {x:0, ease:Bounce.easeOut, delay:duration / 4});
			});
		/* Hover - bounce icon right */
			$(document).on('mouseenter', '.bounce-right', function(event) {
				var duration = 1;
				TweenMax.to($(this).find('i'), duration / 4, {x:-15, ease:Power2.easeOut});
				TweenMax.to($(this).find('i'), duration / 2, {x:0, ease:Bounce.easeOut, delay:duration / 4});
			});
		/* Hover - bounce icon down */
			$(document).on('mouseenter', '.bounce-down', function(event) {
				var duration = 1;
				TweenMax.to($(this).find('i'), duration / 4, {y:-15, ease:Power2.easeOut});
				TweenMax.to($(this).find('i'), duration / 2, {y:0, ease:Bounce.easeOut, delay:duration / 4});
			});
		/* Hover - bounce icon up */
			$(document).on('mouseenter', '.bounce-up', function(event) {
				var duration = 1;
				TweenMax.to($(this).find('i'), duration / 4, {y:15, ease:Power2.easeOut});
				TweenMax.to($(this).find('i'), duration / 2, {y:0, ease:Bounce.easeOut, delay:duration / 4});
			});

	};

	_dg.slick = function() {
		$('[data-slick]').slick({
			lazyLoad: 'progressive',
			fade: true,
			speed: 400,
			cssEase: 'linear',
			responsive: [
				{
					breakpoint: 768,
					settings: {
						// arrows: false,
						fade: false,
						speed: 300,
					}
				}
			]
		});
	};

	_dg.wppopupmaker = function() {
		if (typeof popmake !== 'undefined') {
			$('.popmake').popmake(); // re init
		}
	};

	_dg.gforms = function() {
		// prevent Gravity Forms form being submitted twice++
		var gformSubmitted = false; 
		$(".gform_wrapper form").submit(function(event) {
		    if (gformSubmitted) {
		        event.preventDefault();
		    } else {
		        gformSubmitted = true;
		        $("input[type='submit']", this).val("Sending...");
		    }
		});

		// reinit any Gravity Forms recaptcha on barbajs page load
		$('.ginput_recaptcha').each(function(index, el) {
			if ($(this).is(':empty') && typeof grecaptcha !== 'undefined') {
				grecaptcha.render(this, {
		            'sitekey' : $(this).data('sitekey')
		        });
		    }
		});
	};

	_dg.ajaxloadmore = function() {

		// Ajax Lod More Plugin filtering		
		var alm_is_animating; // we need to make sure call are not interrupted by animations

		/*
		* almFilterComplete()
		* Callback function sent from core Ajax Load More
		*/
		$.fn.almFilterComplete = function(){      
			alm_is_animating = false; // clear animating flag
			$(document).trigger('blazy-revalidate');
		};

		// filter alm for post term
		function alm_filter_term(term_slug, term_taxonomy) {

			if (alm_is_animating) {
				return false; // Exit if filtering is still active 
			}

			alm_is_animating = true;

			var obj= {}, 
			count = 0;

			obj['taxonomy'] = term_taxonomy;
			obj['taxonomy-terms'] = term_slug;
			obj['taxonomy-operator'] = 'IN';
			obj['posts_per_page'] = '999';
			//obj['orderby'] = 'title';
			//obj['order'] = 'ASC';

			var data = obj;      
			$.fn.almFilter('fade', '300', data); // Send data to Ajax Load More
		}

		$(document).on('alm-filter-term', function(event, term_slug, term_taxonomy) {
			alm_filter_term(term_slug, term_taxonomy);
		});

		// filter alm for post meta (ex ACF repeater)
		function alm_filter_post_meta(meta_value, meta_key) {

			if (alm_is_animating) {
				return false; // Exit if filtering is still active 
			}

			alm_is_animating = true;

			var obj= {}, 
			count = 0;

			obj['meta-key'] = meta_key;
			obj['meta-value'] = meta_value;
			obj['meta-compare'] = 'LIKE';
			obj['posts_per_page'] = '999';

			var data = obj;      
			$.fn.almFilter('fade', '300', data); // Send data to Ajax Load More
		}

		$(document).on('alm-filter-post-meta', function(event,meta_value, meta_key) {
			alm_filter_post_meta(meta_value, meta_key);
		});


		// Call those alm filter function in your specific section
		// See https://tidal.durkancloud.net/using-ajax-load-more-for-filtering-content/

	};

	// barba - ajax page transitions
	_dg.barba = function(){

		var $body = $('html, body');

		// progress animation
		var barba_progress = $('.barba-progress');
		var barba_progressing = new TimelineLite({paused: true});
			barba_progressing
				.set(barba_progress, {autoAlpha: 1, width: 0}, 0)
				.fromTo(barba_progress, 2, {width: 0, ease: Power1.easeOut}, {width: '100%', ease: Power1.easeOut}, 0)
				.to(barba_progress, 0.5, {autoAlpha: 0, ease: Power1.easeOut}, '-=0.25')
				;
			barba_progressing.eventCallback("onComplete", function(){
				barba_progressing.pause().time(0)
			});

		Barba.Pjax.start();  // init
		Barba.Prefetch.init(); // caching

		// ignore rules
		Barba.Pjax.originalPreventCheck = Barba.Pjax.preventCheck;
		Barba.Pjax.preventCheck = function(evt, element) {
			if (!Barba.Pjax.originalPreventCheck(evt, element)) {
				return false;
			}

			// ignore pdf links
			if (/.pdf/.test(element.href.toLowerCase())) {
				return false;
			}

			// additional (besides .no-barba) ignore links with these classes
			// ab-item is for wp admin toolbar links
			var ignoreClasses = ['ab-item', 'slick-arrow', 'toggle-takeover'];
			for (var i = 0; i < ignoreClasses.length; i++) {
				if (element.classList.contains(ignoreClasses[i])) {
					return false;
				}
			}

			return true;
		};

		Barba.Dispatcher.on('linkClicked', function(HTMLElement, MouseEvent) {

			// close any takeovers open
			$(document).trigger('close-takeover');

			// close any reveals
			if ($('.reveal-overlay .reveal').length > 0) {
				$('.reveal-overlay .reveal').foundation('close');
			}

			// add classes here for a css transition
			$('body').addClass('barba-transition');

			// transistion animation
			// ...

			// start progress animation when barba link is clicked
			if (Modernizr.touch || $(window).width() <= 1024) {
				barba_progressing.timeScale(1).play(0);
			}

			// kill all slick sliders
			$('.slick-slider').each(function(index, el) {
				$(this).slick('unslick');	
			});

		});

		Barba.Dispatcher.on('initStateChange', function() {

			// GTM state change
			if (typeof dataLayer !== 'undefined') {
				dataLayer.push({
					'event' : 'barbaStateChange',
					'pathname': location.pathname,
					'title' : document.title
				});
			}
			
		});

		Barba.Dispatcher.on('newPageReady', function(currentStatus, oldStatus, container, newPageRawHTML) {

			$body.animate({
				scrollTop: 0
			});

			// eval all script in container
			// used mostly for gravity forms
			var js = container.querySelectorAll('script:not([type="text/template"])');
			if (js != null) {
				js.forEach(function(jsItem) {
					eval(jsItem.innerHTML);
				});				
			}

			// remove all reveal containers from footer
			$('.reveal-overlay').remove();

		});

		Barba.Dispatcher.on('transitionCompleted', function(currentStatus, oldStatus) {

			// speed up progress animation when barba is loaded
			if (Modernizr.touch || $(window).width() <= 1024) {
				barba_progressing.timeScale(3);
			}

			// remove classes here for a css transition
			$('body').removeClass('barba-transition');

			// copy over body classes
			var classes = $('#body').data('classes');
			if (classes != undefined && classes.length > 5) {
				$('body').attr('class', classes);
			}

			// update adminbar edit link
			if ($('#wpadminbar').length > 0) {
				var edit = $('#wpadminbar #wp-admin-bar-edit');
				if ($('#body').data('edit-href').length > 0) {
					edit.show();
					edit.find('a').text($('#body').data('edit-label'));
					edit.find('a').attr('href', $('#body').data('edit-href'));
				} else {
					edit.hide();
				}
			}

			// re-assign current-menu-item
			var elements_outside_barbawrapper = $('.canvas-wrapper').children().not('#barba-wrapper');
			elements_outside_barbawrapper.find('a').each(function(index, el) {
				if (typeof $(this).attr('href') !== "undefined") {
					if ($(this).attr("href") == window.location.pathname || $(this).attr("href") == window.location) {
						if ($(this).parent('li')) {
							$(this).parent('li').addClass('current-menu-item');
						} else {
							$(this).addClass('current-menu-item');
						}
					} else {
						$(this).removeClass('current-menu-item');
						$(this).parent('li').removeClass('current-menu-item');
					}
				}
			});

			// load alm when not loaded from barba page transistion
			if ($(".ajax-load-more-wrap[data-alm-id='']").length) {
				$(".ajax-load-more-wrap[data-alm-id='']").ajaxloadmore();
			}

			// re-initialize functions after barba ajax page change
			$(function() {
				_dg.init(true);		
			});

		});

		// dg transition 
		// allows for whitelisting some pages from barba via inc/header.php dg_has_barba()
		var dgTransition = Barba.BaseTransition.extend({
			start: function() {
				this.newContainerLoading.then(this.finish.bind(this));
			},

			finish: function() {
				// check if page should not be loaded via pjax
				if ($(this.newContainer).is('#no-barba')) {
					Barba.Pjax.forceGoTo(Barba.Pjax.getCurrentUrl());
				} else {
					this.done();
				}
			}
		});

		Barba.Pjax.getTransition = function() {
			// use dgTransition
			return dgTransition;
		};

	};


	// prevent fouc
	_dg.nofouc = function(){

		// http://johnpolacek.com/2012/10/03/help-prevent-fouc/
		(function($) { $('.no-fouc').removeClass('no-fouc'); })( jQuery );

	};

	/**
	 * Theme JS
	 */

	_dg.masonry_grid = function(){

		/*
		Inspiration Grid
		 */
		
		// add grid-size for responsive masonry
		$('.alm-ajax').prepend('<div class="grid-sizer"></div>');

		// load/reload masonry when ALM loads stuff
		$.fn.almComplete = function(alm){

			if ($('.alm-ajax .grid-sizer').length == 0) {
				$('.alm-ajax').prepend('<div class="grid-sizer"></div>');
			}
			
			$('.alm-ajax').masonry({
				itemSelector: '.grid-item',
				columnWidth: '.grid-sizer',
				percentPosition: true
			});

			$('.alm-ajax').masonry('reloadItems');
			$('.alm-ajax').masonry('layout');

			$('.alm-ajax').foundation();

		};

		// ALM filtering		
		var alm_is_animating;

		/*
		* almFilterComplete()
		* Callback function sent from core Ajax Load More
		*
		*/
		$.fn.almFilterComplete = function(){      
			alm_is_animating = false; // clear animating flag
			$(document).trigger('blazy-revalidate');
		};

		// filter alm for post categories
		function alm_filter_post_category(term_slug, term_taxonomy) {

			if (alm_is_animating) {
				return false; // Exit if filtering is still active 
			}

			alm_is_animating = true;

			var obj= {}, 
			count = 0;

			obj['taxonomy'] = term_taxonomy;
			obj['taxonomy-terms'] = term_slug;
			obj['taxonomy-operator'] = 'IN';
			obj['posts_per_page'] = '999';
			//obj['orderby'] = 'title';
			//obj['order'] = 'ASC';

			var data = obj;      
			$.fn.almFilter('fade', '300', data); // Send data to Ajax Load More
		}

		$('.masonry-grid-filter').on('change', function(event) {
			var term_slug = $(this).val();
			alm_filter_post_category(term_slug, 'inspire_cats');
		});	

		// trigger reveal
		// $(document).on('click', '.masonry-grid .inspiration_image', function(event) {
		// 	$('#' + $(this).closest('.grid-item').data('reveal-id') ).foundation('open');
		// });

		
	};

	/*_dg.home = function(){

		if ($('body').hasClass('page-template-template-home')) {

			
		}

	};*/

	/**
	 * Woocommerce
	 */

	/*_dg.woocommerce = function(){

		

	};*/


	_dg.init = function(is_barba){
		is_barba = typeof is_barba !== 'undefined' ? is_barba : false;

		_dg.foundation();
		_dg.common();
		_dg.social_popup();
		_dg.takeover();
		_dg.has_scrolled();
		_dg.anchor_scroll();
		_dg.equal();
		//_dg.select2();
		_dg.blazy();
		_dg.gsap();
		_dg.wow();
		//_dg.slick();
		_dg.wppopupmaker();
		_dg.gforms();
		_dg.masonry_grid();
		//_dg.ajaxloadmore();
		//_dg.home();
		//_dg.woocommerce();

		// don't run on barba page load
		if (!is_barba) {
			//_dg.barba();
		}

		_dg.nofouc();
	};

	// initialize functions on load
	$(function() {
		_dg.init();		
	});
	
	
	/* Sticky Nav */
	function start_header_sticky_nav_scene() {
		var header_sticky_nav = $('header#sticky-masthead');
		header_sticky_nav.removeClass('pined');
		var header_sticky_nav_offset = $(window).height();
	
		var previousScroll = 0;
	
		$(window).on('scroll', function(e) {
			var currentScroll = $(this).scrollTop();
	
			// If the current scroll position is greater than 0 (the top) AND the current scroll position is less than the document height minus the window height (the bottom) run the navigation if/else statement.
			if (currentScroll > 0 && currentScroll < $(document).height() - $(window).height()){
				// If the current scroll is greater than the previous scroll (i.e we're scrolling down the page), hide the nav.
				if (currentScroll > previousScroll){
					$(window).trigger('hide-sticky-nav');
	
					// Else we are scrolling up (i.e the previous scroll is greater than the current scroll), so show the nav.
				} else {
	
					// calc offset
					if (currentScroll > header_sticky_nav_offset) {
						window.setTimeout(function() { $(window).trigger('show-sticky-nav') }, 300);
					} else {
						window.setTimeout(function() { $(window).trigger('hide-sticky-nav') }, 300);
					}
				}
	
				// Set the previous scroll value equal to the current scroll.
				previousScroll = currentScroll;
			}
		});
	
		$(window).on('show-sticky-nav', function(event) {
				$('header#sticky-masthead').addClass('pined');
				console.log("fired");
		});
		$(window).on('hide-sticky-nav', function(event) {
				$('header#sticky-masthead').removeClass('pined');
		});
	}
	start_header_sticky_nav_scene();

})( jQuery );

