<?php

/**
 * DEBUG mode
 */
	// SINGLE setup
	define('THEME_DEBUG', false);

	// DEV/PROD setup
	// if (defined('WP_DEBUG') && true === WP_DEBUG) {
	// 	define('THEME_DEBUG', true);
	// } else {
	// 	define('THEME_DEBUG', false);
	// }


/*
 * Theme Support
 */
function theme_setup() {
	if (!isset($content_width)) $content_width = 1900;

	add_theme_support('automatic-feed-links'); // Enables post and comment RSS feed links to head
	add_theme_support('menus');  // Menu Support
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) ); 

	// Add Thumbnail Theme Support
	$post_types = array('post'); // which post types to add thmbnail support
	add_theme_support('post-thumbnails', $post_types);

	// Setup image sizing
	add_image_size('large', 1300, '', true); // Large Thumbnail
	add_image_size('medium', 500, '', true); // Medium Thumbnail
	add_image_size('xlarge', 1460, '', true); // Extra Large Thumbnail
	add_image_size('xwide', 1920, '', true); // Extra Wide Thumbnail

	// theme specific
	add_image_size('aspot', '1600', '450', true); // Heading
}
add_action( 'after_setup_theme', 'theme_setup' );

/*
 * Enqueue Scripts
 */

	// Load Custom Theme Scripts using Enqueue
	function theme_scripts() {
		if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

			if (THEME_DEBUG) {
				// jQuery
				wp_deregister_script('jquery'); // Deregister WordPress jQuery
				wp_register_script('jquery', get_template_directory_uri() . '/assets/js/vendor/jquery.min.js', array(), '3.3.1');
				wp_enqueue_script('jquery'); // Enqueue it!

				// Foundation
				wp_register_script('foundation', get_template_directory_uri() . '/assets/js/vendor/foundation/foundation.min.js', array('jquery'), '6.4.3');
				wp_enqueue_script('foundation'); // Enqueue it!

				/**
				 * Additional Vendor Scripts
				 */
				wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-custom.js', array('jquery'));
				wp_enqueue_script('modernizr');

				wp_register_script('_imagesloaded', get_template_directory_uri() . '/assets/js/vendor/imagesloaded.pkgd.min.js', array('jquery'));
				wp_enqueue_script('_imagesloaded');

				wp_register_script('barba', get_template_directory_uri() . '/assets/js/vendor/barba.min.js', array('jquery'));
				wp_enqueue_script('barba');

				wp_register_script('SmoothScroll', get_template_directory_uri() . '/assets/js/vendor/SmoothScroll.js', array('jquery'));
				wp_enqueue_script('SmoothScroll');

				wp_register_script('blazy', get_template_directory_uri() . '/assets/js/vendor/blazy.min.js', array('jquery'));
				wp_enqueue_script('blazy');

				wp_register_script('wow', get_template_directory_uri() . '/assets/js/vendor/wow.min.js', array('jquery'));
				wp_enqueue_script('wow');

				wp_register_script('slick', get_template_directory_uri() . '/assets/js/vendor/slick/slick.js', array('jquery'));
				wp_enqueue_script('slick');	 

				wp_register_script('select2', get_template_directory_uri() . '/assets/js/vendor/select2.js', array('jquery'));
            	wp_enqueue_script('select2');

				wp_register_script('takeover', get_template_directory_uri() . '/assets/js/vendor/takeover.js', array('jquery'));
				wp_enqueue_script('takeover');

				// Greensock
				wp_register_script('greensock-tweenmax', get_template_directory_uri() . '/assets/js/vendor/greensock/TweenMax.js', array('jquery'), '1.0.0');
				wp_enqueue_script('greensock-tweenmax');
					// wp_register_script('greensock-cssrule', get_template_directory_uri() . '/assets/js/vendor/greensock/plugins/CSSRulePlugin.js', array('jquery'), '1.0.0');
					// wp_enqueue_script('greensock-cssrule');
				wp_register_script('greensock-timelinemax', get_template_directory_uri() . '/assets/js/vendor/greensock/TimelineMax.js', array('jquery'), '1.0.0');
				wp_enqueue_script('greensock-timelinemax');

				// Scroll Magic
				wp_register_script('scrollmagic', get_template_directory_uri() . '/assets/js/vendor/scrollmagic/ScrollMagic.js', array('jquery'), '1.0.0');
				wp_enqueue_script('scrollmagic');
					wp_register_script('scrollmagic-gsap', get_template_directory_uri() . '/assets/js/vendor/scrollmagic/plugins/animation.gsap.js', array('jquery'), '1.0.0');
					wp_enqueue_script('scrollmagic-gsap');
					wp_register_script('scrollmagic-debug', get_template_directory_uri() . '/assets/js/vendor/scrollmagic/plugins/debug.addIndicators.js', array('jquery'), '1.0.0');
					wp_enqueue_script('scrollmagic-debug');

				// ajax load more
				wp_enqueue_script('ajax-load-more');

				wp_register_script('masonry', get_template_directory_uri() . '/assets/js/vendor/masonry.pkgd.min.js', array('jquery'));
				wp_enqueue_script('masonry');


				// Custom scripts
				wp_register_script('app-init', get_template_directory_uri() . '/assets/js/app-init.js', array('jquery'));
				wp_enqueue_script('app-init');

				wp_register_script(
					'theme-app',
					get_template_directory_uri() . '/assets/js/app.js',
					array(
						'jquery',
						'foundation',
						'imagesloaded',
						'app-init'
						),
					'1.0.0');
				// Enqueue Scripts
				wp_enqueue_script('theme-app');
			
			// If production
			// minified versions are expected
			} else {
				// jQuery
				wp_deregister_script('jquery'); // Deregister WordPress jQuery
				wp_register_script('jquery', get_template_directory_uri() . '/assets/js/vendor/jquery.min.js', array(), '2.1.4');
				wp_enqueue_script('jquery'); // Enqueue it!

				// App init
				wp_register_script('theme-app-init-min', get_template_directory_uri() . '/assets/js/app-init.min.js?'.filemtime(get_stylesheet_directory().'/assets/js/app-init.min.js'), array(), '1.0.0', true);
				wp_enqueue_script('theme-app-init-min');

				// App
				wp_register_script('theme-app-min', get_template_directory_uri() . '/assets/js/app.min.js?'.filemtime(get_stylesheet_directory().'/assets/js/app.min.js'), array(), '1.0.0', true);
				wp_enqueue_script('theme-app-min');

				// ajax load more
				wp_enqueue_script('ajax-load-more');
			}

		}
	}
	add_action('wp_enqueue_scripts', 'theme_scripts', 0); // Add Custom Scripts

	// Loading Conditional Scripts
	/*function theme_conditional_scripts() {
		if (is_single()) {
			if (THEME_DEBUG) {
				wp_register_script('scriptname', get_template_directory_uri() . '/assets/js/scriptname.js', array('theme-app-init'), '1.0.0', true);
				wp_enqueue_script('scriptname');
			} else {
				wp_register_script('scriptname-min', get_template_directory_uri() . '/assets/js/scriptname.min.js', array('theme-app-init-min'), '1.0.0', true);
				wp_enqueue_script('scriptname-min');
			}
		}
	}*/
	// add_action('wp_enqueue_scripts', 'theme_conditional_scripts', 1); // Add Conditional Page Scripts

