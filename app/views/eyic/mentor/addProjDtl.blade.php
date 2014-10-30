@extends('layouts.master')
@section('styles')
@stop

@section('content')
<style>
	.subMenu {
		background: linear-gradient(to right, #ffffff 0%, #f4f4f4 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
		border-right: 1px solid #e7e7e7;		    
		list-style: none outside none;
		padding-top: 55px;
	}
	.subMenu li {		    
		border-top : 1px solid #e7e7e7;
		border-bottom : 1px solid #e7e7e7;
	}		
	.subMenu a {
		border-right: 1px solid #e7e7e7;
		color: #333333;
		display: block;
		margin-right: -1px;
		padding: 14px 0;
	}
	.subMenu a:hover, .subMenu .active a {
		background: no-repeat scroll left top #ffffff;
		border-right: medium none;
		color: #66bb00;
		text-decoration: none;
	}		
	.form-group.required .control-label:after {
		content:"*";
		color:red;
	}
</style>

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
	</div>
</div>
@stop