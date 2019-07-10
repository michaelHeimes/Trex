<?php

// convert the_content filter items to HTTPS
if (!function_exists('filter_wp_content_for_ssl')) {
	function filter_wp_content_for_ssl($content) {
		if(isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {
			$wpurl = parse_url(get_bloginfo('wpurl'));
			$nonssl = 'http://'.$wpurl['host'];
			$ssl = 'https://'.$wpurl['host'];
			$content = str_replace($nonssl,$ssl,$content);
		}
		return $content;
	}
	add_filter('the_content', 'filter_wp_content_for_ssl', 100);
}

// filter acf items to HTTPS
if (!function_exists('format_value_wysiwyg')) {
	function format_value_wysiwyg( $value, $post_id, $field ) {
		if(isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {
			$wpurl = parse_url(get_bloginfo('wpurl'));
			$nonssl = 'http://'.$wpurl['host'];
			$ssl = 'https://'.$wpurl['host'];
			$value = str_replace($nonssl,$ssl,$value);
		}
		return $value;
	}
	add_filter('acf/format_value/type=wysiwyg', 'format_value_wysiwyg', 10, 3);
	add_filter('acf/format_value_for_api/type=wysiwyg', 'format_value_wysiwyg', 10, 3);
}

// upload svg
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// edit link
// pulled form wp-includes/admin-bar.php wp_admin_bar_edit_menu()
if (!function_exists('dg_admin_edit_link')) {
	function dg_admin_edit_link() {
		global $wp_the_query;

		$current_object = $wp_the_query->get_queried_object();
		$item = array();

		if ( empty( $current_object ) )
			return;

		if ( ! empty( $current_object->post_type )
			&& ( $post_type_object = get_post_type_object( $current_object->post_type ) )
			&& current_user_can( 'edit_post', $current_object->ID )
			&& $post_type_object->show_in_admin_bar
			&& $edit_post_link = get_edit_post_link( $current_object->ID ) )
		{
			$item = array(
				'id' => 'edit',
				'title' => $post_type_object->labels->edit_item,
				'href' => $edit_post_link
			);
		} elseif ( ! empty( $current_object->taxonomy )
			&& ( $tax = get_taxonomy( $current_object->taxonomy ) )
			&& current_user_can( 'edit_term', $current_object->term_id )
			&& $edit_term_link = get_edit_term_link( $current_object->term_id, $current_object->taxonomy ) )
		{
			$item = array(
				'id' => 'edit',
				'title' => $tax->labels->edit_item,
				'href' => $edit_term_link
			);
		} elseif ( is_a( $current_object, 'WP_User' )
			&& current_user_can( 'edit_user', $current_object->ID )
			&& $edit_user_link = get_edit_user_link( $current_object->ID ) )
		{
			$item = array(
				'id'    => 'edit',
				'title' => __( 'Edit User' ),
				'href'  => $edit_user_link,
			);
		}

		return $item;
	}

	function dg_admin_edit_title() {
		$link = dg_admin_edit_link();
		return (isset($link['title']) ? $link['title'] : '');
	}

	function dg_admin_edit_href() {
		$link = dg_admin_edit_link();
		return (isset($link['href']) ? $link['href'] : '');
	}
}

// cleanup admin bar
// for better barba usage
if (!function_exists('dg_admin_bar_render')) {
	function dg_admin_bar_render() {
	    global $wp_admin_bar;
	    $wp_admin_bar->remove_menu('updates');
	    $wp_admin_bar->remove_menu('customize');
	    $wp_admin_bar->remove_menu('comments');
	    $wp_admin_bar->remove_menu('new_draft');
	    $wp_admin_bar->remove_menu('itsec_admin_bar_menu');
	}
	add_action( 'wp_before_admin_bar_render', 'dg_admin_bar_render', 20);
}