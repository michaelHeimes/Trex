<?php /* Template Name: Homepage */ ?>

<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">

	<section id="aspot" class="grid-container">

		<div class="b-lazy bg-image" data-src="<?php echo $fields['aspot_bg']['url']; ?>"></div>

		<div class="container grid-x">
			<div class="cell small-12 medium-12">
				TEST
			</div>
		</div>

	</section>

</main>

<?php get_footer(); ?>
