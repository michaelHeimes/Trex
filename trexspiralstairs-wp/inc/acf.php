<?php

// ACF options pages
if( function_exists('acf_add_options_page') ) {

    // add parent
    $parent = acf_add_options_page(array(
        'page_title'    => 'Site Options',
        'menu_title'    => 'Site Options',
        'redirect'      => true,
        'capability'    => 'manage_options',
    ));

    // add sub page
    acf_add_options_sub_page(array(
        'page_title'    => 'General Settings',
        'menu_title'    => 'General',
        'parent_slug'   => $parent['menu_slug'],
        'capability'    => 'manage_options',
    ));

    // add sub page
    acf_add_options_sub_page(array(
        'page_title'    => 'Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => $parent['menu_slug'],
        'capability'    => 'manage_options',
    ));

}

// boost acf admin load time
// https://www.advancedcustomfields.com/blog/acf-pro-5-5-13-update/
add_filter('acf/settings/remove_wp_meta_box', '__return_true');

// run do_shortcode on fields by default
function dg_acf_format_value_shortcode( $value, $post_id, $field ) {
    
    // run do_shortcode
    $value = do_shortcode($value);
    
    // return
    return $value;
}
add_filter('acf/format_value/type=text', 'dg_acf_format_value_shortcode', 10, 3);
add_filter('acf/format_value/type=textarea', 'dg_acf_format_value_shortcode', 10, 3);