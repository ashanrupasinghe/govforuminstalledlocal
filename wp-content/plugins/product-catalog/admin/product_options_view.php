<?php

function html_show_product_options($param_values){  //  var_dump($param_values); ?>



<div class="wrap">

<?php $path_site2 = plugins_url("../images", __FILE__); ?>
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
                <div style="margin-left: -20px;" id="poststuff">
                    <div id="post-body-content" class="catalog-options">
                            <img style="width: 100%;" src="<?php echo $path_site2; ?>/options-2.jpg">
                    </div>			
                </div>			
            </div>
	</div>
    </div>
</div>

<style>
    #wpfooter{
        position:inherit;
    }
.catalog-options   div label .help {
    float: right;
    position:relative;
    display:inline-block;
    width:20px;
    height:20px;
    margin:0px 10px 0px 20px;
    border: 1px solid #888;
    border-radius: 20px;
    text-indent: 7px;
}

.catalog-options   div label .help:hover {
    border: 1px solid #1e8cbe;
    border-radius: 20px;
    text-indent: 7px;
}

.catalog-options   div  .help-block {
     position:absolute;
     min-width:250px;
     padding:5px;
     top:30px;
     left: -121px;
     background:#fff;
     border:1px solid #aaa;
     border-radius: 3px;
     display:none;
     font-size: 12px;
     z-index:5;
    text-align:justify;
}

.catalog-options  div  .help-block.active {
    display:block;
}

.catalog-options  div  .help-block .pnt {
    position:absolute;
    width:10px;
    height:11px;
    top:-10px;
    left:50%;
    margin-left:-5px;
    background:url(../images/help.box.pnt.gif) left top no-repeat;
}

.catalog-options div  .help-block p {
    margin: 0px;
    padding: 0px;
    text-indent: 0px;
}

#post-body-heading {
	width:100%;
	padding:10px 0px 10px 0px;
	height:30px;
	background:#fff;
	border-bottom: 1px solid #e5e5e5;
}

.catalog-options #post-body-heading {width:100%;}

#post-body-heading h3 {
	float:left;
	margin:-5px 0px 0px 5px !important;
	padding:0px;
}

#post-body-heading .button,#post-body-heading .save-catalog-options  {
	float:right;
	margin-right:10px !important;
}

#post-body-heading .button.add-post-slide input {
	position:absolute;
	display:none;
}

#post-body-heading .button.add-new-image .wp-media-buttons-icon {
	background: url('../../../../wp-admin/images/media-button.png') no-repeat top left;
	display: inline-block;
	width: 140px;
	height: 24px;
	vertical-align: text-top;
	color: #fff;
	-webkit-box-shadow: inset 0 0px 0 #fff,0 1px 0 rgba(0,0,0,.08);
	box-shadow: inset 0 0px 0 #fff,0 1px 0 rgba(0,0,0,.08);
	border: none; 
	padding-left: 22px;
	background-position: 0px;
	margin-right: 0px !important;
}

#post-body-heading .button.add-new-catalog .wp-media-buttons-icon {
	background: url('../../../../wp-admin/images/media-button.png') no-repeat top left;
	display: inline-block;
	width: 140px;
	height: 24px;
	vertical-align: text-top;
	color: #fff;
	-webkit-box-shadow: inset 0 0px 0 #fff,0 1px 0 rgba(0,0,0,.08);
	box-shadow: inset 0 0px 0 #fff,0 1px 0 rgba(0,0,0,.08);
	border: none; 
	padding-left: 22px;
	background-position: 0px;
	margin-right: 0px !important;
}

#post-body-heading .button.add-post-slide .wp-media-buttons-icon {
	background: url('../../../../wp-admin/images/post-ats.png') no-repeat top left;
	display: inline-block;
	width: 16px;
	height: 16px;
	vertical-align: text-top;
	margin: 2px 7px 0px 0px;
}

#post-body-footer{
    float: right;
}

#catalog-options-list {
	width:100%;
	background:#fff;
}

#catalog-view-tabs-contents > li  {
	position:relative;
	width:100%;
	float:left;
	display:block;
        background: #fff;
}




#catalog-view-tabs-contents > li  > div {
	position:relative;
	display:block;
	float:left;
	margin:10px 1% 25px 1%;
	padding:0px 1% 10px 1%;
	width:46%;
	background:#f9f9f9;
}
#catalog-view-tabs-contents > li   div.has-background {background:#fff;}
#catalog-view-tabs-contents > li   div.has-height > div {display:inline-block;}


#catalog-view-tabs-contents > li  > div  h3 {
	display:block;
	text-align:center;
	margin:0px 0px 10px 0px;
}

#catalog-view-tabs-contents > li  > div > div {
	position:relative;
	clear:both;
	width:100%;
	height:35px;
	padding:5px 0px 0px 0px;
	margin:0px !important;
}

#catalog-view-tabs-contents > li  > div > div label {
	display:inline-block;
	width:60%;
	padding:5px 0px 0px 2%;
	height:30px;
	float:left;
}



#catalog-view-tabs-contents > li  > div > div div.slider-container {
	position:relative;
	display: inline-block;
	width: 145px;
	margin-left:-5px;
}

#catalog-view-tabs-contents > li  > div > div div.slider-container span {
	position:absolute;
	top:-3px;
	right:0px;
}

#catalog-view-tabs-contents > li  > div > div input[type='text'],#catalog-view-tabs-contents > li  > div > div select {
	width:100px;
}

#catalog-view-tabs-contents > li  > div > div input[type='checkbox'] {
	margin:7px 0px 3px 0px;
}

#catalog-view-tabs-contents > li  > div > div.bws_position_table input {
	margin:3px 17px 3px 3px;
}



</style>

<?php }


?>