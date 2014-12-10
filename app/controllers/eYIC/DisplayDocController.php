<?php

class DisplayDocController extends BaseController {

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = 'DisplayDocController';

	/*
	|-------------------------------------------------------------------------
	| Function:		displayDocCoor
	| Input:		Null
	| Output:		Display Documents for Coordinators
	| Logic:		Display Documents for Coordinators
	|
	*/
	public function displayDocCoor(){
		
		return View::make('eyic.documents.coordinators');
	}

	public function displayDocMentor(){
		
		return View::make('eyic.documents.mentorAndStudentRep');
	}
	
}
