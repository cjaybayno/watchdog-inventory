/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		dataTables();
	}
	
	/* === dataTables === */
	function dataTables() {
		$('#user-list').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/user/paginate'
		});
	}
	
	/* === click clear button === */
	function clickClearInput() {
		$("#clear-users-field").click(function () {
			clearInputs();
		});
	}
	
	/* === Click Delete Button === */
	function clickDeleteBtnHandler(id) {
		loadingBar('#delete-user-result-'+id, 'Deletion in proccess...');
		$('#delete-user-close-'+id).hide();
		$('#delete-user-confirm-'+id).hide();
		
		$.ajax({url: url+"/user/delete/"+id,
			dataType: "json",
			success: function(result) {
				$('#delete-user-result-'+id).html('\
					<div class="alert alert-success">\
						<i><center>'+result.message+'</center></i>\
					</div>');
				$('#delete-user-confirm-'+id).hide();
				$('#delete-user-close-after-'+id).show();
			}
		});
	}
	
	/* === Click Close Button=== */
	function clickCloseBtnAfterHandler() {
		window.location.reload()
	}
	
	