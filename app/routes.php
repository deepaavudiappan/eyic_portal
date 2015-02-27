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

Route::match(array('GET', 'POST'), '/addcoor', array(
			'as'	=>	'addCoor',
			'uses'	=>	'CollegeController@addCoordinator'
));

Route::match(array('GET', 'POST'), '/addCoorSave', array(
			'as'	=>	'addCoorSave',
			'uses'	=>	'CollegeController@addCoordinatorSave'
));

/* Migrate coordinator table data to teachers table*/
Route::match(array('GET', 'POST'), '/admin/migCoor', array(
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

Route::match(array('GET', 'POST'), '/auth/login', array(
			'as'	=>	'login',
			'uses'	=>	'AuthController@doLogin'
));

Route::get('/auth/logout', array(
			'as' => 'logout',
			'uses' => 'AuthController@doLogout'  
));

Route::match(array('GET', 'POST'), '/changePwdLand', array(
			'as'	=>	'changePwdLand',
			'uses'	=>	'AuthController@changePasswordLand'
));

Route::match(array('GET', 'POST'), '/changePwd', array(
			'as'	=>	'changePwd',
			'uses'	=>	'AuthController@changePassword'
));

Route::match(array('GET', 'POST'), '/forgetPwdLand', array(
			'as'	=>	'forgetPwdLand',
			'uses'	=>	'AuthController@forgetPasswordLand'
));

Route::match(array('GET', 'POST'), '/forgetPwd', array(
			'as'	=>	'forgetPwd',
			'uses'	=>	'AuthController@forgetPassword'
));


Route::match(array('GET', 'POST'), '/validateToken/{username}/{token}', array(
			'as'	=>	'validateToken',
			'uses'	=>	'AuthController@validateToken'
));

/* Used to set new password in case of forget password */

Route::match(array('GET', 'POST'), '/setPwdLand', array(
			'as'	=>	'setPwdLand',
			'uses'	=>	'AuthController@setPasswordLand'
));

Route::match(array('GET', 'POST'), '/setPwd', array(
			'as'	=>	'setPwd',
			'uses'	=>	'AuthController@setPassword'
));

Route::match(array('GET', 'POST'), '/common/home', array(
			'as'	=>	'commonHome',
			'uses'	=>	'HomeController@homeBifurcate'
));

Route::match(array('GET', 'POST'), '/common/home_coor_mentor', array(
			'as'	=>	'coorMentorHome',
			'uses'	=>	'HomeController@coordinatorMentorHome'
));

Route::match(array('GET', 'POST'), '/teacher/load_profile', array(
			'as'	=>	'loadPrTeacher',
			'uses'	=>	'TeacherController@load_update_profile'
));

Route::match(array('GET', 'POST'), '/teacher/save_profile', array(
			'as'	=>	'savePrTeacher',
			'uses'	=>	'TeacherController@save_profile'
));

Route::match(array('GET', 'POST'), '/student/load_profile', array(
			'as'	=>	'loadPrStudent',
			'uses'	=>	'StudentHomeController@load_update_profile'
));

Route::match(array('GET', 'POST'), '/student/save_profile', array(
			'as'	=>	'savePrStudent',
			'uses'	=>	'StudentHomeController@save_profile'
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

/*------------------Workshops--------------*/
Route::match(array('GET', 'POST'), '/elsi/workshops/admin/invite_data', array(
			'as'	=>	'invite_data',
			'uses'	=>	'AdminOperations@invite_data'
));

Route::match(array('GET', 'POST'), '/elsi/workshops/admin/workshop_invite', array(
			'as'	=>	'wrkshp',
			'uses'	=>	'AdminOperations@workshop_invite'
));

Route::match(array('GET', 'POST'), '/elsi/workshops/college/confirm_land_loi', array(
			'as'	=>	'clgConfirmLand',
			'uses'	=>	'WrkshpClgController@clgConfirmLand'
));

Route::match(array('GET', 'POST'), '/elsi/workshops/college/confirm_loi', array(
			'as'	=>	'clgConfirm',
			'uses'	=>	'WrkshpClgController@clgConfirm'
));

Route::match(array('GET', 'POST'), '/elsi/workshops/college/confirm_land_fcfs', array(
			'as'	=>	'clgConfirmLandFCFS',
			'uses'	=>	'WrkshpClgController@clgConfirmLandFCFS'
));

Route::match(array('GET', 'POST'), '/elsi/workshops/college/confirm_fcfs', array(
			'as'	=>	'clgConfirmFCFS',
			'uses'	=>	'WrkshpClgController@clgConfirmFCFS'
));

Route::match(array('GET', 'POST'), '/elsi/workshops/college/download/loi', array(
			'as'	=>	'downloadLoi',
			'uses'	=>	'WrkshpClgController@downloadLoi'
));

/*------------------- Final Workshop confirm----------------------*/
Route::match(array('GET', 'POST'), '/elsi/workshop/college/confirm_land_loi', array(
			'as'	=>	'clgConfirmLandFinal',
			'uses'	=>	'WrkshpClgController@clgConfirmLandFinal'
));

Route::match(array('GET', 'POST'), '/elsi/workshop/college/confirm_loi', array(
			'as'	=>	'clgConfirmFinal',
			'uses'	=>	'WrkshpClgController@clgConfirmFinal'
));

Route::match(array('GET', 'POST'), '/elsi/workshop/college/confirm_land_fcfs', array(
			'as'	=>	'clgConfirmLandFCFSFinal',
			'uses'	=>	'WrkshpClgController@clgConfirmLandFCFSFinal'
));

Route::match(array('GET', 'POST'), '/elsi/workshop/college/confirm_fcfs', array(
			'as'	=>	'clgConfirmFCFSFinal',
			'uses'	=>	'WrkshpClgController@clgConfirmFCFSFinal'
));

Route::match(array('GET', 'POST'), '/elsi/workshop/college/confirmed_regd', array(
			'as'	=>	'confirmedRegd',
			'uses'	=>	'WrkshpClgController@confirmedRegd'
));

Route::match(array('GET', 'POST'), '/elsi/workshop/college/download/loi', array(
			'as'	=>	'downloadLoi',
			'uses'	=>	'WrkshpClgController@downloadLoi'
));

Route::match(array('GET', 'POST'), '/elsi/workshop/college/schedule', array(
			'as'	=>	'wrkshpSchedule',
			'uses'	=>	'WrkshpClgController@wrkshpSchedule'
));

Route::match(array('GET', 'POST'), '/elsi/workshop/admin/confirmed_clgs', array(
			'as'	=>	'confirmClgs',
			'uses'	=>	'WrkshpClgController@confirmClgs'
));
/*--------------------Added By SP -------------------------------*/
Route::match(array('GET','POST'),'/project',array(
			'as' => 'project',
			'uses' => 'HomeController@projectDetails'
));

Route::match(array('GET','POST'),'/mentorproject',array(
			'as' => 'mentorproject',
			'uses' => 'HomeController@mentorProjectDetails'
));

/*-------------------------LOI Request e-Mail----------------------------*/
Route::match(array('GET', 'POST'), '/elsi/workshops/admin/rqs_loiclg', array(
			'as'	=>	'rqs_loiclg',
			'uses'	=>	'AdminOperations@rqs_loiclg'
));

Route::match(array('GET', 'POST'), '/elsi/workshops/admin/snd_rqs_loiclg', array(
			'as'	=>	'snd_rqs_loiclg',
			'uses'	=>	'AdminOperations@send_eqiplist_loicollege'
));

Route::match(array('GET', 'POST'), '/elsi/workshops/admin/rqs_loiclglist', array(
			'as'	=>	'rqs_loiclglist',
			'uses'	=>	'AdminOperations@rqs_loiclglist'
));

Route::match(array('GET', 'POST'),'/elsi/workshops/admin/get_clg_list', array(
			'as' => 'get_clg_list', 
			'uses'	=>	'AdminOperations@list_clg'
));



/*----------------------Student Representative Routes---------------------------*/
Route::match(array('GET', 'POST'), '/stdnt_repre/prjStndDtlsLand', array(
			'as'	=>	'prjStndDtlsLand',
			'uses'	=>	'StdntCrdntrOperations@prjStdntDtlsLand'
));

Route::match(array('GET', 'POST'), '/stdnt_repre/prjPropUpload', array(
			'as'	=>	'prjPropUpload',
			'uses'	=>	'StdntCrdntrOperations@prjPropUpload'
));

Route::match(array('GET', 'POST'), '/stdnt/projDtlsStudents', array(
			'as'	=>	'projDtlsStudents',
			'uses'	=>	'StdntCrdntrOperations@proj_dtls'
));


/*----------------------Documents Display Routes---------------------------*/

/* Display Document for Coordinators */
Route::match(array('GET', 'POST'), '/doc/dcoor', array(
			'as'	=>	'dcoor',
			'uses'	=>	'DisplayDocController@displayDocCoor'
));

/* Display Document for Mentors and Student Representative */
Route::match(array('GET', 'POST'), '/doc/dmentor', array(
			'as'	=>	'dmentor',
			'uses'	=>	'DisplayDocController@displayDocMentor'
));

/* Display Document on Plagiarism */
Route::match(array('GET', 'POST'), '/doc/dplag', array(
			'as'	=>	'dplag',
			'uses'	=>	'DisplayDocController@displayDocPlagiarism'
));

Route::match(array('GET', 'POST'), '/doc/projProp', array(
			'as'	=>	'projProp',
			'uses'	=>	'DisplayDocController@displayDocProjProp'
));

Route::match(array('GET', 'POST'), '/doc/projPropDown', array(
			'as'	=>	'projPropDown',
			'uses'	=>	'DisplayDocController@downloadProjProp'
));

Route::match(array('GET', 'POST'), '/doc/stage2', array(
			'as'	=>	'stage2_dtls',
			'uses'	=>	'DisplayDocController@displayDocStage2'
));

Route::match(array('GET', 'POST'), '/doc/coding_standard', array(
			'as'	=>	'codingStandard',
			'uses'	=>	'DisplayDocController@displayDocCodingStndrd'
));

Route::match(array('GET', 'POST'), '/doc/change_log', array(
			'as'	=>	'changeLog',
			'uses'	=>	'DisplayDocController@downloadChangeLog'
));
/*Route::get('/', function(){
		$user = new Login();
		
		$user->username = "user1";
		$user->password = Hash::make("12345");
		$user->save();	
 		
  		return "Done";		
	
});*/

Route::match(array('GET','POST'),'/student/studentHome',array(
			'as' => 'studentHome',
			'uses' => 'StudentHomeController@studentProfile'
));
