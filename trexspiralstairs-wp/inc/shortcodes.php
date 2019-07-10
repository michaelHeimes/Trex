<?php
/*
 * ========================================================================
 *  Shortcodes
 * ========================================================================
 */

// process only certain shortcodes
// $tagnames is an array
function do_shortcode_only_for($content, $tagnames) {
	$pattern = get_shortcode_regex($tagnames);
	$content = preg_replace_callback("/$pattern/", 'do_shortcode_tag', $content);
	return $content;
}

// div shortcode
function div_shortcode($atts, $content = null) {
	$html .= '<div';
	foreach ($atts as $attr => $value) {
		if( $value != '' ) { // adding all attributes
			$html .= ' ' . $attr . '="' . $value . '"';
		} else { // adding empty attributes
			$html .= ' ' . $attr;
		}
	}
	$html .= '>'.preg_replace('#^<\/p>|<p>$#', '', do_shortcode(trim($content))).'</div>';
	return $html;
}
add_shortcode('div', 'div_shortcode');

// script shortcode
function script_shortcode($atts, $content = null) {
	$html .= '<script';
	foreach ($atts as $attr => $value) {
		if( $value != '' ) { // adding all attributes
			$html .= ' ' . $attr . '="' . $value . '"';
		} else { // adding empty attributes
			$html .= ' ' . $attr;
		}
	}
	$html .= '>'.preg_replace('#^<\/p>|<p>$#', '', do_shortcode(trim($content))).'</script>';
	return $html;
}
add_shortcode('script', 'script_shortcode');

// icon shortcode
function dg_icon_shortcode($atts, $content = null) {
	extract( shortcode_atts( array(
		'name' => false
	), $atts ) );

	if (!empty($name)) {
		$classes = array();
		$classes[] = sanitize_title($name);
		$content = '<i class="icon icon-'.implode('', $classes).'"></i>';
	}

	return $content;
}
add_shortcode('icon', 'dg_icon_shortcode');

// blockquote shortcode
function dg_blockquote_shortcode($atts, $content = null) {
	$content = '<blockquote>'.$content.'</blockquote>';

	return $content;
}
add_shortcode('quote', 'dg_blockquote_shortcode');
add_shortcode('blockquote', 'dg_blockquote_shortcode');

// break shortcode
function dg_br_shortcode($atts, $content = null) {
	$content = '<br>';

	return $content;
}
add_shortcode('br', 'dg_br_shortcode');
add_shortcode('break', 'dg_br_shortcode');