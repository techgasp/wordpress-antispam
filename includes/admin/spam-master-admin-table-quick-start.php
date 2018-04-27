<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_admin_table_quick_start extends WP_List_Table {
	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display() {
?>
<table class="widefat" cellspacing="0">
	<thead>
		<tr>
			<th><h2><img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" /><?php _e('&nbsp;Quick Start', 'spam_master'); ?></h2></th>
		</tr>
	</thead>

	<tfoot>
		<tr>
			<th></th>
		</tr>
	</tfoot>

	<tbody>
		<tr class="alternate">
			<td>
				<h1>Spam Master Page</h1>
				<p>This first page displays TechGasp Info (press Like and Follow to keep up-to-date), Quick Start, Latest News and Export Support Data to attach to support tickets.</p>
			</td>
		</tr>
		<tr class="alternate">
			<td>
				<h1>Settings Page</h1>
				<p>After checking if all above requirements are green, this is where you have an overview of the plugin status and registration message.</p>
				<p><b>Protection Status:</b> Automatically displays if Spam Master is Active, if everything is up and running. Connects directly to the below field License Status.</p>
				<p><b>License Status:</b> Automatically displays if License is Active or not. You need an active license to connect to Real Time Black List Servers "RBL". In previous versions we tested other systems where databases were kept on the plugin, but the most efficient is without a question the real-time connection to up to date Servers. The license "costs" peanuts per year and you can start by getting a <a href="https://spammaster.techgasp.com/wp-login.php?action=register" target="_blank" title="Spam Master Awesomeness"><b><em>free trial license</em></b></a>. Give it a go.</p>
				<p><b>Edit Registration Message:</b> This is the message displayed in the website frontend to blocked users or bots. You can change or delete the message. Try to keep it short.</p>
			</td>
		</tr>
		<tr class="alternate">
			<td>
				<h1>Protection Tools Page</h1>
				<p>This page displays more protection tools that you can easily activate. Each tool like <b>Firewall</b>, <b>Honeypot</b>, <b>Re-Captcha</b>, <b>Signatures</b>, <b>Anti-virus</b>, <b>Learning</b>, etc. gets explained inside the Protection Tools page. It's a must see, must use page.</p>
			</td>
		</tr>
		<tr class="alternate">
			<td>
				<h1>Firewall Page</h1>
				<p>This page gives you important insights into your wordpress website visits. You can visualize in detail the firewall blocks saving you precious hosting bandwidth for real users and blocking all misfitting attempts.</p>
			</td>
		</tr>
		<tr class="alternate">
			<td>
				<h1>Registrations Page</h1>
				<p>This page gives you important insights into your website registration process. You can visualize in detail the blocked registrations and all other registrations that cleared the spam check and are active or not.</p>
			</td>
		</tr>
		<tr class="alternate">
			<td>
				<h1>Comments Page</h1>
				<p>If Wordpress native comments system is running, you can check in detail the blocked comments and all other comments that cleared the spam check.</p>
			</td>
		</tr>
		<tr class="alternate">
			<td>
				<h1>Statistics Page</h1>
				<p>Provides you a huge amount of statistical data to analyze.</p>
			</td>
		</tr>
	</tbody>
</table>
<?php
		}
}
