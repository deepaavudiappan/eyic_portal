@extends('layouts.master')
@section('styles')
@stop

@section('content')
	
	<table class="table table-striped">     
      <tbody>
        <tr>
          <td>Project Name:</td>
          <td><strong>{{ $projDtls['proj_name']; }}</strong></td>          
        </tr>
        <tr>
          <td>Mentor Name:</td>
          <td>{{ $tchDtls['name']; }}</td>          
        </tr>
        <tr>
          <td>Mentor Email:</td>
          <td>{{ $tchDtls['emailid']; }}</td>          
        </tr>
      </tbody>
    </table>	
    
    <div class="well well-sm text-center"><strong class="text-info"> Add Project Details </strong></div>
	{{ Form::open(array('class' => 'form-horizontal','role' => 'form', 'route' => 'addprojectdetail', 'method' => 'POST')) }}
	<input id="proj_id" name="proj_id" type="hidden" value="{{ $projDtls['id'];}}"/>	
	<div class="form-group @if ($errors->has('std1_email')) has-error @endif">
		<label class="control-label col-sm-5" for="lbl_std1">Student Representative (1st Student) Email:</label>
		<div class="col-sm-6">
			<input type="text" id="std1_email" class="form-control" name="std1_email" placeholder="example@example.com" value="{{ Input::old('std1_email') }}"/>
			@if ($errors->has('std1_email')) <p class="help-block">{{ $errors->first('std1_email') }} </p>@endif
		</div>
	</div>
	<div class="form-group @if ($errors->has('std2_email')) has-error @endif">
		<label class="control-label col-sm-5" for="lbl_std2">2nd Student Email:</label>
		<div class="col-sm-6">		
			<input type="text" id="std2_email" class="form-control" name="std2_email" placeholder="example@example.com" value="{{ Input::old('std2_email') }}"/>
			@if ($errors->has('std2_email')) <p class="help-block">{{ $errors->first('std2_email') }} </p>@endif
		</div>	
	</div>
	<div class="form-group @if ($errors->has('std3_email')) has-error @endif">
		<label class="control-label col-sm-5" for="lbl_std3">3rd Student Email:</label>
		<div class="col-sm-6">
			<input type="text" id="std3_email" class="form-control" name="std3_email" placeholder="example@example.com" value="{{ Input::old('std3_email') }}"/>
			@if ($errors->has('std3_email')) <p class="help-block">{{ $errors->first('std3_email') }} </p>@endif
		</div>	
	</div>
	<div class="form-group @if ($errors->has('std4_email')) has-error @endif">
		<label class="control-label col-sm-5" for="lbl_std4">4th Student Email:</label>
		<div class="col-sm-6">
			<input type="text" id="std4_email" class="form-control" name="std4_email" placeholder="example@example.com" value="{{ Input::old('std4_email') }}"/>
			@if ($errors->has('std4_email')) <p class="help-block">{{ $errors->first('std4_email') }} </p>@endif
		</div>	
	</div>
	
		{{ Form::submit('Submit' , array('class' => 'btn btn-primary btn-lg btn-block')) }}
	
	{{ Form::close() }}

@stop