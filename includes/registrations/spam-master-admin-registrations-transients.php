<?php
add_action( 'init', 'spam_master_purge_registration_transients' );
        /**
        * clear expired transients -- called on a page load
        */
        function spam_master_purge_registration_transients() {
                global $wpdb;

                // get current PHP time, offset by a minute to avoid clashes with other tasks
                $threshold = time() - 60;

                // delete expired transients, using the paired timeout record to find them
				if(is_multisite()){
				$sql = "
                        delete from t1, t2
                        using {$wpdb->sitemeta} t1
                        join {$wpdb->sitemeta} t2 on t2.meta_key = replace(t1.meta_key, '_timeout', '')
                        where (t1.meta_key like '\_transient\_timeout\_spam_master_invalid_email%' or t1.meta_key like '\_site\_transient\_timeout\_spam_master_invalid_email%')
                        and t1.meta_value < '$threshold';
                ";
				}
				else{
                $sql = "
                        delete from t1, t2
                        using {$wpdb->options} t1
                        join {$wpdb->options} t2 on t2.option_name = replace(t1.option_name, '_timeout', '')
                        where (t1.option_name like '\_transient\_timeout\_spam_master_invalid_email%' or t1.option_name like '\_site\_transient\_timeout\_spam_master_invalid_email%')
                        and t1.option_value < '$threshold';
                ";
				}
                $wpdb->query($sql);

                // delete orphaned transient expirations,
				if(is_multisite()){
				$sql = "
                        delete from {$wpdb->sitemeta}
                        where (
                                meta_key like '\_transient\_timeout\_spam_master_invalid_email%'
                                or meta_key like '\_site\_transient\_timeout\_spam_master_invalid_email%'
                        )
                        and meta_value < '$threshold';
                ";
				}
				else{
                $sql = "
                        delete from {$wpdb->options}
                        where (
                                option_name like '\_transient\_timeout\_spam_master_invalid_email%'
                                or option_name like '\_site\_transient\_timeout\_spam_master_invalid_email%'
                        )
                        and option_value < '$threshold';
                ";
				}
                $wpdb->query($sql);
        }
?>
