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

	/*
	|-------------------------------------------------------------------------
	| Function:		displayDocMentor
	| Input:		Null
	| Output:		Display Documents for Mentors and Student Representative
	| Logic:		Display Documents for Mentors and Student Representative
	|
	*/
	public function displayDocMentor(){
		
		return View::make('eyic.documents.mentorAndStudentRep');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		displayDocPlagiarism
	| Input:		Null
	| Output:		Display Documents on Plagiarism
	| Logic:		Display Documents on Plagiarism
	|
	*/
	public function displayDocPlagiarism(){
		
		return View::make('eyic.documents.plagiarism');
	}
	
}
