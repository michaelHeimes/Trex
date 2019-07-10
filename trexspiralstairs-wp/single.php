<?php get_header(); ?>

	<?php $fields = get_fields($post->ID); ?>
	
	<main role="main">
	
		<!-- Section -->
		<section class="grid-container">

			<div class="grid-x grid-padding-x">

				<div class="cell small-12 medium-9 xsmall-order-2">
		
					<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			
					<!-- Article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
					
						<!-- Post Title -->
						<h1 class="h2">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h1>
						<!-- /Post Title -->
					
						<?php the_content(); ?>
					
						<br class="clear">
					
					</article>
					<!-- /Article -->
				
					<?php endwhile; ?>
				
					<?php endif; ?>

				</div>
		
				<?php get_sidebar(); ?>

			</div>
	
		</section>
		<!-- /Section -->
	
		<br class="clear">
	
	</main>

<?php get_footer(); ?>
