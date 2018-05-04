<?php
	function pngpdlwv_uninstall () {
		if (!defined('WP_UNINSTALL_PLUGIN')) {
			die;
		}

		// upon uninstall, plugin should automatically delete database and remove all options stored in wp_options
		delete_option( 'pngpdlwv_db_version' );
		remove_shortcode( 'pngpdlwv_form' );

		global $wpdb;
		$table_name = $wpdb->prefix . 'pngpdlwv_0';
		if($wpdb->get_var("SHOW TABLES LIKE $table_name") == $table_name) { 
			$sql = "DROP TABLE IF EXISTS $table_name";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
		// dbDelta( $sql, $execute = true );
		echo 'plugin uninstallation was a success!';
	}
	register_uninstall_hook( __FILE__ , 'pngpdlwv_uninstall' );
?>