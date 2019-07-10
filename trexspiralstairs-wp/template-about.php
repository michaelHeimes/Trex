<?php /* Template Name: About */ ?>

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
	
	<section id="partners" class="grid-container">
		<?php if( have_rows('partners') ):?>
			<h2 class="partners-title light-gray-title">In Partnership</h2>
			<div id="partners-wrap" class="grid-container grid-x">
				<?php while ( have_rows('partners') ) : the_row();?>	
				<?php if( have_rows('single_partner') ):?>
					<?php while ( have_rows('single_partner') ) : the_row();?>	
						<?php 
						$image = get_sub_field('logo');
						if( !empty($image) ): ?>
						<a href="<?php the_sub_field('link');?>" target="_blank"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
						<?php endif; ?>
					<?php endwhile;?>
				<?php endif;?>				
				<?php endwhile;?>
			</div>
		<?php endif;?>

		<div id="pa-pride-wrap" class="text-center">
			<img src="/wp-content/themes/trexspiralstairs/assets/img/pa.png" alt="pennsylvania-state-outline"/>
			<p>Proudly made in Pennsylvania, USA.</p>
		</div>
	</section>

</main>

<?php get_footer(); ?>


