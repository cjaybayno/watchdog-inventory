/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		DataTables("#branches-list-table", "branches");
	}
	
	/* === dataTables === */
	function DataTables(selector, controller) {
		$(selector).DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/'+controller+'/paginate'
		});
	}
	
	