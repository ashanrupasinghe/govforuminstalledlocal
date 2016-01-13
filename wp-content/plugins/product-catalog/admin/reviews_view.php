<?php
if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die(__('Access Denied',"product-catalog"));
    }
if (!function_exists('current_user_can')) {
    die(__('Access Denied',"product-catalog"));
}

function html_show_reviews($reviewsArray) { $reviewsArray = array_reverse($reviewsArray, true); $keyForBackground = 1;  //   var_dump($reviewsArray); ?>
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
<h2><?php echo __("Comments Manager","product-catalog"); ?></h2>

<div id="huge_it_catalog_revoews_page">
    <div id="huge_it_catalog_reviews_container">
        <div class="tablenav top">
        <div class="alignleft actions bulkactions">
            <label for="bulk-action-selector-top" class="screen-reader-text"><?php echo __("Select bulk action","product-catalog"); ?></label>
            <select name="action" id="bulk-action-selector-top">
                <option value="-1" selected="selected"><?php echo __("Bulk Actions","product-catalog"); ?></option>
                <option value="spam"><?php echo __("Mark As Spam","product-catalog"); ?></option>
                <option value="not_spam"><?php echo __("Delete From Spams","product-catalog"); ?></option>
                <option value="trash"><?php echo __("Move to Trash","product-catalog"); ?></option>
            </select>
            <input type="submit" name="" id="doaction" class="button action" value="Apply">
        </div>
        <br class="clear">
    </div>
    <table class="widefat fixed comments">
        <thead>
            <tr>
                <th scope="col" id="cb" class="manage-column column-cb check-column" style="">
                    <label class="screen-reader-text" for="cb-select-all-1"><?php echo __("Select All","product-catalog"); ?></label>
                    <input id="cb-select-all-1" type="checkbox">
                </th>
                <th scope="col" id="author" class="manage-column column-author sorted desc" style="">
                    <a>
                        <span><?php echo __("Author","product-catalog"); ?></span><span class=""></span>
                    </a>
                </th>
                <th scope="col" id="comment" class="manage-column column-comment" style=""><?php echo __("Comment","product-catalog"); ?></th>
                <th scope="col" id="response" class="manage-column column-response sortable desc" style="">
                    <a>
                        <span><?php echo __("In Response To","product-catalog"); ?></span><span class=""></span>
                    </a>
                </th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <th scope="col" class="manage-column column-cb check-column" style="">
                    <label class="screen-reader-text" for="cb-select-all-2"><?php echo __("Select All","product-catalog"); ?></label>
                    <input id="cb-select-all-2" type="checkbox">
                </th>
                <th scope="col" class="manage-column column-author sorted desc" style="">
                    <a>
                        <span><?php echo __("Author","product-catalog"); ?></span><span class=""></span>
                    </a>
                </th>
                <th scope="col" class="manage-column column-comment" style=""><?php echo __("Comment","product-catalog"); ?></th>
                <th scope="col" class="manage-column column-response sortable desc" style="">
                    <a>
                        <span><?php echo __("In Response To","product-catalog"); ?></span><span class=""></span>
                    </a>
                </th>
            </tr>
        </tfoot>

        <tbody id="the-comment-list" data-wp-lists="list:comment">
        <?php foreach ($reviewsArray as $review) {  ?>
                <tr id="comment-<?php echo $review->id; ?>" class="comment even thread-even depth-<?php echo $keyForBackground; if($keyForBackground%2 == 0) echo " alt"; ?> ">
                    <th scope="row" class="check-column">
                        <label class="screen-reader-text" for="cb-select-<?php echo $review->id; ?>"><?php echo __("Select comment","product-catalog"); ?></label>
                        <input id="cb-select-<?php echo $keyForBackground; ?>" type="checkbox" name="check_comments" value="<?php echo $review->id; ?>">
                    </th>
                    <td class="author column-author">
                        <input value="<?php echo $review->author_name; ?>" id_for_edit="<?php echo $review->id; ?>" />
                        <br><br>
                        <p class='spamer' <?php if($review->spam != 1) echo "style= 'display: none'"; ?>><?php echo __("Spam","product-catalog"); ?></p>
                    </td>
                    <td class="comment column-comment">
                        <div class="comment-author">
                            <strong>
                                <?php echo $review->author_name; ?>
                            </strong>
                            <br>
                            <a href="edit-comments.php?s=&amp;mode=detail"></a>
                        </div>
                        <div class="submitted-on"><?php echo __("Submitted on","product-catalog"); ?> <a><?php echo " ".$review->date; ?></a></div>
                        <textarea class="reviews_textarea" id_for_edit="<?php echo $review->id; ?>"><?php echo $review->content; ?></textarea>
                        <div id="inline-1" class="hidden">
                        <textarea class="comment" rows="1" cols="1"><?php echo $review->content; ?></textarea>
                        <div class="author-email"></div>
                        <div class="author"><?php echo $review->author_name; ?></div>
                        <div class="comment_status">1</div>
                        </div>
                        <div class="row-actions">
                            <span class="edit" value="<?php echo $review->id; ?>">  | <a title="Edit comment"><?php echo __("Edit","product-catalog"); ?></a></span>
                            <span class="spam" value="<?php echo $review->id; ?>" style='<?php if($review->spam == 1) { echo "display: none"; } ?>'>  | <a class="vim-s vim-destructive" title="Mark this comment as spam"><?php echo __("Spam","product-catalog"); ?></a></span>
                            <span class="not_spam" value="<?php echo $review->id; ?>" style='<?php if($review->spam != 1) { echo "display: none"; } ?>'>  | <a class="vim-s vim-destructive" title="Reove this comment From spam"><?php echo __("Not Spam","product-catalog"); ?></a></span>
                            <span class="trash" value="<?php echo $review->id; ?>"> | <a class="delete vim-d vim-destructive" title="Move this comment to the trash"><?php echo __("Trash","product-catalog"); ?></a>
                            </span>
                        </div>
                    </td>
                    <td class="response column-response">
                        <div class="response-links">
                            <span class="post-com-count-wrapper">
                                <a><?php echo $review->product_name; ?></a><br>
                            </span>
                        </div>
                    </td>
                </tr>
        <?php $keyForBackground++; } ?>
        </tbody>
    </table>
    <div class="alignleft actions bulkactions">
        <label for="bulk-action-selector-top" class="screen-reader-text"><?php echo __("Trash","product-catalog"); ?>Select bulk action</label>
        <select name="action" id="bulk-action-selector-top">
            <option value="-1" selected="selected"><?php echo __("Bulk Actions","product-catalog"); ?></option>
            <option value="spam"><?php echo __("Mark As Spam","product-catalog"); ?></option>
            <option value="not_spam"><?php echo __("Delete From Spams","product-catalog"); ?></option>
            <option value="trash"><?php echo __("Move to Trash","product-catalog"); ?></option>
        </select>
        <input type="submit" name="" id="doaction" class="button action" value="Apply">
    </div>
    </div>
</div>
</div>

<script>
    jQuery( document ).ready(function() {
        jQuery('#huge_it_catalog_revoews_page .trash').click(function(){
            var review_id = jQuery(this).attr('value');
            var reviews_for_delete = [];
            reviews_for_delete.push(jQuery(this).attr('value'));
            var data = {
                            action: 'my_action',
                            post: 'delanyreviews',
                            reviews_for_delete: reviews_for_delete
                       };
            jQuery.post(ajaxurl, data, function(response) {    //      alert(response);
                if(response == 1) {                            //      alert(reviews_for_delete);
                    jQuery("#comment-"+review_id).remove();
                    var key_for_background = 0;
                    jQuery("#the-comment-list tr").each(function(){
                        key_for_background++;
                        if(key_for_background%2 == 0){ jQuery(this).addClass('alt'); }
                        else{ jQuery(this).removeClass('alt'); }
                    });
                }
           });
        });
        jQuery('#huge_it_catalog_revoews_page .spam').on('click',function(){
            var review_id = jQuery(this).attr('value');   //   alert(review_id);
            var spam_reviews = [];
            spam_reviews.push(jQuery(this).attr('value'));   //   alert(spam_reviews);
            var data = {
                            action: 'my_action',
                            post: 'movetospamreviews',
                            spam_reviews: spam_reviews
                       };
            jQuery.post(ajaxurl, data, function(response) {    //    alert(response);
                if(response == 1) {                            //    alert(reviews_for_delete);
                    jQuery("#comment-"+review_id+" .row-actions .not_spam").css({"display" : ""});
                    jQuery("#comment-"+review_id+" .row-actions .spam").css({"display" : "none"});
                    jQuery("#comment-"+review_id+" .author p.spamer").css({"display" : ""});
                }
           });
        });
        
        jQuery('#huge_it_catalog_revoews_page .not_spam').on('click',function(){
            var review_id = jQuery(this).attr('value');   //   alert(review_id);
            var spam_reviews = [];
            spam_reviews.push(jQuery(this).attr('value'));   //   alert(spam_reviews);
            var data = {
                            action: 'my_action',
                            post: 'removefromtospamreviews',
                            spam_reviews: spam_reviews
                       };
            jQuery.post(ajaxurl, data, function(response) {     //   alert(response);
                if(response == 1) {                            //    alert(reviews_for_delete);
                    jQuery("#comment-"+review_id+" .row-actions .not_spam").css({"display" : "none"});
                    jQuery("#comment-"+review_id+" .row-actions .spam").css({"display" : ""});
                    jQuery("#comment-"+review_id+" .author p.spamer").css({"display" : "none"});
                }
            });
        });
        
        jQuery('#huge_it_catalog_revoews_page .edit').click(function(){
            jQuery(this).parent().parent().find(".reviews_textarea").focus();
            jQuery(this).parent().parent().parent().find(".author input").css({"box-shadow" : "0 0 1px #007eff"});
        });
        jQuery('#huge_it_catalog_revoews_page .reviews_textarea').focus(function(){
            jQuery(this).css({"height" : "90px","box-shadow" : "0 0 4px #007eff"});
        });
        jQuery('#huge_it_catalog_revoews_page .reviews_textarea').blur(function(){
            jQuery(this).css({"height" : "","box-shadow" : "none"});
            jQuery(this).parent().parent().parent().find(".author input").css({"height" : "","box-shadow" : "none"});
        });
        jQuery('#huge_it_catalog_revoews_page .column-author input').focus(function(){
            jQuery(this).css({"box-shadow" : "0 0 1px #007eff"});
        });
        jQuery('#huge_it_catalog_revoews_page .column-author input').blur(function(){
            jQuery(this).css({"height" : "","box-shadow" : "none"});
            jQuery(this).parent().parent().parent().find(".author input").css({"height" : "","box-shadow" : "none"});
        });
        jQuery('#huge_it_catalog_revoews_page .reviews_textarea').change(function(){
            var com_new_id = jQuery(this).attr('id_for_edit');   //   alert(com_new_id);
            var com_new_name = jQuery(this).val();  //  alert(com_new_name);
            var data = {
                            action: 'my_action',
                            post: 'editreviewcontent',
                            com_new_name: com_new_name,
                            com_new_id: com_new_id
                        };

                        jQuery.post(ajaxurl, data, function(response) {   //      alert(response);
                            if(response == 1) {
                                jQuery('input').blur();jQuery('textarea').blur();
                            }
                        });
        });
        jQuery('#huge_it_catalog_revoews_page .author input').change(function(){
            var com_new_id = jQuery(this).attr('id_for_edit');   //   alert(com_new_id);
            var com_new_name = jQuery(this).val(); //   alert(com_new_name);
            var data = {
                            action: 'my_action',
                            post: 'editreviewname',
                            com_new_name: com_new_name,
                            com_new_id: com_new_id
                       };
                       jQuery.post(ajaxurl, data, function(response) {
                            if(response == 1) { jQuery('input').blur(); }
                        });
        });
        
    });
    jQuery('#huge_it_catalog_revoews_page #doaction').click(function(){
            var apply_button_val = jQuery(this).parent().find("select").val(); //  alert(apply_button_val);
            if(apply_button_val == -1) { return false; }
            else {
                var checked_reviews = [];
                jQuery("input[name='check_comments']").each(function(){
                    if(jQuery(this).is(':checked')) {
                        checked_reviews.push(jQuery(this).val());
                    }
                });
                if(checked_reviews.length > 0){
                    if(apply_button_val == "spam") {
                        var data = {
                            action: 'my_action',
                            post: 'movetospamreviews',
                            spam_reviews: checked_reviews
                       };
                       jQuery.post(ajaxurl, data, function(response) {  //  alert(response);
                            if(response == 1) {
                                var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                forEach( checked_reviews, function( node ) {       //      alert( node );
                                    jQuery("#comment-"+node+ ".row-actions .not_spam").css({"display" : ""});
                                    jQuery("#comment-"+node+" .row-actions .spam").css({"display" : "none"});
                                    jQuery("#comment-"+node+" .author p.spamer").css({"display" : ""});
                                });
                            }
                       });
                    }
                    else
                        if(apply_button_val == "not_spam") {
                        var data = {
                            action: 'my_action',
                            post: 'removefromtospamreviews',
                            spam_reviews: checked_reviews
                        };
                        jQuery.post(ajaxurl, data, function(response) {  //  alert(response);
                            if(response == 1) {
                                var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                forEach( checked_reviews, function( node ) {       //      alert( node );
                                    jQuery("#comment-"+node+ ".row-actions .not_spam").css({"display" : "none"});
                                    jQuery("#comment-"+node+" .row-actions .spam").css({"display" : ""});
                                    jQuery("#comment-"+node+" .author p.spamer").css({"display" : "none"});
                                });
                            }
                       });
                    }
                        else {
                            if(apply_button_val == "trash") {
                                var data = {
                                    action: 'my_action',
                                    post: 'delanyreviews',
                                    reviews_for_delete: checked_reviews
                                };
                            }
                            jQuery.post(ajaxurl, data, function(response) {  //  alert(response);
                                if(response == 1) {
                                    var forEach = Function.prototype.call.bind( Array.prototype.forEach );
                                    forEach( checked_reviews, function( node ) {       //      alert( node );
                                          jQuery("#comment-"+node).remove();
                                    });
                                }
                           });
                       }
                }
            }
            
        });
    
</script>
<style>
    
#huge_it_catalog_revoews_page a {
    cursor: pointer;
}

#huge_it_catalog_revoews_page .reviews_textarea {
    resize: none;
    border: none;
    box-shadow: none;
    background-color: inherit;
    width: 100%;
}

#huge_it_catalog_revoews_page .author input {
    border: none;
    box-shadow: none;
    background-color: inherit;
    width: 100%;
}

#huge_it_catalog_revoews_page .spamer {
    color: #ff0000;
    margin-left: 6%;
}

#huge_it_catalog_revoews_page .not_spam a {
    color: #a00;
}

#huge_it_catalog_revoews_page .not_spam a:hover {
    color: #ff0000;
}

#poststuff h2 {
    margin-top: 0;
    padding-top: 0;
}

</style>

<?php } ?>