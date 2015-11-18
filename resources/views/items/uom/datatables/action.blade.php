<button class="btn btn-xs btn-info" onclick="clickEditBtn({{ $id }})">
  <span class="fa fa-edit"></span> Edit
</button>

<button class="btn btn-xs btn-danger delete-item-uom" data-toggle="modal" data-target="#delete-item-uom-modal-{{ $id }}">
  <span class="fa fa-trash"></span> Delete
</button>

<!-- Delete Items Category --->
<div class="modal fade" id="delete-item-uom-modal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="Delete Items Category Modal" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Delete Items UOM?</h4>
	  </div>
	  <div class="modal-body">
	    <div id="delete-item-uom-result-{{ $id }}">
			<div class="alert alert-danger">
			  <p>Are you sure you want to delete this Category?</p>
			</div>
			<table class="table" style="width:80%; margin:auto">
			 
			</table>
		</div>
	  </div>
	  <div class="modal-footer">
		<button class="btn btn-default btn-sm pull-left" data-dismiss="modal" id="delete-item-uom-close-{{ $id }}">Close</button>
		<button class="btn btn-default btn-sm pull-left" data-dismiss="modal" id="delete-item-uom-close-after-{{ $id }}" onclick="clickCloseBtnAfterDeleteHandler('item-uom')" style="display:none">Close</button>
		<button class="btn btn-danger btn-sm" id="delete-item-uom-confirm-{{ $id }}" onclick="clickConfirmBtnDeleteBtnHandler({{ $id }}, 'item-uom', 'items-uom')">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->