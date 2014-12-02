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
		
		$validator = Validator::make(
				array(
				'username' 	=> Input::get('inputEmail'),
				'password' 	=> Input::get('inputPassword')
				),
				array(
					'username' => 'required|email',
					'password' => 'required'
				)
		);		
		
		if($validator->fails()){
			$messages = $validator->messages();
			return Redirect::Route('login')->withErrors($validator);				
		}else{
			if(Auth::attempt($userdata)){
				if( Auth::user()->active == 1){	
					echo "Home Profile";
					return Auth::user();
				//Check user and redirect to corresponding controller 1 = teacher  2 = student 
				}else{							
					return Redirect::Route('login')->withErrors(['Please Activate your account']);
				}
			}else{
				$msg = 'Please Enter correct Username and Password';				
				return Redirect::Route('login')->withErrors(['Please Enter correct Username and Password']);
			}
		}//end of else
	}//end of doLogin
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::Route('login'); // redirect the user to the login screen
	}

}