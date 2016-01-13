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
        <div class="large-12 columns">
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
            <?php _e( 'Blog Archives', 'Alcatron' ); ?>
            <?php endif; ?>
	</h1>
        </div>
        <div class="large-12 columns">
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