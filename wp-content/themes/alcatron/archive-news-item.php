<?php get_header();?>
<div class="row">
	<div class="large-12 columns main-content-top">
		<div class="row">
			<div class="large-6 columns">
				<h2><?php echo 'News';//the_title(); ?></h2>
			</div>
			<div class="large-6 columns">
                
                    <?php if(class_exists('the_breadcrumb')){ //$albc = new the_breadcrumb; 
                    echo '<ul class="breadcrumbs right"><li class="home"><a href="'.home_url().'">'.__('Home', 'Alcatron').'</a></li></ul>';
                    } ?>

            </div>
		</div>
	</div>
</div>
<div class="content_wrapper">
	<div class="row">
		<aside class="large-4 columns right">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php   endif;?>
        </aside>
		<div class="large-8 columns">
			<h1>
            <?php if ( is_day() ) : ?>
            <?php printf( __( 'Daily Archives: <span>%s</span>', 'Alcatron' ), get_the_date() ); ?>
            <?php elseif ( is_month() ) : ?>
            <?php printf( __( 'Monthly Archives: <span>%s</span>', 'Alcatron' ), get_the_date('F Y') ); ?>
            <?php elseif ( is_year() ) : ?>
            <?php printf( __( 'Yearly Archives: <span>%s</span>', 'Alcatron' ), get_the_date('Y') ); ?>
            <?php elseif ( is_category() ) : ?>
            <?php single_cat_title();?>
            <?php else : ?>
            <?php //_e( 'News Archives', 'Alcatron' ); ?>
            <?php endif; ?>
	</h1>
		</div>
		<div class="large-8 columns">
            <?php
                if ( have_posts() ) the_post();
		rewind_posts();       
		get_template_part( 'loop', 'archive' );
            ?>
    	</div>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>