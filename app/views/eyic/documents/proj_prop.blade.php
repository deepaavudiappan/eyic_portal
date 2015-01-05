@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Project Proposal</h3>
	</div>
	<div class="panel-body">
		<div class="alert alert-danger">The project team is required to prepare a project proposal using the template provided below and then upload the same. The project will be evaluated based on the uploaded Project Proposal</div>
		<br/>
		{{ HTML::linkRoute('projPropDown', 'Download Project Proposal Template!', [], ['class'	=> 'btn btn-primary', 'id'	=> 'projPropDownLk']) }}
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#projPropLk').addClass('active');
	});
</script>
@stop