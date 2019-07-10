<?php /* Template Name: Installation */ ?>

<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">


<!-- 		<div class="b-lazy bg-image" data-src="<?php echo $fields['aspot_bg']['url']; ?>"></div> -->
		

		
	<?php if( have_rows('installation_steps') ):?>
		<section class="grid-container">
			<h2 class="installation-title light-gray-title wow fadeInDown">Visual Guide</h2>
				<div id="steps-wrap" class="grid-container grid-x">
					<?php while ( have_rows('installation_steps') ) : the_row();?>	
					
						<?php $numberOfSteps = count(get_field('installation_steps'));
						$stepNumber = get_row_index();
						$delay = 0.1;
						$time = $stepNumber * $delay;?>
		
						
						<div class="single_step wow fadeInUp" data-wow-delay="<?php echo $time;?>s" id="step-<?php echo $stepNumber ;?>" data-open="stepModal-<?php echo $stepNumber;?>">
							<?php if( have_rows('single_step') ):?>
								<?php while ( have_rows('single_step') ) : the_row();?>	
									<div class="img-wrap">
										<?php 
										$image = get_sub_field('image');
										$size = 'full'; // (thumbnail, medium, large, full or custom size)
										if( $image ) {
											echo wp_get_attachment_image( $image, $size );
										}
										?>						
									</div>
									<div class="step-mask step-reveal"></div>
									<div class="step-text step-reveal">
										<span><?php echo $stepNumber;?>. </span><i class="icon icon-open-external"></i>
										<p><?php the_sub_field('copy');?></p>
									</div>
										
									<div class="reveal medium" id="stepModal-<?php echo $stepNumber;?>" data-animation-in="fadeIn fast" data-reveal data-overlay="true">
		
										<div class="img-wrap">
											<?php if($stepNumber != 1):?>
												<button class="button modal-nav step-before" data-open="stepModal-<?php echo $stepNumber - 1;?>" aria-label="Previous Step" type="button"><i class="icon icon-chevron-left"></i></button>
											<?php endif;?>
												
											<div class="close-button-wrap">
											<button class="close-button" data-close aria-label="Close modal" type="button"><i class="icon icon-close"></i></button>
											</div>
											
											<?php 
											$image = get_sub_field('image');
											$size = 'full'; // (thumbnail, medium, large, full or custom size)
											if( $image ) {
												echo wp_get_attachment_image( $image, $size );
											}
											?>		
											<p><?php the_sub_field('copy');?></p>
											
											<?php if($stepNumber != $numberOfSteps):?>
												<button class="button modal-nav step-after" data-open="stepModal-<?php echo $stepNumber + 1;?>" aria-label="Next Step" type="button"><i class="icon icon-chevron-right"></i></button>	
											<?php endif;?>	
													
										</div>
														


		
									</div>		
								<?php endwhile;?>
							<?php endif;?>
						</div>				
					<?php endwhile;?>
				</div>
		</section>
	<?php endif;?>				
		
		
	<?php if (get_field('notes')):?>
		<section class="grid-container">
		
			<div id="notes" class="grid-container wow fadeInUp">
				<h2 class="notes-title-title light-gray-title">Notes</h2>
				<?php the_field('notes');?>
	
				<?php 
				$file = get_field('warranty_link');
				if( $file ): ?>
				<div class="text-center">
					<a class="button" href="<?php echo $file['url']; ?>" target="_blank"><?php echo $file['title']; ?></a>
				<?php endif; ?>
				</div>
			</div>
		</section>
	<?php endif;?>


</main>

<?php get_footer(); ?>





