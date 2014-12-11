@extends('layouts.master')

@section('styles')
@stop

@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		{{ Form::open(array('class'=>'form-signin','role'=>'form', 'url' => 'changePwd')) }}	
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Change Password</h3>
			</div>
			<div class="panel-body">
				<div class="form-group" @if ($errors->has('oldPassword')) has-error @endif >
					<label class="control-label" for="lbl_oldPassword">Current Password:</label>
					<input type="password" id="oldPassword"  class="form-control" name="oldPassword" placeholder="Password" value="{{ Input::old('oldPassword') }}"/>
					@if ($errors->has('oldPassword')) <p class="help-block">{{ $errors->first('oldPassword') }} </p>@endif
				</div>
				<div class="form-group" @if ($errors->has('newPassword')) has-error @endif>
					<label class="control-label" for="lbl_newPassword">New Password:</label>
					<input type="password" id="newPassword" class="form-control" name="newPassword" placeholder="Password" value="{{ Input::old('newPassword') }}"/>
					@if ($errors->has('newPassword')) <p class="help-block">{{ $errors->first('newPassword') }} </p>@endif
				</div>
				<div class="form-group" @if ($errors->has('repeatPassword')) has-error @endif>
					<label class="control-label" for="lbl_repeatPassword">Confirm Password:</label>
					<input type="password" id="repeatPassword" class="form-control" name="repeatPassword" placeholder="Password" value="{{ Input::old('repeatPassword') }}"/>
					@if ($errors->has('repeatPassword')) <p class="help-block">{{ $errors->first('repeatPassword') }} </p>@endif
				</div>		        
				<div class="row">
					<div class="col-md-12 text-center">
						<button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{ Form::close() }}	
@stop
