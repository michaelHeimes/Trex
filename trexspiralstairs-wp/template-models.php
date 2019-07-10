<?php /* Template Name: Models */ ?>

<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">

	<section class="grid-container  mobile-fw">

<!-- 		<div class="b-lazy bg-image" data-src="<?php echo $fields['aspot_bg']['url']; ?>"></div> -->

		<div class="grid-container grid-x grid-margin-x mobile-fw">
		<?php if( have_rows('natural') ):?>
			<div class="single-product cell small-12 medium-6 container mobile-fw wow fadeInUp">
				<div class="grid-x">
					<?php while ( have_rows('natural') ) : the_row();?>	
						<div class="copy-wrap small-12 mobile-8">
							<h2 class="title"><?php the_sub_field('title');?></h2>
<!-- 							<p class="price"><span>Starting at </span><?php the_sub_field('price');?></p> -->
							<div class="description"><?php the_sub_field('description');?></div>
							<div class="button-build-wrap">
								<div><a class="button" href="<?php the_sub_field('link_to_product_page');?>">Learn More</a></div>
								<div class="builder-link"><a href="<?php the_sub_field('builder_url');?>">Or build your own<i class="icon icon-trex-arrow-right"></i></a></div>
							</div>
						</div>
						<div class="image-wrap model-cube-img-wrap small-12 mobile-4">
							<?php 
							$image = get_sub_field('image');
							$size = 'full'; // (thumbnail, medium, large, full or custom size)
							if( $image ) {
								echo wp_get_attachment_image( $image, $size );
							}
							?>
						</div>
					<?php endwhile;?>
				</div>
			</div>
		<?php endif;?>	

		<?php if( have_rows('high-performance') ):?>
			<div class="single-product cell small-12 medium-6 container  mobile-fw wow fadeInUp" data-wow-delay="0.5s">
				<div class="grid-x">
					<?php while ( have_rows('high-performance') ) : the_row();?>	
						<div class="copy-wrap small-12 mobile-8">
							<h2 class="title"><?php the_sub_field('title');?></h2>
<!-- 							<p class="price"><span>Starting at </span><?php the_sub_field('price');?></p> -->
							<div class="description"><?php the_sub_field('description');?></div>
							<div class="button-build-wrap">
								<div><a class="button" href="<?php the_sub_field('link_to_product_page');?>">Learn More</a></div>
								<div class="builder-link"><a href="<?php the_sub_field('builder_url');?>">Or build your own<i class="icon icon-trex-arrow-right"></i></a></div>
							</div>
						</div>
						<div class="image-wrap hp-model-cube-img-wrap small-12 mobile-4">
							<?php 
							$image = get_sub_field('image');
							$size = 'full'; // (thumbnail, medium, large, full or custom size)
							if( $image ) {
								echo wp_get_attachment_image( $image, $size );
							}
							?>
						</div>
			<?php endwhile;?>
				</div>
			</div>
		<?php endif;?>

		</div>

	</section>

</main>

<?php get_footer(); ?>
