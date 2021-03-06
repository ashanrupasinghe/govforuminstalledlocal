<?php
/*
Simple:Press
Admin Toolbox Cron Inspector Form
$LastChangedDate: 2014-09-13 11:05:37 -0700 (Sat, 13 Sep 2014) $
$Rev: 11967 $
*/

if (preg_match('#'.basename(__FILE__).'#', $_SERVER['PHP_SELF'])) die('Access denied - you cannot directly call this file');

function spa_toolbox_cron_form() {
    $ahahURL = SFHOMEURL.'index.php?sp_ahah=toolbox-loader&amp;sfnonce='.wp_create_nonce('forum-ahah').'&amp;saveform=cron';
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
    	spjAjaxForm('sfcronform', 'sfcron');
    });
</script>
	<form action="<?php echo $ahahURL; ?>" method="post" id="sfcronform" name="sfcronform">
	<?php echo sp_create_nonce('forum-adminform_cron'); ?>
<?php
   	$cronData = spa_get_cron_data();

	spa_paint_options_init();
	spa_paint_open_tab(spa_text('Toolbox').' - '.spa_text('CRON Inspector'), true);
		spa_paint_open_panel();
			spa_paint_open_fieldset(spa_text('CRON Schedules'), false);
?>
                <table class="widefat fixed spMobileTable800">
                    <thead>
                        <tr>
                            <th style='text-align:center'><?php spa_etext('Name'); ?></th>
                            <th style='text-align:center'><?php spa_etext('Description'); ?></th>
                            <th style='text-align:center'><?php spa_etext('Interval'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
                    $class = 'class ="spMobileTableData"';
                    foreach ($cronData->schedules as $name => $schedule) {
?>
                        <tr <?php echo $class; ?>>
                            <td data-label='<?php spa_etext('Name'); ?>'><?php echo $name; ?></td>
                            <td data-label='<?php spa_etext('Description'); ?>'><?php echo $schedule['display']; ?></td>
                            <td data-label='<?php spa_etext('Interval'); ?>'><?php echo $schedule['interval']; ?></td>
                        </tr>
<?php
                       $class = (strpos($class, 'alternate') === false) ? 'class="spMobileTableData alternate"' : 'class="spMobileTableData"';
                    }
?>
                    </tbody>
                </table>
<?php
			spa_paint_close_fieldset();

			spa_paint_open_fieldset(spa_text('Active CRON'), false);
 ?>
                <table class="widefat fixed spMobileTable1280">
                    <thead>
                        <tr>
                            <th style='text-align:center'><?php spa_etext('Next Run (date)'); ?></th>
                            <th style='text-align:center'><?php spa_etext('Next Run (timestamp)'); ?></th>
                            <th style='text-align:center'><?php spa_etext('Schedule'); ?></th>
                            <th style='text-align:center'><?php spa_etext('Hook'); ?></th>
                            <th style='text-align:center'><?php spa_etext('Arguments'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
                    $class = 'class ="spMobileTableData"';
                    foreach ($cronData->cron as $time => $cron) {
                        foreach ($cron as $hook => $items) {
                            foreach ($items as $item) {
?>
                                <tr <?php echo $class; ?>>
                                    <td data-label='<?php spa_etext('Next Run (date)'); ?>'><?php echo $item['date']; ?></td>
                                    <td data-label='<?php spa_etext('Next Run (timestamp)'); ?>'><?php echo $time; ?></td>
                                    <td data-label='<?php spa_etext('Schedule'); ?>'>
<?php
                                        if ($item['schedule']) {
        								    echo $cronData->schedules[$item['schedule']]['display'];
                                        } else {
        								    spa_etext('One Time');
        								}
?>
                                    </td>
                                    <td data-label='<?php spa_etext('Hook'); ?>'>
<?php
                                        $sph = strncmp('sph_', $hook, 4 );
                                        if ($sph === 0) echo '<b>';
                                        echo $hook;
                                        if ($sph === 0) echo '</b>';
?>
                                    </td>
                                    <td data-label='<?php spa_etext('Arguments'); ?>'>
<?php
                                        if (count($item['args']) > 0) {
        									foreach ($item['args'] as $arg => $value) {
        										echo $arg.':'.$value.'<br />';
                                            }
                                        } else {
                                            echo '&nbsp;';
                                        }
?>
                                    </td>
                                </tr>
<?php
                                $class = (strpos($class, 'alternate') === false) ? 'class="spMobileTableData alternate"' : 'class="spMobileTableData"';
                            }
                        }
                    }
?>
                    </tbody>
                </table>
<?php
  			spa_paint_close_fieldset();
		spa_paint_close_panel();

		do_action('sph_toolbox_top_cron_panel');
		spa_paint_close_container();
		echo '<div class="sfform-panel-spacer"></div>';
	spa_paint_close_tab();

	echo '<div class="sfform-panel-spacer"></div>';

	spa_paint_open_tab(spa_text('Toolbox').' - '.spa_text('CRON Update'), true);
		spa_paint_open_panel();
			spa_paint_open_fieldset(spa_text('Add CRON'), true, 'cron-add');
				spa_paint_input(spa_text('Next Run Timestamp'), 'add-timestamp', '');
				spa_paint_input(spa_text('Interval'), 'add-interval', '');
				spa_paint_input(spa_text('Hook'), 'add-hook', '');
				spa_paint_input(spa_text('Arguments'), 'add-args', '');
  			spa_paint_close_fieldset();

			spa_paint_open_fieldset(spa_text('Run CRON'), true, 'cron-run');
				spa_paint_input(spa_text('Hook to run'), 'run-hook', '');
  			spa_paint_close_fieldset();
		spa_paint_close_panel();

		do_action('sph_toolbox_left_cron_panel');

		spa_paint_tab_right_cell();

		spa_paint_open_panel();
			spa_paint_open_fieldset(spa_text('Delete CRON'), true, 'cron-delete');
				spa_paint_input(spa_text('Next Run Timestamp'), 'del-timestamp', '');
				spa_paint_input(spa_text('Hook'), 'del-hook', '');
				spa_paint_input(spa_text('Arguments'), 'del-args', '');
  			spa_paint_close_fieldset();
		spa_paint_close_panel();

		do_action('sph_toolbox_right_cron_panel');
		spa_paint_close_container();
?>
	<div class="sfform-submit-bar">
	<input type="submit" class="button-primary" id="saveit" name="saveit" value="<?php spa_etext('Update CRON'); ?>" />
	</div>
<?php
	spa_paint_close_tab();
?>
	</form>
<?php
}
?>