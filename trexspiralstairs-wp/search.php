<?php get_header(); ?>
	
	<main role="main">
	
		<!-- Section -->
		<section class="grid-container">
	
			<h1><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

			<div class="grid-x grid-padding-x">

				<div class="cell medium-8 small-12">
		
					<?php get_template_part('loop'); ?>
			
					<?php get_template_part('pagination'); ?>
				
				</div>
	
				<?php get_sidebar(); ?>

			</div>
	
		</section>
		<!-- /Section -->
		
	</main>

<?php get_footer(); ?>
