@extends('layouts.master')
@section('styles')
@stop

@section('content')
	<div class="alert alert-danger">
	The project proposal template is now available under the tab <strong>"Project Proposal"</strong> on the left side menu.
	</div>
	<div class="alert alert-danger">
	<ol>
		@if($college->phase == '2012' || $college->phase == '2013')
		<li>Deadline for the coordinator to register the project: January 17th 2015</li>
		<li>Deadline for the project team to upload the project proposal as per the template: January 23rd 2015</li>
		@else
		<li>Deadline for the coordinator to register the project: January 24th 2015</li>
		<li>Deadline for the project team to upload the project proposal as per the template: January 31st 2015</li>
		@endif
	</ol>
	</div>
	@if($teacherDetail->coor_flag == 1 || $teacherDetail->coor_flag == 2)
	<div class="alert alert-info">
	Dear Coordinator, welcome to e-Yantra Ideas Competition 2015 Portal.<br/><br/>
	<strong>Step 1:</strong> Please read the information under the tab <strong>"Coordinator Info"</strong> on the left side menu<br/>
	<strong>Step 2:</strong> After selecting up to 4 projects to represent your college, please register the projects by clicking on the <strong>"Register Project"</strong> tab on the left side menu<br/>
	<strong>Step 3:</strong> After registering the project, the mentor is contacted to complete the registration<br/>
	<br/>
	You can check the status of all the projects registered under your college at the <strong>"Register Project"</strong> tab on the left side menu.
	</div>
	@endif
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