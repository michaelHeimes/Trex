<?php

// Make Scripts Load In Footer
add_filter('gform_init_scripts_footer', '__return_true');

// load all forms
function dg_load_all_gf_footer_code() {
	if (class_exists('GFFormsModel')) {
		$forms = GFFormsModel::get_forms( null, 'title' );
		foreach ($forms as $form) {
			do_shortcode('[gravityform id="'.$form->id.'" ajax="true"]');
		}
	}
}
add_action('wp_footer', 'dg_load_all_gf_footer_code');

// Confirmation Anchor
function theme_gform_confirmation_anchor($enabled) {
  return false;
}
add_filter('gform_confirmation_anchor','theme_gform_confirmation_anchor');

// enable hide/show labels in Gravity Forms
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// filter the Gravity Forms button type
add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form) {
	return "<button class='button gform_button no-barba' id='gform_submit_button_{$form["id"]}'><span>".$form['button']['text']."</span></button>";
}


/**
 * Loading Gravity Forms with ajax
 */

	function gf_button_ajax_get_form(){
		$user_id = isset( $_GET['user_id'] ) ? absint( $_GET['user_id'] ) : 0;
			$params = array();
			if (!empty($user_id)) {
				$user_info = get_userdata($user_id);
				$params['first_name'] = $user_info->first_name;
				$params['last_name'] = $user_info->last_name;
				$params['email'] = $user_info->user_email;
			}

		$form_id = isset( $_GET['form_id'] ) ? absint( $_GET['form_id'] ) : 0;
		// Render an AJAX-enabled form.
		// https://www.gravityhelp.com/documentation/article/embedding-a-form/#function-call
		gravity_form( $form_id,false, false, false, $params, true );
		die();
	}
	add_action( 'wp_ajax_nopriv_gf_button_get_form', 'gf_button_ajax_get_form' );
	add_action( 'wp_ajax_gf_button_get_form', 'gf_button_ajax_get_form' );