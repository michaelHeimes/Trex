<?php

function theme_nav_header() {
  wp_nav_menu( array(
    'theme_location'  => 'header',
    'menu' => __( 'Header Menu', '_dg'),
    'container' => false,
    'menu_class' => 'menu-header',
    'menu_id' => '',
    'items_wrap' => '<ul class="menu menu-header no-bullet">%3$s</ul>',
    'depth' => 0,
    'fallback_cb' => 'wp_navwalker::fallback',
    //'walker' => new wp_navwalker()
  ));
}

function theme_nav_footer() {
  wp_nav_menu( array(
    'theme_location'  => 'footer',
    'menu' => __( 'Footer Menu', '_dg'),
    'container' => false,
    'menu_class' => 'menu-footer',
    'menu_id' => '',
    'items_wrap' => '<ul class="menu menu-footer no-bullet">%3$s</ul>',
    'depth' => 0,
    'fallback_cb' => 'wp_navwalker::fallback',
    //'walker' => new wp_navwalker()
  ));
}


function register_theme_menus() {
  register_nav_menus(array(
    'header' => __('Header Menu', '_dg'),
    'footer' => __('Footer Menu', '_dg')
  ));
}
add_action( 'after_setup_theme', 'register_theme_menus' );
