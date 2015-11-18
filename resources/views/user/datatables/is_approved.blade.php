@if ($socialites == "0")
	<p>Not Required</p>
@else
	@if ($is_approved)
		<p>Yes</p>
	@else
		<p>No</p>
	@endif
@endif