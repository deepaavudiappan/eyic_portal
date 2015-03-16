@extends('layouts.master')
@section('styles')
@stop

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">
		<h2 class="panel-title text-center">Stage 2 - Code</h2>
	</div>
	<div class="panel-body text-justify">
		@if(isset($error))
		@if(!empty($error))
		<div class="alert alert-danger">
			{{$error}}
		</div>
		@endif
		@endif
		<div class="alert alert-danger">
			The last date to submit Stage 2 - Code is: Midnight, March 15th, 2015
		</div>
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Upload Stage 2 Code</h3>
			</div>
			<div class="panel-body">
				@if(Auth::user()->role == 2)
				@if(Session::has('entityDtl'))
				@if(Session::get('entityDtl')->role == 1)
				@if($proj_dtls->project_status == 6)
				<div class="alert alert-success">
					You have already submitted Stage 2 code. You are allowed to resubmit the code till the last date of 19th March.
				</div>
				@endif
				@if($proj_dtls->project_status == 3 || $proj_dtls->project_status == 6)
				<div class="alert alert-danger">
					<ol>
						<li>Only zip file is allowed</li>
						<li>Maximum Size: 25 MB</li>
						<li>Last Date: 19th March</li>
					</ol>
				</div>
				<div class="row">
					<div class="col-md-12 text-left">
						{{ Form::open(array('route' => 'eyicStage2Code', 'files' => true, 'onsubmit' => 'uploadMsg(this)'))}}
						<label>Stage 2 Code :</label>{{ Form::file('stage2Code','',array('id'=>'stage2Code','class'=>'')) }}<br/><hr/>
					</div>
					<div class="modal fade" id="prjPropUpld" tabindex="-1" role="dialog" aria-labelledby="task1UpldLbl" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">

								<div class="modal-header">
									<h4 class="modal-title" id="prjPropUpld">Upload Stage 2 Code</h4>
								</div>

								<div class="modal-body">
									<div id="uploadMsg" class="alert alert-danger">Your file is being uploaded. Please do not click refresh, back or forward button!</div>
								</div>
								<div class="modal-footer"> 
								</div>
							</div>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-md-12 text-center">
							{{ Form::submit('Upload', array('class'=>'btn btn-primary')) }}
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
			@else
			<div class="alert alert-danger">Project not shortlisted for Stage 2! Sorry!</div>
			@endif
			@else
			<div class="alert alert-danger">Only the Student representative can upload the Stage 2 Code. Please ask your project team's Student Representative to upload the Stage 2 Code.</div>
			@endif
			@else
			<div class="alert alert-danger">Only the Student representative can upload the Stage 2 Code. Please ask your project team's Student Representative to upload the Stage 2 Code.</div>
			@endif
			@else
			<div class="alert alert-danger">Only the Student representative can upload the Stage 2 Code. Please ask your project team's Student Representative to upload the Stage 2 Code.</div>
			@endif
		</div>

		<p>Please upload the Documented code for your implemented solution for Stage 2: A sample Coding Standard has been provided under the <strong>“Coding Standard”</strong> menu on the left side bar and should be used to document your project code.</p>
		<br/>
		<p>Your Stage 2 implementation will also be evaluated on the basis of the quality of the code submitted.</p>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready( function() {
		$('#stage2code').addClass('active');
	});
	function displayInst(){
		$('#stage2LinkMdl').modal('show');
		return true;
	}
	function uploadMsg(){
		$('#prjPropUpld').modal('show');
		return true;
	}
</script>
@stop
