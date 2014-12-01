@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Home</h3>
	</div>
	<div class="panel-body">
		{{ HTML::linkRoute('addprojectdetailland', 'Enter Project Details', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#home').addClass('active');
	});
</script>
@stop