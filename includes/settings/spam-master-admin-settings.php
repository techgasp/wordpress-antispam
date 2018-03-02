<?php
function menu_single(){
	if ( is_admin() )
		add_submenu_page( 'spam-master', 'Settings', 'Settings', 'manage_options', 'spam-master-settings', 'spam_master_options' );
}
///////////////////////
// WORDPRESS ACTIONS //
///////////////////////
if( is_multisite() ) {
	add_action('admin_menu', 'menu_single');
}
else {
	add_action( 'admin_menu', 'menu_single' );
}
////////////////////////
// ADMINISTRATOR PAGE //
////////////////////////
function spam_master_options() {
global $wpdb, $blog_id;
$plugin_master_name = constant('SPAM_MASTER_NAME');
?>
<div class="wrap">
<h1><?php echo $plugin_master_name; ?> Settings</h1>
<?php

//Load Protection & License Status Table
	require_once( dirname( __FILE__ ) . '/spam-master-admin-settings-license-status-table.php');
//Load Edit Registration Message Table
	require_once( dirname( __FILE__ ) . '/spam-master-admin-settings-edit-registration-message-table.php');

?>
<br>
<h2>IMPORTANT: Makes no use of Javascript or Ajax to keep your website fast and conflicts free</h2>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
<br>
<p>
<a class="button-secondary" href="https://wordpress.techgasp.com" target="_blank" title="Visit Website">More TechGasp Plugins</a>
<a class="button-secondary" href="https://wordpress.techgasp.com/support/" target="_blank" title="TechGasp Support">TechGasp Support</a>
<a class="button-primary" href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="Visit Website"><?php echo $plugin_master_name; ?> Info</a>
<a class="button-primary" href="https://wordpress.techgasp.com/spam-master-documentation/" target="_blank" title="Visit Website"><?php echo $plugin_master_name; ?> Documentation</a>
<a class="button-primary" href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Visit Website">RATE US *****</a>
</p>
</div>
<?php
//END OPTIONS FUNCTION
}
?>
