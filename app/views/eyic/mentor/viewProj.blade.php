@extends('layouts.master')
@section('styles')
@stop

@section('content')

<table class="table table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th class="col-md-2">Project Name</th>
			<th class="col-md-6">Project Status</th>
			<th class="col-md-4">Scores</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach ($projectDetails as $key => $project)
		<tr>
			<td>{{$key + 1 }}</td>
			<td>{{$project['project']['proj_name']}}</td>
			<td>@if     ($project['project']['project_status'] == 0)
				<p class="text-danger">{{'Project Registration Pending with Mentor'}}</p>
				@elseif	($project['project']['project_status'] == 1)
				<p class="text-danger">{{'Project Registration Pending with Student'}}</p>
				@elseif($project['project']['project_status'] == 2)
				<p class="text-success">{{'Project Proposal Uploaded! Evaluation in process'}}</p>
				@elseif($project['project']['project_status'] == 3)
				<p class="text-success">{{'Congratulations! Your project has been selected for Stage 2 - Implementation. For details regarding Stage 2, please visit “Stage 2” tab on the left side menu.'}}</p>
				@elseif($project['project']['project_status'] == 4)
				<p class="text-danger">{{'We regret to inform you that your project was not selected for Stage 2 – Implementation. We received a lot of good project proposals but could not select all of them owing to our capacity constraints. We look forward to continued interactions with you in the future.'}}</p>
				@elseif($project['project']['project_status'] == 5)
				<p class="text-danger">{{'We regret to inform you that your project was not selected for Stage 2 – Implementation since the project registration was not completed'}}</p>
				@elseif($project['project']['project_status'] == 6)
				<p class="text-success">{{'Submitted Stage 2 Implementation'}}</p>
				@endif
			</td>
			<td><table class="table table-bordered">
				@if($project['project']['project_status'] == 3 || $project['project']['project_status'] == 4)
				<tr><td>Originality Marks:</td><td>{{$project['proj_eval']['final_orig_marks']}}/10</td></tr>
				<tr><td>Originality Remarks:</td><td>{{$project['proj_eval']['final_orig_remarks']}}</td></tr>
				<tr><td>Idea Marks:</td><td>{{$project['proj_eval']['final_idea_marks']}}/10</td></tr>
				<tr><td>Idea Remarks:</td><td>{{$project['proj_eval']['final_idea_remarks']}}</td></tr>
				<tr><td>Score Marks:</td><td>{{$project['proj_eval']['final_scope_marks']}}/10</td></tr>
				<tr><td>Score Remarks:</td><td>{{$project['proj_eval']['final_scope_remarks']}}</td></tr>
				<tr><td>Status:</td><td>@if($project['project']['project_status'] == 3) Accepted @else Rejected @endif</td></tr>
				@endif
			</table></td>
			<td>
				@if($project['project']['project_status'] == 0)
				{{ Form::open(array('route' => 'addprojectdetailland', 'method' => 'POST')) }}
				{{ Form::hidden('invisible', $project['project']['id'], array('name' => 'proj_id')) }}
				<button class="btn btn-sm btn-primary btn-block" type="submit">Add Team Members</button>
				{{ Form::close() }}
				@endif					
			</td>
		</tr>	
		@endforeach
	</tbody>
</table>

@if (count($projectDetails) === 4)
<p>Number Of projects: {{count($projectDetails)}}</p>
@else
<p>Number Of projects: {{count($projectDetails)}}</p>		
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
		$('#menProLk').addClass('active');
	});
</script>
@stop