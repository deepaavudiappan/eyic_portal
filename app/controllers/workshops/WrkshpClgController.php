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

		$clgs = ['0' => 'Select College'] + ElsiCollegeDetail::where(['region' => 'bangalore', 'LOI' => 1, 'workshop_cnfrm' => 0])->lists('college_name', 'id');

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
		
		if(Input::get('confirm')){
			$clg = ElsiCollegeDetail::find($clg);
			$clg->workshop_cnfrm = 1;

			if(!$clg->save()){
				Log::error($thisMethod . 'Unable to save college confirm');
				return Redirect::route('clgConfirmLand')->withErrors('Unable to confirm college workshop please contact support@e-yantra.org');
			}
			else{
				return Redirect::route('clgConfirmLand')->withSuccess('Your college has successfully confirmed the workshop');
			}
		}
		else{
			return Redirect::route('clgConfirmLand')->withErrors('Please confirm the message');
		}
	}