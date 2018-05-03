<?php
function function_pngpdlwv_form(){
	global $sudotech_pngpdwlv;
  $labelClass = '';
	if ($sudotech_pngpdwlv['radio_formlabels'] === '2') {
		$labelClass = ' hidden ';
	}
  $html = '
  <div id="pngpdlwv_form">
  	<div id="form-header">'.$sudotech_pngpdwlv['form_header'].'</div>
    <form id="lookuptool" class="form form-horizontal" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
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
  ';
  return $html;
}
add_shortcode( 'pngpdlwv_form', 'function_pngpdlwv_form' );
?>