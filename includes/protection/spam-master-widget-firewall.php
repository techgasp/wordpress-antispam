<?php
//Hook Widget
add_action( 'widgets_init', 'spam_master_widget_firewall' );
//Register Widget
function spam_master_widget_firewall() {
register_widget( 'spam_master_widget_firewall' );
}

class spam_master_widget_firewall extends WP_Widget {
	function __construct(){
	$widget_ops = array( 'classname' => 'Spam Master Firewall Status', 'description' => __('Spam Master Firewall Widget warns all users that your website is firewall protected against misfitting and optionally displays last 7 days firewall blocks.', 'spam_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'spam_master_widget_firewall' );
	parent::__construct( 'spam_master_widget_firewall', __('Spam Master Firewall Status', 'spam_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
	global $wpdb, $blog_id;
		extract( $args );
		//Our variables from the widget settings.
		$spam_title = isset( $instance['spam_title'] ) ? $instance['spam_title'] :false;
		$spam_title_new = isset( $instance['spam_title_new'] ) ? $instance['spam_title_new'] :false;
		$show_spam_widget_header = isset( $instance['show_spam_widget_header'] ) ? $instance['show_spam_widget_header'] :false;
		$spam_widget_header = isset( $instance['spam_widget_header'] ) ? $instance['spam_widget_header'] :false;
		$show_spam_firewall_total_count = isset( $instance['show_spam_firewall_total_count'] ) ? $instance['show_spam_firewall_total_count'] :false;
		$show_spam_firewall_total = isset( $instance['show_spam_firewall_total'] ) ? $instance['show_spam_firewall_total'] :false;
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
			$spam_widget_header_create = '<th bgcolor="#07B357" style="text-align: center;" colspan="2"><h2><font color="white">Firewall Active</font></h2></th>';
		}
		else{
			$spam_widget_header_create = '<th><h2>'.$spam_widget_header.'</h2></th>';
		}
	}
	else{
		$spam_widget_header_create = false;
	}
	//Display Firewall Total
	if($show_spam_firewall_total_count){
		if(is_multisite()){
			$spam_firewall_total_count = get_blog_option(1, 'spam_master_block_count');
		}
		else{
			$spam_firewall_total_count = get_option('spam_master_block_count');
		}
		$spam_firewall_total_create = '<tr bgcolor="#FF8200"><td colspan="2"><font color="white">Total Blocks: <b>'.number_format($spam_firewall_total_count).'</b></font></td></tr>';
	}
	else{
		$spam_firewall_total_create = false;
	}
	//Display Firewall List
	if (is_multisite()){
		$blog_prefix = $wpdb->get_blog_prefix();
		$table_prefix = $wpdb->base_prefix;
		$spam_firewall_total_list = $wpdb->get_results("SELECT meta_value FROM {$table_prefix}sitemeta WHERE meta_key LIKE '_site_transient_spam_master_firewall_ip%' ORDER BY meta_value DESC LIMIT 7");
	}
	else{
		$table_prefix = $wpdb->base_prefix;
			$spam_firewall_total_list = $wpdb->get_results("SELECT option_value FROM {$table_prefix}options WHERE option_name LIKE '_transient_spam_master_firewall_ip%' ORDER BY option_value DESC LIMIT 7");
	}
	//Display Spam Link
	if ( $show_spam_link ){
		$spam_link = '<tr bgcolor="#eae7de"><th colspan="2"><a href="https://spammaster.techgasp.com/" target="_blank" title="Protected by Spam Master"><small><em>Protected by Spam Master</em></small></a></th></tr>';
	}
	else{
		$spam_link = false;
	}
		echo '<table style="width: 100%;">' .
				'<thead>' .
					$spam_widget_header_create.
				'</thead>' .
				'<tfoot>' .
					$spam_link.
				'</tfoot>' .
				'<tbody>' .
					$spam_firewall_total_create;
						if($show_spam_firewall_total){
							if(!empty($spam_firewall_total_list)){
								foreach ($spam_firewall_total_list as $spam_firewall_list){
									if (is_multisite()){
										$option_query = 'meta_value';
									}
									else{
										$option_query = 'option_value';
									}
									$key_unserialized = unserialize($spam_firewall_list->$option_query);
									echo '<tr bgcolor="#FFAD58"><td><font color="white">'.$key_unserialized['date'].'</font></td><td><font color="white"><a href="https://spammaster.techgasp.com/search-threat/?search_spam_threat='.$key_unserialized['threat_ip'].'" target="_blank"><img src="'.plugins_url('../images/check-threat.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" >&nbsp;&nbsp;'.stripslashes($key_unserialized['threat_ip']).'</a></font></td></tr>';
								}
							}
							else{
							}
						}
				echo '</tbody>' .
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
		$instance['show_spam_firewall_total_count'] = strip_tags( $new_instance['show_spam_firewall_total_count'] );
		$instance['show_spam_firewall_total'] = $new_instance['show_spam_firewall_total'];
		$instance['show_spam_link'] = $new_instance['show_spam_link'];
		return $instance;
	}
	function form( $instance ) {
	$plugin_master_name = constant('SPAM_MASTER_NAME');
	//Set up some default widget settings.
	$defaults = array( 'spotify_title_new' => __('Spam Master', 'spam_master'), 'spam_title' => true, 'spam_title_new' => false, 'show_spam_widget_header' => true, 'spam_widget_header' => false, 'show_spam_firewall_total_count' => true, 'show_spam_firewall_total' => true, 'show_spam_link' => true );
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
	<label for="<?php echo $this->get_field_id( 'show_spam_widget_header' ); ?>"><b><?php _e('Display Widget Header', 'spam_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'spam_widget_header' ); ?>"><?php _e('Change Header:', 'spam_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'spam_widget_header' ); ?>" name="<?php echo $this->get_field_name( 'spam_widget_header' ); ?>" value="<?php echo $instance['spam_widget_header']; ?>" style="width:auto;" />
	<div class="description">Optional, default header is <b>Firewall Active</b>.</div>
	</p>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_spam_firewall_total_count'], true ); ?> id="<?php echo $this->get_field_id( 'show_spam_firewall_total_count' ); ?>" name="<?php echo $this->get_field_name( 'show_spam_firewall_total_count' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_spam_firewall_total_count' ); ?>"><b><?php _e('Display Total Blocks', 'spam_master'); ?></b></label><br>
	</p>
	<p>
	<img src="<?php echo plugins_url('../images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_spam_firewall_total'], true ); ?> id="<?php echo $this->get_field_id( 'show_spam_firewall_total' ); ?>" name="<?php echo $this->get_field_name( 'show_spam_firewall_total' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_spam_firewall_total' ); ?>"><b><?php _e('Display Last 7 Blocks', 'spam_master'); ?></b></label><br>
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
