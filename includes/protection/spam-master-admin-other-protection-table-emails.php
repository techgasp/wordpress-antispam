<?php
class spam_master_other_protection_table_emails extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;
if(isset($_POST['update_emails'])){
if(is_multisite()){
if (isset($_POST['spam_master_emails_extra_email'])){
update_blog_option($blog_id, 'spam_master_emails_extra_email', $_POST['spam_master_emails_extra_email'] );
}
else{
update_blog_option($blog_id, 'spam_master_emails_extra_email', 'false' );
}
if (isset($_POST['spam_master_emails_extra_email_list'])){
update_blog_option($blog_id, 'spam_master_emails_extra_email_list', $_POST['spam_master_emails_extra_email_list'] );
}
else{
update_blog_option($blog_id, 'spam_master_emails_extra_email_list', '' );
}
if (isset($_POST['spam_master_emails_alert_3_email'])){
update_blog_option($blog_id, 'spam_master_emails_alert_3_email', $_POST['spam_master_emails_alert_3_email'] );
}
else{
update_blog_option($blog_id, 'spam_master_emails_alert_3_email', 'false' );
}
if (isset($_POST['spam_master_emails_alert_email'])){
update_blog_option($blog_id, 'spam_master_emails_alert_email', $_POST['spam_master_emails_alert_email'] );
}
else{
update_blog_option($blog_id, 'spam_master_emails_alert_email', 'false' );
}
if (isset($_POST['spam_master_emails_weekly_email'])){
update_blog_option($blog_id, 'spam_master_emails_weekly_email', $_POST['spam_master_emails_weekly_email'] );
}
else{
update_blog_option($blog_id, 'spam_master_emails_weekly_email', 'false' );
}
if (isset($_POST['spam_master_emails_weekly_stats'])){
update_blog_option($blog_id, 'spam_master_emails_weekly_stats', $_POST['spam_master_emails_weekly_stats'] );
}
else{
update_blog_option($blog_id, 'spam_master_emails_weekly_stats', 'false' );
}
}
else{
if (isset($_POST['spam_master_emails_extra_email'])){
update_option('spam_master_emails_extra_email', $_POST['spam_master_emails_extra_email'] );
}
else{
update_option('spam_master_emails_extra_email', 'false' );
}
if (isset($_POST['spam_master_emails_extra_email_list'])){
update_option('spam_master_emails_extra_email_list', $_POST['spam_master_emails_extra_email_list'] );
}
else{
update_option('spam_master_emails_extra_email_list', '' );
}
if (isset($_POST['spam_master_emails_alert_3_email'])){
update_option('spam_master_emails_alert_3_email', $_POST['spam_master_emails_alert_3_email'] );
}
else{
update_option('spam_master_emails_alert_3_email', 'false' );
}
if (isset($_POST['spam_master_emails_alert_email'])){
update_option('spam_master_emails_alert_email', $_POST['spam_master_emails_alert_email'] );
}
else{
update_option('spam_master_emails_alert_email', 'false' );
}
if (isset($_POST['spam_master_emails_weekly_email'])){
update_option('spam_master_emails_weekly_email', $_POST['spam_master_emails_weekly_email'] );
}
else{
update_option('spam_master_emails_weekly_email', 'false' );
}
if (isset($_POST['spam_master_emails_weekly_stats'])){
update_option('spam_master_emails_weekly_stats', $_POST['spam_master_emails_weekly_stats'] );
}
else{
update_option('spam_master_emails_weekly_stats', 'false' );
}
}
?>
<div id="message" class="updated fade">
<p><?php _e('Emails & Reporting Settings Saved!', 'spam_master'); ?></p>
</div>
<?php
}
if(is_multisite()){
$spam_master_emails_extra_email = get_blog_option($blog_id, 'spam_master_emails_extra_email');
$spam_master_emails_extra_email_list = get_blog_option($blog_id, 'spam_master_emails_extra_email_list');
$spam_master_emails_alert_3_email = get_blog_option($blog_id, 'spam_master_emails_alert_3_email');
$spam_master_emails_alert_email = get_blog_option($blog_id, 'spam_master_emails_alert_email');
$spam_master_emails_weekly_email = get_blog_option($blog_id, 'spam_master_emails_weekly_email');
$spam_master_emails_weekly_stats = get_blog_option($blog_id, 'spam_master_emails_weekly_stats');
}
else{
$spam_master_emails_extra_email = get_option('spam_master_emails_extra_email');
$spam_master_emails_extra_email_list = get_option('spam_master_emails_extra_email_list');
$spam_master_emails_alert_3_email = get_option('spam_master_emails_alert_3_email');
$spam_master_emails_alert_email = get_option('spam_master_emails_alert_email');
$spam_master_emails_weekly_email = get_option('spam_master_emails_weekly_email');
$spam_master_emails_weekly_stats = get_option('spam_master_emails_weekly_stats');
}
//generate statuses
if($spam_master_emails_extra_email == 'true'){
	$spam_master_emails_extra_email_color = '#07B357';
}
else{
	$spam_master_emails_extra_email_color = '#563a3a';
}
if($spam_master_emails_alert_3_email == 'true'){
	$spam_master_emails_alert_3_email_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b> - Daily alert 3 warns you if your website reached or is at a dangerous level. You can find more info about alert levels in Spam Master Settings page.</font></td>';
}
else{
	$spam_master_emails_alert_3_email_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b> - Daily alert 3 warns you if your website reached or is at a dangerous level. You can find more info about alert levels in Spam Master Settings page.</font></td>';
}
if($spam_master_emails_alert_email == 'true'){
	$spam_master_emails_alert_email_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b> - Daily report for normal alert levels and spam probability percentage. You can find more info about alert levels in Spam Master Settings page.</font></td>';
}
else{
	$spam_master_emails_alert_email_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b> - Daily report for normal alert levels and spam probability percentage. You can find more info about alert levels in Spam Master Settings page.</font></td>';
}
if($spam_master_emails_weekly_email == 'true'){
	$spam_master_emails_weekly_email_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b> - Weekly detailed email report.</font></td>';
}
else{
	$spam_master_emails_weekly_email_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b> - Weekly detailed email report.</font></td>';
}
if($spam_master_emails_weekly_stats == 'true'){
	$spam_master_emails_weekly_stats_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b> - Help us improve Spam Master by sending weekly statistical data, same as your weekly report.</font></td>';
}
else{
	$spam_master_emails_weekly_stats_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b> - Help us improve Spam Master by sending weekly statistical data, same as your weekly report.</font></td>';
}
?>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Emails & Reporting', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="2"><small>End Emails & Reporting Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="2">
<p>These are optional settings.  Activating Emails & Reporting adds an extra watchful eye over your <b>Wordpress</b> website security. All emails and reports are sent to the administrator email address found in your wordpress Settings, General options page.</p>
<p>If you want to receive alerts and reports in other email addresses, add your emails below comma-separated. Example: <b>email@myemail.com, email1@myemail.com, other@gmail.com</b></p>
			</th>
		</tr>
		
		
		<tr>
			<td>
				<input name="spam_master_emails_extra_email" id="spam_master_emails_extra_email" value="true" type="checkbox" <?php echo $spam_master_emails_extra_email == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_emails_extra_email"><b><?php _e('Activate to add more emails comma-separated', 'spam_master'); ?></b></label>
			</td>
			<td style="vertical-align:middle; width:70%;" bgcolor="<?php echo $spam_master_emails_extra_email_color; ?>">
				<input id="spam_master_emails_extra_email_list" name="spam_master_emails_extra_email_list" type="text" value="<?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_emails_extra_email_list');}else{echo get_option('spam_master_emails_extra_email_list');} ?>" style="width:100%;">
			</td>
		</tr>
		
		
		<tr>
			<td>
				<input name="spam_master_emails_alert_3_email" id="spam_master_emails_alert_3_email" value="true" type="checkbox" <?php echo $spam_master_emails_alert_3_email == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_emails_alert_3_email"><b><?php _e('Activate Alert Level 3 Warning Email', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_emails_alert_3_email_status; ?>
		</tr>
		<tr>
			<td>
				<input name="spam_master_emails_alert_email" id="spam_master_emails_alert_email" value="true" type="checkbox" <?php echo $spam_master_emails_alert_email == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_emails_alert_email"><b><?php _e('Activate Daily Report Email', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_emails_alert_email_status; ?>
		</tr>
		<tr>
			<td>
				<input name="spam_master_emails_weekly_email" id="spam_master_emails_weekly_email" value="true" type="checkbox" <?php echo $spam_master_emails_weekly_email == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_emails_weekly_email"><b><?php _e('Activate Weekly Report Email', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_emails_weekly_email_status; ?>
		</tr>
		<tr>
			<td>
				<input name="spam_master_emails_weekly_stats" id="spam_master_emails_weekly_stats" value="true" type="checkbox" <?php echo $spam_master_emails_weekly_stats == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_emails_weekly_stats"><b><?php _e('Help Us Improve Spam Master', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_emails_weekly_stats_status; ?>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update_emails' value='<?php _e("Save Emails & Reporting Settings", 'spam_master'); ?>' id='submitbutton' /></p>
</fieldset>
</form>
<?php
		}
}
