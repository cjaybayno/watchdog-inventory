<?php
switch($status) {
	case 'PENDING':
		$labelType = 'warning';
		break;
	
	case 'PLACED':
		$labelType = 'primary';
		break;
		
	case 'RECEIVED':
		$labelType = 'success';
		break;
		
	case 'CANCEL':
		$labelType = 'danger';
		break;
};
?>

<span class='label label-{{$labelType}}'>{{$status}}</span>