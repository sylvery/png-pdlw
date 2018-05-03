let $ = jQuery;
$(document).ready(()=>{
	$.post(cooltool_ajax_obj.ajax_url,{
		action: 'pngpdlwv_reqHandler',
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
		console.log("----------------------------> complete wards <----------------------------");
	});

	$('#province')
		.on('change',()=>{
			// toggle class: hidden
			$('#district')
				.children()
				.remove();
			$('#districts').removeClass('hidden');
			$('#llgs').addClass('hidden');
			$('#wards').addClass('hidden');
			$('#villages').addClass('hidden');
			if ($('#province').val() === 'empty'){
				$('#districts').addClass('hidden')
			}
			// ajax request
			$.post(cooltool_ajax_obj.ajax_url,{
				action: 'pngpdlwv_reqHandler',
				security_string: cooltool_ajax_obj.nonce,
				province: $('#province').val(),
				get: 'districts',
			})
			.done((data)=>{
				// console.log('data:',typeof(data),'\n',data);
				$('#district')
					.append("<option value='empty'>Select District</option>");
				for (var i = 0; data.length > i; i++) {
					$("#district").append('<option value="'+data[i].DistNAME+'">'+data[i].DistNAME+'</option>');
					// $('#message').html('<h2>Districts Retrieved Successfully</h2>')
					console.log(data[i].DistNAME);
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("----------------------------> complete wards <----------------------------");
			});
		});
	$('#district')
		.on('change',()=>{
			// toggle class: hidden
			$('#llg')
				.children()
				.remove();
			$('#wards').addClass('hidden');
			$('#villages').addClass('hidden');
			$('#llgs').removeClass('hidden');
			if ($('#district').val() === 'empty'){
				$('#llgs').addClass('hidden');
			}
			// ajax request
			$.post(cooltool_ajax_obj.ajax_url,{
				action: 'pngpdlwv_reqHandler',
				security_string: cooltool_ajax_obj.nonce,
				province: $('#province').val(),
				district: $('#district').val(),
				get: 'llgs',
			})
			.done((data)=>{
				// console.log('data:',typeof(data),'\n',data);
				$('#llg')
					.append("<option value='empty'>Select Local Level Govt</option>");
				for (var i = 0; data.length > i; i++) {
					console.log(data[i].LlgNAME);
					$('#llg').append('<option value="'+data[i].LlgNAME+'">'+data[i].LlgNAME+'</option>');
					// $('#message').html('<h2>LLGs Retrieved Successfully</h2>')
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("----------------------------> complete wards <----------------------------");
			});
		});
	$('#llg')
		.on('change',()=>{
			// toggle class: hidden
			$('#ward')
				.children()
				.remove();
			$('#villages').addClass('hidden');
			$('#wards').removeClass('hidden');
			if ($('#llg').val() === 'empty'){
				$('#wards').addClass('hidden');
			}
			// ajax request
			$.post(cooltool_ajax_obj.ajax_url,{
				action: 'pngpdlwv_reqHandler',
				security_string: cooltool_ajax_obj.nonce,
				province: $('#province').val(),
				district: $('#district').val(),
				llg: $('#llg').val(),
				get: 'wards',
			})
			.done((data)=>{
				// console.log('data:',typeof(data),'\n',data);
				$('#ward')
					.append("<option value='empty'>Select Ward</option>");
				for (var i = 0; data.length > i; i++) {
					console.log(data[i].WardNAME);
					$('#ward').append('<option value="'+data[i].WardNAME+'">'+data[i].WardNAME+'</option>');
					// $('#message').html('<h2>Wards Retrieved Successfully</h2>')
				}
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("----------------------------> complete wards <----------------------------");
			});
		});
});
