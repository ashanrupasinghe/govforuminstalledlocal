<?php /*** The loop that displays posts.***/ ?>

<?php 

$alc_options = get_option('alc_general_settings');
$custom =  get_post_custom($post->ID);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$blogLayout =  isset ($alc_options['alc_blog_layout']) ? $alc_options['alc_blog_layout'][0] : '0';
//$blogLayout = isset($_GET['blog_layout']) ? $_GET['blog_layout'] : '1';
?>

<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'Alcatron' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'Alcatron' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>
 <?php if($blogLayout == 2 || $blogLayout == 3 || $blogLayout == 4):?><div class="row"><?php endif?>
<?php while ( have_posts() ) : the_post(); ?>
    <?php if($blogLayout == 0):?>
        <article id="post-<?php the_ID();?>" <?php post_class('post'); ?>>
            <div class="post_img">
                <?php  
				$thumbnail = get_the_post_thumbnail($post->ID, 'blog-list1');
				$postmeta = get_post_custom($post->ID); 
				if(!empty($thumbnail)):?>
					<a href="<?php the_permalink()?>"><?php the_post_thumbnail('blog-list1'); ?></a>
				<?php elseif (isset($postmeta['_post_video'])): ?>
					<iframe src="http://player.vimeo.com/video/<?php echo $postmeta['_post_video'][0]; ?>" width="740" height="350" class="post-image"></iframe>
				<?php else: ?>
					<a href="<?php the_permalink()?>">
						<img src = "<?php echo get_template_directory_uri()?>/images/picture.png" alt="<?php _e('No image', 'Alcatron')?>" />
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
						<li class="post-author">
							<span class="icon-user"></span>
							<?php echo get_the_author_link(); ?>
						</li>
					<?php endif?>
								
					<!-- Show categories if set from admin panel -->
					<?php if($alc_options['alc_blog_show_cats']): ?>
						<?php if ( count( get_the_category() ) ) : ?>
							<?php $category = get_the_category();  if($category[0]):?>
							<li class="post-categories">
								<span class="icon-tags"></span>
								<a href="<?php echo get_category_link($category[0]->term_id )?>"><?php echo $category[0]->cat_name?></a>
							</li>
						<?php endif?>
					<?php endif; ?>
					<?php endif?>
				</ul>
			</div>
			<h3><?php the_title() ?></h3>
			<p class="post_text"><?php echo do_shortcode(get_the_excerpt()); ?></p>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %1$s', 'Alcatron' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="button">
				<?php echo isset($alc_options['alc_blogreadmore']) ? $alc_options['alc_blogreadmore'] : _e ('Read More', 'Alcatron') ?>
			</a>
        </article>
<?php elseif ($blogLayout==1): ?>
        <article id="post-<?php the_ID();?>" <?php post_class('post col1-alternative'); ?>>
            <div class="row">
                <div class="large-6 columns">
                    <div class="post_img">
                <?php  
                    $thumbnail = get_the_post_thumbnail($post->ID, 'portfolio-3-col');
                    $postmeta = get_post_custom($pots->ID); 
                    if(!empty($thumbnail)):?>
                    <a href="<?php the_permalink()?>"><?php the_post_thumbnail('portfolio-3-col'); ?></a>
                    <?php elseif (isset($postmeta['_post_video'])): ?>
                    <iframe src="http://player.vimeo.com/video/<?php echo $postmeta['_post_video'][0]; ?>" width="357" height="170" class="post-image"></iframe>
                    <?php else: ?>
                    <a href="<?php the_permalink()?>">
                        <img src = "<?php echo get_template_directory_uri()?>/images/picture.png" alt="<?php _e('No image', 'Alcatron')?>" />
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
			<li class="post-author">
                            <span class="icon-user"></span>
                            <?php echo get_the_author_link(); ?>
			</li>
			<?php endif?>
						
			<!-- Show categories if set from admin panel -->
			<?php if($alc_options['alc_blog_show_cats']): ?>
			<?php if ( count( get_the_category() ) ) : ?>
			<?php $category = get_the_category();  if($category[0]):?>
			<li class="post-categories">
                            <span class="icon-tags"></span>
                            <a href="<?php echo get_category_link($category[0]->term_id )?>"><?php echo $category[0]->cat_name?></a>
			</li>
			<?php endif?>
			<?php endif; ?>
			<?php endif?>
                    </ul>
                    </div>
                </div>
                <div class="large-6 columns">
                    <h2><?php the_title() ?></h2>
                    <p class="post_text"><?php echo do_shortcode(get_the_excerpt()); ?></p>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %1$s', 'Alcatron' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="button">
                    <?php echo isset($alc_options['alc_blogreadmore']) ? $alc_options['alc_blogreadmore'] : _e ('Read More', 'Alcatron') ?>
                    </a>
                </div>
                
            </div>
            
        </article>			
