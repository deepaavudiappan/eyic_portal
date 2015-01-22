@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="alert alert-danger">
	Project Proposal can now be uploaded by the Student Representative by clicking on the "Project Proposal" tab on the left side bar.
</div>
<table class="table table-striped">
	<tr>
		<th colspan="2">
			<h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $studentDetail->name }}</h3>
		</th>
	</tr>
	<tr>
		<td>COLLEGE NAME</td>
		<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {{ $studentDetail->college }}</td>		
	</tr>
	<tr>
		<td>E-MAIL ID</td>
		<td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ $studentDetail->email_id }}</td>		
	</tr>
	<tr>
		<td>CONTACT</td>
		<td><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> {{ $studentDetail->contact_num }}</td>		
	</tr>
	<tr>
		<td>Address</td>
		<td><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $studentDetail->address }}</td>		
	</tr>	 
</table>	
<div class="row">
	<div class="col-md-12 text-center">
		{{ HTML::linkRoute('changePwdLand', 'Change Password', [], ['class'	=> 'btn btn-primary']) }}
	</div>
</div>
@stop

@section('notice')

<div class="panel panel-default">
	<div class="panel-heading">Notice 1</div>
	<div class="panel-body">
		Please put notice 1 here
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">Notice 2</div>
	<div class="panel-body">
		Please put notice 2 here
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#profileLk').addClass('active');
	});
</script>
@stop