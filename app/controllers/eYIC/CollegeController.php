<?php

class CollegeController extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| CollegeController Controller
	|--------------------------------------------------------------------------
	|
	|	Route::match(array('GET', 'POST'), '/addCoor', array(
	|		'as'	=>	'addCoor',
	|		'uses'	=>	'CollegeController@addCoordinator'
	|	));
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = 'CollegeController';

	/*
	|-------------------------------------------------------------------------
	| Function:		addCoordinator
	| Input:		Null
	| Output:		Add college coordinator
	| Logic:		Add college coordinator
	|
	*/
	public function addCoordinator(){
		
		$clgs = ['0' => 'Select College'] + ElsiCollegeDetail::where('EYIC', 1)->lists('college_name', 'id');

		return View::make('eyic.addcoor')->with(['clgs'	=>	$clgs]);
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		addCoordinatorSave
	| Input:		Null
	| Output:		Add college coordinator save
	| Logic:		Add college coordinator save
	|
	*/
	public function addCoordinatorSave(){
		$thisMethod = self::$thisClass . ' -> addCoordinatorSave -> ';

		$rules = [	'college'	=>	'required',
		'pcoor_name'	=>	'required',
		'pcoor_email'	=>	'required|email',
		'scoor_email'	=>	'required|email',
		'scoor_name'	=>	'required'];

		$messages = [	'college.required'	=>	'Please select a college.',
		'pcoor_name.required'		=>	'Primary coordinator name is compulsory.',
		'scoor_name.required'		=>	'Secondary coordinator name is compulsory.',
		'pcoor_email.required'	=>	'Primary coordinator email id is compulsory.',
		'pcoor_email.email'		=>	'Primary coordinator email id is not in proper format.',
		'scoor_email.required'	=>	'Secondary coordinator email id is compulsory.',
		'scoor_email.email'		=>	'Secondary coordinator email id is not in proper format.'];

		$validator = Validator::make(Input::all(), $rules, $messages);

		if ($validator->fails()){
			return Redirect::Route('addCoor')->withErrors($validator)->withInput(Input::all());
		}

		if(Input::get('college') == 0){
			return Redirect::Route('addCoor')->withErrors('Please select a college')->withInput(Input::all());	
		}
		$pcoor = new ElsiCoordinator;
		$pcoor->clg_id = Input::get('college');
		$pcoor->name = Input::get('pcoor_name');
		$pcoor->email_id = Input::get('pcoor_email');
		$pcoor->type = 1;

		$scoor = new ElsiCoordinator;
		$scoor->clg_id = Input::get('college');
		$scoor->name = Input::get('scoor_name');
		$scoor->email_id = Input::get('scoor_email');
		$scoor->type = 2;

		DB::beginTransaction();
		try{
			if(!$pcoor->save()){
				throw new Exception('Unable to save primary coordinator');
			}
			if(!$scoor->save()){
				throw new Exception('Unable to save primary coordinator');	
			}
			DB::commit();
		}
		catch (Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at support@e-yantra.org via email about the issue'];
			return Redirect::route('addCoor')->withErrors($messages)->withInput(Input::all());
		}

		$messages = ['Successfully registered'];
		return Redirect::route('addCoor')->withErrors($messages)->with(['flag'=>1]);
	}
	
}
