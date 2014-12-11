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
  {{ Form::open(array('class'=>'form-signin', 'route' => 'login', 'method' => 'POST')) }}

  <h2 class="form-signin-heading">Please sign in</h2>        

  {{ Form::text('inputEmail', null, array('class' => 'form-control','placeholder' => 'Email Address'))}}
  {{ Form::password('inputPassword', array('class' => 'form-control','placeholder' => 'Password'))}}        
  <br/>
  {{ HTML::linkRoute('forgetPwdLand', 'Forgot Password?', [], []) }}

 <!-- <div class="checkbox">
  <label>
    <input type="checkbox" value="remember-me"> Remember me
  </label>
</div>   --><br/><br/>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>	
{{ Form::close() }}

</div> <!-- /container -->

</div>
@stop
