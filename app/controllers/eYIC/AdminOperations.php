<?php

class AdminOperations extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| AdminOperations Controller
	|--------------------------------------------------------------------------
	|	
	|	
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = "AdminOperations";
	/*
	|-------------------------------------------------------------------------
	| Function:		makeLoginCoor
	| Input:		Null
	| Output:		
	| Logic:		Landing page for eYIC Mentor
	|
	*/
	public function makeLoginCoor(){

		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 3){
			return Redirect::Route('commonHome');
		}
		$thisMethod = self::$thisClass . ' -> makeLoginCoor -> ';
		$emailSubj = "eYIC-2015_Coordinator_Login_Details";

		DB::beginTransaction();
		try{
			$allCoors = ElsiTeachersDtls::whereIn('coor_flag', [1,2])->where(['login_created' => 0])->get();

			foreach($allCoors as $curCoor){
				$scpassword = str_random(10);
				$curStd_login = new Login;
				$curStd_login->username = $curCoor->emailid;
				$curStd_login->active = 1;
				$curStd_login->password = Hash::make($scpassword);
				$curStd_login->clg_id = $curCoor->clg_id;
				$curStd_login->role = 1;

				if(!$curStd_login->save()){
					Log::error($thisMethod . "Throwing exception for unable to make coordinator login");
					throw new Exception('Unable to save coordinator login');
				}
				$curCoor->login_created = 1;
				$curCoor->user_id = $curStd_login->id;
				
				if(!$curCoor->save()){
					Log::error($thisMethod . "Throwing exception for unable to save coordinator in teachers dtls flag update");
					throw new Exception('Unable to save coordinator in teachers flag update');
				}
				Mail::queue('emails.eyic.coord_invite',  array('username'	=>	$curCoor->emailid, 
					'pwd' => $scpassword, 'coorName' => $curCoor->name, 'clgName' => $curCoor->clg_id), function($message) use($curCoor, $emailSubj)
				{
					$message->from(EYIC_FROM_EMAIL, EYIC_FROM_NAME);
					$message->to($curCoor->emailid)->subject($emailSubj);
				});
			}

			DB::commit();
		}
		catch(Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return Redirect::route('adminHome')->withErrors($messages);
		}

		return Redirect::route('adminHome')->with(['success' => 'Setup Coordinator accounts successfully']);
	}
}