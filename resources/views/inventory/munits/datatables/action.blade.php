<a href="{{ URL::route('munits.show', $id) }}">
	<button class="btn btn-xs btn-primary"><span class="fa fa-eye"></span> View</button>
</a>
<a href="{{ URL::route('munits.edit', $id) }}">
	<button class="btn btn-xs btn-info"><span class="fa fa-edit"></span> Edit</button>
</a>
<button class="btn btn-xs btn-danger delete-munits" data-toggle="modal" data-target="#delete-munits-modal-{{ $id }}">
  <span class="fa fa-trash"></span> Delete
</button>

<!-- Delete Munits --->
<div class="modal fade" id="delete-munits-modal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="Delete Munits Modal" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Delete Measurement Units</h4>
	  </div>
	  <div class="modal-body">
	    <div id="delete-munits-result-{{ $id }}">
			<div class="alert alert-danger">
			  <p>Are you sure you want to delete this unit?</p>
			</div>
			<table class="table" style="width:80%; margin:auto">
			 
			</table>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="delete-munits-close-{{ $id }}">Close</button>
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="delete-munits-close-after-{{ $id }}" onclick="clickCloseBtnAfterHandler('measurement-units')" style="display:none">Close</button>
		<button type="button" class="btn btn-danger" id="delete-munits-confirm-{{ $id }}" onclick="clickDeleteMunit({{ $id }})">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->