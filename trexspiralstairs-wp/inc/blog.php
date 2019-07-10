<?php

/**
 * Customized Excerpt
 */

	add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
	add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
	add_filter('excerpt_more', 'theme_view_article'); // Add 'View Article' button instead of [...] for Excerpts
	remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

	// Custom Excerpts
	function theme_index($length) { // Create 20 Word Callback for Index page Excerpts, call using theme_excerpt('theme_index');
			return 40;
	}

	// Create 40 Word Callback for Custom Post Excerpts, call using theme_excerpt('theme_custom_post');
	function theme_blog($length) {
			return 20;
	}

	// Create the Custom Excerpts callback
	function theme_excerpt($length_callback = '', $more_callback = '') {
			global $post;
			if (function_exists($length_callback)) {
					add_filter('excerpt_length', $length_callback);
			}
			if (function_exists($more_callback)) {
					add_filter('excerpt_more', $more_callback);
			}
			$output = get_the_excerpt();
			$output = apply_filters('wptexturize', $output);
			$output = apply_filters('convert_chars', $output);
			if (!empty($output) && function_exists($more_callback)) {
					if (function_exists($length_callback)) $output = wp_trim_words($output, call_user_func($length_callback, '') , '' );
					$output .= call_user_func($more_callback, '');
			}
			$output = '<p>' . $output . '...</p>';
			echo $output;
	}

	// Custom View Article link to Post
	function theme_view_article($more) {
			global $post;
			return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
	}


	// Custom View Article link to Post
	function theme_blog_article($more) {
			return '';
			// global $post;
			// return ' <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('Read more', 'html5blank') . '</a>';
	}


/**
 * Comments
 */

	// Threaded Comments
	function enable_threaded_comments() {
			if (!is_admin()) {
					if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
							wp_enqueue_script('comment-reply');
					}
			}
	}
	add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments

	// Custom Comments Callback
	function theme_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
	?>
		<!-- heads up: starting < for the html tag (li or div) in the next line: -->
		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
		<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>

			<div class="grid-x grid-padding-x">
				<div class="cell small-12 medium-2">
					<div class="comment-author vcard">
						<p class="text-center">
							<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
							<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
						</p>
					</div>
				</div>
				<div class="cell small-12 medium-10">
					<?php if ($comment->comment_approved == '0') : ?>
						<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
						<br />
					<?php endif; ?>

					<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a>
					</div>

					<div class="comment-text">
						<?php comment_text() ?>
					</div>

					<ul class="menu">
						<li class="reply">
							<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => 'Reply'))) ?>
						</li>
					</ul>
				</div>
			</div>

		<?php if ( 'div' != $args['style'] ) : ?>
		</div>
		<?php endif; ?>
	<?php }


	// custom comment form fields
	function theme_comment_form_fields( $fields ) {

		unset($fields['author']);
		unset($fields['email']);
		unset($fields['url']);

		$commenter = wp_get_current_commenter();
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html_req = ( $req ? " required='required'" : '' );
		$html5    = 'html5';

		$fields['author'] = '<p class="comment-form-author group"><label for="author">' . __( 'Name', 'domainreference' ) . ' '.( $req ? '<span class="required">*</span>' : '' ).'</label> <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="Name" /></p>';

		$fields['email']  = '<p class="comment-form-email group"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="Email" /></p>';

		return $fields;
	}
	add_filter( 'comment_form_default_fields', 'theme_comment_form_fields' );

	// custom comment_field
	function theme_comment_form_field_comment($comment_field) {
		$comment_field = '<p class="comment-form-comment group"><label for="comment" class="invisible">' . _x( 'Comments', 'noun' ) .
		    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" maxlength="65525" placeholder="Comments">' .
		    '</textarea></p>';
		return $comment_field;
	}
	add_filter( 'comment_form_field_comment', 'theme_comment_form_field_comment' );

	// define the comment_form_submit_button
	function theme_comment_form_submit_button( $submit_button, $args ) {
		$submit_before = '<div class="form-group">';
		$submit_after = '</div>';
		return $submit_before . $submit_button . $submit_after;
	};
	//add_filter( 'comment_form_submit_button', 'theme_comment_form_submit_button', 10, 2 );

	// Save custom comment form field meta data
	function theme_save_custom_comment_field_data( $comment_id ) {
		// if ( ( isset( $_POST['custom_value'] ) ) && ( $_POST['custom_value'] != '') )
		// 	$custom_value = wp_filter_nohtml_kses($_POST['custom_value']);
		// if (!empty($custom_value)) add_comment_meta( $comment_id, 'custom_value', $custom_value );
	}
	add_action( 'comment_post', 'theme_save_custom_comment_field_data', 10, 1 );

	// Check if gravatar exists.
	function validate_gravatar($email) {
		// Craft a potential url and test its headers
		$hash = md5(strtolower(trim($email)));
		$uri = 'https://0.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($uri);
		if (!preg_match("|200|", $headers[0])) {
			$has_valid_avatar = FALSE;
		} else {
			$has_valid_avatar = TRUE;
		}
		return $has_valid_avatar;
	}

	// allow certain shortcodes in comments
	function comment_text_shortcodes( $comment_text, $comment ) { 
		$comment_text = do_shortcode_only_for($comment_text, array('quote'));
		return $comment_text; 
	};  
	//add_filter( 'comment_text', 'comment_text_shortcodes', 10, 2 );


	// remove #respond from cancel reply to comment link
	// prevents jumping back up to top comment area
	function theme_cancel_comment_reply_link($formatted_link, $link, $text) {
		$formatted_link = str_replace('#respond', '', $formatted_link);
		return $formatted_link;
	}
	add_filter('cancel_comment_reply_link', 'theme_cancel_comment_reply_link', 10, 3);

	// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
	function theme_pagination() {
	    global $wp_query;
	    $big = 999999999;
	    echo paginate_links(array(
	        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
	        'format' => '?paged=%#%',
	        'current' => max(1, get_query_var('paged')),
	        'total' => $wp_query->max_num_pages
	    ));
	}
	add_action('init', 'theme_pagination'); // Add our HTML5 Pagination



