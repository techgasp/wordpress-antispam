<?php
// Multisite Block
if( is_multisite()){
$response_key = get_blog_option($blog_id, 'spam_master_status');
	//Set malfunctions as VALID
	//post data if license status is valid
	if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
	add_filter('wpmu_validate_user_signup', 'spam_master_email_check', 99);
	function spam_master_email_check($result){
	global $wpdb, $blog_id;
	//prepare threat buffer
	$spam_master_blacklist = get_blog_option($blog_id, 'blacklist_keys');
	$blacklist_string = $spam_master_blacklist;
	$blacklist_array = explode("\n", $blacklist_string);
	$blacklist_size = sizeof($blacklist_array);
	$data = $_POST['user_email'];
	$blog_threat_ip = $_SERVER['REMOTE_ADDR'];
		// Analyse List
		for($i = 0; $i < $blacklist_size; $i++){
		$blacklist_current = trim($blacklist_array[$i]);
		//check buffer
			if(stripos($data, $blacklist_current) !== false){
				$spam_master_transient_array = array('date' => current_time( 'mysql' ),
													'type' => 'Registration',
													'threat_ip' => $blog_threat_ip,
													'threat_email' => $blog_threat_email,
													'details' => 'wordpress registration attempt');
				json_encode($spam_master_transient_array);
				$result['errors']->add('invalid_email',__('<strong>SPAM MASTER</strong>' . get_blog_option($blog_id, 'spam_master_message'),'spam_master'))& set_site_transient('spam_master_invalid_email'.current_time( 'mysql' ), $spam_master_transient_array, 604800 );
				$count = $result;
				$blog_prefix = $wpdb->get_blog_prefix($blog_id);
				$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
				echo '<p class="error"><strong>SPAM MASTER</strong>'.get_blog_option($blog_id, 'spam_master_message').'</p>';
			//end for
			}
		//end for
		}
			//buffer empty
			if(!empty($data) && stripos($user_email, $blacklist_current) == false){
				//create data to be posted
				$blog_license_key = get_blog_option($blog_id, 'spam_license_key');
				$blog_threat_type = 'registration';
				if(empty($data)){
					$data = "Spam Bot";
				}
				$blog_threat_email = wp_strip_all_tags($data);
				$blog_threat_content = 'registration';
				$blog_web_address = get_site_url();
				$address_unclean = $blog_web_address;
				$address = preg_replace('#^https?://#', '', $address_unclean);
				@$blog_server_ip = $_SERVER['SERVER_ADDR'];
				//if empty ip
				if(empty($blog_server_ip) || $blog_server_ip == '0'){
					@$blog_server_ip = 'I '.gethostbyname($_SERVER['SERVER_NAME']);
				}
				$spam_master_learning_post = array(
											'blog_license_key' => $blog_license_key,
											'blog_threat_ip' => $blog_threat_ip,
											'blog_threat_type' => $blog_threat_type,
											'blog_threat_email' => $blog_threat_email,
											'blog_threat_content' => $blog_threat_content,
											'blog_web_adress' => $address,
											'blog_server_ip' => $blog_server_ip
											);										
				$spam_master_leaning_url = 'aHR0cHM6Ly9zcGFtbWFzdGVyLnRlY2hnYXNwLmNvbS93cC1jb250ZW50L3BsdWdpbnMvc3BhbS1tYXN0ZXItYWRtaW5pc3RyYXRvci9pbmNsdWRlcy9sZWFybmluZy9nZXRfbGVhcm5fcmVnLnBocA==';
				$response = wp_remote_post( base64_decode($spam_master_leaning_url), array(
																					'method' => 'POST',
																					'timeout' => 45,
																					'body' => $spam_master_learning_post
																					)
																				);
					if ( is_wp_error( $response ) ) {
						$error_message = $response->get_error_message();
						echo "Something went wrong, please get in touch with TechGasp Support: $error_message";
					}
					else {
						$data = json_decode( wp_remote_retrieve_body( $response ), true );
						if(empty($data)){
						}
						else{
							$spam_threat = $data['threat'];
							//add to buffer	ip and email
							$spam_master_array_email = array_merge(explode("\n", $blog_threat_email), explode("\n", $spam_master_blacklist));
							$spam_master_array_ip = array_merge(explode("\n", $blog_threat_ip), explode("\n", $spam_master_blacklist));
							$spam_master_array = array_merge_recursive($spam_master_array_email, $spam_master_array_ip);
							$spam_master_array = array_map("trim", $spam_master_array);
							sort ($spam_master_array);
							$spam_master_string = implode("\n", array_unique($spam_master_array));
							update_blog_option($blog_id, 'blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																'type' => 'Registration',
																'threat_ip' => $blog_threat_ip,
																'threat_email' => $blog_threat_email,
																'details' => 'wordpress registration attempt');
							json_encode($spam_master_transient_array);
							$result['errors']->add('invalid_email',__('<strong>SPAM MASTER</strong>' . get_blog_option($blog_id, 'spam_master_message'),'spam_master'))& set_site_transient('spam_master_invalid_email'.current_time( 'mysql' ), $spam_master_transient_array, 604800 );
							$count = $result;
							$blog_prefix = $wpdb->get_blog_prefix($blog_id);
							$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							echo '<p class="error"><strong>SPAM MASTER</strong>'.get_blog_option($blog_id, 'spam_master_message').'</p>';
						}
					}
			//end buffer empty
			}
		return $result;
		//end func
		}
	//end valid
	}
