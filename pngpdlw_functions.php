<?php

// makes '/wp-admin/admin-ajax.php' available to both public and private users through the 'cooltool_ajax_obj' global variable
add_action( 'wp_enqueue_scripts', 'cooltool_enqueue' );
function cooltool_enqueue( $hook ) {
	global $sudotech_pngpdwlv;
	$datafield = $sudotech_pngpdwlv['checkbox_datafield'];
	if ($datafield[1]==1) { // province
		if ($datafield[2]==1) { // district
			if ($datafield[3]==1) { // llg
				if ($datafield[4]==1) { // ward
					if ($datafield[5]==1) { // village
						wp_enqueue_script('cooltool_ajax',plugins_url( '/js/cooltool_ajax.js', __FILE__ ),array('jquery'));
					} else {
						wp_enqueue_script('cooltool_ajax',plugins_url( '/js/cooltool_ajax_provDistLlgWard.js', __FILE__ ),array('jquery'));
					}
				} else {
					wp_enqueue_script('cooltool_ajax',plugins_url( '/js/cooltool_ajax_provDistLlg.js', __FILE__ ),array('jquery'));
				}
			} else {
				wp_enqueue_script('cooltool_ajax',plugins_url( '/js/cooltool_ajax_provDist.js', __FILE__ ),array('jquery'));
			}
		} else {
			wp_enqueue_script('cooltool_ajax',plugins_url( '/js/cooltool_ajax_provOnly.js', __FILE__ ),array('jquery'));
		}
	} else {
		wp_enqueue_script('cooltool_ajax',plugins_url( '/js/cooltool_ajax.js', __FILE__ ),array('jquery'));
	}
	wp_enqueue_script('cooltool_ajax',plugins_url( '/js/cooltool_ajax.js', __FILE__ ),array('jquery'));
	wp_enqueue_style( 'bootstrap_theme', plugins_url( '/css/bootstrap-theme.css', __FILE__ ) );
	wp_enqueue_style( 'bootstrap_forms', plugins_url( '/css/bootstrap.css', __FILE__ ) );
	$nonce = wp_create_nonce('cooltool');
	wp_localize_script( 'cooltool_ajax', 'cooltool_ajax_obj', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce' => $nonce,
		) );
}

function reqHandler() {
	check_ajax_referer( 'cooltool', 'security_string' );
	if (empty($_POST)) die('Nothing sent via $_POST');
	global $wpdb;
	$table = $wpdb->prefix . "pngpdlw";
	$province = $_POST['province'];
	$district = $_POST['district'];
	$llg = $_POST['llg'];
	$ward = $_POST['ward'];
	$what = $_POST['get'];

	switch ( $what ) {
		case 'provinces':
			$dbquery =  'SELECT ProvNAME' . ' FROM '.$table. ' GROUP BY ProvNAME';
			break;
		case 'districts':
			$dbquery =  'SELECT DistNAME' . ' FROM '.$table. ' WHERE ProvNAME = "' . $province .'" GROUP BY DistNAME';
			break;
		case 'llgs':
			$dbquery =  'SELECT LlgNAME' . ' FROM '.$table. ' WHERE ProvNAME = "' . $province .'" AND DistNAME = "'. $district . '" GROUP BY LlgNAME';
			break;
		case 'wards':
			$dbquery =  'SELECT WardNAME' . ' FROM '.$table. ' WHERE ProvNAME = "' . $province .'" AND DistNAME = "'. $district . '" AND LlgNAME = "'. $llg . '" GROUP BY WardNAME';
			break;
		case 'villages':
			$dbquery =  'SELECT VillageNAME' . ' FROM '.$table. ' WHERE ProvNAME = "' . $province .'" AND DistNAME = "'. $district . '" AND LlgNAME = "'. $llg . '" AND WardNAME = "'. $ward . '" GROUP BY VillageNAME';
			break;
		default:
			# code...
			break;
	}
	wp_send_json( $wpdb->get_results( $wpdb->prepare($dbquery), OBJECT ) );
	die();
}
add_action( 'wp_ajax_pngpdlw_reqHandler', 'reqHandler' );
add_action( 'wp_ajax_nopriv_pngpdlw_reqHandler', 'reqHandler' );

?>