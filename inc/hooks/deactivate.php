<?php
	function pngpdlwv_deactivate() {
		// do something when the plugin is deactivated
		echo "plugin deactivated successfully";
	}
	register_deactivation_hook( __FILE__ , 'pngpdlwv_deactivate' );
?>