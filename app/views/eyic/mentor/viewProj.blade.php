@extends('layouts.master')
@section('styles')
@stop

@section('content')

	<table class="table table-striped">
	  <thead>
	        <tr>
	          <th>#</th>
	          <th>Project Name</th>
	          <th>Project Status</th>
	          <th>Team Members</th>
	          <th></th>	          
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
					@else	($project['project_status'] == 2)
						<p class="text-success">{{'Project Proposal Uploaded! Evaluation in process'}}</p>
					@endif		
				</td>
				<td><!-- <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a> --></td>
				<td>
					@if($project['project_status'] == 0)
						{{ Form::open(array('route' => 'addprojectdetailland', 'method' => 'POST')) }}
							{{ Form::hidden('invisible', $project['id'], array('name' => 'proj_id')) }}
							<button class="btn btn-sm btn-primary btn-block" type="submit">Add Team members</button>
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