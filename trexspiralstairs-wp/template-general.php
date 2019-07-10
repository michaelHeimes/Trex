<?php /* Template Name: General */ ?>

<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">

	<section class="grid-container">

<!-- 		<div class="b-lazy bg-image" data-src="<?php echo $fields['aspot_bg']['url']; ?>"></div> -->

		<?php if (get_field('copy')):?>
			<div id="about-copy-wrap">
				<div id="about-copy" class="grid-container">
					<?php the_field('copy');?>
				</div>
				
				<div class="text-center model-cube-img-wrap">
					<?php 
					$image = get_field('image');
					$size = 'full'; // (thumbnail, medium, large, full or custom size)
					if( $image ) {
						echo wp_get_attachment_image( $image, $size );
					}
					?>	
				</div>
			</div>
		<?php endif;?>	
	</section>

</main>

<?php get_footer(); ?>


