<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb, $blog_id;
//Prepare License stuff
$platform = "Wordpress";
$spam_master_cron = "TRUE";
$spam_master_alert_level_date_set = date('Y-m-d H:i:s');
if( is_multisite() ){
$response_key = get_blog_option( $blog_id, 'spam_master_status');
$spam_license_key = get_blog_option($blog_id, 'spam_license_key');
$spam_master_emails_alert_3_email = get_blog_option($blog_id, 'spam_master_emails_alert_3_email');
$spam_master_emails_alert_email = get_blog_option($blog_id, 'spam_master_emails_alert_email');
//create data to be posted
$wordpress = get_bloginfo('version');
$admin_email = get_blog_option($blog_id, 'admin_email');
$blog = get_blog_option($blog_id, 'blogname');
	if(empty($blog)){
		$blog = 'Wp multi';
	}
$web_address = get_site_url();
$address_unclean = $web_address;
$address = preg_replace('#^https?://#', '', $address_unclean);
$spam_master_version = constant('SPAM_MASTER_VERSION');
$spam_master_type = get_blog_option($blog_id, 'spam_master_type');
$license = get_blog_option($blog_id, 'spam_license_key');
$spam_master_multisite = "YES";
$spam_master_multisite_number = get_blog_count();
$spam_master_multisite_joined = $spam_master_multisite . ' - ' . $spam_master_multisite_number;
@$spam_master_server_ip = $_SERVER['SERVER_ADDR'];
	//if empty ip
	if(empty($spam_master_server_ip) || $spam_master_server_ip == '0' || $spam_master_server_ip == '127.0.0.1'){
		@$spam_master_ip_gethostbyname = gethostbyname($_SERVER['SERVER_NAME']);
		@$spam_master_server_ip = 'I '.$spam_master_ip_gethostbyname;
		if(empty($spam_master_ip_gethostbyname) || $spam_master_ip_gethostbyname == '0' || $spam_master_ip_gethostbyname == '127.0.0.1'){
			@$spam_master_urlparts = parse_url($web_address);
			@$spam_master_hostname = $spam_master_urlparts['host'];
			@$spam_master_result = dns_get_record($spam_master_hostname, DNS_A);
			@$spam_master_server_ip = 'i '.$spam_master_result[0]['ip'];
		}
	}
@$spam_master_server_hostname = gethostbyaddr($_SERVER['SERVER_ADDR']);
	//if empty host
	if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0' || $spam_master_server_hostname == '127.0.0.1'){
		@$spam_master_ho_gethostbyname = gethostbyname($_SERVER['SERVER_NAME']);
		@$spam_master_server_hostname = 'H '.$spam_master_ho_gethostbyname;
		if(empty($spam_master_ho_gethostbyname) || $$spam_master_ho_gethostbyname == '0' || $$spam_master_ho_gethostbyname == '127.0.0.1'){
			@$spam_master_urlparts = parse_url($web_address);
			@$spam_master_hostname = $spam_master_urlparts['host'];
			@$spam_master_result = dns_get_record($spam_master_hostname, DNS_A);
			@$spam_master_server_hostname = 'h '.$spam_master_result[0]['ip'];
		}
	}
