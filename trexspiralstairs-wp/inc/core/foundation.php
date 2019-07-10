<?php


//https://github.com/foundationize/foundationize/blob/master/inc/shortcodes.php
/*
 * Example usage: [row class1='classa_one classa_two' style='margin: 0 auto;'][/row]
 */
function dg_grid ($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => 'grid-x grid-padding-x',
        'style' => ''
    ), $atts);
    $content = str_replace("]<br />", ']', $content);
    $content = str_replace("<br />\n[", '[', $content);
    $content = str_replace("]</p>", ']', $content);
    $content = str_replace("<p>\n[", '[', $content);
    $content = str_replace("<p>[", '[', $content);
    $content = '<div class="' . esc_attr($a['class']) . '" style="' . esc_attr($a['style']) . '">'
    . do_shortcode($content) . '</div>';
    $content = str_replace("<p></p>", '', $content);
    return force_balance_tags($content);
}
add_shortcode('row', 'dg_grid');
add_shortcode('grid', 'dg_grid');

/*
 * Example usage: [column class1='classa_one classa_two' style='margin: 0 auto;'][/column]
 */
function dg_cell ($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => 'cell',
        'style' => ''
    ), $atts);
    $content =  '<div class="cell ' . esc_attr($a['class']) . '" style="' . esc_attr($a['style']) . '">'
    . do_shortcode($content) . '</div>';
    return force_balance_tags($content);
}
add_shortcode('column', 'dg_cell');
add_shortcode('cell', 'dg_cell');


// get notices and format for foundation
function dg_message($message, $type = 'secondary') {
    $content = '';
    switch ($type) {
        case 'error':
            $classes[] = 'alert';
            break;
        case 'notice':
            $classes[] = 'secondary';
            break;
        case 'success':
            $classes[] = 'success';
            break;
    }
    $content .= '<div class="'.implode(' ', $classes).' callout"><p>'.$message.'</p></div>';

    return $content;
}


/**
 * Foundation Press stuff
 * https://github.com/olefredrik/FoundationPress
 */

if ( ! function_exists( 'foundationpress_theme_support' ) ) :
function foundationpress_theme_support() {
    // Switch default core markup for search form, comment form, and comments to output valid HTML5
    add_theme_support( 'html5', array(
        'caption',
    ) );
}
add_action( 'after_setup_theme', 'foundationpress_theme_support' );
endif;

// Clean up WordPress defaults
if ( ! function_exists( 'foundationpress_start_cleanup' ) ) :
function foundationpress_start_cleanup() {
    // Remove inline width attribute from figure tag
    add_filter( 'img_caption_shortcode', 'foundationpress_remove_figure_inline_style', 10, 3 );
}
add_action( 'after_setup_theme','foundationpress_start_cleanup' );
endif;

// Remove inline width attribute from figure tag causing images wider than 100% of its conainer
if ( ! function_exists( 'foundationpress_remove_figure_inline_style' ) ) :
function foundationpress_remove_figure_inline_style( $output, $attr, $content ) {
    $atts = shortcode_atts( array(
        'id'      => '',
        'align'   => 'alignnone',
        'width'   => '',
        'caption' => '',
        'class'   => '',
    ), $attr, 'caption' );
    $atts['width'] = (int) $atts['width'];
    if ( $atts['width'] < 1 || empty( $atts['caption'] ) ) {
        return $content;
    }
    if ( ! empty( $atts['id'] ) ) {
        $atts['id'] = 'id="' . esc_attr( $atts['id'] ) . '" ';
    }
    $class = trim( 'wp-caption ' . $atts['align'] . ' ' . $atts['class'] );
    if ( current_theme_supports( 'html5', 'caption' ) ) {
        return '<figure ' . $atts['id'] . ' class="' . esc_attr( $class ) . '">'
        . do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $atts['caption'] . '</figcaption></figure>';
    }
}
endif;

/**
 * Enable Foundation responsive embeds for WP video embeds
 */
if ( ! function_exists( 'foundationpress_responsive_video_oembed_html' ) ) :
    function foundationpress_responsive_video_oembed_html( $html, $url, $attr, $post_id ) {
        // Whitelist of oEmbed compatible sites that **ONLY** support video.
        // Cannot determine if embed is a video or not from sites that
        // support multiple embed types such as Facebook.
        // Official list can be found here https://codex.wordpress.org/Embeds
        $video_sites = array(
            'youtube', // first for performance
            'collegehumor',
            'dailymotion',
            'funnyordie',
            'ted',
            'videopress',
            'vimeo',
        );
        $is_video = false;
        // Determine if embed is a video
        foreach ( $video_sites as $site ) {
            // Match on `$html` instead of `$url` because of
            // shortened URLs like `youtu.be` will be missed
            if ( strpos( $html, $site ) ) {
                $is_video = true;
                break;
            }
        }
        // Process video embed
        if ( true == $is_video ) {
            // Find the `<iframe>`
            $doc = new DOMDocument();
            $doc->loadHTML( $html );
            $tags = $doc->getElementsByTagName( 'iframe' );
            // Get width and height attributes
            foreach ( $tags as $tag ) {
                $width  = $tag->getAttribute( 'width' );
                $height = $tag->getAttribute( 'height' );
                break; // should only be one
            }
            $class = 'responsive-embed'; // Foundation class
            // Determine if aspect ratio is 16:9 or wider
            if ( is_numeric( $width ) && is_numeric( $height ) && ( $width / $height >= 1.7 ) ) {
                $class .= ' widescreen'; // space needed
            }
            // Wrap oEmbed markup in Foundation responsive embed
            return '<div class="' . $class . '">' . $html . '</div>';
        } else { // not a supported embed
            return $html;
        }
    }
    add_filter( 'embed_oembed_html', 'foundationpress_responsive_video_oembed_html', 10, 4 );
endif;


// reveal button shortcode
// http://foundation.zurb.com/sites/docs/reveal.html
/*
 * Example usage: [modal-button id='uniqueid' class='button'][/modal-button]
 */
function dg_foundation_reveal_button($atts, $content = null) {
    $a = shortcode_atts(array(
        'id' => 'reveal_modal',
        'class' => 'button',
        'style' => '',
        'title' => ''
    ), $atts);
    
    $content = '<a data-open="'.esc_attr($a['id']).'" class="'.esc_attr($a['class']).'" style="'.esc_attr($a['style']).'" title="'.esc_attr($a['title']).'">'
    . do_shortcode($content) . '</a>';
    return $content;
}
add_shortcode('reveal-button', 'dg_foundation_reveal_button');
add_shortcode('modal-button', 'dg_foundation_reveal_button');

// reveal content shortcode
// http://foundation.zurb.com/sites/docs/reveal.html
/*
 * Example usage: [modal-content id='uniqueid'][/modal-content]
 */
function dg_foundation_reveal_content($atts, $content = null) {
    $a = shortcode_atts(array(
        'id' => 'reveal_modal',
        'class' => 'button'
    ), $atts);
    
    $content = '<div id="'.esc_attr($a['id']).'" class="reveal '.esc_attr($a['class']).'" data-reveal data-reveal data-animation-in="fade-in" data-animation-out="fade-out" data-v-offset="80">';
    $content .= '<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>';
    $content .= do_shortcode($content);
    $content .= '</div>';
    return $content;
}
add_shortcode('reveal-content', 'dg_foundation_reveal_content');
add_shortcode('modal-content', 'dg_foundation_reveal_content');