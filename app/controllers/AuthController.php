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

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = "AuthController";

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
					if(Auth::user()->role == 1){
							$teacherDtl = ElsiTeachersDtls::firstbyAttributes(['user_id' => Auth::id()]);
							Session::put('entityDtl', $teacherDtl);
					}else if(Auth::user()->role == 2){
							$stdDtl = ElsiStudentsDtls::firstbyAttributes(['user_id'=> Auth::id()]);
							Session::put('entityDtl', $stdDtl);
					}
					return Redirect::Route('commonHome');
				//Check user and redirect to corresponding controller 1 = teacher  2 = student 
				}else{	
					//logout also						
					return Redirect::Route('login')->withErrors(['Please Activate your account']);
				}
			}else{
				$msg = 'Please Enter correct Username and Password';				
				return Redirect::Route('login')->withErrors([$msg]);
			}
		}//end of else
	}//end of doLogin
	
	/*
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::Route('login'); // redirect the user to the login screen


		if(Auth::attempt($userdata)){
			if(Auth::user()->role == 1){
				$teacherDtl = ElsiTeachersDtls::firstbyAttributes(['user_id' => Auth::id()]);
				Session::put('entityDtl', $teacherDtl);
			}
			else if(Auth::user()->role == 2){
				$stdDtl = ElsiStudentsDtls::firstbyAttributes('user_id', Auth::id());
				Session::put('entityDtl', $stdDtl);
			}
			return Redirect::Route('commonHome');
		}
		else{
			return Redirect::Route('loginLand')->withErrors('Incorrect username or password!');
		}
	}*/
	
	public function doLogout(){
		if(Auth::check()){
			Auth::logout();
			Session::flush();
			return Redirect::Route('loginLand')->with([ MSG_VAR_SUCCESS => 'Logout successful']);
		}
		else{
			return Redirect::Route('loginLand');
		}
		//Auth::logout(); // log the user out of our application
		//return Redirect::Route('loginLand'); // redirect the user to the login screen
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

    /* This page must be accessed after login*/
    if(!Auth::check()) {
        return Redirect::Route('loginLand');
    }

		//Display the view
		return View::make('changepwd');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		changePassword
	| Input:		Null
	| Output:		Change Password 
	| Logic:		Change Password
	|
	*/
	public function changePassword(){
		
		$thisMethod = self::$thisClass . ' -> changePassword -> ';
				
		/* This page must be accessed after login*/
		if(!Auth::check()){
			return Redirect::Route('loginLand');
    }

		$username = "";
		if(Session::has('entityDtl')){
			$username = Session::get('entityDtl')['username'];
		}
		else{
			//$username = 'khalid.iitb@gmail.com';
      Log::error($thisMethod . "Exception occured! Msg: ". "Session not set");
      $messages = ['Session not set. Login again.'];
      return Redirect::Route('loginLand')->withErrors($messages);
		}

		/* Validation of data */
		$rules = [	
		'oldPassword'		=>	'required',
		'newPassword'		=>	'required',
		'repeatPassword'	=>	'required'];

		$messages = [	
		'oldPassword.required'		=>	'Current Password is compulsory.',
		'newPassword.required'		=>	'New Password is compulsory.',
		'repeatPassword.required'	=>	'Confirm Password is compulsory.'];

		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()){
			return Redirect::Route('changePwdLand')->withErrors($validator)->withInput(Input::all());
		}

		/* Check newPassword and repeatPassword are Equal. Is some better approach available? */
		$newpassword = Input::get('newPassword');
		$repeatpassword = Input::get('repeatPassword');
		if ($newpassword != $repeatpassword){
			$messages = ['New Password, Confirm Password doesn\'t match.'];
			return Redirect::Route('changePwdLand')->withErrors($messages)->withInput(Input::all());
		}

		/* Check user exist in DB */
		$user = Login::where('username', $username)->first();
		if(!$user) { 
			Log::error($thisMethod . "This email is not registered with us.");
			$messages = ['Please Login again.'];
			return Redirect::Route('loginLand')->withErrors($messages);
		}

		/* Check currentpassword and storedpassword match. Use Hash */
		$oldpassword = Input::get('oldPassword');
		if(!(Hash::check($oldpassword, $user->password))) { 
			$messages = ['Incorrect Current Password.'];
			return Redirect::Route('changePwdLand')->withErrors($messages)->withInput(Input::all());
		}

		//$user->password = $newpassword;
		$user->password = Hash::make($newpassword);
		
		DB::beginTransaction();
		try {
			if(!$user->save()){
				throw new Exception('Unable to save new password to Users table');
			}
			DB::commit();
			Log::debug($thisMethod . "Password updated.");
		}
		catch (Exception $e) {
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return Redirect::route('changePwdLand')->withErrors($messages)->withInput(Input::all());
			
		}

		//Display Success
		$messages = ['Password changed. Please login again.'];
		return Redirect::route('loginLand')->withErrors($messages);
		
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		forgetPasswordLand
	| Input:		Null
	| Output:		Generate View for Forget Password 
	| Logic:		Generate View for Forget Password
	|
	*/
	public function forgetPasswordLand(){
		
		//Display the view
		return View::make('forgetpwd');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		forgetPassword
	| Input:		Null
	| Output:		Forget Password 
	| Logic:		Forget Password
	|
	*/
	public function forgetPassword(){
		
		$thisMethod = self::$thisClass . ' -> forgetPassword -> ';
				
		/* Validation of data */
		$rules = [	
		'username'		=>	'required|email'
		];

		$messages = [	
		'username.required'		=>	'Username is compulsory.',
		'username.email'		=>	'Email is not in proper format.',
		];

		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()) {
			return Redirect::Route('forgetPwdLand')->withErrors($validator)->withInput(Input::all());
		}

		/* Validation of username/emailid */
		$username = Input::get('username');
		$user = Login::where('username', $username)->first();
		if(!$user) { 
			$messages = ['This email is not registered with us.'];
			return Redirect::Route('forgetPwdLand')->withErrors($messages)->withInput(Input::all());
		}

		/* Generate token and store in DB */
		$token = md5(str_random(50));
		$user->token = $token;
		$user->active = 0;

		DB::beginTransaction();
		try {
			if(!$user->save()){
				throw new Exception('Unable to save token to users_login table.');
			}
			
			/* send a nice email to user */
			$emailSubj = "eYIC : Reset password";
			Mail::queue('emails.eyic.setpassword_invite',  array('username'	=> $username, 'token' => $token), function($message) use($username, $emailSubj)
			{
				$message->from(EYIC_FROM_EMAIL, EYIC_FROM_NAME);
				$message->to($username)->subject($emailSubj);
			});

			DB::commit();
			Log::debug($thisMethod . "Token updated.");
		}
		catch (Exception $e) {
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return Redirect::route('forgetPwdLand')->withErrors($messages)->withInput(Input::all());
		}

		//Display Success
		$mesgstr = "A mail containing further instructions has been sent to ".$username.". Please check it to reset your password.";
		$messages = [$mesgstr];
		return Redirect::route('forgetPwdLand')->withErrors($messages);
		
		
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		Validate username, token before allowing to set new password.
	| Input:		Null
	| Output:		Validate username, token before allowing to set new password.  
	| Logic:		Validate username, token before allowing to set new password. 
	|
	*/
	public function validateToken($username, $token) {

		$thisMethod = self::$thisClass . ' -> validateToken -> ';

		/* Validate username and token */

		$userrecord = Login::where('username', $username)->first();
		if(!$userrecord || ($userrecord->token != $token)) {
			// Log Error.
			$messages = 'Incorrect emailid or token.';			
			Log::error($thisMethod . $messages);
			// Redirect to login page with error message.
			$messages = ['Unable to set new password. Please contact us at helpdesk@e-yantra.org via email about the issue']; 				return Redirect::Route('loginLand')->withErrors($messages);
		}
		
		/* Emailid, Token verified. redirect user to set password page. */	
		return Redirect::Route('setPwdLand', array('username' => $username));
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		setPasswordLand
	| Input:		Null
	| Output:		Generate View to set new password incase of Forget Password 
	| Logic:		Generate View to set new password incase of Forget Password 
	|
	*/
	public function setPasswordLand($username) {
			return View::make('setpwd')->with('username', $username);
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		setPassword
	| Input:		Null
	| Output:		set new password incase of Forget Password  
	| Logic:		set new password incase of Forget Password 
	|
	*/
	public function setPassword($username){
		
		$thisMethod = self::$thisClass . ' -> setPassword -> ';

		/* Validation of input data */
		$rules = [	
		'newPassword'		=>	'required',
		'repeatPassword'	=>	'required'];

		$messages = [	
		'newPassword.required'		=>	'Password is compulsory.',
		'repeatPassword.required'	=>	'Confirm Password is compulsory.'];

		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()){
			return Redirect::Route('setPwdLand')->withErrors($validator)->withInput(Input::all());
		}

		/* Check newPassword and repeatPassword are Equal. */
		$newpassword = Input::get('newPassword');
		$repeatpassword = Input::get('repeatPassword');
		if ($newpassword != $repeatpassword){
			$messages = ['Password, Confirm Password doesn\'t match.'];
			return Redirect::Route('setPwdLand')->withErrors($messages)->withInput(Input::all());
		}

		/* Save new password in database */
		$userrecord = Login::where('username', $username)->first();
		$userrecord->password = Hash::make($newpassword);
		$userrecord->token = Null;
		$userrecord->active = 1;
		
		DB::beginTransaction();
		try {
			if(!$userrecord->save()){
				throw new Exception('Unable to set new password in users_login table');
			}
			DB::commit();
			Log::debug($thisMethod . "Password set.");
		}
		catch (Exception $e) {
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return Redirect::route('loginLand')->withErrors($messages)->withInput(Input::all());
		}

		//Display Success
		$messages = ['Password saved. Please Login.'];
		return Redirect::route('loginLand')->withErrors($messages);		
	}
	
}
