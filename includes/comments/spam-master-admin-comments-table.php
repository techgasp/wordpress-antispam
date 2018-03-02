<?php
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class spam_master_comments_table extends WP_List_Table {
	/**
	 * Constructor, we override the parent to pass our own arguments
	 * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
	 */
	 function __construct() {
		 parent::__construct( array(
		'singular'=> 'wp_list_text_link', //Singular label
		'plural' => 'wp_list_text_links', //plural label, also this well be one of the table css class
		'ajax'	=> false //We won't support Ajax for this table
		) );
	 }
	/**
	 * Add extra markup in the toolbars before or after the list
	 * @param string $which, helps you decide if you add the markup after (bottom) or before (top) the list
	 */
//	function extra_tablenav( $which ) {
//		if ( $which == "top" ){
			//The code that goes before the table is here
//			echo '<h3>Many registration attempts are blocked in Spam Master Firewall, look for firewall blocks in wp-login.php.</h3>';
//		}
//		if ( $which == "bottom" ){
			//The code that goes after the table is there
//			echo '<br><br><p><b>User Status:</b> 0= User Registered & Account Active. 1= User Registered, Account Active & Account Disabled by Administrator, Marked as Spam. 2= User Registered & Account Not Active</p><br>';
//		}
//	}

	/**
	 * Define the columns that are going to be used in the table
	 * @return array $columns, the array of columns to use with the table
	 */
	function get_columns() {
		return $columns= array(
			'col_blocks_date'		=>__('Date'),
			'col_blocks_author'		=>__('Author'),
			'col_blocks_email'		=>__('Email'),
			'col_blocks_ip'			=>__('Ip'),
			'col_blocks_comment'	=>__('Comment'),
			'col_blocks_status'		=>__('Status'),
		);
	}

	/**
	 * Decide which columns to activate the sorting functionality on
	 * @return array $sortable, the array of columns that can be sorted by the user
	 */
		function get_sortable_columns() {
		return $sortable = array(
			'col_blocks_date'		=>	array('comment_date',false),
			'col_blocks_author'		=>	array('comment_author',false),
			'col_blocks_email'		=>	array('comment_author_email',false),
			'col_blocks_ip'			=>	array('comment_author_ip',false),
			'col_blocks_comment'	=>	array('comment_content',false),
			'col_blocks_status'		=>	array('comment_approved',false),
		);
	}

	/**
	 * Prepare the table with different parameters, pagination, columns and table elements
	 */
	function prepare_items() {
		global $wpdb, $blog_id, $_wp_column_headers;
		$screen = get_current_screen();

		/* -- Preparing your query -- */
		if (is_multisite()){
			$blog_prefix = $wpdb->get_blog_prefix();
			$query = "SELECT * FROM {$blog_prefix}comments WHERE comment_approved='0' OR comment_approved='1' OR comment_approved='spam' OR comment_approved='trash'";
		}
		else{
			$query = "SELECT * FROM $wpdb->comments WHERE comment_approved='0' OR comment_approved='1' OR comment_approved='spam' OR comment_approved='trash'";
		}
		/* -- Ordering parameters -- */
	    //Parameters that are going to be used to order the result
	    $orderby = !empty($_GET["orderby"]) ? esc_sql($_GET["orderby"]) : 'comment_ID';
	    $order = !empty($_GET["order"]) ? esc_sql($_GET["order"]) : 'DESC';
	    if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }

		/* -- Pagination parameters -- */
        //Number of elements in your table?
        $totalitems = $wpdb->query($query); //return the total number of affected rows
        //How many to display per page?
        $perpage = 10;
        //Which page is this?
        $paged = !empty($_GET["paged"]) ? esc_sql($_GET["paged"]) : '';
        //Page Number
        if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
        //How many pages do we have in total?
        $totalpages = ceil($totalitems/$perpage);
        //adjust the query to take pagination into account
		if(!empty($paged) && !empty($perpage)){
			$offset=($paged-1)*$perpage;
	    	$query.=' LIMIT '.(int)$offset.','.(int)$perpage;
		}

		/* -- Register the pagination -- */
		$this->set_pagination_args( array(
			"total_items" => $totalitems,
			"total_pages" => $totalpages,
			"per_page" => $perpage,
		) );
		//The pagination links are automatically built according to those parameters
		
		/* Register the Columns */
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);

		/* -- Fetch the items -- */
		$this->items = $wpdb->get_results($query);
	}

	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display_rows() {
		global $wpdb;
		//Get the records registered in the prepare_items method
		$records = $this->items;

		//Get the columns registered in the get_columns and get_sortable_columns methods
		list( $columns, $hidden ) = $this->get_column_info();

		//Loop for each record
		if(!empty($records)){foreach($records as $rec){

			//Open the line
			static $row_class = '';
			$row_class = ( $row_class == '' ? ' class="alternate"' : '' );
			echo '<tr '.$row_class.' id="record_'.$rec->comment_approved.'">';
			foreach ( $columns as $column_name => $column_display_name ) {

				//Style attributes for each col
				$class = "class='$column_name column-$column_name'";
				$style = '';
				if ( in_array( $column_name, $hidden ) )
				$style = ' style="display:none;"';
				$attributes = '$class$style';
				$length = 400;

				//Display the cell
				switch ( $column_name ) {
					case "col_blocks_date":	echo '<td '.$attributes.'>'.stripslashes($rec->comment_date).'</td>';break;
					case "col_blocks_author":	if ( strlen($rec->comment_author) > $length ) {
													$rec->comment_author = substr($rec->comment_author,0,$length);
													$rec->comment_author = $rec->comment_author .' ...';
												}
												echo '<td '.$attributes.'>'.stripslashes($rec->comment_author).'</td>';break;
					case "col_blocks_email":	if ( strlen($rec->comment_author_email) > $length ) {
													$rec->comment_author_email = substr($rec->comment_author_email,0,$length);
													$rec->comment_author_email = $rec->comment_author_email .' ...';
												}
												echo '<td '.$attributes.'>'.stripslashes($rec->comment_author_email).'</td>';break;
					case "col_blocks_ip":	if ( strlen($rec->comment_author_IP) > $length ) {
													$rec->comment_author_IP = substr($rec->comment_author_IP,0,$length);
													$rec->comment_author_IP = $rec->comment_author_IP .' ...';
												}
												echo '<td '.$attributes.'>'.stripslashes($rec->comment_author_IP).'</td>';break;
					case "col_blocks_comment":	if ( strlen($rec->comment_content) > $length ) {
													$rec->comment_content = substr($rec->comment_content,0,$length);
													$rec->comment_content = $rec->comment_content .' ...';
												}
												echo '<td '.$attributes.'>'.stripslashes(wp_strip_all_tags($rec->comment_content)).'</td>';break;
					case "col_blocks_status":	if ($rec->comment_approved == '0'){
												$rec->comment_approved = 'Pending';
												echo '<td '.$attributes.' bgcolor="#f9e4cc"><a href="https://spammaster.techgasp.com/search-threat/?search_spam_threat='.$rec->comment_author_IP.'" target="_blank"><img src="'.plugins_url('../images/check-threat.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" >&nbsp;&nbsp;'.stripslashes($rec->comment_approved).'</a></td>';break;
												}
												if ($rec->comment_approved == '1'){
												$rec->comment_approved = 'Approved';
												echo '<td '.$attributes.' bgcolor="#ccf1f9">'.stripslashes($rec->comment_approved).'</td>';break;
												}
												if ($rec->comment_approved == 'spam'){
												$rec->comment_approved = 'Success Blocked Spam - Trashed';
												echo '<td '.$attributes.' bgcolor="#ebece9"><a href="https://spammaster.techgasp.com/search-threat/?search_spam_threat='.$rec->comment_author_IP.'" target="_blank"><img src="'.plugins_url('../images/check-threat.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" >&nbsp;&nbsp;'.stripslashes($rec->comment_approved).'</a></td>';break;
												}
												if ($rec->comment_approved == 'trash'){
												$rec->comment_approved = 'Success Blocked Spam - Trashed';
												echo '<td '.$attributes.' bgcolor="#ebece9"><a href="https://spammaster.techgasp.com/search-threat/?search_spam_threat='.$rec->comment_author_IP.'" target="_blank"><img src="'.plugins_url('../images/check-threat.png', dirname(__FILE__)).'" style="height:24px; vertical-align:middle;" >&nbsp;&nbsp;'.stripslashes($rec->comment_approved).'</a></td>';break;
												}
				}
			}

			//Close the line
			echo'</tr>';
		}}
	}
}
