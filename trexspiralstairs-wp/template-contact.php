<?php /* Template Name: Contact */ ?>

<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">

	<section class="grid-container">

<!-- 		<div class="b-lazy bg-image" data-src="<?php echo $fields['aspot_bg']['url']; ?>"></div> -->

		<?php if (get_field('copy')):?>
			<div id="contact-copy-wrap">
				<div id="contact-copy" class="grid-container">
					<?php the_field('copy');?>
				</div>
			</div>
		<?php endif;?>	
	</section>
	

</main>

<?php get_footer(); ?>


