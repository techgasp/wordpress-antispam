<?php
		/** function/method
		* Usage: hooking (registering) the plugin menu
		* Arg(0): null
		* Return: void
		*/
		function menu_com_single(){
		if ( is_admin() )
		add_submenu_page( 'spam-master', 'Comments', 'Comments', 'manage_options', 'spam-master-comments', 'spam_master_comments' );
		}

		///////////////////////
		// WORDPRESS ACTIONS //
		///////////////////////
		if( is_multisite() ) {
		add_action( 'admin_menu', 'menu_com_single' );
		}
		else {
		add_action( 'admin_menu', 'menu_com_single' );
		}

function spam_master_comments(){
$plugin_master_name = constant('SPAM_MASTER_NAME');
///////////////////////////////
//Prepare Comments Graph//
///////////////////////////////
//Prepare 5 Days
$spam_master_users_today = date( 'Y-m-d' );
$spam_master_users_today_minus_1 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
$spam_master_users_today_minus_2 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-2, date("Y")));
$spam_master_users_today_minus_3 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-3, date("Y")));
$spam_master_users_today_minus_4 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-4, date("Y")));
//QUERY DATABASE FOR BLOCKED
global $wpdb;
if (is_multisite()){
	$blog_prefix = $wpdb->get_blog_prefix();
	$query_blocked = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today}%'";
	$query_blocked_1 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today_minus_1}%'";
	$query_blocked_2 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today_minus_2}%'";
	$query_blocked_3 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today_minus_3}%'";
	$query_blocked_4 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today_minus_4}%'";
}
else{
	$table_prefix = $wpdb->base_prefix;
	$query_blocked = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today}%'";
	$query_blocked_1 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today_minus_1}%'";
	$query_blocked_2 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today_minus_2}%'";
	$query_blocked_3 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today_minus_3}%'";
	$query_blocked_4 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='spam' AND comment_date LIKE '{$spam_master_users_today_minus_4}%'";
}
$totalitems_blocked = $wpdb->query($query_blocked);
$totalitems_blocked_1 = $wpdb->query($query_blocked_1);
$totalitems_blocked_2 = $wpdb->query($query_blocked_2);
$totalitems_blocked_3 = $wpdb->query($query_blocked_3);
$totalitems_blocked_4 = $wpdb->query($query_blocked_4);
//QUERY DATABASE FOR APPROVED
if (is_multisite()){
	$blog_prefix = $wpdb->get_blog_prefix();
	$query_approved = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today}%'";
	$query_approved_1 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today_minus_1}%'";
	$query_approved_2 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today_minus_2}%'";
	$query_approved_3 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today_minus_3}%'";
	$query_approved_4 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today_minus_4}%'";
}
else{
	$query_approved = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today}%'";
	$query_approved_1 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today_minus_1}%'";
	$query_approved_2 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today_minus_2}%'";
	$query_approved_3 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today_minus_3}%'";
	$query_approved_4 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='1' AND comment_date LIKE '{$spam_master_users_today_minus_4}%'";
}
$totalitems_approved = $wpdb->query($query_approved);
$totalitems_approved_1 = $wpdb->query($query_approved_1);
$totalitems_approved_2 = $wpdb->query($query_approved_2);
$totalitems_approved_3 = $wpdb->query($query_approved_3);
$totalitems_approved_4 = $wpdb->query($query_approved_4);
//QUERY DATABASE FOR PENDING
if (is_multisite()){
	$blog_prefix = $wpdb->get_blog_prefix();
	$query_pending = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today}%'";
	$query_pending_1 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today_minus_1}%'";
	$query_pending_2 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today_minus_2}%'";
	$query_pending_3 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today_minus_3}%'";
	$query_pending_4 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today_minus_4}%'";
}
else{
	$query_pending = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today}%'";
	$query_pending_1 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today_minus_1}%'";
	$query_pending_2 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today_minus_2}%'";
	$query_pending_3 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today_minus_3}%'";
	$query_pending_4 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='0' AND comment_date LIKE '{$spam_master_users_today_minus_4}%'";
}
$totalitems_pending = $wpdb->query($query_pending);
$totalitems_pending_1 = $wpdb->query($query_pending_1);
$totalitems_pending_2 = $wpdb->query($query_pending_2);
$totalitems_pending_3 = $wpdb->query($query_pending_3);
$totalitems_pending_4 = $wpdb->query($query_pending_4);
//QUERY DATABASE FOR TRASHED
if (is_multisite()){
	$blog_prefix = $wpdb->get_blog_prefix();
	$query_trashed = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today}%'";
	$query_trashed_1 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today_minus_1}%'";
	$query_trashed_2 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today_minus_2}%'";
	$query_trashed_3 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today_minus_3}%'";
	$query_trashed_4 = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today_minus_4}%'";
}
else{
	$query_trashed = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today}%'";
	$query_trashed_1 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today_minus_1}%'";
	$query_trashed_2 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today_minus_2}%'";
	$query_trashed_3 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today_minus_3}%'";
	$query_trashed_4 = "SELECT * FROM {$table_prefix}comments WHERE comment_approved='trash' AND comment_date LIKE '{$spam_master_users_today_minus_4}%'";
}
$totalitems_trashed = $wpdb->query($query_trashed);
$totalitems_trashed_1 = $wpdb->query($query_trashed_1);
$totalitems_trashed_2 = $wpdb->query($query_trashed_2);
$totalitems_trashed_3 = $wpdb->query($query_trashed_3);
$totalitems_trashed_4 = $wpdb->query($query_trashed_4);
?>
<div class="wrap">
<h1><?php echo $plugin_master_name; ?> Comments</h1>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Comments Apropved', 'Comments Blocked', 'Comments Blocked Trashed','Comments Pending'],
          ['<?php echo $spam_master_users_today_minus_4; ?>',	<?php echo $totalitems_approved_4; ?>,	<?php echo $totalitems_blocked_4; ?>,	<?php echo $totalitems_trashed_4; ?>,	<?php echo $totalitems_pending_4; ?>],
          ['<?php echo $spam_master_users_today_minus_3; ?>',	<?php echo $totalitems_approved_3; ?>,	<?php echo $totalitems_blocked_3; ?>,	<?php echo $totalitems_trashed_3; ?>,	<?php echo $totalitems_pending_3; ?>],
          ['<?php echo $spam_master_users_today_minus_2; ?>',	<?php echo $totalitems_approved_2; ?>,	<?php echo $totalitems_blocked_2; ?>,	<?php echo $totalitems_trashed_2; ?>,	<?php echo $totalitems_pending_2; ?>],
          ['<?php echo $spam_master_users_today_minus_1; ?>',	<?php echo $totalitems_approved_1; ?>,	<?php echo $totalitems_blocked_1; ?>,	<?php echo $totalitems_trashed_1; ?>,	<?php echo $totalitems_pending_1; ?>],
          ['<?php echo $spam_master_users_today; ?>',	<?php echo $totalitems_approved; ?>,	<?php echo $totalitems_blocked; ?>,	<?php echo $totalitems_trashed; ?>,	<?php echo $totalitems_pending; ?>],
        ]);

        var options = {
          title: '',
          curveType: 'function',
          legend: { position: 'bottom' },
          vAxis: {title: 'Comments'},
          logScale:true,
          series: {
			0: { color: '#078BB3', pointSize: '10'},
			1: { color: '#6BD474', pointSize: '10'},
			2: { color: '#559E5B', pointSize: '10'},
			3: { color: '#F2AE41', pointSize: '10'}
			},
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
</script>
<div id="curve_chart" style="width: 100%; height: 300px"></div>
<br>

<form method="post" width='1'>
<fieldset class="options">
<?php
if(!class_exists('spam_master_comments_header_blocked')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-comments-header-blocked.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_comments_header_blocked();
//Table of elements
$wp_list_table->display();

if(!class_exists('spam_master_comments_table')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-comments-table.php');
}
//Prepare Table of elements
$wp_list_table = new spam_master_comments_table();
$wp_list_table->prepare_items();
//Table of elements
$wp_list_table->display();
?>
<p class="submit" style="margin:0px; padding:0px; height:30px;"><input class='button-primary' type='submit' name='update' value='<?php _e("Refresh List", 'spam_master'); ?>' id='submitbutton' /></p>
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
