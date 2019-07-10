<?php /* Template Name: Resources */ ?>

<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">


<!-- 		<div class="b-lazy bg-image" data-src="<?php echo $fields['aspot_bg']['url']; ?>"></div> -->

	<?php if( have_rows('resources') ):?>
		<section class="grid-container">
			<div id="support-documents"></div>
			<h2 class="resources-title light-gray-title wow fadeInDown">Support Documents</h2>
			<div class="resources-wrap grid-container grid-x">
				<?php while ( have_rows('resources') ) : the_row();?>	
				
				<?php $numberOfResources = count(get_field('installation_steps'));
					$resourceNumber = get_row_index(); 
					$delay = 0.25;
					$time = $resourceNumber * $delay;						    
				?>
				
					<?php 
					$file = get_sub_field('single_resource');
					if( $file ): ?>
						<a class="single-resource text-center cell small-12 medium-4 container wow fadeInUp" data-wow-delay="<?php echo $time;?>s" href="<?php echo $file['url']; ?>" target="_blank"><i class="icon icon-download"></i><span><?php echo $file['title']; ?></span></a>
					<?php endif; ?>
				<?php endwhile;?>
			</div>
		</section>
	<?php endif;?>	

	<?php if( have_rows('faq') ):?>
	<section class="grid-container">
		<div id="faqs"></div>
		<div id="faq-accordian-wrap" class="grid-container grid-x wow fadeInUp">
			<h2 class="faq-title light-gray-title">Frequently Asked Questions</h2>
			<ul id="faq-accordian" data-accordion>
			<?php while ( have_rows('faq') ) : the_row();?>	
				<?php if( have_rows('single_faq') ):?>
					<?php while ( have_rows('single_faq') ) : the_row();?>	
					<li class="accordion-item" data-accordion-item>
						<a href="#" class="accordion-title"><?php the_sub_field('question');?></a>
						<div class="accordion-content" data-tab-content><?php the_sub_field('answer');?></div>
					</li>
					<?php endwhile;?>
				<?php endif;?>				
			<?php endwhile;?>
			</ul>
		</div>
	</section>
	<?php endif;?>				



</main>

<?php get_footer(); ?>


