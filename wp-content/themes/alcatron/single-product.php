<?php
/**
 * The Template for displaying all single posts.
 */
get_header ();

?>

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
        <?php if( have_rows('product_shortcode') ): ?>  
        <aside class="large-7 columns right">
            <?php //if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog Sidebar") ) : ?> <?php  // endif;?>
                      
            <?php while( have_rows('product_shortcode') ): the_row(); ?>    
            <?php $short= get_sub_field('short_code');?>      
            <?php echo do_shortcode($short); ?>         
            <?php endwhile;?>            
            
        </aside> 
       <?php endif;?>
        <?php if( have_rows('product_shortcode') ): ?> 
        <div class="large-5 columns">
        <?php else:?>
        <div class="large-12 columns">
        <?php endif;?>
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <article class="post single-post"
					id="post-<?php the_ID();?>">

					<div class="post_text"><?php the_content(); ?></div>
				</article>

				<div class="separator"></div>
			<?php if($alc_options['alc_blog_show_tags']) :?> 				
				<div class="twelve columns">
				    <?php
															
$tags_list = get_the_tag_list ( '<li>', '', '</li>' );
															if ($tags_list) :
																?>
						<div class="widget_tag_cloud" style="margin-left: -14px">
						<ul><?php printf( __( '%s', 'Alcatron' ), $tags_list ); ?></ul>
					</div>
					<?php endif; ?>
				</div>		
			<?php endif?>
            <?php endwhile; ?>
            <div class="comments">
                <?php comments_template(); ?>
				<?php $test = false; if ($test) {comment_form(); wp_link_pages( $args );} ?>
            </div>
			</div>

		</div>
	</div>
</div>
<?php get_footer(); ?>