<?php elseif($blogLayout==2) :?>
        <article  <?php post_class('col-2 large-6 columns') ?> id="post-<?php the_ID();?>">
            <div class="post_img">
                 <?php  
                    $thumbnail = get_the_post_thumbnail($post->ID, 'blog-list3');
                    $postmeta = get_post_custom($post->ID); 
                    if(!empty($thumbnail)):?>
                    <a href="<?php the_permalink()?>"><?php the_post_thumbnail('blog-list3'); ?></a>
                    <?php elseif (isset($postmeta['_post_video'])): ?>
                    <iframe src="http://player.vimeo.com/video/<?php echo $postmeta['_post_video'][0]; ?>" width="357" height="285" class="post-image"></iframe>
                    <?php else: ?>
                    <a href="<?php the_permalink()?>">
                        <img src = "<?php echo get_template_directory_uri()?>/images/picture.png" alt="<?php _e('No image', 'Alcatron')?>" />
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
			<li class="post-author">
                            <span class="icon-user"></span>
                            <?php echo get_the_author_link(); ?>
			</li>
			<?php endif?>
						
			<!-- Show categories if set from admin panel -->
			<?php if($alc_options['alc_blog_show_cats']): ?>
			<?php if ( count( get_the_category() ) ) : ?>
			<?php $category = get_the_category();  if($category[0]):?>
			<li class="post-categories">
                            <span class="icon-tags"></span>
                            <a href="<?php echo get_category_link($category[0]->term_id )?>"><?php echo $category[0]->cat_name?></a>
			</li>
			<?php endif?>
			<?php endif; ?>
			<?php endif?>
                    </ul>  
            </div>
            <h2><?php the_title() ?></h2>
            <p class="post_text"><?php echo do_shortcode(get_the_excerpt()); ?></p>
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %1$s', 'Alcatron' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="button">
                <?php echo isset($alc_options['alc_blogreadmore']) ? $alc_options['alc_blogreadmore'] : _e ('Read More', 'Alcatron') ?>
            </a>
			<hr />
        </article>
 <?php elseif($blogLayout==3):?>

        <article <?php post_class('post col-2 large-4 columns') ?> id="post-<?php the_ID();?>">
            <div class="post_img">
                 <?php  
                    $thumbnail = get_the_post_thumbnail($post->ID, 'portfolio-3-col');
                    $postmeta = get_post_custom($post->ID); 
                    if(!empty($thumbnail)):?>
                    <a href="<?php the_permalink()?>"><?php the_post_thumbnail('portfolio-3-col'); ?></a>
                    <?php elseif (isset($postmeta['_post_video'])): ?>
                    <iframe src="http://player.vimeo.com/video/<?php echo $postmeta['_post_video'][0]; ?>" width="357" height="285" class="post-image"></iframe>
                    <?php else: ?>
                    <a href="<?php the_permalink()?>">
                        <img src = "<?php echo get_template_directory_uri()?>/images/picture.png" alt="<?php _e('No image', 'Alcatron')?>" />
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
			<li class="post-author">
                            <span class="icon-user"></span>
                            <?php echo get_the_author_link(); ?>
			</li>
			<?php endif?>
						
			<!-- Show categories if set from admin panel -->
			<?php if($alc_options['alc_blog_show_cats']): ?>
			<?php if ( count( get_the_category() ) ) : ?>
			<?php $category = get_the_category();  if($category[0]):?>
			<li class="post-categories">
                            <span class="icon-tags"></span>
                            <a href="<?php echo get_category_link($category[0]->term_id )?>"><?php echo $category[0]->cat_name?></a>
			</li>
			<?php endif?>
			<?php endif; ?>
			<?php endif?>
                    </ul>  
            </div>
            <h2><?php the_title() ?></h2>
            <p class="post_text"><?php echo do_shortcode(get_the_excerpt()); ?></p>
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %1$s', 'Alcatron' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="button">
                <?php echo isset($alc_options['alc_blogreadmore']) ? $alc_options['alc_blogreadmore'] : _e ('Read More', 'Alcatron') ?>
            </a>
        </article>
   
<?php elseif($blogLayout==4): ?>

        <article <?php post_class('post col-2 large-3 columns') ?> id="post-<?php the_ID();?>">
            <div class="post_img">
                 <?php  
                    $thumbnail = get_the_post_thumbnail($post->ID, 'portfolio-4-col');
                    $postmeta = get_post_custom($post->ID); 
                    if(!empty($thumbnail)):?>
                    <a href="<?php the_permalink()?>"><?php the_post_thumbnail('portfolio-4-col'); ?></a>
                    <?php elseif (isset($postmeta['_post_video'])): ?>
                    <iframe src="http://player.vimeo.com/video/<?php echo $postmeta['_post_video'][0]; ?>" width="260" height="170" class="post-image"></iframe>
                    <?php else: ?>
                    <a href="<?php the_permalink()?>">
                        <img src = "<?php echo get_template_directory_uri()?>/images/picture.png" alt="<?php _e('No image', 'Alcatron')?>" />
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
			<li class="post-author">
                            <span class="icon-user"></span>
                            <?php echo get_the_author_link(); ?>
			</li>
			<?php endif?>
						
			<!-- Show categories if set from admin panel -->
			<?php if($alc_options['alc_blog_show_cats']): ?>
			<?php if ( count( get_the_category() ) ) : ?>
			<?php $category = get_the_category();  if($category[0]):?>
			<li class="post-categories">
                            <span class="icon-tags"></span>
                            <a href="<?php echo get_category_link($category[0]->term_id )?>"><?php echo $category[0]->cat_name?></a>
			</li>
			<?php endif?>
			<?php endif; ?>
			<?php endif?>
                    </ul>  
            </div>
            <h2><?php the_title() ?></h2>
            <p class="post_text"><?php echo do_shortcode(get_the_excerpt()); ?></p>
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %1$s', 'Alcatron' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="button">
                <?php echo isset($alc_options['alc_blogreadmore']) ? $alc_options['alc_blogreadmore'] : _e ('Read More', 'Alcatron') ?>
            </a>
        </article>
   
    <?php endif; ?>
    <?php endwhile;?>
 <?php if($blogLayout == 2 || $blogLayout == 3 || $blogLayout == 4):?></div><?php endif?>
<div class="row">
    <div class="large-12 columns">
<div class="pagination-wrapper">
		<?php 
			if ( $wp_query->max_num_pages > 1 ) :
			   include(Alcatron_PLUGINS. '/wp-pagenavi.php' );
			   if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
			endif; 
		?>
</div>
</div></div>