<?php get_header(); ?>

<main role="main">

	<section class="grid-container grid-container-padded">

		<article id="post-404" class="text-center">

			<h3><?php _e( 'Page not found', 'html5blank' ); ?></h3>
			<p>We are sorry but this page does not exist. Please <a href="<?php echo home_url(); ?>"><?php _e( 'return to the home page', 'html5blank' ); ?></a> or go to another page on the site via the navigation menu.</p>
		</article>

	</section>

</main>

<?php get_footer(); ?>

