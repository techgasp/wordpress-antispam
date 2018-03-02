<?php
if(is_multisite()){
$response_key = get_blog_option($blog_id, 'spam_master_status');
	if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
		add_action( 'woocommerce_process_registration_errors', 'spam_master_validate_woo_extra_validate_fields', 10, 4 );
		function spam_master_validate_woo_extra_validate_fields($errors, $username, $password, $email){
		global $wpdb, $blog_id;
		$spam_master_reg_email = $email;
		//prepare threat buffer
		$spam_master_blacklist = get_blog_option($blog_id, 'blacklist_keys');
		$blacklist_string = $spam_master_blacklist;
		$blacklist_array = explode("\n", $blacklist_string);
		$blacklist_size = sizeof($blacklist_array);
		$blog_threat_ip = $_SERVER['REMOTE_ADDR'];
			// Analyse List
			for($i = 0; $i < $blacklist_size; $i++){
			$blacklist_current = trim($blacklist_array[$i]);
				//check buffer
				if(stripos($spam_master_reg_email, $blacklist_current) !== false){
					$spam_master_transient_array = array('date' => current_time( 'mysql' ),
														'type' => 'Woocommerce',
														'threat_ip' => $blog_threat_ip,
														'threat_email' => $spam_master_reg_email,
														'details' => 'woocommerce registration attempt');
					json_encode($spam_master_transient_array);
					$errors = set_site_transient('spam_master_invalid_email'.current_time( 'mysql' ), $spam_master_transient_array, 604800 );
					$count = $errors;
					$blog_prefix = $wpdb->get_blog_prefix($blog_id);
					$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
					throw new Exception( __( '<strong>SPAM MASTER</strong>' . get_blog_option($blog_id, 'spam_master_message'),'spam_master'));
				}
			//end for
			}
			//buffer empty
				if(!empty($email) && !empty($password) && stripos($spam_master_reg_email, $blacklist_current) == false){
					//create data to be posted
					$blog_license_key = get_blog_option($blog_id, 'spam_license_key');
					$blog_threat_type = 'woocommerce';
					if(empty($user_email)){
						$data = "Spam Bot";
					}
					$blog_threat_email = wp_strip_all_tags($spam_master_reg_email);
					$blog_threat_content = 'woocommerce';
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
														'type' => 'Woocommerce',
														'threat_ip' => $blog_threat_ip,
														'threat_email' => $spam_master_reg_email,
														'details' => 'woocommerce registration attempt');
							json_encode($spam_master_transient_array);
							$errors = set_site_transient('spam_master_invalid_email'.current_time( 'mysql' ), $spam_master_transient_array, 604800 );
							$count = $errors;
							$blog_prefix = $wpdb->get_blog_prefix($blog_id);
							$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							throw new Exception( __( '<strong>SPAM MASTER</strong>' . get_blog_option($blog_id, 'spam_master_message'),'spam_master'));
						}
					}
				//end buffer empty
				}
		//end func
		return $errors;
		}
	//end valid
	}
//end multi
}
else{
$response_key = get_option('spam_master_status');
	if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
		add_action( 'woocommerce_process_registration_errors', 'spam_master_validate_woo_extra_validate_fields', 10, 4 );
		function spam_master_validate_woo_extra_validate_fields($errors, $username, $password, $email){
		global $wpdb;
		$spam_master_reg_email = $email;
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
				if(stripos($spam_master_reg_email, $blacklist_current) !== false){
					$spam_master_transient_array = array('date' => current_time( 'mysql' ),
														'type' => 'Woocommerce',
														'threat_ip' => $blog_threat_ip,
														'threat_email' => $spam_master_reg_email,
														'details' => 'woocommerce registration attempt');
					json_encode($spam_master_transient_array);
					$errors = set_transient('spam_master_invalid_email'.current_time( 'mysql' ), $spam_master_transient_array, 604800 );
					$count = $errors;
					$table_prefix = $wpdb->base_prefix;
					$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
					throw new Exception( __( '<strong>SPAM MASTER</strong>' . get_option('spam_master_message'),'spam_master'));
				}
			//end for
			}
			//buffer empty
				if(!empty($email) && !empty($password) && stripos($spam_master_reg_email, $blacklist_current) == false){
					//create data to be posted
					$blog_license_key = get_option('spam_license_key');
					$blog_threat_type = 'woocommerce';
					if(empty($user_email)){
						$data = "Spam Bot";
					}
					$blog_threat_email = wp_strip_all_tags($spam_master_reg_email);
					$blog_threat_content = 'woocommerce';
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
														'type' => 'Woocommerce',
														'threat_ip' => $blog_threat_ip,
														'threat_email' => $spam_master_reg_email,
														'details' => 'woocommerce registration attempt');
							json_encode($spam_master_transient_array);
							$errors = set_transient('spam_master_invalid_email'.current_time( 'mysql' ), $spam_master_transient_array, 604800 );
							$count = $errors;
							$table_prefix = $wpdb->base_prefix;
							$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							throw new Exception( __( '<strong>SPAM MASTER</strong>' . get_option('spam_master_message'),'spam_master'));
						}
					}
				//end buffer empty
				}
		//end func
		return $errors;
		}
	//end valid
	}
//end single
}
?>
