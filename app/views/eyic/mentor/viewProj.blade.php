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
			<th>Scores</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	{{$projectDetails}}
	<?php print_r(projectDetails);	?>
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