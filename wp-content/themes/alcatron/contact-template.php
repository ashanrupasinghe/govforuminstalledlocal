<?php /* Template Name: Contact Form */ ?>

<?php get_header(); ?>
<?php

$alc_options = get_option ( 'alc_general_settings' );
$options = array (
		$alc_options ['alc_contact_error_message'],
		$alc_options ['alc_contact_success_message'],
		$alc_options ['alc_subject'],
		$alc_options ['alc_email_address'] 
);

$custom = get_post_custom ( $post->ID );
$layout = isset ( $custom ['_page_layout'] ) ? $custom ['_page_layout'] [0] : '1';
$breadcrumbs = $alc_options ['alc_show_breadcrumbs'];
$titles = $alc_options ['alc_show_page_titles'];
?>
<?php  if ($breadcrumbs || $titles):?>
<div class="row">
	<div class="large-12 columns main-content-top">
		<div class="row">
			<div class="large-6 columns">
                <?php  if ($titles):?>
					<h2>
						<?php
		$headline = get_post_meta ( $post->ID, "_headline", $single = false );
		if (! empty ( $headline [0] )) {
			echo $headline [0];
		} else {
			echo get_the_title ();
		}
		?>
					</h2>
				<?php endif?>
            </div>
			<div class="large-6 columns">
				<?php  if ($breadcrumbs):?>
					<?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
				<?php endif?>
            </div>
		</div>
	</div>
</div>
<?php endif?>
<?php //if (!empty($alc_options['alc_contact_address'])):?>
<script type="text/javascript"
	src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript"
	src="<?php echo get_template_directory_uri().'/js/gmap3.min.js';?>"></script>
<script type="text/javascript">   
  jQuery(function(){
	jQuery('#map_canvas').gmap3(
	  {
		action: 'addMarker',
		address: "Government Factory, Colombo, Western Province, Sri Lanka",
		map:{
		  center: true,
		  zoom: 16
		},
		
	  },
	  {action: 'setOptions', args:[{scrollwheel:true}]}
	);
	  
  });
