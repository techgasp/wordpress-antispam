<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
global $wpdb, $blog_id, $current_user;
//Prepare License stuff
$platform = "Wordpress";
$spam_master_alert_level_date_set = date('Y-m-d H:i:s');
$spam_master_alert_level_date_auto = date('Y-m-d');
if( is_multisite() ){
$response_key = get_blog_option($blog_id, 'spam_master_status');
$spam_license_key = get_blog_option($blog_id, 'spam_license_key');
$spam_master_alert_level = get_blog_option($blog_id, 'spam_master_alert_level');
$spam_master_alert_level_date_received = get_blog_option($blog_id, 'spam_master_alert_level_date');
$spam_master_alert_level_date_received_manual = get_blog_option($blog_id, 'spam_master_alert_level_date_manual');
$spam_master_alert_level_p_text = get_blog_option($blog_id, 'spam_master_alert_level_p_text');
$spam_master_protection_total_number = get_blog_option($blog_id, 'spam_master_protection_total_number');
$spam_master_emails_alert_3_email = get_blog_option($blog_id, 'spam_master_emails_alert_3_email');
$spam_master_emails_alert_email = get_blog_option($blog_id, 'spam_master_emails_alert_email');
//create data to be posted
$wordpress = get_bloginfo('version');
$admin_email = get_blog_option($blog_id, 'admin_email');
$blog = get_blog_option($blog_id, 'blogname');
	if(empty($blog)){
		$blog = $admin_email;
	}
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
$web_address = get_site_url();
$address_unclean = $web_address;
$address = preg_replace('#^https?://#', '', $address_unclean);
$spam_master_version = constant('SPAM_MASTER_VERSION');
$spam_master_type = get_blog_option($blog_id, 'spam_master_type');
$license = get_blog_option($blog_id, 'spam_license_key');
$license_status = get_blog_option($blog_id, 'spam_master_status');
$spam_master_multisite = "YES";
$spam_master_multisite_number = get_blog_count();
$spam_master_multisite_joined = $spam_master_multisite . ' - ' . $spam_master_multisite_number;
@$spam_master_server_ip = $_SERVER['SERVER_ADDR'];
	//if empty ip
	if(empty($spam_master_server_ip) || $spam_master_server_ip == '0'){
		@$spam_master_server_ip = 'I '.gethostbyname($_SERVER['SERVER_NAME']);
	}
@$spam_master_server_hostname = gethostbyaddr($_SERVER['SERVER_ADDR']);
	//if empty host
	if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0'){
		@$spam_master_server_hostname = 'H '.gethostbyname($_SERVER['SERVER_NAME']);
	}
}
else{
$response_key = get_option('spam_master_status');
$spam_license_key = get_option('spam_license_key');
$spam_master_alert_level = get_option('spam_master_alert_level');
$spam_master_alert_level_date_received = get_option('spam_master_alert_level_date');
$spam_master_alert_level_date_received_manual = get_option('spam_master_alert_level_date_manual');
$spam_master_alert_level_p_text = get_option('spam_master_alert_level_p_text');
$spam_master_protection_total_number = get_option('spam_master_protection_total_number');
$spam_master_emails_alert_3_email = get_option('spam_master_emails_alert_3_email');
$spam_master_emails_alert_email = get_option('spam_master_emails_alert_email');
//create data to be posted
$wordpress = get_bloginfo('version');
$admin_email = get_option('admin_email');
$blog = get_option('blogname');
	if(empty($blog)){
		$blog = $admin_email;
	}
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
$web_address = get_site_url();
$address_unclean = $web_address;
$address = preg_replace('#^https?://#', '', $address_unclean);
$spam_master_version = constant('SPAM_MASTER_VERSION');
$spam_master_type = get_option('spam_master_type');
$license = get_option('spam_license_key');
$license_status = get_option('spam_master_status');
$spam_master_multisite = "NO";
$spam_master_multisite_number = "0";
$spam_master_multisite_joined = $spam_master_multisite . ' - ' . $spam_master_multisite_number;
@$spam_master_server_ip = $_SERVER['SERVER_ADDR'];
	//if empty ip
	if(empty($spam_master_server_ip) || $spam_master_server_ip == '0'){
		@$spam_master_server_ip = 'I '.gethostbyname($_SERVER['SERVER_NAME']);
	}
@$spam_master_server_hostname = gethostbyaddr($_SERVER['SERVER_ADDR']);
	//if empty host
	if(empty($spam_master_server_hostname) || $spam_master_server_hostname == '0'){
		@$spam_master_server_hostname = 'H '.gethostbyname($_SERVER['SERVER_NAME']);
	}
}

