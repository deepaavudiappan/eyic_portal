@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Project Details</h3>
	</div>
	<div class="panel-body">
		@if($project['project_status'] == 7 || $project['project_status'] == 8)
		<div class="alert alert-danger">
			Please check the remarks provided for your project.
		</div>
		@endif
		<table class="table table-striped">
			<tr><td>Project Name:</td><td>{{$project['proj_name']}}</td></tr>
			<tr><td>Project Status:</td><td>
				@if ($project['project_status'] == 0)
				<p class="text-danger">{{'Project Registration Pending with Mentor'}}</p>
				@elseif	($project['project_status'] == 1)
				<p class="text-danger">{{'Project Registration Pending with Student'}}</p>
				@elseif($project['project_status'] == 2)
				<p class="text-success">{{'Project Proposal Uploaded! Evaluation in process'}}</p>
				@elseif($project['project_status'] == 3)
				<p class="text-success">{{'Congratulations! Your project has been selected for Stage 2 - Implementation. For details regarding Stage 2, please visit “Stage 2” tab on the left side menu.'}}</p>
				@elseif($project['project_status'] == 4)
				<p class="text-danger">{{'We regret to inform you that your project was not selected for Stage 2 – Implementation. We received a lot of good project proposals but could not select all of them owing to our capacity constraints. We look forward to continued interactions with you in the future.'}}</p>
				@elseif($project['project_status'] == 5)
				<p class="text-danger">{{'We regret to inform you that your project was not selected for Stage 2 – Implementation since the project registration was not completed'}}</p>
				@elseif($project['project_status'] == 6)
				<p class="text-success">{{'Submitted Stage 2 Implementation'}}</p>
				@elseif($project['project_status'] == 7)
				<p class="text-success">{{'We regret to inform you that your project was not selected for eYIC Finals. We received a lot of good implemented projects but could not select all of them owing to our capacity constraints. We look forward to continued interactions with you in the future.'}}</p>
				@elseif($project['project_status'] == 8)
				<p class="text-success">{{'Congratulations! Your project has been selected for eYIC Finals at IITB. Further details regarding accommodation and travelling will be emailed to the entire team.'}}</p>
				@elseif($project['project_status'] == 9)
				<p class="text-danger">Did not submit Stage 2 Implementation</p>
				@endif
			</td></tr>
			@if($project['project_status'] == 3 || $project['project_status'] == 4 || $project['project_status'] == 6 || $project['project_status'] == 7 || $project['project_status'] == 8 || $project['project_status'] == 9)
			<tr><td>Originality Marks:</td><td>{{$proj_eval->final_orig_marks}}/10</td></tr>
			<tr><td>Originality Remarks:</td><td>{{$proj_eval->final_orig_remarks}}</td></tr>
			<tr><td>Idea Marks:</td><td>{{$proj_eval->final_idea_marks}}/10</td></tr>
			<tr><td>Idea Remarks:</td><td>{{$proj_eval->final_idea_remarks}}</td></tr>
			<tr><td>Scope Marks:</td><td>{{$proj_eval->final_scope_marks}}/10</td></tr>
			<tr><td>Scope Remarks:</td><td>{{$proj_eval->final_scope_remarks}}</td></tr>
			@endif
			<tr><td>Stage 2 Remarks</td>
			@if($project['project_status'] == 7 || $project['project_status'] == 8)
			<td>@if($project['project_status'] == 7) Accepted @else Rejected @endif - {{$project['stg2_remark']}}</td>
			@else
			Not Applicable
			@endif
			</tr>
		</table>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#proj_dtls_stnd').addClass('active');
	});
</script>
@stop