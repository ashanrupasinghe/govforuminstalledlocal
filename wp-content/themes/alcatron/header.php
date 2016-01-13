<!DOCTYPE html>
<!--[if IE 8]> 	<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>  

	<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
    <?php  $alc_options = get_option('alc_general_settings'); ?>
	
   	<?php if(!empty($alc_options['alc_favicon'])):?>
		<link rel="shortcut icon" href="<?php echo $alc_options['alc_favicon'] ?>" /> 
 	<?php endif?>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script><![endif]-->
	<!--[if IE 8]><link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/ie8-grid-foundation-4.css" /><![endif]-->
	
    <?php 
   		$bodyFont = isset($alc_options['alc_body_font']) ? $alc_options['alc_body_font'] : 'off';
		$headingsFont =(isset($alc_options['alc_headings_font']) && $alc_options['alc_headings_font'] !== 'off') ? $alc_options['alc_headings_font'] : 'off';
		$menuFont = (isset($alc_options['alc_menu_font']) && $alc_options['alc_menu_font'] !== 'off') ? $alc_options['alc_menu_font'] : 'off';
	
		$fonts['body, p, .content_wrapper a, #menu-top-menu a, ol, .content_wrapper li #menu-top-menu li, label, #copyright'] = $bodyFont;
		$fonts['h1, h2, h3, h4, h5, h6'] = $headingsFont;
		$fonts['#menu-main a'] = $menuFont;
		
		foreach ($fonts as $value => $key)
		{
			if($key != 'off' && $key != ''){ 
				$api_font = str_replace(" ", '+', $key);
				$font_name = font_name($key);
				
				echo '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$api_font.'" />';
				echo "<style type=\"text/css\">".$value."{ font-family: '".$key."' !important; }</style>";			
			}
		}
	?>
<script src='https://www.google.com/recaptcha/api.js'></script><!-- google captcha -->	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
 <?php if (!is_page_template('under-construction.php')):?>
	
	<div class="top-header">
		<div class="main-wrapper">
			<div class="row">
				<div class="large-8 columns">
					<?php
						wp_nav_menu(array( 
							'theme_location' => 'top_nav',
							'menu' =>'top_nav', 
							'container'=>'', 
							'depth' => 1, 
							'menu_class' => 'inline-list alc_top_menu'
						));
					?>                         
				</div>
				<div class="small-4 columns  text-right hr-info">
					<?php echo do_shortcode($alc_options['alc_top_header_info']);?>
					<?php if ($alc_options['alc_login_link']):?>
						<?php  if ( is_user_logged_in()) : ?>
							<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout" class="button login"><i class="icon-lock"></i><?php _e('Logout', 'Alcatron'); ?></a>
						<?php else : ?>
							<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="Login" class="button login"><i class="icon-lock"></i><?php _e('Login', 'Alcatron'); ?></a>
						<?php endif;?>       
					<?php endif?>
				</div> 
			</div>
		</div>
	</div>
	<!-- Begin Main Wrapper -->
	<div class="main-wrapper">
	  
	<header class="row main-navigation">
		<div class="large-12 columns">
			<a href="<?php echo home_url() ?>" id="logo">
				<?php if(!empty($alc_options['alc_logo'])):?>
					<img src="<?php echo $alc_options['alc_logo'] ?>" alt="<?php echo $alc_options['alc_logotext']?>" id="logo-image" style="width: auto;height: auto;"/>
				<?php else:?>
					<?php echo isset($alc_options['alc_logotext']) ? $alc_options['alc_logotext'] : 'Alcatron' ?>
				<?php endif?>
			</a>			
		</div>
		<!-- Main Navigation -->
       
			<div class="large-12 columns top-main-menu-as">			
				<nav class="top-bar">
					<ul class="title-area">
						<!-- Toggle Button Mobile -->
						<li class="name"></li>
						<li class="toggle-topbar menu-icon"><a href="#"><span><?php _e('Main Menu', 'Alcatron')?></span></a></li>
						<!-- End Toggle Button Mobile -->
					</ul>
					<section class="top-bar-section">
						<?php 
							$walker = new My_Walker;
							if(function_exists('wp_nav_menu')):
								wp_nav_menu( 
								array( 
									'theme_location' => 'primary_nav',
									'menu' =>'primary_nav', 
									'container'=>'', 
									'depth' => 4, 
									'menu_class' => 'right alc_main_menu',
									'walker' => $walker
									)  
								); 
							else:
								?><ul class="sf-menu top-level-menu"><?php wp_list_pages('title_li=&depth=4'); ?></ul><?php
							endif; 
						?>				 
					</section>
				</nav>
			</div>
       
	</header>
 <?php endif;?>