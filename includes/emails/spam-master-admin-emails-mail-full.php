<?php
add_action( 'init', 'spam_master_warning_full_email' );
function spam_master_warning_full_email(){
global $wpdb, $blog_id;
if( is_multisite() ){
$admin_email = get_blog_option($blog_id, 'admin_email');
$blogname = get_blog_option($blog_id, 'blogname');
	if(empty($blogname)){
		$blogname = 'your blog';
	}
$spam_master_emails_extra_email = get_blog_option($blog_id, 'spam_master_emails_extra_email');
$spam_master_emails_extra_email_list = get_blog_option($blog_id, 'spam_master_emails_extra_email_list');
}
else{
$admin_email = get_option('admin_email');
$blogname = get_option('blogname');
	if(empty($blogname)){
		$blogname = 'your blog';
	}
$spam_master_emails_extra_email = get_option('spam_master_emails_extra_email');
$spam_master_emails_extra_email_list = get_option('spam_master_emails_extra_email_list');
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
//email user
//set mail html
add_filter( 'wp_mail_content_type', 'spam_master_send_user_notice_expired_full_html' );
function spam_master_send_user_notice_expired_full_html() {
	return 'text/html';
}
//Email Subject Title Header
$spam_master_subject_title = 'License Expired!!!';
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
$spam_master_table_content = '<p>'.$blogname.' is no longer protected by Spam Master against millions of threats.</p>
<p>Hope you have enjoyed 1 year of bombastic protection. You can quickly get another license and get protected again, it costs peanuts per year.</p>
<p><a href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="get full license"><em>get full license</em></a></p>
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
$spam_master_table_footer_content = '<p><a href="https://wordpress.techgasp.com/spam-master/" target="_blank">get full license</a></p>';
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
remove_filter( 'wp_mail_content_type', 'spam_master_send_user_notice_expired_full_html' );
if( is_multisite() ){
	update_blog_option($blog_id, 'spam_master_full_expired', 'notice');
}
else{
	update_option('spam_master_full_expired', 'notice');
}
}
?>
