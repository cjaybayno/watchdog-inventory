<a href="{{ URL::to('inventory/items/show/'.$id) }}">
	<button class="btn btn-xs btn-primary"><span class="fa fa-eye"></span> View</button>
</a>
<a href="{{ URL::to('inventory/items/edit/'.$id) }}">
	<button class="btn btn-xs btn-info"><span class="fa fa-edit"></span> Edit</button>
</a>
<button class="btn btn-xs btn-danger delete-item" data-toggle="modal" data-target="#delete-item-modal-{{ $id }}">
  <span class="fa fa-trash"></span> Delete
</button>

<!-- Delete item --->
<div class="modal fade" id="delete-item-modal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="Delete item Modal" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Delete item</h4>
	  </div>
	  <div class="modal-body">
	    <div id="delete-item-result-{{ $id }}">
			<div class="alert alert-danger">
			  <p>Are you sure you want to delete this Item?</p>
			</div>
			<table class="table" style="width:80%; margin:auto">
			 
			</table>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="delete-item-close-{{ $id }}">Close</button>
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="delete-item-close-after-{{ $id }}" onclick="clickCloseBtnAfterHandler('items')" style="display:none">Close</button>
		<button type="button" class="btn btn-danger" id="delete-item-confirm-{{ $id }}" onclick="clickDeleteItem({{ $id }})">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->