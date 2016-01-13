<div class="row collapse ">
	<form action="<?php echo site_url() ?>" method="get" id="search-global-form">   
            <div class="small-10 columns"><input type="text" placeholder="<?php _e('Enter search terms', 'Alcatron');?>" name="s" id="search" value="<?php the_search_query(); ?>" /></div>
		<div class="small-2 columns"><button type="submit" value="" name="search" class="button" id="searchsubmit"><i class="icon-search icon-2x"></i></button> </div>
	</form>
</div>