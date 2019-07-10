<?php
// edits to the pages post type
if (is_admin()) {
	
	$prefix = 'page_';
	$post_type = 'page';
	
	// hide admin page panels
	function page_metaboxes() {
		remove_meta_box('trackbacksdiv','page','normal'); 
		remove_meta_box('postcustom','page','normal'); 
		remove_meta_box('commentstatusdiv','page','normal'); 
		remove_meta_box('commentsdiv','page','normal'); 
		remove_meta_box('authordiv','page','normal'); 
		remove_meta_box('pageauthordiv','page','normal'); 
		remove_meta_box('tagsdiv','page','side'); 
	}
	add_action('admin_init','page_metaboxes');
	
}

