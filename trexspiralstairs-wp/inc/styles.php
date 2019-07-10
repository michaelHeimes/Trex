<?php

/**
 * WP Editor
 */

	// add default styles to styleselect
	// https://codex.wordpress.org/TinyMCE_Custom_Styles
	function dg_add_styleselect_classes( $init_array ) {  
		// Define the style_formats array
		$_style_formats = array(  
			// Each array child is a format with it's own settings 
			array(  
				'title' => 'Sans Serif Font',  
				'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table',
				'classes' => 'font-sans-serif'
			),
			array(  
				'title' => 'Serif Font',  
				'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table',
				'classes' => 'font-serif'
			),
			array(  
				'title' => 'Small Text',  
				'selector' => 'p,div',
				'classes' => 'small'
			),
			array(  
				'title' => 'Large Text',  
				'selector' => 'p,div',
				'classes' => 'large'
			),
			array(  
				'title' => 'Un-bulleted List',  
				'selector' => 'ul',
				'classes' => 'no-bullet'
			),
			
			
			
		); 
		// add to exising formats
		$style_formats = (json_decode($init_array['style_formats']) ? json_decode($init_array['style_formats'], true) : array());
		foreach ($_style_formats as $key => $value) {
			$style_formats[] = $value;
		}    

		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );  
		
		return $init_array;  
	} 
	add_filter( 'tiny_mce_before_init', 'dg_add_styleselect_classes', 11 ); 


	// Add a Custom CSS File to WP Admin Area
function dg_admin_custom_style() {
	wp_register_style('dg_admincustomstyle', get_template_directory_uri() . '/assets/css/admin-custom.css', array(), '1.0', 'all');
	wp_enqueue_style('dg_admincustomstyle');
}
add_action('admin_enqueue_scripts', 'dg_admin_custom_style');