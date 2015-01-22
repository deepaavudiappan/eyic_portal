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
		<br/><br/>
		Upload facility coming soon!

		@if(Auth::user()->role == 2)
		@if(Session::has('entityDtl'))
		@if(Session::get('entityDtl')->role == 1)
		@if($proj_dtls->project_status < 2)
		<div class="row">
			<div class="col-md-12 text-left">
				<div class="alert alert-danger text-justify">
					<ul>
						<strong>NOTE:</strong>
						<li>Only PDF file format is allowed with a maximum size of 8 MB.</li>
						<li>You can upload the project proposal only once.</li>
					</ul>
				</div>
				{{ Form::open(array('route' => 'prjPropUpload', 'files' => true, 'onsubmit' => 'uploadMsg(this)'))}}
				<div class="row text-center">
					<div class="col-md-12">
						{{ Form::file('prjProp','',array('id'=>'prjProp','class'=>'')) }}
					</div>
				</div>
				<div class="modal fade" id="prjPropUpld" tabindex="-1" role="dialog" aria-labelledby="task1UpldLbl" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">

							<div class="modal-header">
								<h4 class="modal-title" id="prjPropUpld">Upload Project Proposal</h4>
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
		<div class="alert alert-danger">Project proposal already submitted!</div>
		@endif
		@else
		<div class="alert alert-danger">Only the Student representative can upload the Project Proposal. Please ask your project team's Student Representative to upload the Project Proposal.</div>
		@endif
		@else
		<div class="alert alert-danger">Only the Student representative can upload the Project Proposal. Please ask your project team's Student Representative to upload the Project Proposal.</div>
		@endif
		@else
		<div class="alert alert-danger">Only the Student representative can upload the Project Proposal. Please ask your project team's Student Representative to upload the Project Proposal.</div>
		@endif
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">

	function uploadMsg(){

		$('#prjPropUpld').modal('show');
		return true;
	}


	$(document).ready( function() {
		$('#projPropLk').addClass('active');
	});
</script>
@stop