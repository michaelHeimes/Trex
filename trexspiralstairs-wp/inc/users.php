<?php

// remove admin bar for roles
function remove_admin_bar() {
	if (!current_user_can('administrator') && !current_user_can('shop_manager') && !current_user_can('editor') && !is_admin()) {
		show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'remove_admin_bar');

