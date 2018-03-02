<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	if ((is_user_logged_in()) && (current_user_can( 'administrator' ))){
	global $wpdb, $blog_id;
	//Prepare Global Data
	$wordpress = get_bloginfo('version');
	$web_adress = get_site_url();
	$web_home = home_url();
	$current_user = wp_get_current_user();
	$admin_first_name = $current_user->user_firstname;
	$admin_last_name = $current_user->user_lastname ;
	$admin_name_joined = $admin_first_name . ' ' . $admin_last_name;
	$plugin_master_name = constant('SPAM_MASTER_NAME');
	$plugin_master_version = constant('SPAM_MASTER_VERSION');
	$plugin_master_server_ip = $_SERVER['SERVER_ADDR'];
	$plugin_master_server_hostname = @gethostbyaddr($_SERVER['SERVER_ADDR']);
	$theme_data = wp_get_theme();
	$theme = $theme_data->Name . ' - Version: ' . $theme_data->Version;
	$post_stati = implode( ', ', get_post_stati() );
	$php_version = PHP_VERSION;
	$webserver = $_SERVER['SERVER_SOFTWARE'];
	$webserver_suhosin = extension_loaded( 'suhosin' ) ? 'Your server has SUHOSIN installed.' : 'Your server does not have SUHOSIN installed.';
	$wordpress_memory = WP_MEMORY_LIMIT;
	$php_safe_mode = ini_get( 'safe_mode' ) ? "Yes" : "No";
	$php_memory_limit = ini_get( 'memory_limit' );
	$php_upload_max_size = ini_get( 'upload_max_filesize' );
	$php_post_max_size = ini_get( 'post_max_size' );
	$php_time_limit = ini_get( 'upload_max_filesize' );
	$php_max_input_vars = ini_get( 'max_input_vars' );
	$php_arg_separator = ini_get( 'arg_separator.output' );
	$php_allow_url_fopen = ini_get( 'allow_url_fopen' ) ? "Yes" : "No";
	$php_display_errors = ini_get( 'display_errors' ) ? 'On (' . ini_get( 'display_errors' ) . ')' : 'N/A';
	$php_fsockopen = function_exists( 'fsockopen' ) ? 'Your server supports fsockopen.' : 'Your server does not support fsockopen.';
	$php_curl = function_exists( 'curl_init' ) ? 'Your server supports cURL.' : 'Your server does not support cURL.';
	$php_soap_client = class_exists( 'SoapClient' ) ? 'Your server has the SOAP Client enabled.' : 'Your server does not have the SOAP Client enabled.';
	$wp_debug = defined( 'WP_DEBUG' ) ? WP_DEBUG ? 'Enabled' : 'Disabled' : 'Not set';
	$wp_table_prefix = $wpdb->prefix;
	//Prepare Specific Data
	if( is_multisite() ){
		$blog = get_blog_option($blog_id, 'blogname');
		$admin_email = get_blog_option($blog_id, 'admin_email');
		$license = get_blog_option($blog_id, 'spam_license_key');
		$status = get_blog_option($blog_id, 'spam_license_status' );
		$status_error = get_blog_option($blog_id, 'spam_license_error' );
		$license_expires = get_blog_option($blog_id, 'spam_license_expires' );
		$plugin_master_multisite = "YES";
		$plugin_master_multisite_number = get_blog_count();
		$plugin_master_multisite_joined = $plugin_master_multisite . ' - ' . $plugin_master_multisite_number;
	}
	else{
		$blog = get_option('blogname');
		$admin_email = get_option('admin_email');
		$license = get_option('spam_license_key');
		$status = get_option( 'spam_license_status' );
		$status_error = get_option( 'spam_license_error' );
		$license_expires = get_option( 'spam_license_expires' );
		$plugin_master_multisite = "NO";
		$plugin_master_multisite_number = "0";
		$plugin_master_multisite_joined = $plugin_master_multisite . ' - ' . $plugin_master_multisite_number;
	}
	if(empty($license)){
		$license = "empty";
	}
	if(empty($license_expires)){
		$license_expires = "empty";
	}
	if(empty($status)){
		$status = "empty";
	}
	if(empty($status_error)){
		$status_error = "empty";
	}

	//CREATE LOCAL FILE
	// Make a DateTime object and get a time stamp for the filename
	$date = new DateTime();
	$ts = $date->format("Y-m-d-G");
	// A name with a time stamp, to avoid duplicate filenames
	$filename = 'plugin_info_'.$ts.'.txt';
	//opens file to write
	$fp = fopen($filename, 'w');
	// List Records
	$hrow = '--------------------------------'."\n".
			"\n".
			'<-Plugin Data->'."\n".
			'Plugin Name: '.$plugin_master_name.' - Version: '.$plugin_master_version."\n".
			'Plugin License: '.$license.' - License Expires: '.$license_expires."\n".
			'Plugin License Status: '.$status.' - License Error: '.$status_error."\n".
			"\n".
			'--------------------------------'."\n".
			"\n".
			'<-Website Data->'."\n".
			'Wordpress Version: '.$wordpress."\n".
			'Wordpress Memory: '.$wordpress_memory."\n".
			'Wordpress Debug: '.$wp_debug."\n".
			'Wordpress DB Prefix: '.$wp_table_prefix."\n".
			'Wordpress Multisite: '.$plugin_master_multisite_joined."\n".
			'Blog Name: '.$blog."\n".
			'Blog Home: '.$web_home."\n".
			'Blog Address: '.$web_adress."\n".
			'Blog Admin: '.$admin_name_joined.' - Blog Email: '.$admin_email."\n".
			'Blog Hostname: '.$plugin_master_server_hostname."\n".
			'Blog Ip: '.$plugin_master_server_ip."\n".
			'Blog Theme: '.$theme."\n".
			'Registered Post Stati: '.$post_stati."\n".
			"\n".
			'--------------------------------'."\n".
			"\n".
			'<-Website Engine->'."\n".
			'WEBSERVER: '.$webserver."\n".
			'WEBSERVER SUHOSIN: '.$webserver_suhosin."\n".
			'PHP VERSION: '.$php_version."\n".
			'PHP SAFE MODE: '.$php_safe_mode."\n".
			'PHP MEMORY LIMIT: '.$php_memory_limit."\n".
			'PHP UPLOAD MAX SIZE: '.$php_upload_max_size."\n".
			'PHP POST MAX SIZE: '.$php_post_max_size."\n".
			'PHP TIME LIMIT: '.$php_time_limit."\n".
			'PHP MAX INPUT VARS: '.$php_max_input_vars."\n".
			'PHP ARG SEPARATOR: '.$php_arg_separator."\n".
			'PHP FOPEN: '.$php_allow_url_fopen."\n".
			'PHP FSOCKSOPEN: '.$php_fsockopen."\n".
			'PHP CURL: '.$php_curl."\n".
			'PHP SOAP CLIENT: '.$php_soap_client."\n".
			"\n".
			'--------------------------------'."\n";
	// Extracts the keys of the first record and writes them
	fputs($fp, $hrow);
	// Close the output buffer (Like you would a file)
	fclose($fp);
	//DOWNLOAD LETS PUSH THE FILE TO THE BROWSER
	header( 'Content-type: text/plain' );
	header( 'Content-Disposition: attachment;filename='.$filename);
	//header('Expires: 0');
	//header('Cache-Control: no-cache');
	readfile($filename);
	@unlink($filename);
	// This function removes all content from the output buffer
	flush();
//end if logged_in and admin
}
?>
