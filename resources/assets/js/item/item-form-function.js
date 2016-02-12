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
		fileInput('#image');
		newFormSubmit();
		modifyFormSubmit();
	}
	
	function fileInput(selector) {
		$(selector).fileinput({
			overwriteInitial: true,
			maxFileSize: 1000,
			showCaption: false,
			showUpload: false,
			defaultPreviewContent: typeof itemImages !== 'undefined' ? itemImages : '',
			allowedFileExtensions: ['jpeg', 'jpg', 'png'],
		});
	}
	
	function newFormSubmit() {
		$("#new-form-submit").click(function() {
			loadingModal('show','Saving ....');
			ajaxCsrfToken();
			$.ajax({
				url: url+'/items/store',
				type: 'post',
				data: formData(),
				dataType: 'json',
				cache:false,
				contentType: false,
				processData: false,
				complete: function() {		
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
					});
				},
				success: function(result) {
					$('.form-group').removeClass('has-error');
					$('.error').empty();
					$('.submit-btn, .fileinput-remove, .btn-file').hide();
					$('input, select').attr('disabled', true);
					addEditBtn('#add-edit-btn', url+'/items/edit/'+result.itemId);
					successAlert('#item-result', result.message);
				}
			});
			
			return false;
		});
	}
	
	function modifyFormSubmit() {
		$("#modify-form-submit").click(function() {
			loadingModal('show', 'Saving ....');
			ajaxCsrfToken();
			$.ajax({
				url: url+'/items/update/'+$('#item_id').val(),
				type: 'post',
				data: formData(),
				dataType: 'json',
				cache:false,
				contentType: false,
				processData: false,
				complete: function() {		
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
					});
				},
				success: function(result) {
					$('.form-group').removeClass('has-error');
					$('.error').empty();
					$('.submit-btn, .fileinput-remove, .btn-file').hide();
					$('input, select').attr('disabled', true);
					successAlert('#item-result', result.message);
					addEditBtn('#add-edit-btn', url+'/items/edit/'+result.itemId);
				}
			});
			
			return false;
		});
	}
	
	function formData() {
		var data = new FormData();
		/* === add input file in FormData === */
		$.each($('#image')[0].files, function(i, file) {
			data.append('image', file);
		});
		/* === add input text in FormData === */
		$('input, select').each(function(){
			var currentSelector = $(this);
			data.append(currentSelector.attr('name'), currentSelector.val());
		})
		
		/* ==== add textarea === */

		return data;
	}
	
	
	