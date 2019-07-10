<section id="comments">

	<?php if (comments_open()): ?>
	<div class="grid-x comment-form">

		<div class="cell small-12">
			<h3><?php comments_number(); ?></h3>

			<?php
			// form field customization theme_comment_form_fields in blog.php
			comment_form(array(
				'title_reply' => 'Leave a Comment',
				'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title show-for-sr">',
				'title_reply_after'    => '',
				'cancel_reply_before'  => '</h3><small>',
				'cancel_reply_after'   => '</small>',
				'cancel_reply_link' => '<i class="icon-close"></i> Cancel Reply',
				'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . '</p>',
				'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">Submit Comment</button>',
				'format' => 'html5',
				));
			?>
		</div>

	</div>
	<?php endif; ?>

	<?php if (have_comments()) : ?>

		<?php wp_list_comments('type=comment&callback=theme_comments&style=div'); // Custom callback in blog.php ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		
		
	<?php endif; ?>

</section>