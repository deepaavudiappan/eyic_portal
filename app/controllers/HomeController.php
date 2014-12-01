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
			return Redirect::Route('coorMentorHome');
		}
		else if(Auth::user()->role == 2){
			//Return to students home page
			//return Redirect::Route('');
		}
		else if(Auth::user()->role == 3){
			//Return to admin page
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
		if(Auth::user()->role != 3){
			return Redirect::Route('commonHome');
		}

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
			if(Session::get('entityDtl')['coor_flag'] == 1 || Session::get('entityDtl')['coor_flag'] == 2){
				return View::make('eyic.labincharge.home');		
			}
			else{
				return View::make('eyic.mentor.home');
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
	
}