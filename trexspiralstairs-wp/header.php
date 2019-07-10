<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
	
	<!-- dns prefetch -->
	<link href="//www.google-analytics.com" rel="dns-prefetch">
	
	<!-- Meta -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	
	<!-- icons -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/touch.png">

	<?php if (function_exists('the_field')) the_field('gtm_container_code', 'options'); ?>
	<script><?php if (function_exists('the_field')) the_field('dataLayer_snippet'); ?></script>
		
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
	<?php if (function_exists('the_field')) the_field('gtm_container_frame', 'options'); ?>

	<!-- Canvas Wrapper -->
	<div class="canvas-wrapper">
		<div class="barba-progress"></div>
		

		<!-- Sitcky Header -->
		<header id="sticky-masthead" class="site-header" role="banner">
			<!-- Wrapper -->
			<div class="site-header-nav-wrap wrapper grid-container">

				<div class="grid-x">

					<div class="cell small-10 medium-3">
						<div class="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/trex-spiral-stairs-logo-dark.svg" alt="<?php bloginfo('name'); ?>"></a>
						</div>
					</div>

						<nav class="main-navigation navigation right cell medium-9 end show-for-medium" role="navigation">
								<?php theme_nav_header(); ?>
						</nav>
						
						<nav class="main-navigation navigation right small-2 hide-for-medium" role="navigation">
							<ul class="menu">
								<li><a class="pointer toggle-takeover" data-takeover="nav_takeover"><i class="icon icon-bars"></i></a></li>
							</ul>
						</nav>

				</div>
				

			</div>
			<!-- /Wrapper -->

			
			<a id="main-nav-builder-link" class="button show-for-medium toggle-takeover" data-takeover="builder-options">Build your own</a>
			
		</header>

		<!-- Header -->
		<header id="masthead" class="site-header" role="banner">
			<div id="contact-bar">		
				<div class="grid-container full">
	
					<div class="grid-x show-for-medium">
							
						<?php if( have_rows('social_links', 'option') ):?>
							<div id="social_links-wrap" class="small-12 medium-6">
