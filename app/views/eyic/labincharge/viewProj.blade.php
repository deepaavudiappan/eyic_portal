@extends('layouts.master')
@section('styles')
@stop

@section('content')

Project Details from your college:	

<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Project Name</th>
			<th>Project Status</th>
			<th>Team Members</th>          
		</tr>
	</thead>
	<tbody>
		@foreach ($projectDetails as $key => $project)
		<tr>
			<td>{{($key+1)}}</td>
			<td>{{$project['proj_name']}}</td>
			<td>@if     ($project['project_status'] == 0)
				<p class="text-danger">{{'Project Registration Pending with Mentor'}}</p>
				@elseif	($project['project_status'] == 1)
				<p class="text-danger">{{'Project Registration Pending with Student'}}</p>
				@elseif ($project['project_status'] == 2)
				<p class="text-success">{{'Project Proposal Uploaded! Evaluation in process'}}</p>
				@elseif($project['project_status'] == 3)
				<p class="text-success">{{'Cleared for Stage 2'}}</p>
				@elseif($project['project_status'] == 4)
				<p class="text-danger">{{'Rejected'}}</p>
				@elseif($project['project_status'] == 5)
				<p class="text-danger">{{'Did not complete registration'}}</p>
				@elseif($project['project_status'] == 6)
				<p class="text-success">{{'Submitted Stage 2 Implementation'}}</p>
				@elseif($project['project_status'] == 7)
				<p class="text-danger">{{'Project not selected for eYIC Finals'}}</p>
				@elseif($project['project_status'] == 8)
				<p class="text-success">{{'Project Selected for eYIC Finals!'}}</p>
				@endif		
			</td>
			<td class="text-center"><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></td>
		</tr>	
		@endforeach
	</tbody>
</table>

@if (count($projectDetails) === 4)
<p>Number Of project: {{count($projectDetails)}}</p>
@else
<p>Number Of project: {{count($projectDetails)}}</p>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Project Detail</h3>
	</div>
	<div class="panel-body">
		<div class="alert alert-danger">
			Last date to register new projects have passed!
		</div>
		<!-- {{ HTML::linkRoute('regProjLand', 'Register a Project', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }} -->
	</div>
</div>	
@endif

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
		$('#regProLk').addClass('active');
	});
</script>
@stop