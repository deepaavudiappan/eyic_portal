@extends('layouts.login-master')

@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
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
	</div>
</div>
{{ Form::close() }}	
</div>
@stop
