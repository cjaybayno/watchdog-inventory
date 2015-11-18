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
	}
	
	function fileInput(selector) {
		$(selector).fileinput({
			showCaption: false,
			showUpload: false,
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

		return data;
	}
	
	
	