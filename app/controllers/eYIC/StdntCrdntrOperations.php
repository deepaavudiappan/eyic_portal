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

	/*
	|-------------------------------------------------------------------------
	| Function:		proj_dtls
	| Input:		Null
	| Output:		
	| Logic:		Landing page for eYIC Student Representive
	|
	*/
	public function proj_dtls(){

		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 2){
			return Redirect::Route('commonHome');
		}

		$std_id = Session::get('entityDtl')->id;

		$proj = EyicProjectDtls::where('student1_id', $std_id)->orWhere('student2_id', $std_id)->orWhere('student3_id', $std_id)->orWhere('student4_id', $std_id)->get();

		if(count($proj) < 1){
			return Redirect::Route('projDtlsStudents')->withErrors(['Unable to find project. Please contact us at helpdesk@e-yantra.org with this issue message.']);
		}
		if($proj[0]->project_status == 3 || $proj[0]->project_status == 4){
			$eval = EyicProjEvaluation::where('proj_id', $proj[0]->id)->get();

			if(count($eval) > 0){
				return View::make('eyic.stdnt_repre.proj_dtls')->with(['project' => $proj[0], 'proj_eval'	=> $eval[0]]);
			}
			else{
				return View::make('eyic.stdnt_repre.proj_dtls')->with(['project' => $proj[0], 'proj_eval'	=> Null]);
			}
		}
		else{
			return View::make('eyic.stdnt_repre.proj_dtls')->with('project', $proj[0]);
		}
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		eyicStage2Save
	| Input:		Null
	| Output:		
	| Logic:		Landing page for eYIC Student Representive
	|
	*/
	public function eyicStage2Save(){
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 2){
			return Redirect::Route('commonHome');
		}

		$rules = [	'videoLink'	=>	'required|url'];

		$messages = [	'videoLink.required'	=>	'Implementation video Link is compulsory!',
		'videoLink.url'		=>	'Implementation video link provided is not a valid URL'];

		$validator = Validator::make(Input::all(), $rules, $messages);
		$std_id = Session::get('entityDtl')->id;

		$proj = EyicProjectDtls::where('student1_id', $std_id)->orWhere('student2_id', $std_id)->orWhere('student3_id', $std_id)->orWhere('student4_id', $std_id)->get();

		if ($validator->fails()){
			return View::make('eyic.documents.stage2')->with(['error'=>'Implementation Video Link is compulsory.','proj_dtls' =>$proj[0]]);
		}
		$link = Input::get('videoLink');

		if(strpos($link, 'youtube.com') === False && strpos($link, 'youtu.be') === False){
			return View::make('eyic.documents.stage2')->with(['error'=>'Implementation video link provided is not of youtube.com or youtu.be! The link must contain youtube.com or youtu.be','proj_dtls' =>$proj[0]]);
		}

		if(count($proj) < 1){
			return View::make('eyic.documents.stage2');
		}

		if(Input::hasFile('projProp')){
			if(!Input::file('projProp')->isValid()){
				return View::make('eyic.documents.stage2')->with(['error'=>'Unable to upload the file. Please contact us at helpdesk@e-yantra.org','proj_dtls' =>$proj[0]]);
			}
			$format = strtolower(Input::file('projProp')->getClientOriginalExtension());
			$size = Input::file('projProp')->getSize();

			if($format != 'pdf'){
				return View::make('eyic.documents.stage2')->with(['error'=>'Unable to upload project proposal. Incorrect file format detected. Only pdf is allowed!','proj_dtls' =>$proj[0]]);
			}
			if($size > 9437184){
				return View::make('eyic.documents.stage2')->with(['error'=>'Unable to upload project proposal. File size is more than 8 MB.','proj_dtls' =>$proj[0]]);
			}

			Input::file('projProp')->move(UPLOAD_FILES_LOC . 'proj_proposal_updated/', 'PP#' . $proj[0]->id . '.pdf');
		}
		if(Input::hasFile('changeLog')){
			if(!Input::file('changeLog')->isValid()){
				return View::make('eyic.documents.stage2')->with(['error'=>'Unable to upload the file. Please contact us at helpdesk@e-yantra.org','proj_dtls' =>$proj[0]]);
			}
			$format = strtolower(Input::file('changeLog')->getClientOriginalExtension());
			$size = Input::file('changeLog')->getSize();

			if($format != 'xls' && $format != 'xlsx'){
				return View::make('eyic.documents.stage2')->with(['error'=>'Unable to upload change log. Incorrect file format detected. Only xlxs or xls is allowed!','proj_dtls' =>$proj[0]]);
			}
			if($size > 9437184){
				return View::make('eyic.documents.stage2')->with(['error'=>'Unable to upload change log. File size is more than 8 MB.','proj_dtls' =>$proj[0]]);
			}

			Input::file('changeLog')->move(UPLOAD_FILES_LOC . 'change_log/', 'PP#' . $proj[0]->id . '.' . $format);
		}

		$proj[0]->imple_link = $link;
		$proj[0]->imple_link_date = new DateTime;
		$proj[0]->project_status = 6;

		if(!$proj[0]->save()){
			return View::make('eyic.documents.stage2')->with(['error'=>'Unable to save link, contact us at helpdesk@e-yantra.org','proj_dtls' =>$proj[0]]);
		}
		else{
			return View::make('eyic.documents.stage2');
		}
	}
}