<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_registrations_header_blocked extends WP_List_Table {
	function display() {
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th>
				<h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Registrations Blocked by Spam Master', 'spam_master'); ?></h2>
				<p>Contains up to a week of data. Older data is automatically purged to keep your <b>database "slim"</b> and your website with <b>fast page load times</b>.</p>
				<p>Many registration attempts are blocked via Firewall, remember to take a look at Spam Master Firewall page and look for wp-login.php.</p>
			</th>
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
