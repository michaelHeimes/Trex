<?php
// edits to the posts post type
if (is_admin()) {
	
	$prefix = 'post_';
	$post_type = 'post';
	
	// hide admin post panels
	function post_metaboxes() {
		remove_meta_box('trackbacksdiv','post','normal'); 
		remove_meta_box('postcustom','post','normal'); 
		remove_meta_box('commentstatusdiv','post','normal'); 
		remove_meta_box('commentsdiv','post','normal'); 
		remove_meta_box('authordiv','post','normal'); 
		remove_meta_box('tagsdiv-post_tag','post','side');
	}
	add_action('admin_init','post_metaboxes');
	
}