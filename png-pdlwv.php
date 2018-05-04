<?php

/**
 * @package png_pdlwv
 * @version 1.2.2
 */
/*
Plugin Name: PNG PDLWV
Plugin URI:  https://developer.wordpress.org/plugins/png-pdlw/
Description: Papua New Guinea Provinces Districts LLGs & Wards
Version:     1.2.2
Author:      Sudo Tech
Author URI:  http://sudotech.biz
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: geography
Domain Path: /geography

PNG PDLWV is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
PNG PDLWV is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with PNG PDLWV. If not, see {URI to Plugin License}.
*/

global $pngpdlwv_db_version;
$pngpdlwv_db_version = '1.2.2';

// load required files

if (file_exists(dirname(__FILE__).'/pngpdlwv_functions.php')) {
  require_once( dirname(__FILE__) . '/pngpdlwv_functions.php' );
}
if (file_exists( dirname(__FILE__) . '/admin/admin-init.php' )){
    require_once( dirname(__FILE__) . '/admin/admin-init.php' );
}
if (file_exists( dirname(__FILE__) . '/inc/shortcodes.php' )){
    require_once( dirname(__FILE__) . '/inc/shortcodes.php' );
}

// hooks
register_activation_hook( dirname(__FILE__) . '/inc/hooks/activate.php' , 'pngpdlwv_activate' );
register_deactivation_hook( dirname(__FILE__) . '/inc/hooks/deactivate.php' , 'pngpdlwv_deactivate' );
register_uninstall_hook( dirname(__FILE__) . '/inc/hooks/uninstall.php' , 'pngpdlwv_uninstall' );


// wp_register_script( 'cooltool_ajax', plugins_url( '/js/cooltool_ajax.js'); // see pngpdlwv_functions.php line 4, its registered there 

// function pngpdlwv_update_db_check() {
//   global $pngpdlwv_db_version;
//   if ( get_site_option( 'pngpdlwv_db_version' ) != $pngpdlwv_db_version ) {
//       // pngpdlwv_install();
//   }
// }
// add_action( 'plugins_loaded', 'pngpdlwv_update_db_check' );

// register_activation_hook( __FILE__, 'pngpdlwv_install_uploaddbdata' );

?>