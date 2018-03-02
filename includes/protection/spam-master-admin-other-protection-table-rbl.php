<?php
class spam_master_other_protection_table_rbl extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;	
//GET RESPONSE KEY TO GENERATE
if( is_multisite() ){
$response_key = get_blog_option($blog_id, 'spam_master_status');
}
else{
$response_key = get_option('spam_master_status');
}
///STATUS VALID
if ($response_key == 'VALID'){
	if( is_multisite() ){
		$full_rbl_color = "07B357";
		$full_rbl_status = "OPTIMAL CONNECTION";
	}
	else{
		$full_rbl_color = "07B357";
		$full_rbl_status = "OPTIMAL CONNECTION";
	}
}
//STATUS MALFUNCTION_1
if ($response_key == 'MALFUNCTION_1'){
	if( is_multisite() ){
		$full_rbl_color = "563a3a";
		$full_rbl_status = "MALFUNCTION_1 CONNECTION";
	}
	else{
		$full_rbl_color = "563a3a";
		$full_rbl_status = "MALFUNCTION_1 CONNECTION";
	}
}
//STATUS MALFUNCTION_2
if ($response_key == 'MALFUNCTION_2'){
	if( is_multisite() ){
		$full_rbl_color = "563a3a";
		$full_rbl_status = "MALFUNCTION_2 CONNECTION";
	}
	else{
		$full_rbl_color = "563a3a";
		$full_rbl_status = "MALFUNCTION_2 CONNECTION";
	}
}
//STATUS MALFUNCTION_3
if ($response_key == 'MALFUNCTION_3'){
	if( is_multisite() ){
		$full_rbl_color = "525051";
		$full_rbl_status = "MALFUNCTION_3 DISCONNECTED";
	}
	else{
		$full_rbl_color = "525051";
		$full_rbl_status = "MALFUNCTION_3 DISCONNECTED";
	}
}
//STATUS EXPIRED
if ($response_key == 'EXPIRED'){
	if( is_multisite() ){
		$full_rbl_color = "525051";
		$full_rbl_status = "DISCONNECTED";	
	}
	else{
		$full_rbl_color = "525051";
		$full_rbl_status = "DISCONNECTED";
	}
}
//STATUS INACTIVE, NO LICENSE SENT YET
if ($response_key == 'INACTIVE'){
	if( is_multisite() ){
		$full_rbl_color = "563a3a";
		$full_rbl_status = "DISCONNECTED";
	}
	else{
		$full_rbl_color = "563a3a";
		$full_rbl_status = "DISCONNECTED";
	}
}
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;RBL Servers', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="2"><small>End RBL Servers Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="2">
<p>The RBL Servers status should be online if you have a valid RBL license.</p>
<p>You can check detailed statistics of the servers status by clicking the button below.</p>
<p><a class="button-secondary" href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="Visit Website">get rbl protection license</a> <a class="button-primary" href="https://spammaster.techgasp.com/rbl-servers-status/" target="_blank" title="RBL Servers Status">RBL Servers Status</a> </p>
			</th>
		</tr>
		<tr>
			<td style="width:30%;">Primary RBL Server Cluster</td>
			<td style="vertical-align:middle" bgcolor="#<?php echo $full_rbl_color; ?>"><font color="white"><b><?php echo $full_rbl_status; ?></b></font>
			</td>
		<tr>
				<tr>
			<td style="width:30%;">Secondary RBL Server Cluster</td>
			<td style="vertical-align:middle" bgcolor="#<?php echo $full_rbl_color; ?>"><font color="white"><b><?php echo $full_rbl_status; ?></b></font>
		</tr>
	</tbody>
</table>
<?php
		}
}
