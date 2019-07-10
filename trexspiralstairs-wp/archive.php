<?php get_header(); ?>

<main role="main">

	<section class="grid-container grid-container-padded">
		
		<div class="grid-x grid-margin-x">
		
			<div class="cell small-12 medium-8">

				<h1>Archives</h1>

				<?php get_template_part('loop'); ?>

				<?php get_template_part('pagination'); ?>
				
			</div>
			
			<?php get_sidebar(); ?>

		</div>

	</section>

</main>

<?php get_footer(); ?>