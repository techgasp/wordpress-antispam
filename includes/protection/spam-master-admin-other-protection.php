<?php
function menu_rct_single(){
	if ( is_admin() )
	add_submenu_page( 'spam-master', 'Protection Tools', 'Protection Tools', 'manage_options', 'spam-master-recaptcha', 'spam_master_recaptcha' );
}
	///////////////////////
	// WORDPRESS ACTIONS //
	///////////////////////
	if( is_multisite() ) {
		add_action( 'admin_menu', 'menu_rct_single' );
	}
	else {
		add_action( 'admin_menu', 'menu_rct_single' );
	}

function spam_master_recaptcha(){
$plugin_master_name = constant('SPAM_MASTER_NAME');
?>
<div class="wrap">
<h1><?php echo $plugin_master_name; ?> Extra Protection Tools</h1>
	
<?php
//////////////////
//FIREWALL ADMIN//
//////////////////
if(!class_exists('spam_master_other_protection_table_firewall')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-firewall.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_firewall();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
</br>
<?php
//////////////////////
//Integrations ADMIN//
//////////////////////
if(!class_exists('spam_master_other_protection_table_integrations')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-integrations.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_integrations();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
</br>
<?php
/////////////////////////
//Comments Strict ADMIN//
/////////////////////////
if(!class_exists('spam_master_other_protection_table_comments_strict')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-comments-strict.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_comments_strict();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
</br>
<?php
////////////////////////
//Clean Comments ADMIN//
////////////////////////
if(!class_exists('spam_master_other_protection_table_clean')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-clean.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_clean();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
</br>
<?php
/////////////////
//Emails ADMIN//
/////////////////
if(!class_exists('spam_master_other_protection_table_emails')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-emails.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_emails();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
</br>
<?php
/////////////////
//Widgets ADMIN//
/////////////////
if(!class_exists('spam_master_other_protection_table_widgets')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-widgets.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_widgets();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
</br>
<?php
////////////////////
//Signatures ADMIN//
////////////////////
if(!class_exists('spam_master_other_protection_table_signatures')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-signatures.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_signatures();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
</br>
<?php
//////////////////
//Learning ADMIN//
//////////////////
if(!class_exists('spam_master_other_protection_table__learning')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-learning.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_learning();
//Table of elements
$wp_list_table->display();
?>
</br>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
</br>
<?php
/////////////
//RBL ADMIN//
/////////////
if(!class_exists('spam_master_other_protection_table__rbl')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-other-protection-table-rbl.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_other_protection_table_rbl();
//Table of elements
$wp_list_table->display();
?>
</br>

<h2>IMPORTANT: Makes no use of Javascript or Ajax to keep your website fast and conflicts free</h2>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
<p>
<a class="button-secondary" href="https://wordpress.techgasp.com" target="_blank" title="Visit Website">More TechGasp Plugins</a>
<a class="button-secondary" href="https://wordpress.techgasp.com/support/" target="_blank" title="TechGasp Support">TechGasp Support</a>
<a class="button-primary" href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="Visit Website"><?php echo $plugin_master_name; ?> Info</a>
<a class="button-primary" href="https://wordpress.techgasp.com/spam-master-documentation/" target="_blank" title="Visit Website"><?php echo $plugin_master_name; ?> Documentation</a>
<a class="button-primary" href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Visit Website">RATE US *****</a>
</p>
</div>
<?php
}

//////////////////////////
//GET FRONTEND VARIABLES//
//////////////////////////
global $blog_id;
if(is_multisite()){
$spam_master_firewall_on = get_blog_option($blog_id, 'spam_master_firewall_on');
$spam_master_recaptcha_registration = get_blog_option($blog_id, 'spam_master_recaptcha_registration');
$spam_master_recaptcha_login = get_blog_option($blog_id, 'spam_master_recaptcha_login');
$spam_master_recaptcha_comments = get_blog_option($blog_id, 'spam_master_recaptcha_comments');
$spam_master_recaptcha_public_key = get_blog_option($blog_id, 'spam_master_recaptcha_public_key');
$spam_master_recaptcha_ampoff = get_blog_option($blog_id, 'spam_master_recaptcha_ampoff');
$spam_master_honeypot_timetrap = get_blog_option($blog_id, 'spam_master_honeypot_timetrap');
$spam_master_honeypot_timetrap_speed = get_blog_option($blog_id, 'spam_master_honeypot_timetrap_speed');
$spam_master_signature_registration = get_blog_option($blog_id, 'spam_master_signature_registration');
$spam_master_signature_login = get_blog_option($blog_id, 'spam_master_signature_login');
$spam_master_signature_comments = get_blog_option($blog_id, 'spam_master_signature_comments');
$spam_master_signature_email = get_blog_option($blog_id, 'spam_master_signature_email');
$spam_master_comment_website_field = get_blog_option($blog_id, 'spam_master_comment_website_field');
}
else{
$spam_master_firewall_on = get_option('spam_master_firewall_on');
$spam_master_recaptcha_registration = get_option('spam_master_recaptcha_registration');
$spam_master_recaptcha_login = get_option('spam_master_recaptcha_login');
$spam_master_recaptcha_comments = get_option('spam_master_recaptcha_comments');
$spam_master_recaptcha_public_key = get_option('spam_master_recaptcha_public_key');
$spam_master_recaptcha_ampoff = get_option('spam_master_recaptcha_ampoff');
$spam_master_honeypot_timetrap = get_option('spam_master_honeypot_timetrap');
$spam_master_honeypot_timetrap_speed = get_option('spam_master_honeypot_timetrap_speed');
$spam_master_signature_registration = get_option('spam_master_signature_registration');
$spam_master_signature_login = get_option('spam_master_signature_login');
$spam_master_signature_comments = get_option('spam_master_signature_comments');
$spam_master_signature_email = get_option('spam_master_signature_email');
$spam_master_comment_website_field = get_option('spam_master_comment_website_field');
}
//////////////////////////////////////////////
//IMPLEMENT RECAPTCHA FRONTEND REGISTRATIONS//
//////////////////////////////////////////////
if ($spam_master_recaptcha_registration == 'true'){
	if ($spam_master_recaptcha_public_key !== ''){
		if ( $spam_master_recaptcha_ampoff !== 'true' ) {
			//MULTISITE HOOKS
			if(is_multisite()){
				add_action('signup_extra_fields', 'spam_master_recaptcha_register_field' );
				add_action('register_form', 'spam_master_recaptcha_register_field' );
				add_action('wpmu_validate_user_signup', 'spam_master_recaptcha_register_multi_errors', 99);
			}
			//SINGLE SITE HOOKS
			else{
				add_action('login_enqueue_scripts', 'spam_master_recaptcha_css');
				add_action('register_form', 'spam_master_recaptcha_register_field' );
				add_filter( 'registration_errors', 'spam_master_recaptcha_register_single_errors', 10, 3 );
			}
		}

//CSS FOR SINGLE SITE
function spam_master_recaptcha_css(){
	echo '<style type="text/css">';
	echo '#login{width:350px !important;}';
	echo '</style>';
}
//END CSS
//INSERT FIELD
function spam_master_recaptcha_register_field(){
global $wpdb, $blog_id;
if(is_multisite()){
$spam_master_recaptcha_public_key = get_blog_option($blog_id, 'spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_blog_option($blog_id, 'spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_blog_option($blog_id, 'spam_master_recaptcha_theme');
}
else{
$spam_master_recaptcha_public_key = get_option('spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_option('spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_option('spam_master_recaptcha_theme');
}
	?>
	<label>Re-CAPTCHA Code</label>
	<?php
	echo '<script src="https://www.google.com/recaptcha/api.js"></script>' .
	'<div class="g-recaptcha" data-theme="'.$spam_master_recaptcha_theme.'" data-sitekey="'.$spam_master_recaptcha_public_key.'"></div>';
	if (is_multisite()){
	?>
	<p>Press <b>Next</b> after verifying captcha.</p>
	<br>
	<?php
	}
	else{
	?>
	<p>Press <b>Register</b> after verifying captcha.</p>
	<br>
	<?php
	}
}
//END FIELD
//START ERRORS VALIDATION MULTI SITE
function spam_master_recaptcha_register_multi_errors($result){
	if(isset($_POST['g-recaptcha-response'])){
	$captcha=$_POST['g-recaptcha-response'];
		if(!$captcha){
				$result['errors']->add('invalid_email',__('<strong>SPAM MASTER</strong>: Insert Correct Captcha','spam_master'));
				echo '<p class="error"><strong>SPAM MASTER</strong>: Insert Correct Captcha</p>';
		}
	}
return $result;
}
//END ERRORS MULTI VALIDATION
//START ERRORS VALIDATION SINGLE SITE
function spam_master_recaptcha_register_single_errors($errors){
	if(isset($_POST['g-recaptcha-response'])){
	$captcha=$_POST['g-recaptcha-response'];
		if(!$captcha){
			if(is_multisite()){
				$errors->add('error', __('<strong>SPAM MASTER</strong>: Insert Correct Captcha','spam_master') );
				echo '<p class="error"><strong>SPAM MASTER</strong>: Insert Correct Captcha</p>';
			}
			else{
				$errors->add('error', __('<strong>SPAM MASTER</strong>: Insert Correct Captcha','spam_master') );
			}
		}
	}
return $errors;
//END ERRORS VALIDATION
}

	//END public key
	}
//END $spam_master_recaptcha_registration - true
}
//////////////////////////////////////
//IMPLEMENT RECAPTCHA FRONTEND LOGIN//
//////////////////////////////////////
if ($spam_master_recaptcha_login == 'true'){
	if ($spam_master_recaptcha_public_key !== ''){
		if ( $spam_master_recaptcha_ampoff !== 'true' ) {
			//MULTISITE HOOKS
			if(is_multisite()){
				add_action('signup_extra_fields', 'spam_master_recaptcha_login_field' );
				add_action('login_form', 'spam_master_recaptcha_login_field');
				add_action('login_head', 'spam_master_recaptcha_login_errors', 99);
			}
			//SINGLE SITE HOOKS
			else{
				add_action('login_enqueue_scripts', 'spam_master_recaptcha_login_css');
				add_action('login_form', 'spam_master_recaptcha_login_field');
				add_filter( 'authenticate', 'spam_master_recaptcha_login_errors', 10, 3 );
			}
		}

//CSS FOR SINGLE SITE
function spam_master_recaptcha_login_css(){
	echo '<style type="text/css">';
	echo '#login{width:350px !important;}';
	echo '</style>';
}
//END CSS
//INSERT FIELD
function spam_master_recaptcha_login_field(){
global $wpdb, $blog_id;
if(is_multisite()){
$spam_master_recaptcha_public_key = get_blog_option($blog_id, 'spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_blog_option($blog_id, 'spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_blog_option($blog_id, 'spam_master_recaptcha_theme');
}
else{
$spam_master_recaptcha_public_key = get_option('spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_option('spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_option('spam_master_recaptcha_theme');
}
echo	'<script src="https://www.google.com/recaptcha/api.js"></script>';
echo	'<label>Re-CAPTCHA Code</label>' .
		'<div class="g-recaptcha" data-theme="'.$spam_master_recaptcha_theme.'" data-sitekey="' . $spam_master_recaptcha_public_key . '"></div>';
//END FIELD
}

//START ERRORS VALIDATION
function spam_master_recaptcha_login_errors($user, $password) {
global $wpdb, $blog_id;
if(is_multisite()){
$spam_master_recaptcha_public_key = get_blog_option($blog_id, 'spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_blog_option($blog_id, 'spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_blog_option($blog_id, 'spam_master_recaptcha_theme');
}
else{
$spam_master_recaptcha_public_key = get_option('spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_option('spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_option('spam_master_recaptcha_theme');
}
	if ( isset( $_POST['g-recaptcha-response'] ) ) {
		$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $spam_master_recaptcha_secret_key . '&response=' . $_POST['g-recaptcha-response'] );
		$response = json_decode( $response['body'], true );
		if ( false === $response['success'] ) {
			return new WP_Error( 'Captcha Invalid', spam_master_get_error_message() );
		}
		else {
			return $user;
		}
	}
}

//SET ERROR MESSAGE
function spam_master_get_error_message() {
	$custom_error = '<strong>SPAM MASTER:</strong> Insert Correct Captcha';
	if ( $custom_error ) {
		return __( $custom_error );
	}
	else {
		return __( '<strong>Silence is Gold</strong>' );
	}
}

	//END public key
	}
//END $spam_master_recaptcha_login - true
}

/////////////////////////////////////////
//IMPLEMENT RECAPTCHA FRONTEND COMMENTS//
/////////////////////////////////////////
if ($spam_master_recaptcha_comments == 'true'){
	if ($spam_master_recaptcha_public_key !== ''){
		if ( $spam_master_recaptcha_ampoff !== 'true' ) {
			//MULTISITE HOOKS
			if(is_multisite()){
				add_action( 'comment_form_after_fields', 'spam_master_comment_field', 1);
				add_filter( 'preprocess_comment', 'spam_master_verify_comment_data' );
			}
			//SINGLE SITE HOOKS
			else{
				add_action('login_enqueue_scripts', 'spam_master_recaptcha_comments_css');
				add_action( 'comment_form_after_fields', 'spam_master_comment_field', 1);
				add_filter( 'preprocess_comment', 'spam_master_verify_comment_data' );
			}
		}

//CSS FOR SINGLE SITE
function spam_master_recaptcha_comments_css(){
	echo '<style type="text/css">';
	echo '#login{width:350px !important;}';
	echo '</style>';
}
function spam_master_comment_field(){
global $wpdb, $blog_id;
if(is_multisite()){
$spam_master_recaptcha_public_key = get_blog_option($blog_id, 'spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_blog_option($blog_id, 'spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_blog_option($blog_id, 'spam_master_recaptcha_theme');
}
else{
$spam_master_recaptcha_public_key = get_option('spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_option('spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_option('spam_master_recaptcha_theme');
}
echo	'<script src="https://www.google.com/recaptcha/api.js"></script>';
echo	'<p class="comment-form-recaptcha">' .
		'<label>Re-CAPTCHA Code</label>' .
		'<div class="g-recaptcha" data-theme="'.$spam_master_recaptcha_theme.'" data-sitekey="' . $spam_master_recaptcha_public_key . '"></div></p>';
}
//COMMENT VERIFICATION
function spam_master_verify_comment_data($commentdata){
global $wpdb, $blog_id;
if(is_multisite()){
$spam_master_recaptcha_public_key = get_blog_option($blog_id, 'spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_blog_option($blog_id, 'spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_blog_option($blog_id, 'spam_master_recaptcha_theme');
}
else{
$spam_master_recaptcha_public_key = get_option('spam_master_recaptcha_public_key');
$spam_master_recaptcha_secret_key = get_option('spam_master_recaptcha_secret_key');
$spam_master_recaptcha_theme = get_option('spam_master_recaptcha_theme');
	if ( isset( $_POST['g-recaptcha-response'] ) ) {
		$response = wp_remote_get( 'https://www.google.com/recaptcha/api/siteverify?secret=' . $spam_master_recaptcha_secret_key . '&response=' . $_POST['g-recaptcha-response'] );
		$response = json_decode( $response['body'], true );
		if ( true === $response['success'] ) {
			return $commentdata;
		}
		else {
			return wp_die( __( '<strong>SPAM MASTER</strong>: Insert Correct Captcha' ) );
		}
	}
}
}

	//END public key
	}
//END $spam_master_recaptcha_comments - true	
}

///////////////////////////////
//IMPLEMENT HONEYPOT FRONTEND//
///////////////////////////////
if ($spam_master_honeypot_timetrap == 'true'){
//MULTISITE HOOKS
if(is_multisite()){
add_action('signup_extra_fields', 'spam_master_honeypot_css');
add_action('signup_extra_fields', 'spam_master_honeypot_register_field' );
add_action('wpmu_validate_user_signup', 'spam_master_honeypot_register_errors_multi', 99);
}
//SINGLE SITE HOOKS
else{
add_action('login_enqueue_scripts', 'spam_master_honeypot_css');
add_action('register_form', 'spam_master_honeypot_register_field' );
add_filter( 'registration_errors', 'spam_master_honeypot_register_single_errors', 10, 3 );
}

//CSS FOR SINGLE SITE
function spam_master_honeypot_css(){
	echo '<style type="text/css">';
	echo '.smaster{display:none;}';
	echo '</style>';
}
//END CSS
//INSERT FIELD
function spam_master_honeypot_register_field(){
global $wpdb, $blog_id;
?>
<p class="smaster">
<label for="mothers_name"><?php _e( 'Mothers Name', 'spam_master' ); ?><br>
<input type="text" name="mothers_name" id="mothers_name" class="input" value="" size="25" autocomplete="off" />
</label>
</p>
<p class="smaster">
<label for="fax_number"><?php _e( 'Fax Number', 'spam_master' ); ?><br>
<input type="type="text" name="fax_number" id="fax_number" class="input" value="" size="25" autocomplete="off" />
</label>
</p>
<?php
//END FIELD
}
//START ERRORS VALIDATION MULTI SITE
function spam_master_honeypot_register_errors_multi($result){
	if(!empty($_POST['mothers_name'])){
		$result['errors']->add('error', __('<strong>SPAM MASTER</strong>: Blocked IP, Domain, Email','spam_master') );
		echo '<p class="error"><strong>SPAM MASTER</strong>: Blocked IP, Domain, Email</p>';
	}
	if(!empty($_POST['fax_number'])){
		$result['errors']->add('error', __('<strong>SPAM MASTER</strong>: Blocked IP, Domain, Email','spam_master') );
		echo '<p class="error"><strong>SPAM MASTER</strong>: Blocked IP, Domain, Email</p>';
	}
return $result;
}
//END ERRORS MULTI VALIDATION
//START ERRORS VALIDATION SINGLE SITE
function spam_master_honeypot_register_single_errors($errors){
	if(!empty($_POST['mothers_name'])){
		$errors->add('error', __('<strong>SPAM MASTER</strong>: Blocked IP, Domain, Email','spam_master') );
	}
	if(!empty($_POST['fax_number'])){
		$errors->add('error', __('<strong>SPAM MASTER</strong>: Blocked IP, Domain, Email','spam_master') );	
	}
return $errors;
//END ERRORS VALIDATION
}
//END HONEYPOT
}

/////////////////////////////////
//IMPLEMENT SIGNATURES FRONTEND//
/////////////////////////////////
if ($spam_master_signature_registration == 'true'){
//MULTISITE HOOKS
if(is_multisite()){
add_action('signup_extra_fields', 'spam_master_signature_registration_field' );
}
//SINGLE SITE HOOKS
else{
add_action('register_form', 'spam_master_signature_registration_field' );
}
//INSERT FIELD
function spam_master_signature_registration_field(){
global $wpdb, $blog_id;
?>
<p>
<?php _e( 'Website Protected by ', 'spam_master' ); ?>
<a href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Spam Master"><em>Spam Master</em></a>
</p>
<br>
<?php
//END FIELD
}
//END FUNCTION
}
if ($spam_master_signature_login == 'true'){
if(is_multisite()){
add_action('login_form', 'spam_master_signature_login_field');
}
//SINGLE SITE HOOKS
else{
add_action('login_form', 'spam_master_signature_login_field');
}
//INSERT FIELD
function spam_master_signature_login_field(){
global $wpdb, $blog_id;
echo '<p>Website Protected by <a href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Spam Master"><em>Spam Master</em></a></p><br>';
//END FIELD
}
//END FUNCTION
}
if ($spam_master_signature_comments == 'true'){
//MULTISITE HOOKS
if(is_multisite()){
add_action( 'comment_form_after_fields', 'spam_master_signature_comments_field', 1);
}
//SINGLE SITE HOOKS
else{
add_action( 'comment_form_after_fields', 'spam_master_signature_comments_field', 1);
}
function spam_master_signature_comments_field(){
global $wpdb, $blog_id;
echo '<p>Website Protected by <a href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Spam Master"><em>Spam Master</em></a></p><br>';
//END FIELD
}
//END FUNCTION
}
if ($spam_master_signature_email == 'true'){
if(is_multisite()){
//wpmu_signup_user_notification & wpmu_activate_signup
//https://core.trac.wordpress.org/browser/tags/4.5.3/src/wp-includes/ms-functions.php#L0
//END MULTI SITE
}
//SINGLE SITE HOOKS
else{
//Password change email
if ( !function_exists('wp_password_change_notification') ) :
function wp_password_change_notification( $user ) {
global $wpdb;
	// send a copy of password change notification to the admin
	// but check to see if it's the admin whose password we're changing, and skip this
	if ( 0 !== strcasecmp( $user->user_email, get_option( 'admin_email' ) ) ) {
		// The blogname option is escaped with esc_html on the way into the database in sanitize_option
		// we want to reverse this for the plain text arena of emails.
		$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
		/* translators: %s: user name */
		$message = sprintf( __( 'Password changed for user: %s' ), $user->user_login ) . "\r\n\r\n";
		$message .= $blogname. __(' is protected by Spam Master') . "\r\n";
		/* translators: %s: site title */
		wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] Password Changed' ), $blogname ), $message );
	}
}
endif;
//New Registrations email
if ( !function_exists('wp_new_user_notification') ) :
function wp_new_user_notification( $user_id, $deprecated = null, $notify = '' ) {
	if ( $deprecated !== null ) {
		_deprecated_argument( __FUNCTION__, '4.3.1' );
	}
	global $wpdb, $wp_hasher;
	$user = get_userdata( $user_id );
	// The blogname option is escaped with esc_html on the way into the database in sanitize_option
	// we want to reverse this for the plain text arena of emails.
	$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
	if ( 'user' !== $notify ) {
		$message  = sprintf( __( 'New user registration on your site %s:' ), $blogname ) . "\r\n\r\n";
		$message .= sprintf( __( 'Username: %s' ), $user->user_login ) . "\r\n\r\n";
		$message .= sprintf( __( 'Email: %s' ), $user->user_email ) . "\r\n\r\n";
		$message .= $blogname. __(' is protected by Spam Master') . "\r\n\r\n";
		@wp_mail( get_option( 'admin_email' ), sprintf( __( '[%s] New User Registration' ), $blogname ), $message );
	}
	// `$deprecated was pre-4.3 `$plaintext_pass`. An empty `$plaintext_pass` didn't sent a user notifcation.
	if ( 'admin' === $notify || ( empty( $deprecated ) && empty( $notify ) ) ) {
		return;
	}
	// Generate something random for a password reset key.
	$key = wp_generate_password( 20, false );
	/** This action is documented in wp-login.php */
	do_action( 'retrieve_password_key', $user->user_login, $key );
	// Now insert the key, hashed, into the DB.
	if ( empty( $wp_hasher ) ) {
		$wp_hasher = new PasswordHash( 8, true );
	}
	$hashed = time() . ':' . $wp_hasher->HashPassword( $key );
	$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user->user_login ) );
	$message = sprintf(__('Username: %s'), $user->user_login) . "\r\n\r\n";
	$message .= __('To set your password, visit the following address:') . "\r\n\r\n";
	$message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login') . ">\r\n\r\n";
	$message .= wp_login_url() . "\r\n\r\n";
	$message .= $blogname. __(' is protected by Spam Master') . "\r\n";
	wp_mail($user->user_email, sprintf(__('[%s] Your username and password info'), $blogname), $message);
//END FUNCTION
}
//END IF
endif;
//END SINGLE SITE
}
//END SIGNATURE TRUE
}
///////////////////////////////
//IMPLEMENT FIREWALL FRONTEND//
///////////////////////////////
if ($spam_master_firewall_on == 'true'){
	//exempt admins from check
	if(!function_exists('wp_get_current_user')) {
		include(ABSPATH . "wp-includes/pluggable.php"); 
	}
	if( current_user_can( 'administrator' ) OR current_user_can( 'editor' ) OR current_user_can( 'author' ) OR current_user_can( 'contributor' ) OR current_user_can('super_admin')){
	}
	else{
		//firewall
		add_action('init', 'spam_master_frontend_firewall');
		function spam_master_frontend_firewall(){
		global $wpdb, $blog_id, $pagenow;
		//get visitor ip
		$visitor_ip = $_SERVER['REMOTE_ADDR'];
			//get spam master buffer
			if(is_multisite()){
			$spam_master_blacklist = get_blog_option($blog_id, 'blacklist_keys');
			$blacklist_string = $spam_master_blacklist;
			$blacklist_array = explode("\n", $blacklist_string);
			$blacklist_size = sizeof($blacklist_array);
				// Analyse List
				for($i = 0; $i < $blacklist_size; $i++){
				$blacklist_current = trim($blacklist_array[$i]);
				//check buffer
					if(stripos($visitor_ip, $blacklist_current) !== false){
						if($pagenow == "wp-signup.php" && $_SERVER['REQUEST_METHOD'] == 'GET'){
							$page = home_url( '/firewall/' );
							$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																'type' => 'Firewall',
																'threat_ip' => $visitor_ip,
																'threat_email' => 'none',
																'details' => 'firewall block in '.$pagenow);
							json_encode($spam_master_transient_array);
							$errors = set_site_transient( 'spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
							$count = $errors;
							$blog_prefix = $wpdb->get_blog_prefix($blog_id);
							$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							
							wp_redirect($page);
							exit();
						}
						else{
							$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																'type' => 'Firewall',
																'threat_ip' => $visitor_ip,
																'threat_email' => 'none',
																'details' => 'firewall block in '.$pagenow);
							json_encode($spam_master_transient_array);
							$errors = set_site_transient( 'spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
							$count = $errors;
							$blog_prefix = $wpdb->get_blog_prefix($blog_id);
							$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							$page = home_url( '/firewall/' );

							wp_redirect($page);
							exit();
						}
					return;
					//end if
					}
				//end for
				}
			//end multi
			}
			else{
			$spam_master_blacklist = get_option('blacklist_keys');
			$blacklist_string = $spam_master_blacklist;
			$blacklist_array = explode("\n", $blacklist_string);
			$blacklist_size = sizeof($blacklist_array);
				// Analyse List
				for($i = 0; $i < $blacklist_size; $i++){
				$blacklist_current = trim($blacklist_array[$i]);
					//check buffer
					if(stripos($visitor_ip, $blacklist_current) !== false){
						if($pagenow == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET'){
							$page = home_url( '/firewall/' );
							$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																'type' => 'Firewall',
																'threat_ip' => $visitor_ip,
																'threat_email' => 'none',
																'details' => 'firewall block in '.$pagenow);
							json_encode($spam_master_transient_array);
							$errors = set_transient( 'spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
							$count = $errors;
							$table_prefix = $wpdb->base_prefix;
							$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							
							wp_safe_redirect($page);
							exit();
						}
						else{
							$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																'type' => 'Firewall',
																'threat_ip' => $visitor_ip,
																'threat_email' => 'none',
																'details' => 'firewall block in '.$pagenow);
							json_encode($spam_master_transient_array);
							$errors = set_transient( 'spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
							$count = $errors;
							$table_prefix = $wpdb->base_prefix;
							$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							
							$page = home_url( '/firewall/' );
							wp_safe_redirect($page);
							exit();
						}
					return;
					//end if
					}
				//end for
				}
			//end single
			}
		//end func firewall
		}
	//END Admin check
	}
//END FIREWALL TRUE
}

/////////////////////////
//COMMENT WEBSITE FIELD//
/////////////////////////
if ($spam_master_comment_website_field == 'true'){
function spam_master_attempt_remove_comment_website_field($fields){ 
	unset($fields['url']);
	return $fields;
}
add_filter('comment_form_default_fields','spam_master_attempt_remove_comment_website_field');
}
