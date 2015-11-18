/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		DataTables("#suppliers-list-table", "suppliers");
		clearInputs();
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