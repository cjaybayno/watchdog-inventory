<!-- Edit form modal -->
<div class="modal fade" id="edit-form-modal" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Edit Items Category</h4>
	  </div>
	  <div class="modal-body col-sm-12">
		<div class="col-xs-12">
			<div class="generic-modal-title"></div>
			<div id="modal-message"></div>
		</div>
		<div class="col-xs-12">
			<div id="result-message"></div>
		</div>
		<input type="hidden" name="id" id="edit-id">
		<div class="col-xs-12">
			<div class="form-group" id="form-group-name">
				<label for="name" class="control-label">Name</label>
				<div class="error" id="error-name"></div>
				<input type="text" name="name" style="text-transform:capitalize;" class="form-control" id="edit-name" placeholder="Category Name">
			</div>
		</div>
		<div class="col-xs-12">
			<div class="form-group" id="form-group-label">
				<label for="label" class="control-label">Label</label>
				<div class="error" id="error-label"></div>
				<input type="text" name="label" style="text-transform:capitalize;" class="form-control" id="edit-label" placeholder="Category Label">
			</div>
		</div>
		<div class="col-xs-12">
			<div class="form-group" id="form-group-description">
				<label for="description" class="control-label">Description</label>
				<div class="error" id="error-description"></div>
				<textarea name="description" class="form-control" id="edit-description" rows="5"></textarea>
			</div>
		</div>
	  </div>
	  <div class="modal-footer">
		<div class="col-xs-12">
			<button type="button" class="form-btn btn btn-sm btn-info pull-left" id="modify-form-submit">Modify</button>
			<button type="button" class="form-btn btn btn-sm btn-default pull-left clear-btn">Clear</button>
			<button type="button" class="form-btn close-btn btn-sm btn btn-default" data-dismiss="modal" id="close-btn">Close</button>
		</div>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->