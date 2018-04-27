<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_admin_table_support extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
function display() {
	//Export Button
	function spam_master_load_support_data_export(){
		echo plugins_url( 'spam-master-admin-table-support-export.php', __FILE__);
	}
?>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Support', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th><a class="button-primary" href="<?php spam_master_load_support_data_export() ?>" title="Export Support Data">Export Support Data</a></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td>Are you in trouble?</td>
		</tr>
		<tr class="alternate">
			<td>Click -> Export Support Data button and create a <a href="https://wordpress.techgasp.com/support/" target="_blank" title="TechGasp Support"><em>Support Ticket</em></a> at TechGasp Website attaching the plugin_info.txt file to the ticket.</td>
		</tr>
	</tbody>
</table>
</fieldset>
</form>
<?php
//end func
}
//end class
}
