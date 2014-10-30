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
		
		//Auth

		//Store the student details and send email
		return;
	}
}