</script>
<?php //endif?>
<div class="content_wrapper">
	<div class="row">
		<div class="large-12 columns">  
			<?php //if (!empty($alc_options['alc_contact_address'])):?>
            	<div id="map_canvas" class="gmap3 map_location"></div>
			<?php //endif?>			
		</div>
                
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="large-7 columns">
			<div class="contact_info">
					<?php the_content(); ?>
					<a href="#" data-reveal-id="rev-4145" class="button radius normal small" id="rev-parent-4145"><?php the_field('contact_pop_up_button_name');?></a>
				</div>
		</div>
		<?php endwhile; ?>
		<div class="large-5 columns">
		<?php /*?>
			<form method="POST" class="contactForm">
				<div id="status"></div>
				<div class="contact_form">
					<div class="row">
						<div class="small-4 columns">
							<input type="text" placeholder="<?php _e('Name', 'Alcatron')?>"
								name="contactname" id="contactname" />
							<?php if(isset($nameError) && $nameError != ''): ?><span
								class="errorarr"><?php echo $nameError;?></span><?php endif;?>
						</div>
						<div class="small-4 columns">
							<input type="text" placeholder="<?php _e('E-mail', 'Alcatron')?>"
								name="contactemail" id="contactemail" />
							<?php if(isset($emailError) && $emailError != ''): ?><span
								class="errorarr"><?php echo $emailError;?></span><?php endif;?>
						</div>
						<div class="small-4 columns">
							<input type="text"
								placeholder="<?php _e('Website', 'Alcatron')?>"
								name="contactwebsite" id="contactwebsite" />
						</div>
						<div class="small-12 columns">
							<textarea cols="10" rows="15" name="contactmessage"
								id="contactmessage"
								placeholder="<?php _e('Message', 'Alcatron')?>"></textarea>
							<?php if(isset($messageError) && $messageError != ''): ?><span
								class="errorarr"><?php echo $messageError;?></span><?php endif;?>
						</div>
						<div class="small-12 columns">
							<div class="g-recaptcha"
								data-sitekey="6LdWpRETAAAAAOJw5KDcePEWRdLvDag3Q1Yg29-m" style=""></div>
						</div>
						<div class="small-12 columns contact-button">
							<input type="submit" class="button"
								value="<?php _e('Send message', 'Alcatron')?>" name="send"
								id="send" /> <input type="hidden" name="options"
								value="<?php echo implode('|', $options) ?>" />
						</div>
					</div>
				</div>
			</form>
			<?php */?>
			<?php echo do_shortcode('[contact-form-7 id="3520" title="Contact page"]');?>
		</div>
	</div>
	<!-- <div class="row">
		<div class="large-12 columns"> -->
		<?php //the_field('contact_table'); ?>
		<!-- </div>
	</div> -->
	
	<?php if( have_rows('person') ): ?>	
	<div id="rev-4145" class="reveal-modal ">
	<div class="row">
		<div class="large-12 columns contact-table-div">			
				<table class="contact-table">
					<thead>
						<tr>
							<th>Div./Unit</th>
							<th>Name</th>
							<th>Designation</th>
							<th>E-mail</th>
							<th>Telephone No</th>
							<th>Ext No</th>
						</tr>
					</thead>
					<tbody>
				<?php
		
		while ( have_rows ( 'person' ) ) :
			the_row ();
			// vars
			$unit = get_sub_field ( 'Div_Unit' );
			$name = get_sub_field ( 'name' );
			$designation = get_sub_field ( 'designation' );
			$email = get_sub_field ( 'e-mail' );
			$phone = get_sub_field ( 'telephone_no' );
			$ext_no = get_sub_field ( 'ext_no' );
			?>
					<tr>
							<td><?php echo $unit;?></td>
							<td><?php echo $name;?></td>
							<td><?php echo $designation;?></td>
							<td><?php echo $email;?></td>
							<td><?php echo $phone;?></td>
							<td><?php echo $ext_no;?></td>
						</tr>
					<?php endwhile; ?>
				</tbody>
				</table>			
			
		</div>
	</div>
</div>
<?php endif; ?>
</div>
<script type="text/javascript">
<!-- Contact form validation
jQuery(document).ready(function(){

  jQuery(".contactForm").validate({
	submitHandler: function() {
	
		var postvalues =  jQuery(".contactForm").serialize();
		
		jQuery.ajax
		 ({
		   type: "POST",
		  url: "<?php echo get_template_directory_uri()  ?>/contact-form.php",
		   data: postvalues,
		   success: function(response)
		   {
		 	 jQuery("#status").html(response).show('normal');
		     jQuery('#contactmessage, #contactemail, #contactname, #contactwebsite').val("");
		   }
		 });
		return false;
		
    },
	focusInvalid: true,
	focusCleanup: false,
	//errorLabelContainer: jQuery("#registerErrors"),
  	rules: 
	{
		contactname: {required: true},
		contactemail: {required: true, minlength: 6,maxlength: 50, email:true},
		contactmessage: {required: true, minlength: 6}
	},
	
	messages: 
	{
		contactname: {required: "<?php _e( 'Name is required', 'Alcatron' ); ?>"},
		contactemail: {required: "<?php _e( 'E-mail is required', 'Alcatron' ); ?>", email: "<?php _e( 'Please provide a valid e-mail', 'Alcatron' ); ?>", minlength:"<?php _e( 'E-mail address should contain at least 6 characters', 'Alcatron' ); ?>"},
		contactmessage: {required: "<?php _e( 'Message is required', 'Alcatron' ); ?>"}
	},
	
	errorPlacement: function(error, element) 
	{
		error.insertBefore(element);
		jQuery('<span class="errorarr"></span>').insertBefore(element);
	},
	invalidHandler: function()
	{
		//jQuery("body").animate({ scrollTop: 0 }, "slow");
	}
	
});
});
-->
</script>


<?php get_footer(); ?>