/**
 * Images
 */


	// add additional images sizes
	function dg_custom_image_sizes( $sizes ) {
			return array_merge( $sizes, array(
					'xlarge' => __( 'Extra Large' ),
					'xwide' => __( 'Extra Wide' ),
			) );
	}
	add_filter( 'image_size_names_choose', 'dg_custom_image_sizes' );


/**
 * Misc
 */

	// Reading Time
	function dg_estimated_reading_time() {

		$post = get_post();

		$words = str_word_count( strip_tags( $post->post_content ) );
		$minutes = floor( $words / 120 );
		$seconds = floor( $words % 120 / ( 120 / 60 ) );

		if ( 1 <= $minutes ) {
			// $estimated_time = $minutes . ' minute' . ($minutes == 1 ? '' : 's') . ', ' . $seconds . ' second' . ($seconds == 1 ? '' : 's');
			$estimated_time = $minutes . ' min.' . ($minutes == 1 ? '' : ' read');
		} else {
			$estimated_time = $seconds . ' sec' . ($seconds == 1 ? '' : 's');
		}

		return $estimated_time;

	}


/**
 * Archives
 */

	// Add a class to the archive link if it is the current one
	function dg_get_archives_link( $link_html ) {	
		global $wp;
		static $current_url;


		if( empty( $current_url ) ) {
			$current_url = add_query_arg( $_SERVER['QUERY_STRING'], '', site_url( $wp->request).'/' ).'\'';
		}

		if ( stristr( $link_html, $current_url )  ) {
			$link_html = preg_replace( '/(<[^\s>]+)/','\1 class="current-item"',$link_html,1 );
		}

		return $link_html;
	}
	add_filter('get_archives_link', 'dg_get_archives_link');


	// Return an alternate title, without prefix, for every type used in the get_the_archive_title().
	add_filter('get_the_archive_title', function ($title) {
		if ( is_category() ) {
				$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
				$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
				$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_year() ) {
				$title = get_the_date( _x( 'Y', 'yearly archives date format' ) );
		} elseif ( is_month() ) {
				$title = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
		} elseif ( is_day() ) {
				$title = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
		} elseif ( is_tax( 'post_format' ) ) {
				if ( is_tax( 'post_format', 'post-format-aside' ) ) {
						$title = _x( 'Asides', 'post format archive title' );
				} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
						$title = _x( 'Galleries', 'post format archive title' );
				} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
						$title = _x( 'Images', 'post format archive title' );
				} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
						$title = _x( 'Videos', 'post format archive title' );
				} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
						$title = _x( 'Quotes', 'post format archive title' );
				} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
						$title = _x( 'Links', 'post format archive title' );
				} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
						$title = _x( 'Statuses', 'post format archive title' );
				} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
						$title = _x( 'Audio', 'post format archive title' );
				} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
						$title = _x( 'Chats', 'post format archive title' );
				}
		} elseif ( is_post_type_archive() ) {
				$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
				$title = single_term_title( '', false );
		} else {
				$title = __( 'Archives' );
		}
		return $title;
	});


/**
 * Categories
 */

// get primary categories from Yoast SEO plugin settings
function dg_get_primary_term($_post, $taxonomy = 'category') {
	$primary_term = false;
	$terms = get_the_terms($_post, $taxonomy);
	if ($terms) {
		if ( class_exists('WPSEO_Primary_Term') ) {
			// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
			$wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $_post->ID );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term = get_term( $wpseo_primary_term );

			if (is_wp_error($term)) { 
				// Default to first category (not Yoast) if an error is returned
				$primary_term = current($terms);
			} else { 
				// Yoast Primary category
				$primary_term = $term;
			}
		} else {
			$primary_term = current($terms);
		}
	}

	return $primary_term;
}