<aside class="large-4 right">
                        <?php if  (function_exists('dynamic_sidebar') && dynamic_sidebar('main_sidebar')){ }else { ?>
		<p class="noside"><?php _e('There Is No Sidebar Widgets Yet', 'Alcatron'); ?></p>
	 <?php } ?>
</aside>
