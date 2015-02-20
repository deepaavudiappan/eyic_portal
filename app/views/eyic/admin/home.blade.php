@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Home</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">eYRTC Admin Section</h3>
					</div>
					<div class="panel-body">
						<p>Nothing here as of now!</p>						
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">eLSI Workshops Admin Section</h3>
					</div>
					<div class="panel-body">
						{{ HTML::linkRoute('invite_data', 'Send Workshop Invites', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/><br/>
						{{ HTML::linkRoute('rqs_loiclg', 'Send equipment list', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/>
					</div>
				</div>				
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">eLSI College Status Admin Section</h3>
					</div>
					<div class="panel-body">
						{{ HTML::linkRoute('rqs_loiclglist', 'College LOI Status', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">eYIC Admin Section</h3>
					</div>
					<div class="panel-body">
						{{ HTML::linkRoute('setupCoorAccs', 'Setup Coordinators account (email is sent)', [], array('class'	=>	'btn btn-primary', 'role' => 'button')); }}<br/>
					</div>
				</div>
			</div>
		</div>
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