<a href="{{ URL::route('suppliers.show', $id) }}">
	<button class="btn btn-xs btn-primary"><span class="fa fa-eye"></span> View</button>
</a>
<a href="{{ URL::route('suppliers.edit', $id) }}">
	<button class="btn btn-xs btn-info"><span class="fa fa-edit"></span> Edit</button>
</a>
<button class="btn btn-xs btn-danger delete-supplier" data-toggle="modal" data-target="#delete-supplier-modal-{{ $id }}">
  <span class="fa fa-trash"></span> Delete
</button>

<!-- Delete Branch --->
<div class="modal fade" id="delete-supplier-modal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="Delete Branch Modal" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Delete Branch</h4>
	  </div>
	  <div class="modal-body">
	    <div id="delete-supplier-result-{{ $id }}">
			<div class="alert alert-danger">
			  <p>Are you sure you want to delete this supplier?</p>
			</div>
			<table class="table" style="width:80%; margin:auto">
			 
			</table>
		</div>
	  </div>
	  <div class="modal-footer">
		<button class="btn btn-default btn-sm pull-left" data-dismiss="modal" id="delete-supplier-close-{{ $id }}">Close</button>
		<button class="btn btn-default btn-sm pull-left" data-dismiss="modal" id="delete-supplier-close-after-{{ $id }}" onclick="clickCloseBtnAfterDeleteHandler('suppliers')" style="display:none">Close</button>
		<button class="btn btn-danger btn-sm" id="delete-supplier-confirm-{{ $id }}" onclick="clickConfirmBtnDeleteBtnHandler({{ $id }}, 'supplier', 'suppliers')">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->