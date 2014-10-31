<?php

class LabInchargeOperations extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| LabInchargeOperations Controller
	|--------------------------------------------------------------------------
	|
	|	Route::match(array('GET', 'POST'), '/labin/regProjLand', array(
	|		'as'	=>	'regProjLand',
	|		'uses'	=>	'LabInchargeOperations@loadRegProj'
	|	);	
	|	
	|	Route::match(array('GET', 'POST'), '/labin/registerProj', array(
	|		'as'	=>	'registerProj',
	|		'uses'	=>	'LabInchargeOperations@registerProj'
	|	));
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = 'LabInchargeOperations';

	/*
	|-------------------------------------------------------------------------
	| Function:		loadRegProj
	| Input:		Null
	| Output:		Displays the inputs for registering new project
	| Logic:		Landing page for eYIC Lab Incharge
	|
	*/
	public function loadRegProj(){
		//Auth
		//Display the view
		return View::make('eyic.labincharge.regProj');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		registerProj
	| Input:		Project Details
	| Output:		Saves the project details
	| Logic:		Landing page for eYIC Lab Incharge
	|
	*/
	public function registerProj(){
		//Auth
		//Display the view

		$thisMethod = self::$thisClass . ' -> registerProj -> ';
		$clg_id = 1;

		$rules = [	'proj_name'	=>	'required',
		'mentor_name'	=>	'required',
		'mentor_email'	=>	'required|email'];

		$messages = [	'proj_name.required'	=>	'Project Name is compulsory',
		'mentor_name.required'		=>	'Mentor Name is compulsory',
		'mentor_name.email'		=>	'Mentor email id is not in proper format'];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()){
			return Redirect::route('regProjLand')->withErrors($validator)->withInput(Input::all());
		}

		Log::error($thisMethod . 'Validation success');
		$proj_name = Input::get('proj_name');
		$mentor_name = Input::get('mentor_name');
		$mentor_email = Input::get('mentor_email');

		$projs_reg = EyicProjectDtls::where('clg_id', $clg_id)->get();

		if(count($projs_reg) >= EYIC_PROJS_ALLOWED){
			$msg = 'Maximum allowed '. EYIC_PROJS_ALLOWED . 'projects have already been registered';
			return Redirect::route('regProjLand')->withErrors($msg)->withInput(Input::all());
		}

		DB::beginTransaction();
		try{
			//Check intigrity
			$projDtls = new EyicProjectDtls;
			$projDtls->proj_name = $proj_name;
			$projDtls->clg_id = $clg_id;

			if(!$projDtls->save()){
				throw new Exception("Failed to save project details");
			}

			$mentorPwd = str_random(10);

			$curStd_login = new Login;
			$curStd_login->username = $mentor_email;
			$curStd_login->active = 1;
			$curStd_login->password = Hash::make($mentorPwd);
			$curStd_login->clg_id = $clg_id;
			$curStd_login->role = 2;

			if(!$curStd_login->save()){
				throw new Exception("Failed to save users login");
			}

			$mentorDtls = new ElsiTeachersDtls;
			$mentorDtls->name = $mentor_name;
			$mentorDtls->emailid = $mentor_email;
			$mentorDtls->project_id = $projDtls->id;

			if(!$mentorDtls->save()){
				throw new Exception("Failed to save mentor details");
			}

			//Send email

			DB::commit();
		}
		catch (Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return Redirect::route('regProjLand')->withErrors($messages)->withInput(Input::all());
		}
		//Store the student details and send email
		$messages = ['Successfully stored'];
		return Redirect::route('regProjLand')->withErrors($messages);
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		displayRegProj
	| Input:		Null
	| Output:		Display all of the registered projects
	| Logic:		Landing page for eYIC Lab Incharge
	|
	*/
	public function displayRegProj(){
		//Auth
		$clg_id = 1;

		$projs_reg = EyicProjectDtls::where('clg_id', $clg_id)->get();

		return View::make('eyic.labincharge.dispRegProj')->with('projs', $projs_reg);
	}
}