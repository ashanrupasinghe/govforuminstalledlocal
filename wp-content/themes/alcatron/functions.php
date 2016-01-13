<?php
/********************* DEFINE MAIN PATHS ********************/

define('Alcatron_PLUGINS',  get_template_directory() . '/plugins' ); // Shortcut to the /plugins/ directory

$adminPath 	=  get_template_directory() . '/library/admin/';
$funcPath 	=  get_template_directory() . '/library/functions/';
$incPath 	=  get_template_directory() . '/library/includes/';

global $alc_options;
$alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');
/************************************************************/

/*********** LOAD ALL REQUIRED SCRIPTS AND STYLES ***********/
function loadScripts()
{
	$alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');
	if( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin())
	{           
		wp_enqueue_style('foundation-styles',  get_template_directory_uri().'/css/foundation.min.css');
		wp_enqueue_style('fgx-styles', get_stylesheet_directory_uri().'/css/fgx-foundation.css');
		wp_enqueue_style('main-styles', get_stylesheet_directory_uri().'/style.css');
		if(isset($alc_options['alc_color_theme']) && $alc_options['alc_color_theme'] =='dark'):
			wp_enqueue_style('dark-theme',  get_template_directory_uri().'/dark.css');
		endif;	
		wp_enqueue_style('dynamic-styles',  get_template_directory_uri().'/css/dynamic-styles.php');
		wp_enqueue_style('revsilder',  get_template_directory_uri().'/css/revslider.css');
		wp_enqueue_style('normalize',  get_template_directory_uri().'/plugins/prettyphoto/prettyPhoto.css');
		
        // Font awesome styles       
		wp_enqueue_style('font-awesome',  get_template_directory_uri().'/plugins/fontawesome/css/font-awesome.min.css');
        wp_enqueue_style('font-awesome',  get_template_directory_uri().'/css/themes/default/default.css');
		
        wp_enqueue_style('smallipop',  get_template_directory_uri().'/plugins/smallipop/css/jquery.smallipop.css');
		wp_enqueue_style('jplayer-styles',  get_template_directory_uri().'/js/jplayer/skin/pink.flag/jplayer.pink.flag.css',false,'3.0.1','all');
        
		// Register or enqueue scripts
		wp_enqueue_script('jquery');
        wp_enqueue_script('modernizr', get_template_directory_uri() .'/js/vendor/custom.modernizr.js', array('jquery'), '3.2', true);
		wp_enqueue_script('foundation-min',  get_template_directory_uri(). '/js/foundation.min.js');
		wp_enqueue_script('quicksand', get_template_directory_uri() .'/js/jquery.quicksand.js', array('jquery'), '3.2', true);
		wp_enqueue_script('jplayer-audio',  get_template_directory_uri().'/js/jplayer/jquery.jplayer.min.js', array('jquery'), '3.2', true);
                
        wp_enqueue_script('prettyphoto', get_template_directory_uri().'/plugins/prettyphoto/jquery.prettyPhoto.js', array('jquery'), '3.2', true);
		
		wp_enqueue_script('prettify', get_template_directory_uri().'/plugins/smallipop/lib/contrib/prettify.js', array('jquery'), '3.2', true);
		wp_enqueue_script('smallipop', get_template_directory_uri().'/plugins/smallipop/lib/jquery.smallipop.js', array('jquery'), '3.2', true);
		wp_enqueue_script('smallipop-calls', get_template_directory_uri().'/plugins/smallipop/lib/smallipop.calls.js', array('jquery'), '3.2', true);;
	  	wp_enqueue_script('carouFredSel',  get_template_directory_uri(). '/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js', array('jquery'), '3.0.1' );
		wp_enqueue_script('touchSwipe',  get_template_directory_uri().'/plugins/carouFredSel/helper-plugins/jquery.touchSwipe.min.js', array('jquery'), '3.2', true);
        wp_enqueue_script('bxslidermin', get_template_directory_uri() .'/js/jquery.bxslider.min.js', array('jquery'), '3.2', true);
	    wp_enqueue_script('flickr', get_template_directory_uri().'/plugins/flickr/jflickrfeed.min.js', array('jquery'), '3.2', true);
        wp_enqueue_script('Validate',  get_template_directory_uri().'/js/jquery.validate.min.js',array('jquery'), array('jquery'), '3.2', true);
        wp_enqueue_script('app-head-js', get_template_directory_uri() .'/js/app-head-calls.js', array('jquery'), '3.2', true);
		
		wp_enqueue_script('app-footer-js', get_template_directory_uri() .'/js/app-bottom-calls.js', array('jquery'), '3.2', true);        

		if (is_page_template('contact-template.php')){
			$alc_options = get_option('alc_general_settings'); 
			if (!empty($alc_options['alc_contact_address']))
			{
				wp_enqueue_script('Google-map-api',  'http://maps.google.com/maps/api/js?sensor=false');
				wp_enqueue_script('Google-map',  get_template_directory_uri().'/js/gmap3.min.js');
			}			
		}		
		if (is_page_template('under-construction.php'))
		{
			wp_enqueue_script('Under-construction',  get_template_directory_uri().'/js/jquery.countdown.js');
		}
	}
}
add_action( 'wp_enqueue_scripts', 'loadScripts' ); //Load All Scripts

