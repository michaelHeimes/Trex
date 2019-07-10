<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">
		
	<!-- Section -->
	<section class="grid-container mobile-fw">

		<div class="grid-x grid-padding-x mobile-fw">

			<div class="cell small-12 mobile-fw">

				<h1 class="hide"><?php the_title(); ?></h1>
				
				<h2 class="home-models-title light-gray-title wow fadeInDown">Models</h2>

				<div class="grid-container grid-x grid-margin-x mobile-fw">
				<?php if( have_rows('natural', '34') ):?>
					<div class="single-product cell small-12 medium-6 container mobile-fw wow fadeInUp">
						<div class="grid-x">
							<?php while ( have_rows('natural', '34') ) : the_row();?>	
								<div class="copy-wrap small-12 mobile-8">
									<h2 class="title"><?php the_sub_field('title', '34');?></h2>
<!-- 									<p class="price"><span>Starting at </span><?php the_sub_field('price', '34');?></p> -->
									<div class="description"><?php the_sub_field('description', '34');?></div>
									<div class="button-build-wrap">
										<div><a class="button" href="<?php the_sub_field('link_to_product_page', '34');?>">Learn More</a></div>
										<div class="builder-link"><a href="<?php the_sub_field('builder_url', '34');?>">Or build your own<i class="icon icon-trex-arrow-right"></i></a></div>
									</div>
								</div>
								<div class="image-wrap model-cube-img-wrap small-12 mobile-4">
									<?php 
									$image = get_sub_field('image', '34');
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
		
				<?php if( have_rows('high-performance', '34') ):?>
					<div class="single-product cell small-12 medium-6 container mobile-fw wow fadeInUp" data-wow-delay="0.5s">
						<div class="grid-x">
							<?php while ( have_rows('high-performance', '34') ) : the_row();?>	
								<div class="copy-wrap small-12 mobile-7 medium-8">
									<h2 class="title"><?php the_sub_field('title', '34');?></h2>
<!-- 									<p class="price"><span>Starting at </span><?php the_sub_field('price', '34');?></p> -->
									<div class="description"><?php the_sub_field('description', '34');?></div>
									<div class="button-build-wrap">
										<div><a class="button" href="<?php the_sub_field('link_to_product_page', '34');?>">Learn More</a></div>
										<div class="builder-link"><a href="<?php the_sub_field('builder_url', '34');?>">Or build your own<i class="icon icon-trex-arrow-right"></i></a></div>
									</div>
								</div>
								<div class="image-wrap hp-model-cube-img-wrap small-12 mobile-4">
									<?php 
									$image = get_sub_field('image', '34');
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

			</div>

		</div>

	</section>
	<!-- /Section -->

	<section id="get-inspired" class="grid-container masonry-grid">
		<h2 class="home-ispriration-title light-gray-title wow fadeInDown">Get Inspired</h2>
		<div class="grid wow fadeInUp">
			<?php echo do_shortcode('[ajax_load_more id="3757590561" post_type="inspire" posts_per_page="7" scroll="false" images_loaded="true" button_label="Load More" button_loading_label="Loading More..." transition_container="false" taxonomy="inspire_cats" taxonomy_operator="IN" taxonomy_terms=""]');?>
			<div class="text-center">
				<a id="home-inspiration-link" class="grey-button button alm-load-more-btn" href="<?php get_site_url();?>/inspiration">View All</a>
			</div>
		</div>
	</section>
	
	
	<?php if( have_rows('partners', '61') ):?>
		<section id="partners" class="grid-container wow fadeIn">

			<h2 class="partners-title light-gray-title wow fadeInDown">In Partnership</h2>
			<div id="partners-wrap" class="grid-container grid-x">
				<?php while ( have_rows('partners', '61') ) : the_row();?>	
				
				<?php $numberOfPartners = count(get_field('installation_steps'));
						$partnerNumber = get_row_index(); 
						$delay = 0.25;
						$time = $partnerNumber * $delay;						    
						    
				?>

				<?php if( have_rows('single_partner', '61') ):?>
					<?php while ( have_rows('single_partner', '61') ) : the_row();?>	
						<?php 
						$image = get_sub_field('logo', '61');
						if( !empty($image) ): ?>
						<a class="wow fadeInUp" data-wow-delay="<?php echo $time;?>s" href="<?php the_sub_field('link');?>" target="_blank"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
						<?php endif; ?>
					<?php endwhile;?>
				<?php endif;?>				
				<?php endwhile;?>
			</div>
				<div id="pa-pride-wrap" class="text-center wow fadeInUp" data-wow-delay="1s">
					<img src="/wp-content/themes/trexspiralstairs/assets/img/pa.png" alt="pennsylvania-state-outline"/>
					<p>Proudly made in Pennsylvania, USA.</p>
				</div>
		</section>
	<?php endif;?>
	
<!--
	<section id="been-up-to" class="grid-container">
			<h2 class="light-gray-title wow fadeInDown">What We've Been Up To</h2>
			<?php 
			$link = get_field('instagram_link');
			if( $link ): 
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<a id="ig-link" class="wow fadeInUp" data-wow-delay="0.25s" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
			<?php endif; ?>
			
			<div id="ig-feed-wrap" class="container wow fadeInUp" data-wow-delay="0.25s">
				<?php echo do_shortcode('[instagram-feed]');?>
			</div>
	</section>
-->

</main>

<?php get_footer(); ?>