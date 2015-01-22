<?php

class WrkshpClgController extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| WrkshpClgController Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = 'WrkshpClgController';

/*
	|-------------------------------------------------------------------------
	| Function:		registerWorkshopLand
	| Input:		Null
	| Output:		Register for WorkshopLand
	| Logic:		Register for WorkshopLand
	|
	*/
	public function registerWorkshopLand(){
		$thisMethod = self::$thisClass . ' -> registerWorkshop -> ';

		$dst_region = ElsiCollegeDetail::distinct()->select('region')->lists('region','region');

		return View::make('workshops.invite_data')->with(['regions' => $dst_region]);
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		clgConfirmLand
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function clgConfirmLand(){
		$thisMethod = self::$thisClass . ' -> clgConfirmLand -> ';

		$clgs = ['0' => 'Select College'] + ElsiCollegeDetail::where('phase', 'like', '2015')->where(['region' => 'bangalore', 'LOI' => 1, 'workshop_cnfrm' => 0])->lists('college_name', 'id');

		return View::make('workshops.loi_confirm')->with('clgs', $clgs);
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		clgConfirm
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function clgConfirm(){
		$thisMethod = self::$thisClass . ' -> clgConfirm -> ';

		$clg_id = Input::get('clg_id');

		if($clg_id == 0){
			return Redirect::route('clgConfirmLand')->withErrors('Please select the college!');
		}
		
		$clg = ElsiCollegeDetail::find($clg_id);
		$clg->workshop_cnfrm = 1;
		$clg->workshop_cnfrm_date = new DateTime;

		if(!$clg->save()){
			Log::error($thisMethod . 'Unable to save college confirm');
			return Redirect::route('clgConfirmLand')->withErrors('Unable to confirm college workshop please contact support@e-yantra.org');
		}
		else{
			return Redirect::route('clgConfirmLand')->withSuccess('Your college has successfully confirmed participation in the workshop.');
		}
		/*}
		else{
			return Redirect::route('clgConfirmLand')->withErrors('Please confirm the message');
		}*/
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		clgConfirmLandFCFS
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function clgConfirmLandFCFS(){
		$thisMethod = self::$thisClass . ' -> clgConfirmLandFCFS -> ';

		$clgs = ['0' => 'Select College'] + ElsiCollegeDetail::where('phase', 'like', '2015')->where(['region' => 'bangalore', 'LOI' => 0, 'workshop_cnfrm' => 0])->lists('college_name', 'id');

		return View::make('workshops.fcfs_confirm')->with('clgs', $clgs);
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		clgConfirm
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function clgConfirmFCFS(){
		$thisMethod = self::$thisClass . ' -> clgConfirmFCFS -> ';

		$clg_id = Input::get('clg_id');

		if($clg_id == 0){
			return Redirect::route('clgConfirmLandFCFS')->withErrors('Please select the college!');
		}
		$rules = [	'tl_name'	=>	'required',
		'tl_email'				=>	'required|email',
		'tm1_name'				=>	'required',
		'tm2_name'				=>	'required',
		'tm3_name'				=>	'required',
		'tl_cont'				=>	'required'];

		$messages = [	'tl_name.required'	=>	'Team Leader Name is required',
		'tl_email.required'		=>	'Team Leader e-mail id is compulsory.',
		'tl_email.email'		=>	'Team Leader e-mail id is not in proper format.',
		'tm1_name.required'		=>	'Team Member name is required.',
		'tm2_name.required'		=>	'Team Member name is required.',
		'tm3_name.required'		=>	'Team Member name is required.',
		'tl_cont.required'		=>	'Team Leader\'s Contact number is required'];

		$clg = ElsiCollegeDetail::find($clg_id);
		$clg->workshop_cnfrm = 1;
		$clg->workshop_cnfrm_date = new DateTime;
		$clg->tl_name = Input::get('tl_name');
		$clg->tl_email = Input::get('tl_email');
		$clg->tl_contact = Input::get('tl_cont');
		$clg->tm_name = Input::get('tm1_name') . ',' . Input::get('tm2_name') . ',' . Input::get('tm3_name');

		if(!$clg->save()){
			Log::error($thisMethod . 'Unable to save college confirm');
			return Redirect::route('clgConfirmLandFCFS')->withErrors('Unable to confirm college workshop please contact support@e-yantra.org');
		}
		else{
			return Redirect::route('clgConfirmLandFCFS')->withSuccess('You have successfully registered your team.  You will be notified on or before January 30th');
		}
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		downloadLoi
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function downloadLoi(){
		$thisMethod = self::$thisClass . ' -> downloadLoi -> ';

		return Response::download(DOWNLOAD_FILES_LOC . 'elsi/letter-of-intent.docx');
	}



	/*-----------------------Final-------------------------*/
	/*
	|-------------------------------------------------------------------------
	| Function:		clgConfirmLandFinal
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function clgConfirmLandFinal(){
		$thisMethod = self::$thisClass . ' -> clgConfirmLandFinal -> ';

		if(!Input::has('ct')){
			Log::error($thisMethod . 'clg_token not passed! No details');
			return Redirect::route('confirmedRegd')->withErrors('Something went wrong. Token not passed, please contact us at support@e-yantra.org to report the issue with this message.');
		}
		//Authenticate Token
		$token = Input::get('ct');

		$clg = ElsiCollegeDetail::where('workshop_token', 'like', trim($token))->get();

		if(count($clg) < 1){
			Log::error($thisMethod . 'clg_token incorrect!' . $token);
			return Redirect::route('confirmedRegd')->withErrors('Something went wrong. Incorrect Token, please contact us at support@e-yantra.org to report the issue with this message.');
		}

		return View::make('workshops.loi_confirm_final')->with('clgs', $clgs[0]);
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		clgConfirmFinal
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function clgConfirmFinal(){
		$thisMethod = self::$thisClass . ' -> clgConfirmFinal -> ';

		$clg_id = Input::get('clg_id');

		if($clg_id == 0){
			Log::error($thisMethod . 'clg_id not passed! No details');
			return Redirect::route('confirmedRegd')->withErrors('Something went wrong. College id missing, please contact us at support@e-yantra.org to report the issue with this message.');
		}
		
		$clg = ElsiCollegeDetail::find($clg_id);
		$clg->workshop_cnfrm = 1;
		$clg->workshop_cnfrm_date = new DateTime;

		if(!$clg->save()){
			Log::error($thisMethod . 'Unable to save college confirm' . $clg_id);
			return Redirect::route('confirmedRegd')->withErrors('Unable to confirm college workshop please contact support@e-yantra.org');
		}
		else{
			return Redirect::route('confirmedRegd')->withSuccess('Your college has successfully confirmed participation in the workshop.');
		}
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		confirmedRegd
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function confirmedRegd(){
		$thisMethod = self::$thisClass . ' -> confirmedRegd -> ';

		return View::make('workshops.confim_msg');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		clgConfirmLandFCFSFinal
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function clgConfirmLandFCFSFinal(){
		$thisMethod = self::$thisClass . ' -> clgConfirmLandFCFSFinal -> ';

		if(!Input::has('ct')){
			Log::error($thisMethod . 'clg_token not passed! No details');
			return Redirect::route('confirmedRegd')->withErrors('Something went wrong. Token not passed, please contact us at support@e-yantra.org to report the issue with this message.');
		}
		//Authenticate Token
		$token = Input::get('ct');

		$clg = ElsiCollegeDetail::whereLike('workshop_token', trim($token))->get();

		if(count($clg) < 1){
			Log::error($thisMethod . 'clg_token incorrect!' . $token);
			return Redirect::route('confirmedRegd')->withErrors('Something went wrong. Incorrect Token, please contact us at support@e-yantra.org to report the issue with this message.');
		}
		// $clgs = ['0' => 'Select College'] + ElsiCollegeDetail::where('phase', 'like', '2015')->where(['region' => 'bangalore', 'LOI' => 0, 'workshop_cnfrm' => 0])->lists('college_name', 'id');

		return View::make('workshops.fcfs_confirm_final')->with('clgs', $clg[0]);
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		clgConfirm
	| Input:		Null
	| Output:		Register for Workshop
	| Logic:		Register for Workshop
	|
	*/
	public function clgConfirmFCFSFinal(){
		$thisMethod = self::$thisClass . ' -> clgConfirmFCFSFinal -> ';

		$clg_id = Input::get('clg_id');

		if($clg_id == 0){
			Log::error($thisMethod . 'clg_id not passed! No details');
			return Redirect::route('confirmedRegd')->withErrors('Something went wrong. College id missing, please contact us at support@e-yantra.org to report the issue with this message.');
		}
		$rules = [	'tl_name'	=>	'required',
		'tl_email'				=>	'required|email',
		'tm1_name'				=>	'required',
		'tm2_name'				=>	'required',
		'tm3_name'				=>	'required',
		'tl_cont'				=>	'required'];

		$messages = [	'tl_name.required'	=>	'Team Leader Name is required',
		'tl_email.required'		=>	'Team Leader e-mail id is compulsory.',
		'tl_email.email'		=>	'Team Leader e-mail id is not in proper format.',
		'tm1_name.required'		=>	'Team Member name is required.',
		'tm2_name.required'		=>	'Team Member name is required.',
		'tm3_name.required'		=>	'Team Member name is required.',
		'tl_cont.required'		=>	'Team Leader\'s Contact number is required'];

		$clg = ElsiCollegeDetail::find($clg_id);
		$clg->workshop_cnfrm = 1;
		$clg->workshop_cnfrm_date = new DateTime;
		$clg->tl_name = Input::get('tl_name');
		$clg->tl_email = Input::get('tl_email');
		$clg->tl_contact = Input::get('tl_cont');
		$clg->tm_name = Input::get('tm1_name') . ',' . Input::get('tm2_name') . ',' . Input::get('tm3_name');

		if(!$clg->save()){
			Log::error($thisMethod . 'Unable to save college confirm' . $clg_id);
			return Redirect::route('confirmedRegd')->withErrors('Unable to confirm college workshop please contact support@e-yantra.org');
		}
		else{
			return Redirect::route('confirmedRegd')->withSuccess('You have successfully registered your team.  You will be notified on or before January 30th');
		}
	}
}