<?php

// have plugin load JS on all pages
define("POPMAKE_FORCE_SCRIPTS", true);

// move popup html into barba wrapper
remove_action( 'wp_footer', 'popmake_render_popups', 1 );
add_action( 'barbajs_before_wrapper_close', 'popmake_render_popups', 1 );