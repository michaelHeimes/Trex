<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class('column'); ?>>

		<div class="bg-wrapper">
			
			<?php /*
			<!-- Post Thumbnail -->
			<?php
			if (has_post_thumbnail()) {
				$image = thumb(get_the_post_thumbnail_url($post, 'full'), 580, 435);
			} else {
				// default image
				$image = get_field('default_post_image', 'option');
				$image = thumb($image['url'], 580, 435);
			}
			?>
			<?php if ($image): ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="image">
				<img src="<?php echo $image['url']; ?>" alt="<?php echo esc_attr(get_the_title()); ?>" ?>
			</a>
			<?php endif; ?>
			<!-- /Post Thumbnail -->
			*/ ?>

			<div class="content-wrapper">
			
				<!-- Post Title -->
				<h2>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h2>
				<!-- /Post Title -->

				<p class="date">
					<?php the_time('F j, Y'); ?>
				</p>

				<?php
				$terms = get_the_terms($post, 'category');
				if ($terms):
					$terms_list = array();
					foreach ($terms as $term) {
						$terms_list[] = '<a href="'.get_term_link($term).'">'.$term->name.'</a>';
					}
				?>
				<p class="category">
					<?php echo implode(', ', $terms_list); ?>
				</p>
				<?php endif; ?>
				
				<div class="excerpt">
					<?php theme_excerpt('theme_blog', 'theme_blog_article'); // Build your custom callback length in functions.php ?>
				</div>

			</div>

			<a class="view-article button-link-arrow" href="<?php echo get_permalink($post->ID); ?>">Read more</a>

		</div>
		
	</article>
	<!-- /Article -->
	
<?php endwhile; ?>

<?php else: ?>

	<!-- Article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /Article -->

<?php endif; ?>
