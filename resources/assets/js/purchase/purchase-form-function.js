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
		selectSupplier();
		addItemColumn();
		removeItemColumn();
		removeSingleItemColumn();
		selectSingleItem();
		validateInput();
		inputQuantity();
		inputDiscount();
		shortCutKey();
		newFormSubmit();
	}
	
	function selectSupplier() {
		$("#supplier").change(function() {
			getSupplier('change');
			if ($(this).val() != '') {
				$('.form-hide').show();
			} else {
				$('.form-hide').hide();
			}
			$('.quantity').val('');
			$('.price, .discount, .subtotal').val(addTwoZero(0));
			$('#total').val(addTwoZero(0));
			$('.quantity, .discount').attr('readonly', true);
		});
	}
	
	function getSupplier(event) {
		var itemSelector = $('.item');
		var closestTr    = itemSelector.closest('tr');
		$.get(url+"/purchases/items-of-supplier/"+$("#supplier").val(), function(result) {
			var selectData = [];
			selectData.push({'id'  : ' ', 'text': 'Select Items'});
			$.each(result, function(key, value) {
				selectData.push({
					'id'  : value.id,
					'text': value.brand+' '+value.name+' ('+value.measurement+value.uom+')'
				});
			});
			if (event == 'click') {
				$('#item-table tr').next().find('.item').select2({data: selectData });
			}
			if (event == 'change') {
				itemSelector.empty();
				itemSelector.select2({data: selectData });
			}
		});
	}
	
	function addItemColumn() {
		$('#add-column-btn').click(function() {
			$(htmlSelectItems).insertAfter('#item-table tr:last');
			getSupplier('click');
			validateInput();
		});
	}
	
	function removeItemColumn() {
		$('#remove-column-btn').click(function() {
			$('tr.remove-item').last().remove();
			computeTotal();
		});
	}
	
	function removeSingleItemColumn() {
		$(document).on('click', '.remove-single-column-btn', function() {
			$(this).closest('tr').remove();
			computeTotal();
		})
	}
	
	function selectSingleItem() {
		$(document).on('change', '.item', function() {
			var thisSelector = $(this);
			var closestTr    = thisSelector.closest('tr');
			var item 		 = closestTr.find('.item').val();
			
			if (item != ' ') {
				closestTr.find('.quantity').removeAttr('readonly');
				closestTr.find('.discount').removeAttr('readonly');
				$.get(url+"/purchases/item-price/"+thisSelector.val(), function(result) {
					closestTr.find('.price').val(addTwoZero(result.current_price));
				});
			} else {
				closestTr.find('.quantity').attr('readonly', true);
				closestTr.find('.discount').attr('readonly', true);
				closestTr.find('.price').val(addTwoZero(0));
			}
			
			closestTr.find('.quantity').val('');
			closestTr.find('.subtotal, .discount').val(addTwoZero(0));
		});
	}
	
	function inputQuantity() {
		$(document).on('keyup', '.quantity', function() {
			var thisSelector = $(this);
			var closestTr    = thisSelector.closest('tr');
			var subtotal     = addTwoZero(closestTr.find('.price').val() * thisSelector.val());
			closestTr.find('.subtotal').val(subtotal);
			computeTotal();
		});
	}
	
	function inputDiscount() {
		$(document).on('keyup', '.discount', function() {
			var thisSelector = $(this);
			var closestTr    = thisSelector.closest('tr');
			var subtotal     = addTwoZero(closestTr.find('.quantity').val() * closestTr.find('.price').val());
			var subtotal     = addTwoZero(subtotal - thisSelector.val());
			closestTr.find('.subtotal').val(subtotal);
			computeTotal();
		});
		
		$(document).on('blur', '.discount', function() {
			var thisSelector = $(this);
			var closestTr    = thisSelector.closest('tr');
			var discount     = addTwoZero(Number(thisSelector.val()));
			closestTr.find('.discount').val(discount);
		});
	}
	
	function computeTotal() {
		var total = 0;
		$('.subtotal').each(function(index, selector) {
			total = parseFloat(total) + parseFloat($(selector).val()); 
		});
	
		$('#total').val(digits(addTwoZero(total)));
		$('#total_raw').val(addTwoZero(total));
	}
	
	function validateInput() {
		$('.quantity').inputmask('decimal');
		$('.discount').inputmask('decimal');
		
		// $(document).on('keydown', '.quantity, .discount', function(e) {
			// if ( ! (e.keyCode == 8) &&  //backspace
				 // ! (e.keyCode == 9) &&  //tab
				 // ! (e.keyCode == 116) && // F5
				 // ! (e.keyCode == 190) && // period
				 // ! (e.keyCode >= 37 && e.keyCode <= 40) && //arrows
				 // ! (e.keyCode >= 48 && e.keyCode <= 57) && //numbers
				 // ! (e.keyCode >= 96 && e.keyCode <= 105)) //numpad
			// {
				// return false;
			// }
		// });
	}
	
	function shortCutKey() {
		$(document).on('keypress', function(e) {
			if ($('#supplier').val() != '') {
				if(e.charCode == 74) {
					//add items
					$(htmlSelectItems).insertAfter('#item-table tr:last');
					getSupplier('click');
					validateInput();
				}
				if(e.charCode == 75) {
					//remove items
					$('tr.remove-item').last().remove();
					computeTotal();
				}
			}
		});
	}
	
	function newFormSubmit() {
		$("#new-form-submit").click(function() {
			loadingModal('show','Saving ....');
			ajaxCsrfToken();
			$.ajax({
				url: url+'/purchases/store',
				type: "post",
				data: $('form').serialize(),
				dataType: 'json',
				complete: function() {		
					loadingModal('close');
				},
				error: function(result) {
					
				},
				success: function(result) {
					if (result.success) {
						$('.item-btn').hide();
						$('#new-form-submit').hide();
						$('input, select, textarea').attr('disabled', true);
						hideZeroValueQuantity();
					} else {
						alert(result.message);
					}
				}
			});
			
			return false;
		});
	}
	
	function hideZeroValueQuantity() {
		var selector = $('.quantity');
		var subtotalsCount =  selector.length;
		for (var i=0; i < subtotalsCount; i++) {
			/* === hide quantity that has value of 0.00  and '' === */
			if (selector.eq(i).val() == 0) {
				selector.eq(i).closest('tr').hide();	
			}
		}			
	}
	
	// function modifyFormSubmit() {
		// $("#modify-form-submit").click(function(){
			// loadingModal('show','Modifying ....');
			// ajaxCsrfToken();
			// $.ajax({
				// url: url+'/suppliers/update/'+$('#supplier_id').val(),
				// type: "post",
				// data: $('input, select').serialize() + '&remarks='+ $('#remarks').val(),
				// dataType: 'json',
				// complete: function(){				
					// loadingModal('close');
				// },
				// error: function(result) {
					// var response = JSON.parse(result.responseText);
					// /* === remove show error highlights === */
					// $('.form-group').removeClass('has-error');
					// $('.error').empty();
					
					// $.each(response, function(key, value) {
						// /* === show error highlights === */ 
						// $('#form-group-'+key).addClass('has-error');
						// $('#error-'+key).html(errorLabel(value));
						// /* === show error highlights in address textarea=== */
						// var addressField = [
							// 'street',
							// 'brgy_town',
							// 'province_city' 	
						// ];	
						// if ($.inArray(key, addressField) > -1) {
							// $('#form-group-address').addClass('has-error');
						// }
						
					// });
				// },
				// success: function(result) {
					// $('.form-group').removeClass('has-error');
					// $('.error').empty();
					// $('.submit-btn').hide();
					// $('input, textarea').attr('readonly', true);
					// $('.select2').prop('disabled', true);
					// successAlert('#supplier-result', result.message);
						
					// $('#add-edit-btn').empty().html('\
						// <button class="btn btn-block btn-sm btn-info pull-right" id="edit-btn">\
							// <span class="fa fa-edit"></span> Edit \
						// </button>\
					// ');
				// }
			// });
			
			// return false;
		// });
	// }
	
	// function editClickBtn() {
		// $(document).on('click','#edit-btn', function() {
			// location.reload();
			// return false;
		// });
	// }