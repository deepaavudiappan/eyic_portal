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
	
	/*
	|-------------------------------------------------------------------------
	| Function:		displayDocProjProp	
	| Input:		Null
	| Output:		Display Documents on Project Proposal
	| Logic:		Display Documents on Project Proposal
	|
	*/
	public function displayDocProjProp	(){
		
		if(Auth::user()->role == 2){
			if(Session::has('entityDtl')){
				if(Session::get('entityDtl')->role == 1){
					$std_id = Session::get('entityDtl')->id;
					$proj = EyicProjectDtls::where('student1_id', $std_id)->orWhere('student2_id', $std_id)->orWhere('student3_id', $std_id)->orWhere('student4_id', $std_id)->get();

					if(count($proj) < 1){
						return View::make('eyic.documents.proj_prop');
					}
					else{
						return View::make('eyic.documents.proj_prop')->with('proj_dtls', $proj[0]);
					}
				}
				else{
					return View::make('eyic.documents.proj_prop');
				}
			}
			else{
				return View::make('eyic.documents.proj_prop');
			}
		}
		else{
			return View::make('eyic.documents.proj_prop');	
		}
		
		
		
	}
	
	/*
	|-------------------------------------------------------------------------
	| Function:		downloadProjProp	
	| Input:		Null
	| Output:		Download Documents on Project Proposal
	| Logic:		Download Documents on Project Proposal
	|
	*/
	public function downloadProjProp	(){
		
		return Response::download(DOWNLOAD_FILES_LOC . 'eyic/Project_Proposal_Template_eyic_2015.docx');
	}
	
	/*
	|-------------------------------------------------------------------------
	| Function:		displayDocStage2	
	| Input:		Null
	| Output:		Download Documents Stage 2
	| Logic:		Download Documents Stage 2
	|
	*/
	public function displayDocStage2(){
		return View::make('eyic.documents.stage2');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		displayDocCodingStndrd	
	| Input:		Null
	| Output:		Download Documents Coding Standard
	| Logic:		Download Documents Coding Standard
	|
	*/
	public function displayDocCodingStndrd(){
		return View::make('eyic.documents.coding_standard');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		downloadChangeLog	
	| Input:		Null
	| Output:		Download Documents Coding Standard
	| Logic:		Download Documents Coding Standard
	|
	*/
	public function downloadChangeLog(){
		return Response::download(DOWNLOAD_FILES_LOC . 'eyic/eyic_change_log.xlsx');
	}
}
