<?php
//post data if license status is valid
if(is_multisite()){
$response_key = get_blog_option($blog_id, 'spam_master_status');
}
else{
$response_key = get_option('spam_master_status');
}
//Set malfunctions as VALID
if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
	add_filter( 'pre_comment_approved', 'spam_master_comment_learning', '99', 2 );
	add_filter( 'pre_trackback_post', 'spam_master_comment_learning', '99', 2 );
	function spam_master_comment_learning($approved, $commentdata){
	global $wpdb, $blog_id;
	//create data to be posted
	if(is_multisite()){
		$blog_license_key = get_blog_option($blog_id, 'spam_license_key');
		$spam_master_blacklist = get_blog_option($blog_id, 'blacklist_keys');
		$spam_master_whitelist = get_blog_option($blog_id, 'spam_master_whitelist');
		$comment_russian_char = get_blog_option($blog_id, 'comment_russian_char');
		$comment_russian_char_set = get_blog_option($blog_id, 'comment_russian_char_set');
		$comment_chinese_char = get_blog_option($blog_id, 'comment_chinese_char');
		$comment_chinese_char_set = get_blog_option($blog_id, 'comment_chinese_char_set');
		$comment_asian_char = get_blog_option($blog_id, 'comment_asian_char');
		$comment_asian_char_set = get_blog_option($blog_id, 'comment_asian_char_set');
		$comment_arabic_char = get_blog_option($blog_id, 'comment_arabic_char');
		$comment_arabic_char_set = get_blog_option($blog_id, 'comment_arabic_char_set');
		$comment_spam_char = get_blog_option($blog_id, 'comment_spam_char');
		$comment_spam_char_set = get_blog_option($blog_id, 'comment_spam_char_set');
		
	}
	else{
		$blog_license_key = get_option('spam_license_key');
		$spam_master_blacklist = get_option('blacklist_keys');
		$spam_master_whitelist = get_option('spam_master_whitelist');
		$comment_russian_char = get_option('comment_russian_char');
		$comment_russian_char_set = get_option('comment_russian_char_set');
		$comment_chinese_char = get_option('comment_chinese_char');
		$comment_chinese_char_set = get_option('comment_chinese_char_set');
		$comment_asian_char = get_option('comment_asian_char');
		$comment_asian_char_set = get_option('comment_asian_char_set');
		$comment_arabic_char = get_option('comment_arabic_char');
		$comment_arabic_char_set = get_option('comment_arabic_char_set');
		$comment_spam_char = get_option('comment_spam_char');
		$comment_spam_char_set = get_option('comment_spam_char_set');
	}
	if(empty($commentdata['comment_author_email'])){
		$commentdata['comment_author_email'] = date("YmdHis").'@'.date("YmdHis").'.com';
	}
	$whitelist_string = $spam_master_whitelist;
	$whitelist_array = explode("\n", $whitelist_string);
	$whitelist_size = sizeof($whitelist_array);
	// Analyse List
	for($o = 0; $o < $whitelist_size; $o++){
	$whitelist_current = trim($whitelist_array[$o]);
	//check buffer
		//exempt admins and whitelist from check
		if(stripos($commentdata['comment_author_email'], $whitelist_current) !== false OR stripos($_SERVER['REMOTE_ADDR'], $whitelist_current) !== false){
			$approved = '1';
			return $approved;
			exit();
		}
	}
	//exempt admins from check
	if(!function_exists('wp_get_current_user')) {
		include(ABSPATH . "wp-includes/pluggable.php"); 
	}
	if(current_user_can( 'administrator' ) OR current_user_can( 'editor' ) OR current_user_can( 'author' ) OR current_user_can( 'contributor' )){
		$approved = '1';
		return $approved;
		exit();
	}
		else{
			if(is_trackback()){
				@$request_array = 'HTTP_POST_VARS';
				$blog_threat_type = 'trackback';
				$blog_threat_ip = $_SERVER['REMOTE_ADDR'];
				$result_comment_author_email = 'trackback_'.date("YmdHis");
				$tb_url = $_POST['url'];
				if(empty($tb_url)){
					$tb_url = 'empty url';
				}
				$title  = $_POST['title'];
				if(empty($title)){
					$title = 'empty title';
				}
				$excerpt = $_POST['excerpt'];
				if(empty($excerpt)){
					$excerpt = 'empty excerpt';
				}
				$join_tbs = 'URL: '.$tb_url.' - NAME: '.$title.' - TITLE: '.$title.' - EXC: '.$excerpt;
				$result_comment_content_trim = substr($join_tbs,0,360);
				$result_comment_content_clean = wp_strip_all_tags(stripslashes_deep($result_comment_content_trim), true);
			}
			else{
				$blog_threat_type = 'comment';
				$blog_threat_ip = $commentdata['comment_author_IP'];
					//stop process if comment ip is the same as server address
					if($blog_threat_ip == $_SERVER['SERVER_ADDR']){
						return new WP_Error( 'require_valid_comment', __( '<strong>ERROR</strong>: the comment ip is the same as the web server address.' ), 200 );
					}
				$result_comment_author_email = wp_strip_all_tags($commentdata['comment_author_email']);
				$result_comment_content_trim = substr($commentdata['comment_content'],0,360);
				$result_comment_content_clean = wp_strip_all_tags(stripslashes_deep($result_comment_content_trim), true);
			}
			/////////////////////////////////
			//lets do a quick character block
			if ($comment_russian_char == 'true' || $comment_chinese_char == 'true' || $comment_asian_char == 'true' || $comment_arabic_char == 'true' || $comment_spam_char == 'true'){
				//create data to be posted
				$blog_web_address = get_site_url();
				$address_unclean = $blog_web_address;
				$address = preg_replace('#^https?://#', '', $address_unclean);
				@$blog_server_ip = $_SERVER['SERVER_ADDR'];
				//if empty ip
				if(empty($blog_server_ip) || $blog_server_ip == '0'){
					@$blog_server_ip = 'I '.gethostbyname($_SERVER['SERVER_NAME']);
				}
				if ($comment_russian_char == 'true'){
					$blacklist_russian_char_string = $comment_russian_char_set;
					$blacklist_russian_char_array = explode("\n", $blacklist_russian_char_string);
					$blacklist_russian_char_size = sizeof($blacklist_russian_char_array);
					// Analyse List
					for($i = 0; $i < $blacklist_russian_char_size; $i++){
					$blacklist_russian_char_current = trim($blacklist_russian_char_array[$i]);
						//check buffer
						if(stripos($commentdata['comment_content'], $blacklist_russian_char_current) !== false){
						$spam_master_array_email = array_merge(explode("\n", $result_comment_author_email), explode("\n", $spam_master_blacklist));
						$spam_master_array_ip = array_merge(explode("\n", $blog_threat_ip), explode("\n", $spam_master_blacklist));
						$spam_master_array = array_merge_recursive($spam_master_array_email, $spam_master_array_ip);
						$spam_master_array = array_map("trim", $spam_master_array);
						sort ($spam_master_array);
						$spam_master_string = implode("\n", array_unique($spam_master_array));
							if(is_multisite()){
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Russian Char - ' . $blacklist_russian_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_site_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$blog_prefix = $wpdb->get_blog_prefix($blog_id);
								$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_blog_option($blog_id, 'blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							else{
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Russian Char - ' . $blacklist_russian_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$table_prefix = $wpdb->base_prefix;
								$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							$spam_master_learning_post = array(
											'blog_license_key' => $blog_license_key,
											'blog_threat_ip' => $blog_threat_ip,
											'blog_threat_type' => $blog_threat_type,
											'blog_threat_email' => $result_comment_author_email,
											'blog_threat_content' => 'Russian Char - ' . $blacklist_russian_char_current . ' - ' . $result_comment_content_clean,
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
							if(is_multisite()){
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_blog_option($blog_id, 'spam_master_message').'' ), 200 );
							}
							else{
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_option('spam_master_message').'' ), 200 );
							}
						}
					//end for
					}
				}
				if ($comment_chinese_char == 'true'){
					$blacklist_chinese_char_string = $comment_chinese_char_set;
					$blacklist_chinese_char_array = explode("\n", $blacklist_chinese_char_string);
					$blacklist_chinese_char_size = sizeof($blacklist_chinese_char_array);
					// Analyse List
					for($i = 0; $i < $blacklist_chinese_char_size; $i++){
					$blacklist_chinese_char_current = trim($blacklist_chinese_char_array[$i]);
						//check buffer
						if(stripos($commentdata['comment_content'], $blacklist_chinese_char_current) !== false){
						$spam_master_array_email = array_merge(explode("\n", $result_comment_author_email), explode("\n", $spam_master_blacklist));
						$spam_master_array_ip = array_merge(explode("\n", $blog_threat_ip), explode("\n", $spam_master_blacklist));
						$spam_master_array = array_merge_recursive($spam_master_array_email, $spam_master_array_ip);
						$spam_master_array = array_map("trim", $spam_master_array);
						sort ($spam_master_array);
						$spam_master_string = implode("\n", array_unique($spam_master_array));
							if(is_multisite()){
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Chinese Char - ' . $blacklist_chinese_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_site_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$blog_prefix = $wpdb->get_blog_prefix($blog_id);
								$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_blog_option($blog_id, 'blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							else{
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Chinese Char - ' . $blacklist_chinese_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$table_prefix = $wpdb->base_prefix;
								$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							$spam_master_learning_post = array(
											'blog_license_key' => $blog_license_key,
											'blog_threat_ip' => $blog_threat_ip,
											'blog_threat_type' => $blog_threat_type,
											'blog_threat_email' => $result_comment_author_email,
											'blog_threat_content' => 'Chinese Char - ' . $blacklist_chinese_char_current . ' - ' . $result_comment_content_clean,
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
							if(is_multisite()){
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_blog_option($blog_id, 'spam_master_message').'' ), 200 );
							}
							else{
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_option('spam_master_message').'' ), 200 );
							}
						}
					//end for
					}
				}
				if ($comment_asian_char == 'true'){
					$blacklist_asian_char_string = $comment_asian_char_set;
					$blacklist_asian_char_array = explode("\n", $blacklist_asian_char_string);
					$blacklist_asian_char_size = sizeof($blacklist_asian_char_array);
					// Analyse List
					for($i = 0; $i < $blacklist_asian_char_size; $i++){
					$blacklist_asian_char_current = trim($blacklist_asian_char_array[$i]);
						//check buffer
						if(stripos($commentdata['comment_content'], $blacklist_asian_char_current) !== false){
						$spam_master_array_email = array_merge(explode("\n", $result_comment_author_email), explode("\n", $spam_master_blacklist));
						$spam_master_array_ip = array_merge(explode("\n", $blog_threat_ip), explode("\n", $spam_master_blacklist));
						$spam_master_array = array_merge_recursive($spam_master_array_email, $spam_master_array_ip);
						$spam_master_array = array_map("trim", $spam_master_array);
						sort ($spam_master_array);
						$spam_master_string = implode("\n", array_unique($spam_master_array));
							if(is_multisite()){
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Asian Char - ' . $blacklist_asian_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_site_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$blog_prefix = $wpdb->get_blog_prefix($blog_id);
								$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_blog_option($blog_id, 'blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							else{
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Asian Char - ' . $blacklist_asian_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$table_prefix = $wpdb->base_prefix;
								$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							$spam_master_learning_post = array(
											'blog_license_key' => $blog_license_key,
											'blog_threat_ip' => $blog_threat_ip,
											'blog_threat_type' => $blog_threat_type,
											'blog_threat_email' => $result_comment_author_email,
											'blog_threat_content' => 'Asian Char - ' . $blacklist_asian_char_current . ' - ' . $result_comment_content_clean,
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
							if(is_multisite()){
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_blog_option($blog_id, 'spam_master_message').'' ), 200 );
							}
							else{
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_option('spam_master_message').'' ), 200 );
							}
						}
					//end for
					}
				}
				if ($comment_arabic_char == 'true'){
					$blacklist_arabic_char_string = $comment_arabic_char_set;
					$blacklist_arabic_char_array = explode("\n", $blacklist_arabic_char_string);
					$blacklist_arabic_char_size = sizeof($blacklist_arabic_char_array);
					// Analyse List
					for($i = 0; $i < $blacklist_arabic_char_size; $i++){
					$blacklist_arabic_char_current = trim($blacklist_arabic_char_array[$i]);
						//check buffer
						if(stripos($commentdata['comment_content'], $blacklist_arabic_char_current) !== false){
						$spam_master_array_email = array_merge(explode("\n", $result_comment_author_email), explode("\n", $spam_master_blacklist));
						$spam_master_array_ip = array_merge(explode("\n", $blog_threat_ip), explode("\n", $spam_master_blacklist));
						$spam_master_array = array_merge_recursive($spam_master_array_email, $spam_master_array_ip);
						$spam_master_array = array_map("trim", $spam_master_array);
						sort ($spam_master_array);
						$spam_master_string = implode("\n", array_unique($spam_master_array));
							if(is_multisite()){
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Arabic Char - ' . $blacklist_arabic_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_site_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$blog_prefix = $wpdb->get_blog_prefix($blog_id);
								$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_blog_option($blog_id, 'blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							else{
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Arabic Char - ' . $blacklist_arabic_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$table_prefix = $wpdb->base_prefix;
								$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							$spam_master_learning_post = array(
											'blog_license_key' => $blog_license_key,
											'blog_threat_ip' => $blog_threat_ip,
											'blog_threat_type' => $blog_threat_type,
											'blog_threat_email' => $result_comment_author_email,
											'blog_threat_content' => 'Arabic Char - ' . $blacklist_arabic_char_current . ' - ' . $result_comment_content_clean,
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
							if(is_multisite()){
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_blog_option($blog_id, 'spam_master_message').'' ), 200 );
							}
							else{
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_option('spam_master_message').'' ), 200 );
							}
						}
					//end for
					}
				}
				if ($comment_spam_char == 'true'){
					$blacklist_spam_char_string = $comment_spam_char_set;
					$blacklist_spam_char_array = explode("\n", $blacklist_spam_char_string);
					$blacklist_spam_char_size = sizeof($blacklist_spam_char_array);
					// Analyse List
					for($i = 0; $i < $blacklist_spam_char_size; $i++){
					$blacklist_spam_char_current = trim($blacklist_spam_char_array[$i]);
						//check buffer
						if(stripos($commentdata['comment_content'], $blacklist_spam_char_current) !== false){
						$spam_master_array_email = array_merge(explode("\n", $result_comment_author_email), explode("\n", $spam_master_blacklist));
						$spam_master_array_ip = array_merge(explode("\n", $blog_threat_ip), explode("\n", $spam_master_blacklist));
						$spam_master_array = array_merge_recursive($spam_master_array_email, $spam_master_array_ip);
						$spam_master_array = array_map("trim", $spam_master_array);
						sort ($spam_master_array);
						$spam_master_string = implode("\n", array_unique($spam_master_array));
							if(is_multisite()){
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Spam Char - ' . $blacklist_spam_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_site_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$blog_prefix = $wpdb->get_blog_prefix($blog_id);
								$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_blog_option($blog_id, 'blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							else{
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
																	'type' => 'Comment - Trackback',
																	'threat_ip' => $blog_threat_ip,
																	'threat_email' => $result_comment_author_email,
																	'details' => 'Spam Char - ' . $blacklist_spam_char_current . ' - ' . $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$table_prefix = $wpdb->base_prefix;
								$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
								update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
							}
							$spam_master_learning_post = array(
											'blog_license_key' => $blog_license_key,
											'blog_threat_ip' => $blog_threat_ip,
											'blog_threat_type' => $blog_threat_type,
											'blog_threat_email' => $result_comment_author_email,
											'blog_threat_content' => 'Spam Char - ' . $blacklist_spam_char_current . ' - ' . $result_comment_content_clean,
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
							if(is_multisite()){
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_blog_option($blog_id, 'spam_master_message').'' ), 200 );
							}
							else{
								return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_option('spam_master_message').'' ), 200 );
							}
						}
					//end for
					}
				}
			}
			/////////////////////////////////
			//lets process with normal checks
			//prepare threat buffer
			$blacklist_string = $spam_master_blacklist;
			$blacklist_array = explode("\n", $blacklist_string);
			$blacklist_size = sizeof($blacklist_array);
			// Analyse List
			for($i = 0; $i < $blacklist_size; $i++){
			$blacklist_current = trim($blacklist_array[$i]);
				//check buffer
				if(stripos($result_comment_author_email, $blacklist_current) !== false){
					if(is_multisite()){
						$spam_master_transient_array = array('date' => current_time( 'mysql' ),
															'type' => 'Comment - Trackback',
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
						$spam_master_transient_array = array('date' => current_time( 'mysql' ),
															'type' => 'Comment - Trackback',
															'threat_ip' => $blog_threat_ip,
															'threat_email' => $result_comment_author_email,
															'details' => $result_comment_content_clean);
						json_encode($spam_master_transient_array);
						$errors = set_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
						$count = $errors;
						$table_prefix = $wpdb->base_prefix;
						$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
					}
					return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_blog_option($blog_id, 'spam_master_message').'' ), 200 );
				}
			//end for
			}
				//buffer empty
				if(stripos($result_comment_author_email, $blacklist_current) == false){
					//create data to be posted
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
							$approved = '0';
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
															'type' => 'Comment - Trackback',
															'threat_ip' => $blog_threat_ip,
															'threat_email' => $result_comment_author_email,
															'details' => $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_site_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$blog_prefix = $wpdb->get_blog_prefix($blog_id);
								$count = $wpdb->query("UPDATE {$blog_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_blog_option($blog_id, 'spam_master_message').'' ), 200 );
							}
							else{
								update_option('blacklist_keys', strip_tags(preg_replace('/\n+/', "\n", trim($spam_master_string))));
								$spam_master_transient_array = array('date' => current_time( 'mysql' ),
															'type' => 'Comment - Trackback',
															'threat_ip' => $blog_threat_ip,
															'threat_email' => $result_comment_author_email,
															'details' => $result_comment_content_clean);
								json_encode($spam_master_transient_array);
								$errors = set_transient('spam_master_firewall_ip'.current_time( 'mysql' ), $spam_master_transient_array, 604800);
								$count = $errors;
								$table_prefix = $wpdb->base_prefix;
								$count = $wpdb->query("UPDATE {$table_prefix}options SET option_value=option_value + 1 WHERE option_name='spam_master_block_count'");
							return new WP_Error( 'require_valid_email', __( '<strong>SPAM MASTER</strong>'. get_option('spam_master_message').'' ), 200 );
							}
							$approved = 'trash';
						}
					return $approved;
					}
				//end buffer empty
				}
		//end admins check
		}
	//end func comments
	}
//end valid
}
?>
