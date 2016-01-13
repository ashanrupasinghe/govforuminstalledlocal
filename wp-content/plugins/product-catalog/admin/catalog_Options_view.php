<?php 
if (function_exists('current_user_can'))
    if (!current_user_can('delete_pages')) {
        die(__('Access Denied',"product-catalog"));
    }
if (!function_exists('current_user_can')) {
    die(__('Access Denied',"product-catalog"));
}

function      html_showStyles($param_values, $op_type)
{
    ?>
<script>

jQuery(document).ready(function () {
	var strliID=jQuery(location).attr('hash');
	//alert(strliID);
	jQuery('#catalog-view-tabs li').removeClass('active');
	if(jQuery('#catalog-view-tabs li a[href="'+strliID+'"]').length>0){
		jQuery('#catalog-view-tabs li a[href="'+strliID+'"]').parent().addClass('active');
	}else {
		jQuery('#catalog-view-tabs li a[href="#catalog-view-options-0"]').parent().addClass('active');
	}
	jQuery('#catalog-view-tabs-contents li').removeClass('active');
	strliID=strliID;
	//alert(strliID);
	if(jQuery(strliID).length>0){
		jQuery(strliID).addClass('active');
	}else {
		jQuery('#catalog-view-options-0').addClass('active');
	}
	jQuery('input[data-slider="true"]').bind("slider:changed", function (event, data) {
		 jQuery(this).parent().find('span').html(parseInt(data.value)+"%");
		 jQuery(this).val(parseInt(data.value));
	});	
});
</script>
<div class="wrap">

<?php $path_site2 = plugins_url("../images", __FILE__); ?>

    <div id="poststuff">
	<?php $path_site2 = plugins_url("../images/", __FILE__); ?>
        <?php $path_site2 = plugins_url("../images", __FILE__); 
	?>
	<style>
		.free_version_banner {
			position:relative;
			display:block;
			background-image:url(<?php echo $path_site2; ?>/wp_banner_bg.jpg);
			background-position:top left;
			backround-repeat:repeat;
			overflow:hidden;
		}
		
		.free_version_banner .manual_icon {
			position:absolute;
			display:block;
			top:15px;
			left:15px;
		}
		
		.free_version_banner .usermanual_text {
                        font-weight: bold !important;
			display:block;
			float:left;
			width:270px;
			margin-left:75px;
			font-family:'Open Sans',sans-serif;
			font-size:12px;
			font-weight:300;
			font-style:italic;
			color:#ffffff;
			line-height:10px;
                        margin-top: 0;
                        padding-top: 15px;
		}
		
		.free_version_banner .usermanual_text a,
		.free_version_banner .usermanual_text a:link,
		.free_version_banner .usermanual_text a:visited {
			display:inline-block;
			font-family:'Open Sans',sans-serif;
			font-size:17px;
			font-weight:600;
			font-style:italic;
			color:#ffffff;
			line-height:30.5px;
			text-decoration:underline;
		}
		
		.free_version_banner .usermanual_text a:hover,
		.free_version_banner .usermanual_text a:focus,
		.free_version_banner .usermanual_text a:active {
			text-decoration:underline;
		}
		
		.free_version_banner .get_full_version,
		.free_version_banner .get_full_version:link,
		.free_version_banner .get_full_version:visited {
                        padding-left: 60px;
                        padding-right: 4px;
			display: inline-block;
                        position: absolute;
                        top: 15px;
                        right: calc(50% - 167px);
                        height: 38px;
                        width: 268px;
                        border: 1px solid rgba(255,255,255,.6);
                        font-family: 'Open Sans',sans-serif;
                        font-size: 23px;
                        color: #ffffff;
                        line-height: 43px;
                        text-decoration: none;
                        border-radius: 2px;
		}
		
		.free_version_banner .get_full_version:hover {
			background:#ffffff;
			color:#bf1e2e;
			text-decoration:none;
			outline:none;
		}
		
		.free_version_banner .get_full_version:focus,
		.free_version_banner .get_full_version:active {
			
		}
		
		.free_version_banner .get_full_version:before {
			content:'';
			display:block;
			position:absolute;
			width:33px;
			height:23px;
			left:25px;
			top:9px;
			background-image:url(<?php echo $path_site2; ?>/wp_shop.png);
			background-position:0px 0px;
			background-repeat:repeat;
		}
		
		.free_version_banner .get_full_version:hover:before {
			background-position:0px -27px;
		}
		
		.free_version_banner .huge_it_logo {
			float:right;
			margin:15px 15px;
		}
		
		.free_version_banner .description_text {
                        padding:0 0 13px 0;
			position:relative;
			display:block;
			width:100%;
			text-align:center;
			float:left;
			font-family:'Open Sans',sans-serif;
			color:#fffefe;
			line-height:inherit;
		}
                .free_version_banner .description_text p{
                        margin:0;
                        padding:0;
                        font-size: 14px;
                }
		</style>
	<div class="free_version_banner">
		<img class="manual_icon" src="<?php echo $path_site2; ?>/icon-user-manual.png" alt="user manual" />
		<p class="usermanual_text">If you have any difficulties in using the options, Follow the link to <a href="http://huge-it.com/wordpress-product-catalog-user-manual/" target="_blank">User Manual</a></p>
		<a class="get_full_version" href="http://huge-it.com/product-catalog/" target="_blank">GET THE FULL VERSION</a>
                <a href="http://huge-it.com" target="_blank"><img class="huge_it_logo" src="<?php echo $path_site2; ?>/Huge-It-logo.png"/></a>
                <div style="clear: both;"></div>
		<div  class="description_text"><p>This is the free version of the plugin. In order to use options from this section, get the full version. We appreciate every customer.</p></div>
	</div>
        <div style="clear:both;"></div>
        <div style="color: #a00; margin-bottom: 15px;"><?php echo __("This options are for commercial users, it includes one of Personal, Multi-Site or Developer versions.Please upgrade to use this section. Please upgrade to use this section.","product-catalog");?>  
        </div>
            <div id="post-body-content" class="catalog-options">
                    <div id="post-body-heading">
                            <h3><?php echo __("Themes Options","product-catalog");?></h3>

                            <a onclick="document.getElementById('adminForm').submit()" class="save-catalog-options button-primary"><?php echo __("Save");?></a>

                    </div>
                    <form action="admin.php?page=Options_product_Catalog_styles&task=save" method="post" id="adminForm" name="adminForm">
                        <div id="catalog-options-list">
			
                            <ul id="catalog-view-tabs">
                                    <li><a href="#catalog-view-options-0"><?php echo __("Blocks Toggle Up/Down","product-catalog");?></a></li>
                                    <li><a href="#catalog-view-options-1"><?php echo __("Full-Height Blocks","product-catalog");?></a></li>
                                    <li><a href="#catalog-view-options-2"><?php echo __("Catalog/Content-Popup","product-catalog");?></a></li>
                                    <li><a href="#catalog-view-options-3"><?php echo __("Full-Width Blocks","product-catalog");?></a></li>
                                    <li><a href="#catalog-view-options-5"><?php echo __("Content Slider","product-catalog");?></a></li>
                            </ul>
                            <ul class="options-block" id="catalog-view-tabs-contents">
                                 <li id="catalog-view-options-0" style="list-style-type: none;">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-1.jpg" style="width: 100%;"/>
                                </li>
                                <li id="catalog-view-options-1">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-2.jpg" style="width: 100%;" />
                                </li>
                                <li id="catalog-view-options-2">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-3.jpg" style="width: 100%;" />
                                </li>
                                <li id="catalog-view-options-3">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-4.jpg" style="width: 100%;" />
                                </li>
                                <li id="catalog-view-options-5">
                                    <img src="<?php echo $path_site2; ?>/catalog-options-5.jpg" style="width: 100%;" />
                                </li>
                            </ul>
                                    <div id="post-body-footer">
                                        <a onclick="document.getElementById('adminForm').submit()" class="save-catalog-options button-primary"><?php echo __("Save","product-catalog");?></a>
                                        <div class="clear"></div>
                                </div>
                            </form>
                        </div>
                        
            </div>
    </div>
</div>

<script>
    jQuery("#post-body-heading a, #post-body-footer a").click(function(){
        alert("Product Catalog Settings are disabled in free version. If you need those functionalityes, you need to buy the commercial version.");return false;
    });
    
</script>

<input type="hidden" name="option" value=""/>
<input type="hidden" name="task" value=""/>
<input type="hidden" name="controller" value="options"/>
<input type="hidden" name="op_type" value="styles"/>
<input type="hidden" name="boxchecked" value="0"/>

<?php
}