<?php

class MentorOperations extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| MentorOperations Controller
	|--------------------------------------------------------------------------
	|
	|	Route::match(array('GET', 'POST'), '/addprojdetail', array(
	|		'as'	=>	'addprojectdetail',
	|		'uses'	=>	'eYIC\MentorOperations@addProjectDetails'
	|	));
	|	Route::match(array('GET', 'POST'), '/addprojdetailLand', array(
	|		'as'	=>	'addprojectdetailland',
	|		'uses'	=>	'eYIC\MentorOperations@eyicMentorLand'
	|	));
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = "MentorOperations";
	/*
	|-------------------------------------------------------------------------
	| Function:		eyicMentorLand
	| Input:		Null
	| Output:		
	| Logic:		Landing page for eYIC Mentor
	|
	*/
	public function eyicMentorLand(){
		//Auth
		//Pull up Project Name
		//Display the view
		return View::make('eyic.mentor.addProjDtl');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		addProjectDetails
	| Input:		Null
	| Output:		
	| Logic:		Add details of the project
	|
	*/
	public function addProjectDetails(){
		$thisMethod = self::$thisClass . ' -> addProjectDetails -> ';
		$emailSubj = 'eYIC Invite';
		//Authorize

		//Get project id
		$proj_id = 1;
		$mentor_name = 'XYZ';
		$proj_title = 'TEMP';
		
		$rules = [	'std1_email'	=>	'required|email',
		'std2_email'	=>	'required|email',
		'std3_email'	=>	'email',
		'std4_email'	=>	'email'];

		$messages = [	'std1_email.required'	=>	'Student Coordinator email id is compulsory',
		'std1_email.email'		=>	'Student Coordinator email id is not in proper format',
		'std2_email.required'	=>	'2nd student email id is compulsory',
		'std2_email.email'		=>	'2nd student email id is not in proper format',
		'std3_email.email'		=>	'3nd student email id is not in proper format',
		'std4_email.email'		=>	'4nd student email id is not in proper format',
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()){
			return Redirect::to('addprojdetailLand')->withErrors($validator)->withInput(Input::all());
		}
		$sc_email = Input::get('std1_email');
		$std2_email = Input::get('std2_email');
		$std3_email = Input::get('std3_email');
		$std4_email = Input::get('std4_email');
		$stdArray = [];

		//begining DB transaction
		DB::beginTransaction();
		try{
			$scpassword = str_random(10);
			$std2_pwd = str_random(10);
			$std3_pwd = str_random(10);
			$std4_pwd = str_random(10);

			$curStd_login = new Login;
			$curStd_login->username = $sc_email;
			$curStd_login->password = Hash::make($scpassword);
			$curStd_login->role = 3;

			if(!$curStd_login->save()){
				throw new Exception("Failed to save users login");
			}

			$scStd = [];
			$scStd['user_id'] = $curStd_login->id;
			$scStd['project_id'] = $proj_id;
			$scStd['email_id'] = $sc_email;
			$scStd['role'] = 2;
			array_push($stdArray, $scStd);

			$curStd_login = new Login;
			$curStd_login->username = $std2_email;
			$curStd_login->password = Hash::make($std2_pwd);
			$curStd_login->role = 3;

			if(!$curStd_login->save()){
				throw new Exception("Failed to save users login");
			}

			$scStd2 = [];
			$scStd2['user_id'] = $curStd_login->id;
			$scStd2['project_id'] = $proj_id;
			$scStd2['email_id'] = $std2_email;
			$scStd2['role'] = 1;
			array_push($stdArray, $scStd2);

			if(!empty($std3_email)){

				$curStd_login = new Login;
				$curStd_login->username = $std3_email;
				$curStd_login->password = Hash::make($std3_pwd);
				$curStd_login->role = 3;

				if(!$curStd_login->save()){
					throw new Exception("Failed to save users login");
				}

				$scStd3 = [];
				$scStd3['user_id'] = $curStd_login->id;
				$scStd3['project_id'] = $proj_id;
				$scStd3['email_id'] = $std3_email;
				$scStd3['role'] = 1;
				array_push($stdArray, $scStd3);
			}
			if(!empty($std4_email)){
				$curStd_login = new Login;
				$curStd_login->username = $std4_email;
				$curStd_login->password = Hash::make($std4_pwd);
				$curStd_login->role = 3;

				if(!$curStd_login->save()){
					throw new Exception("Failed to save users login");
				}

				$scStd4 = [];
				$scStd4['user_id'] = $curStd_login->id;
				$scStd4['project_id'] = $proj_id;
				$scStd4['email_id'] = $std4_email;
				$scStd4['role'] = 1;
				array_push($stdArray, $scStd4);
			}

			if(EyicStudentsDtls::insert($stdArray)){
				Log::debug($thisMethod . "Added student details successfully");
			}
			else{
				Log::debug($thisMethod . "Throwing exception for unable to save the student details");
				throw new Exception('Unable to save student details');
			}
			DB::commit();

			Mail::queue('emails.eyic.student_invite',  array('username'	=>	$sc_email, 
				'pwd' => $scpassword, 'mentor' => $mentor_name, 'proj' => $proj_title), function($message) use($sc_email, $emailSubj)
			{
				$message->from(EYIC_FROM_EMAIL, EYIC_FROM_NAME);
				$message->to($sc_email)->subject($emailSubj);
			});
			Mail::queue('emails.eyic.student_invite',  array('username'	=>	$std2_email, 
				'pwd' => $std2_pwd, 'mentor' => $mentor_name, 'proj' => $proj_title), function($message) use($std2_email, $emailSubj)
			{
				$message->from(EYIC_FROM_EMAIL, EYIC_FROM_NAME);
				$message->to($std2_email)->subject($emailSubj);
			});
			if(!empty($std3_email)){
				Mail::queue('emails.eyic.student_invite', array('username'	=>	$std3_email, 
					'pwd' => $std3_pwd, 'mentor' => $mentor_name, 'proj' => $proj_title), function($message) use($std3_email, $emailSubj)
				{
					$message->from(EYIC_FROM_EMAIL, EYIC_FROM_NAME);
					$message->to($std3_email)->subject($emailSubj);
				});
			}
			if(!empty($std4_email)){
				Mail::queue('emails.eyic.student_invite', array('username'	=>	$std4_email, 
					'pwd' => $std4_pwd, 'mentor' => $mentor_name, 'proj' => $proj_title), function($message) use($std4_email, $emailSubj)
				{
					$message->from(EYIC_FROM_EMAIL, EYIC_FROM_NAME);
					$message->to($std4_email)->subject($emailSubj);
				});
			}
		}
		catch (Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$msgs = $validator->errors();
			$messages = ['Unable to save the information. Please contact helpdesk@e-yantra.org via email about the issue'];
			return Redirect::to('addprojdetailLand')->withErrors($messages)->withInput(Input::all());
		}
		//Store the student details and send email
		$messages = ['Successfully stored'];
		return Redirect::to('addprojdetailLand')->withErrors($messages);
	}
}