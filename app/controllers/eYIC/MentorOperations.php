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
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 1){
			return Redirect::Route('commonHome');
		}

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
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 1){
			return Redirect::Route('commonHome');
		}
		$thisMethod = self::$thisClass . ' -> addProjectDetails -> ';
		$emailSubj = 'eYIC Invite';

		/*################################################*/
		//Get project id
		$proj_id = 1;
		$proj_title = 'TEMP';
		
		$mentor_name = 'XYZ';
		if(Session::has('entityDtl')){
			$mentor_name = Session::get('entityDtl')['name'];
		}
		else{
			$mentor_name = '{Mentor Name not provided}';
		}

		$clg_id = Auth::user()->clg_id;
		
		$rules = [	'std1_email'	=>	'required|email',
		'std2_email'	=>	'required|email',
		'std3_email'	=>	'required|email',
		'std4_email'	=>	'email'];

		$messages = [	'std1_email.required'	=>	'Student Coordinator email id is compulsory',
		'std1_email.email'		=>	'Student Coordinator email id is not in proper format',
		'std2_email.required'	=>	'2nd student email id is compulsory',
		'std2_email.email'		=>	'2nd student email id is not in proper format',
		'std3_email.required'	=>	'3rd student email id is compulsory',
		'std3_email.email'		=>	'3nd student email id is not in proper format',
		'std4_email.email'		=>	'4nd student email id is not in proper format',
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()){
			return Redirect::Route('addprojectdetailland')->withErrors($validator)->withInput(Input::all());
		}
		$sc_email = Input::get('std1_email');
		$std2_email = Input::get('std2_email');
		$std3_email = Input::get('std3_email');
		$std4_email = Input::get('std4_email');
		
		//Check if student already registered
		$res = ElsiStudentsDtls::whereIn('email_id', [$sc_email, $std2_email, $std3_email, $std4_email])->get();

		if(count($res) != 0){

			$str = 'Student already registered with another project: ';
			foreach($res as $curStd){
				$str .= $curStd->email_id . ' ';
			}
			return Redirect::route('addprojectdetailland')->withErrors($str)->withInput(Input::all());
		}
		//begining DB transaction
		DB::beginTransaction();
		try{

			$scpassword = str_random(10);
			$std2_pwd = str_random(10);
			$std3_pwd = str_random(10);
			$std4_pwd = str_random(10);

			$curStd_login = new Login;
			$curStd_login->username = $sc_email;
			$curStd_login->active = 1;
			$curStd_login->password = Hash::make($scpassword);
			$curStd_login->clg_id = $clg_id;
			$curStd_login->role = 2;

			if(!$curStd_login->save()){
				throw new Exception("Failed to save users login");
			}

			$scStd = new ElsiStudentsDtls;
			$scStd->user_id = $curStd_login->id;
			$scStd->email_id = $sc_email;
			$scStd->role = 1;
			
			if(!$scStd->save()){
				throw new Exception("Failed to save student details");
			}

			$curStd_login = new Login;
			$curStd_login->username = $std2_email;
			$curStd_login->active = 1;
			$curStd_login->password = Hash::make($std2_pwd);
			$curStd_login->clg_id = $clg_id;
			$curStd_login->role = 2;

			if(!$curStd_login->save()){
				throw new Exception("Failed to save users login");
			}

			$scStd2 = new ElsiStudentsDtls;
			$scStd2->user_id = $curStd_login->id;
			$scStd2->email_id = $std2_email;
			$scStd2->role = 2;
			
			if(!$scStd2->save()){
				throw new Exception("Failed to save student details");
			}			

			if(!empty($std3_email)){

				$curStd_login = new Login;
				$curStd_login->username = $std3_email;
				$curStd_login->active = 1;
				$curStd_login->password = Hash::make($std3_pwd);
				$curStd_login->clg_id = $clg_id;
				$curStd_login->role = 2;

				if(!$curStd_login->save()){
					throw new Exception("Failed to save users login");
				}

				$scStd3 = new ElsiStudentsDtls;
				$scStd3->user_id = $curStd_login->id;
				$scStd3->email_id = $std3_email;
				$scStd3->role = 2;
				
				if(!$scStd3->save()){
					throw new Exception("Failed to save student details");
				}
			}
			if(!empty($std4_email)){
				$curStd_login = new Login;
				$curStd_login->username = $std4_email;
				$curStd_login->active = 1;
				$curStd_login->password = Hash::make($std4_pwd);
				$curStd_login->clg_id = $clg_id;
				$curStd_login->role = 2;

				if(!$curStd_login->save()){
					throw new Exception("Failed to save users login");
				}

				$scStd4 = new ElsiStudentsDtls;
				$scStd4->user_id = $curStd_login->id;
				$scStd4->email_id = $std4_email;
				$scStd4->role = 2;
				
				if(!$scStd4->save()){
					throw new Exception("Failed to save student details");
				}	
			}
			
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

			DB::commit();
		}
		catch (Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return Redirect::route('addprojectdetailland')->withErrors($messages)->withInput(Input::all());
		}
		//Store the student details and send email
		$messages = 'Successfully stored';
		return Redirect::route('addprojectdetailland')->with(['success' => $messages]);
	}
}
