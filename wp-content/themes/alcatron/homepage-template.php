<?php 
/* Template Name: Homepage */
/*
 * the all do short code part added by government factory project,
 * now, home page only show this template,
 * not show content of the home page post.
 */
?>

<?php

get_header ();
$alc_options = get_option ( 'alc_general_settings' );
$custom = get_post_custom ( $post->ID );
$layout = isset ( $custom ['_page_layout'] ) ? $custom ['_page_layout'] [0] : '1';
?>
<div class="content_wrapper">
	<div class="row">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Homepage Top Sidebar") ) : ?> <?php   endif;?>	
			<?php if ($layout == '3'):?>
				<aside class="large-4 columns sidebar-left"><?php generated_dynamic_sidebar() ?></aside>
			<?php endif?>
			<div
			class="<?php echo $layout == '1' ? 'large-12' : 'large-8'?> columns">
				<?php 
// the_content();
				      // this part commented by govftactory
				      // start home page content by gov factory
				?>
				<?php
				// home page slider
				echo do_shortcode ( '[row][one_whole][rev_slider home][/one_whole][/row]' );
				//service pages
				$service_regidtration=get_permalink(3431);
				$training=get_permalink(3437);
				$inquiries=get_permalink(3523);
				$procument_note=get_permalink(3434);
				// servicess-set-one
				echo do_shortcode ( '[row][one_fourth][fblock title="Service Registration" subtitle=" ... " icon="icon-edit" link="'.$service_regidtration.'"]See More[/fblock][/one_fourth][one_fourth][fblock title="Training Services" subtitle=" ... " icon="icon-user" link="'.$training.'"]See More[/fblock][/one_fourth][one_fourth][fblock title="Inquiries" subtitle="..." icon="icon-truck" link="'.inquiries.'"]See More[/fblock][/one_fourth][one_fourth][fblock title="Procurement Notices" subtitle=" ... " icon="icon-exchange" link="'.$procument_note.'"]See More[/fblock][/one_fourth][/row]' );
						
				
				// workshop main heading
				$workshop_main_heading=get_field ( 'workshops_main_heading', 'option' );;
				echo do_shortcode ( '<div class="promo promo-xyz">' . '[row][one_whole]' . $workshop_main_heading . '[/one_whole][/row]' . '</div>' );
				?>
				<?php
				// workshop-1
				$title_ws_1 = get_field ( 'workshop-1', 'option' );
				$published_posts_ws_1 = wp_count_posts ( 'workshop-1' )->publish;
				$icon_ws_1 = get_field ( 'icon-workshop-1', 'option' );
				
				// workshop-2
				$title_ws_2 = get_field ( 'workshop-2', 'option' );
				$published_posts_ws_2 = wp_count_posts ( 'workshop-2' )->publish;
				$icon_ws_2 = get_field ( 'icon-workshop-2', 'option' );
				// workshop-3
				$title_ws_3 = get_field ( 'workshop-3', 'option' );
				$published_posts_ws_3 = wp_count_posts ( 'workshop-3' )->publish;
				$icon_ws_3 = get_field ( 'icon-workshop-3', 'option' );
				// workshop-4
				$title_ws_4 = get_field ( 'workshop-4', 'option' );
				$published_posts_ws_4 = wp_count_posts ( 'workshop-4' )->publish;
				$icon_ws_4 = get_field ( 'icon-workshop-4', 'option' );
				// workshop-5
				$title_ws_5 = get_field ( 'workshop-5', 'option' );
				$published_posts_ws_5 = wp_count_posts ( 'workshop-5' )->publish;
				$icon_ws_5 = get_field ( 'icon-workshop-5', 'option' );
				// workshop-6
				$title_ws_6 = get_field ( 'workshop-6', 'option' );
				$published_posts_ws_6 = wp_count_posts ( 'workshop-6' )->publish;
				$icon_ws_6 = get_field ( 'icon-workshop-6', 'option' );
				
				// echo do_shortcode('[row]');
				echo do_shortcode ( '[row][one_whole][workshop1 title="' . $title_ws_1 . '" limit="' . $published_posts_ws_1 . '" featured="0" icon="'.$icon_ws_1.'"/][/one_whole][/row]' );
				echo do_shortcode ( '[row][one_whole][workshop2 title="' . $title_ws_2 . '" limit="' . $published_posts_ws_2 . '" featured="0" icon="'.$icon_ws_2.'"/][/one_whole][/row]' );
				echo do_shortcode ( '[row][one_whole][workshop3 title="' . $title_ws_3 . '" limit="' . $published_posts_ws_3 . '" featured="0" icon="'.$icon_ws_3.'"/][/one_whole][/row]' );
				echo do_shortcode ( '[row][one_whole][workshop4 title="' . $title_ws_4 . '" limit="' . $published_posts_ws_4 . '" featured="0" icon="'.$icon_ws_4.'"/][/one_whole][/row]' );
				echo do_shortcode ( '[row][one_whole][workshop5 title="' . $title_ws_5 . '" limit="' . $published_posts_ws_5 . '" featured="0" icon="'.$icon_ws_5.'"/][/one_whole][/row]' );
				echo do_shortcode ( '[row][one_whole][workshop6 title="' . $title_ws_6 . '" limit="' . $published_posts_ws_6 . '" featured="0" icon="'.$icon_ws_6.'"/][/one_whole][/row]' );
				// echo do_shortcode('[/row]');
				
				// latest news,//tenders,enquiry form
				$left_heading=get_field ( 'lrft_column', 'option' );
				$middle_heading=get_field ( 'middle_column', 'option' );
				$right_heading=get_field ( 'right_column', 'option' );			
				
				$left_button=get_field ( 'left_button_text', 'option' );
				$middle_button=get_field ( 'middle_button_text', 'option' );
				
				$left_icon=get_field ( 'icon_left_column', 'option' );
				$right_icon=get_field ( 'icon_right_column', 'option' );
				$middle_icon=get_field ( 'icon_middle_column', 'option' );
				
				echo do_shortcode ( '[row][one_third][tblock title="'.$left_heading.'" image="'.$left_icon.'"/][list_posts limit="3" type="2" order="DESC" orderby="comment_count" post_type="news-item"/][/one_third][one_third][tblock title="'.$middle_heading.'" image="'.$middle_icon.'"/][list_posts limit="6" type="100" order="DESC" orderby="comment_count" post_type="tender"/][/one_third][one_third][tblock title="'.$right_heading.'" image="'.$right_icon.'"/][contact-form-7 id="3241" title="Enquiry"][/one_third][/row]' );
				// end home page content by govt factory.
				?>
				
				
				
			</div>
			<?php if ($layout == '2'):?>
				<aside class="large-4 columns sidebar-right"><?php generated_dynamic_sidebar() ?></aside>
			<?php endif?>
		<?php endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>