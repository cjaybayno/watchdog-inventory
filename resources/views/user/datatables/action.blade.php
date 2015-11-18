<a href="{{ URL::to('user/'.$id) }}">
	<button class="btn btn-xs btn-primary"><span class="fa fa-eye"></span> View</button>
</a>
<a href="{{ URL::to('user/edit/'.$id) }}">
	<button class="btn btn-xs btn-info"><span class="fa fa-edit"></span> Edit</button>
</a>
<button class="btn btn-xs btn-danger delete-user" data-toggle="modal" data-target="#delete-user-modal-{{ $id }}">
  <span class="fa fa-trash"></span> Delete
</button>

<!-- Delete User --->
<div class="modal fade" id="delete-user-modal-{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="Delete User Modal" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Delete User</h4>
	  </div>
	  <div class="modal-body">
	    <div id="delete-user-result-{{ $id }}">
			<div class="alert alert-danger">
			  <p>Are you sure you want to delete this user?</p>
			</div>
			<table class="table" style="width:80%; margin:auto">
			  <tr>
				<td>
					<img src="{{ $avatar }}" alt="User Image" class="img-thumbnail" style="height:80px; width:80px">
				</td>
				<td></td>
			  </tr>
			  <tr>
				<td>ID</td>
				<td>{{ $id }}</td>
			  </tr>
			  <tr>
				<td>Username</td>
				<td>{{ $username }}</td>
			  </tr>
			   <tr>
				<td>Name</td>
				<td>{{ $name }}</td>
			  </tr>
			  <tr>
				<td>Email</td>
				<td>{{ $email }}</td>
			  </tr>
			</table>
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="delete-user-close-{{ $id }}">Close</button>
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" id="delete-user-close-after-{{ $id }}" onclick="clickCloseBtnAfterHandler()" style="display:none">Close</button>
		<button type="button" class="btn btn-danger" id="delete-user-confirm-{{ $id }}" onclick="clickDeleteBtnHandler({{ $id }})">Confirm</button>
	  </div>
	</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->