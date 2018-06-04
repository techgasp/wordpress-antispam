<?php
class spam_master_other_protection_table_integrations extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
function display() {
global $wp_nonce, $current_user, $wpdb, $blog_id;
if(isset($_POST['update_integrations'])){
if(is_multisite()){
	if (isset($_POST['spam_master_recaptcha_version'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_version', $_POST['spam_master_recaptcha_version'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_version', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_registration'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_registration', $_POST['spam_master_recaptcha_registration'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_registration', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_login'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_login', $_POST['spam_master_recaptcha_login'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_login', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_comments'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_comments', $_POST['spam_master_recaptcha_comments'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_comments', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_public_key'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_public_key', $_POST['spam_master_recaptcha_public_key'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_public_key', '' );
	}
	if (isset($_POST['spam_master_recaptcha_secret_key'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_secret_key', $_POST['spam_master_recaptcha_secret_key'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_secret_key', '' );
	}
	if (isset($_POST['spam_master_recaptcha_theme'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_theme', $_POST['spam_master_recaptcha_theme'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_theme', '' );
	}
	if (isset($_POST['spam_master_recaptcha_preview'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_preview', $_POST['spam_master_recaptcha_preview'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_preview', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_ampoff'])){
	update_blog_option($blog_id, 'spam_master_recaptcha_ampoff', $_POST['spam_master_recaptcha_ampoff'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_recaptcha_ampoff', 'false' );
	}
	if (isset($_POST['spam_master_honeypot_timetrap'])){
	update_blog_option($blog_id, 'spam_master_honeypot_timetrap', $_POST['spam_master_honeypot_timetrap'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_honeypot_timetrap', 'false' );
	}
	if (isset($_POST['spam_master_honeypot_timetrap_speed'])){
	update_blog_option($blog_id, 'spam_master_honeypot_timetrap_speed', $_POST['spam_master_honeypot_timetrap_speed'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_honeypot_timetrap_speed', '' );
	}
	if (isset($_POST['spam_master_integrations_contact_form_7'])){
	update_blog_option($blog_id, 'spam_master_integrations_contact_form_7', $_POST['spam_master_integrations_contact_form_7'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_integrations_contact_form_7', 'false' );
	}
	if (isset($_POST['spam_master_integrations_woocommerce'])){
	update_blog_option($blog_id, 'spam_master_integrations_woocommerce', $_POST['spam_master_integrations_woocommerce'] );
	}
	else{
	update_blog_option($blog_id, 'spam_master_integrations_woocommerce', 'false' );
	}
}
else{
	if (isset($_POST['spam_master_recaptcha_version'])){
	update_option('spam_master_recaptcha_version', $_POST['spam_master_recaptcha_version'] );
	}
	else{
	update_option('spam_master_recaptcha_version', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_registration'])){
	update_option('spam_master_recaptcha_registration', $_POST['spam_master_recaptcha_registration'] );
	}
	else{
	update_option('spam_master_recaptcha_registration', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_login'])){
	update_option('spam_master_recaptcha_login', $_POST['spam_master_recaptcha_login'] );
	}
	else{
	update_option('spam_master_recaptcha_login', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_comments'])){
	update_option('spam_master_recaptcha_comments', $_POST['spam_master_recaptcha_comments'] );
	}
	else{
	update_option('spam_master_recaptcha_comments', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_public_key'])){
	update_option('spam_master_recaptcha_public_key', $_POST['spam_master_recaptcha_public_key'] );
	}
	else{
	update_option('spam_master_recaptcha_public_key', '' );
	}
	if (isset($_POST['spam_master_recaptcha_secret_key'])){
	update_option('spam_master_recaptcha_secret_key', $_POST['spam_master_recaptcha_secret_key'] );
	}
	else{
	update_option('spam_master_recaptcha_secret_key', '' );
	}
	if (isset($_POST['spam_master_recaptcha_theme'])){
	update_option('spam_master_recaptcha_theme', $_POST['spam_master_recaptcha_theme'] );
	}
	else{
	update_option('spam_master_recaptcha_theme', '' );
	}
	if (isset($_POST['spam_master_recaptcha_preview'])){
	update_option('spam_master_recaptcha_preview', $_POST['spam_master_recaptcha_preview'] );
	}
	else{
	update_option('spam_master_recaptcha_preview', 'false' );
	}
	if (isset($_POST['spam_master_recaptcha_ampoff'])){
	update_option('spam_master_recaptcha_ampoff', $_POST['spam_master_recaptcha_ampoff'] );
	}
	else{
	update_option('spam_master_recaptcha_ampoff', 'false' );
	}
	if (isset($_POST['spam_master_honeypot_timetrap'])){
	update_option('spam_master_honeypot_timetrap', $_POST['spam_master_honeypot_timetrap'] );
	}
	else{
	update_option('spam_master_honeypot_timetrap', 'false' );
	}
	if (isset($_POST['spam_master_honeypot_timetrap_speed'])){
	update_option('spam_master_honeypot_timetrap_speed', $_POST['spam_master_honeypot_timetrap_speed'] );
	}
	else{
	update_option('spam_master_honeypot_timetrap_speed', '' );
	}
	if (isset($_POST['spam_master_integrations_contact_form_7'])){
	update_option('spam_master_integrations_contact_form_7', $_POST['spam_master_integrations_contact_form_7'] );
	}
	else{
	update_option('spam_master_integrations_contact_form_7', 'false' );
	}
	if (isset($_POST['spam_master_integrations_woocommerce'])){
	update_option('spam_master_integrations_woocommerce', $_POST['spam_master_integrations_woocommerce'] );
	}
	else{
	update_option('spam_master_integrations_woocommerce', 'false' );
	}
}
?>
<div id="message" class="updated fade">
<p><?php _e('Integrations Saved!', 'spam_master'); ?></p>
</div>
<?php
}

if(is_multisite()){
$spam_master_recaptcha_version = get_blog_option($blog_id, 'spam_master_recaptcha_version');
$spam_master_recaptcha_registration = get_blog_option($blog_id, 'spam_master_recaptcha_registration');
$spam_master_recaptcha_login = get_blog_option($blog_id, 'spam_master_recaptcha_login');
$spam_master_recaptcha_comments = get_blog_option($blog_id, 'spam_master_recaptcha_comments');
	if($spam_master_recaptcha_version == 'true'){
		$spam_master_recaptcha_version_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>Invisible reCAPTCHA active</b></font></td>';
	}
	else{
		$spam_master_recaptcha_version_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>reCAPTCHA V2 active</b></font></td>';
	}
	if($spam_master_recaptcha_registration == 'true'){
		$spam_master_recaptcha_registration_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_recaptcha_registration_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
	if($spam_master_recaptcha_login == 'true'){
		$spam_master_recaptcha_login_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_recaptcha_login_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
	if($spam_master_recaptcha_comments == 'true'){
		$spam_master_recaptcha_comments_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_recaptcha_comments_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
$spam_master_honeypot_timetrap = get_blog_option($blog_id, 'spam_master_honeypot_timetrap');
	if($spam_master_honeypot_timetrap == 'true'){
		$spam_master_honeypot_timetrap_status = '<td style="vertical-align:middle; width:70%;"" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_honeypot_timetrap_status = '<td style="vertical-align:middle; width:70%;"" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
$spam_master_integrations_contact_form_7 = get_blog_option($blog_id, 'spam_master_integrations_contact_form_7');
	if($spam_master_integrations_contact_form_7 == 'true'){
		$spam_master_integrations_contact_form_7_status = '<td style="vertical-align:middle; width:70%;"" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_integrations_contact_form_7_status = '<td style="vertical-align:middle; width:70%;"" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
$spam_master_integrations_woocommerce = get_blog_option($blog_id, 'spam_master_integrations_woocommerce');
	if($spam_master_integrations_woocommerce == 'true'){
		$spam_master_integrations_woocommerce_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_integrations_woocommerce_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
}
else{
$spam_master_recaptcha_version = get_option('spam_master_recaptcha_version');
$spam_master_recaptcha_registration = get_option('spam_master_recaptcha_registration');
$spam_master_recaptcha_login = get_option('spam_master_recaptcha_login');
$spam_master_recaptcha_comments = get_option('spam_master_recaptcha_comments');
	if($spam_master_recaptcha_version == 'true'){
		$spam_master_recaptcha_version_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>Invisible reCAPTCHA selected</b></font></td>';
	}
	else{
		$spam_master_recaptcha_version_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>reCAPTCHA V2 selected</b></font></td>';
	}
	if($spam_master_recaptcha_registration == 'true'){
		$spam_master_recaptcha_registration_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_recaptcha_registration_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
	if($spam_master_recaptcha_login == 'true'){
		$spam_master_recaptcha_login_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_recaptcha_login_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
	if($spam_master_recaptcha_comments == 'true'){
		$spam_master_recaptcha_comments_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_recaptcha_comments_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
$spam_master_honeypot_timetrap = get_option('spam_master_honeypot_timetrap');
	if($spam_master_honeypot_timetrap == 'true'){
		$spam_master_honeypot_timetrap_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_honeypot_timetrap_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
$spam_master_integrations_contact_form_7 = get_option('spam_master_integrations_contact_form_7');
	if($spam_master_integrations_contact_form_7 == 'true'){
		$spam_master_integrations_contact_form_7_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_integrations_contact_form_7_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
$spam_master_integrations_woocommerce = get_option('spam_master_integrations_woocommerce');
	if($spam_master_integrations_woocommerce == 'true'){
		$spam_master_integrations_woocommerce_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#07B357"><font color="white"><b>ONLINE</b></font></td>';
	}
	else{
		$spam_master_integrations_woocommerce_status = '<td style="vertical-align:middle; width:70%;" bgcolor="#563a3a"><font color="white"><b>OFFLINE</b></font></td>';
	}
}
?>
<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Integration API', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr><th colspan="4"><small>End Integrations Api Section</small></th></tr>
	</tfoot>

	<tbody>
		<tr>
			<th colspan="2">
<p>These are optional settings. The Integrations API allows the implementation of external protection functions and allows Spam Master to check for Threats and Spam in other wordpress plugins that deal with registrations, comments, email contact forms, etc.</p>
<p>If you are a plugin developer and want your plugin included in Spam Master API, get in touch with us via support ticket.</p>
			</th>
		</tr>
		<tr class="alternate">
			<th colspan="2">
				<h3><em>reCAPTCHA V2 & Invisible reCAPTCHA</em></h3>
				<p>Activating Re-Captcha adds a captcha code field to the Login Page, Registration page or to all Comments of your <b>Wordpress</b>.</p>
				<p>Activating re-captcha will automatically eliminate all "bots" or "robots" fake registrations. <b>Make sure you have no other plugins installed that use captcha's or re-captcha</b></p>
				<p>Re-Captcha is freely provided by google and requires a google api key that you can get in seconds. Get your free google <a href="https://www.google.com/recaptcha/intro/index.html" title="re-captcha" target="_blank">re-captcha key</a>.</p>
				<p>Re-Captcha works on Accelerated Mobile Pages (AMP), but does not conform to the <a href="https://www.ampproject.org/docs/reference/components" target="_blank"> strict AMP standard definitions</a>. It is therefore recommended to switch it off for AMP pages.</p>
			</th>
		</tr>
		<tr class="alternate">
			<td>
				<input name="spam_master_recaptcha_version" id="spam_master_recaptcha_version" value="true" type="checkbox" <?php echo $spam_master_recaptcha_version == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_recaptcha_version"><b><?php _e('Activate Invisible reCaptcha', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_recaptcha_version_status; ?>
		</tr>
		<tr class="alternate">
			<td>
				<input name="spam_master_recaptcha_registration" id="spam_master_recaptcha_registration" value="true" type="checkbox" <?php echo $spam_master_recaptcha_registration == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_recaptcha_registration"><b><?php _e('Activate Re-Captcha Registration Page', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_recaptcha_registration_status; ?>
		</tr>
		<tr class="alternate">
			<td>
				<input name="spam_master_recaptcha_login" id="spam_master_recaptcha_login" value="true" type="checkbox" <?php echo $spam_master_recaptcha_login == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_recaptcha_login"><b><?php _e('Activate Re-Captcha Login Page', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_recaptcha_login_status; ?>
		</tr>
		<tr class="alternate">
			<td>
				<input name="spam_master_recaptcha_comments" id="spam_master_recaptcha_comments" value="true" type="checkbox" <?php echo $spam_master_recaptcha_comments == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_recaptcha_comments"><b><?php _e('Activate Re-Captcha in Comments Page', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_recaptcha_comments_status; ?>
		</tr>
		<tr class="alternate">
			<td><label for="spam_master_recaptcha_public_key"><?php _e('Re-Captcha API Site Key:', 'spam_master'); ?></label></td>
			<td><input id="spam_master_recaptcha_public_key" name="spam_master_recaptcha_public_key" type="text" value="<?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_recaptcha_public_key');}else{echo get_option('spam_master_recaptcha_public_key');} ?>" style="width:100%;"></td>
		</tr>
		<tr class="alternate">
			<td><label for="spam_master_recaptcha_secret_key"><?php _e('Re-Captcha API Secret Key:', 'spam_master'); ?></label></td>
			<td><input id="spam_master_recaptcha_secret_key" name="spam_master_recaptcha_secret_key" type="text" value="<?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_recaptcha_secret_key');}else{echo get_option('spam_master_recaptcha_secret_key');} ?>" style="width:100%;"></td>
		</tr>
		<tr class="alternate">
			<td><label for="spam_master_recaptcha_theme"><?php _e(' Color Scheme:', 'spam_master'); ?></label></td>
			<td>
				<input id="spam_master_recaptcha_theme" name="spam_master_recaptcha_theme" type="text" value="<?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_recaptcha_theme');}else{echo get_option('spam_master_recaptcha_theme');} ?>" style="width:100%;">
				<p>Color Scheme options are: <b>light</b> or <b>dark</b>.</p>
			</td>
		</tr>
		<tr class="alternate">
			<td colspan="2">
				<input name="spam_master_recaptcha_ampoff" id="spam_master_recaptcha_ampoff" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_recaptcha_ampoff') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_recaptcha_ampoff') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_recaptcha_ampoff"><b><?php _e('Switch off Re-Captcha on AMP pages', 'spam_master'); ?></b></label>
			</td>
		</tr>
		<tr class="alternate">
			<td colspan="2">
				<input name="spam_master_recaptcha_preview" id="spam_master_recaptcha_preview" value="true" type="checkbox" <?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_recaptcha_preview') == 'true' ? 'checked="checked"':'';}else{echo get_option('spam_master_recaptcha_preview') == 'true' ? 'checked="checked"':'';} ?> />
				<label for="spam_master_recaptcha_preview"><b><?php _e('Activate Re-Captcha Preview', 'spam_master'); ?></b></label>
			</td>
		</tr>
		<tr class="alternate">
			<th colspan="2">
<?php
if(is_multisite()){
$spam_master_recaptcha_version = get_blog_option($blog_id, 'spam_master_recaptcha_version');
$spam_master_recaptcha_preview = get_blog_option($blog_id, 'spam_master_recaptcha_preview');
$spam_master_recaptcha_preview = get_blog_option($blog_id, 'spam_master_recaptcha_ampoff');
$spam_master_recaptcha_public_key = get_blog_option($blog_id, 'spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_option('spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_blog_option($blog_id,'spam_master_recaptcha_theme');
}
else{
$spam_master_recaptcha_version = get_option('spam_master_recaptcha_version');
$spam_master_recaptcha_preview = get_option('spam_master_recaptcha_preview');
$spam_master_recaptcha_preview = get_option('spam_master_recaptcha_ampoff');
$spam_master_recaptcha_public_key = get_option('spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_option('spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_option('spam_master_recaptcha_theme');
}
if ($spam_master_recaptcha_preview == 'true' ){
	if ($spam_master_recaptcha_version == 'true' ){
		if ($spam_master_recaptcha_public_key !== ''){
			if ($spam_master_recaptcha_secret_key !== ''){
				echo '<font color="red">Not fully implemented yet... Please deactivate Invisible reCAPTCHA and <b>use reCAPTCHA V2</b></font><br><br>
				<style>iframe{width: 100%;height: 60px;}.grecaptcha-badge{width: 301px !important;height: 100% !important;}</style>
				<script src="https://www.google.com/recaptcha/api.js" async defer></script>
				<form action="test.php" method="POST" id="theForm">
				<script>
				function submitForm() {
				document.getElementById("theForm").submit();
				}
				</script>
				<div class="g-recaptcha" data-sitekey="'.$spam_master_recaptcha_public_key.'" data-bind="recaptcha-submit" data-callback="submitForm" data-badge="inline"></div>
				<input type="hidden" name="login" class="loginmodal-submit" id="recaptcha-submit" value="Login">
				</form>';
			}
			else{
				echo '<div id="message" class="error"><p>Warning... Invisible reCaptcha Activated without <b>Secret Key</b>.</p><p>Click below "Get your free google re-captcha key".</p></div>';
			}
		}
		else{
			echo '<div id="message" class="error"><p>Warning... Invisible reCaptcha Activated without <b>Site Key</b>.</p><p>Click below "Get your free google re-captcha key".</p></div>';
		}
	}
	else{
		if ($spam_master_recaptcha_public_key !== ''){
			if ($spam_master_recaptcha_secret_key !== ''){
				echo '<script src="https://www.google.com/recaptcha/api.js"></script>' .
				'<div class="g-recaptcha" data-theme="'.$spam_master_recaptcha_theme.'" data-sitekey="'.$spam_master_recaptcha_public_key.'"></div>';
			}
			else{
				echo '<div id="message" class="error"><p>Warning... Re-Captcha Activated without <b>Secret Key</b>.</p><p>Click below "Get your free google re-captcha key".</p></div>';
			}
		}
		else{
			echo '<div id="message" class="error"><p>Warning... Re-Captcha Activated without <b>Public Key</b>.</p><p>Click below "Get your free google re-captcha key".</p></div>';
		}
	}
}			
?>		
			</th>
		</tr>
		<tr>
			<th colspan="2">
				<h3><em>Honeypot</em></h3>
				<p>Activating Honeypot adds invisible traps for "bots" or "robots in <b>Wordpress</b> registration page or comments.</p>
				<p>"persons" or "humans" will not see these traps, more about <a href="https://en.wikipedia.org/wiki/Honeypot_(computing)" title="honeypot" target="_blank">honeypot</a>.</p>
			</th>
		</tr>
		<tr>
			<td>
				<input name="spam_master_honeypot_timetrap" id="spam_master_honeypot_timetrap" value="true" type="checkbox" <?php echo $spam_master_honeypot_timetrap == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_honeypot_timetrap"><b><?php _e('Activate Time Trap', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_honeypot_timetrap_status; ?>
		</tr>
		<tr>
			<td style="vertical-align:middle; width:30%;"><label for="spam_master_honeypot_timetrap_speed"><?php _e('Honeypot Trap Speed', 'spam_master'); ?></label></td>
			<td>
				<input id="spam_master_honeypot_timetrap_speed" name="spam_master_honeypot_timetrap_speed" type="text" size="16" value="<?php if(is_multisite()){echo get_blog_option($blog_id, 'spam_master_honeypot_timetrap_speed');}else{echo get_option('spam_master_honeypot_timetrap_speed');} ?>">
				<p>Time trap checks for how fast the "bots" are trying to submit the registration data. Default is <b>5</b> seconds.</p>
			</td>
		</tr>
		<tr class="alternate">
			<th colspan="2">
				<h3><em>Contact Form 7</em></h3>
				<p>Contact Form 7 manages multiple contact forms, plus you can customize the form and the mail contents flexibly with simple markup.</p>
				<p>Activating Contact Form 7, Spam Master will pro-active scan the email forms before the email function is triggered keeping your email inbox safe from spam and other threats. <a href="https://wordpress.org/plugins/contact-form-7/" title="Contact Form 7" target="_blank">Download Here</a>.</p>
			</th>
		</tr>
		<tr class="alternate">
			<td>
				<input name="spam_master_integrations_contact_form_7" id="spam_master_integrations_contact_form_7" value="true" type="checkbox" <?php echo $spam_master_integrations_contact_form_7 == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_integrations_contact_form_7"><b><?php _e('Activate Contact Form 7', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_integrations_contact_form_7_status; ?>
		</tr>
		<tr>
			<th colspan="2">
				<h3><em>Woocommerce</em></h3>
				<p>WooCommerce is an open source e-commerce platform for small to large-sized online merchants using WordPress.</p>
				<p>Activating Woocommerce, Spam Master will pro-active scan registrations and block spam, exploits and credit card frauds. <a href="https://wordpress.org/plugins/woocommerce/" title="Woocommerce" target="_blank">Download Here</a>.</p>
			</th>
		</tr>
		<tr>
			<td>
				<input name="spam_master_integrations_woocommerce" id="spam_master_integrations_woocommerce" value="true" type="checkbox" <?php echo $spam_master_integrations_woocommerce == 'true' ? 'checked="checked"':''; ?> />
				<label for="spam_master_integrations_woocommerce"><b><?php _e('Activate Woocommerce', 'spam_master'); ?></b></label>
			</td>
			<?php echo $spam_master_integrations_woocommerce_status; ?>
		</tr>
	</tbody>
</table>
<p class="submit"><input class='button-primary' type='submit' name='update_integrations' value='<?php _e("Save Integration Settings", 'spam_master'); ?>' id='submit_button' /></p>
</fieldset>
</form>
<?php
		}
}
