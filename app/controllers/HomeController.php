<?php

class HomeController extends BaseController {
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
	protected static $thisClass = "HomeController";

	/*
	|-------------------------------------------------------------------------
	| Function:		homeBifurcate
	| Input:		Null
	| Output:		
	| Logic:		Landing page for eYIC Mentor
	|
	*/
	public function homeBifurcate(){
		$thisMethod = self::$thisClass . ' -> homeBifurcate -> ';
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role == 1){
			//Return to teachers home page
			//Log::debug('##########' . Session::get('errors'));
			if(Session::has('errors'))
				return Redirect::Route('coorMentorHome')->withErrors(Session::get('errors')->getMessages());
				//return Redirect::Route('coorMentorHome');
			else
				return Redirect::Route('coorMentorHome');
		}
		else if(Auth::user()->role == 2){
			//Return to students home page
			
			if(Session::has('errors'))
				return Redirect::Route('studentHome')->withErrors(Session::get('errors')->getMessages());
			else
				return Redirect::Route('studentHome');
		}
		else if(Auth::user()->role == 3){
			//Return to admin page
			if(Session::has('errors'))
				return Redirect::Route('adminHome')->withErrors(Session::get('errors')->getMessages());
			else
				return Redirect::Route('adminHome');
		}
		else{
			Log::error($thisMethod . 'got role other than 1, 2 and 3 Login ID: ' . Auth::id());
			//Return to error page
		}
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		adminHome
	| Input:		Null
	| Output:		
	| Logic:		Admin Home page
	|
	*/
	public function adminHome(){
		$thisMethod = self::$thisClass . ' -> adminHome -> ';
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		/*if(Auth::user()->role != 3){
			return Redirect::Route('commonHome');
		}*/

		return View::make('eyic.admin.home');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		coordinatorMentorHome
	| Input:		Null
	| Output:		
	| Logic:		coordinatorMentorHome Home page
	|
	*/
	public function coordinatorMentorHome(){
		$thisMethod = self::$thisClass . ' -> coordinatorMentorHome -> ';
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 1){
			return Redirect::Route('commonHome');
		}
		if(Session::has('entityDtl')){
			Log::debug($thisMethod . ' Coor_flag: ' . Session::get('entityDtl')['coor_flag'] . ' Auth:: ' . Auth::id());
			if(Session::get('entityDtl')['coor_flag'] == 0 || Session::get('entityDtl')['coor_flag'] == 1 || Session::get('entityDtl')['coor_flag'] == 2){
				$teacher = ElsiTeachersDtls::where('user_id', Auth::id())->get();
				$teacher = $teacher[0];
				$clgDtl = ElsiCollegeDetail::find(Session::get('entityDtl')['clg_id']);				
				$teacher['college'] = $clgDtl['college_name'];				
				View::share(array('title'=>'Profile','link' => 1));
				return View::make('eyic.common.home')->with(array('teacherDetail'=>$teacher, 'college' => $clgDtl));							
				//return View::make('eyic.labincharge.home')->with(array('teacherDetail'=>$teacher,'projectDetail'=>$projectDtl));					
			}			
		}
		else{
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