<?php
class spam_master_other_protection_table_comments_strict extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;
//Save data	
if(isset($_POST['update_comments_strict'])){
if(is_multisite()){
if (isset($_POST['require_name_email'])){
update_blog_option($blog_id, 'require_name_email', '1' );
}
else{
update_blog_option($blog_id, 'require_name_email', '1' );
}
if (isset($_POST['comment_registration'])){
update_blog_option($blog_id, 'comment_registration', '1' );
}
else{
update_blog_option($blog_id, 'comment_registration', '' );
}
if (isset($_POST['comment_moderation'])){
update_blog_option($blog_id, 'comment_moderation', '1' );
}
else{
update_blog_option($blog_id, 'comment_moderation', '' );
}
if (isset($_POST['comment_whitelist'])){
update_blog_option($blog_id, 'comment_whitelist', '1' );
}
else{
update_blog_option($blog_id, 'comment_whitelist', '' );
}
if (isset($_POST['spam_master_comment_website_field'])){
update_blog_option($blog_id, 'spam_master_comment_website_field', 'true');
}
else{
update_blog_option($blog_id, 'spam_master_comment_website_field', 'true');
}
if (isset($_POST['comment_russian_char'])){
update_blog_option($blog_id, 'comment_russian_char', 'true');
}
else{
update_blog_option($blog_id, 'comment_russian_char', 'false');
}
if (isset($_POST['comment_chinese_char'])){
update_blog_option($blog_id, 'comment_chinese_char', 'true');
}
else{
update_blog_option($blog_id, 'comment_chinese_char', 'false');
}
if (isset($_POST['comment_asian_char'])){
update_blog_option($blog_id, 'comment_asian_char', 'true');
}
else{
update_blog_option($blog_id, 'comment_asian_char', 'false');
}
if (isset($_POST['comment_arabic_char'])){
update_blog_option($blog_id, 'comment_arabic_char', 'true');
}
else{
update_blog_option($blog_id, 'comment_arabic_char', 'false');
}
if (isset($_POST['comment_spam_char'])){
update_blog_option($blog_id, 'comment_spam_char', 'true');
}
else{
update_blog_option($blog_id, 'comment_spam_char', 'false');
}
}
//single
else{
if (isset($_POST['require_name_email'])){
update_option('require_name_email', '1' );
}
else{
update_option('require_name_email', '1' );
}
if (isset($_POST['comment_registration'])){
update_option('comment_registration', '1' );
}
else{
update_option('comment_registration', '' );
}
if (isset($_POST['comment_moderation'])){
update_option('comment_moderation', '1' );
}
else{
update_option('comment_moderation', '' );
}
if (isset($_POST['comment_whitelist'])){
update_option('comment_whitelist', '1' );
}
else{
update_option('comment_whitelist', '' );
}
if (isset($_POST['spam_master_comment_website_field'])){
update_option('spam_master_comment_website_field', 'true');
}
else{
update_option('spam_master_comment_website_field', 'true');
}
if (isset($_POST['comment_russian_char'])){
update_option('comment_russian_char', 'true');
}
else{
update_option('comment_russian_char', 'false');
}
if (isset($_POST['comment_chinese_char'])){
update_option('comment_chinese_char', 'true');
}
else{
update_option('comment_chinese_char', 'false');
}
if (isset($_POST['comment_asian_char'])){
update_option('comment_asian_char', 'true');
}
else{
update_option('comment_asian_char', 'false');
}
if (isset($_POST['comment_arabic_char'])){
update_option('comment_arabic_char', 'true');
}
else{
update_option('comment_arabic_char', 'false');
}
if (isset($_POST['comment_spam_char'])){
update_option('comment_spam_char', 'true');
}
else{
update_option('comment_spam_char', 'false');
}
}
?>
<div id="message" class="updated fade">
<p><?php _e('Comment Settings Saved!', 'spam_master'); ?></p>
</div>
<?php
}
?>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="4"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Comment Options', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="4"><small>End Comment Options Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="4">
<h3><em>Wordpress Native Comment Options</em></h3>
<p>These are native Wordpress Comment options that seem to be overlook. It is highly recommended to have them active if your blog is under spam attack.</p>
<p><b>Comment author must fill out name and email</b>. Can not be turned off and is useful to create load / hassle to spamming bots / Humans. It also helps the Spam Master Learning function to detect and stop spam attempts.</b></p>
<p><b>Users must be registered and logged in to comment</b>. Optional, before commenting users should have registered and activated their account in your blog by passing the registration spam scan. Stops commenting floods or attacks from different Ip's.</p>
<p><b>Comment must be manually approved</b>. Optional, new comments need to pass the spam check and afterwards need to be approved by a blog administrator before being approved and displayed.</p>
<p><b>Comment author must have a previously approved comment</b>. Optional, cuts down on the number of comments you have to approve. Once the comment passes the spam check and you approve one comment by that author, their future comments will be automatically approved. Heads-Up, approve comments from know safe sources.</p>
<p><b>Remove Website Comment Field</b>. Optional, attempts to remove from wordpress themes the spam tasty website field located in comments form.</p>
			</th>
		</tr>
		<tr>
			<td>
				<input name="require_name_email" id="require_name_email" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'require_name_email') == '1' ? 'checked="checked"':'';}else{echo get_option('require_name_email') == '1' ? 'checked="checked"':'';} ?> />
				<label for="require_name_email"><b><?php _e('Comment author must fill out name and email', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="comment_registration" id="comment_registration" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'comment_registration') == '1' ? 'checked="checked"':'';}else{echo get_option('comment_registration') == '1' ? 'checked="checked"':'';} ?> />
				<label for="comment_registration"><b><?php _e('Users must be registered and logged in to comment', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="comment_moderation" id="comment_moderation" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'comment_moderation') == '1' ? 'checked="checked"':'';}else{echo get_option('comment_moderation') == '1' ? 'checked="checked"':'';} ?> />
				<label for="comment_moderation"><b><?php _e('Comment must be manually approved', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="comment_whitelist" id="comment_whitelist" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'comment_whitelist') == '1' ? 'checked="checked"':'';}else{echo get_option('comment_whitelist') == '1' ? 'checked="checked"':'';} ?> />
				<label for="comment_whitelist"><b><?php _e('Comment author must have a previously approved comment', 'spam_master'); ?></b></label>
			</td>
		</tr>
		<tr>
			<td>
				<input name="spam_master_comment_website_field" id="spam_master_comment_website_field" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_comment_website_field') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_comment_website_field') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_comment_website_field"><b><?php _e('Remove Website Comment Field', 'spam_master'); ?></b></label>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr class="alternate">
			<th colspan="4">