<!-- 								<div class="contact-bar-social-link"></div> -->
								<?php while ( have_rows('social_links', 'option') ) : the_row();?>
									<?php if( have_rows('single_social_link', 'option') ):?>
										<?php while ( have_rows('single_social_link', 'option') ) : the_row();?>
										
											<a class="contact-bar-social-link" href="<?php the_sub_field('social_link_url', 'option'); ?>" target="_blank"><?php the_sub_field('social_link_icon', 'option'); ?></a>			
										
									<?php endwhile;?>
								<?php endif;?>						
								<?php endwhile;?>
							</div>
						<?php endif;?>
					
						<div id="contact-bar-right" class="small-12 medium-6">
							<?php if( get_field('phone_number', 'option') ): ?>
								<a class="phone_number" href="tel:<?php the_field('phone_number', 'option'); ?>"><i class="icon icon-phone"></i><?php the_field('phone_number', 'option'); ?></a>
							<?php endif; ?>		
							
							<?php if( get_field('email_address', 'option') ): ?>
								<a class="email" href="mailto:<?php the_field('email_address', 'option'); ?>"><i class="icon icon-envelope"></i><?php the_field('email_address', 'option'); ?></a>
							<?php endif; ?>	
						</div>	
						
					</div>
				</div>
			</div>
				
			<!-- Wrapper -->
			<div class="site-header-nav-wrap wrapper grid-container">

				<div class="grid-x">

					<div class="cell small-10 medium-3">
						<div class="logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/trex-spiral-stairs-logo.svg" alt="<?php bloginfo('name'); ?>"></a>
						</div>
					</div>

						<nav class="main-navigation navigation right cell medium-9 end show-for-medium" role="navigation">
								<?php theme_nav_header(); ?>
						</nav>
						
						<nav class="main-navigation navigation right small-2 hide-for-medium" role="navigation">
							<ul class="menu">
								<li><a class="pointer toggle-takeover" data-takeover="nav_takeover"><i class="icon icon-bars"></i></a></li>
							</ul>
						</nav>

				</div>
				

			</div>
			<!-- /Wrapper -->

			<div id="nav_takeover" class="takeover takeover-slidedown hide-for-medium">

				<div class="grid-container">

					<div class="grid-x">
						
						<div class="cell small-10 logo">
							<a class="left" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/trex-spiral-stairs-logo.svg" alt="<?php bloginfo('name'); ?>"></a>
						</div>

						<div class="cell small-2">
							<nav class="navigation right" role="navigation">
								<ul class="menu">
									<li><a class="toggle-takeover"><span class="show-for-sr">Close</span> <i class="icon-close"></i></a></li>
								</ul>
							</nav>
						</div>

					</div>

				</div>

				<section class="takeover-content">


					<div class="main-navigation takeover-nav small-12 cell">

						<?php theme_nav_header(); ?>

					</div>


				</section>
				
			</div>

			<a id="main-nav-builder-link" class="button show-for-medium toggle-takeover" data-takeover="builder-options">Build your own</a>

		</header>



		<!-- /Header -->
		<?php if(is_404()):?>
  			<div id="banner-wrap">
	  			<div class="banner" style="background-image: url('/wp-content/uploads/model-banner-bg.jpg')"></div>
  				<div id="banner-text-overlay">
			 		<h1 id="banner_title">Page Not Found</h1>
			 		<p id="banner_sub_title">This Page Does Not Exist</p>
  				</div>
	  		</div>
	  		
	  	<?php else:?>
		
		<?php
			$imgID = get_field('background_image');
			$imgSize = "full";
			$imgArr = wp_get_attachment_image_src( $imgID, $imgSize );
		?>
			
		<div id="banner-wrap">
			<div class="banner" style="background-image: url(<?php echo $imgArr[0]; ?> );"></div>
				<div id="banner-text-overlay">
				 	<div id="banner_title" class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.75s"><?php the_field('banner_title');?></div>
				 	<?php if( get_field('subtitle_or_links') == 'subtitle' ): ?>
				 		<div id="banner_sub_title" class="wow fadeInUp" data-wow-delay="1s"><?php the_field('banner_sub-title');?></div>
				 	<?php endif; ?>		
				 	
				 	<?php if( get_field('subtitle_or_links') == 'links' ): ?>
					 	<?php if( have_rows('link_buttons') ):?>
					 		<?php while ( have_rows('link_buttons') ) : the_row();?>	
					 			<?php 
								$link = get_sub_field('single_link_button');
								if( $link ): 
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<a class="button banner-link wow fadeInUp" href="<?php echo esc_url($link_url); ?>"><?php echo esc_html($link_title); ?></a>
								<?php endif; ?>
					 		<?php endwhile;?>
					 	<?php endif;?>				
				 	<?php endif; ?>	
				 	
				 	<?php if( get_field('subtitle_or_links') == 'file' ): ?>
					 	<?php if( have_rows('file_buttons') ):?>
					 		<?php while ( have_rows('file_buttons') ) : the_row();?>	
								<?php 
								$file = get_sub_field('single_file_button');
								if( $file ): ?>
									<a class="button wow fadeInUp" data-wow-delay="1s" href="<?php echo $file['url']; ?>" target="_blank"><?php echo $file['title']; ?></a>
								<?php endif; ?>
					 		<?php endwhile;?>
					 	<?php endif;?>				
				 	<?php endif; ?>	
		  		</div>
		</div>
		
		 <?php endif;?>
				

				
		<!-- barba -->
		<div id="barba-wrapper"><div class="barba-container " id="<?php if (dg_has_barba()): ?>has-barba<?php else: ?>no-barba<?php endif; ?>">
			<div id="body" data-classes="<?php echo join( ' ', get_body_class() ); ?>" data-edit-label="<?php echo esc_attr(dg_admin_edit_title()); ?>" data-edit-href="<?php echo esc_attr(dg_admin_edit_href()); ?>"></div><!-- wp body classes -->			

			<div class="wrapper" id="content">

