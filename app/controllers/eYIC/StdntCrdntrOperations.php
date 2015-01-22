<?php

class StdntCrdntrOperations extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| StdntCrdntrOperations Controller
	|--------------------------------------------------------------------------
	|	
	|	
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = "StdntCrdntrOperations";
	/*
	|-------------------------------------------------------------------------
	| Function:		prjStdntDtlsLand
	| Input:		Null
	| Output:		
	| Logic:		Landing page for eYIC Student Representive
	|
	*/
	public function prjStdntDtlsLand(){

		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 2){
			return Redirect::Route('commonHome');
		}
		if(Session::has('entityDtl')){
			if(Session::get('entityDtl')['role'] != 1){
				return Redirect::Route('commonHome');
			}
		}
		else{
			return Redirect::Route('commonHome');
		}

		return View::make('eyic.stdnt_repre.addPrjStndDtlsLand');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		prjPropUpload
	| Input:		Null
	| Output:		
	| Logic:		Upload Project proposal
	|
	*/
	public function prjPropUpload(){
		$thisMethod = self::$thisClass . ' prjPropUpload -> ';

		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 2){
			return Redirect::Route('commonHome');
		}
		if(Session::get('entityDtl')->role != 1){
			return Redirect::Route('commonHome');
		}
		try{
			if(!Input::hasFile('prjProp')){
				return Redirect::Route('projProp')->withErrors(['No file selected!']);	
			}
			if(!Input::file('prjProp')->isValid()){
				return Redirect::Route('projProp')->withErrors(['Unable to upload the file. Please try again later']);	
			}
			$format = strtolower(Input::file('prjProp')->getClientOriginalExtension());
			$size = Input::file('prjProp')->getSize();

			if($format != 'pdf'){
				return Redirect::Route('projProp')->withErrors(['Unable to upload project proposal. Incorrect file format detected. Only pdf is allowed!']);
			}

			if($size > 9437184){
				return Redirect::Route('projProp')->withErrors(['Unable to upload project proposal. File size is more than 8 MB.']);
			}

			$std_id = Session::get('entityDtl')->id;

			$proj = EyicProjectDtls::where('student1_id', $std_id)->orWhere('student2_id', $std_id)->orWhere('student3_id', $std_id)->orWhere('student4_id', $std_id)->get();

			if(count($proj) < 1){
				return Redirect::Route('projProp')->withErrors(['Unable to find project. Please contact us at helpdesk@e-yantra.org with this issue message.']);
			}

			$proj_id = $proj[0]->id;
			Input::file('prjProp')->move(UPLOAD_FILES_LOC . 'proj_proposal/', 'PP#' . $proj_id . '.pdf');

			$proj[0]->project_status = 2;
			$proj[0]->proposal_date = new DateTime;

			if(!$proj[0]->save()){
				Log::error($thisMethod . 'Could not save project status proposal: ' . Auth::id());
				return Redirect::Route('projProp')->withErrors(['Unable to upload the file. Please contact us at helpdesk@e-yantra.org']);
			}

			return Redirect::Route('projProp')->with(['success'	=> 'Successfully uploaded the Project Proposal!']);
		}
		catch(Exception $e){
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			$messages = ['Unable to perform action. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return Redirect::route('projProp')->withErrors($messages);
		}
	}
}

