@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Send Lab Setup equipment list -> LOI Colleges</h3>
	</div>
	<div class="panel-body">
		{{ HTML::linkRoute('adminHome', 'back to home', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/><br/>

		{{ Form::open(array('route' => 'snd_rqs_loiclg', 'method' => 'POST')) }}
		{{ Form::select('regions', $regions,[], ['class' => 'form-control'] );}}<br/><br/>
		<label style="width:250px;">From e-mail ID:</label><input type="text" name="from_email" />
		<br/><br/>
		<div class="row">
			<div class="col-md-6">
				{{ Form::submit('Send equipment list->LOI Colleges' , array('class' => 'btn btn-primary', 'name' => 'rqs_loiclg')) }}<br/><br/>				
			</div>			
		</div>
		{{ Form::close()}}

	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#template').addClass('active');
	});
</script>
@stop