<?php
class spam_master_other_protection_table_firewall extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;
if(isset($_POST['update_firewall'])){
if(is_multisite()){
if (isset($_POST['spam_master_firewall_on'])){
update_blog_option($blog_id, 'spam_master_firewall_on', $_POST['spam_master_firewall_on'] );
}
else{
update_blog_option($blog_id, 'spam_master_firewall_on', 'false' );
}
}
else{
if (isset($_POST['spam_master_firewall_on'])){
update_option('spam_master_firewall_on', $_POST['spam_master_firewall_on'] );
}
else{
update_option('spam_master_firewall_on', 'false' );
}
}
?>
<div id="message" class="updated fade">
<p><?php _e('Firewall Settings Saved!', 'spam_master'); ?></p>
</div>
<?php
}

if(is_multisite()){
$spam_master_firewall_on = get_blog_option($blog_id, 'spam_master_firewall_on');
}
else{
$spam_master_firewall_on = get_option('spam_master_firewall_on');
}
//generate statuses
if($spam_master_firewall_on == 'true'){
	$spam_master_firewall_status = '<td style="vertical-align:middle; width:70%;"" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
}
else{
	$spam_master_firewall_status = '<td style="vertical-align:middle; width:70%;"" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
}
?>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Firewall', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="2"><small>End Firewall Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="2">
<p>These are optional settings.  Activating the firewall and the Alert 3 email adds an important protection layer to your <b>Wordpress</b> website.</p>
<p>The Firewall is a barrier designed to prevent unauthorized or unwanted communications between dangerous hosts and your website. It saves precious bandwidth for real users and blocks misfits.</p>
			</th>
		</tr>
		<tr>
			<td>
				<input name="spam_master_firewall_on" id="spam_master_firewall_on" value="true" type="checkbox" <?php echo $spam_master_firewall_on == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_firewall_on"><b><?php _e('Activate Wordpress Firewall', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_firewall_status; ?>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update_firewall' value='<?php _e("Save Firewall Settings", 'spam_master'); ?>' id='submitbutton' /></p>
</fieldset>
</form>
<?php
		}
}
