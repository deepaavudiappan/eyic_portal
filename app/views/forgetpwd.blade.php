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

	{{ Form::open(array('class'=>'form-signin','role'=>'form', 'url' => 'forgetPwd')) }}	
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Forget Password</h3>
		</div>
		<div class="panel-body">
        	     
        		<div class="form-group" @if ($errors->has('username')) has-error @endif >
				<label class="control-label" for="lbl_username">Email Id :</label>
				<input type="text" id="username"  class="form-control" name="username" placeholder="" value="{{ Input::old('username') }}"/>
				@if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }} </p>@endif
			</div>		        
                	<div class="row">
				<div class="col-md-12 text-center">
        				<button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
				</div>
			</div>
		
		</div>
	</div>
	{{ Form::close() }}	
</div>
@stop
