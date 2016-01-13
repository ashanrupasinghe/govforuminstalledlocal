<?php
/**
 * The Template for displaying all single posts.
 */

get_header(); 
	
?>

<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <h2><?php the_title(); ?></h2>
            </div>        
            <div class="large-6 columns">
                <?php $title_ws_1 = get_field ( 'workshop-1', 'option' );?>
                    <?php if(class_exists('the_breadcrumb')){ //$albc = new the_breadcrumb;
                                        $post_type= get_post_type();
                    $achiveurl= get_post_type_archive_link($post_type);
                    echo '<ul class="breadcrumbs right"><li class="home"><a href="'.home_url().'">'.__('Home', 'Alcatron').'</a></li><li><a href="'.$achiveurl.'">'.$title_ws_1.'</a></li><li>&nbsp;&nbsp;'.get_the_title().'</li></ul>';
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
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <article class="post single-post" id="post-<?php the_ID();?>">
                <div class="post_img">
                    <?php
                    $thumbnail = get_the_post_thumbnail($post->ID, 'blog-list1');
                    if(!empty($thumbnail)):?>
                    <a href="<?php the_permalink()?>"><?php the_post_thumbnail('blog-list1'); ?></a>
                    <?php else: ?>
                    <a href="<?php the_permalink()?>">
                        <img src = "<?php echo get_template_directory_uri()?>/images/picture.jpg" alt="<?php _e('No image', 'Alcatron')?>" />
                    </a>
                    <?php endif ?>
                    <ul class="meta">
                        <!-- Show comments if set from admin panel -->
                        <?php if( 'open' == $post->comment_status && $alc_options['alc_blog_show_comments']) : ?>        
                        <li>
                            <span class="icon-comment"></span>
                            <?php comments_popup_link( __( '0 Comments', 'Alcatron' ), __( '1 Comment', 'Alcatron' ), __( '% Comments', 'Alcatron' )); ?>
                        </li>
                        <?php endif?>
                        <?php if($alc_options['alc_blog_show_date']): ?>
                        <li>
                            <span class="icon-calendar"></span>
                            <time datetime="<?php echo get_the_time('Y-m-d'); ?>"><?php echo get_the_time('M d, Y'); ?></time>
                        </li>
                        <?php endif?>
                         <!-- Show post author if set from admin panel -->
			<?php if($alc_options['alc_blog_show_author']): ?>
			<li>
                            <span class="icon-user"></span>
                            <?php echo get_the_author_link(); ?>
			</li>
			<?php endif?>
						
			<!-- Show categories if set from admin panel -->
			<?php if($alc_options['alc_blog_show_cats']): ?>
			<?php if ( count( get_the_category() ) ) : ?>
			<?php $category = get_the_category();  if($category[0]):?>
			<li>
				<span class="icon-tags"></span>
				<a href="<?php echo get_category_link($category[0]->term_id )?>"><?php echo $category[0]->cat_name?></a>
			</li>
			<?php endif?>
			<?php endif; ?>
			<?php endif?>
                    </ul>
                </div>
                <h3><?php the_title(); ?></h3>
                <div class="post_text"><?php the_content(); ?>         
                
                </div>
            </article>
		
			<div class="separator"></div>
			
            <?php endwhile; ?>
            
            
        </div>
        
    </div>
    <div class="row">
    <div class="large-12 columns">
    <?php $title=get_field('workshop-1','option');
    	  $limit=wp_count_posts('workshop-1');
    	  $published_posts = wp_count_posts('workshop-1')->publish; 
    	  $icon_ws_1 = get_field ( 'icon-workshop-1', 'option' );
    	echo do_shortcode('[row][one_whole][workshop1 title="'.$title.'" limit="'.$published_posts.'" featured="0" icon="'.$icon_ws_1.'"/][/one_whole][/row]');?>
    </div></div>
</div>
<?php get_footer(); ?>