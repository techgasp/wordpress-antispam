<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_firewall_header_blocked extends WP_List_Table {
	function display() {
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Spam Master Firewall Blocks', 'spam_master'); ?></h2><p>Contains up to a week of data. Older data is automatically purged to keep your <b>database "slim"</b> and your website with <b>fast page load times</b>.</p></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
		</tr>
	</tfoot>

	<tbody>
		<tr>
		</tr>
	</tbody>
</table>
<?php
		}
}
