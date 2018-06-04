<?php
/**
Plugin Name: Spam Master
Plugin URI: https://wordpress.techgasp.com/spam-master/
Version: 5.5.9
Author: TechGasp
Author URI: http://wordpress.techgasp.com
Text Domain: spam-master
Description: Spam Master is the Ultimate Spam Protection plugin that blocks new user registrations and post comments with Real Time anti-spam lists.
License: GPL2 or later
*/
/*  Copyright 2013 TechGasp  (email : info@techgasp.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if(!class_exists('spam_master')) :
///////DEFINE///////
define( 'SPAM_MASTER_VERSION', '5.5.9' );
define( 'SPAM_MASTER_NAME', 'Spam Master' );

class spam_master{
public static function content_with_quote($content){
$quote = '<p>' . get_option('tsm_quote') . '</p>';
	return $content . $quote;
}
//SETTINGS LINK IN PLUGIN MANAGER
public static function spam_master_links( $links, $file ) {
if ( $file == plugin_basename( dirname(__FILE__).'/spam-master.php' ) ) {
		if( is_network_admin() ){
		$techgasp_plugin_url = network_admin_url( 'admin.php?page=spam-master' );
		}
		else {
		$techgasp_plugin_url = admin_url( 'admin.php?page=spam-master' );
		}
	$links[] = '<a href="' . $techgasp_plugin_url . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}
//END CLASS
}
add_filter('the_content', array('spam_master', 'content_with_quote'));
add_filter('plugin_action_links', array('spam_master', 'spam_master_links'), 10, 2);
endif;

//First time installs add settings wide options
global $wpdb, $blog_id;
$comment_russian_char_array = array('д','и','ж','Ч','Б');
$comment_russian_char_array_implode = implode("\n", $comment_russian_char_array);
$comment_chinese_char_array = array('的','是','一','不','了','人','我','在','有','他','这','为','你','出','就','那','要','自','她','于','木','作','工','程','裝','潢','統','包','室','內','設','計','家');
$comment_chinese_char_array_implode = implode("\n", $comment_chinese_char_array);
$comment_asian_char_array = array('ョ','プ','て','い','ン','が','る','ノ','。','ト','ự','ữ','đ','ắ','ủ','ă','ả','ạ','ơ','ố','ộ','ư');
$comment_asian_char_array_implode = implode("\n", $comment_asian_char_array);
$comment_arabic_char_array = array('أ','ن','ا','ح','ب','ه','ل','ا','ي','ة','إ','أ','و','هَ','ج');
$comment_arabic_char_array_implode = implode("\n", $comment_arabic_char_array);
$comment_spam_char_array = array('ɑ','ɑ','Ь','Ᏼ','ƅ','Ⲥ','Ԁ','ԁ','Ɗ','Ꭰ','ɗ','ｅ','ｅ','Ꮐ','Ꮋ','һ','ߋ','օ','ⲟ','Ⲣ','ⲣ','Ꮲ','Ꭱ','ｒ','Ꮪ','Ⴝ','Ꭲ','Ƭ','ᥙ','ҝ','ⲭ','ｚ','Ꮤ','ѡ','ʏ','ʏ','ү','ү','Ⲩ','қ','ҝ','᧐','…','・');
$comment_spam_char_array_implode = implode("\n", $comment_spam_char_array);
if( is_multisite() ){
add_blog_option($blog_id, 'spam_master_type', 'NO TYPE');
add_blog_option($blog_id, 'spam_master_status', 'INACTIVE');
add_blog_option($blog_id, 'spam_master_message', ': Email, Domain, or Ip banned from registration.');
add_blog_option($blog_id, 'spam_master_learning_active', 'true');
add_blog_option($blog_id, 'spam_master_comment_strict_on', 'true');
add_blog_option($blog_id, 'spam_master_comments_clean', 'true');
add_blog_option($blog_id, 'spam_master_signature_registration', 'true');
add_blog_option($blog_id, 'spam_master_signature_login', 'true');
add_blog_option($blog_id, 'spam_master_signature_comments', 'true');
add_blog_option($blog_id, 'spam_master_signature_email', 'true');
add_blog_option($blog_id, 'spam_master_block_count', '0');
add_blog_option($blog_id, 'spam_master_widget_heads_up', 'false');
add_blog_option($blog_id, 'spam_master_widget_statistics', 'false');
add_blog_option($blog_id, 'spam_master_widget_firewall', 'false');
add_blog_option($blog_id, 'spam_master_widget_dashboard_status', 'true');
add_blog_option($blog_id, 'spam_master_widget_dashboard_statistics', 'false');
add_blog_option($blog_id, 'spam_master_shortcodes_total_count', 'false');
add_blog_option($blog_id, 'spam_master_emails_alert_3_email', 'true');
add_blog_option($blog_id, 'spam_master_emails_alert_email', 'true');
add_blog_option($blog_id, 'spam_master_emails_weekly_email', 'true');
add_blog_option($blog_id, 'spam_master_emails_weekly_stats', 'true');
add_blog_option($blog_id, 'comment_russian_char', 'false');
update_blog_option($blog_id, 'comment_russian_char_set', $comment_russian_char_array_implode);
add_blog_option($blog_id, 'comment_chinese_char', 'false');
update_blog_option($blog_id, 'comment_chinese_char_set', $comment_chinese_char_array_implode);
add_blog_option($blog_id, 'comment_asian_char', 'false');
update_blog_option($blog_id, 'comment_asian_char_set', $comment_asian_char_array_implode);
add_blog_option($blog_id, 'comment_arabic_char', 'false');
update_blog_option($blog_id, 'comment_arabic_char_set', $comment_arabic_char_array_implode);
add_blog_option($blog_id, 'comment_spam_char', 'false');
update_blog_option($blog_id, 'comment_spam_char_set', $comment_spam_char_array_implode);
update_blog_option($blog_id, 'spam_master_firewall_on', 'true');
update_blog_option($blog_id, 'require_name_email', '1');
update_blog_option($blog_id, 'spam_master_comment_website_field', 'true');
$response_key = get_blog_option($blog_id, 'spam_master_status');
$spam_master_type = get_blog_option($blog_id, 'spam_master_type');
$spam_master_trial_expired = get_blog_option($blog_id, 'spam_master_trial_expired');
$spam_master_full_expired = get_blog_option($blog_id, 'spam_master_full_expired');
$spam_master_full_notice = get_blog_option($blog_id, 'spam_master_full_notice');
$spam_master_emails_weekly_email = get_blog_option($blog_id, 'spam_master_emails_weekly_email');
//flush add new htaccess rule

}
else{
add_option('spam_master_type', 'NO TYPE');
add_option('spam_master_status', 'INACTIVE');
add_option('spam_master_message', ': Email, Domain, or Ip banned from registration.');
add_option('spam_master_learning_active', 'true');
add_option('spam_master_comment_strict_on', 'true');
add_option('spam_master_comments_clean', 'true');
add_option('spam_master_signature_registration', 'true');
add_option('spam_master_signature_login', 'true');
add_option('spam_master_signature_comments', 'true');
add_option('spam_master_signature_email', 'true');
add_option('spam_master_block_count', '0');
add_option('spam_master_widget_heads_up', 'false');
add_option('spam_master_widget_statistics', 'false');
add_option('spam_master_widget_firewall', 'false');
add_option('spam_master_widget_dashboard_status', 'true');
add_option('spam_master_widget_dashboard_statistics', 'false');
add_option('spam_master_shortcodes_total_count', 'false');
add_option('spam_master_emails_alert_3_email', 'true');
add_option('spam_master_emails_alert_email', 'false');
add_option('spam_master_emails_weekly_email', 'true');
add_option('spam_master_emails_weekly_stats', 'true');
add_option('comment_russian_char', 'false');
update_option('comment_russian_char_set', $comment_russian_char_array_implode);
add_option('comment_chinese_char', 'false');
update_option('comment_chinese_char_set', $comment_chinese_char_array_implode);
add_option('comment_asian_char', 'false');
update_option('comment_asian_char_set', $comment_asian_char_array_implode);
add_option('comment_arabic_char', 'false');
update_option('comment_arabic_char_set', $comment_arabic_char_array_implode);
add_option('comment_spam_char', 'false');
update_option('comment_spam_char_set', $comment_spam_char_array_implode);
update_option('spam_master_firewall_on', 'true');
update_option('require_name_email', '1');
update_option('spam_master_comment_website_field', 'true');
$response_key = get_option('spam_master_status');
$spam_master_type = get_option('spam_master_type');
$spam_master_trial_expired = get_option('spam_master_trial_expired');
$spam_master_full_expired = get_option('spam_master_full_expired');
$spam_master_full_notice = get_option('spam_master_full_notice');
$spam_master_emails_weekly_email = get_option('spam_master_emails_weekly_email');
//Flush htaccess
add_action('admin_init', 'spam_master_flush_rewrites');
function spam_master_flush_rewrites($wp_rewrite){
global $wp_rewrite;
$wp_rewrite->flush_rules();
}
//add new htaccess rule
add_action( 'generate_rewrite_rules', 'spam_master_add_firewall_rewrites');
function spam_master_add_firewall_rewrites($wp_rewrite){
global $wp_rewrite;
$new_non_wp_rules = array('firewall/$' => 'wp-content/plugins/spam-master/includes/protection/spam-master-admin-other-protection-frontend-firewall.html');
$wp_rewrite->non_wp_rules = $new_non_wp_rules + $wp_rewrite->non_wp_rules;
return $wp_rewrite->non_wp_rules;
}
}

// HOOK ADMIN
require_once( dirname( __FILE__ ) . '/includes/admin/spam-master-admin.php');
// HOOK SETTINGS
if(is_multisite()){
	require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-settings-network-admin.php');
}
require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-settings.php');
// HOOK TRIAL
require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-settings-license-trial.php');
//HOOK LEARNING REG
if(is_multisite()){
	$spam_master_activate_learning_reg = get_blog_option($blog_id, 'users_can_register');
}
else{
	$spam_master_activate_learning_reg = get_option('users_can_register');
}
if($spam_master_activate_learning_reg == '1'){
	require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-learning-reg.php');
}
//HOOK LEARNING COM
if(is_multisite()){
	$spam_master_activate_learning_com = get_blog_option($blog_id, 'default_comment_status');
}
else{
	$spam_master_activate_learning_com = get_option('default_comment_status');
}
if($spam_master_activate_learning_com == 'open'){
	require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-learning-com.php');
}
// HOOK TOOLS
if(is_multisite()){
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-admin-other-protection-network-admin.php');
}
require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-admin-other-protection.php');
// HOOK FIREWALL
if(is_multisite()){
	require_once( dirname( __FILE__ ) . '/includes/firewall/spam-master-admin-firewall-network-admin.php');
}
require_once( dirname( __FILE__ ) . '/includes/firewall/spam-master-admin-firewall.php');
// HOOK REGISTRATIONS
if(is_multisite()){
	require_once( dirname( __FILE__ ) . '/includes/registrations/spam-master-admin-registrations-network-admin.php');
}
require_once( dirname( __FILE__ ) . '/includes/registrations/spam-master-admin-registrations.php');
// HOOK COMMENTS
if(is_multisite()){
require_once( dirname( __FILE__ ) . '/includes/comments/spam-master-admin-comments-network-admin.php');
}
require_once( dirname( __FILE__ ) . '/includes/comments/spam-master-admin-comments.php');
// HOOK STATISTICS
if(is_multisite()){
	require_once( dirname( __FILE__ ) . '/includes/statistics/spam-master-admin-statistics-network-admin.php');
}
require_once( dirname( __FILE__ ) . '/includes/statistics/spam-master-admin-statistics.php');
// HOOK WIDGETS & SHORTCODES wp-options dependent pages
if(is_multisite()){
	$spam_master_widget_heads_up = get_blog_option($blog_id, 'spam_master_widget_heads_up');
	$spam_master_widget_statistics = get_blog_option($blog_id, 'spam_master_widget_statistics');
	$spam_master_widget_firewall = get_blog_option($blog_id, 'spam_master_widget_firewall');
	$spam_master_widget_dashboard_status = get_blog_option($blog_id, 'spam_master_widget_dashboard_status');
	$spam_master_widget_dashboard_statistics = get_blog_option($blog_id, 'spam_master_widget_dashboard_statistics');
	$spam_master_shortcodes_total_count = get_blog_option($blog_id, 'spam_master_shortcodes_total_count');
	$spam_master_integrations_contact_form_7 = get_blog_option($blog_id, 'spam_master_integrations_contact_form_7');
	$spam_master_integrations_woocommerce = get_blog_option($blog_id, 'spam_master_integrations_woocommerce');
}
else{
	$spam_master_widget_heads_up = get_option('spam_master_widget_heads_up');
	$spam_master_widget_statistics = get_option('spam_master_widget_statistics');
	$spam_master_widget_firewall = get_option('spam_master_widget_firewall');
	$spam_master_widget_dashboard_status = get_option('spam_master_widget_dashboard_status');
	$spam_master_widget_dashboard_statistics = get_option('spam_master_widget_dashboard_statistics');
	$spam_master_shortcodes_total_count = get_option('spam_master_shortcodes_total_count');
	$spam_master_integrations_contact_form_7 = get_option('spam_master_integrations_contact_form_7');
	$spam_master_integrations_woocommerce = get_option('spam_master_integrations_woocommerce');
}
if($spam_master_widget_heads_up == 'true'){
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-widget-heads-up.php');
}
if($spam_master_widget_statistics == 'true'){
}
if($spam_master_widget_firewall == 'true'){
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-widget-firewall.php');
}
if($spam_master_widget_dashboard_status == 'true'){
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-widget-dashboard-status.php');
}
if($spam_master_widget_dashboard_statistics == 'true'){
}
if($spam_master_shortcodes_total_count == 'true'){
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-shortcodes.php');
}
if($spam_master_integrations_contact_form_7 == 'true'){
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-contact-form-7.php');
}
if($spam_master_integrations_woocommerce == 'true'){
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-woocommerce-sig.php');
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-woocommerce-reg.php');
}

add_action('admin_notices', 'spam_master_admin_notices');
function spam_master_admin_notices(){
global $wpdb, $blog_id;
if( is_multisite() ){
$response_key = get_blog_option($blog_id, 'spam_master_status');
$spam_master_type = get_blog_option($blog_id, 'spam_master_type');
}
else{
$response_key = get_option('spam_master_status');
$spam_master_type = get_option('spam_master_type');
}

//Courtesy Link
if($spam_master_type == 'FULL'){
	add_filter('in_admin_footer', 'spam_master_footer_full_admin');
	function spam_master_footer_full_admin($default){
		$screen = get_current_screen();
		if(in_array($screen->id, array( 'toplevel_page_spam-master', 'spam-master_page_spam-master-settings', 'spam-master_page_spam-master-recaptcha', 'spam-master_page_spam-master-firewall', 'spam-master_page_spam-master-registrations', 'spam-master_page_spam-master-comments', 'spam-master_page_spam-master-statistics'))){
			echo '<span id="footer-thankyou">&nbsp;&nbsp;|&nbsp;&nbsp;Thank you for using <a href="https://spammaster.techgasp.com" target="_blank">Spam Master</a>. Please <a href="https://www.wordpress.org/plugins/spam-master/" target="_blank">rate us on WordPress.org</a>.</span>';
		}
	}
}
if($spam_master_type == 'TRIAL'){
	add_filter('in_admin_footer', 'spam_master_footer_trial_admin');
	function spam_master_footer_trial_admin($default){
		$screen = get_current_screen();
		if(in_array($screen->id, array( 'toplevel_page_spam-master', 'spam-master_page_spam-master-settings', 'spam-master_page_spam-master-recaptcha', 'spam-master_page_spam-master-firewall', 'spam-master_page_spam-master-registrations', 'spam-master_page_spam-master-comments', 'spam-master_page_spam-master-statistics'))){
			echo '<span id="footer-thankyou">&nbsp;&nbsp;|&nbsp;&nbsp;Thank you for using <a href="https://spammaster.techgasp.com" target="_blank">Spam Master</a>.</span>';
		}
	}
}

///STATUS VALID
	if ($response_key == 'VALID'){
	}
//STATUS MALFUNCTION_1
	if ($response_key == 'MALFUNCTION_1'){
		?>
		<div class="notice notice-warning is-dismissible">
		<h2><em>Spam Master Malfunction 1. Not up to date!!! Please Update Spam Master</em></h2>
		<p>Your License is Valid and your Protection is Active & Online, not to worry. Please update, upgrade Spam Master to the latest available version in your plugins administrator page.</p>
		<p></p>
		<p>p.s. warning will auto disappear once Spam Master is updated and re-syncs with the RBL servers or, by pressing <b>RE-SYNCHRONIZE LICENSE NOW</b> button in Spam Master Settings page.</p>
		</div>
		<?php
	}
//STATUS MALFUNCTION_2
	if ($response_key == 'MALFUNCTION_2'){
		?>
		<div class="notice notice-warning is-dismissible">
		<h2><em>Spam Master Malfunction 2!!! Urgently Update Spam Master to the latest version</em></h2>
		<p>Your License is Valid and your Protection is Active & Online but, Malfunction 2 was detected. Urgently update, upgrade Spam Master to the latest available version in your plugins administrator page.</p>
		<p></p>
		<p>p.s. warning will auto disappear once malfunction is fixed and Spam Master re-syncs with the RBL servers or, by pressing <b>RE-SYNCHRONIZE LICENSE NOW</b> button in Spam Master Settings page.</p>
		</div>
		<?php
	}
//STATUS MALFUNCTION_3
	if ($response_key == 'MALFUNCTION_3'){
		?>
		<div class="notice notice-error is-dismissible">
		<h2><em>Spam Master Malfunction 3</em></h2>
		<p>Warning!!! Your License is <b>INACTIVE & OFFLINE</b>, Malfunction 3 was detected.</p>
		<p>More about malfunction 3 <a href="https://wordpress.techgasp.com/spam-master-documentation/" target="_blank" title="more about malfunction 3"><em>click here</em></a>.</p>
		<p>Please get in touch with TechGasp via <a href="https://wordpress.techgasp.com/support/" target="_blank" title="Support Ticket"><em>Support Ticket</em></a> and refer malfunction 3.</p>
		<p></p>
		<p>p.s. warning will auto disappear once malfunction is fixed.</p>
		</div>
		<?php
		if( is_multisite() ){
		update_blog_option($blog_id, 'spam_master_alert_level', '');
		update_blog_option($blog_id, 'spam_master_alert_level_date', '');
		}
		else{
		update_option('spam_master_alert_level', '');
		update_option('spam_master_alert_level_date', '');
		}
	}
//STATUS EXPIRED
	if ($response_key == 'EXPIRED'){
		if($spam_master_type == 'TRIAL'){
			?>
			<div class="notice notice-error is-dismissible">
			<h2><em>Spam Master</em></h2>
			<p>Warning!!! Your Trial License EXPIRED.</p>
			<p>Hope you have enjoyed the bombastic spam protection provided by Spam Master. Unfortunately your website is now unprotected and may be subjected to thousands of spam threats & exploits.</p>
			<p></p>
			<p>Not to worry! If you enjoyed the protection you can quickly get a full license, it costs peanuts per year, <a href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="get full license"><em>get full license</em></a></p>
			<p></p>
			<p>p.s. warning will disappear once license key is inserted and you press Save & Refresh.</p>
			</div>
			<?php
		}
		if($spam_master_type == 'FULL'){
			?>
			<div class="notice notice-error is-dismissible">
			<h2><em>Spam Master</em></h2>
			<p>Warning!!! Your License EXPIRED.</p>
			<p>Hope you have enjoyed 1 year of bombastic spam protection provided by Spam Master. Unfortunately your website is now unprotected and may be subjected to thousands of spam threats & exploits.</p>
			<p></p>
			<p>Not to worry! If you enjoyed the protection you can quickly get another license, it costs peanuts per year, <a href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="get full license"><em>get full license</em></a></p>
			<p></p>
			<p>p.s. warning will disappear once license key is inserted and you press Save & Refresh.</p>
			</div>
			<?php
		}
		if( is_multisite() ){
		update_blog_option($blog_id, 'spam_master_alert_level', '');
		update_blog_option($blog_id, 'spam_master_alert_level_date', '');
		}
		else{
		update_option('spam_master_alert_level', '');
		update_option('spam_master_alert_level_date', '');
		}
	}
//STATUS INACTIVE, NO LICENSE SENT YET
	if ($response_key == 'INACTIVE'){
		if($spam_master_type == 'TRIAL'){
		?>
			<div class="notice notice-error is-dismissible">
			<h2><em>Spam Master Free Trial</em></h2>
			<p>Warning!!! Your License is <b>INACTIVE & OFFLINE!!!</b></p>
			<p>Are you a first time user? Not to worry get a 7 day free trial license to test Spam Master awesomeness <a href="https://spammaster.techgasp.com/wp-login.php?action=register" target="_blank" title="Spam Master Awesomeness"><em>click here</em></a>.</p>
			<p></p>
			<p>p.s. warning will disappear once license key is inserted and you press Save & Refresh.</p>
			</div>
		<?php
		}
		if($spam_master_type == 'FULL'){
		?>
			<div class="notice notice-error is-dismissible">
			<h2><em>Please Update Spam Master!!!</em></h2>
			<p>Warning!!! Your license is <b>INACTIVE & OFFLINE</b> you haven't updated, upgraded Spam Master "for a very long time". Not to worry, please update Spam Master to the latest version and re-activate your license.</p>
			<p>1. Update Spam Master to the latest version in your plugins administrator page.</p>
			<p>2. Go to Spam Master Settings page and under the license key press the <b>RE-SYNCHRONIZE LICENSE NOW</b> button.</p>
			</div>
		<?php
		}
		if( is_multisite() ){
		update_blog_option($blog_id, 'spam_master_alert_level', '');
		update_blog_option($blog_id, 'spam_master_alert_level_date', '');
		}
		else{
		update_option('spam_master_alert_level', '');
		update_option('spam_master_alert_level_date', '');
		}
	}
//END FUNC ADIM NOTICES
}

//set emails outside admin scope including weekly email cron
if($response_key == 'EXPIRED'){
	if( is_multisite() ){
		update_blog_option($blog_id, 'blacklist_keys_bk', get_blog_option($blog_id, 'blacklist_keys'));
		delete_blog_option($blog_id, 'blacklist_keys');
		delete_blog_option($blog_id, 'comment_russian_char_set');
		delete_blog_option($blog_id, 'comment_chinese_char_set');
		delete_blog_option($blog_id, 'comment_asian_char_set');
		delete_blog_option($blog_id, 'comment_arabic_char_set');
		delete_blog_option($blog_id, 'comment_spam_char_set');
	}
	else{
		update_option('blacklist_keys_bk', get_option('blacklist_keys'));
		delete_option('blacklist_keys');
		delete_option('comment_russian_char_set');
		delete_option('comment_chinese_char_set');
		delete_option('comment_asian_char_set');
		delete_option('comment_arabic_char_set');
		delete_option('comment_spam_char_set');
	}
	if($spam_master_type == 'TRIAL'){
		if(empty($spam_master_trial_expired)){
			require_once( dirname( __FILE__ ) . '/includes/emails/spam-master-admin-emails-mail-trial.php');
		}
	}
	if($spam_master_type == 'FULL'){
		if(empty($spam_master_full_expired)){
			require_once( dirname( __FILE__ ) . '/includes/emails/spam-master-admin-emails-mail-full.php');
		}
	}
}
if($response_key == 'VALID'){
	if($spam_master_type == 'FULL'){
		if(empty($spam_master_full_notice)){
			require_once( dirname( __FILE__ ) . '/includes/emails/spam-master-admin-emails-mail-full-notice.php');
		}
	}
	//set 6 days report email if active
	if($spam_master_emails_weekly_email == 'true'){
		function spam_master_weekly_report_cron( $schedules ) {
			$schedules['6days'] = array(
			'interval' => 518400,
			'display' => __( '6 Days', 'spam_master' )
			);
		 return $schedules;
		}
		add_filter( 'cron_schedules', 'spam_master_weekly_report_cron' );

		//sets the updater page
		function spam_master_weekly_report_load_cron(){
		global $wpdb, $blog_id;
			require_once( dirname( __FILE__ ) . '/includes/emails/spam-master-admin-emails-weekly-report.php');
			if( is_multisite() ){
				$spam_master_emails_weekly_stats = get_blog_option($blog_id, 'spam_master_emails_weekly_stats');
			}
			else{
				$spam_master_emails_weekly_stats = get_option('spam_master_emails_weekly_stats');
			}
			if($spam_master_emails_weekly_stats == 'true'){
				require_once( dirname( __FILE__ ) . '/includes/emails/spam-master-admin-emails-weekly-stats-report.php');
			}
		}

		if ( ! wp_next_scheduled( 'spam_master_weekly_report_load' ) ) {
		  wp_schedule_event( time(), '6days', 'spam_master_weekly_report_load' );
		}
		add_action( 'spam_master_weekly_report_load', 'spam_master_weekly_report_load_cron' );

		//registers deactivation if plugin uninstalled
		function spam_master_remove_weekly_report_cron_schedule(){
		  wp_clear_scheduled_hook( 'spam_master_weekly_report_load' );
		}
		register_deactivation_hook( __FILE__, 'spam_master_remove_weekly_report_cron_schedule' );
	}
	else{
		//registers deactivation if plugin uninstalled
		function spam_master_remove_weekly_report_cron_schedule(){
		  wp_clear_scheduled_hook( 'spam_master_weekly_report_load' );
		}
		register_deactivation_hook( __FILE__, 'spam_master_remove_weekly_report_cron_schedule' );
	}
}

//////////////////////////
////////CRON HOOKS////////
//////////////////////////
//sets the cron time
function spam_master_license_cron( $schedules ) {
	$schedules['daily'] = array(
		'interval' => 86400,
		'display' => __( 'Once Daily', 'spam_master' )
	);
  return $schedules;
}
add_filter( 'cron_schedules', 'spam_master_license_cron' );

//sets the updater page
function spam_master_license_load_cron(){
	require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-settings-license-sender.php');
}

if ( ! wp_next_scheduled( 'spam_master_license_load' ) ) {
  wp_schedule_event( time(), 'daily', 'spam_master_license_load' );
}
add_action( 'spam_master_license_load', 'spam_master_license_load_cron' );

//registers deactivation if plugin uninstalled
function spam_master_remove_license_cron_schedule(){
  wp_clear_scheduled_hook( 'spam_master_license_load' );
}
register_deactivation_hook( __FILE__, 'spam_master_remove_license_cron_schedule' );

//sets the buffer time
function spam_master_blacklist_cron( $schedules ) {
	$schedules['quartely'] = array(
		'interval' => 7889238,
		'display' => __( 'Once Quartely', 'spam_master' )
	);
  return $schedules;
}
add_filter( 'cron_schedules', 'spam_master_blacklist_cron' );

//sets the updater page
function spam_master_blacklist_load_cron(){
	require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-settings-blacklist.php');
}

if ( ! wp_next_scheduled( 'spam_master_blacklist_load' ) ) {
  wp_schedule_event( time(), 'quartely', 'spam_master_blacklist_load' );
}
add_action( 'spam_master_blacklist_load', 'spam_master_blacklist_load_cron' );

//registers deactivation if plugin uninstalled
function spam_master_remove_blacklist_cron_schedule(){
  wp_clear_scheduled_hook( 'spam_master_blacklist_load' );
}
register_deactivation_hook( __FILE__, 'spam_master_remove_blacklist_cron_schedule' );

function spam_master_clean_comments( $schedules ) {
	$schedules['daily'] = array(
		'interval' => 86400,
		'display' => __( 'Once Daily', 'spam_master' )
	);
  return $schedules;
}
add_filter( 'cron_schedules', 'spam_master_clean_comments' );

//sets the cron page
function spam_master_load_clean_comments_cron(){
	require_once( dirname( __FILE__ ) . '/includes/protection/spam-master-admin-protection-clean-comments.php');
}

if ( ! wp_next_scheduled( 'spam_master_load_clean_comments' ) ) {
  wp_schedule_event( time(), 'daily', 'spam_master_load_clean_comments' );
}
add_action( 'spam_master_load_clean_comments', 'spam_master_load_clean_comments_cron' );

//registers deactivation if plugin uninstalled
function spam_master_remove_clean_comments(){
  wp_clear_scheduled_hook( 'spam_master_load_clean_comments' );
}
register_deactivation_hook( __FILE__, 'spam_master_remove_clean_comments' );
//uninstall stuff
function spam_master_uninstall(){
	require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-settings-uninstall-options.php');
	require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-settings-uninstall-reg-transients.php');
	require_once( dirname( __FILE__ ) . '/includes/settings/spam-master-admin-settings-uninstall-fir-transients.php');
}
register_uninstall_hook( __FILE__, 'spam_master_uninstall' );
?>
