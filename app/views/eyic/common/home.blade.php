@extends('layouts.master')
@section('styles')
@stop

@section('content')

<table class="table table-striped">
	  <tr>
	  	<th colspan="2">
	  		<h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $teacherDetail->name }}</h3>
	  	</th>
	  </tr>
	  <tr>
		<td>COLLEGE NAME</td>
		<td><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {{ $teacherDetail->college }}</td>		
	  </tr>
	  <tr>
		<td>E-MAIL ID</td>
		<td><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> {{ $teacherDetail->emailid }}</td>		
	  </tr>
	  <tr>
		<td>CONTACT</td>
		<td><span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span> {{ $teacherDetail->contact_num }}</td>		
	  </tr>
	  <tr>
		<td>DEPARTMENT</td>
		<td><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> {{ $teacherDetail->department }}</td>		
	  </tr>
	  <tr>
		<td>DESIGATION</td>
		<td><span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> {{ $teacherDetail->designation }}</td>		
	  </tr>
</table>
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