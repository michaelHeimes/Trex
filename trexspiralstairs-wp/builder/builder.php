<?php

// hide admin bar on builder template
function trex_theme_hide_admin_bar($bool) {
	$uri = $_SERVER["REQUEST_URI"];

	if ( is_page_template( 'page-builder.php' ) || stripos($uri, '/builder/') !== false ) {
		return false;
	} else {
		return $bool;
	}
}
add_filter('show_admin_bar', 'trex_theme_hide_admin_bar');

function remove_dg_no_fouc() {
	$uri = $_SERVER["REQUEST_URI"];

	if ( is_page_template( 'page-builder.php' ) || stripos($uri, '/builder/') !== false ) {
		remove_action('wp_head', 'dg_no_fouc', 1);
	}
}
add_action('wp', 'remove_dg_no_fouc', 1);

// Loading Conditional Scripts
function builder_conditional_scripts() {
	$uri = $_SERVER["REQUEST_URI"];

	if ( is_page_template( 'page-builder.php' ) || stripos($uri, '/builder/') !== false  ) {
		if (THEME_DEBUG) {
			
			$handles = array('foundation', '_imagesloaded', 'barba', 'SmoothScroll', 'blazy', 'wow', 'slick', 'select2', 'takeover', 'greensock-tweenmax', 'greensock-timelinemax', 'scrollmagic', 'scrollmagic-debug', 'scrollmagic-gsap', 'ajax-load-more', 'masonry', 'app-init', 'theme-app');
			foreach ($handles as $handle) {
				wp_dequeue_script($handle);
			}

			// jQuery
			wp_deregister_script('jquery'); // Deregister WordPress jQuery
			wp_register_script('jquery', get_template_directory_uri() . '/builder/assets/js/jquery.min.js', array(), '2.1.4');
			wp_enqueue_script('jquery'); // Enqueue it!

		} else {

			$handles = array('theme-app-init-min', 'theme-app-min');
			foreach ($handles as $handle) {
				wp_dequeue_script($handle);
			}

			// jQuery
			wp_deregister_script('jquery'); // Deregister WordPress jQuery
			wp_register_script('jquery', get_template_directory_uri() . '/builder/assets/js/jquery.min.js', array(), '2.1.4');
			wp_enqueue_script('jquery'); // Enqueue it!
			
		}
	}
}
add_action('wp_enqueue_scripts', 'builder_conditional_scripts', 10); // Add Conditional Page Scripts

// Theme Stylesheets using Enqueue
function builder_styles() {

	$uri = $_SERVER["REQUEST_URI"];

	if ( is_page_template( 'page-builder.php' ) || stripos($uri, '/builder/') !== false  ) {

		if (THEME_DEBUG) {
			
			$handles = array('theme-fonts', 'theme-style');
			foreach ($handles as $handle) {
				wp_dequeue_style($handle);
			}

		} else {
			
			$handles = array('theme-fonts-min', 'theme-style-min');
			foreach ($handles as $handle) {
				wp_dequeue_style($handle);
			}
			
		}

	}
}
add_action('wp_enqueue_scripts', 'builder_styles', 999); // Add Theme Stylesheet