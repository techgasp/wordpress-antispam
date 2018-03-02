<?php
		/** function/method
		* Usage: hooking (registering) the plugin menu
		* Arg(0): null
		* Return: void
		*/
		function menu_com_net_single(){
		if ( is_admin() )
		add_submenu_page( 'spam-master', 'Comments', 'Comments', 'manage_options', 'spam-master-comments', 'spam_master_net_comments' );
		}

		///////////////////////
		// WORDPRESS ACTIONS //
		///////////////////////
		if( is_multisite() ) {
		add_action( 'network_admin_menu', 'menu_com_net_single' );
		}
		else {
		}

function spam_master_net_comments(){
$plugin_master_name = constant('SPAM_MASTER_NAME');
?>
<div class="wrap">
<h1><?php echo $plugin_master_name; ?> Comments</h1>

<form method="post" width='1'>
<fieldset class="options">
<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if(!class_exists('spam_master_comments_header_network_admin')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-comments-header-network-admin.php');
}

//Prepare Table of elements
$wp_list_table = new spam_master_comments_header_network_admin();
//Table of elements
$wp_list_table->display();

?>
</fieldset>
</form>
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
}
