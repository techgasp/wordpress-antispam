<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wpdb, $blog_id;
//Set time for everything
$spam_master_time = current_time('Y-m-d H:i:s');
//only get the last 1 day of threats/ips
$spam_master_time_expires = date("Y-m-d H:i:s",strtotime($spam_master_time."-1 days"));

if( is_multisite() ){
$response_key = get_blog_option( $blog_id, 'spam_master_status');
$admin_email = get_blog_option($blog_id, 'admin_email');
$blogname = get_blog_option($blog_id, 'blogname');
	if(empty($blogname)){
		$blogname = 'your blog';
	}
$spam_master_alert_level = get_blog_option($blog_id, 'spam_master_alert_level');
$spam_master_alert_level_p_text = get_blog_option($blog_id, 'spam_master_alert_level_p_text');
$spam_master_protection_total_number = get_blog_option($blog_id, 'spam_master_protection_total_number');
$spam_master_block_count = get_blog_option(1, 'spam_master_block_count');
$blog_prefix = $wpdb->get_blog_prefix();
$table_prefix = $wpdb->base_prefix;
$spam_master_daily_block_count = $wpdb->get_var("SELECT COUNT(*) FROM {$table_prefix}sitemeta WHERE meta_key LIKE '_site_transient_spam_master_firewall_ip%'");
$spam_master_emails_extra_email = get_blog_option($blog_id, 'spam_master_emails_extra_email');
$spam_master_emails_extra_email_list = get_blog_option($blog_id, 'spam_master_emails_extra_email_list');
}
else{
$response_key = get_option('spam_master_status');
$admin_email = get_option('admin_email');
$blogname = get_option('blogname');
	if(empty($blogname)){
		$blogname = 'your blog';
	}
$spam_master_alert_level = get_option('spam_master_alert_level');
$spam_master_alert_level_p_text = get_option('spam_master_alert_level_p_text');
$spam_master_protection_total_number = get_option('spam_master_protection_total_number');
$spam_master_block_count = get_option('spam_master_block_count');
$table_prefix = $wpdb->base_prefix;
$spam_master_daily_block_count = $wpdb->get_var("SELECT COUNT(*) FROM {$table_prefix}options WHERE option_name LIKE '_transient_spam_master_firewall_ip%'");
$spam_master_emails_extra_email = get_option('spam_master_emails_extra_email');
$spam_master_emails_extra_email_list = get_option('spam_master_emails_extra_email_list');
}
if($spam_master_alert_level == 'ALERT_0'){
	$spam_master_alert_level_deconstructed = '0';
}
if($spam_master_alert_level == 'ALERT_1'){
	$spam_master_alert_level_deconstructed = '1';
}
if($spam_master_alert_level == 'ALERT_2'){
	$spam_master_alert_level_deconstructed = '2';
}
if($response_key == 'VALID'){
	$spam_master_warning = false;
	$spam_master_warning_signature = '<p>All is good.</p>';
}
if($response_key == 'MALFUNCTION_1'){
	$spam_master_warning = '<li>Warnings: <b>Malfunction 1, please update Spam Master to the latest version</b></li>';
	$spam_master_warning_signature = '<p>Please correct the warnings.</p>';
}
if($response_key == 'MALFUNCTION_2'){
	$spam_master_warning = '<li>Warnings: <b>Malfunction 2, urgently update Spam Master, your installed version is extremely old</b></li>';
	$spam_master_warning_signature = '<p>Please correct the warnings.</p>';
}
if($spam_master_block_count <= '10'){
	$spam_master_block_count_result = '<li>Total Blocks: <b>good, less than 10</b></li>';
}
if($spam_master_block_count >= '11'){
	$spam_master_block_count_result = '<li>Total Blocks: <b>'.number_format($spam_master_block_count).' firewall triggers & registrations blocked</b></li>';
}

