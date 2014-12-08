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
}

