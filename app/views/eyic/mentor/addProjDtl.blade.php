@extends('layouts.master')
@section('styles')
@stop

@section('content')
<div class="panel panel-default" style="border:0px;">
	<h2>Add Project Details</h2><br/>
	<p>Project Name: </p><br/>
	<p>Mentor Name: </p><br/>
	<p>Mentor Email: </p><br/>
	{{ Form::open(array('route' => 'addprojectdetail', 'method' => 'POST')) }}
	<div class="form-group @if ($errors->has('std1_email')) has-error @endif">
		<label class="control-label" for="lbl_std1">Student Coordinator (1st Student) Email:</label>
		<input type="text" id="std1_email" class="form-control" name="std1_email" placeholder="example@example.com" value="{{ Input::old('std1_email') }}"/>
		@if ($errors->has('std1_email')) <p class="help-block">{{ $errors->first('std1_email') }} </p>@endif
	</div>
	<div class="form-group @if ($errors->has('std2_email')) has-error @endif">
		<label class="control-label" for="lbl_std2">2nd Student Email:</label>
		<input type="text" id="std2_email" class="form-control" name="std2_email" placeholder="example@example.com" value="{{ Input::old('std2_email') }}"/>
		@if ($errors->has('std2_email')) <p class="help-block">{{ $errors->first('std2_email') }} </p>@endif
	</div>
	<div class="form-group @if ($errors->has('std3_email')) has-error @endif">
		<label for="lbl_std3">3rd Student Email:</label>
		<input type="text" id="std3_email" class="form-control" name="std3_email" placeholder="example@example.com" value="{{ Input::old('std3_email') }}"/>
		@if ($errors->has('std3_email')) <p class="help-block">{{ $errors->first('std3_email') }} </p>@endif
	</div>
	<div class="form-group @if ($errors->has('std4_email')) has-error @endif">
		<label for="lbl_std4">4th Student Email:</label>
		<input type="text" id="std4_email" class="form-control" name="std4_email" placeholder="example@example.com" value="{{ Input::old('std4_email') }}"/>
		@if ($errors->has('std4_email')) <p class="help-block">{{ $errors->first('std4_email') }} </p>@endif
	</div>
	{{ Form::submit('Submit' , array('class' => 'btn btn-primary')) }}
	{{ Form::close() }}
</div>
@stop