function alcatron_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'alcatron-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,700" );}
add_action( 'wp_enqueue_scripts', 'alcatron_fonts' );

/************************************************************/

/********************* DEFINE MAIN PATHS ********************/

require_once ($incPath . 'the_breadcrumb.php');
require_once ($incPath . 'OAuth.php');
require_once ($incPath . 'twitteroauth.php');
require_once ($incPath . 'portfolio_walker.php');
require_once ($funcPath . 'sidebar-generator.php');
require_once ($funcPath . 'options.php');
require_once ($funcPath . 'post-types.php');
require_once ($funcPath . 'widgets.php');
require_once ($funcPath . '/shortcodes/shortcode.php');


require_once ($adminPath . 'custom-fields.php');
require_once ($adminPath . 'scripts.php');
require_once ($adminPath . 'admin-panel/admin-panel.php');
// Redirect To Theme Options Page on Activation
if (is_admin() && isset($_GET['activated'])){
	wp_redirect(admin_url('admin.php?page=adminpanel'));
}

/************************************************************/
/************** ADD SUPPORT FOR LOCALIZATION ***************/

load_theme_textdomain( 'Alcatron',  get_template_directory() . '/languages' );

	$locale = get_locale();

	$locale_file =  get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

/************************************************************/



/**************** ADD SUPPORT FOR POST THUMBS ***************/

add_theme_support( 'post-thumbnails');

// Define various thumbnail sizes
//add_image_size('portfolio-thumb-3cols', 200, 176, true); 

add_image_size('portfolio-4-col', 269, 176, true);
add_image_size('portfolio-3-col', 365, 238, true); 
add_image_size('blog-list1', 740, 350, true); 
add_image_size('blog-list3', 357, 169, true);
add_image_size('blog-thumb', 100, 50, true);
add_image_size('blog-thumb2', 50, 50, true);
add_image_size('blog-thumb3', 148, 96, true);

/************************************************************/

$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
    global $option_posts_per_page;
    if ( is_tax( 'portfolio_category') ) {
		$pageId = get_page_ID_by_page_template('portfolio-template3.php');
		if ($pageId)
		{
			$custom =  get_post_custom($pageId);
			$items_per_page = isset ($custom['_page_portfolio_num_items_page']) ? $custom['_page_portfolio_num_items_page'][0] : '777';
			return $items_per_page;
		}
		else
		{
			return 4;
		}
    } else {
        return $option_posts_per_page;
    }
}

/************* ADD SUPPORT FOR WORDPRESS 3 MENUS ************/

add_theme_support( 'menus' );

//Register Navigations
add_action( 'init', 'my_custom_menus' );
function my_custom_menus() {
    register_nav_menus(
        array(
            'primary_nav' => __( 'Primary Navigation', 'Alcatron'),
            'top_nav' => __( 'Top Navigation', 'Alcatron'),
			'footer_nav' => __( 'Footer Navigation', 'Alcatron')
        )
    );
}

// Custom menu walker for main navigation

class My_Walker extends Walker_Nav_Menu {
 
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $element->has_children = !empty($children_elements[$element->ID]);
        @$element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';
        @$element->classes[] = ($element->has_children) ? 'has-dropdown' : '';
		
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }	
 
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"dropdown\">\n";
    }
    
}


/************************************************************/
/************* COMMENTS HOOK *************/

