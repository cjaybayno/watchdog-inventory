/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		newFormSubmit();
		modifyFormSubmit();
		clickCloseBtn();
	}
	
	function newFormSubmit() {
		var formID 		   = '#create-form-modal';
		var formIDSelector = $(formID);
		var disabledForm   = formIDSelector.find('input, textarea, .form-btn');
		$("#new-form-submit").click(function() {
			var data = $(formID+' input, '+formID+' textarea').serialize();
			loadingBar(formID+' #modal-message','Saving ....');	
			disabledForm.attr('disabled', true);
			ajaxCsrfToken();
			$.ajax({
				url: url+'/'+route+'/store',
				type: 'post',
				data: data,
				dataType: 'json',
				complete: function() {				
					loadingBarClose(formID+' #modal-message');
				},
				error: function(result) {
					var response = JSON.parse(result.responseText);
					removeInputErrors()
					disabledForm.removeAttr('disabled');
					$.each(response, function(key, value) {
						/* === show error highlights === */ 
						$(formID+' #form-group-'+key).addClass('has-error');
						$(formID+' #error-'+key).html(errorLabel(value));	
					});
				},
				success: function(result) {
					removeInputErrors();
					formIDSelector.find('#close-btn').removeAttr('disabled');
					formIDSelector.find('#new-form-submit, #clear-btn').hide();
					formIDSelector.find('#result-message').empty().html('\
						<div class="alert alert-success">\
							<i><center>'+result.message+'</center></i>\
						</div>');
				}
			});
			
			return false;
		});
	}
	
	function modifyFormSubmit() {
		var formID 		   = '#edit-form-modal';
		var formIDSelector = $(formID);
		var disabledForm   = formIDSelector.find('input, textarea, .form-btn');
		$("#modify-form-submit").click(function() {
			var data = $(formID+' input, '+formID+' textarea').serialize();
			loadingBar(formID+' #modal-message','Modifying ....');
			formIDSelector.find('#result-message').empty();
			disabledForm.attr('disabled', true);
			ajaxCsrfToken();
			$.ajax({
				url: url+'/'+route+'/update/'+$('#edit-id').val(),
				type: 'post',
				data: data,
				dataType: 'json',
				complete: function() {
					loadingBarClose(formID+' #modal-message');
				},
				error: function(result) {
					var response = JSON.parse(result.responseText);
					removeInputErrors()
					disabledForm.removeAttr('disabled');
					$.each(response, function(key, value) {
						/* === show error highlights === */ 
						$(formID+' #form-group-'+key).addClass('has-error');
						$(formID+' #error-'+key).html(errorLabel(value));	
					});
				},
				success: function(result) {
					removeInputErrors();
					disabledForm.removeAttr('disabled');
					formIDSelector.find('#result-message').empty().html('\
						<div class="alert alert-success">\
							<i><center>'+result.message+'</center></i>\
						</div>');
				}
			});
			
			return false;
		});
	}
	
	function clickCloseBtn() {
		$('.close-btn').click(function() {
			location.reload();
		});
	}