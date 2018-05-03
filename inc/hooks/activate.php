<?php
// activation hook
add_action( 'init', 'pngpdlwv_activate_create_table' );
add_action( 'init', 'pngpdlwv_activate_populate_table' );

function pngpdlwv_activate_create_table() {
	global $wpdb;
	global $pngpdlwv_db_version;
	// $external_db = new wpdb(DB_USER,DB_PASSWORD,DB_NAME,DB_HOST); // use this to connect to an external database

	$table_name = $wpdb->prefix . 'pngpdlwv';	
	$charset_collate = $wpdb->get_charset_collate();

	// checks and creates a table if it doesn't already exist
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) { 
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			ProvNAME tinytext NOT NULL,
			DistNAME tinytext NOT NULL,
			LlgNAME tinytext NOT NULL,
			WardNAME tinytext NOT NULL,
			VillageNAME tinytext NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		add_option( 'pngpdlwv_db_version', $pngpdlwv_db_version );
	}
}
function pngpdlwv_activate_populate_table () {
	// insert code
}
function pngpdlwv_activate(){
	pngpdlwv_activate_create_table();
	// pngpdlwv_install_uploaddbdata();
}

?>