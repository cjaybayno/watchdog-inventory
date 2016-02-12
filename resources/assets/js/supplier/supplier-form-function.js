/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		$('.select2').select2();
		selectProvinceCity();
		selectBrgyTown();
		okAddress();
		newFormSubmit();
		modifyFormSubmit();
		editClickBtn();
	}
	
	function selectProvinceCity() {
		$('#province_city').change(function() {
			$('#brgy_town').empty().attr('disabled', true);
			$.ajax({url: url+'/suppliers/brgy-town/'+$(this).val(),
				dataType: "json",
				success: function(result) {
					var selectData = [];
					$.each(result, function(key, value) {
						if (value == 'SELECT BARANGAY/TOWN') {
							selectData.push({'id': ' ', 'text': value});
						} else {
							selectData.push({'id': key, 'text': value});
						}
					});
					$('#brgy_town').select2({
						data: selectData
					}).removeAttr('disabled');
				}
			});
		});
	}
	
	function selectBrgyTown() {
		$('#brgy_town').change(function() {
			$('#zipcode').empty();
			$.ajax({url: url+'/suppliers/zipcode/'+$(this).val(),
				dataType: "json",
				success: function(result) {
					$('#zipcode').val(result);
				}
			});
		});
	}
	
	function okAddress() {
		$('#ok-address').click(function() {
			var addressField = {
				'street' 		: $('#street').val(),
				'brgy_town'		: $('#brgy_town').val(),
				'province_city' : $('#province_city').val(),
				'zipcode' 		: $('#zipcode').val(),
				'country' 		: $('#country').val(),
			};
			var addressHtml = '';
			$.each(addressField, function(key, value) {
				if (value != '' && value != 0) {
					addressHtml += value+' &#13;&#10; ';
				}
			});
			$('#address').html(addressHtml);
			$('#address-modal').modal('hide');
		});
	}
	
	function newFormSubmit() {
		$("#new-form-submit").click(function(){
			loadingModal('show','Saving ....');
			ajaxCsrfToken();
			$.ajax({
				url: url+'/suppliers/store',
				type: "post",
				data: $('input, select').serialize() + '&remarks='+ $('#remarks').val(),
				dataType: 'json',
				complete: function(){				
					loadingModal('close');
				},
				error: function(result) {
					var response = JSON.parse(result.responseText);
					/* === remove show error highlights === */
					$('.form-group').removeClass('has-error');
					$('.error').empty();
					
					$.each(response, function(key, value) {
						/* === show error highlights === */ 
						$('#form-group-'+key).addClass('has-error');
						$('#error-'+key).html(errorLabel(value));
						/* === show error highlights in address textarea=== */
						var addressField = [
							'street',
							'brgy_town',
							'province_city' 	
						];
						
						if ($.inArray(key, addressField) > -1) {
							$('#form-group-address').addClass('has-error');
						}
						
					});
				},
				success: function(result) {
					$('.form-group').removeClass('has-error');
					$('.error').empty();
					$('.submit-btn').hide();
					$('input, textarea').attr('readonly', true);
					$('.select2').prop('disabled', true);
					successAlert('#supplier-result', result.message);
					
				}
			});
			
			return false;
		});
	}
	
	function modifyFormSubmit() {
		$("#modify-form-submit").click(function(){
			loadingModal('show','Modifying ....');
			ajaxCsrfToken();
			$.ajax({
				url: url+'/suppliers/update/'+$('#supplier_id').val(),
				type: "post",
				data: $('input, select').serialize() + '&remarks='+ $('#remarks').val(),
				dataType: 'json',
				complete: function(){				
					loadingModal('close');
				},
				error: function(result) {
					var response = JSON.parse(result.responseText);
					/* === remove show error highlights === */
					$('.form-group').removeClass('has-error');
					$('.error').empty();
					
					$.each(response, function(key, value) {
						/* === show error highlights === */ 
						$('#form-group-'+key).addClass('has-error');
						$('#error-'+key).html(errorLabel(value));
						/* === show error highlights in address textarea=== */
						var addressField = [
							'street',
							'brgy_town',
							'province_city' 	
						];	
						if ($.inArray(key, addressField) > -1) {
							$('#form-group-address').addClass('has-error');
						}
						
					});
				},
				success: function(result) {
					$('.form-group').removeClass('has-error');
					$('.error').empty();
					$('.submit-btn').hide();
					$('input, textarea').attr('readonly', true);
					$('.select2').prop('disabled', true);
					successAlert('#supplier-result', result.message);
						
					$('#add-edit-btn').empty().html('\
						<button class="btn btn-block btn-sm btn-info pull-right" id="edit-btn">\
							<span class="fa fa-edit"></span> Edit \
						</button>\
					');
				}
			});
			
			return false;
		});
	}
	
	function editClickBtn() {
		$(document).on('click','#edit-btn', function() {
			location.reload();
			return false;
		});
	}