/*
 * Enqueue Styles
 */

	// Theme Stylesheets using Enqueue
	function theme_styles() {

		if (THEME_DEBUG) {
			// add fonts
			// separate file for performance
			wp_register_style('theme-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), '1.0');
			wp_enqueue_style('theme-fonts');

			// Sass Compiled CSS
			wp_register_style('theme-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0');
			wp_enqueue_style('theme-style');
		} else {
			// add fonts
			// separate file for performance
			wp_register_style('theme-fonts-min', get_template_directory_uri() . '/assets/css/fonts.min.css', array(), '1.0');
			wp_enqueue_style('theme-fonts-min');

			// Sass Compiled CSS
			wp_register_style('theme-style-min', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0');
			wp_enqueue_style('theme-style-min');
		}
	}
	add_action('wp_enqueue_scripts', 'theme_styles', 999); // Add Theme Stylesheet

/**
 * External Modules/Files
 */
	// Core
	// Should not need to be modified except with theme updates
	include_once(TEMPLATEPATH.'/inc/core/admin.php'); // wp-admin tweaks
	include_once(TEMPLATEPATH.'/inc/core/cleanup.php'); // wp cleanup
	include_once(TEMPLATEPATH.'/inc/core/extras.php'); // misc tweaks and helpers
	include_once(TEMPLATEPATH.'/inc/core/foundation.php'); // foundation tweaks
	include_once(TEMPLATEPATH.'/inc/core/resize.php'); // image sizing
	//include_once(TEMPLATEPATH.'/inc/core/wpcron.php'); // cron events
	//include_once(TEMPLATEPATH.'/inc/core/localstorage.php'); // local storage class, requires 

	// Edit away
	include_once(TEMPLATEPATH.'/inc/menus.php'); // theme menus
	include_once(TEMPLATEPATH.'/inc/styles.php'); // wp editor styles
	include_once(TEMPLATEPATH.'/inc/shortcodes.php'); // theme shortcodes
	include_once(TEMPLATEPATH.'/inc/widgets.php'); // theme widgets
	include_once(TEMPLATEPATH.'/inc/posts.php'); // post post_type tweaks
	include_once(TEMPLATEPATH.'/inc/pages.php'); // page post_type tweaks
	include_once(TEMPLATEPATH.'/inc/blog.php'); // customize excerpts, comments, archives, etc
	include_once(TEMPLATEPATH.'/inc/acf.php'); // acf options, etc
	include_once(TEMPLATEPATH.'/inc/gforms.php'); // gravity forms
	include_once(TEMPLATEPATH.'/inc/users.php'); // user related
	include_once(TEMPLATEPATH.'/inc/header.php'); // header related

	// Theme specific
	//include_once(TEMPLATEPATH.'/inc/filename.php');

	// Builder
	include_once(TEMPLATEPATH.'/builder/builder.php');


/**
 * Anything else move to another file!
 */




