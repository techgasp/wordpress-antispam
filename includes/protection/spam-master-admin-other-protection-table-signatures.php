<?php
class spam_master_other_protection_table_signatures extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;
//Save data	
if(isset($_POST['update_signatures'])){
if(is_multisite()){
if (isset($_POST['spam_master_signature_registration'])){
update_blog_option($blog_id, 'spam_master_signature_registration', $_POST['spam_master_signature_registration'] );
}
else{
update_blog_option($blog_id, 'spam_master_signature_registration', 'false' );
}
if (isset($_POST['spam_master_signature_login'])){
update_blog_option($blog_id, 'spam_master_signature_login', $_POST['spam_master_signature_login'] );
}
else{
update_blog_option($blog_id, 'spam_master_signature_login', 'false' );
}
if (isset($_POST['spam_master_signature_comments'])){
update_blog_option($blog_id, 'spam_master_signature_comments', $_POST['spam_master_signature_comments'] );
}
else{
update_blog_option($blog_id, 'spam_master_signature_comments', 'false' );
}
if (isset($_POST['spam_master_signature_email'])){
update_blog_option($blog_id, 'spam_master_signature_email', $_POST['spam_master_signature_email'] );
}
else{
update_blog_option($blog_id, 'spam_master_signature_email', 'false' );
}
}
else{
if (isset($_POST['spam_master_signature_registration'])){
update_option('spam_master_signature_registration', $_POST['spam_master_signature_registration'] );
}
else{
update_option('spam_master_signature_registration', 'false' );
}
if (isset($_POST['spam_master_signature_login'])){
update_option('spam_master_signature_login', $_POST['spam_master_signature_login'] );
}
else{
update_option('spam_master_signature_login', 'false' );
}
if (isset($_POST['spam_master_signature_comments'])){
update_option('spam_master_signature_comments', $_POST['spam_master_signature_comments'] );
}
else{
update_option('spam_master_signature_comments', 'false' );
}
if (isset($_POST['spam_master_signature_email'])){
update_option('spam_master_signature_email', $_POST['spam_master_signature_email'] );
}
else{
update_option('spam_master_signature_email', 'false' );
}
}
?>
<div id="message" class="updated fade">
<p><?php _e('Signatures Settings Saved!', 'spam_master'); ?></p>
</div>
<?php
}
?>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="4"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Signatures', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="4"><small>End Signatures Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="4">
<p>This small extra protection tool is a huge deterrent against all forms of human span. Most of the automatic spam bots are already blocked by the licensed RBL Servers and other extra protection tools like Re-Captcha and Honeypot.</p>
<p>Statistics show 1% to 2% of human (real persons) are working spammers. 2% multiplied by millions of humans doing this is a lot. These options are important because these persons trying to spam will know their efforts are in vain, a waist of time.</p>
<p>The signatures are displayed in the login form, registration form, comments form and emails, i.e. registration email. You can turn them of here.</p>
			</th>
		</tr>
		<tr>
			<td>
				<input name="spam_master_signature_registration" id="spam_master_signature_registration" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_signature_registration') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_signature_registration') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_signature_registration"><b><?php _e('Activate Registration Signature', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="spam_master_signature_login" id="spam_master_signature_login" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_signature_login') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_signature_login') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_signature_login"><b><?php _e('Activate Login Signature', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="spam_master_signature_comments" id="spam_master_signature_comments" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_signature_comments') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_signature_comments') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_signature_comments"><b><?php _e('Activate Comments Signature', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="spam_master_signature_email" id="spam_master_signature_email" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_signature_email') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_signature_email') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_signature_email"><b><?php _e('Activate Email Signature', 'spam_master'); ?></b></label>
			</td>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update_signatures' value='<?php _e("Save Signatures Settings", 'spam_master'); ?>' id='submitbutton' /></p>
</fieldset>
</form>
<?php
		}
}
