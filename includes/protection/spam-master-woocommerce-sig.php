<?php
if(is_multisite()){
$response_key = get_blog_option($blog_id, 'spam_master_status');
}
else{
$response_key = get_option('spam_master_status');
}
if($response_key == 'VALID' || $response_key == 'MALFUNCTION_1' || $response_key == 'MALFUNCTION_2'){
	add_filter('woocommerce_register_form_end', 'spam_master_woo_extra_register_field');
	function spam_master_woo_extra_register_field(){
	?>
		<div class="clear"></div>
		<p class="form-row form-row-wide">
		<label for="spam_master">Website Protected by <a href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Spam Master"><em>Spam Master</em></a></label>
		</p>
	  <?php
	}

	add_filter('woocommerce_login_form_end', 'spam_master_woo_extra_login_field');
	function spam_master_woo_extra_login_field(){
	?>
		<div class="clear"></div>
		<p class="form-row form-row-wide">
		<label for="spam_master">Website Protected by <a href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Spam Master"><em>Spam Master</em></a></label>
		</p>
	  <?php
	}
	
	add_filter('woocommerce_checkout_form_end', 'spam_master_woo_extra_checkout_field');
	function spam_master_woo_extra_checkout_field(){
	?>
		<div class="clear"></div>
		<p class="form-row form-row-wide">
		<label for="spam_master">Website Protected by <a href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Spam Master"><em>Spam Master</em></a></label>
		</p>
	  <?php
	}

	add_action('woocommerce_email_footer', 'spam_master_woo_extra_email_field');
	function spam_master_woo_extra_email_field($email) {
		?>
		<p></p>
		<p><?php printf( __( 'Website Protected by <b>Spam Master</b>', 'spam_master')); ?></p>
		<?php
	}
}
?>
