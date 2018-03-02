<?php
global $wpdb, $blog_id;
//add message to wordpress in case theres no post message update
if( is_multisite() ){
	$spam_master_message = get_blog_option( $blog_id, 'spam_master_message');
}
else{
	$spam_master_message = get_option('spam_master_message');
}

//POST Message
if (isset($_POST['update_message'])){
// Update Message
	if (isset($_POST['spam_master_message'])){
		if ($spam_master_message = $_POST['spam_master_message']){
			if( is_multisite() ){
			update_blog_option($blog_id, 'spam_master_message', $spam_master_message);
			}
			else {
			update_option('spam_master_message', $spam_master_message);
			}
		}
	}
?>
<div id="message" class="updated fade">
<p><?php _e('Message Saved & Refreshed', 'spam_master'); ?></p>
</div>
<?php
//end message post
}
?>
<br>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Edit Registration Message', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th><p class="submit" style="margin-top:-10px !important; margin-bottom:-18px !important"><input class='button-primary' type='submit' name='update_message' value='<?php _e("Save & Refresh", 'spam_master'); ?>' id='submitbutton' /></p></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle">
				<p>This message is displayed to spam users who are not allowed to register in your Wordpress. There's not a lot of space so, keep it short.</p>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:middle">
				<textarea name='spam_master_message' style="width:100%" rows='3'><?php echo $spam_master_message; ?></textarea>
			</td>
		</tr>
	</tbody>
</table>
</fieldset>
</form>
