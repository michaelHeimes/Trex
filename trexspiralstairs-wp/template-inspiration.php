<?php /* Template Name: Inspiration */ ?>

<?php get_header(); ?>

<?php $fields = get_fields($post->ID); ?>

<main role="main">

	<section id="get-inspired-filter" class="container grid-container">
	  <div class="grid-filter-container">
		  <label class="light-gray-title">Filter: </label>
			<?php
			$args = array(
				'taxonomy' => 'inspire_cats'
			);
			$terms = get_terms($args);
			$default_term_slug = 'featured'; // featured
			?>
			<select class="masonry-grid-filter">
				<option value="">View All</option>
				<?php foreach ($terms as $term): ?>
				<option value="<?php echo $term->slug; ?>" <?php echo ($term->slug == $default_term_slug ? 'selected="selected"' : ''); ?>><?php echo $term->name; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</section>

	<section id="get-inspired" class="grid-container masonry-grid">
		<div class="grid">
			<?php echo do_shortcode('[ajax_load_more id="3757590561" post_type="inspire" posts_per_page="7" orderby="menu_order" scroll="false" images_loaded="true" button_label="Load More" button_loading_label="Loading More..." transition_container="false" taxonomy="inspire_cats" taxonomy_operator="IN" taxonomy_terms=""]');?>
		</div>
	</section>

</main>

<?php get_footer(); ?>


