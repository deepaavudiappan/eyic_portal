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

		if(Auth::attempt($userdata)){
			if(Auth::user()->role == 1){
				$teacherDtl = ElsiTeachersDtls::firstbyAttributes(['user_id' => Auth::id()]);
				Session::put('entityDtl', $teacherDtl);
			}
			else if(Auth::user()->role == 2){
				$stdDtl = ElsiStudentDtls::firstbyAttributes('user_id', Auth::id());
				Session::put('entityDtl', $stdDtl);
			}
			return Redirect::Route('commonHome');
		}
		else{
			return Redirect::Route('loginLand')->withErrors('Incorrect username or password!');
		}
	}
	
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

		if(Session::has('entityDtl')){
			$username = Session::get('entityDtl')['username'];
		}
		else{
			$username = 'kiran';
		}

		/* Validation of data */
		$rules = [	
		'oldPassword'		=>	'required',
		'newPassword'		=>	'required',
		'repeatPassword'	=>	'required'];

		$messages = [	
		'oldPassword.required'		=>	'Current Password is compulsory',
		'newPassword.required'		=>	'New Password is compulsory',
		'repeatPassword.required'	=>	'Confirm Password is compulsory'];

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

		/* Check currentpassword and storedpassword match. Use Hash */
		$oldpassword = Input::get('oldPassword');
		$user = Login::where('username', $username)->first();
		if($oldpassword != $user->password) {
			$messages = ['Incorrect Current Password.'];
			return Redirect::Route('changePwdLand')->withErrors($messages)->withInput(Input::all());
		}

		$user->password = $newpassword;
		
		DB::beginTransaction();
		try {
			if(!$user->save()){
				throw new Exception('Unable to save new password to Users table');
			}
			DB::commit();
			Log::success($thisMethod . "Password updated.");
		}
		catch (Exception $e) {
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
		}

		//Store the student details and send email
		$messages = ['Successfully saved'];
		return Redirect::route('changePwdLand')->withErrors($messages);
		
	}
	
}
