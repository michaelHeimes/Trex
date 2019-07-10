<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">

	<!-- Section -->
	<section class="grid-container">

		<div class="grid-x grid-padding-x">

			<div class="cell small-12">

				<h1 class="hide"><?php the_title(); ?></h1>

				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
					<?php the_content(); ?>
				
					<br class="clearfix">
				
				</article>
				<!-- /Article -->
			
				<?php endwhile; endif; ?>

			</div>

		</div>

	</section>
	<!-- /Section -->

</main>

<?php get_footer(); ?>