<h3><em>Comment Character Options</em></h3>
<p>Blocks comments with specific regional characters and encoding on them.</p>
			</th>
		</tr>
		<tr class="alternate">
			<td>
				<input name="comment_russian_char" id="comment_russian_char" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'comment_russian_char') == 'true' ? 'checked="checked"':'';}else{echo get_option('comment_russian_char') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="comment_russian_char"><b><?php _e('Automatically Block Comments with Russain Characters', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="comment_chinese_char" id="comment_chinese_char" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'comment_chinese_char') == 'true' ? 'checked="checked"':'';}else{echo get_option('comment_chinese_char') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="comment_chinese_char"><b><?php _e('Automatically Block Comments with Chinese Characters', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="comment_asian_char" id="comment_asian_char" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'comment_asian_char') == 'true' ? 'checked="checked"':'';}else{echo get_option('comment_asian_char') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="comment_asian_char"><b><?php _e('Automatically Block Comments with Asian Characters', 'spam_master'); ?></b></label>
			</td>
			<td>
				<input name="comment_arabic_char" id="comment_arabic_char" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'comment_arabic_char') == 'true' ? 'checked="checked"':'';}else{echo get_option('comment_arabic_char') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="comment_arabic_char"><b><?php _e('Automatically Block Comments with Arabic Characters', 'spam_master'); ?></b></label>
			</td>
		</tr>
		<tr class="alternate">
			<td>
				<input name="comment_spam_char" id="comment_spam_char" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'comment_spam_char') == 'true' ? 'checked="checked"':'';}else{echo get_option('comment_spam_char') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="comment_spam_char"><b><?php _e('Automatically Block Comments with Spam Characters', 'spam_master'); ?></b></label>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update_comments_strict' value='<?php _e("Save Comment Settings", 'spam_master'); ?>' id='submitbutton' /></p>
</fieldset>
</form>
<?php
		}
}
