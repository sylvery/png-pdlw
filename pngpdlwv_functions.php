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
			wp_enqueue_script('cooltool_ajax',plugins_url( '/js/cooltool_ajax_prov.js', __FILE__ ),array('jquery'));
		}
	}
	wp_enqueue_style( 'bootstrap_theme', plugins_url( '/css/bootstrap-theme.css', __FILE__ ) );
	wp_enqueue_style( 'bootstrap_forms', plugins_url( '/css/bootstrap.css', __FILE__ ) );
	wp_enqueue_style( 'styles', plugins_url( '/css/style.css', __FILE__ ) );
	$nonce = wp_create_nonce('cooltool');
	wp_localize_script( 'cooltool_ajax', 'cooltool_ajax_obj', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce' => $nonce,
		) );
}

function textfield_sanitize ($arg) {
	$arg = sanitize_text_field( $arg );
	if (strlen($arg)>33) {
		$arg = substr($arg, 0,33);
	}
	return $arg;
}

function reqHandler() {
	check_ajax_referer( 'cooltool', 'security_string' );
	if (empty($_POST)) die('Nothing sent via $_POST');
	global $wpdb;
	$table = $wpdb->prefix . "pngpdlwv";
	// validate variables available to the public before going any further
	/* 
		validation rules
		> variable must contain no more than 35 characters
		> characters should contain all alphabets, numbers, fullstop, short-dash and forward slashes only
		> validate by variable as they are passed in

		isset() and empty() for checking whether a variable exists and isn’t blank
		mb_strlen() or strlen() for checking that a string has the e xpected number of characters
		preg_match(), strpos() for checking for occurrences of certain strings in other strings
		count() for checking how many items are in an array
		in_array() for checking whether something exists in an array
	*/
	$province = textfield_sanitize($_POST['province']);
	$district = textfield_sanitize($_POST['district']);
	$llg = textfield_sanitize($_POST['llg']);
	$ward = textfield_sanitize($_POST['ward']);
	$what = textfield_sanitize($_POST['get']);

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
add_action( 'wp_ajax_pngpdlwv_reqHandler', 'reqHandler' );
add_action( 'wp_ajax_nopriv_pngpdlwv_reqHandler', 'reqHandler' );

?>