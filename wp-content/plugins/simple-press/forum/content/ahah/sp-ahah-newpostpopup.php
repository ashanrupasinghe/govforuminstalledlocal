<?php
/*
Simple:Press
Users New Posts Popup
$LastChangedDate: 2015-09-20 11:49:23 -0700 (Sun, 20 Sep 2015) $
$Rev: 13488 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

sp_forum_api_support();

global $spThisUser, $spListView, $spThisListTopic;

$popup = 1;

if (!isset($_GET['action'])) die();
if (isset($_GET['popup'])) $popup = sp_esc_int($_GET['popup']);
$count = (isset($_GET['count'])) ? sp_esc_int($_GET['count']) : 0;

# Individual forum new post listing
if ($_GET['action'] == 'forum') {
	if (isset($_GET['id'])) {
		$fid = (int) $_GET['id'];
		$topics = array();
		for ($x=0; $x<count($spThisUser->newposts['forums']); $x++) {
			if ($spThisUser->newposts['forums'][$x] == $fid) $topics[] = $spThisUser->newposts['topics'][$x];
		}

		if ($popup) echo '<div id="spMainContainer">';
        $first = sp_esc_int($_GET['first']);
        $group = isset($_GET['group']) ? sp_esc_int($_GET['group']) : false;
		$spListView = new spTopicList($topics, $count, $group, '', $first, $popup, 'forum unread posts');

		sp_load_template('spListView.php');
		if ($popup) echo '</div>';
	}
}

# All forums (users new post list)
if ($_GET['action'] == 'all') {
	echo '<div id="spMainContainer">';
    $first = sp_esc_int($_GET['first']);
    $group = sp_esc_int($_GET['group']);
	$spListView = new spTopicList($spThisUser->newposts['topics'], $count, $group, '', $first, $popup, 'all unread posts');

	sp_load_template('spListView.php');
	echo '</div>';
}

if ($_GET['action'] == 'mark-read') {
    sp_mark_all_read();

    die();
}

if ($_GET['action'] == 'mark-forum-read') {
    $forum = (empty($_GET['forum'])) ? '' : sp_esc_int($_GET['forum']);
    if (empty($forum)) die();

    sp_mark_forum_read($forum);

    die();
}

die();
?>