//end multi
}
//SingleSite Block
else{
//post data if license status is valid
$response_key = get_option('spam_master_status');
	//Set malfunctions as VALID
	if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
		add_action( 'register_post', 'spam_master', 10, 3 );
		function spam_master($user_login, $user_email, $errors){
		global $wpdb;
		//prepare threat buffer
		$spam_master_blacklist = get_option('blacklist_keys');
		$blacklist_string = $spam_master_blacklist;
		$blacklist_array = explode("\n", $blacklist_string);
		$blacklist_size = sizeof($blacklist_array);
		$blog_threat_ip = $_SERVER['REMOTE_ADDR'];
			// Analyse List
			for($i = 0; $i < $blacklist_size; $i++){
			$blacklist_current = trim($blacklist_array[$i]);
				//check buffer
				if(stripos($user_email, $blacklist_current) !== false){
					$spam_master_transient_array = array('date' => current_time( 'mysql' ),
														'type' => 'Registration',
														'threat_ip' => $blog_threat_ip,
														'threat_email' => $blog_threat_email,
														'details' => 'wordpress registration attempt');
					json_encode($spam_master_transient_array);
					$errors->add('invalid_email', '<strong>SPAM MASTER</strong>'.__( get_option('spam_master_message') ))& set_transient( 'spam_master_invalid_email'.current_time( 'mysql' ), $spam_master_transient_array, 604800 );
					$count = $errors;
					$table_prefix = $wpdb->base_prefix;
					$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
					return;
				}
			//end for
			}
				//buffer empty
				if(!empty($user_email) && !empty($user_login) && stripos($user_email, $blacklist_current) == false){
					//create data to be posted
					$blog_license_key = get_option('spam_license_key');
					$blog_threat_type = 'registration';
					if(empty($user_email)){
						$data = "Spam Bot";
					}
					$blog_threat_email = wp_strip_all_tags($user_email);
					$blog_threat_content = 'registration';
					$blog_web_address = get_site_url();
					$address_unclean = $blog_web_address;
					$address = preg_replace('#^https?://#', '', $address_unclean);
					@$blog_server_ip = $_SERVER['SERVER_ADDR'];
					//if empty ip
					if(empty($blog_server_ip) || $blog_server_ip == '0'){
						@$blog_server_ip = 'I '.gethostbyname($_SERVER['SERVER_NAME']);
					}
					$spam_master_learning_post = array(
												'blog_license_key' => $blog_license_key,
												'blog_threat_ip' => $blog_threat_ip,
												'blog_threat_type' => $blog_threat_type,
												'blog_threat_email' => $blog_threat_email,
												'blog_threat_content' => $blog_threat_content,
												'blog_web_adress' => $address,
												'blog_server_ip' => $blog_server_ip
												);										
					$spam_master_leaning_url = 'aHR0cHM6Ly9zcGFtbWFzdGVyLnRlY2hnYXNwLmNvbS93cC1jb250ZW50L3BsdWdpbnMvc3BhbS1tYXN0ZXItYWRtaW5pc3RyYXRvci9pbmNsdWRlcy9sZWFybmluZy9nZXRfbGVhcm5fcmVnLnBocA==';
					$response = wp_remote_post( base64_decode($spam_master_leaning_url), array(
																						'method' => 'POST',
																						'timeout' => 45,
																						'body' => $spam_master_learning_post
																						)
																					);
					if ( is_wp_error( $response ) ) {
						$error_message = $response->get_error_message();
						echo "Something went wrong, please get in touch with TechGasp Support: $error_message";
					}
					else {
						$data = json_decode( wp_remote_retrieve_body( $response ), true );
						if(empty($data)){
						}
						else{
							$spam_threat = $data['threat'];
							//add to buffer	ip and email
							$spam_master_array_email = array_merge(explode("\n", $blog_threat_email), explode("\n", $spam_master_blacklist));
							$spam_master_array_ip = array_merge(explode("\n", $blog_threat_ip), explode("\n", $spam_master_blacklist));
							$spam_master_array = array_merge_recursive($spam_master_array_email, $spam_master_array_ip);
							$spam_master_array = array_map("trim", $spam_master_array);
							sort ($spam_master_array);
							$spam_master_string = implode("\n", array_unique($spam_master_array));
							update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							$spam_master_transient_array = array('date' => current_time( 'mysql' ),
															'type' => 'Registration',
															'threat_ip' => $blog_threat_ip,
															'threat_email' => $blog_threat_email,
															'details' => 'wordpress registration attempt');
							json_encode($spam_master_transient_array);
							$errors->add('invalid_email', '<strong>SPAM MASTER</strong>'.__( get_option('spam_master_message') ))& set_transient( 'spam_master_invalid_email'.current_time( 'mysql' ), $spam_master_transient_array, 604800 );
							$count = $errors;
							$table_prefix = $wpdb->base_prefix;
							$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							return;
						}
					}
				//end buffer empty
				}
		//end func
		}
	//end valid
	}
//end single
}
?>
