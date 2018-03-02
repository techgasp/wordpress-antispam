<?php
global $wpdb, $blog_id;
if( is_multisite() ){
delete_blog_option($blog_id, 'blacklist_keys');
}
else{
delete_option('blacklist_keys');
}
?>