//Alert Update
if (isset($_POST['update_alert_level'])){
	$spam_master_cron = "ALERT";
	if (empty($spam_master_alert_level_date_received_manual) || $spam_master_alert_level_date_received_manual !== $spam_master_alert_level_date_auto){
		if( is_multisite() ){
			$spam_master_alert_post = array(
											'spam_license_key' => $spam_license_key,
											'platform' => $platform,
											'platform_version' => $wordpress,
											'platform_type' => $spam_master_multisite_joined,
											'spam_master_version' => $spam_master_version,
											'spam_master_type' => $spam_master_type,
											'blog_name' => $blog,
											'blog_address' => $address,
											'blog_admin' => $blog_admin_name_joined,
											'blog_email' => $admin_email,
											'blog_hostname' => $spam_master_server_hostname,
											'blog_ip' => $spam_master_server_ip,
											'spam_master_cron' => $spam_master_cron
											);
			$spam_master_license_url = 'aHR0cHM6Ly9zcGFtbWFzdGVyLnRlY2hnYXNwLmNvbS93cC1jb250ZW50L3BsdWdpbnMvc3BhbS1tYXN0ZXItYWRtaW5pc3RyYXRvci9pbmNsdWRlcy9saWNlbnNlL2dldF9hbGVydC5waHA=';
			$response = wp_remote_post( base64_decode($spam_master_license_url), array(
																				'method' => 'POST',
																				'timeout' => 45,
																				'body' => $spam_master_alert_post
																				)
																				);
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				echo "Something went wrong, please get in touch with TechGasp Support: $error_message";
			}
			else{
				$data = json_decode( wp_remote_retrieve_body( $response ), true );
				if(empty($data)){
					$spam_master_type = 'EMPTY';
					update_blog_option( $blog_id, 'spam_master_type', $spam_master_type);
					$spam_master_status = 'INACTIVE';
					$response_key = $spam_master_status;
					update_blog_option( $blog_id, 'spam_master_status', $spam_master_status);
					$spam_master_protection_total_number = '0';
					update_blog_option( $blog_id, 'spam_master_protection_total_number', $spam_master_protection_total_number);
					$spam_master_alert_level = '';
					update_blog_option($blog_id, 'spam_master_alert_level', $spam_master_alert_level);
					$spam_master_alert_level_date = '';
					update_blog_option($blog_id, 'spam_master_alert_level_date', $spam_master_alert_level_date);
					$spam_master_alert_level_date_received_manual = '';
					update_blog_option($blog_id, 'spam_master_alert_level_date_manual', $spam_master_alert_level_date_received_manual);
					$spam_master_alert_level_p_text = '';
					update_blog_option($blog_id, 'spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
				}
				else{
					$spam_master_type = $data['type'];
					update_blog_option( $blog_id, 'spam_master_type', $spam_master_type);
					$spam_master_status = $data['status'];
					$response_key = $spam_master_status;
					update_blog_option( $blog_id, 'spam_master_status', $spam_master_status);
					$spam_master_protection_total_number = $data['threats'];
					update_blog_option( $blog_id, 'spam_master_protection_total_number', $spam_master_protection_total_number);
					$spam_master_alert_level = $data['alert'];
					update_blog_option($blog_id, 'spam_master_alert_level', $spam_master_alert_level);
					$spam_master_alert_level_date = $spam_master_alert_level_date_set;
					update_blog_option($blog_id, 'spam_master_alert_level_date', $spam_master_alert_level_date);
					$spam_master_alert_level_date_received_manual = $spam_master_alert_level_date_auto;
					update_blog_option($blog_id, 'spam_master_alert_level_date_manual', $spam_master_alert_level_date_received_manual);
					$spam_master_alert_level_p_text = $data['percent'];
					update_blog_option($blog_id, 'spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
					//Start Alert Emails
					if($spam_master_emails_alert_3_email == 'true'){
						if($spam_master_alert_level == 'ALERT_3'){
							require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert-3.php');
						}
					}
					if($spam_master_emails_alert_email == 'true'){
						if($spam_master_alert_level == 'ALERT_2' || $spam_master_alert_level == 'ALERT_1' || $spam_master_alert_level == 'ALERT_0'){
							require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert.php');
						}
					}
				}
			}
		}
		else{
			$spam_master_alert_post = array(
											'spam_license_key' => $spam_license_key,
											'platform' => $platform,
											'platform_version' => $wordpress,
											'platform_type' => $spam_master_multisite_joined,
											'spam_master_version' => $spam_master_version,
											'spam_master_type' => $spam_master_type,
											'blog_name' => $blog,
											'blog_address' => $address,
											'blog_admin' => $admin_name_joined,
											'blog_email' => $admin_email,
											'blog_hostname' => $spam_master_server_hostname,
											'blog_ip' => $spam_master_server_ip,
											'spam_master_cron' => $spam_master_cron
											);
			$spam_master_license_url = 'aHR0cHM6Ly9zcGFtbWFzdGVyLnRlY2hnYXNwLmNvbS93cC1jb250ZW50L3BsdWdpbnMvc3BhbS1tYXN0ZXItYWRtaW5pc3RyYXRvci9pbmNsdWRlcy9saWNlbnNlL2dldF9hbGVydC5waHA=';
			$response = wp_remote_post( base64_decode($spam_master_license_url), array(
																				'method' => 'POST',
																				'timeout' => 45,
																				'body' => $spam_master_alert_post
																				)
																				);
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				echo "Something went wrong, please get in touch with TechGasp Support: $error_message";
			}
			else{
				$data = json_decode( wp_remote_retrieve_body( $response ), true );
				if(empty($data)){
					$spam_master_type = 'EMPTY';
					update_option('spam_master_type', $spam_master_type);
					$spam_master_status = 'INACTIVE';
					$response_key = $spam_master_status;
					update_option('spam_master_status', $spam_master_status);
					$spam_master_protection_total_number = '0';
					update_option('spam_master_protection_total_number', $spam_master_protection_total_number);
					$spam_master_alert_level = '';
					update_option('spam_master_alert_level', $spam_master_alert_level);
					$spam_master_alert_level_date = '';
					update_option('spam_master_alert_level_date', $spam_master_alert_level_date);
					$spam_master_alert_level_date_received_manual = '';
					update_option('spam_master_alert_level_date_manual', $spam_master_alert_level_date_received_manual);
					$spam_master_alert_level_p_text = '';
					update_option('spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
				}
				else{
					$spam_master_type = $data['type'];
					update_option('spam_master_type', $spam_master_type);
					$spam_master_status = $data['status'];
					$response_key = $spam_master_status;
					update_option('spam_master_status', $spam_master_status);
					$spam_master_protection_total_number = $data['threats'];
					update_option('spam_master_protection_total_number', $spam_master_protection_total_number);
					$spam_master_alert_level = $data['alert'];
					update_option('spam_master_alert_level', $spam_master_alert_level);
					$spam_master_alert_level_date = $spam_master_alert_level_date_set;
					update_option('spam_master_alert_level_date', $spam_master_alert_level_date);
					$spam_master_alert_level_date_received_manual = $spam_master_alert_level_date_auto;
					update_option('spam_master_alert_level_date_manual', $spam_master_alert_level_date_received_manual);
					$spam_master_alert_level_p_text = $data['percent'];
					update_option('spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
					//Start Alert Emails
					if($spam_master_emails_alert_3_email == 'true'){
						if($spam_master_alert_level == 'ALERT_3'){
							require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert-3.php');
						}
					}
					if($spam_master_emails_alert_email == 'true'){
						if($spam_master_alert_level == 'ALERT_2' || $spam_master_alert_level == 'ALERT_1' || $spam_master_alert_level == 'ALERT_0'){
							require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert.php');
						}
					}
				}
			}
		}
		?>
		<div id="message" class="updated fade">
		<p><?php _e('<h2>Spam Master Alert Level Manual Sync</h2>', 'spam_master'); ?></p>
		<p><?php _e('Daily manual-sync done. Alert Level Updated to -> ', 'spam_master'); ?><?php echo $spam_master_alert_level; ?></p>
		<p><?php _e('Alert Levels do not change over a matter of seconds or minutes, the RBL servers process your data over a time span using advanced algorithm heuristics to generate your alert levels.', 'spam_master'); ?></p>
		<p><?php _e('Wait for the next auto-sync or manual-sync again tomorrow.', 'spam_master'); ?></p>
		</div>
		<?php
	//end date
	}
	else{
		?>
		<div class="notice notice-warning is-dismissible">
		<p><?php _e('<h2>Spam Master Alert Level Manual Sync</h2>', 'spam_master'); ?></p>
		<p><?php _e('You already checked the Alert Level today, only 1 manual sync available per day. Wait for next auto-sync or try again tomorrow.', 'spam_master'); ?></p>
		<p><?php _e('Alert Levels do not change over a matter of seconds or minutes, the RBL servers process your data over a time span using advanced algorithm heuristics to generate your alert levels.', 'spam_master'); ?></p>
		<p><?php _e('Wait for the next auto-sync or manual-sync again tomorrow.', 'spam_master'); ?></p>
		</div>
		<?php
	}
//END POST
}
else{}

//RE-SYNC if FULL AND INACTIVE OR EXPIRED
if($spam_master_type == 'FULL'){
	if($license_status == 'INACTIVE' || $license_status == 'MALFUNCTION_1' || $license_status == 'MALFUNCTION_2' || $license_status == 'EXPIRED'){
		//creates button
		$spam_master_resync = '<p class="submit" style="margin-top:-10px !important; margin-bottom:-18px !important"><input class="button-primary" type="submit" name="resync_license" id="resync_license" value="RE-SYNCHRONIZE LICENSE NOW"  /></p>';
		//post button
		if(isset($_POST['resync_license'])){
			$spam_master_cron = "RESYN";
			if(!empty($spam_license_key)){
				//remote post and response
				$spam_master_license_sync = array(
												'spam_license_key' => $spam_license_key,
												'platform' => $platform,
												'platform_version' => $wordpress,
												'platform_type' => $spam_master_multisite_joined,
												'spam_master_version' => $spam_master_version,
												'spam_master_type' => $spam_master_type,
												'blog_name' => $blog,
												'blog_address' => $address,
												'blog_admin' => $blog_admin_name_joined,
												'blog_email' => $admin_email,
												'blog_hostname' => $spam_master_server_hostname,
												'blog_ip' => $spam_master_server_ip,
												'spam_master_cron' => $spam_master_cron
											);
				$spam_master_license_url = 'aHR0cHM6Ly9zcGFtbWFzdGVyLnRlY2hnYXNwLmNvbS93cC1jb250ZW50L3BsdWdpbnMvc3BhbS1tYXN0ZXItYWRtaW5pc3RyYXRvci9pbmNsdWRlcy9saWNlbnNlL2dldF9zeW5jLnBocA==';
				$response = wp_remote_post( base64_decode($spam_master_license_url), array(
																					'method' => 'POST',
																					'timeout' => 45,
																					'body' => $spam_master_license_sync
																					)
																					);
				if ( is_wp_error( $response ) ) {
					$error_message = $response->get_error_message();
					echo "Something went wrong, please get in touch with TechGasp Support with error: $error_message";
				}
				else{
					$data = json_decode( wp_remote_retrieve_body( $response ), true );
					if(empty($data)){
						if( is_multisite() ){
							$spam_master_type = 'EMPTY';
							update_blog_option( $blog_id, 'spam_master_type', $spam_master_type);
							$spam_master_status = 'INACTIVE';
							$response_key = $spam_master_status;
							update_blog_option( $blog_id, 'spam_master_status', $spam_master_status);
							$spam_master_protection_total_number = '0';
							update_blog_option( $blog_id, 'spam_master_protection_total_number', $spam_master_protection_total_number);
							$spam_master_alert_level = '';
							update_blog_option($blog_id, 'spam_master_alert_level', $spam_master_alert_level);
							$spam_master_alert_level_date = '';
							update_blog_option($blog_id, 'spam_master_alert_level_date', $spam_master_alert_level_date);
							$spam_master_alert_level_p_text = '';
							update_blog_option($blog_id, 'spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
						}
						else{
							$spam_master_type = 'EMPTY';
							update_option('spam_master_type', $spam_master_type);
							$spam_master_status = 'INACTIVE';
							$response_key = $spam_master_status;
							update_option('spam_master_status', $spam_master_status);
							$spam_master_protection_total_number = '0';
							update_option('spam_master_protection_total_number', $spam_master_protection_total_number);
							$spam_master_alert_level = '';
							update_option('spam_master_alert_level', $spam_master_alert_level);
							$spam_master_alert_level_date = '';
							update_option('spam_master_alert_level_date', $spam_master_alert_level_date);
							$spam_master_alert_level_p_text = '';
							update_option('spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
						}
					}
					else{
						if( is_multisite() ){
							$spam_master_type = $data['type'];
							update_blog_option( $blog_id, 'spam_master_type', $spam_master_type);
							$spam_master_status = $data['status'];
							$response_key = $spam_master_status;
							update_blog_option( $blog_id, 'spam_master_status', $spam_master_status);
							$spam_master_protection_total_number = $data['threats'];
							update_blog_option( $blog_id, 'spam_master_protection_total_number', $spam_master_protection_total_number);
							$spam_master_alert_level = $data['alert'];
							update_blog_option($blog_id, 'spam_master_alert_level', $spam_master_alert_level);
							$spam_master_alert_level_date = $spam_master_alert_level_date_set;
							update_blog_option($blog_id, 'spam_master_alert_level_date', $spam_master_alert_level_date);
							$spam_master_alert_level_p_text = $data['percent'];
							update_blog_option($blog_id, 'spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
						}
						else{
							$spam_master_type = $data['type'];
							update_option('spam_master_type', $spam_master_type);
							$spam_master_status = $data['status'];
							$response_key = $spam_master_status;
							update_option('spam_master_status', $spam_master_status);
							$spam_master_protection_total_number = $data['threats'];
							update_option('spam_master_protection_total_number', $spam_master_protection_total_number);
							$spam_master_alert_level = $data['alert'];
							update_option('spam_master_alert_level', $spam_master_alert_level);
							$spam_master_alert_level_date = $spam_master_alert_level_date_set;
							update_option('spam_master_alert_level_date', $spam_master_alert_level_date);
							$spam_master_alert_level_p_text = $data['percent'];
							update_option('spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
						}
						//Start Alert Emails
						if($spam_master_emails_alert_3_email == 'true'){
							if($spam_master_alert_level == 'ALERT_3'){
								require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert-3.php');
							}
						}
						if($spam_master_emails_alert_email == 'true'){
							if($spam_master_alert_level == 'ALERT_2' || $spam_master_alert_level == 'ALERT_1' || $spam_master_alert_level == 'ALERT_0'){
								require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert.php');
							}
						}
					}
				}
				?>
				<div id="message" class="updated fade">
				<p><?php _e('License RE-SYNC Done.', 'spam_master'); ?></p>
				</div>
				<?php
			}
			else{
				?>
				<div class="notice notice-warning is-dismissible">
				<p><?php _e('Your License is empty, please insert a valid license, press Save & Refresh, press Activate License.', 'spam_master'); ?></p>
				</div>
				<?php
			}
		//END POST
		}
		else{}
	}
	else{
		$spam_master_resync = false;
	}
}
else{
	$spam_master_resync = false;
}

//License Update post in wordpress
if (isset($_POST['update_license'])){
	$spam_master_cron = "MAN";
	if (!empty($_POST['spam_master_new_license'])){
		$spam_master_new_license = sanitize_text_field($_POST['spam_master_new_license']);
		if( is_multisite() ){
			//ONLY IF LICENSE IS DIFFERENT 
			$spam_master_old_license = get_blog_option( $blog_id, 'spam_license_key_old_code');
			if ($spam_master_old_license !== $spam_master_new_license){
				update_blog_option($blog_id, 'spam_license_key_old_code', $spam_master_new_license);
				update_blog_option($blog_id, 'spam_license_key', $spam_master_new_license);
				$spam_license_key = $spam_master_new_license;
				//remote post and response
				$spam_master_license_post = array(
												'spam_license_key' => $spam_master_new_license,
												'platform' => $platform,
												'platform_version' => $wordpress,
												'platform_type' => $spam_master_multisite_joined,
												'spam_master_version' => $spam_master_version,
												'spam_master_type' => $spam_master_type,
												'blog_name' => $blog,
												'blog_address' => $address,
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
				if ( is_wp_error( $response ) ) {
					$error_message = $response->get_error_message();
					echo "Something went wrong, please get in touch with TechGasp Support with error: $error_message";
				}
				else {
					$data = json_decode( wp_remote_retrieve_body( $response ), true );
					if(empty($data)){
						$spam_master_type = 'EMPTY';
						update_blog_option( $blog_id, 'spam_master_type', $spam_master_type);
						$spam_master_status = 'INACTIVE';
						$response_key = $spam_master_status;
						update_blog_option( $blog_id, 'spam_master_status', $spam_master_status);
						$spam_master_protection_total_number = '0';
						update_blog_option( $blog_id, 'spam_master_protection_total_number', $spam_master_protection_total_number);
						$spam_master_alert_level = '';
						update_blog_option($blog_id, 'spam_master_alert_level', $spam_master_alert_level);
						$spam_master_alert_level_date = '';
						update_blog_option($blog_id, 'spam_master_alert_level_date', $spam_master_alert_level_date);
						$spam_master_alert_level_p_text = '';
						update_blog_option($blog_id, 'spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
					}
					else{
						$spam_master_type = $data['type'];
						update_blog_option( $blog_id, 'spam_master_type', $spam_master_type);
						$spam_master_status = $data['status'];
						$response_key = $spam_master_status;
						update_blog_option( $blog_id, 'spam_master_status', $spam_master_status);
						$spam_master_protection_total_number = $data['threats'];
						update_blog_option( $blog_id, 'spam_master_protection_total_number', $spam_master_protection_total_number);
						$spam_master_alert_level = $data['alert'];
						update_blog_option($blog_id, 'spam_master_alert_level', $spam_master_alert_level);
						$spam_master_alert_level_date = $spam_master_alert_level_date_set;
						update_blog_option($blog_id, 'spam_master_alert_level_date', $spam_master_alert_level_date);
						$spam_master_alert_level_p_text = $data['percent'];
						update_blog_option($blog_id, 'spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
						//Start Alert Emails
						if($spam_master_emails_alert_3_email == 'true'){
							if($spam_master_alert_level == 'ALERT_3'){
								require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert-3.php');
							}
						}
						if($spam_master_emails_alert_email == 'true'){
							if($spam_master_alert_level == 'ALERT_2' || $spam_master_alert_level == 'ALERT_1' || $spam_master_alert_level == 'ALERT_0'){
								require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert.php');
							}
						}
					}
				}
			}
		}
		else{
			//ONLY IF LICENSE IS DIFFERENT 
			$spam_master_old_license = get_option('spam_license_key_old_code');
			if ($spam_master_old_license !== $spam_master_new_license){
				update_option('spam_license_key_old_code', $spam_master_new_license);
				update_option('spam_license_key', $spam_master_new_license);
				$spam_license_key = $spam_master_new_license;
				//remote post and response
				$spam_master_license_post = array(
												'spam_license_key' => $spam_master_new_license,
												'platform' => $platform,
												'platform_version' => $wordpress,
												'platform_type' => $spam_master_multisite_joined,
												'spam_master_version' => $spam_master_version,
												'spam_master_type' => $spam_master_type,
												'blog_name' => $blog,
												'blog_address' => $address,
												'blog_admin' => $admin_name_joined,
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
					echo "Something went wrong, please get in touch with TechGasp Support with error: $error_message";
				}
				else {
					$data = json_decode( wp_remote_retrieve_body( $response ), true );
					if(empty($data)){
						$spam_master_type = 'EMPTY';
						update_option('spam_master_type', $spam_master_type);
						$spam_master_status = 'INACTIVE';
						$response_key = $spam_master_status;
						update_option('spam_master_status', $spam_master_status);
						$spam_master_protection_total_number = '0';
						update_option('spam_master_protection_total_number', $spam_master_protection_total_number);
						$spam_master_alert_level = '';
						update_option('spam_master_alert_level', $spam_master_alert_level);
						$spam_master_alert_level_date = '';
						update_option('spam_master_alert_level_date', $spam_master_alert_level_date);
						$spam_master_alert_level_p_text = '';
						update_option('spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
					}
					else{
						$spam_master_type = $data['type'];
						update_option('spam_master_type', $spam_master_type);
						$spam_master_status = $data['status'];
						$response_key = $spam_master_status;
						update_option('spam_master_status', $spam_master_status);
						$spam_master_protection_total_number = $data['threats'];
						update_option('spam_master_protection_total_number', $spam_master_protection_total_number);
						$spam_master_alert_level = $data['alert'];
						update_option('spam_master_alert_level', $spam_master_alert_level);
						$spam_master_alert_level_date = $spam_master_alert_level_date_set;
						update_option('spam_master_alert_level_date', $spam_master_alert_level_date);
						$spam_master_alert_level_p_text = $data['percent'];
						update_option('spam_master_alert_level_p_text', $spam_master_alert_level_p_text);
						//Start Alert Emails
						if($spam_master_emails_alert_3_email == 'true'){
							if($spam_master_alert_level == 'ALERT_3'){
								require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert-3.php');
							}
						}
						if($spam_master_emails_alert_email == 'true'){
							if($spam_master_alert_level == 'ALERT_2' || $spam_master_alert_level == 'ALERT_1' || $spam_master_alert_level == 'ALERT_0'){
								require_once(plugin_dir_path( __FILE__ ) . '../emails/spam-master-admin-emails-mail-alert.php');
							}
						}
					}
				}
			}
		}
		?>
		<div id="message" class="updated fade">
		<p><?php _e('License Saved & Refreshed', 'spam_master'); ?></p>
		</div>
		<?php
	}
	else{
		?>
		<div class="notice notice-warning is-dismissible">
		<p><?php _e('Your License is empty, please insert a valid license.', 'spam_master'); ?></p>
		</div>
		<?php
	}
//END POST
}
else{}

//STATUS VALID
if ($response_key == 'VALID'){
	$spam_master_protection_selection = $spam_master_type. ' ACTIVE ONLINE';
	$spam_master_protection_bgcolor= "07B357";
	$license_color = "07B357";
	$license_status = "VALID LICENSE";
	$spam_license_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	if(empty($spam_master_alert_level_date_received_manual) || $spam_master_alert_level_date_received_manual !== $spam_master_alert_level_date_auto){
		$spam_master_alert_level_date_check_button = '<a class="submit"><input class="button-primary" name="update_alert_level" id="update_alert_level" value="Manual Check" type="submit"></a>';
		$spam_master_alert_level_date_received_manual = "Not Checked";
		$spam_master_alert_level_manual_text = "1 daily manual check available";
	}
	else{
		$spam_master_alert_level_date_check_button = '<a class="button-secondary" title="Manual Daily Check Used">Check Done</a>';
		$spam_master_alert_level_date_received_manual = $spam_master_alert_level_date_received_manual;
		$spam_master_alert_level_manual_text = "daily check used";
	}
	$protection_total_number_text = number_format($spam_master_protection_total_number).' Threats & Exploits';
}
//STATUS EXPIRED
if ($response_key == 'EXPIRED'){
	$spam_master_protection_selection = 'EXPIRED OFFLINE';
	$spam_master_protection_bgcolor= "F2AE41";
	$license_color = "F2AE41";
	$license_status = "EXPIRED LICENSE";
	$spam_license_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_date_check_button = '<a class="button-secondary" title="Manual Check">Manual Check</a>';
	$spam_master_alert_level_date_received_manual = "No Check";
	$spam_master_alert_level_manual_text = "EXPIRED OFFLINE";
	$protection_total_number_text = "0 Threats & Exploits - EXPIRED OFFLINE";
}
//STATUS MALFUNCTION_1
if ($response_key == 'MALFUNCTION_1'){
	$spam_master_protection_selection = 'MALFUNCTION_1 ACTIVE ONLINE';
	$spam_master_protection_bgcolor= "563a3a";
	$license_color = "563a3a";
	$license_status = "VALID LICENSE";
	$spam_license_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	if(empty($spam_master_alert_level_date_received_manual) || $spam_master_alert_level_date_received_manual !== $spam_master_alert_level_date_auto){
		$spam_master_alert_level_date_check_button = '<a class="submit"><input class="button-primary" name="update_alert_level" id="update_alert_level" value="Manual Check" type="submit"></a>';
		$spam_master_alert_level_date_received_manual = "Not Checked";
		$spam_master_alert_level_manual_text = "1 daily manual check available - MALFUNCTION_1 detected";
	}
	else{
		$spam_master_alert_level_date_check_button = '<a class="button-secondary" title="Manual Daily Check Used">Check Done</a>';
		$spam_master_alert_level_date_received_manual = $spam_master_alert_level_date_received_manual;
		$spam_master_alert_level_manual_text = "daily check used - MALFUNCTION_1 detected";
	}
	$protection_total_number_text = number_format($spam_master_protection_total_number).' Threats & Exploits';
}
//STATUS MALFUNCTION_2
if ($response_key == 'MALFUNCTION_2'){
	$spam_master_protection_selection = 'MALFUNCTION_2 ACTIVE ONLINE';
	$spam_master_protection_bgcolor= "563a3a";
	$license_color = "563a3a";
	$license_status = "VALID LICENSE";
	$spam_license_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	if(empty($spam_master_alert_level_date_received_manual) || $spam_master_alert_level_date_received_manual !== $spam_master_alert_level_date_auto){
		$spam_master_alert_level_date_check_button = '<a class="submit"><input class="button-primary" name="update_alert_level" id="update_alert_level" value="Manual Check" type="submit"></a>';
		$spam_master_alert_level_date_received_manual = "Not Checked";
		$spam_master_alert_level_manual_text = "1 daily manual check available - MALFUNCTION_2 detected";
	}
	else{
		$spam_master_alert_level_date_check_button = '<a class="button-secondary" title="Manual Daily Check Used">Check Done</a>';
		$spam_master_alert_level_date_received_manual = $spam_master_alert_level_date_received_manual;
		$spam_master_alert_level_manual_text = "daily check used - MALFUNCTION_2 detected";
	}
	$protection_total_number_text = number_format($spam_master_protection_total_number).' Threats & Exploits';
}
//STATUS MALFUNCTION_3
if ($response_key == 'MALFUNCTION_3'){
	$spam_master_protection_selection = 'MALFUNCTION_3 INACTIVE OFFLINE';
	$spam_master_protection_bgcolor= "F2AE41";
	$license_color = "F2AE41";
	$license_status = "MALFUNCTION_3 OFFLINE";
	$spam_license_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_date_check_button = '<a class="button-secondary" title="Manual Check">Manual Check</a>';
	$spam_master_alert_level_date_received_manual = "No Check";
	$spam_master_alert_level_manual_text = "MALFUNCTION_3 OFFLINE";
	$protection_total_number_text = "0 Threats & Exploits - MALFUNCTION_3 OFFLINE";
	
}
//STATUS INACTIVE, NO LICENSE SENT YET
if ($response_key == 'INACTIVE'){
	$spam_master_protection_selection = 'INACTIVE OFFLINE';
	$spam_master_protection_bgcolor= "563a3a";
	$license_color = "563a3a";
	$license_status = "INACTIVE LICENSE";
	$spam_license_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	if($spam_master_type == 'TRIAL' || $spam_master_type == 'EMPTY'){
		$spam_master_alert_level_date_check_button = '<a class="button-secondary" title="Manual Check">Manual Check</a>';
		$spam_master_alert_level_date_received_manual = "No Check";
		$spam_master_alert_level_manual_text = "INACTIVE OFFLINE";
	}
	if($spam_master_type == 'FULL'){
		if(empty($spam_master_alert_level_date_received_manual) || $spam_master_alert_level_date_received_manual !== $spam_master_alert_level_date_auto){
			$spam_master_alert_level_date_check_button = '<a class="submit"><input class="button-primary" name="update_alert_level" id="update_alert_level" value="Manual Check" type="submit"></a>';
			$spam_master_alert_level_date_received_manual = "Not Checked";
			$spam_master_alert_level_manual_text = "1 daily manual check available";
		}
		else{
			$spam_master_alert_level_date_check_button = '<a class="button-secondary" title="Manual Daily Check Used">Check Done</a>';
			$spam_master_alert_level_date_received_manual = $spam_master_alert_level_date_received_manual;
			$spam_master_alert_level_manual_text = "daily check used";
		}
	}	
	$protection_total_number_text = "0 Threats & Exploits - INACTIVE OFFLINE";
}

//ALERT LEVEL, EMPTY
if(empty($spam_master_alert_level)){
	$spam_master_alert_bgcolor = "959090";
	$spam_master_alert_level_date_received = "No Check";
	$spam_master_alert_level_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" title="Your Website did not sync" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_text = "No RBL (real-time blacklist) Server Sync";
	$spam_master_alert_level_p_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" title="Your Website did not sync" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_p_text = "No RBL (real-time blacklist) Server Sync";
	$spam_master_alert_level_p_label = "";
}
//ALERT LEVEL, ALERT_0
if ($spam_master_alert_level == 'ALERT_0'){
	$spam_master_alert_bgcolor = "28292a";
	$spam_master_alert_level_icon = '<img src="'.plugins_url('../images/alert-0.png', dirname(__FILE__)).'" title="Your Website is in Alert Level 0" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_text = "Low level of spam and threats. Your website is mainly being visited by occasional harvester bots.";
	$spam_master_alert_level_p_icon = '<img src="'.plugins_url('../images/alert-p-0.png', dirname(__FILE__)).'" title="Your Website Spam Probability" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_p_label = "percent probability";
}
//ALERT LEVEL, ALERT_1
if ($spam_master_alert_level == 'ALERT_1'){
	$spam_master_alert_bgcolor = "28292a";
	$spam_master_alert_level_icon = '<img src="'.plugins_url('../images/alert-1.png', dirname(__FILE__)).'" title="Your Website is in Alert Level 1" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_text = "Low level of spam and threats. Your website is mainly being visited by occasional human spammers and harvester bots.";
	$spam_master_alert_level_p_icon = '<img src="'.plugins_url('../images/alert-p-1.png', dirname(__FILE__)).'" title="Your Website Spam Probability" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_p_label = "percent probability";
}
//ALERT LEVEL, ALERT_2
if ($spam_master_alert_level == 'ALERT_2'){
	$spam_master_alert_bgcolor = "28292a";
	$spam_master_alert_level_icon = '<img src="'.plugins_url('../images/alert-2.png', dirname(__FILE__)).'" title="Your Website is in Alert Level 2" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_text = "Medium level of spam and threats. Spam Master is actively fighting constant attempts of spam and threats by machine bots.";
	$spam_master_alert_level_p_icon = '<img src="'.plugins_url('../images/alert-p-2.png', dirname(__FILE__)).'" title="Your Website Spam Probability" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_p_label = "percent probability";
}
//ALERT LEVEL, ALERT_3
if ($spam_master_alert_level == 'ALERT_3'){
	$spam_master_alert_bgcolor = "28292a";
	$spam_master_alert_level_icon = '<img src="'.plugins_url('../images/alert-3.png', dirname(__FILE__)).'" title="Your Website is in Alert Level 3" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_text = "WARNING! High level of spam and threats, flood detected. Spam Master is fighting an array of human spammers and bot networks which include exploit attempts.";
	$spam_master_alert_level_p_icon = '<img src="'.plugins_url('../images/alert-p-3.png', dirname(__FILE__)).'" title="Your Website Spam Probability" style="height:24px; vertical-align:middle;" />';
	$spam_master_alert_level_p_label = "percent probability";
}
$treat_level_icon_0 = '<img src="'.plugins_url('../images/alert-0.png', dirname(__FILE__)).'" title="Alert Level 0" style="height:28px; vertical-align:middle;" />';
$treat_level_icon_1 = '<img src="'.plugins_url('../images/alert-1.png', dirname(__FILE__)).'" title="Alert Level 1" style="height:28px; vertical-align:middle;" />';
$treat_level_icon_2 = '<img src="'.plugins_url('../images/alert-2.png', dirname(__FILE__)).'" title="Alert Level 2" style="height:28px; vertical-align:middle;" />';
$treat_level_icon_3 = '<img src="'.plugins_url('../images/alert-3.png', dirname(__FILE__)).'" title="Alert Level 3" style="height:28px; vertical-align:middle;" />';
$spam_master_alert_level_icon_trans = '<img src="'.plugins_url('../images/check.png', dirname(__FILE__)).'" title="Manual Alert Level Check" style="height:24px; vertical-align:middle;" />';
$spam_master_alert_level_icon_shield = '<img src="'.plugins_url('../images/shield.png', dirname(__FILE__)).'" title="Protected Against" style="height:24px; vertical-align:middle;" />';
?>
<br>

<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Threat Alert Level', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th colspan="2"><?php echo $treat_level_icon_0; ?>&nbsp;<?php echo $treat_level_icon_1; ?>&nbsp;<?php echo $treat_level_icon_2; ?>&nbsp;<?php echo $treat_level_icon_3; ?> <a class="button-secondary" href="https://wordpress.techgasp.com/spam-master-documentation/#threat_level" target="_blank" title="Spam Master Documentation">Alert Levels Documentation</a></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle; width:20%;" nowrap>Your Website Alert Level:</td>
			<td style="vertical-align:middle;" bgcolor="#<?php echo $spam_master_alert_bgcolor; ?>"><font color="white"><b><?php echo $spam_master_alert_level_icon; ?>&nbsp;&nbsp;Auto Check:&nbsp;<?php echo $spam_master_alert_level_date_received; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $spam_master_alert_level_text; ?></b></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width:20%;" nowrap>Spam Activity Probability:</td>
			<td style="vertical-align:middle;"bgcolor="#<?php echo $spam_master_alert_bgcolor; ?>"><font color="white"><b><?php echo $spam_master_alert_level_p_icon; ?>&nbsp;&nbsp;<?php echo $spam_master_alert_level_p_text; ?>&nbsp;<?php echo $spam_master_alert_level_p_label; ?></b></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width:20%;" nowrap>Protected Against:</td>
			<td style="vertical-align:middle;"bgcolor="#<?php echo $spam_master_alert_bgcolor; ?>"><font color="white"><b><?php echo $spam_master_alert_level_icon_shield; ?>&nbsp;&nbsp;<?php echo $protection_total_number_text; ?></b></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width:20%;" nowrap><?php echo $spam_master_alert_level_date_check_button; ?></td>
			<td style="vertical-align:middle;"bgcolor="#<?php echo $spam_master_alert_bgcolor; ?>"><font color="white"><b><?php echo $spam_master_alert_level_icon_trans; ?>&nbsp;&nbsp;Manual Check:&nbsp;<?php echo $spam_master_alert_level_date_received_manual; ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $spam_master_alert_level_manual_text; ?></b></td>
		</tr>
	</tbody>
</table>
</fieldset>
</form>

<br>

<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Protection Status', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th colspan="2"><a class="button-secondary" href="https://wordpress.techgasp.com/spam-master-documentation/#protection_status" target="_blank" title="Spam Master Documentation">Protection Status Documentation</a></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle; width:20%;" nowrap>Protection Status:</td>
			<td style="vertical-align:middle;" bgcolor="#<?php echo $spam_master_protection_bgcolor; ?>"><font color="white"><b><?php echo $spam_license_status_icon; ?>&nbsp;&nbsp;<?php echo $spam_master_protection_selection; ?></b></td>
		</tr>
	</tbody>
</table>

<br>

<form method="post" width='1'>
<fieldset class="options">
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;License Status', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th>
				<p class="submit" style="margin-top:-10px !important; margin-bottom:-18px !important"><input class='button-primary' type='submit' name='update_license' id='update_license' value='<?php _e("Save & Refresh", 'spam_master'); ?>'  /></p>
			</th>
			<th>
				<?php echo $spam_master_resync; ?>
			</th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle; width:20%;">Insert Spam Master License:</td>
			<td style="vertical-align:middle; padding-left: 0px;"><input class="" id="spam_master_new_license" name="spam_master_new_license" type="text" size="40" value="<?php echo $spam_license_key; ?>"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width:20%;">License Status:</td>
			<td style="vertical-align:middle;" bgcolor="#<?php echo $license_color; ?>"><font color="white"><b><?php echo $spam_license_status_icon; ?>&nbsp;&nbsp;<?php echo $license_status; ?></b></font></td>
		</tr>
		<tr class="alternate">
			<td colspan="2" style="vertical-align:middle;"><a class="button-secondary" href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="Visit Website">get rbl protection license</a></td>
		</tr>
	</tbody>
</table>
</fieldset>
</form>
