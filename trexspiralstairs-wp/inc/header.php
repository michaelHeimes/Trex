<?php

// prevent fouc
// http://johnpolacek.com/2012/10/03/help-prevent-fouc/
function dg_no_fouc() {
    echo '<style type="text/css">.no-fouc {display: none;}</style><script type="text/javascript">document.documentElement.className = "no-fouc";</script>';
}
add_action('wp_head', 'dg_no_fouc', 1);

// Check if post should have barba setup
// Used to disable barba on certain areas of the site
function dg_has_barba() {
    $has_barba = true;

    global $post;
    $get_page_template = basename(get_page_template());
    $blog_page = (is_home() ? true : false);

    //if (is_page() && $get_page_template == 'template-account.php') $has_barba = false;
    //if ($blog_page) $has_barba = false;
    if (is_single()) $has_barba = false;
    //if (is_archive()) $has_barba = false;
    //if (is_front_page()) $has_barba = false;

    return $has_barba;
}

// disable open sans for monarch plugin
function theme_et_monarch_disable_fonts() {
    if ( function_exists('is_plugin_active') && is_plugin_active( 'monarch/monarch.php' ) ) {
        wp_dequeue_style( 'et-gf-open-sans' );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_et_monarch_disable_fonts', 99 );