<?php
//Hook Widget
add_action( 'widgets_init', 'spam_master_widget_heads_up' );
//Register Widget
function spam_master_widget_heads_up() {
register_widget( 'spam_master_widget_heads_up' );
}

class spam_master_widget_heads_up extends WP_Widget {
	function __construct(){
	$widget_ops = array( 'classname' => 'Spam Master Heads Up', 'description' => __('Spam Master Heads Up Widget warns all users that your website is protected against misfitting hence deterring them. It optionally displays SSL Encryption Seal.', 'spam_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'spam_master_widget_heads_up' );
	parent::__construct( 'spam_master_widget_heads_up', __('Spam Master Heads Up', 'spam_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
	global $wpdb, $blog_id;
		extract( $args );
		//Our variables from the widget settings.
		$spam_title = isset( $instance['spam_title'] ) ? $instance['spam_title'] :false;
		$spam_title_new = isset( $instance['spam_title_new'] ) ? $instance['spam_title_new'] :false;
		$show_spam_widget_header = isset( $instance['show_spam_widget_header'] ) ? $instance['show_spam_widget_header'] :false;
		$spam_widget_header = isset( $instance['spam_widget_header'] ) ? $instance['spam_widget_header'] :false;
		$show_spam_total_count = isset( $instance['show_spam_total_count'] ) ? $instance['show_spam_total_count'] :false;
		$show_spam_ssl = isset( $instance['show_spam_ssl'] ) ? $instance['show_spam_ssl'] :false;
		$show_spam_link = isset( $instance['show_spam_link'] ) ? $instance['show_spam_link'] :false;
		echo $before_widget;
	// Display the widget title
		if ( $spam_title ){
		if (empty ($spam_title_new)){
			$spam_title_new = constant('SPAM_MASTER_NAME');
			echo $before_title . $spam_title_new . $after_title;
		}
		else{
			echo $before_title . $spam_title_new . $after_title;
		}
	}
	else{
	}
	//Display Widget Header
	if ( $show_spam_widget_header ){
		if (empty($spam_widget_header)){
			$spam_widget_header_create = '<th><h2><img src="'.plugins_url('../images/check-safe.png', dirname(__FILE__)).'" style="vertical-align:middle; padding-right:5px;" />Safe Website</h2></th>';
		}
		else{
			$spam_widget_header_create = '<th><h2><img src="'.plugins_url('../images/check-safe.png', dirname(__FILE__)).'" style="vertical-align:middle; padding-right:5px;" />'.$spam_widget_header.'</h2></th>';
		}
	}
	else{
		$spam_widget_header_create = false;
	}
	//Display Protection Total Count
	if ( $show_spam_total_count ){
		if(is_multisite()){
			$spam_master_shortcodes_total_count = get_blog_option($blog_id, 'spam_master_shortcodes_total_count');
		}
		else{
			$spam_master_shortcodes_total_count = get_option('spam_master_shortcodes_total_count');
		}
		if ($spam_master_shortcodes_total_count == 'true'){
			$spam_widget_total_create = '<tr><td><img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="float:left; width:20px; vertical-align:middle;" />&nbsp;Protected: '.do_shortcode('[spam_master_stats_total_count]').' Million Threats</td></tr>';
		}
		else{
			$spam_widget_total_create = '<tr><td><img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="float:left; width:20px; vertical-align:middle;" />&nbsp;Please activate Threat Protection Total Count shortcode in Protection Tools page, Widgets & Shortcodes section.</td></tr>';
		}
	}
	else{
		$spam_widget_total_create = false;
	}
	//Display Spam SSL
	if ( $show_spam_ssl ){
		$spam_is_ssl = is_ssl();
		if ($spam_is_ssl){
			$spam_ssl_image = '<img src="'.plugins_url('../images/check-lock.png', dirname(__FILE__)).'" style="float:left; width:20px; vertical-align:middle;" />';
			$spam_ssl_text = '&nbsp;Secure Encrypted Website';
			$spam_ssl = '<tr><td>'.$spam_ssl_text.$spam_ssl_image.'</td></tr>';
		}
		else{
			$spam_ssl_image = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="float:left; width:20px; vertical-align:middle;" />';
			$spam_ssl_text = '&nbsp; SSL No Encryption';
			$spam_ssl = '<tr><td>'.$spam_ssl_text.$spam_ssl_image.'</td></tr>';
		}
	}
	else{
		$spam_ssl = false;
	}
	//Display Spam Link
	if ( $show_spam_link ){
		$spam_link = '<tr><th><a href="https://spammaster.techgasp.com/" target="_blank" title="Protected by Spam Master"><small><em>Protected by Spam Master</em></small></a></th></tr>';
	}
	else{
		$spam_link = false;
	}
	//Prepare Display
	if(is_multisite()){
		$spam_firewall_on = get_blog_option($blog_id, 'spam_master_firewall_on');
	}
	else{
		$spam_firewall_on = get_option('spam_master_firewall_on');
	}
	if($spam_firewall_on == 'true'){
		$spam_firewall_image = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="float:left; width:20px; vertical-align:middle;" />';
		$spam_firewall_text = '&nbsp;Active Firewall';
		$spam_firewall = $spam_firewall_text.$spam_firewall_image;
	}
	else{
		$spam_firewall_image = '<img src="'.plugins_url('../images/check-inactive.png', dirname(__FILE__)).'" style="float:left; width:20px; vertical-align:middle;" />';
		$spam_firewall_text = '&nbsp;Firewall';
		$spam_firewall = $spam_firewall_text.$spam_firewall_image;
	}
	$protection_engine_version = constant('SPAM_MASTER_VERSION');
	$protection_engine_image = '<img src="'.plugins_url('../images/check-pass.png', dirname(__FILE__)).'" style="float:left; width:20px; vertical-align:middle;" />';
	
		echo '<table style="width:100%">' .
				'<thead>' .
					'<tr>' .
						$spam_widget_header_create.
					'</tr>' .
				'</thead>' .
				'<tfoot>' .
					$spam_link.
				'</tfoot>' .
				'<tbody>' .
					'<tr>' .
						'<td>&nbsp;Protection Engine: '.$protection_engine_image.'&nbsp;'.$protection_engine_version.'</td>' .
					'</tr>' .
					$spam_widget_total_create .
					'<tr>' .
						'<td>&nbsp;Active Scan'.$protection_engine_image.'</td>' .
					'</tr>' .
					'<tr>' .
						'<td>'.$spam_firewall.'</td>' .
					'</tr>' .
					$spam_ssl.
				'</tbody>' .
			'</table>';

	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['spam_title'] = strip_tags( $new_instance['spam_title'] );
		$instance['spam_title_new'] = $new_instance['spam_title_new'];
		$instance['show_spam_widget_header'] = $new_instance['show_spam_widget_header'];
		$instance['spam_widget_header'] = strip_tags( $new_instance['spam_widget_header'] );
		$instance['show_spam_total_count'] = $new_instance['show_spam_total_count'];
		$instance['show_spam_ssl'] = $new_instance['show_spam_ssl'];
		$instance['show_spam_link'] = $new_instance['show_spam_link'];
		return $instance;
	}
	function form( $instance ) {
	$plugin_master_name = constant('SPAM_MASTER_NAME');
	//Set up some default widget settings.
	$defaults = array( 'spotify_title_new' => __('Spam Master', 'spam_master'), 'spam_title' => true, 'spam_title_new' => false, 'show_spam_widget_header' => true, 'spam_widget_header' => false, 'show_spam_total_count' => false, 'show_spam_ssl' => false, 'show_spam_link' => true );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<p><b>Check the buttons to be displayed:</b></p>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['spam_title'], true ); ?> id="<?php echo $this->get_field_id( 'spam_title' ); ?>" name="<?php echo $this->get_field_name( 'spam_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'spam_title' ); ?>"><b><?php _e('Display Widget Title', 'spam_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'spam_title_new' ); ?>"><?php _e('Change Title:', 'spam_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'spam_title_new' ); ?>" name="<?php echo $this->get_field_name( 'spam_title_new' ); ?>" value="<?php echo $instance['spam_title_new']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_spam_widget_header'], true ); ?> id="<?php echo $this->get_field_id( 'show_spam_widget_header' ); ?>" name="<?php echo $this->get_field_name( 'show_spam_widget_header' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_spam_widget_header' ); ?>"><b><?php _e('Display Widget Header with Safe Seal Icon', 'spam_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'spam_widget_header' ); ?>"><?php _e('Change Header:', 'spam_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'spam_widget_header' ); ?>" name="<?php echo $this->get_field_name( 'spam_widget_header' ); ?>" value="<?php echo $instance['spam_widget_header']; ?>" style="width:auto;" />
	<div class="description">Optional, default header is <b>Safe Website</b>.</div>
	</p>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_spam_total_count'], true ); ?> id="<?php echo $this->get_field_id( 'show_spam_total_count' ); ?>" name="<?php echo $this->get_field_name( 'show_spam_total_count' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_spam_total_count' ); ?>"><b><?php _e('Display Total Threats Count', 'spam_master'); ?></b></label><br>
	<div class="description">Optional, if set to display, remember to activate the Threat Protection Total Count shortcode in Protection Tools page, Widgets & Shortcodes section.</div>
	</p>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_spam_ssl'], true ); ?> id="<?php echo $this->get_field_id( 'show_spam_ssl' ); ?>" name="<?php echo $this->get_field_name( 'show_spam_ssl' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_spam_ssl' ); ?>"><b><?php _e('Display SSL/HTTPS Seal', 'spam_master'); ?></b></label><br>
	<div class="description">Optional, if your website contains a valid SSL / HTTPS certificate, let's your users know that the website is secure and encrypted.</div>
	</p>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_spam_link'], true ); ?> id="<?php echo $this->get_field_id( 'show_spam_link' ); ?>" name="<?php echo $this->get_field_name( 'show_spam_link' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_spam_link' ); ?>"><b><?php _e('Display Spam Master Signature', 'spam_master'); ?></b></label><br>
	<div class="description">Optional, displays Spam Master Warning Signature to users.</div>
	</p>
<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<b><?php echo $plugin_master_name; ?> Website</b>
	</p>
	<p><a class="button-secondary" href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="<?php echo $plugin_master_name; ?> Info Page">Info Page</a> <a class="button-secondary" href="https://wordpress.techgasp.com/spam-master-documentation/" target="_blank" title="<?php echo $plugin_master_name; ?> Documentation">Documentation</a> <a class="button-primary" href="https://wordpress.org/plugins/spam-master/" target="_blank" title="<?php echo $plugin_master_name; ?> Wordpress">RATE US *****</a></p>
	<?php
	}
 }
?>
