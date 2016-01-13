<?php
/*
Simple:Press
Admin Forums Data Prep Support Functions
$LastChangedDate: 2015-08-03 20:00:33 -0700 (Mon, 03 Aug 2015) $
$Rev: 13242 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function spa_paint_custom_icons() {
	global $spPaths;

	$out = '';

	# Open custom icons folder and get cntents for matching
	$path = SF_STORE_DIR.'/'.$spPaths['custom-icons'].'/';
	$dlist = @opendir($path);
	if (!$dlist) {
		echo '<table><tr><td class="sflabel"><strong>'.spa_text('The custom icons folder does not exist').'</strong></td></tr></table>';
		return;
	}

	# start the table display
	$out.= '<table class="wp-list-table widefat"><tr>';
	$out.= '<th style="width:30%;text-align:center">'.spa_text('Icon').'</th>';
	$out.= '<th style="width:50%;text-align:center">'.spa_text('Filename').'</th>';
	$out.= '<th style="text-align:center">'.spa_text('Remove').'</th>';
	$out.= '</tr>';

    $out.= '<tr><td colspan="3">';
    $out.= '<div id="sf-custom-icons">';

    $row = 0;
	while (false !== ($file = readdir($dlist))) {
		if ($file != '.' && $file != '..') {

			$found = false;
		    $out.= '<table id="icon'.$row.'" style="width:100%">';
			$out.= '<tr>';
			$out.= '<td style="text-align:center;width:30%" class="spWFBorder"><img class="sfcustomicon " src="'.esc_url(SFCUSTOMURL.'/'.$file).'" alt="" /></td>';
			$out.= '<td style="text-align:center;width:50%"  class="spWFBorder sflabel">';
			$out.= $file;
			$out.= '</td>';
			$out.= '<td style="text-align:center"  class="spWFBorder">';
			$site = esc_url(SFHOMEURL.'index.php?sp_ahah=forums&amp;sfnonce='.wp_create_nonce('forum-ahah')."&amp;action=delicon&amp;file=$file");
			$out.= '<img src="'.SFCOMMONIMAGES.'delete.png" title="'.spa_text('Delete custom icon').'" alt="" onclick="spjDelRow(\''.$site.'\', \'icon'.$row.'\');" />';
			$out.= '</td>';
			$out.= '</tr>';
			$out.= '</table>';

            $row++;
		}
	}
	$out.= '</div>';
	$out.= '</td></tr></table>';
	echo '<input type="hidden" id="icon-count" name="icon-count" value="'.$row.'" />';
	closedir($dlist);

	echo $out;
}

function spa_paint_featured_images() {
	global $spPaths;

	$out = '';

	# Open forum images folder and get contents for matching
	$path = SF_STORE_DIR.'/'.$spPaths['forum-images'].'/';
	$dlist = @opendir($path);
	if (!$dlist) {
		echo '<table><tr><td class="sflabel"><strong>'.spa_text('The forum feauted images folder does not exist').'</strong></td></tr></table>';
		return;
	}

	# start the table display
	$out.= '<table class="wp-list-table widefat"><tr>';
	$out.= '<th style="width:30%;text-align:center">'.spa_text('Image').'</th>';
	$out.= '<th style="width:50%;text-align:center">'.spa_text('Filename').'</th>';
	$out.= '<th style="text-align:center">'.spa_text('Remove').'</th>';
	$out.= '</tr>';

    $out.= '<tr><td colspan="3">';
    $out.= '<div id="sf-featured-images">';
	while (false !== ($file = readdir($dlist))) {
		if ($file != '.' && $file != '..') {
			$found = false;
		    $out.= '<table style="width:100%">';
			$out.= '<tr>';
			$out.= '<td style="text-align:center;width:30%" class="spWFBorder"><img class="sffeaturedimage " src="'.esc_url(SFFEATUREDURL.'/'.$file).'" alt="" /></td>';
			$out.= '<td style="text-align:center;width:50%"  class="spWFBorder sflabel">';
			$out.= $file;
			$out.= '</td>';
			$out.= '<td style="text-align:center"  class="spWFBorder">';
			$site = esc_url(SFHOMEURL.'index.php?sp_ahah=forums&amp;sfnonce='.wp_create_nonce('forum-ahah')."&amp;action=delimage&amp;file=$file");
			$out.= '<img src="'.SFCOMMONIMAGES.'delete.png" title="'.spa_text('Delete featured image').'" alt="" onclick="spjDelRowReload(\''.$site.'\', \'sfreloadfi\');" />';
			$out.= '</td>';
			$out.= '</tr>';
			$out.= '</table>';
		}
	}
	$out.= '</div>';
	$out.= '</td></tr></table>';
	closedir($dlist);

	echo $out;
}

?>