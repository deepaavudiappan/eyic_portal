<?php

class StudentHomeController extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| HomeController Controller
	|--------------------------------------------------------------------------
	|	Route::match(array('GET', 'POST'), '/homecommon', array(
	|		'as'	=>	'commonHome',
	|		'uses'	=>	'HomeController@homeBifurcate'
	|	));
	|	
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = "StudentHomeController";	

	/*
	|-------------------------------------------------------------------------
	| Function:		coordinatorMentorHome
	| Input:		Null
	| Output:		
	| Logic:		coordinatorMentorHome Home page
	|
	*/
	public function studentProfile(){
		$thisMethod = self::$thisClass . ' -> studentProfile -> ';
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 2){
			return Redirect::Route('commonHome');
		}		 
		
		if(Session::has('entityDtl')){
			Log::debug($thisMethod . ' Coor_flag: ' . Session::get('entityDtl')['coor_flag'] . ' Auth:: ' . Auth::id());			
				$student = ElsiStudentsDtls::where('user_id', Auth::id())->get();
				$student = $student[0];
				$clgDtl = ElsiCollegeDetail::find($student->clg_id);				
				$student['college'] = $clgDtl['college_name'];
				//$student['college'] = "Add college_id in student table";				
				//View::share(array('title'=>'Profile','link' => 1));
				//print_r($clgDtl);
				return View::make('eyic.common.studentHome')->with(array('studentDetail' => $student));							
				//return View::make('eyic.labincharge.home')->with(array('teacherDetail'=>$teacher,'projectDetail'=>$projectDtl));					
		}else{
			return Redirect::Route('logout');
		}
		
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		studentHome
	| Input:		Null
	| Output:		
	| Logic:		Student Home page
	|
	*/
	public function studentHome(){
		$thisMethod = self::$thisClass . ' -> studentHome -> ';
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 2){
			return Redirect::Route('commonHome');
		}

		return View::make('eyic.student.home');
	}

	public function projectDetails(){
		
		$thisMethod = self::$thisClass . ' -> projectDetails -> ';
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 1){
			return Redirect::Route('commonHome');
		}

		if(Session::has('entityDtl')){
			Log::debug($thisMethod . ' Coor_flag: ' . Session::get('entityDtl')['coor_flag'] . ' Auth:: ' . Auth::id());
			if(Session::get('entityDtl')['coor_flag'] == 1 || Session::get('entityDtl')['coor_flag'] == 2){
				
				$projectDtl = EyicProjectDtls::where(['clg_id' => Session::get('entityDtl')['clg_id']])->get();							
				View::share(array('title'=>'Project','link' => 2));
				return View::make('eyic.labincharge.viewProj')->with(array('projectDetails'=>$projectDtl));									
			}			
		}
		else{
			return Redirect::Route('logout');
		}		
		
	}
	
	public function mentorProjectDetails(){
		
		$thisMethod = self::$thisClass . ' -> mentorProjectDetails -> ';
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		
		if(Session::has('entityDtl')){
			Log::debug($thisMethod . ' Coor_flag: ' . Session::get('entityDtl')['coor_flag'] . ' Auth:: ' . Auth::id());
			
			$projectDtl = EyicProjectDtls::where(['teacher_id' => Session::get('entityDtl')['id']])->get();							
			view::share(array('title'=>'Mentor Project','link' => 3));
			return View::make('eyic.mentor.viewProj')->with(array('projectDetails'=>$projectDtl));									
						
		}
		else{
			return Redirect::Route('logout');
		}
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		save_profile
	| Input:		Null
	| Output:		
	| Logic:		
	|
	*/
	public function save_profile(){

		if(!Auth::check()){
			return json_encode([JSON_ERROR => 'Operation not allowed.']);
		}
		if(Auth::user()->role != 2){
			return json_encode([JSON_ERROR => 'Operation only allowed to Students.']);
		}
		$thisMethod = self::$thisClass . ' -> save_profile -> ';
		$usr_id = Auth::id();

		$rules = [	'contact_num'	=>	'regex:/^[+]?\d+[-]?\d+$/',
		'address'		=>	"regex:/^[A-Za-z0-9'\.\-\s\,]*$/",
		'branch'		=>	'regex:/^[_A-Za-z0-9-\s]*$/',
		'year'			=>	'regex:/^-*\d$/',
		'degree'		=>	'regex:/^[_A-Za-z0-9-\s\.]*$/',
		'gender'		=>	'regex:/^[_A-Za-z0-9-\s]*$/'];

		$messages = [	'contact_num.regex'	=>	'Contact Number can only have digits, + and - sign.',
		'address.regex'		=>	'Address can only have characters, numbers and (.,-) symbols.',
		'branch.regex'		=>	'Branch can only contain characters and numbers.',
		'year.regex'		=>	'Year can only be 1 digit.',
		'degree.regex'		=>	'Degree can only contain characters and numbers.',
		'gender.regex'		=>	'Gender can only contain characters and numbers.'
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		$ar_vl = array_values($validator->messages()->toArray());

		$fn_msg = '';
		foreach($ar_vl as $msg){
			$fn_msg .= $msg[0] . "<br/>";
		}
		if ($validator->fails()){
			return json_encode([JSON_ERROR => $fn_msg]);
		}

		$contact_num = Input::get('contact_num');
		$address = Input::get('address');
		$branch = Input::get('branch');
		$year = Input::get('year');
		$degree = Input::get('degree');
		$gender = Input::get('gender');

		DB::beginTransaction();
		try{

			$student = ElsiStudentsDtls::where('user_id', $usr_id)->get();

			if(count($student) < 1){
				throw new Exception("Could not find student details");
			}

			
			$student[0]->contact_num = $contact_num;
			$student[0]->address = $address;
			
			if($year != '-1')			
				$student[0]->year = $year;
			else
				$student[0]->year = null;

			if($branch != '-1')
				$student[0]->branch = $branch;
			else
				$student[0]->branch = null;
			
			if($degree != '-1')
				$student[0]->degree = $degree;
			else
				$student[0]->degree = null;

			if($gender != '-1')
				$student[0]->gender = $gender;
			else
				$student[0]->gender = null;

			if(!$student[0]->save()){
				throw new Exception("Failed to update student details");
			}

			DB::commit();
		}
		catch(Exception $e){
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return json_encode([JSON_ERROR => $messages]);
		}
		return json_encode([JSON_SUCCESS => 'Successfully updated the details!']);
	}

	public function load_update_profile(){

		if(!Auth::check()){
			return json_encode([JSON_ERROR => 'Operation not allowed.']);
		}
		if(Auth::user()->role != 2){
			return json_encode([JSON_ERROR => 'Operation only allowed to Students.']);
		}
		$thisMethod = self::$thisClass . ' -> load_update_profile -> ';
		
		$departments = ElsiDepartments::orderBy('name')->get();
		
		$std = ElsiStudentsDtls::where('user_id', Auth::id())->get();

		$ret_array = ['depart'	=>	$departments, 'profile'	=> $std];

		return json_encode($ret_array);
	}
	
}