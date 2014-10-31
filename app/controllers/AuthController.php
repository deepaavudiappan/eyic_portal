<?php

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Authenticate Controller
	|--------------------------------------------------------------------------
	|
	|	Route::get('/login', 'AuthController@login');
	|
	*/

	/*
	|-------------------------------------------------------------------------
	| Function:		login
	| Input:		Null
	| Output:		Redirect to appropriate home page
	| Logic:		Used to authenticate the user and redirect to appropriate
	|				home page
	|
	*/
	public function login(){
		$us = 'sad@njk.com';
		$pwd = 'bkm012xt';

		if(Auth::attempt(['username'=> $us, 'password'=>$pwd])){
			Log::error("Success!!");
		}
		else{
			Log::error("Failed");
		}

	}

}