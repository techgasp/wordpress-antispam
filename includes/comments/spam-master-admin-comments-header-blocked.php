<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_comments_header_blocked extends WP_List_Table {
	function display() {
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Comments by Spam Master', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<td>Many comments are blocked via Firewall, remember to take a look at Spam Master Firewall page for more stats.</td>
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
