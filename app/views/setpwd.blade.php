@extends('layouts.login-master')

<style>
	.form-signin {
    margin: 0 auto;
    max-width: 330px;
    padding: 15px;
	}
	*{
	    box-sizing: border-box;
	}
</style>
@section('styles')
@stop

@section('content')
<div class="row" style="top-margin: 50px">

@if ($errors->has())
<div class="alert alert-danger">
@foreach ($errors->all() as $error)
{{ $error; }}
@endforeach
</div>
@endif

	{{ Form::open(array('class'=>'form-signin','role'=>'form', 'url' => 'setPwd')) }}	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Set Password</h3>
		</div>
		<div class="panel-body">
        	     
			<div class="form-group" @if ($errors->has('newPassword')) has-error @endif>
				<label class="control-label" for="lbl_newPassword">Password:</label>
				<input type="password" id="newPassword" class="form-control" name="newPassword" placeholder="" value="{{ Input::old('newPassword') }}"/>
				@if ($errors->has('newPassword')) <p class="help-block">{{ $errors->first('newPassword') }} </p>@endif
			</div>
			<div class="form-group" @if ($errors->has('repeatPassword')) has-error @endif>
				<label class="control-label" for="lbl_repeatPassword">Confirm Password:</label>
				<input type="password" id="repeatPassword" class="form-control" name="repeatPassword" placeholder="" value="{{ Input::old('repeatPassword') }}"/>
				@if ($errors->has('repeatPassword')) <p class="help-block">{{ $errors->first('repeatPassword') }} </p>@endif
			</div>		        
                	<div class="row">
				<div class="col-md-12 text-center">
        				<button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
				</div>
			</div>
		
		</div>
	</div>
	{{ Form::close() }}	
</div>
@stop
