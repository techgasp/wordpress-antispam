<?php
class spam_master_other_protection_table_learning extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;
//if($_POST['update_learning']){
//if(is_multisite()){
//if (isset($_POST['spam_master_learning_active'])){
//update_blog_option($blog_id, 'spam_master_learning_active', $_POST['spam_master_learning_active'] );
//}
//else{
//update_blog_option($blog_id, 'spam_master_learning_active', 'false' );
//}
//}
//else{
//if (isset($_POST['spam_master_learning_active'])){
//update_option('spam_master_learning_active', $_POST['spam_master_learning_active'] );
//}
//else{
//update_option('spam_master_learning_active', 'false' );
//}
//}
//}

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
		$learning_color = "07B357";
		$learning_status = "ONLINE";
	}
	else{
		$learning_color = "07B357";
		$learning_status = "ONLINE";
	}
}
//STATUS MALFUNCTION_1
if ($response_key == 'MALFUNCTION_1'){
	if( is_multisite() ){
		$learning_color = "563a3a";
		$learning_status = "MALFUNCTION_1 ONLINE";
	}
	else{
		$learning_color = "563a3a";
		$learning_status = "MALFUNCTION_1 ONLINE";
	}
}
//STATUS MALFUNCTION_2
if ($response_key == 'MALFUNCTION_2'){
	if( is_multisite() ){
		$learning_color = "563a3a";
		$learning_status = "MALFUNCTION_2 ONLINE";
	}
	else{
		$learning_color = "563a3a";
		$learning_status = "MALFUNCTION_2 ONLINE";
	}
}
//STATUS MALFUNCTION_3
if ($response_key == 'MALFUNCTION_3'){
	if( is_multisite() ){
		$learning_color = "525051";
		$learning_status = "MALFUNCTION_3 OFFLINE";
	}
	else{
		$learning_color = "525051";
		$learning_status = "MALFUNCTION_3 OFFLINE";
	}
}
//STATUS EXPIRED
if ($response_key == 'EXPIRED'){
	if( is_multisite() ){
		$learning_color = "525051";
		$learning_status = "OFFLINE";	
	}
	else{
		$learning_color = "525051";
		$learning_status = "OFFLINE";
	}
}
//STATUS INACTIVE, NO LICENSE SENT YET
if ($response_key == 'INACTIVE'){
	if( is_multisite() ){
		$learning_color = "563a3a";
		$learning_status = "OFFLINE";
	}
	else{
		$learning_color = "563a3a";
		$learning_status = "OFFLINE";
	}
}	
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Spam Learning', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="2"><small>End Spam Learning Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="2">
<p>Spam Learning is a powerful tool to combat spam, your website is automatically connected to spam fighting RBL Servers. In order to function, it needs an active RBL Server license.</p>
<p>If you are in a hurry to report spam or remove a wrong spam entry, you can do so manually using the 2 buttons below.</p>
			</th>
		</tr>
		<tr>
			<td>
				<a class="button-primary" href="https://spammaster.techgasp.com/add-threat/" target="_blank" title="Add Threat">Add Threat</a> 
				<a class="button-primary" href="https://spammaster.techgasp.com/remove-threat/" target="_blank" title="Remove Threat">Remove Threat</a>
			</td>
			<td style="vertical-align:middle; width:70%;" bgcolor="#<?php echo $learning_color; ?>"><font color="white"><b><?php echo $learning_status; ?></b></font></td>
		</tr>
	</tbody>
</table>
<!-- <p class="submit"><input class='button-primary' type='submit' name='update_learning' value='<?php _e("Save Learning Settings", 'spam_master'); ?>' id='submit_button' /></p>-->
<?php
		}
}
