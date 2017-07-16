<?php

/**
 * @package png_pdlw
 * @version 1.1
 */
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
$pngpdlw_db_version = '1.1';

require_once( '/pngpdlw_functions.php' );
require_once( dirname(__FILE__) . '/admin/admin-init.php' );

// wp_register_script( 'cooltool_ajax', plugins_url( '/js/cooltool_ajax.js');
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
	$table_name = $wpdb->prefix . 'pngpdlw';
	echo $table_name;
	// read external csv file
	$plugin_path = plugin_dir_path( __FILE__ );
	// extract data & insert data within a loop
	// $sampledata = array(
	// 	'ProvNAME' => 'Morobe Province', 
	// 	'DistNAME' => 'Lae District', 
	// 	'LlgNAME' => 'Lae Urban LLG', 
	// 	'WardNAME' => 'Lae City', 
	// 	'VillageNAME' => 'Koboni Street', 
	// 	);
	// if (($handle = fopen( $plugin_path . 'data.csv','r' )) !== FALSE) {
	// 	while (($data = fgetcsv($handle,5)) !== FALSE) {
	// 		echo "data " . $data[0] . "<br />";
	// 		// $wpdb->insert($table_name,array( $key => $value, ));
	// 	}
	// 	fclose($handle);
	//  // // deprecated
	// 	// // variables to insert
	// 	// $province = 'Morobe Province';
	// 	// $district = 'Lae District';
	// 	// $llg = 'Lae Urban LLG';
	// 	// $ward = 'Lae City';
	// 	// $village = 'Kapiak Street';
		
	// 	// // insert data to db
	// 	// $wpdb->insert( 
	// 	// 	$table_name, 
	// 	// 	array( 
	// 	// 		'ProvNAME' => $province, 
	// 	// 		'DistNAME' => $district, 
	// 	// 		'LlgNAME' => $llg, 
	// 	// 		'WardNAME' => $ward, 
	// 	// 		'VillageNAME' => $village, 
	// 	// 	) 
	// 	// );
	// 	} else {
	// 		echo "handle error!" . $handle;
	// 	}
}

function pngpdlw_update_db_check() {
  global $pngpdlw_db_version;
  if ( get_site_option( 'pngpdlw_db_version' ) != $pngpdlw_db_version ) {
      pngpdlw_install();
  }
}
add_action( 'plugins_loaded', 'pngpdlw_update_db_check' );

register_activation_hook( __FILE__, 'pngpdlw_install' );
register_activation_hook( __FILE__, 'pngpdlw_install_data' );

function function_pngpdlw_form(){
	global $sudotech_pngpdwlv;
	if ($sudotech_pngpdwlv['radio_formlabels'] === '2') {
		$labelClass = ' hidden ';
	}
  $html = '
  <div id="pngpdlw_form">
  	<div id="form-header">'.$sudotech_pngpdwlv['form_header'].'</div>
    <form id="lookuptool" class="form form-horizontal" action="">
      <p id="provinces" class="form-group">
        <label class="'.$labelClass.'col-sm-3 control-label">Province</label>
        <select id="province" class="col-sm-9 form-control">
        	<option value="empty">Select Province</option>
        </select>
      </p>
      <p id="districts" class="hidden form-group">
        <label class="'.$labelClass.'col-sm-3 control-label">District</label>
        <select id="district" class="col-sm-3 form-control">
        	<option value="empty">Select District</option>
        </select>
      </p>
      <p id="llgs" class="hidden form-group">
        <label class="'.$labelClass.'col-sm-3 control-label">LLG</label>
        <select id="llg" class="col-sm-3 form-control">
        	<option value="empty">Select Local Level Govt</option>
        </select>
      </p>
      <p id="wards" class="hidden form-group">
        <label class="'.$labelClass.'col-sm-3 control-label">Ward</label>
        <select id="ward" class="col-sm-3 form-control">
        	<option value="empty">Select Ward</option>
        </select>
      </p>
      <p id="villages" class="hidden form-group">
        <label class="'.$labelClass.'col-sm-3 control-label">Village</label>
        <select id="village" class="col-sm-3 form-control">
        	<option value="empty">Select Village</option>
        </select>
      </p>
    </form>
  </div>
  <div id="message" class="block blockquote"></div>
	<div id="form-header">'.$sudotech_pngpdwlv['form_footer'].'</div>
	<div class="social social-icons">'.$sudotech_pngpdwlv['share_icons'].'</div>
  ';
  return $html;
}
add_shortcode( 'pngpdlw_form', 'function_pngpdlw_form' );

?>