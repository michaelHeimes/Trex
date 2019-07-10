<?php get_header(); ?>
	
	<main role="main">
	
		<section class="grid-x grid-padding-x">

			<div class="cell small-12 medium-9">

				<h1>Latest Posts</h1>

				<?php get_template_part('loop'); ?>
		
				<?php get_template_part('pagination'); ?>

			</div>

			<?php get_sidebar(); ?>
	
		</section>
		
	</main>

<?php get_footer(); ?>
