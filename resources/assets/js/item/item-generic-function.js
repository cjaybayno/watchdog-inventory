/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		DataTables();
	}
	
	/* === dataTables === */
	function DataTables() {
		dataTableSelector.DataTable({
			bLengthChange: false,
			iDisplayLength: 10,
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/'+route+'/paginate'
		});
	}
	
	function clickEditBtn(id) {
		$.get(url+'/'+route+'/show/'+id)
		.done(function(response) {
			$.each(response, function(key, value) {		
				$('#edit-'+key).val(value);
			});
			
			$('#edit-form-modal').modal('show');
		});
			  
	}