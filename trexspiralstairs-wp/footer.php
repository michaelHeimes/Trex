	</div>
	<!-- /Wrapper -->

	<?php do_action('barbajs_before_wrapper_close'); ?>

	</div></div>
	<!-- /barba Wrapper -->
	
	<div class="expert-contact" class="grid-container">
		<div class="grid-x">
			<p class="expert-contact-label light-gray-title cell small-12 wow fadeInUp">Need help? Speak to an expert</p>
				<?php if( get_field('phone_number', 'option') ): ?>
					<a class="phone_number ecll small-12 medium-6 wow slideInLeft" href="tel:<?php the_field('phone_number', 'option'); ?>"><i class="icon icon-phone"></i><?php the_field('phone_number', 'option'); ?></a>
				<?php endif; ?>		
				
				<?php if( get_field('email_address', 'option') ): ?>
					<a class="email cell small-12 medium-6 wow slideInRight" href="mailto:<?php the_field('email_address', 'option'); ?>"><i class="icon icon-envelope"></i><?php the_field('email_address', 'option'); ?></a>
				<?php endif; ?>	
		</div>
	</div>
			
	<div class="footer-form grid-container wow fadeInUp">
		<i class="icon icon-quote"></i>
		<?php gravity_form( 1, true, false, false, '', true );?>
	</div>
		
	<!-- Footer -->
	<footer class="site-footer wow fadeInUp">
		<?php
			$footerBgID = get_field('footer_background_image', 'option');
			$footerBgSize = "full";
			$footerBgArr = wp_get_attachment_image_src( $footerBgID, $footerBg );
		?>		
		<?php 
		if( !empty($footerBgID) ): ?>			
			<div class="footer-bg" style="background-image: url(<?php echo $footerBgArr[0]; ?> );"></div>
		<?php endif;?>

		<div class="grid-container full">
		
			<div class="grid-x">

				<div class="cell small-12 medium-3">

					<div class="logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/trex-spiral-stairs-logo.svg" alt="<?php bloginfo('name'); ?>"></a>
					</div>

				</div>

				<div class="cell small-12 medium-9">

					<nav class="main-navigation navigation right cell small-12 medium-12 end" role="navigation">
							<?php theme_nav_footer(); ?>
					</nav>			

				</div>


			</div>
			
			<div class="grid-x social hide-for-medium">

				<div class="cell">

					<div id="contact-bar" class="grid-x">
						
						
						<?php if( have_rows('social_links', 'option') ):?>
							<div id="social_links-wrap" class="small-12">
								<?php while ( have_rows('social_links', 'option') ) : the_row();?>
									<?php if( have_rows('single_social_link', 'option') ):?>
										<?php while ( have_rows('single_social_link', 'option') ) : the_row();?>

												<a class="contact-bar-social-link" href="<?php the_sub_field('social_link_url', 'option'); ?>" target="_blank"><?php the_sub_field('social_link_icon', 'option'); ?></a>
										
									<?php endwhile;?>
								<?php endif;?>						
								<?php endwhile;?>
							</div>
						<?php endif;?>
					
						<div id="contact-bar-right" class="small-12">
							<?php if( get_field('phone_number', 'option') ): ?>
								<a class="phone_number" href="tel:<?php the_field('phone_number', 'option'); ?>"><i class="icon icon-phone"></i><?php the_field('phone_number', 'option'); ?></a>
							<?php endif; ?>		
							
							<?php if( get_field('email_address', 'option') ): ?>
								<a class="email" href="mailto:<?php the_field('email_address', 'option'); ?>"><i class="icon icon-envelope"></i><?php the_field('email_address', 'option'); ?></a>
							<?php endif; ?>	
							
							<?php 
							$link = get_field('privacy_link', 'option');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
							<?php endif; ?>
							
							<?php if( get_field('copyright', 'option') ): ?>
								<p>&copy;<?php echo date('Y'); ?> <?php the_field('copyright', 'option'); ?></p>
							<?php endif; ?>	
							
						</div>	
						
					</div>

				</div>

			</div>


			<div class="grid-x social show-for-medium">

				<div class="cell grid-container">

					<div id="contact-bar" class="grid-x">
					
						<div id="contact-bar-right" class="small-12 medium-10">
							<?php if( get_field('phone_number', 'option') ): ?>
								<a class="phone_number" href="tel:<?php the_field('phone_number', 'option'); ?>"><i class="icon icon-phone"></i><?php the_field('phone_number', 'option'); ?></a>
							<?php endif; ?>		
							
							<?php if( get_field('email_address', 'option') ): ?>
								<a class="email" href="mailto:<?php the_field('email_address', 'option'); ?>"><i class="icon icon-envelope"></i><?php the_field('email_address', 'option'); ?></a>
							<?php endif; ?>	
							
							<?php 
							$link = get_field('privacy_link', 'option');
							if( $link ): 
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
							<?php endif; ?>
							
							<?php if( get_field('copyright', 'option') ): ?>
								<p>&copy;<?php echo date('Y'); ?> <?php the_field('copyright', 'option'); ?></p>
							<?php endif; ?>					
														
						</div>	
						
						<?php if( have_rows('social_links', 'option') ):?>
							<div id="social_links-wrap" class="small-12 medium-2">
								<?php while ( have_rows('social_links', 'option') ) : the_row();?>
									<?php if( have_rows('single_social_link', 'option') ):?>
										<?php while ( have_rows('single_social_link', 'option') ) : the_row();?>

												<a class="contact-bar-social-link" href="<?php the_sub_field('social_link_url', 'option'); ?>" target="_blank"><?php the_sub_field('social_link_icon', 'option'); ?></a>
										
									<?php endwhile;?>
								<?php endif;?>						
								<?php endwhile;?>
							</div>
						<?php endif;?>
						
					</div>

				</div>

			</div>


		</div>
		
		
	</footer>
	<!-- /Footer -->

</div>
<!-- /Canvas Wrapper -->

<div id="builder-options" class="takeover takeover-scale show-for-large">
	<a class="toggle-takeover" aria-label="Close modal"><i class="icon icon-close"></i></a>
	<section class="takeover-content">
		<h2 class="home-models-title light-gray-title wow fadeInDown">Select Your Model</h2>

		<div class="grid-container grid-x grid-margin-x mobile-fw">
		<?php if( have_rows('natural', '34') ):?>
			<div class="single-product cell small-12 medium-6 container mobile-fw wow fadeInUp">
				<div class="grid-x">
					<?php while ( have_rows('natural', '34') ) : the_row();?>	
						<div class="copy-wrap small-12 mobile-8">
							<h2 class="title"><?php the_sub_field('title', '34');?></h2>
							<div class="description"><?php the_sub_field('description', '34');?></div>
							<div class="button-build-wrap">
								<div><a class="button" href="<?php the_sub_field('builder_url', '34');?>">Get Started</a></div>
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
							<div class="description"><?php the_sub_field('description', '34');?></div>
							<div class="button-build-wrap">
								<div><a class="button" href="<?php the_sub_field('builder_url', '34');?>">Get Started</a></div>
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
	</section>
</div>

<?php wp_footer(); ?>

<?php // DEBUG ?>
<?php /*if (get_current_user_id() == 1):?><?php endif;*/ ?>
<?php /*global $current_user; get_currentuserinfo(); if (is_user_logged_in() && in_array( 'administrator', (array) $current_user->roles )): ?>	<?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.<?php endif;*/ ?>

</body>
</html>
