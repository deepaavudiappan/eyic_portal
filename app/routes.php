<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::match(array('GET', 'POST'), '/addCoor', array(
			'as'	=>	'addCoor',
			'uses'	=>	'CollegeController@addCoordinator'
));

Route::match(array('GET', 'POST'), '/addCoorSave', array(
			'as'	=>	'addCoorSave',
			'uses'	=>	'CollegeController@addCoordinatorSave'
));

/* Migrate coordinator table data to teachers table*/
Route::match(array('GET', 'POST'), '/migCoor', array(
			'as'	=>	'migCoor',
			'uses'	=>	'MigCoorController@migrateCoorToTeacher'
));

/*----------------------Auth Routes---------------------------*/
Route::match(array('GET', 'POST'), '/', array(
			'as'	=>	'loginLand',
			'uses'	=>	function(){		
							return View::make('login');
						}
));

Route::post('/auth/login', array(
			'as'	=>	'login',
			'uses'	=>	'AuthController@doLogin'
));

Route::get('/auth/logout', array(
			'as' => 'logout',
			'uses' => 'AuthController@doLogout'  
));


Route::match(array('GET', 'POST'), '/common/home', array(
			'as'	=>	'commonHome',
			'uses'	=>	'HomeController@homeBifurcate'
));

Route::match(array('GET', 'POST'), '/common/home_coor_mentor', array(
			'as'	=>	'coorMentorHome',
			'uses'	=>	'HomeController@coordinatorMentorHome'
));

/*----------------------Mentor Routes---------------------------*/
Route::match(array('GET', 'POST'), '/mentor/addprojdetail', array(
			'as'	=>	'addprojectdetail',
			'uses'	=>	'MentorOperations@addProjectDetails'
));

Route::match(array('GET', 'POST'), '/mentor/addprojdetailLand', array(
			'as'	=>	'addprojectdetailland',
			'uses'	=>	'MentorOperations@eyicMentorLand'
));

/*----------------------Coordinator Routes---------------------------*/
Route::match(array('GET', 'POST'), '/labin/regProjLand', array(
			'as'	=>	'regProjLand',
			'uses'	=>	'LabInchargeOperations@loadRegProj'
));

Route::match(array('GET', 'POST'), '/labin/registerProj', array(
			'as'	=>	'registerProj',
			'uses'	=>	'LabInchargeOperations@registerProj'
));

/*----------------------Admin Routes---------------------------*/
Route::match(array('GET', 'POST'), '/admin/home', array(
			'as'	=>	'adminHome',
			'uses'	=>	'HomeController@adminHome'
));

Route::match(array('GET', 'POST'), '/admin/setupCoorAccs', array(
			'as'	=>	'setupCoorAccs',
			'uses'	=>	'AdminOperations@makeLoginCoor'
));

/*Route::get('/', function(){
		$user = new Login();
		
		$user->username = "user1";
		$user->password = Hash::make("12345");
		$user->save();	
 		
  		return "Done";		
	
});*/