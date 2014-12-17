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
				$student = 	Session::get('entityDtl');
				$clgDtl = ElsiCollegeDetail::find(Session::get('entityDtl')['clg_id']);				
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
	
}