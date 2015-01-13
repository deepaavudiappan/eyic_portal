@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Send Invite Data</h3>
	</div>
	<div class="panel-body">
		{{ HTML::linkRoute('adminHome', 'back to home', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/><br/>

		{{ Form::open(array('route' => 'wrkshp', 'method' => 'POST')) }}
		{{ Form::select('regions', $regions,[], ['class' => 'form-control'] );}}<br/><br/>
		<label style="width:250px;">Workshop Date:</label><input type="text" name="date" /><br/>
		<label style="width:250px;">Venue:</label><input type="text" name="venue" /><br/>
		<label style="width:250px;">Nodal Center Coordinator Name:</label><input type="text" name="nc_coor" /><br/>
		<label style="width:250px;">Contact Number:</label><input type="text" name="contact_num" /><br/><br/>
		{{ Form::submit('Invite LOI Colleges!' , array('class' => 'btn btn-primary', 'name' => 'loi_invite')) }}<br/><br/>
		{{ Form::submit('Invite Other Colleges' , array('class' => 'btn btn-danger', 'name' => 'fcfs_invite')) }}
		{{ Form::close()}}

	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#template').addClass('active');
	});
</script>
@stop