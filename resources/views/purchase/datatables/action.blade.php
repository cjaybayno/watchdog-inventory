<a href="#">
	<button class="btn btn-xs btn-primary"><span class="fa fa-print"></span> Print</button>
</a>
<a href="#">
	<button class="btn btn-xs btn-primary"><span class="fa fa-eye"></span> View</button>
</a>
<a href="#">
	<button class="btn btn-xs btn-info"><span class="fa fa-edit"></span> Edit</button>
</a>

<!--
<button class="btn btn-xs btn-danger delete-branch" data-toggle="modal" data-target="#delete-branch-modal-{{ $id }}">
  <span class="fa fa-trash"></span> Delete
</button>

<!-- Delete Branch 
<div class="modal fade" id="delete-branch-modal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="Delete Branch Modal" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Delete Branch</h4>
	  </div>
	  <div class="modal-body">
	    <div id="delete-branch-result-{{ $id }}">
			<div class="alert alert-danger">
			  <p>Are you sure you want to delete this branch?</p>
			</div>
			<table class="table" style="width:80%; margin:auto">
			 
			</table>
		</div>
	  </div>
	  <div class="modal-footer">
		<button class="btn btn-default btn-sm pull-left" data-dismiss="modal" id="delete-branch-close-{{ $id }}">Close</button>
		<button class="btn btn-default btn-sm pull-left" data-dismiss="modal" id="delete-branch-close-after-{{ $id }}" onclick="clickCloseBtnAfterDeleteHandler('branches')" style="display:none">Close</button>
		<button class="btn btn-danger btn-sm" id="delete-branch-confirm-{{ $id }}" onclick="clickConfirmBtnDeleteBtnHandler({{ $id }}, 'branch', 'branches')">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  <!-- </div><!-- /.modal-dialog -->
<!-- </div><!-- /.modal -->