function Alcatron_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	
    <li class="com_item" id="li-comment-<?php comment_ID() ?>">
        <div class="com_main" id="comment-<?php comment_ID(); ?>">
            <div >
                <?php echo get_avatar($comment); ?>                 
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
            <p><em><?php _e('Your comment is awaiting moderation.', 'Alcatron') ?></em></p>
            <?php endif; ?>
            <div class="com_content">
                <div class="com_meta">
                    <span class="user_name">
                        <a href="<?php echo get_comment_author_link()?>" rel="external nofollow"><?php echo get_comment_author()?></a>		
                    </span>
                    <span class="com_date"><?php printf(__('%1$s at %2$s', 'Alcatron'), get_comment_date(),get_comment_time()) ?></span>
                    <?php edit_comment_link(__('(Edit)', 'Alcatron'),'  ','') ?>
                </div>
                <p class="com_text"><?php comment_text() ?></p>
                <div class="com_reply ">
                    <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'style'=>'<ul class="com_child"', 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>
        </div>	
<?php }

/*****************************************/

/******************SIDEBAR******************/
if ( function_exists('register_sidebar') )
{
    register_sidebar(array(
		'name' => 'Blog Sidebar',
		'id'	=> 'global-sidebar-1',
                'before_widget' => '<div id="%1$s" class="widgets sidebar-widget portfolio_sidebar %2$s">',
                'after_widget' => '</div></div>',
                'before_title' => '<h3>',
                'after_title' => '</h3><div class="wid_content">',
    ));
	
	register_sidebar(array(
		'name' => 'Portfolio Sidebar',
		'id'	=> 'global-portfolio-sidebar-1',
                'before_widget' => '<div id="%1$s" class=" widgets sidebar-widget portfolio_sidebar %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3>',
                'after_title' => '</h3>',
    ));
   $al_options = get_option('alc_general_settings'); 
	$footer_widget_count = isset($al_options['alc_footer_widgets_count']) ? $al_options['alc_footer_widgets_count']:4;

	for($i = 1; $i<= $footer_widget_count; $i++)
	{
		unregister_sidebar('Footer Widget '.$i);
		if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name' => 'Footer Widget '.$i,
			'id'	=> 'footer-sidebar-'.$i,
			'before_widget' => '<div class="large-3 columns footer-block">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="footer-title footer-title-ashan">',
			'after_title' => '</h4><div class="footer_part_content">',
		));
	}
}

add_filter('widget_text', 'do_shortcode');
add_filter('the_excerpt', 'do_shortcode');
/********************************************************************************************/

/********* STRING MANIPULATIONS ************/

function alc_trim($text, $length, $end = '[...]') {
	$text = preg_replace('`\[[^\]]*\]`', '', $text);
	$text = strip_tags($text);
	$text = substr($text, 0, $length);
	$text = substr($text, 0, last_pos($text, " "));
	$text = $text . $end;
	return $text;
}

function last_pos($string, $needle){
   $len=strlen($string);
   for ($i=$len-1; $i>-1;$i--){
       if (substr($string, $i, 1)==$needle) return ($i);
   }
   return FALSE;
}

function limit_words($string, $word_limit) {
 
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
 
	$words = explode(' ', $string);
 
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
 
	return implode(' ', array_slice($words, 0, $word_limit)).'...';
}

add_filter('the_content', 'shortcode_empty_paragraph_fix');

function shortcode_empty_paragraph_fix($content)
{   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);

	$content = strtr($content, $array);
	$content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );
	
	return $content;
}

function custom_tag_cloud_widget($args) {
	$args['number'] = 0; //adding a 0 will display all tags
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['format'] = 'list'; //ul with a class of wp-tag-cloud
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );

/*******************************************/

/********** GET PAGES BY PARAMS ************/

/*-- Get root parent of a page --*/
function get_root_page($page_id) 
{
	global $wpdb;
	
	$parent = $wpdb->get_var("SELECT post_parent FROM $wpdb->posts WHERE post_type='page' AND ID = '$page_id'");
	
	if ($parent == 0) 
		return $page_id;
	else 
		return get_root_page($parent);
}


/*-- Get page name by ID --*/
function get_page_name_by_ID($page_id)
{
	global $wpdb;
	$page_name = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '$page_id'");
	return $page_name;
}


/*-- Get page ID by Page Template --*/
function get_page_ID_by_page_template($template_name)
{
	global $wpdb;
	$page_ID = $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_value = '$template_name' AND meta_key = '_wp_page_template'");
	return $page_ID;
}

