<?php
if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die(__('Access Denied',"product-catalog"));
    }
if (!function_exists('current_user_can')) {
    die(__('Access Denied',"product-catalog"));
}

function html_show_ratings($ratingsArray){ $ratingsArray = array_reverse($ratingsArray, true); $keyForBackground = 1;  //  var_dump($ratingsArray);exit; ?>
<div class="wrap">
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
		<div  class="description_text"><p>This is the free version of the plugin. Click "GET THE FULL VERSION" for more advanced options.   We appreciate every customer.</p></div>
	</div>
        <div style="clear:both;"></div>
    <div id="poststuff">
        <div id="catalogs-list-page">
            <h2><?php echo __("Huge-IT Catalog Ratings","product-catalog");?></h2>
            <div id="huge_it_catalog_ratings_page">
            <div id="huge_it_catalog_reviews_container">
                <table class="widefat fixed comments">
                        <thead>
                            <tr>
                                <th scope="col" id="cb" class="manage-column column-cb check-column" style="">
                                    <label class="screen-reader-text" for="cb-select-all-<?php  ?>"><?php echo __("Select All","product-catalog");?></label>
                                    <input id="cb-select-all-<?php  ?>" type="checkbox">
                                </th>
                                <th >
                                    <span><?php echo __("Product Name","product-catalog");?></span><span class="sorting-indicator"></span>
                                </th>
                                <th ><?php echo __("Rating","product-catalog");?></th>
                                <th >
                                    <span><?php echo __("Author","product-catalog");?> IP</span><span class="sorting-indicator"></span>
                                </th>
                                <th ><?php echo __("Submited On","product-catalog");?></th>
                                <th ><?php echo __("Edit","product-catalog");?></th>
                                <th ><a id="doaction" ><?php echo __("Delete","product-catalog");?></a></th>

                            </tr>
                        </thead>

                        <tbody id="the-comment-list" data-wp-lists="list:comment">
                        <?php foreach ($ratingsArray as $rating) {  ?>
                                <tr id="comment-<?php echo $rating->id; ?>" class="comment even thread-even depth-<?php echo $keyForBackground; if($keyForBackground%2 == 0) echo " alt"; ?> ">
                                    <th scope="row" class="check-column">
                                        <label class="screen-reader-text" for="cb-select-<?php echo $rating->id; ?>"><?php echo __("Select comment","product-catalog");?></label>
                                        <input id="cb-select-<?php echo $keyForBackground; ?>" type="checkbox" name="check_comments" value="<?php echo $rating->id; ?>">
                                    </th>
                                    <td class="response column-response">
                                        <div class="response-links">
                                            <span class="post-com-count-wrapper">
                                                <?php echo $rating->name; ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="comment column-comment">
                                        <div class="comment-author">
                                            <strong>
                                                <?php echo $rating->ip; ?>
                                            </strong>
                                            <br>
                                            <a href="edit-comments.php?s=&amp;mode=detail"></a>
                                        </div>
                                        <input class="reviews_textarea" id_for_edit="<?php echo $rating->id; ?>" value="<?php echo $rating->value; ?>" />
                                        <div id="inline-1" class="hidden">
                                        <textarea class="comment" rows="1" cols="1"><?php echo $rating->value; ?></textarea>
                                        <div class="author-email"></div>
                                        <div class="author"><?php echo $rating->ip; ?></div>
                                        <div class="comment_status">1</div>
                                        </div>
                <!--                        <div class="row-actions">
                                            <span class="edit" value="<?php echo $rating->id; ?>"> | <a title="Edit comment">Edit</a></span>
                                            <span class="trash" value="<?php echo $rating->id; ?>"> | <a class="delete vim-d vim-destructive" title="Move this comment to the trash">Trash</a>
                                            </span>
                                        </div>-->
                                    </td>
                                    <td class="author column-author">
                                        <input value="<?php echo $rating->ip; ?>" id_for_edit="<?php echo $rating->id; ?>" />
                                       <br>
                                        <a href="edit-comments.php?s=&amp;mode=detail"></a>
                                    </td>

                                    <td><?php echo " ".$rating->date; ?></td>
                                    <td><span class="edit" value="<?php echo $rating->id; ?>"> <a><?php echo __("Edit","product-catalog");?></a></td>
                                    <td><span class="trash" value="<?php echo $rating->id; ?>"> <a><?php echo __("Delete","product-catalog");?></a></td>
                                </tr>
                        <?php $keyForBackground++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    jQuery( document ).ready(function() {
        
//        jQuery("body").not('.wrap .poststuff #catalogs-list-page #huge_it_catalog_ratings_page #huge_it_catalog_reviews_container table .edit').click(function(){
//            jQuery("#the-comment-list input").css({"box-shadow" : "none"});
//        });
        
        jQuery('#huge_it_catalog_ratings_page .trash').click(function(){
            var rating_id = jQuery(this).attr('value');
            var ratings_for_delete = [];
            ratings_for_delete.push(jQuery(this).attr('value'));
            var data = {
                            action: 'my_action',
                            post: 'delanyratings',
                            ratings_for_delete: ratings_for_delete
                       };
            jQuery.post(ajaxurl, data, function(response) {    //      alert(response);
                if(response == 1) {                            //      alert(ratings_for_delete);
                    jQuery("#comment-"+rating_id).remove();
                    var key_for_background = 0;
                    jQuery("#the-comment-list tr").each(function(){
                        key_for_background++;
                        if(key_for_background%2 == 0){ jQuery(this).addClass('alt'); }
                        else{ jQuery(this).removeClass('alt');('alt'); }
                    });
                }
           });
        });
        jQuery('#huge_it_catalog_ratings_page .edit').click(function(){
            jQuery("#the-comment-list input").css({"box-shadow" : "none"});
            jQuery(this).parent().parent().find(".reviews_textarea").css({"box-shadow" : "0 0 4px #007eff"});
            jQuery(this).parent().parent().find(".author input").css({"box-shadow" : "0 0 4px #007eff"});
        });
        
//        jQuery('*').not('.edit_all').not('.edit').click(function(){
//            alert("ok");
//        });
        
        jQuery('.edit_all').click(function(){
            jQuery("#the-comment-list input").css({"box-shadow" : "none"});
            jQuery(".reviews_textarea").css({"box-shadow" : "0 0 4px #007eff"});
            jQuery(".author input").css({"box-shadow" : "0 0 4px #007eff"});
        });
        
        
        
        jQuery('#huge_it_catalog_ratings_page .reviews_textarea').focus(function(){
            jQuery(this).css({"box-shadow" : "0 0 4px #007eff"});
        });
        jQuery('#huge_it_catalog_ratings_page .reviews_textarea').blur(function(){
            jQuery(this).css({"box-shadow" : "none"});
            jQuery(this).parent().parent().parent().find(".author input").css({"box-shadow" : "none"});
        });
        jQuery('#huge_it_catalog_ratings_page .column-author input').focus(function(){
            jQuery(this).css({"box-shadow" : "0 0 1px #007eff"});
        });
        jQuery('#huge_it_catalog_ratings_page .column-author input').blur(function(){
            jQuery(this).css({"box-shadow" : "none"});
            jQuery(this).parent().parent().parent().find(".author input").css({"box-shadow" : "none"});
        });
        jQuery('#huge_it_catalog_ratings_page .reviews_textarea').change(function(){
            var rating_new_id = jQuery(this).attr('id_for_edit');   //   alert(rating_new_id);
            var rating_new_value = jQuery(this).val();  //  alert(rating_new_value);
            if(rating_new_value > 5){ alert('Maximum Value 5');return false; }
            var data = {
                            action: 'my_action',
                            post: 'editratingvalue',
                            rating_new_id: rating_new_id,
                            rating_new_value: rating_new_value
                        };
            jQuery.post(ajaxurl, data, function(response) { // alert(response);
                 if(response == 1) {  }
            });
        });
        jQuery('#huge_it_catalog_ratings_page .author input').change(function(){
            var rating_new_id = jQuery(this).attr('id_for_edit');   //   alert(rating_new_id);
            var rating_new_ip = jQuery(this).val(); //   alert(com_new_name);
            var data = {
                            action: 'my_action',
                            post: 'editratingip',
                            rating_new_id: rating_new_id,
                            rating_new_ip: rating_new_ip
                       };
            jQuery.post(ajaxurl, data, function(response) {
                 if(response == 1) { jQuery('input').blur(); }
            });
        });
        
    });
    jQuery('#huge_it_catalog_ratings_page #doaction').click(function(){
                var checked_ratings = [];
                jQuery("input[name='check_comments']").each(function(){
                    if(jQuery(this).is(':checked')) {
                        checked_ratings.push(jQuery(this).val());
                    }
                });
                if(checked_ratings.length > 0){
                            var data = {
                                action: 'my_action',
                                post: 'delanyratings',
                                ratings_for_delete: checked_ratings
                            };
                }
            
                jQuery.post(ajaxurl, data, function(response) {  //  alert(response);
                    if(response == 1) {
                        var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                        forEach( checked_ratings, function( node ) {       //      alert( node );
                              jQuery("#comment-"+node).remove();
                        });
                    }
               });
        });
    
</script>
<style>
    
#huge_it_catalog_ratings_page a {
    cursor: pointer;
}

#huge_it_catalog_ratings_page .reviews_textarea {
    resize: none;
    border: none;
    box-shadow: none;
    background-color: inherit;
    margin: -4px 0px 0px -4px;
    color: #555;
}

#huge_it_catalog_ratings_page .author input {
    border: none;
    box-shadow: none;
    background-color: inherit;
    margin: -4px 0px 0px -4px;
    padding: 3px;
    color: #555;
}

#huge_it_catalog_ratings_page table tr td {
    padding: 8px 0px 5px 5px !important;
}
#huge_it_catalog_ratings_page table tr th {
    padding: 8px 0px 3px 5px !important;
}

#poststuff h2 {
    margin-top: 0;
    padding-top: 0;
}

</style>

<?php } ?>