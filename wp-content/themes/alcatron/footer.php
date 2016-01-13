</div> <!--main content end -->

<?php $alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');?>
<div class="footer_wrapper">
	<footer class="row footer-part">
		<div class="large-12 columns">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Top Sidebar") ) :endif; ?>
			
			 <!-- Bottom Content -->
			<?php 
				$footer_widget_count = isset($alc_options['alc_footer_widgets_count']) ? $alc_options['alc_footer_widgets_count']:0;
				if($footer_widget_count > 0):
			?>
			<div class="row">			
				<?php
					for($i = 1; $i<= $footer_widget_count; $i++){
						if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Widget ".$i) ) :endif;
					}			
				?>
			</div>
			<?php endif; ?>		
		</div>
	</footer>
	<div class="privacy footer-part row">
		<div class="large-12 columns">
			<a href="#" class="scrollup" style="display: inline"><?php _e('Scroll', 'Alcatron')?></a>
			<div class="row footer_bottom">
				<div class="large-5 columns">
					<p class="copyright"><?php echo $alc_options['alc_copyright']?></p>
				</div>
				<div class="large-5 columns right">
					<div class="row collapse">
						<?php echo do_shortcode($alc_options['alc_footer_social'])?>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php //include ('optionspanel.php') ?>
</div>

<?php if (isset($alc_options['alc_custom_js'])) echo $alc_options['alc_custom_js']; ?>
<?php wp_footer()?>
</body>
</html>