/*-- Get page content (Used for pages with custom post types) --*/
if(!function_exists('getPageContent'))
{
	function getPageContent($pageId)
	{
		if(!is_numeric($pageId))
		{
			return;
		}
		global $wpdb;
		$sql_query = 'SELECT DISTINCT * FROM ' . $wpdb->posts .
		' WHERE ' . $wpdb->posts . '.ID=' . $pageId;
		$posts = $wpdb->get_results($sql_query);
		if(!empty($posts))
		{
			foreach($posts as $post)
			{
				return nl2br($post->post_content);
			}
		}
	}
}


/* -- Get page ID by Custom Field Value -- */
function get_page_ID_by_custom_field_value($custom_field, $value)
{
	global $wpdb;
	$page_ID = $wpdb->get_var("
	    SELECT wposts.ID
    	FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta
	    WHERE wposts.ID = wpostmeta.post_id 
    	AND wpostmeta.meta_key = '$custom_field' 
	    AND (wpostmeta.meta_value like '$value,%' OR wpostmeta.meta_value like '%,$value,%' OR wpostmeta.meta_value like '%,$value' OR wpostmeta.meta_value = '$value')		
    	AND wposts.post_status = 'publish' 
	    AND wposts.post_type = 'page'
		LIMIT 0, 1");

	return $page_ID;
}
/*******************************************/

add_theme_support( 'automatic-feed-links' );
if ( ! isset( $content_width ) ) $content_width = 960;
add_filter('the_excerpt', 'do_shortcode');

/******* POSTS RELATED BY TAXONOMY *********/

function get_taxonomy_related_posts($post_id, $taxonomy, $limit, $args=array()) {
  $query = new WP_Query();
  $terms = wp_get_object_terms($post_id, $taxonomy);
  if (count($terms)) {
    $post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
    $post = get_post($post_id);
    $args = wp_parse_args($args,array(
      'post_type' => $post->post_type, 
      'post__in' => $post_ids,
	  'exclude' => $post_id,
      'taxonomy' => $taxonomy,
      'term' => $terms[0]->slug,
	  'posts_per_page' => $limit
    ));
    $query = new WP_Query($args);
  }
  return $query;
}

/********************************************/

/*************  ENABLE SESSIONS *************/

function cp_admin_init() {
	if (!session_id())
	session_start();
}

add_action('init', 'cp_admin_init');

/********************************************/


/**************  GOOGLE FONTS ***************/

function font_name($string){
		
	$check = strpos($string, ':');
	if($check == false){
		return $string;
	} else { 
		preg_match("/([\w].*):/i", $string, $matches);
		return $matches[1];
	} 
} 



/************** LIST TAXONOMY ***************/

function list_taxonomy($taxonomy, $id='')
{
	$args = array ('hide_empty' => false);
	$tax_terms = get_terms($taxonomy, $args); 
	$active = '';
	$output = '<ul id="'.$id.'">';

	foreach ($tax_terms as $tax_term) {
		if ($taxonomy  == $tax_term)
		{
			$active  = ' class="active"';
		}
		$output.='<li><a href="'.esc_attr(get_term_link($tax_term, $taxonomy)) . '"'.$active.'>'.$tax_term->name.'</a></li>';
	}
	$output.='</ul>';
	
	return $output;
}

/********************************************/
function my_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.png);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );



?>

<?php 

/* Remove FancyBox Scripts from Shoppe */

add_action('wp_head','my_conditional_script',0);

function my_conditional_script() {
	if( class_exists('easyFancyBox') && ( is_singular('product') || is_post_type_archive('product') ) ) {
		remove_action('wp_enqueue_scripts', array('easyFancyBox','enqueue_styles'), 999);
		remove_action('wp_print_scripts', array('easyFancyBox','register_scripts'), 999);
		remove_action('wp_head', array('easyFancyBox','main_script'), 999);
		remove_action('wp_footer', array('easyFancyBox','enqueue_footer_scripts'), 999);
		remove_action('wp_footer', array('easyFancyBox', 'on_ready'), 999);
	}
}
?>

<?php 
//this function for main menu allignet to center,
function main_menu_styling(){
$login=is_user_logged_in();
if ($login){
	?>
 <style type="text/css">
 @media screen and (min-width: 1000px) {
	 .top-main-menu-as{
		right: 7%;
		} 
		}
</style>
<?php 	
}else{?>
 <style type="text/css">
 @media screen and (min-width: 1000px) {
	 .top-main-menu-as{
		right: 12%;
		} 
		}
</style>	
	
<?php 
}

}
add_action( 'wp_head', 'main_menu_styling' );
?>

