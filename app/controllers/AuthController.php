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
	public function doLogin(){
			
		$userdata = array(
				'username' 	=> Input::get('inputEmail'),
				'password' 	=> Input::get('inputPassword')
		);

		if(Auth::attempt($userdata)){
			return Auth::user();
		}
		else{
			return Redirect::to('login');
		}

	}
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('login'); // redirect the user to the login screen
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		changePasswordLand
	| Input:		Null
	| Output:		Generate View to Change Password 
	| Logic:		Generate View to Change Password
	|
	*/
	public function changePasswordLand(){
		
		//Display the view
		return View::make('changepwd');
	}
	
	

}
