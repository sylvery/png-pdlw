<?php

/*
Plugin Name: PNG PDLW
Plugin URI:  https://developer.wordpress.org/plugins/png-pdlw/
Description: Papua New Guinea Provinces Districts LLGs & Wards
Version:     0.0.1
Author:      Sudo Tech
Author URI:  fb.me/sudotech.biz
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: geography
Domain Path: /geography
*/

global $pngpdlw_db_version;
$pngpdlw_db_version = '1.0';

function pngpdlw_install() {
	global $wpdb;
	global $pngpdlw_db_version;

	$table_name = $wpdb->prefix . 'pngpdlw';
	
	$charset_collate = $wpdb->get_charset_collate();

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

	add_option( 'pngpdlw_db_version', $pngpdlw_db_version );
}

function pngpdlw_install_data() {
	global $wpdb;
	
	$province = 'Morobe Province';
	$district = 'Lae District';
	$llg = 'Lae Urban LLG';
	$ward = 'Lae City';
	$village = 'Data Street';
	
	$table_name = $wpdb->prefix . 'pngpdlw';
	
	$wpdb->insert( 
		$table_name, 
		array( 
			'ProvNAME' => $province, 
			'DistNAME' => $district, 
			'LlgNAME' => $llg, 
			'WardNAME' => $ward, 
			'VillageNAME' => $village, 
		) 
	);
}

register_activation_hook( __FILE__, 'pngpdlw_install' );
register_activation_hook( __FILE__, 'pngpdlw_install_data' );

?>