@extends('layouts.master')
@section('styles')
@stop

@section('content')

<div class="row" style="top-margin: 50px">
	<div role="navigation" class="col-md-3" style="bottom: auto; top: 0px; position: relative;">
		<ul class="subMenu nav nav-sidebar">
			<!-- <li class='active'><a href="{{ URL::to('homepage') }}">Homepage</a></li>
			<li><a href="{{ URL::to('syllabus') }}">Test Syllabus</a></li>
			<li><a href="{{ URL::to('faq') }}">FAQ</a></li>
			<li><a href="{{ URL::to('schedule') }}">Schedule</a></li> -->
		</ul>              
	</div><!--/span-->
	<div class="col-md-9" style="margin-top: 25px;">
		@if ($errors->has())
		@foreach ($errors->all() as $error)
		{{ $error }}		
		@endforeach
		@endif

		<div class="panel panel-default" style="border:0px;">
			<h2>Register New Project</h2><br/>
			{{ Form::open(array('route' => 'registerProj', 'method' => 'POST')) }}
			<div class="form-group @if ($errors->has('proj_name')) has-error @endif">
				<label class="control-label" for="lbl_projname">Project Name:</label>
				<input type="text" id="proj_name" class="form-control" name="proj_name" value="{{ Input::old('proj_name') }}"/>
				@if ($errors->has('proj_name')) <p class="help-block">{{ $errors->first('proj_name') }} </p>@endif
			</div>
			<div class="form-group @if ($errors->has('mentor_name')) has-error @endif">
				<label class="control-label" for="lbl_mentor_name">Mentor (Teacher) Name:</label>
				<input type="text" id="mentor_name" class="form-control" name="mentor_name" value="{{ Input::old('mentor_name') }}"/>
				@if ($errors->has('mentor_name')) <p class="help-block">{{ $errors->first('mentor_name') }} </p>@endif
			</div>
			<div class="form-group @if ($errors->has('mentor_email')) has-error @endif">
				<label class="control-label" for="lbl_mentor_email">Mentor (Teacher) Email ID:</label>
				<input type="text" id="mentor_email" class="form-control" name="mentor_email" placeholder="example@example.com" value="{{ Input::old('mentor_email') }}"/>
				@if ($errors->has('mentor_email')) <p class="help-block">{{ $errors->first('mentor_email') }} </p>@endif
			</div>
			{{ Form::submit('Submit' , array('class' => 'btn btn-primary')) }}
			{{ Form::close() }}
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready( function() {
		$('#regProLk').addClass('active');
	});
</script>
@stop