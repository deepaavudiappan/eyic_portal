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
			return Redirect::Route('addprojectdetailland');
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
	
}