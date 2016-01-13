<?php get_header();?>
<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <h2><?php the_title(); ?></h2>
            </div>        
            <div class="large-6 columns">
                
                    <?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>

            </div>
        </div>
    </div>
</div>
<div class="content_wrapper">
    <div class="row">
                       <div class="large-8 columns center">
					<h1 class="notfound_title"><?php _e('404', 'Alcatron')?></h1>
					<h2 class="notfound_subtitle"><?php _e('Oops...are you lost?', 'Alcatron')?></h2>            
				</div> 
        <div class="large-12 columns">
			<div class="row">
				<div class="large-6 columns centered">
					<p class="notfound_description">
						<?php _e('The page you are looking for seems to be missing.Go back, or return to yourcompany.com to choose a new direction.Please report any broken links to our team.', 'Alcatron')?>
					</p>
				</div>   
			</div>
		</div>
		<div class="large-12 columns">
			<div class="row">
				<div class="large-4 columns ">
					<a class="button expand bottom20" href="javascript: history.go(-1)"><i class="icon-undo"></i><?php _e('Return to previous page', 'Alcatron')?></a>
				</div> 
			</div>
		</div>
    </div>
</div>
<?php get_footer(); ?>
