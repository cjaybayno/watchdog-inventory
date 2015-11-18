/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		addSelectItems();
		removeSelectItems();
		clickFormSave();
		blurPriceInput();
		clickNewPurchase();
        select2Plugin();
		
		/* === click clear button === */
		$("#clear-purchase-btn").click(function() {
			clearInputs();
		});
	}
	
	function select2Plugin() {
		$('.select2').select2();
	}
	
	function addSelectItems() {
		$('#add-item-btn').click(function() {
			$(htmlSelectItems).appendTo('#add-item');
			$('.select2').select2();
		});
	}
	
	function removeSelectItems() {
		$(document).on('click', '.remove-btn', function(){
			$('#add-item div.remove-item').last().remove();
		});
	}
	
	function blurPriceInput() {
		$('.price').blur(function() {
			$(this).val(addTwoZero($(this).val()));
		});
		
		$(document).on('blur', '.price', function(){
			$(this).val(addTwoZero($(this).val()));
		});
	}
	
	function clickFormSave() {
		$('form').submit(function (e) {
			e.preventDefault();
			loadingModal('show','Saving this purchase....');
			ajaxCsrfToken();
			$.ajax({
				url: url+'/purchases/save',
				type: "post",
				data: $('form').serialize(),
				dataType: 'json',
				complete: function(){				
					loadingModal('close');
				},
				error: function(result) {
					var response = JSON.parse(result.responseText);
					var findFormGroup = $('#add-item').find('div.form-group');
					/* === remove has-error in form-group of item_purchase === */
					findFormGroup.removeClass('has-error');
					$('div.error').html(emptyLabel());
					/* === loop through error list=== */
					$.each(response, function(key, message) {
						var keyLength = key.length;
						var keyName = key.substring(0, keyLength - 2);
						if (key != 'branch_purchase') {
							var lastIndex  = key.charAt(keyLength - 1);
							/* === add has-error in form-group of item_purchase=== */
							if (keyName == 'item_purchase') {
								$(findFormGroup.eq(lastIndex).find('div.item_purchase-error')).html(errorLabel(message));
							}
							if (keyName == 'quantity') {
								$(findFormGroup.eq(lastIndex).find('div.quantity-error')).html(errorLabel(message));
							}
							if (keyName == 'price') {
								$(findFormGroup.eq(lastIndex).find('div.price-error')).html(errorLabel(message));
							}						
							$(findFormGroup.eq(lastIndex).find('div.remove-btn-error')).html(emptyLabel());
						} else {
							$('.branch_purchase-error').html(errorLabel(message));
						}
					});
				},
				success: function(result) {
					$('.error').html(emptyLabel());
					$('input, select').attr('disabled','disabled');
					$('.btn').hide();
					$('#new-purchase-btn').show();
					$('#purchase-result').empty().html('\
						<div class="col-sm-offset-2 col-sm-8">\
							<div class="alert alert-success">\
								<i><center>'+result.message+'</center></i>\
							</div>\
						</div>');
				}
			});
		});
	}
	
	function errorLabel(message) {
		return '<label class="control-label remove-error" style="color:red;">\
					<i class="fa fa-times-circle-o"></i>'+message+'</label>'
	}
	
	function emptyLabel() {
		return '<label class="control-label remove-error" for="inputError"></label>'
	}
	
	function clickNewPurchase() {
		$('#new-purchase-btn').click(function() {
			window.location.reload();
		})
	}
	