<?php
global $wpdb, $blog_id;
if( is_multisite() ){
$spam_master_comments_clean = get_blog_option($blog_id, 'spam_master_comments_clean');
	if($spam_master_comments_clean == 'true'){
	$spam_master_blacklist = get_blog_option($blog_id, 'blacklist_keys');
	$blog_prefix = $wpdb->get_blog_prefix();
	$result_comments_status_ip = $wpdb->get_results("SELECT comment_ID,comment_author_IP,comment_approved FROM {$blog_prefix}comments WHERE comment_approved = '0' OR comment_approved = '1'");
		foreach($result_comments_status_ip as $status){
			$status_id = $status->comment_ID;
			$status_ip = $status->comment_author_IP;
			$status_status = $status->comment_approved;

			$blacklist_string = $spam_master_blacklist;
			$blacklist_array = explode("\n", $blacklist_string);
			$blacklist_size = sizeof($blacklist_array);
			// Analyse List of IP's
			for($i = 0; $i < $blacklist_size; $i++){
				$blacklist_current = trim($blacklist_array[$i]);
				//check buffer
				if(stripos($status_ip, $blacklist_current) !== false){
					wp_delete_comment( $status_id, false );
				}
			}
		}
	$result_comments_status_email = $wpdb->get_results("SELECT comment_ID,comment_author_email,comment_approved FROM {$blog_prefix}comments WHERE comment_approved = '0' OR comment_approved = '1'");
		foreach($result_comments_status_email as $status){
			$status_id = $status->comment_ID;
			$status_email = $status->comment_author_email;
			$status_status = $status->comment_approved;

			$blacklist_string = $spam_master_blacklist;
			$blacklist_array = explode("\n", $blacklist_string);
			$blacklist_size = sizeof($blacklist_array);
			// Analyse List of IP's
			for($i = 0; $i < $blacklist_size; $i++){
				$blacklist_current = trim($blacklist_array[$i]);
				//check buffer
				if(stripos($status_email, $blacklist_current) !== false){
					wp_delete_comment( $status_id, false );
				}
			}
		}
	}
}
else{
$spam_master_comments_clean = get_option('spam_master_comments_clean');
	if($spam_master_comments_clean == 'true'){
	$spam_master_blacklist = get_option('blacklist_keys');
	$table_prefix = $wpdb->base_prefix;
	$result_comments_status_ip = $wpdb->get_results("SELECT comment_ID,comment_author_IP,comment_approved FROM {$table_prefix}comments WHERE comment_approved = '0' OR comment_approved = '1'");
		foreach($result_comments_status_ip as $status){
			$status_id = $status->comment_ID;
			$status_ip = $status->comment_author_IP;
			$status_status = $status->comment_approved;

			$blacklist_string = $spam_master_blacklist;
			$blacklist_array = explode("\n", $blacklist_string);
			$blacklist_size = sizeof($blacklist_array);
			// Analyse List of IP's
			for($i = 0; $i < $blacklist_size; $i++){
				$blacklist_current = trim($blacklist_array[$i]);
				//check buffer
				if(stripos($status_ip, $blacklist_current) !== false){
					wp_delete_comment( $status_id, false );
				}
			}
		}
	$result_comments_status_email = $wpdb->get_results("SELECT comment_ID,comment_author_email,comment_approved FROM {$table_prefix}comments WHERE comment_approved = '0' OR comment_approved = '1'");
		foreach($result_comments_status_email as $status){
			$status_id = $status->comment_ID;
			$status_email = $status->comment_author_email;
			$status_status = $status->comment_approved;

			$blacklist_string = $spam_master_blacklist;
			$blacklist_array = explode("\n", $blacklist_string);
			$blacklist_size = sizeof($blacklist_array);
			// Analyse List of IP's
			for($i = 0; $i < $blacklist_size; $i++){
				$blacklist_current = trim($blacklist_array[$i]);
				//check buffer
				if(stripos($status_email, $blacklist_current) !== false){
					wp_delete_comment( $status_id, false );
				}
			}
		}
	}
}
?>
