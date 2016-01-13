<?php
/*
Simple:Press
Forum Tools Links
$LastChangedDate: 2015-12-02 07:06:22 -0800 (Wed, 02 Dec 2015) $
$Rev: 13630 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

sp_forum_api_support();

$fid = '';
if (isset($_GET['forum'])) $fid = sp_esc_int($_GET['forum']);

# get out of here if no action specified
if (empty($_GET['action'])) die();
$action = $_GET['action'];

if ($action == 'topictools') {
	# admins topic tool set
	$tid = sp_esc_int($_GET['topic']);
	$page = sp_esc_int($_GET['page']);
	if (empty($fid) || empty($tid)) die();
	$forum = spdb_table(SFFORUMS, "forum_id=$fid", 'row', '', '', ARRAY_A);
	$topic = spdb_table(SFTOPICS, "topic_id=$tid", 'row', '', '', ARRAY_A);
	echo sp_render_topic_tools($topic, $forum, $page);
	die();
}

if ($action == 'posttools') {
	# admins post tool set
	$postid = sp_esc_int($_GET['post']);
	$page = sp_esc_int($_GET['page']);
	$postnum = sp_esc_int($_GET['postnum']);
	$displayname = esc_html(urldecode($_GET['name']));
	$last = sp_esc_int($_GET['last']);
	if (empty($postid)) die();
	$post = spdb_table(SFPOSTS, "post_id=$postid", 'row', '', '', ARRAY_A);
	$forum = spdb_table(SFFORUMS, "forum_id=".$post['forum_id'], 'row', '', '', ARRAY_A);
	$topic = spdb_table(SFTOPICS, "topic_id=".$post['topic_id'], 'row', '', '', ARRAY_A);

	# establish email
	if ($post['user_id']==NULL || $post['user_id']==0) {
		$useremail = '';
		$guestemail = sp_filter_email_display($post['guest_email']);
	} else {
		$useremail = sp_filter_email_display(spdb_table(SFUSERS, 'ID='.$post['user_id'], 'user_email'));
		$guestemail = '';
	}
	echo sp_render_post_tools($post, $forum, $topic, $page, $postnum, $useremail, $guestemail, $displayname, $last);
	die();
}
die();

# Forum Tools - Topic View
function sp_render_post_tools($post, $forum, $topic, $page, $postnum, $useremail, $guestemail, $displayname, $last) {
	global $spThisUser;

	$br = (current_theme_supports('sp-theme-responsive')) ? '<br />' : '';
	$out = '';

	$out.= '<div id="spMainContainer" class="spForumToolsPopup">';
	$out.= '<div class="spAdminLinksPopup">';
	$out.= '<div class="spForumToolsHeader">';
	$out.= '<div class="spForumToolsHeaderTitle">'.sp_filter_title_display($topic['topic_name']).'</div>';
	$out.= '<div class="spForumToolsHeaderTitle">'.sp_text('Post').' #'.$postnum.'</div>';
	$out.= '</div>';

	$out.= sp_open_grid();

	$out.= sp_render_common_tools($forum, $topic, $post, $page, $br);

	if (($post['post_status'] != 0) && sp_get_auth('moderate_posts', $forum['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsModerate">';
		$out.= '<a href="javascript:document.postapprove'.$post['post_id'].'.submit();">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsApprove.png').$br;
		$out.= sp_text('Approve this post').'</a>';
		$out.= '<form action="'.sp_build_url($forum['forum_slug'], $topic['topic_slug'], $page, $post['post_id'], $post['post_index']).'" method="post" name="postapprove'.$post['post_id'].'">';
		$out.= '<input type="hidden" name="approvepost" value="'.$post['post_id'].'" />';
		$out.= '</form>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (($post['post_status'] == 0) && sp_get_auth('moderate_posts', $forum['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsModerate">';
		$out.= '<a href="javascript:document.unapprovepost'.$post['post_id'].'.submit();">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsUnapprove.png').$br;
		$out.= sp_text('Unapprove this post').'</a>';
		$out.= '<form action="'.sp_build_url($forum['forum_slug'], $topic['topic_slug'], $page, $post['post_id'], $post['post_index']).'" method="post" name="unapprovepost'.$post['post_id'].'">';
		$out.= '<input type="hidden" name="unapprovepost" value="'.$post['post_id'].'" />';
		$out.= '</form>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('view_email', $forum['forum_id'])) {
		$email = (!empty($useremail)) ? $useremail : $guestemail;
		$content = '';
		if ($post['user_id']) {
			$content.= '<div>'.sp_text('User ID').': '.$post['user_id'].' - '.$displayname.'</div>';
		} else {
			$content.= '<div>'.sp_text('Guest').'</div>';
		}
		$content.= '<div>'.$email.'</div><div>'.$post['poster_ip'].'</div>';
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsEmail">';
		$title = sp_text("Users email and IP");
		$out.= '<a href="javascript:void(null)" onclick="spjDialogHtml(this, \''.$content.'\', \''.esc_js($title).'\', 300, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsEmail.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('pin_posts', $forum['forum_id'])) {
		$pintext = ($post['post_pinned']) ? sp_text('Unpin this post') : sp_text('Pin this post');
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsPin">';
		$ajaxUrl = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=pin-post&amp;post='.$post['post_id'];
		$out.= "<a href='javascript:void(null)' onclick='spjPinPost(\"$ajaxUrl\");'>";
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsPin.png').$br;
		$out.= $pintext.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if ($spThisUser->admin) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsOrder">';
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=sort-topic&amp;topicid='.$topic['topic_id'];
		$out.= '<a href="javascript:void(null)" onclick="spjLoadTool(\''.$site.'\', \'spMainContainer\', \'\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsSort.png').$br;
		$out.= sp_text('Reverse sort this topic').'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	$edit_days = sp_get_option('editpostdays');
	$post_date = strtotime(sp_date('d', $post['post_date']));
	$date_diff = floor((time() - $post_date) / (60 * 60 * 24));
	if (sp_get_auth('edit_any_post', $forum['forum_id']) ||
	   ($post['user_id'] == $spThisUser->ID &&
			(sp_get_auth('edit_own_posts_forever', $forum['forum_id']) ||
			(sp_get_auth('edit_own_posts_reply', $forum['forum_id']) && $last) ||
			(sp_get_auth('edit_own_posts_for_time', $forum['forum_id']) && $date_diff <= $edit_days)))) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsEdit">';
		$out.= '<a href="javascript:document.admineditpost'.$post['post_id'].'.submit();">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsEdit.png').$br;
		$out.= sp_text('Edit this post').'</a>';
		$out.= '<form action="'.sp_build_url($forum['forum_slug'], $topic['topic_slug'], $page, $post['post_id'], $post['post_index']).'" method="post" name="admineditpost'.$post['post_id'].'">';
		$out.= '<input type="hidden" name="postedit" value="'.$post['post_id'].'" />';
		$out.= '</form>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('delete_any_post', $post['forum_id']) || sp_get_auth('delete_own_posts', $forum['forum_id']) && $spThisUser->ID == $post['user_id']) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsDelete">';
		$msg = esc_js(sp_text('Are you sure you want to delete this post?'));
		$ajaxUrl = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=delete-post&amp;killpost='.$post['post_id'].'&amp;killposttopic='.$post['topic_id'].'&amp;killpostforum='.$post['forum_id'].'&amp;killpostposter='.$post['user_id'].'&amp;page='.$page;
		$out.= "<a href='javascript:void(null)' onclick='spjDeletePost(\"$ajaxUrl\", {$post['post_id']}, {$post['topic_id']});'>";
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsDelete.png').$br;
		$out.= sp_text('Delete this post').'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('move_posts', $post['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsMove">';
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=move-post&amp;id='.$post['topic_id'].'&amp;pid='.$post['post_id'].'&amp;pix='.$post['post_index'];
		$title = sp_text('Move this post');
		$out.= '<a rel="nofollow" href="javascript:void(null)" onclick="spjDialogAjax(this, \''.$site.'\', \''.esc_js($title).'\', 400, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsMove.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('reassign_posts', $post['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsReassign">';
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=reassign&amp;id='.$post['topic_id'].'&amp;pid='.$post['post_id'].'&amp;uid='.$post['user_id'];
		$title = sp_text('Reassign this post');
		$out.= '<a rel="nofollow" href="javascript:void(null)" onclick="spjDialogAjax(this, \''.$site.'\', \''.esc_js($title).'\', 400, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsReassign.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if ($spThisUser->admin || $spThisUser->moderator) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsNofity">';
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=notify&amp;pid='.$post['post_id'];
		$title = sp_text('Notify user');
		$out.= '<a rel="nofollow" href="javascript:void(null)" onclick="spjDialogAjax(this, \''.$site.'\', \''.esc_js($title).'\', 400, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsNotify.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	# do filter now so the properties is always the last tool
	$out = apply_filters('sph_add_post_tool', $out, $post, $forum, $topic, $page, $postnum, $useremail, $guestemail, $displayname, $br);

	if ($spThisUser->admin || $spThisUser->moderator) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsProperties">';
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=properties&amp;forum='.$post['forum_id'].'&amp;topic='.$post['topic_id'].'&amp;post='.$post['post_id'];
		$title = sp_text('View properties');
		$out.= '<a rel="nofollow" href="javascript:void(null)" onclick="spjDialogAjax(this, \''.$site.'\', \''.esc_js($title).'\', 400, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsProperties.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

//	$out.= '</div>';
	$out.= sp_close_grid();
$out.= '</div></div>';

	$out = apply_filters('sph_post_tools', $out, $post, $forum, $topic, $page, $postnum, $useremail, $guestemail, $displayname, $br);

	return $out;
}

# Forum Tools - Forum View
function sp_render_topic_tools($topic, $forum, $page) {
	global $spThisUser;

	$br = (current_theme_supports('sp-theme-responsive')) ? '<br />' : '';
	$topicname = urlencode(sp_filter_title_display($topic['topic_name']));

	$out = '';

	$out.= '<div id="spMainContainer" class="spForumToolsPopup">';
	$out.= '<div class="spAdminLinksPopup">';
	$out.= '<div class="spForumToolsHeader">';
	$out.= '<div class="spForumToolsHeaderTitle">'.sp_filter_title_display($topic['topic_name']).'</div>';
	$out.= '</div>';

	$out.= sp_open_grid();

	$out.= sp_render_common_tools($forum, $topic, '', $page, $br);

	if ($spThisUser->admin) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsOrder">';
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=sort-forum&amp;forumid='.$forum['forum_id'];
		$out.= '<a href="javascript:void(null)" onclick="spjLoadTool(\''.$site.'\', \'spMainContainer\', \'\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsSort.png').$br;
		$out.= sp_text('Reverse sort this forum').'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	# add filter now so that propeties is always the bottom tool
	$out = apply_filters('sph_add_topic_tool', $out, $topic, $forum, $page, $br);

	if ($spThisUser->admin || $spThisUser->moderator) {
		$out.= sp_open_grid_cell();
		$title = sp_text('View properties');
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=properties&amp;group='.$forum['group_id'].'&amp;forum='.$forum['forum_id'].'&amp;topic='.$topic['topic_id'];
		$out.= '<div class="spForumToolsProperties">';
		$out.= '<a rel="nofollow" href="javascript:void(null)" onclick="spjDialogAjax(this, \''.$site.'\', \''.esc_js($title).'\', 400, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsProperties.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	$out.= sp_close_grid();

	$out.= '</div></div>';

	$out = apply_filters('sph_topic_tools', $out, $topic, $forum, $page, $br);

	return $out;
}

function sp_render_common_tools($forum, $topic, $post=0, $page=0, $br) {
	global $spThisUser;

	$out = '';

	if (sp_get_auth('lock_topics', $forum['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsLock">';
		$locktext = ($topic['topic_status']) ? sp_text('Unlock this topic') : sp_text('Lock this topic');
		$ajaxUrl = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=lock-topic&amp;topic='.$topic['topic_id'];
		$out.= "<a href='javascript:void(null)' onclick='spjLockTopic(\"$ajaxUrl\");'>";
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsLock.png').$br;
		$out.= $locktext.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('pin_topics', $forum['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsPin">';
		$pintext = ($topic['topic_pinned']) ? sp_text('Unpin this topic') : sp_text('Pin this topic');
		$ajaxUrl = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=pin-topic&amp;topic='.$topic['topic_id'];
		$out.= "<a href='javascript:void(null)' onclick='spjPinTopic(\"$ajaxUrl\");'>";
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsPin.png').$br;
		$out.= $pintext.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('pin_topics', $forum['forum_id']) && $topic['topic_pinned']) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsPin">';
		$pintext = sp_text('Promote this pinned topic');
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=order-pins&amp;topicid='.$topic['topic_id'].'&amp;forumid='.$forum['forum_id'].'&amp;userid='.$topic['user_id'];
		$title = sp_text('Order Pinned Topics');
		$out.= '<a rel="nofollow" href="javascript:void(null)" onclick="spjDialogAjax(this, \''.$site.'\', \''.esc_js($title).'\', 400, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsPin.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if ((sp_get_auth('edit_own_topic_titles', $forum['forum_id']) && $topic['user_id'] == $spThisUser->ID) || sp_get_auth('edit_any_topic_titles', $forum['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsEdit">';
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=edit-title&amp;topicid='.$topic['topic_id'].'&amp;forumid='.$forum['forum_id'].'&amp;userid='.$topic['user_id'];
		$title = sp_text('Edit topic title');
		$out.= '<a rel="nofollow" href="javascript:void(null)" onclick="spjDialogAjax(this, \''.$site.'\', \''.esc_js($title).'\', 400, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsEdit.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('delete_topics', $forum['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsDelete">';
		$msg = esc_js(sp_text('Are you sure you want to delete this topic?'));
		$view = (!empty($post)) ? 'topic' : 'forum';
		$ajaxUrl = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=delete-topic&amp;killtopic='.$topic['topic_id'].'&amp;killtopicforum='.$forum['forum_id'].'&amp;page='.$page."&amp;view=$view";
		$out.= "<a href='javascript:void(null)' onclick='spjDeleteTopic(\"$ajaxUrl\", {$topic['topic_id']}, {$forum['forum_id']});'>";
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsDelete.png').$br;
		$out.= sp_text('Delete this topic').'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}

	if (sp_get_auth('move_topics', $forum['forum_id'])) {
		$out.= sp_open_grid_cell();
		$out.= '<div class="spForumToolsMove">';
		$site = SFHOMEURL.'index.php?sp_ahah=admintools&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;action=move-topic&amp;topicid='.$topic['topic_id'].'&amp;forumid='.$forum['forum_id'];
		$title = sp_text('Move this topic');
		$out.= '<a rel="nofollow" href="javascript:void(null)" onclick="spjDialogAjax(this, \''.$site.'\', \''.esc_js($title).'\', 400, 0, \'center\');">';
		$out.= sp_paint_icon('spIcon', SPTHEMEICONSURL, 'sp_ToolsMove.png').$br;
		$out.= $title.'</a>';
		$out.= '</div>';
		$out.= sp_close_grid_cell();
	}
	$out = apply_filters('sph_add_common_tools', $out, $forum, $topic, $post, $page, $br);

	return $out;
}

die();

?>