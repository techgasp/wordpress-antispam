<?php
if(!function_exists('wp_get_current_user')) {
	include(ABSPATH . "wp-includes/pluggable.php"); 
}
global $wpdb, $blog_id, $current_user;
if ((is_user_logged_in()) && (current_user_can( 'administrator' ))){
//Prepare Uninstall stuff
$platform = "Wordpress";
$spam_master_cron = "UNINS";
	if( is_multisite() ){
	$response_key = get_blog_option( $blog_id, 'spam_master_status');
	$spam_license_key = get_blog_option($blog_id, 'spam_license_key');
	$wordpress = get_bloginfo('version');
	$blog = get_blog_option($blog_id, 'blogname');
	$admin_email = get_blog_option($blog_id, 'admin_email');
	$current_user = wp_get_current_user();
	$admin_first_name = $current_user->user_firstname;
	$admin_last_name = $current_user->user_lastname;
	$admin_name_joined = $admin_first_name . ' ' . $admin_last_name;
		if(empty($admin_first_name)){
			$blog_admin_name_joined = $blog;
		}
		else{
			$blog_admin_name_joined = $admin_name_joined;
		}
	$web_adress = get_site_url();
	$spam_master_version = constant('SPAM_MASTER_VERSION');
	$spam_master_type = get_blog_option($blog_id, 'spam_master_type');
	$license = get_blog_option($blog_id, 'spam_license_key');
	$spam_master_multisite = "YES";
	$spam_master_multisite_number = get_blog_count();
	$spam_master_multisite_joined = $spam_master_multisite . ' - ' . $spam_master_multisite_number;
	@$spam_master_server_ip = $_SERVER['SERVER_ADDR'];
	//if empty ip
	if(empty($spam_master_server_ip) || $spam_master_server_ip == '0'){
		@$spam_master_server_ip = 'IP- '.gethostbyname($_SERVER['SERVER_NAME']);
	}
	@$spam_master_server_hostname = gethostbyaddr($_SERVER['SERVER_ADDR']);
	//if empty host
	if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0'){
		@$spam_master_server_hostname = 'HO- '.gethostbyname($_SERVER['SERVER_NAME']);
	}
	//remote post and response
	$spam_master_license_post = array(
								'spam_license_key' => $spam_license_key,
								'platform' => $platform,
								'platform_version' => $wordpress,
								'platform_type' => $spam_master_multisite_joined,
								'spam_master_version' => $spam_master_version,
								'spam_master_type' => $spam_master_type,
								'blog_name' => $blog,
								'blog_address' => $web_adress,
								'blog_admin' => $blog_admin_name_joined,
								'blog_email' => $admin_email,
								'blog_hostname' => $spam_master_server_hostname,
								'blog_ip' => $spam_master_server_ip,
								'spam_master_cron' => $spam_master_cron
								);
	$spam_master_license_url = 'aHR0cHM6Ly9zcGFtbWFzdGVyLnRlY2hnYXNwLmNvbS93cC1jb250ZW50L3BsdWdpbnMvc3BhbS1tYXN0ZXItYWRtaW5pc3RyYXRvci9pbmNsdWRlcy9saWNlbnNlL2dldF9saWMucGhw';
	$response = wp_remote_post( base64_decode($spam_master_license_url), array(
																				'method' => 'POST',
																				'timeout' => 45,
																				'body' => $spam_master_license_post
																				)
																				);
	delete_blog_option($blog_id, 'spam_master_message');
	delete_blog_option($blog_id, 'spam_master_firewall_on');
	delete_blog_option($blog_id, 'spam_master_learning_active');
	delete_blog_option($blog_id, 'spam_master_comments_clean');
	delete_blog_option($blog_id, 'spam_master_signature_registration');
	delete_blog_option($blog_id, 'spam_master_signature_login');
	delete_blog_option($blog_id, 'spam_master_signature_comments');
	delete_blog_option($blog_id, 'spam_master_signature_email');
	delete_blog_option($blog_id, 'spam_master_block_count');
	delete_blog_option($blog_id, 'spam_master_widget_heads_up');
	delete_blog_option($blog_id, 'spam_master_widget_statistics');
	delete_blog_option($blog_id, 'spam_master_widget_firewall');
	delete_blog_option($blog_id, 'spam_master_widget_dashboard_status');
	delete_blog_option($blog_id, 'spam_master_widget_dashboard_statistics');
	delete_blog_option($blog_id, 'spam_master_shortcodes_total_count');
	delete_blog_option($blog_id, 'spam_master_trial_expired');
	delete_blog_option($blog_id, 'spam_master_full_expired');
	delete_blog_option($blog_id, 'spam_master_recaptcha_registration');
	delete_blog_option($blog_id, 'spam_master_recaptcha_login');
	delete_blog_option($blog_id, 'spam_master_recaptcha_comments');
	delete_blog_option($blog_id, 'spam_master_recaptcha_public_key');
	/* code added by Oliver Maor - delete "AMP off" setting as well as the preview option (obviously forgotten before) */
	delete_blog_option($blog_id, 'spam_master_recaptcha_preview');
	delete_blog_option($blog_id, 'spam_master_recaptcha_ampoff');
	/* End code added by Oliver Maor */
	delete_blog_option($blog_id, 'spam_license_key_old_code');
	update_blog_option($blog_id, 'blacklist_keys_bk', get_blog_option($blog_id, 'blacklist_keys'));
	delete_blog_option($blog_id, 'blacklist_keys');
	delete_blog_option($blog_id, 'spam_master_protection_total_number');
	delete_blog_option($blog_id, 'spam_master_honeypot_timetrap');
	delete_blog_option($blog_id, 'spam_master_honeypot_timetrap_speed');
	delete_blog_option($blog_id, 'spam_master_comment_strict_name_email');
	delete_blog_option($blog_id, 'spam_master_comment_strict_registered');
	delete_blog_option($blog_id, 'spam_master_comment_strict_manually_approved');
	delete_blog_option($blog_id, 'spam_master_comment_strict_auto_approve');
	delete_blog_option($blog_id, 'spam_master_alert_level');
	delete_blog_option($blog_id, 'spam_master_alert_level_date');
	delete_blog_option($blog_id, 'spam_master_alert_level_date_manual');
	delete_blog_option($blog_id, 'spam_master_comment_website_field');
	delete_blog_option($blog_id, 'spam_master_alert_level_p_text');
	delete_blog_option($blog_id, 'spam_master_integrations_contact_form_7');
	delete_blog_option($blog_id, 'spam_master_whitelist');
	delete_blog_option($blog_id, 'spam_master_integrations_woocommerce');
	delete_blog_option($blog_id, 'spam_master_firewall_alert_3_email');
	delete_blog_option($blog_id, 'spam_master_emails_alert_3_email');
	delete_blog_option($blog_id, 'spam_master_emails_alert_email');
	delete_blog_option($blog_id, 'spam_master_full_notice');
	delete_blog_option($blog_id, 'spam_master_emails_weekly_email');
	delete_blog_option($blog_id, 'spam_master_emails_weekly_stats');
	delete_blog_option($blog_id, 'spam_master_emails_weekly_email_date');
	delete_blog_option($blog_id, 'spam_master_emails_weekly_stats_date');
	delete_blog_option($blog_id, 'comment_russian_char');
	delete_blog_option($blog_id, 'comment_russian_char_set');
	delete_blog_option($blog_id, 'comment_chinese_char');
	delete_blog_option($blog_id, 'comment_chinese_char_set');
	delete_blog_option($blog_id, 'comment_asian_char');
	delete_blog_option($blog_id, 'comment_asian_char_set');
	delete_blog_option($blog_id, 'comment_arabic_char');
	delete_blog_option($blog_id, 'comment_arabic_char_set');
	delete_blog_option($blog_id, 'comment_spam_char');
	delete_blog_option($blog_id, 'comment_spam_char_set');
	delete_blog_option($blog_id, 'spam_master_emails_extra_email');
	delete_blog_option($blog_id, 'spam_master_emails_extra_email_list');
	}
	else{
	$response_key = get_option('spam_master_status');
	$spam_license_key = get_option('spam_license_key');
	//create data to be posted
	$wordpress = get_bloginfo('version');
	$blog = get_option('blogname');
	$admin_email = get_option('admin_email');
	$current_user = wp_get_current_user();
	$admin_first_name = $current_user->user_firstname;
	$admin_last_name = $current_user->user_lastname;
	$admin_name_joined = $admin_first_name . ' ' . $admin_last_name;
		if(empty($admin_first_name)){
			$blog_admin_name_joined = $blog;
		}
		else{
			$blog_admin_name_joined = $admin_name_joined;
		}
	$web_adress = get_site_url();
	$spam_master_version = constant('SPAM_MASTER_VERSION');
	$spam_master_type = get_option('spam_master_type');
	$license = get_option('spam_license_key');
	$spam_master_multisite = "NO";
	$spam_master_multisite_number = "0";
	$spam_master_multisite_joined = $spam_master_multisite . ' - ' . $spam_master_multisite_number;
	@$spam_master_server_ip = $_SERVER['SERVER_ADDR'];
	//if empty ip
	if(empty($spam_master_server_ip) || $spam_master_server_ip == '0'){
		@$spam_master_server_ip = 'IP- '.gethostbyname($_SERVER['SERVER_NAME']);
	}
	@$spam_master_server_hostname = gethostbyaddr($_SERVER['SERVER_ADDR']);
	//if empty host
	if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0'){
		@$spam_master_server_hostname = 'HO- '.gethostbyname($_SERVER['SERVER_NAME']);
	}
	$spam_master_license_post = array(
								'spam_license_key' => $spam_license_key,
								'platform' => $platform,
								'platform_version' => $wordpress,
								'platform_type' => $spam_master_multisite_joined,
								'spam_master_version' => $spam_master_version,
								'spam_master_type' => $spam_master_type,
								'blog_name' => $blog,
								'blog_address' => $web_adress,
								'blog_admin' => $blog_admin_name_joined,
								'blog_email' => $admin_email,
								'blog_hostname' => $spam_master_server_hostname,
								'blog_ip' => $spam_master_server_ip,
								'spam_master_cron' => $spam_master_cron
								);
	$spam_master_license_url = 'aHR0cHM6Ly9zcGFtbWFzdGVyLnRlY2hnYXNwLmNvbS93cC1jb250ZW50L3BsdWdpbnMvc3BhbS1tYXN0ZXItYWRtaW5pc3RyYXRvci9pbmNsdWRlcy9saWNlbnNlL2dldF9saWMucGhw';
	$response = wp_remote_post( base64_decode($spam_master_license_url), array(
																				'method' => 'POST',
																				'timeout' => 45,
																				'body' => $spam_master_license_post
																				)
																				);
	delete_option('spam_master_message');
	delete_option('spam_master_learning_active');
	delete_option('spam_master_comments_clean');
	delete_option('spam_master_signature_registration');
	delete_option('spam_master_signature_login');
	delete_option('spam_master_signature_comments');
	delete_option('spam_master_signature_email');
	delete_option('spam_master_block_count');
	delete_option('spam_master_widget_heads_up');
	delete_option('spam_master_widget_statistics');
	delete_option('spam_master_widget_firewall');
	delete_option('spam_master_widget_dashboard_status');
	delete_option('spam_master_widget_dashboard_statistics');
	delete_option('spam_master_shortcodes_total_count');
	delete_option('spam_master_trial_expired');
	delete_option('spam_master_full_expired');
	delete_option('spam_master_firewall_on');
	delete_option('spam_master_recaptcha_registration');
	delete_option('spam_master_recaptcha_login');
	delete_option('spam_master_recaptcha_comments');
	delete_option('spam_master_recaptcha_public_key');
	/* code added by Oliver Maor - delete "AMP off" setting as well as the preview option (obviously forgotten before) */
	delete_option('spam_master_recaptcha_preview');
	delete_option('spam_master_recaptcha_ampoff');
	/* End code added by Oliver Maor */
	delete_option('spam_license_key_old_code');
	update_option('blacklist_keys_bk', get_option('blacklist_keys'));
	delete_option('blacklist_keys');
	delete_option('spam_master_protection_total_number');
	delete_option('spam_master_honeypot_timetrap');
	delete_option('spam_master_honeypot_timetrap_speed');
	delete_option('spam_master_comment_strict_name_email');
	delete_option('spam_master_comment_strict_registered');
	delete_option('spam_master_comment_strict_manually_approved');
	delete_option('spam_master_comment_strict_auto_approve');
	delete_option('spam_master_alert_level');
	delete_option('spam_master_alert_level_date');
	delete_option('spam_master_alert_level_date_manual');
	delete_option('spam_master_comment_website_field');
	delete_option('spam_master_alert_level_p_text');
	delete_option('spam_master_integrations_contact_form_7');
	delete_option('spam_master_whitelist');
	delete_option('spam_master_integrations_woocommerce');
	delete_option('spam_master_firewall_alert_3_email');
	delete_option('spam_master_emails_alert_3_email');
	delete_option('spam_master_emails_alert_email');
	delete_option('spam_master_full_notice');
	delete_option('spam_master_emails_weekly_email');
	delete_option('spam_master_emails_weekly_stats');
	delete_option('spam_master_emails_weekly_email_date');
	delete_option('spam_master_emails_weekly_stats_date');
	delete_option('comment_russian_char');
	delete_option('comment_russian_char_set');
	delete_option('comment_chinese_char');
	delete_option('comment_chinese_char_set');
	delete_option('comment_asian_char');
	delete_option('comment_asian_char_set');
	delete_option('comment_arabic_char');
	delete_option('comment_arabic_char_set');
	delete_option('comment_spam_char');
	delete_option('comment_spam_char_set');
	delete_option('spam_master_emails_extra_email');
	delete_option('spam_master_emails_extra_email_list');
	}
}
?>
