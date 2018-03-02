<?php
class spam_master_other_protection_table_widgets extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;
//Save data	
if(isset($_POST['update_widgets'])){
if(is_multisite()){
if (isset($_POST['spam_master_widget_heads_up'])){
update_blog_option($blog_id, 'spam_master_widget_heads_up', $_POST['spam_master_widget_heads_up'] );
}
else{
update_blog_option($blog_id, 'spam_master_widget_heads_up', 'false' );
}
if (isset($_POST['spam_master_widget_statistics'])){
update_blog_option($blog_id, 'spam_master_widget_statistics', $_POST['spam_master_widget_statistics'] );
}
else{
update_blog_option($blog_id, 'spam_master_widget_statistics', 'false' );
}
if (isset($_POST['spam_master_widget_firewall'])){
update_blog_option($blog_id, 'spam_master_widget_firewall', $_POST['spam_master_widget_firewall'] );
}
else{
update_blog_option($blog_id, 'spam_master_widget_firewall', 'false' );
}
if (isset($_POST['spam_master_widget_dashboard_status'])){
update_blog_option($blog_id, 'spam_master_widget_dashboard_status', $_POST['spam_master_widget_dashboard_status'] );
}
else{
update_blog_option($blog_id, 'spam_master_widget_dashboard_status', 'false' );
}
if (isset($_POST['spam_master_widget_dashboard_statistics'])){
update_blog_option($blog_id, 'spam_master_widget_dashboard_statistics', $_POST['spam_master_widget_dashboard_statistics'] );
}
else{
update_blog_option($blog_id, 'spam_master_widget_dashboard_statistics', 'false' );
}
if (isset($_POST['spam_master_shortcodes_total_count'])){
update_blog_option($blog_id, 'spam_master_shortcodes_total_count', $_POST['spam_master_shortcodes_total_count'] );
}
else{
update_blog_option($blog_id, 'spam_master_shortcodes_total_count', 'false' );
}
}
else{
if (isset($_POST['spam_master_widget_heads_up'])){
update_option('spam_master_widget_heads_up', $_POST['spam_master_widget_heads_up'] );
}
else{
update_option('spam_master_widget_heads_up', 'false' );
}
if (isset($_POST['spam_master_widget_statistics'])){
update_option('spam_master_widget_statistics', $_POST['spam_master_widget_statistics'] );
}
else{
update_option('spam_master_widget_statistics', 'false' );
}
if (isset($_POST['spam_master_widget_firewall'])){
update_option('spam_master_widget_firewall', $_POST['spam_master_widget_firewall'] );
}
else{
update_option('spam_master_widget_firewall', 'false' );
}
if (isset($_POST['spam_master_widget_dashboard_status'])){
update_option('spam_master_widget_dashboard_status', $_POST['spam_master_widget_dashboard_status'] );
}
else{
update_option('spam_master_widget_dashboard_status', 'false' );
}
if (isset($_POST['spam_master_widget_dashboard_statistics'])){
update_option('spam_master_widget_dashboard_statistics', $_POST['spam_master_widget_dashboard_statistics'] );
}
else{
update_option('spam_master_widget_dashboard_statistics', 'false' );
}
if (isset($_POST['spam_master_shortcodes_total_count'])){
update_option('spam_master_shortcodes_total_count', $_POST['spam_master_shortcodes_total_count'] );
}
else{
update_option('spam_master_shortcodes_total_count', 'false' );
}
}
?>
<div id="message" class="updated fade">
<p><?php _e('Widgets Settings Saved!', 'spam_master'); ?></p>
</div>
<?php
}
?>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="4"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Widgets & Shortcodes', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="4"><small>End Widgets Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="4">
<p>Usually plugins load all their widgets automatically upon install. Experience tells us that many of the Widgets are never used or deployed by users while taking some of the website resources. Here you have full control of which Widgets to use and load, just activate them below.</p>
<p>You will find the activated Widgets in your wordpress widgets page or in the case of dashboard widgets in your website dashboard page. If you feel there's a cool feature missing or a widget altogether, get in touch with us and we will be happy to add it, <a href="https://wordpress.techgasp.com/support/" target="_blank" title="Contact TechGasp Support"><em>click here</em></a>.</p>
			</th>
		</tr>
		<tr>
			<th colspan="4"><b>Widgets:</b></th>
		</tr>
		<tr>
			<td>
				<input name="spam_master_widget_heads_up" id="spam_master_widget_heads_up" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_widget_heads_up') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_widget_heads_up') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_widget_heads_up"><?php _e('Heads Up Widget (Visible by Users & Admins)', 'spam_master'); ?></label>
			</td>
			<td>
				<input name="spam_master_widget_statistics" id="spam_master_widget_statistics" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_widget_statistics') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_widget_statistics') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_widget_statistics"><?php _e('Statistics Widget (Visible by Users & Admins)', 'spam_master'); ?></label>
			</td>
			<td>
				<input name="spam_master_widget_firewall" id="spam_master_widget_firewall" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_widget_firewall') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_widget_firewall') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_widget_firewall"><?php _e('Firewall Status Widget (Visible by Users & Admins)', 'spam_master'); ?></label>
			</td>
			<td></td>
		</tr>
		<tr>
			<th colspan="4"><b>Dashboard Widgets:</b></th>
		</tr>
		<tr>
			<td>
				<input name="spam_master_widget_dashboard_status" id="spam_master_widget_dashboard_status" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_widget_dashboard_status') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_widget_dashboard_status') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_widget_dashboard_status"><?php _e('Dashboard Status Widget (Visible by Admins)', 'spam_master'); ?></label>
			</td>
			<td>
				<input name="spam_master_widget_dashboard_statistics" id="spam_master_widget_dashboard_statistics" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_widget_dashboard_statistics') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_widget_dashboard_statistics') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_widget_dashboard_statistics"><?php _e('Dashboard Statistics Widget (Visible by Admins)', 'spam_master'); ?></label>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<th colspan="4"><b>Shortcodes:</b></th>
		</tr>
				<tr>
			<td>
				<input name="spam_master_shortcodes_total_count" id="spam_master_shortcodes_total_count" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_shortcodes_total_count') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_shortcodes_total_count') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_shortcodes_total_count"><?php _e('Threat Protection Total Count [spam_master_stats_total_count]', 'spam_master'); ?></label>
			</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update_widgets' value='<?php _e("Save Widgets Settings", 'spam_master'); ?>' id='submitbutton' /></p>
</fieldset>
</form>
<?php
		}
}
