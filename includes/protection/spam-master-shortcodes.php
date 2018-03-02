<?php
if(is_multisite()){
	$response_key = get_blog_option($blog_id, 'spam_master_status');
}
else{
	$response_key = get_option('spam_master_status');
}
if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
	//Shortcode to display Total Threats Count inside frontend posts and pages [spam_master_stats_total_count]
	add_shortcode('spam_master_stats_total_count', 'spam_master_stats_total_count');
	function spam_master_stats_total_count(){
	global $wpdb, $blog_id;
		if( is_multisite() ){
			$spam_master_protection_total_number = number_format(get_blog_option($blog_id, 'spam_master_protection_total_number'));
		}
		else{
			$spam_master_protection_total_number = number_format(get_option('spam_master_protection_total_number'));
		}
	return $spam_master_protection_total_number;
	}
}
?>
