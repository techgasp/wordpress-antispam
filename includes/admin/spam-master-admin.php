<?php
function menu_single_spam_master_admin(){
if ( is_admin() )
add_menu_page( 'Spam Master', 'Spam Master', 'manage_options', 'spam-master', 'spam_master_admin', plugins_url( 'spam-master/images/techgasp-minilogo-16.png' ) );
}

		///////////////////////
		// WORDPRESS ACTIONS //
		///////////////////////
		if( is_multisite() ) {
		add_action( 'network_admin_menu', 'menu_single_spam_master_admin' );
		add_action( 'admin_menu', 'menu_single_spam_master_admin' );
		}
		else {
		add_action( 'admin_menu', 'menu_single_spam_master_admin' );
		}

function spam_master_admin(){
$plugin_master_name = constant('SPAM_MASTER_NAME');
?>
<div class="wrap">
<h1>TechGasp - <?php echo $plugin_master_name; ?></h1>
<?php
if(!class_exists('spam_master_admin_table_header')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-table-header.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_admin_table_header();
//Table of elements
$wp_list_table->display();
?>
</br>

<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>

</br>

<?php
if(!class_exists('spam_master_admin_table_quick_start')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-table-quick-start.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_admin_table_quick_start();
//Table of elements
$wp_list_table->display();
?>
</br>

<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>

</br>

<?php
if(!class_exists('spam_master_admin_table_support')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-table-support.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_admin_table_support();
//Table of elements
$wp_list_table->display();
?>

</br>

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