if(empty($spam_master_daily_block_count)){
	$spam_master_daily_block_count_result = '<li>Weekly Triggers: <b>good, nothing to report</b></li>';
}
else{
	$spam_master_daily_block_count_result = '<li>Weekly Triggers: <b>'.number_format($spam_master_daily_block_count).' firewall triggers</b></li>';
}
//get extra emails
if($spam_master_emails_extra_email == 'true'){
	if(!empty($spam_master_emails_extra_email_list)){
		$spam_master_more_emails = ','.$spam_master_emails_extra_email_list;
	}
	else{
		$spam_master_more_emails = false;
	}
}
else{
	$spam_master_more_emails = false;
}
if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
//email user
//set mail html
add_filter( 'wp_mail_content_type', 'spam_master_send_daily_report_html' );
function spam_master_send_daily_report_html(){
	return 'text/html';
}
//Email Subject Title Header
$spam_master_subject_title = 'Daily Report';
$spam_master_html = '<!DOCTYPE html><html>';
$spam_master_header = '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>'.$spam_master_subject_title.'</title></head>';
$spam_master_body = '<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="background-color: #f6f6f6; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif;">';
$spam_master_table_header = '<div style="width:100%; -webkit-text-size-adjust:none !important; margin:0; padding: 70px 0 70px 0;">
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="520" id="template_container" style="box-shadow:0 0 0 1px #f3f3f3 !important; border-radius:3px !important; background-color: #ffffff; border: 1px solid #e9e9e9; border-radius:3px !important; padding: 20px;">
<tr>
<td align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="520" id="template_header" style=" color: #00000; border-top-left-radius:3px !important; border-top-right-radius:3px !important; border-bottom: 0; font-weight:bold; line-height:100%; text-align: center; vertical-align:middle;" bgcolor="#ffffff">
<tr>
<td>
<h1 style="color: #000000; margin:0; padding: 28px 24px; display:block; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif; font-size:32px; font-weight: 500; line-height: 1.2;">
'.$spam_master_subject_title.'
</h1></td></tr></table></td></tr>';
$spam_master_table_body = '<tr>
<td align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="520" id="template_body">
<tr>
<td valign="top" style="border-radius:3px !important; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif;">
<table border="0" cellpadding="20" cellspacing="0" width="100%">
<tr>
<td valign="top">
<div style="color: #000000; font-size:14px; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif; line-height:150%; text-align:left;">';
//Email Content
$spam_master_table_content = '<p>Spam Master Daily Alert Level Report for '.$blogname.'</p>
<ul>
'.$spam_master_warning.'
<li>Alert Level: <b>'.$spam_master_alert_level_deconstructed.'</b></li>
<li>Spam Probability: <b>'.$spam_master_alert_level_p_text.'%</b></li>
<li>Protected Against: <b>'.number_format($spam_master_protection_total_number).' threats</b></li>'.
$spam_master_daily_block_count_result.
$spam_master_block_count_result.'
</ul>
'.$spam_master_warning_signature.'
<p>The daily alert level report email can be turned off in Spam Master Protection Tools page, Emails & Reporting section.</p>
<br>
<p>Thanks</p>
<p>TechGasp Team</p>';
$spam_master_table_content_close = '</div>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>';
$spam_master_table_footer_start = '<tr>
<td align="center" valign="top">
<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer" style="border-top:0; -webkit-border-radius:3px;">
<tr>
<td valign="top">
<table border="0" cellpadding="10" cellspacing="0" width="100%">
<tr>
<td colspan="2" valign="middle" id="credit" style="border:0; color: #000000; font-family: &apos;Helvetica Neue&apos;, Helvetica, Arial, &apos;Lucida Grande&apos;, sans-serif; font-size:14px; line-height:125%; text-align:center;">';
$spam_master_table_footer_content = '<p><a href="https://www.wordpress.org/plugins/spam-master/" target="_blank">Share the love, please rate us on WordPress.org</a></p>';
$spam_master_email_close = '</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>
</body>
</html>';
//send email
$from = $admin_email;
$to = $admin_email.$spam_master_more_emails;
$subject = $spam_master_subject_title;
$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject);
$message = $spam_master_html.
			$spam_master_header.
			$spam_master_body.
			$spam_master_table_header.
			$spam_master_table_body.
			$spam_master_table_content.
			$spam_master_table_content_close.
			$spam_master_table_footer_start.
			$spam_master_table_footer_content.
			$spam_master_email_close;
wp_mail( $to, $subject, $message, $headers );	
// Reset content-type to avoid conflicts
remove_filter( 'wp_mail_content_type', 'spam_master_send_daily_report_html' );
}
?>
