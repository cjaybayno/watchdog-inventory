/* ========================================================================
 *  Initialize Pages
 * ======================================================================== */
	$(initialPages);

/* ========================================================================
 *  Major function
 * ======================================================================== */
 
	/* ==== function to init this page === */
	function initialPages($) {
		dataTable('#purchase-list', 'purchases');
	}
	
	function dataTable(selector, controller) {
		$(selector).DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/'+controller+'/paginate'
		});
	}