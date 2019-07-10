<!-- Sidebar -->
<aside id="sidebar" class="cell medium-3 small-12">

	<?php get_template_part('searchform'); ?>
    		
	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
	</div>
	
	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
	</div>
		
</aside>
<!-- /Sidebar -->
