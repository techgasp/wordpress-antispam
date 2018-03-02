<?php
class spam_master_other_protection_table_clean extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;
if(isset($_POST['update_clean_comments'])){
if(is_multisite()){
	if (isset($_POST['spam_master_comments_clean'])){
	update_blog_option($blog_id, 'spam_master_comments_clean', $_POST['spam_master_comments_clean'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_comments_clean', 'false' );
	}
}
else{
	if (isset($_POST['spam_master_comments_clean'])){
	update_option('spam_master_comments_clean', $_POST['spam_master_comments_clean'] );
	}
	else{
	update_option('spam_master_comments_clean', 'false' );
	}
}
?>
<div id="message" class="updated fade">
<p><?php _e('Clean-Up Settings Saved!', 'spam_master'); ?></p>
</div>
<?php
}

if(isset($_POST['update_spam_master_whitelist'])){
	//prepare whitelist
	$spam_master_array_whitelist = array_merge(explode("\n", $_POST['spam_master_whitelist']));
	$spam_master_array = array_map("trim", $spam_master_array_whitelist);
	sort ($spam_master_array);
	//prepare blacklist
	if(is_multisite()){
		$spam_master_blacklist = get_blog_option($blog_id, 'blacklist_keys');
	}
	else{
		$spam_master_blacklist = get_option('blacklist_keys');
	}
	$spam_master_array_blacklist = array_merge(explode("\n", $spam_master_blacklist));
	$spam_master_array_b = array_map("trim", $spam_master_array_blacklist);
	sort ($spam_master_array_b);
	$spam_master_array_b_delete = array_diff($spam_master_array_b, $spam_master_array);
	//lets save
	$spam_master_b_string = implode("\n", array_unique($spam_master_array_b_delete));
	$spam_master_string = implode("\n", array_unique($spam_master_array));
	//add to buffer	ip and email
	if(is_multisite()){
		update_blog_option($blog_id, 'spam_master_whitelist', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
		update_blog_option($blog_id, 'blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_b_string))));
	}
	else{
		update_option('spam_master_whitelist', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
		update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_b_string))));
	}
?>
<div id="message" class="updated fade">
<p><?php _e('Spam Buffer Whitelist Updated!', 'spam_master'); ?></p>
</div>
<?php
}

if(isset($_POST['spam_master_clean_spam_buffer_go'])){
//DELETE
if (!empty($_POST['spam_master_clean_spam_buffer'])){
	$spam_master_clean_spam_buffer = 'true';
}
else{
	$spam_master_clean_spam_buffer = 'false';
}
//Start Processing
	if ($spam_master_clean_spam_buffer == 'true'){
		if(is_multisite()){
			delete_blog_option($blog_id, 'blacklist_keys');
		}
		else{
			delete_option('blacklist_keys');
		}
		?>
		<div id="message" class="updated fade">
		<p><strong><?php _e('Spam Buffer is Clean', 'spam_master'); ?></strong></p>
		</div>
		<?php
	}
	else{
		?>
		<div class="notice notice-error is-dismissible">
		<p><strong><?php _e('Checkbox not Selected! Spam Buffer is not Clean.', 'spam_master'); ?></strong></p>
		</div>
		<?php
	}
//END POST
}
else{
}

if(is_multisite()){
$spam_master_comments_clean = get_blog_option($blog_id, 'spam_master_comments_clean');
	if($spam_master_comments_clean == 'true'){
		$spam_master_comments_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_comments_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
$spam_master_whitelist = get_blog_option($blog_id, 'spam_master_whitelist');
	if(empty($spam_master_whitelist)){
		$spam_master_whitelist = 'Your Spam Buffer Whitelist is empty. Insert emails or ips from frequent commenters that you know are safe.';
	}
	else{
		$spam_master_whitelist = $spam_master_whitelist;
	}	
}
else{
$spam_master_comments_clean = get_option('spam_master_comments_clean');

	if($spam_master_comments_clean == 'true'){
		$spam_master_comments_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_comments_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
$spam_master_whitelist = get_option('spam_master_whitelist');
	if(empty($spam_master_whitelist)){
		$spam_master_whitelist = 'Your Spam Buffer Whitelist is empty. Insert emails or ips from frequent commenters that are safe.';
	}
	else{
		$spam_master_whitelist = $spam_master_whitelist;
	}
}

//Clean Spam Buffer Button
function spam_master_clean_spam_buffer(){
	//echo plugins_url( 'spam-master-admin-clean-spam-buffer.php', __FILE__);
}
?>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Clean-Up', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="2"><small>End Clean-Up Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="2">
<p>These are optional settings. Activate Comments Clean-Up will automatically compare your spam buffer threat list with older comments that are Approved or Pending. If match exists, these comments are automatically moved from Approved or Pending to Trash.</p>
			</th>
		</tr>
		<tr>
			<td>
				<input name="spam_master_comments_clean" id="spam_master_comments_clean" value="true" type="checkbox" <?php echo $spam_master_comments_clean == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_comments_clean"><b><?php _e('Activate Comments Clean-Up', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_comments_status; ?>
		</tr>
		<tr>
			<td style="width:30%;">
				<p class="submit"><input class='button-primary' type='submit' name='update_clean_comments' value='<?php _e("Save Auto Clean-Up", 'spam_master'); ?>' id='submit_button' /></p>
			</td>
			<td style="width:70%;"></td>
		</tr>
			<th colspan="2">
<p>Spam Buffer Whitelisting excludes spam checks in comments from safe emails or ip's. It also removes these safe emails and ip's from your Spam Buffer allowing these users to comment freely.</p>
			</th>
		<tr>
			<td style="width:30%;">
<textarea rows="15" name="spam_master_whitelist" id="spam_master_whitelist" style="width:100%;">
<?php echo $spam_master_whitelist; ?>
</textarea>
			</td>
			<td style="vertical-align:top; width:70%;">
				<h2>Spam Buffer Whitelist</h2>
				<p>Insert emails or ips from frequent commenter's that are safe.</p>
				<p>Important, insert 1 per line and press below Save Settings.</p>
				<br>
				<p>You can check you wordpress native comments to get emails and ips.</p>
				<br>
				<p>Whitelisting will also delete the email or ip from your spam buffer <b>but not from online RBL Servers</b>. Make sure you remove them.</p>
				<p><a href="https://spammaster.techgasp.com/remove-threat/" target="_blank"><img src="<?php echo plugins_url('../images/check-fail.png', dirname(__FILE__)); ?>" style="height:24px; vertical-align:middle;" > RBL Removal</a> <a href="https://spammaster.techgasp.com/search-threat/" target="_blank"><a href="https://spammaster.techgasp.com/search-threat/" target="_blank"><img src="<?php echo plugins_url('../images/check-threat.png', dirname(__FILE__)); ?>" style="height:24px; vertical-align:middle;" > RBL Search</a></p>
				<br>
				<p class="submit"><input class='button-primary' type='submit' name='update_spam_master_whitelist' value='<?php _e("Save & Refresh Whitelist", 'spam_master'); ?>' id='submit_button' /></p>
			</td>
		</tr>
			<th colspan="2">
<p>In extreme cases the Clean Spam Buffer button allows you to clean your blog fast memory access of previously detected spam threats but it will not remove entries in online RBL Servers.</p>
			</th>
		<tr>
			<td><input name="spam_master_clean_spam_buffer" id="spam_master_clean_spam_buffer" value="true" type="checkbox" /><label for="spam_master_clean_spam_buffer">Check & Press Clean Spam Buffer</label></td>
			<td bgcolor="#563a3a"><input class='button-primary' type='submit' name='spam_master_clean_spam_buffer_go' value='<?php _e("Clean Spam Buffer", 'spam_master'); ?>' id='submitbutton' /></td>
		</tr>
	</tbody>
</table>
</fieldset>
</form>
<?php
		}
}
