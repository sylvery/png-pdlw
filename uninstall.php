<?php
	function pngpdlwv_uninstall () {
		if (!defined(WP_UNINSTALL_PLUGIN)) {
			die;
		}

		// upon uninstall, plugin should automatically delete database and remove all options stored in wp_options
		delete_option( 'pngpdlwv_db_version' );
		remove_shortcode( 'pngpdlwv_form' )

		global $wpdb;
		$table_name = $wpdb->prefix . 'pngpdlwv';	
		$wpdb->query("DROP TABLE IF EXISTS $table_name");
		// dbDelta( $sql, $execute = true );
		echo 'plugin uninstallation was a success!';
	}
?>