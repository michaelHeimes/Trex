<!-- search -->
<form class="search <?php echo (get_search_query() ? 'active' : 'inactive'); ?>" method="get" action="<?php echo home_url(); ?>" role="search">
	<div class="input-group">
		<input class="search-input" type="search" name="s" placeholder="<?php _e( 'Search', 'html5blank' ); ?>" value="<?php echo get_search_query(); ?>">
		<div class="input-group-button">
			<button class="search-submit" type="submit" role="button"><i class="icon-search"></i></button>
		</div>
	</div>
</form>
<!-- /search -->
