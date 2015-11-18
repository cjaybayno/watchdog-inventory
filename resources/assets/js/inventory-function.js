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
		DataTables("#items-list-table", "items");
		DataTables("#munits-list-table", "measurement-units");
		clearInputs();
	}
	
	/* === dataTables === */
	function DataTables(selector, controller) {
		$(selector).DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: url+'/inventory/'+controller+'/paginate'
		});
	}
	
	/* === Click delete branch button === */
	function  clickDeleteBranch(id) {
		deleteBtnHandler(id, 'branch', 'branches');
	}
	
	/* === Click delete branch button === */
	function  clickDeleteItem(id) {
		deleteBtnHandler(id, 'item', 'items');
	}
	
	/* === Click delete munits button === */
	function  clickDeleteItem(id) {
		deleteBtnHandler(id, 'item', 'items');
	}
	
	/* === Click delete branch button === */
	function  clickDeleteMunit(id) {
		deleteBtnHandler(id, 'munits', 'measurement-units');
	}
	
	/* === Click close Button after success deletion === */
	function clickCloseBtnAfterHandler(controller) {
		window.location.href = url+'/inventory/'+controller;
	}
	
	
	