//Set malfunctions as VALID
if($response_key == 'INACTIVE' || $response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
//remote post and response
$spam_master_license_post = array(
							'spam_license_key' => $spam_license_key,
							'platform' => $platform,
							'platform_version' => $wordpress,
							'platform_type' => $spam_master_multisite_joined,
							'spam_master_version' => $spam_master_version,
							'spam_master_type' => $spam_master_type,
							'blog_name' => $blog,
							'blog_address' => $address,
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
	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		echo "Something went wrong, please get in touch with TechGasp Support: $error_message";
	}
	else {
		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if(empty($data)){
			$spam_master_type = 'EMPTY';
			update_blog_option($blog_id, 'spam_master_type', $spam_master_type);
			$spam_master_status = 'INACTIVE';
			update_blog_option($blog_id, 'spam_master_status', $spam_master_status);
			$spam_master_protection_total_number = '0';
			update_blog_option($blog_id, 'spam_master_protection_total_number', $spam_master_protection_total_number);
			$spam_master_alert_level_received = '';
			update_blog_option($blog_id, 'spam_master_alert_level', $spam_master_alert_level_received);
			$spam_master_alert_level_date = '';
			update_blog_option($blog_id, 'spam_master_alert_level_date', $spam_master_alert_level_date);
			$spam_master_alert_level_p_text = '';
			update_blog_option($blog_id, 'spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
		}
		else{
			$spam_master_type = $data['type'];
			update_blog_option($blog_id, 'spam_master_type', $spam_master_type);
			$spam_master_status = $data['status'];
			update_blog_option($blog_id, 'spam_master_status', $spam_master_status);
			$spam_master_protection_total_number = $data['threats'];
			update_blog_option($blog_id, 'spam_master_protection_total_number', $spam_master_protection_total_number);
			$spam_master_alert_level_received = $data['alert'];
			update_blog_option($blog_id, 'spam_master_alert_level', $spam_master_alert_level_received);
			$spam_master_alert_level_date = $spam_master_alert_level_date_set;
			update_blog_option($blog_id, 'spam_master_alert_level_date', $spam_master_alert_level_date);
			$spam_master_alert_level_p_text = $data['percent'];
			update_blog_option($blog_id, 'spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
			//Start Alert Emails
			if($spam_master_emails_alert_3_email == 'true'){
				if($spam_master_alert_level_received == 'ALERT_3'){
					require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert-3.php');
				}
			}
			if($spam_master_emails_alert_email == 'true'){
				if($spam_master_alert_level_received == 'ALERT_2' || $spam_master_alert_level_received == 'ALERT_1' || $spam_master_alert_level_received == 'ALERT_0'){
					require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert.php');
				}
			}
		}
	}
}
else{
}
//END MULTI
}
else{
$response_key = get_option('spam_master_status');
$spam_license_key = get_option('spam_license_key');
$spam_master_emails_alert_3_email = get_option('spam_master_emails_alert_3_email');
$spam_master_emails_alert_email = get_option('spam_master_emails_alert_email');
//create data to be posted
$wordpress = get_bloginfo('version');
$admin_email = get_option('admin_email');
$blog = get_option('blogname');
	if(empty($blog)){
		$blog = 'Wp single';
	}
$web_address = get_site_url();
$address_unclean = $web_address;
$address = preg_replace('#^https?://#', '', $address_unclean);
$spam_master_version = constant('SPAM_MASTER_VERSION');
$spam_master_type = get_option('spam_master_type');
$license = get_option('spam_license_key');
$spam_master_multisite = "NO";
$spam_master_multisite_number = "0";
$spam_master_multisite_joined = $spam_master_multisite . ' - ' . $spam_master_multisite_number;
@$spam_master_server_ip = $_SERVER['SERVER_ADDR'];
	//if empty ip
	if(empty($spam_master_server_ip) || $spam_master_server_ip == '0' || $spam_master_server_ip == '127.0.0.1'){
		@$spam_master_ip_gethostbyname = gethostbyname($_SERVER['SERVER_NAME']);
		@$spam_master_server_ip = 'I '.$spam_master_ip_gethostbyname;
		if(empty($spam_master_ip_gethostbyname) || $spam_master_ip_gethostbyname == '0' || $spam_master_ip_gethostbyname == '127.0.0.1'){
			@$spam_master_urlparts = parse_url($web_address);
			@$spam_master_hostname = $spam_master_urlparts['host'];
			@$spam_master_result = dns_get_record($spam_master_hostname, DNS_A);
			@$spam_master_server_ip = 'i '.$spam_master_result[0]['ip'];
		}
	}
@$spam_master_server_hostname = gethostbyaddr($_SERVER['SERVER_ADDR']);
	//if empty host
	if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0' || $spam_master_server_hostname == '127.0.0.1'){
		@$spam_master_ho_gethostbyname = gethostbyname($_SERVER['SERVER_NAME']);
		@$spam_master_server_hostname = 'H '.$spam_master_ho_gethostbyname;
		if(empty($spam_master_ho_gethostbyname) || $$spam_master_ho_gethostbyname == '0' || $$spam_master_ho_gethostbyname == '127.0.0.1'){
			@$spam_master_urlparts = parse_url($web_address);
			@$spam_master_hostname = $spam_master_urlparts['host'];
			@$spam_master_result = dns_get_record($spam_master_hostname, DNS_A);
			@$spam_master_server_hostname = 'h '.$spam_master_result[0]['ip'];
		}
	}
//Set malfunctions as VALID
if($response_key == 'INACTIVE' || $response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
//remote post and response
$spam_master_license_post = array(
							'spam_license_key' => $spam_license_key,
							'platform' => $platform,
							'platform_version' => $wordpress,
							'platform_type' => $spam_master_multisite_joined,
							'spam_master_version' => $spam_master_version,
							'spam_master_type' => $spam_master_type,
							'blog_name' => $blog,
							'blog_address' => $address,
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
	if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		echo "Something went wrong, please get in touch with TechGasp Support: $error_message";
	}
	else {
		$data = json_decode( wp_remote_retrieve_body( $response ), true );
		if(empty($data)){
			$spam_master_type = 'EMPTY';
			update_option('spam_master_type', $spam_master_type);
			$spam_master_status = 'INACTIVE';
			update_option('spam_master_status', $spam_master_status);
			$spam_master_protection_total_number = '0';
			update_option('spam_master_protection_total_number', $spam_master_protection_total_number);
			$spam_master_alert_level_received = '';
			update_option('spam_master_alert_level', $spam_master_alert_level_received);
			$spam_master_alert_level_date = '';
			update_option('spam_master_alert_level_date', $spam_master_alert_level_date);
			$spam_master_alert_level_p_text = '';
			update_option('spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
		}
		else{
			$spam_master_type = $data['type'];
			update_option('spam_master_type', $spam_master_type);
			$spam_master_status = $data['status'];
			update_option('spam_master_status', $spam_master_status);
			$spam_master_protection_total_number = $data['threats'];
			update_option('spam_master_protection_total_number', $spam_master_protection_total_number);
			$spam_master_alert_level_received = $data['alert'];
			update_option('spam_master_alert_level', $spam_master_alert_level_received);
			$spam_master_alert_level_date = $spam_master_alert_level_date_set;
			update_option('spam_master_alert_level_date', $spam_master_alert_level_date);
			$spam_master_alert_level_p_text = $data['percent'];
			update_option('spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
			//Start Alert Emails
			if($spam_master_emails_alert_3_email == 'true'){
				if($spam_master_alert_level_received == 'ALERT_3'){
					require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert-3.php');
				}
			}
			if($spam_master_emails_alert_email == 'true'){
				if($spam_master_alert_level_received == 'ALERT_2' || $spam_master_alert_level_received == 'ALERT_1' || $spam_master_alert_level_received == 'ALERT_0'){
					require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert.php');
				}
			}
		}
	}
}
else{
}
//END SINGLE
}
?>
