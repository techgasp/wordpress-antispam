<?php
add_action( 'wp_user_dashboard_setup', 'spam_master_add_dashboard_status' );
add_action( 'wp_dashboard_setup', 'spam_master_add_dashboard_status' );

function spam_master_add_dashboard_status() {
$user = wp_get_current_user();
wp_add_dashboard_widget(
'spam_master_add_dashboard_status',
__( 'Spam Master Dashboard Status' ),
'spam_master_dashboard_status_content'
);
}

function spam_master_dashboard_status_content() {
global $wpdb, $blog_id;
//PREPARE WIDGET
if( is_multisite() ){
$response_key = get_blog_option( $blog_id, 'spam_master_status');
$firewall_active = get_blog_option($blog_id, 'spam_master_firewall_on');
}
else{
$response_key = get_option('spam_master_status');
$firewall_active = get_option('spam_master_firewall_on');
}
//STATUS VALID
if ($response_key == 'VALID'){
	if( is_multisite() ){
		$spam_master_protection_selection = 'Active';
		$spam_master_protection_bgcolor= "07B357";
		$license_color = "07B357";
		$license_status = "Valid";
		$spam_license_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$protection_total_number = get_blog_option($blog_id, 'spam_master_protection_total_number');
		$protection_number_color = "07B357";
		$spam_protected_against_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$learning_color = "07B357";
		$learning_status = "Online";
		$spam_leaning_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		if($firewall_active == 'true'){
		$firewall_color = "07B357";
		$firewall_status = "Online";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		else{
		$firewall_color = "6d8770";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		$full_rbl_color = "07B357";
		$full_rbl_status = "Connected";
		$spam_rbl_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		
	}
	else{
		$spam_master_protection_selection = 'Active';
		$spam_master_protection_bgcolor= "07B357";
		$license_color = "07B357";
		$license_status = "Valid";
		$spam_license_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$protection_total_number = get_option('spam_master_protection_total_number');
		$protection_number_color = "07B357";
		$spam_protected_against_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$learning_color = "07B357";
		$learning_status = "Online";
		$spam_leaning_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		if($firewall_active == 'true'){
		$firewall_color = "07B357";
		$firewall_status = "Online";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		else{
		$firewall_color = "6d8770";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		$full_rbl_color = "07B357";
		$full_rbl_status = "Connected";
		$spam_rbl_status_icon = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	}
}
//STATUS EXPIRED
if ($response_key == 'EXPIRED'){
	if( is_multisite() ){
		$spam_master_protection_selection = 'Expired';
		$spam_master_protection_bgcolor= "F2AE41";
		$license_color = "F2AE41";
		$license_status = "Expired";
		$spam_license_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$protection_number_color = "F2AE41";
		$protection_total_number = "0";
		$spam_protected_against_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$learning_color = "525051";
		$learning_status = "Offline";
		$spam_leaning_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		if($firewall_active == 'true'){
		$firewall_color = "525051";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		else{
		$firewall_color = "525051";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		$full_rbl_color = "525051";
		$full_rbl_status = "Disconnected";
		$spam_rbl_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	}
	else{
		$spam_master_protection_selection = 'Expired';
		$spam_master_protection_bgcolor= "F2AE41";
		$license_color = "F2AE41";
		$license_status = "Expired";
		$spam_license_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$protection_number_color = "F2AE41";
		$protection_total_number = "0";
		$spam_protected_against_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$learning_color = "525051";
		$learning_status = "Offline";
		$spam_leaning_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		if($firewall_active == 'true'){
		$firewall_color = "525051";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		else{
		$firewall_color = "525051";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		$full_rbl_color = "525051";
		$full_rbl_status = "Disconnected";
		$spam_rbl_status_icon = '<img src="'.plugins_url('../images/check-fail.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	}
}
//STATUS INACTIVE, NO LICENSE SENT YET
if ($response_key == 'INACTIVE'){
	if( is_multisite() ){
		$spam_master_protection_selection = 'Inactive';
		$spam_master_protection_bgcolor= "563a3a";
		$license_color = "563a3a";
		$license_status = "Empty";
		$spam_license_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$protection_number_color = "563a3a";
		$protection_total_number = "0";
		$spam_protected_against_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$learning_color = "563a3a";
		$learning_status = "Offline";
		$spam_leaning_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		if($firewall_active == 'true'){
		$firewall_color = "563a3a";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		else{
		$firewall_color = "563a3a";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		$full_rbl_color = "563a3a";
		$full_rbl_status = "Disconnected";
		$spam_rbl_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	}
	else{
		$spam_master_protection_selection = 'Inactive';
		$spam_master_protection_bgcolor= "563a3a";
		$license_color = "563a3a";
		$license_status = "Empty";
		$spam_license_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$protection_number_color = "563a3a";
		$protection_total_number = "0";
		$spam_protected_against_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		$learning_color = "563a3a";
		$learning_status = "Offline";
		$spam_leaning_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		if($firewall_active == 'true'){
		$firewall_color = "563a3a";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		else{
		$firewall_color = "563a3a";
		$firewall_status = "Offline";
		$spam_firewall_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
		}
		$full_rbl_color = "563a3a";
		$full_rbl_status = "Disconnected";
		$spam_rbl_status_icon = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" />';
	}
}
echo '<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="'.plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)).'" style="float:left; height:18px; vertical-align:middle;" />&nbsp;License Status</h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th colspan="2"></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle; width:30%;"><b>License Status</b></td>
			<td style="vertical-align:middle;" bgcolor="#'.$license_color.'"><font color="white"><b>'.$spam_license_status_icon.'&nbsp;&nbsp;'.$license_status.'</b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width:20%;"><b>Protection Status</b></td>
			<td style="vertical-align:middle;" bgcolor="#'.$spam_master_protection_bgcolor.'"><font color="white"><b>'.$spam_license_status_icon.'&nbsp;&nbsp;'.$spam_master_protection_selection.'</b></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Protected Against</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#'.$protection_number_color.'"><font color="white"><b>'.$spam_protected_against_status_icon.'&nbsp;&nbsp;'.number_format($protection_total_number).' threats</b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Spam Learning</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#'.$learning_color.'"><font color="white"><b>'.$spam_leaning_status_icon.'&nbsp;&nbsp;'.$learning_status.'</b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Firewall</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#'.$firewall_color.'"><font color="white"><b>'.$spam_firewall_status_icon.'&nbsp;&nbsp;'.$firewall_status.'</b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Primary RBL Cluster</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#'.$full_rbl_color.'"><font color="white"><b>'.$spam_rbl_status_icon.'&nbsp;&nbsp;'.$full_rbl_status.'</b></font></td>
		</tr>
		<tr>
			<td style="vertical-align:middle; width: 50%;"></td>
			<td style="vertical-align:middle; width: 50%;"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle; width: 50%;"><b>Secondary RBL Cluster</b></td>
			<td style="vertical-align:middle; width: 50%;" bgcolor="#'.$full_rbl_color.'"><font color="white"><b>'.$spam_rbl_status_icon.'&nbsp;&nbsp;'.$full_rbl_status.'</b></font></td>
		</tr>
	</tbody>
</table>';
}
?>
