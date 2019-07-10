<?php /* Template Name: Single Model */ ?>

<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">
	<section class="grid-container">

<!-- 		<div class="b-lazy bg-image" data-src="<?php echo $fields['aspot_bg']['url']; ?>"></div> -->

		<div class="grid-container grid-x grid-margin-x">
		<?php if( have_rows('model') ):?>
			<div class="single-product cell small-12 container wow fadeInUp">
				<div class="grid-x">
					<?php while ( have_rows('model') ) : the_row();?>	
						<div class="copy-wrap small-12 medium-7 wow fadeInLeft">
							<h2 class="title"><?php the_sub_field('title');?></h2>
<!-- 							<p class="price"><span>Starting at </span><?php the_sub_field('price');?></p> -->
							<div class="description"><?php the_sub_field('description');?></div>
							<?php if( have_rows('tread_options') ):?>
							<div id="tread-options" class="product-row">
								<label class="product-row-label">Tread Options</label>
								<?php while ( have_rows('tread_options') ) : the_row();?>	
									<div class="single_tread_option">
									<?php if( have_rows('single_tread_option') ):?>
										<?php while ( have_rows('single_tread_option') ) : the_row();?>	
										<?php
											$imgID1 = get_sub_field('image');
											$imgSize1 = "full";
											$imgArr1 = wp_get_attachment_image_src( $imgID1, $imgSize1 );
										?>
										<div class="tread-image" style="background-image: url(<?php echo $imgArr1[0]; ?> );background-repeat: no-repeat;background-position: center center; background-size:cover;"></div>
										<label><?php the_sub_field('label');?></label>
										<?php endwhile;?>
									<?php endif;?>			
									</div>	
								<?php endwhile;?>
							</div>
							<?php endif;?>				
										
							<?php if( get_sub_field('footnotes') ):?>
							<div id="footnotes" class="product-row">
								<?php the_sub_field('footnotes');?>
							</div>
							<?php endif;?>	
							
							<?php if( have_rows('colors') ):?>
							<div id="colors" class="product-row">
								<label class="product-row-label">Powdercoat Colors</label>
								<?php while ( have_rows('colors') ) : the_row();?>		
									<div class="single_color" style="background-color:<?php the_sub_field('single_color');?>;"></div>
								<?php endwhile;?>
							</div>
							<?php endif;?>				
							
							<?php if( have_rows('diameters') ):?>
							<div id="diameters" class="product-row">
								<label class="product-row-label">Code Compliant Diameters</label>
								<?php while ( have_rows('diameters') ) : the_row();?>		
									<div class="single_diameter product-digit"><?php the_sub_field('single_diameter');?></div>
								<?php endwhile;?>
							</div>
							<?php endif;?>								
							
							<?php if( have_rows('heights') ):?>
							<div id="heights" class="product-row">
								<label class="product-row-label">Heights</label>
								<div id="heights-wrap">
									<div id="heights-ramp"></div>
								<?php while ( have_rows('heights') ) : the_row();?>	
									<div class="single_height product-digit"><?php the_sub_field('single_height');?></div>
								<?php endwhile;?>
								</div>
							</div>
							<?php endif;?>								
							
							
							
							
							<div class="button-build-wrap">
								<div class="button" data-open="quoteModal">Get a Quote</div>
								<a class="builder-link single-product-builder-link grey-button" href="<?php the_sub_field('builder_url');?>">Build your own</a>
							</div>
						</div>
						
						<div class="image-wrap model-cube-img-wrap small-12 medium-5 wow fadeInRight">
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
		
		
<div class="reveal medium" id="quoteModal" data-animation-in="fadeIn fast" data-additional-overlay-classes="no-overlay" data-reveal>

	<button class="close-button" data-close aria-label="Close modal" type="button"><i class="icon icon-close"></i></button>
	<h2>Get a Quote</h2>

	<div class="expert-contact" class="grid-container">
		<div class="grid-x">
				<?php if( get_field('phone_number', 'option') ): ?>
					<a class="phone_number cell small-12 medium-6" href="tel:<?php the_field('phone_number', 'option'); ?>"><i class="icon icon-phone"></i><?php the_field('phone_number', 'option'); ?></a>
				<?php endif; ?>		
				
				<?php if( get_field('email_address', 'option') ): ?>
					<a class="email cell small-12 medium-6" href="mailto:<?php the_field('email_address', 'option'); ?>"><i class="icon icon-envelope"></i><?php the_field('email_address', 'option'); ?></a>
				<?php endif; ?>	
		</div>
	</div>
			
	<div class="footer-form" class="grid-container">
		<?php gravity_form( 2, true, false, false, '', true );?>
	</div>
		
</div>
	</section>
	

	
	<?php if(get_field('inspiration_shortcode')):?>
	<section id="get-inspired" class="grid-container masonry-grid">
					<h2 class="light-gray-title">Get Inspired</h2>
		<div class="grid">
			<?php the_field('inspiration_shortcode');?>
		</div>
	</section>
	<?php endif;?>
	
	
	

</main>

<?php get_footer(); ?>


