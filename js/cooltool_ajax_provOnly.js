let $ = jQuery;
$(document).ready(()=>{
	$.post(cooltool_ajax_obj.ajax_url,{
		action: 'pngpdlw_reqHandler',
		security_string: cooltool_ajax_obj.nonce,
		province: 'none',
		get: 'provinces',
	})
	.done((data)=>{
		// console.log('data:',typeof(data),'\n',data);
		for (var i = 0; data.length > i; i++) {
			$('#province').append('<option value="'+data[i].ProvNAME+'">'+data[i].ProvNAME+'</option>');
			// $('#message').html('<h2>Provinces Retrieved Successfully</h2>')
			console.log(data[i].ProvNAME);
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("----------------------------> complete <----------------------------");
	});
});
