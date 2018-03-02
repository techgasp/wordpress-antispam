<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_statistics_table_network extends WP_List_Table {
	function display(){
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th colspan="2"><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Statistics', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th colspan="2"></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td style="vertical-align:middle">
<b>Statistics are available per sub-site.</b>
			</td>
			<td style="vertical-align:middle"></td>
		</tr>
		<tr>
			<td style="vertical-align:middle"></td>
			<td style="vertical-align:middle"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle">
<b>Protected Against</b>
			</td>
			<td style="vertical-align:middle" bgcolor="#<?php
if( is_multisite() ) {
echo get_blog_option(1, 'spam_master_protection_number_color');
}
else{
echo get_option('spam_master_protection_number_color');
}
?>"><font color="white"><b><?php
if( is_multisite() ) {
echo get_blog_option(1, 'spam_master_protection_total');
}
else{
echo get_option('spam_master_protection_total');
}
?> Threats</b></font>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:middle"></td>
			<td style="vertical-align:middle"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle">
<b>Spam Learning</b>
			</td>
			<td style="vertical-align:middle" bgcolor="#<?php
if( is_multisite() ) {
echo get_blog_option(1, 'spam_master_learning_color');
}
else{
echo get_option('spam_master_learning_color');
}
?>"><font color="white"><b><?php
if( is_multisite() ) {
echo get_blog_option(1, 'spam_master_learning_status');
}
else{
echo get_option('spam_master_learning_status');
}
?></b></font>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:middle"></td>
			<td style="vertical-align:middle"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle">
<b>Primary RBL Server Cluster</b>
			</td>
			<td style="vertical-align:middle" bgcolor="#<?php
if( is_multisite() ) {
echo get_blog_option(1, 'spam_master_full_rbl_color');
}
else{
echo get_option('spam_master_full_rbl_color');
}
?>"><font color="white">Cluster Status: <b><?php
if( is_multisite() ) {
echo get_blog_option(1, 'spam_master_full_rbl_status');
}
else{
echo get_option('spam_master_full_rbl_status');
}
?></b></font>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:middle"></td>
			<td style="vertical-align:middle"></td>
		</tr>
		<tr class="alternate">
			<td style="vertical-align:middle">
<b>Secondary RBL Server Cluster</b>
			</td>
			<td style="vertical-align:middle" bgcolor="#<?php
if( is_multisite() ) {
echo get_blog_option(1, 'spam_master_full_rbl_color');
}
else{
echo get_option('spam_master_full_rbl_color');
}
?>"><font color="white">Cluster Status: <b><?php
if( is_multisite() ) {
echo get_blog_option(1, 'spam_master_full_rbl_status');
}
else{
echo get_option('spam_master_full_rbl_status');
}
?></b></font>
			</td>
		</tr>
	</tbody>
</table>
<?php
		}
}
