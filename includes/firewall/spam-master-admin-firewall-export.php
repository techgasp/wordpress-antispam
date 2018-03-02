<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
if ((is_user_logged_in()) && (current_user_can( 'administrator' ))){
global $wpdb;
$table_prefix = $wpdb->base_prefix;
if(is_multisite()){
	$qry = array();
	$qry[] = "SELECT meta_value AS firewall_blocked";
	$qry[] = "FROM {$table_prefix}sitemeta";
	$qry[] = "WHERE meta_key";
	$qry[] = "LIKE '_site_transient_spam_master_firewall_ip%'";
}
else{
	$qry = array();
	$qry[] = "SELECT option_value AS firewall_blocked";
	$qry[] = "FROM {$table_prefix}options";
	$qry[] = "WHERE option_name";
	$qry[] = "LIKE '_transient_spam_master_firewall_ip%'";
}
$result = $wpdb->get_results(implode(" ", $qry), ARRAY_A);
//CREATE LOCAL FILE
	if ($wpdb->num_rows > 0) {
		// Make a DateTime object and get a time stamp for the filename
		$date = new DateTime();
		$ts = $date->format("Y-m-d-G");
		// A name with a time stamp, to avoid duplicate filenames
		$filename = "spam_master_firewall_DB_$ts.csv";
		//opens file to write
		$fp = fopen($filename, 'w');
		// Get the first record
		$hrow = $result[0];
		// Extracts the keys of the first record and writes them
		// to the output buffer in CSV format
		fputcsv($fp, array_keys($hrow));
			// Then, write every record to the output buffer in CSV format
			foreach ($result as $data) {
				fputcsv($fp, $data);
			}
		// Close the output buffer (Like you would a file)
		fclose($fp);
	}
	//DOWNLOAD LETS PUSH THE FILE TO THE BROWSER
	header( 'Content-Type: text/csv' );
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
