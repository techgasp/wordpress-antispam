<?php
if(is_multisite()){
$response_key = get_blog_option($blog_id, 'spam_master_status');
}
else{
$response_key = get_option('spam_master_status');
}
if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
	add_filter('wpcf7_spam', 'spam_master_contact_form_7');
	function spam_master_contact_form_7($spam){
	global $wpdb, $blog_id;
		//buffer action
		if ( $spam ) {
			return $spam;
		}

		//create data to be posted
		if(is_multisite()){
			$blog_license_key = get_blog_option($blog_id, 'spam_license_key');
			$spam_master_blacklist = get_blog_option($blog_id, 'blacklist_keys');
		}
		else{
			$blog_license_key = get_option('spam_license_key');
			$spam_master_blacklist = get_option('blacklist_keys');
		}
		$blog_threat_type = 'contact-form-7';
		$blog_threat_ip = $_SERVER['REMOTE_ADDR'];
		$result_comment_author_email = wp_strip_all_tags($_POST['your-email']);
			if(empty($result_comment_author_email)){
				$result_comment_content_clean = 'your-email-'.date("YmdHis");
			}
		$result_comment_content_trim = substr($_POST['your-message'],0,360);
		$result_comment_content_clean = wp_strip_all_tags(stripslashes_deep($result_comment_content_trim), true);
			if(empty($result_comment_content_clean)){
				$result_comment_content_clean = 'your-message';
			}
		//create data to be posted
		$blog_web_adress = get_site_url();
		$address_unclean = $blog_web_adress;
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
										'blog_threat_email' => $result_comment_author_email,
										'blog_threat_content' => $result_comment_content_clean,
										'blog_web_adress' => $address,
										'blog_server_ip' => $blog_server_ip
										);										
		$spam_master_leaning_url = 'aHR0cHM6Ly9zcGFtbWFzdGVyLnRlY2hnYXNwLmNvbS93cC1jb250ZW50L3BsdWdpbnMvc3BhbS1tYXN0ZXItYWRtaW5pc3RyYXRvci9pbmNsdWRlcy9sZWFybmluZy9nZXRfbGVhcm5fY29tLnBocA==';
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
		else{
			$data = json_decode( wp_remote_retrieve_body( $response ), true );
			if(empty($data)){
				return false;
			}
			else{
				$spam_threat = $data['threat'];
				//add to buffer	ip and email
				$spam_master_array_email = array_merge(explode("\n", $result_comment_author_email), explode("\n", $spam_master_blacklist));
				$spam_master_array_ip = array_merge(explode("\n", $blog_threat_ip), explode("\n", $spam_master_blacklist));
				$spam_master_array = array_merge_recursive($spam_master_array_email, $spam_master_array_ip);
				$spam_master_array = array_map("trim", $spam_master_array);
				sort ($spam_master_array);
				$spam_master_string = implode("\n", array_unique($spam_master_array));
				if(is_multisite()){
					update_blog_option($blog_id, 'blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
					$spam_master_transient_array = array('date' => current_time( 'mysql' ),
														'type' => 'Contact Form 7',
														'threat_ip' => $blog_threat_ip,
														'threat_email' => $result_comment_author_email,
														'details' => $result_comment_content_clean);
					json_encode($spam_master_transient_array);
					$errors = set_site_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
					$count = $errors;
					$blog_prefix = $wpdb->get_blog_prefix($blog_id);
					$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
				}
				else{
					update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
					$spam_master_transient_array = array('date' => current_time( 'mysql' ),
														'type' => 'Contact Form 7',
														'threat_ip' => $blog_threat_ip,
														'threat_email' => $result_comment_author_email,
														'details' => $result_comment_content_clean);
					json_encode($spam_master_transient_array);
					$errors = set_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
					$count = $errors;
					$table_prefix = $wpdb->base_prefix;
					$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
				}
			return  $result['reason'] = array( 'spam' => wpcf7_get_message( 'spam' ) );
			}
		}
	}
}
?>
