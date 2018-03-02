<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_statistics_table extends WP_List_Table {

function display(){
global $wpdb, $blog_id;
$blog_prefix = $wpdb->get_blog_prefix();
$table_prefix = $wpdb->base_prefix;
if( is_multisite() ){
$response_key = get_blog_option($blog_id, 'spam_master_status');
$firewall_active = get_blog_option($blog_id, 'spam_master_firewall_on');
}
else{
$response_key = get_option('spam_master_status');
$firewall_active = get_option('spam_master_firewall_on');
}
///STATUS VALID
if ($response_key == 'VALID'){
	if( is_multisite() ){
		if($firewall_active == 'true'){
		$firewall_color = "07B357";
		$firewall_status = "ONLINE";
		}
		else{
		$firewall_color = "6d8770";
		$firewall_status = "OFFLINE, ACTIVATE FIREWALL IN PROTECTION TOOLS";
		}
		$full_rbl_color = "07B357";
		$full_rbl_status = "OPTIMAL CONNECTION";
		$learning_color = "07B357";
		$learning_status = "ONLINE";
		$alert_color = "07B357";
		$alert_level = get_blog_option($blog_id, 'spam_master_alert_level');
		$alert_date = get_blog_option($blog_id, 'spam_master_alert_level_date');
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(umeta_id) FROM {$table_prefix}usermeta WHERE meta_key='primary_blog' AND meta_value={$blog_id}");
		$spam_master_block_count = get_blog_option(1, 'spam_master_block_count');
		$protection_total_number = get_blog_option($blog_id, 'spam_master_protection_total_number');
		$protection_number_color = "07B357";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='trash'");
		
		
	}
	else{
		if($firewall_active == 'true'){
		$firewall_color = "07B357";
		$firewall_status = "ONLINE";
		}
		else{
		$firewall_color = "6d8770";
		$firewall_status = "OFFLINE, ACTIVATE FIREWALL IN PROTECTION TOOLS";
		}
		$full_rbl_color = "07B357";
		$full_rbl_status = "OPTIMAL CONNECTION";
		$learning_color = "07B357";
		$learning_status = "ONLINE";
		$alert_color = "07B357";
		$alert_level = get_option('spam_master_alert_level');
		$alert_date = get_option('spam_master_alert_level_date');
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
		$spam_master_block_count = get_option('spam_master_block_count');
		$protection_total_number = get_option('spam_master_protection_total_number');
		$protection_number_color = "07B357";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='trash'");
	}
}
///MALFUNCTION_1
if ($response_key == 'MALFUNCTION_1'){
	if( is_multisite() ){
		if($firewall_active == 'true'){
		$firewall_color = "563a3a";
		$firewall_status = "ONLINE";
		}
		else{
		$firewall_color = "6d8770";
		$firewall_status = "OFFLINE, ACTIVATE FIREWALL IN PROTECTION TOOLS";
		}
		$full_rbl_color = "563a3a";
		$full_rbl_status = "MALFUNCTION_1 CONNECTION";
		$learning_color = "563a3a";
		$learning_status = "MALFUNCTION_1 ONLINE";
		$alert_color = "563a3a";
		$alert_level = get_blog_option($blog_id, 'spam_master_alert_level');
		$alert_date = get_blog_option($blog_id, 'spam_master_alert_level_date');
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(umeta_id) FROM {$table_prefix}usermeta WHERE meta_key='primary_blog' AND meta_value={$blog_id}");
		$spam_master_block_count = get_blog_option(1, 'spam_master_block_count');
		$protection_total_number = get_blog_option($blog_id, 'spam_master_protection_total_number');
		$protection_number_color = "563a3a";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='trash'");
		
		
	}
	else{
		if($firewall_active == 'true'){
		$firewall_color = "563a3a";
		$firewall_status = "ONLINE";
		}
		else{
		$firewall_color = "6d8770";
		$firewall_status = "OFFLINE, ACTIVATE FIREWALL IN PROTECTION TOOLS";
		}
		$full_rbl_color = "563a3a";
		$full_rbl_status = "MALFUNCTION_1 CONNECTION";
		$learning_color = "563a3a";
		$learning_status = "MALFUNCTION_1 ONLINE";
		$alert_color = "563a3a";
		$alert_level = get_option('spam_master_alert_level');
		$alert_date = get_option('spam_master_alert_level_date');
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
		$spam_master_block_count = get_option('spam_master_block_count');
		$protection_total_number = get_option('spam_master_protection_total_number');
		$protection_number_color = "563a3a";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='trash'");
	}
}
///MALFUNCTION_2
if ($response_key == 'MALFUNCTION_2'){
	if( is_multisite() ){
		if($firewall_active == 'true'){
		$firewall_color = "563a3a";
		$firewall_status = "ONLINE";
		}
		else{
		$firewall_color = "6d8770";
		$firewall_status = "OFFLINE, ACTIVATE FIREWALL IN PROTECTION TOOLS";
		}
		$full_rbl_color = "563a3a";
		$full_rbl_status = "MALFUNCTION_2 CONNECTION";
		$learning_color = "563a3a";
		$learning_status = "MALFUNCTION_2 ONLINE";
		$alert_color = "563a3a";
		$alert_level = get_blog_option($blog_id, 'spam_master_alert_level');
		$alert_date = get_blog_option($blog_id, 'spam_master_alert_level_date');
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(umeta_id) FROM {$table_prefix}usermeta WHERE meta_key='primary_blog' AND meta_value={$blog_id}");
		$spam_master_block_count = get_blog_option(1, 'spam_master_block_count');
		$protection_total_number = get_blog_option($blog_id, 'spam_master_protection_total_number');
		$protection_number_color = "563a3a";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='trash'");
		
		
	}
	else{
		if($firewall_active == 'true'){
		$firewall_color = "563a3a";
		$firewall_status = "ONLINE";
		}
		else{
		$firewall_color = "6d8770";
		$firewall_status = "OFFLINE, ACTIVATE FIREWALL IN PROTECTION TOOLS";
		}
		$full_rbl_color = "563a3a";
		$full_rbl_status = "MALFUNCTION_2 CONNECTION";
		$learning_color = "563a3a";
		$learning_status = "MALFUNCTION_2 ONLINE";
		$alert_color = "563a3a";
		$alert_level = get_option('spam_master_alert_level');
		$alert_date = get_option('spam_master_alert_level_date');
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
		$spam_master_block_count = get_option('spam_master_block_count');
		$protection_total_number = get_option('spam_master_protection_total_number');
		$protection_number_color = "563a3a";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='trash'");
	}
}
///MALFUNCTION_3
if ($response_key == 'MALFUNCTION_3'){
	if( is_multisite() ){
		if($firewall_active == 'true'){
		$firewall_color = "525051";
		$firewall_status = "OFFLINE";
		}
		else{
		$firewall_color = "525051";
		$firewall_status = "OFFLINE";
		}
		$full_rbl_color = "525051";
		$full_rbl_status = "MALFUNCTION_3 CONNECTION";
		$learning_color = "525051";
		$learning_status = "MALFUNCTION_3 OFFLINE";
		$alert_color = "525051";
		$alert_level = "MALFUNCTION_3 OFFLINE";
		$alert_date = "No Sync date";
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(umeta_id) FROM {$table_prefix}usermeta WHERE meta_key='primary_blog' AND meta_value={$blog_id}");
		$spam_master_block_count = get_blog_option(1, 'spam_master_block_count');
		$protection_total_number = "0";
		$protection_number_color = "525051";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='trash'");
		
		
	}
	else{
		if($firewall_active == 'true'){
		$firewall_color = "525051";
		$firewall_status = "OFFLINE";
		}
		else{
		$firewall_color = "525051";
		$firewall_status = "OFFLINE";
		}
		$full_rbl_color = "525051";
		$full_rbl_status = "MALFUNCTION_3 DISCONNECTED";
		$learning_color = "525051";
		$learning_status = "MALFUNCTION_3 OFFLINE";
		$alert_color = "525051";
		$alert_level = "MALFUNCTION_3 OFFLINE";
		$alert_date = "No Sync date";
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
		$spam_master_block_count = get_option('spam_master_block_count');
		$protection_total_number = "0";
		$protection_number_color = "525051";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='trash'");
	}
}
//STATUS EXPIRED
if ($response_key == 'EXPIRED'){
	if( is_multisite() ){
		if($firewall_active == 'true'){
		$firewall_color = "525051";
		$firewall_status = "OFFLINE";
		}
		else{
		$firewall_color = "525051";
		$firewall_status = "OFFLINE";
		}
		$full_rbl_color = "525051";
		$full_rbl_status = "DISCONNECTED";
		$learning_color = "525051";
		$learning_status = "OFFLINE";
		$alert_color = "525051";
		$alert_level = "DISCONNECTED";
		$alert_date = "No Sync date";
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(umeta_id) FROM {$table_prefix}usermeta WHERE meta_key='primary_blog' AND meta_value={$blog_id}");
		$spam_master_block_count = get_blog_option(1, 'spam_master_block_count');
		$protection_number_color = "F2AE41";
		$protection_total_number = "0";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='trash'");
	}
	else{
		if($firewall_active == 'true'){
		$firewall_color = "525051";
		$firewall_status = "OFFLINE";
		}
		else{
		$firewall_color = "525051";
		$firewall_status = "OFFLINE";
		}
		$full_rbl_color = "525051";
		$full_rbl_status = "DISCONNECTED";
		$learning_color = "525051";
		$learning_status = "OFFLINE";
		$alert_color = "525051";
		$alert_level = "DISCONNECTED";
		$alert_date = "No Sync date";
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
		$spam_master_block_count = get_option('spam_master_block_count');
		$protection_number_color = "F2AE41";
		$protection_total_number = "0";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='trash'");
	}
}
//STATUS INACTIVE, NO LICENSE SENT YET
if ($response_key == 'INACTIVE'){
	if( is_multisite() ){
		if($firewall_active == 'true'){
		$firewall_color = "563a3a";
		$firewall_status = "OFFLINE";
		}
		else{
		$firewall_color = "563a3a";
		$firewall_status = "OFFLINE";
		}
		$full_rbl_color = "563a3a";
		$full_rbl_status = "DISCONNECTED";
		$learning_color = "563a3a";
		$learning_status = "OFFLINE";
		$alert_color = "563a3a";
		$alert_level = "DISCONNECTED";
		$alert_date = "No Sync date";
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(umeta_id) FROM {$table_prefix}usermeta WHERE meta_key='primary_blog' AND meta_value={$blog_id}");
		$spam_master_block_count = get_blog_option(1, 'spam_master_block_count');
		$protection_number_color = "563a3a";
		$protection_total_number = "0";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM {$blog_prefix}comments WHERE comment_approved='trash'");
	}
	else{
		if($firewall_active == 'true'){
		$firewall_color = "563a3a";
		$firewall_status = "OFFLINE";
		}
		else{
		$firewall_color = "563a3a";
		$firewall_status = "OFFLINE";
		}
		$full_rbl_color = "563a3a";
		$full_rbl_status = "DISCONNECTED";
		$learning_color = "563a3a";
		$learning_status = "OFFLINE";
		$alert_color = "563a3a";
		$alert_level = "DISCONNECTED";
		$alert_date = "No Sync date";
		$spam_master_user_registrations = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
		$spam_master_block_count = get_option('spam_master_block_count');
		$protection_number_color = "563a3a";
		$protection_total_number = "0";
		$spam_master_comments_total = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments");
		$spam_master_comments_total_blocked = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='spam'");
		$spam_master_comments_total_approved = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='1'");
		$spam_master_comments_total_pending = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='0'");
		$spam_master_comments_total_trashed = $wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved='trash'");
	}
}
//IF EMPTY DATA SET 0 for graph
if(empty($spam_master_user_registrations)){
	$spam_master_user_registrations = "0";
}
if(empty($spam_master_block_count)){
	$spam_master_block_count = "0";
}
if(empty($spam_master_comments_total)){
	$spam_master_comments_total = "0";
}
if(empty($spam_master_comments_total_approved)){
	$spam_master_comments_total_approved = "0";
}
if(empty($spam_master_comments_total_blocked)){
	$spam_master_comments_total_blocked = "0";
}
if(empty($spam_master_comments_total_trashed)){
	$spam_master_comments_total_aspam_master_comments_total_trashedpproved = "0";
}
if(empty($spam_master_comments_total_pending)){
	$spam_master_comments_total_pending = "0";
}

//SET TABLE DATA

?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2">
					<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
					<script type="text/javascript">
						google.charts.load('current', {'packages':['corechart']});
						google.charts.setOnLoadCallback(drawVisualization);


					function drawVisualization() {
					// Some raw data (not necessarily accurate)
					var data = google.visualization.arrayToDataTable([
					['Result', 'Users Approved', 'Firewall Triggers & Registrations Blocked', 'Comments Approved', 'Comments Blocked', 'Comments Blocked Trashed', 'Comments Pending',],
					['', <?php echo $spam_master_user_registrations; ?>, <?php echo $spam_master_block_count; ?>, <?php echo $spam_master_comments_total_approved; ?>, <?php echo $spam_master_comments_total_blocked; ?>, <?php echo $spam_master_comments_total_trashed; ?>, <?php echo $spam_master_comments_total_pending; ?>]
					]);

					var options = {
					title : '',
					seriesType: 'bars',
					series: {6: {type: 'line'}},
					legend: { position: 'bottom', maxLines: 3 },
					logScale:true,
					colors:[
						'#078BB3',
						'#E8052B',
						'#23B307',
						'#A53636',
						'#E1532D',
						'#F2AE41',
					],
					chartArea: {
						width:'90%',
						height:'90%',
					},
					};

					var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
					chart.draw(data, options);
					}
					</script>
					<div id="chart_div" style="width: 100%; height: 500px;"></div>
				</th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th colspan="2"></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Total Users</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#078BB3"><font color="white"><b><?php echo number_format($spam_master_user_registrations); ?></b> Registered</font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;">Total Firewall Triggers & Registrations Blocked</td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#078BB3"><font color="white"><b><?php echo number_format($spam_master_block_count); ?></b> Firewall Triggers & Registrations Blocked</font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Total Comments</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#078BB3"><font color="white"><b><?php echo number_format($spam_master_comments_total); ?></b> Comments</font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;">Total Comments Approved</td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#078BB3"><font color="white"><b><?php echo number_format($spam_master_comments_total_approved); ?></b> Comments</font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;">Total Comments Pending</td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#078BB3"><font color="white"><b><?php echo number_format($spam_master_comments_total_pending); ?></b> Comments</font>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;">Total Comments Blocked</td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#078BB3"><font color="white"><b><?php echo number_format($spam_master_comments_total_blocked); ?></b> Comments</font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;">Total Comments Blocked Trashed</td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#078BB3"><font color="white"><b><?php echo number_format($spam_master_comments_total_trashed); ?></b> Comments</font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Threat Alert Level</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#<?php echo $alert_color; ?>"><font color="white"><b>DATE: <?php echo $alert_date;?> - LEVEL: <?php echo $alert_level;?></b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Protected Against</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#<?php echo $protection_number_color; ?>"><font color="white"><b><?php echo number_format($protection_total_number);?> THREATS</b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Spam Learning</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#<?php echo $learning_color; ?>"><font color="white"><b><?php echo $learning_status; ?></b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Firewall</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#<?php echo $firewall_color; ?>"><font color="white"><b><?php echo $firewall_status; ?></b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Primary RBL Server Cluster</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#<?php echo $full_rbl_color; ?>"><font color="white">Cluster Status: <b><?php echo $full_rbl_status; ?></b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Secondary RBL Server Cluster</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#<?php echo $full_rbl_color; ?>"><font color="white">Cluster Status: <b><?php echo $full_rbl_status; ?></b></font></td>
		</tr>
	</tbody>
</table>
<?php
		}
}
?>
