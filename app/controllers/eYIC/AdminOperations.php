<?php

class AdminOperations extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| AdminOperations Controller
	|--------------------------------------------------------------------------
	|	
	|	
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = "AdminOperations";
	/*
	|-------------------------------------------------------------------------
	| Function:		makeLoginCoor
	| Input:		Null
	| Output:		
	| Logic:		Landing page for eYIC Mentor
	|
	*/
	public function makeLoginCoor(){

		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 3){
			return Redirect::Route('commonHome');
		}
		$thisMethod = self::$thisClass . ' -> makeLoginCoor -> ';
		$emailSubj = "eYIC-2015_Coordinator_Login_Details";

		DB::beginTransaction();
		try{
			$allCoors = ElsiTeachersDtls::whereIn('coor_flag', [1,2])->where(['login_created' => 0])->get();

			foreach($allCoors as $curCoor){
				$scpassword = str_random(10);
				$curStd_login = new Login;
				$curStd_login->username = $curCoor->emailid;
				$curStd_login->active = 1;
				$curStd_login->password = Hash::make($scpassword);
				$curStd_login->clg_id = $curCoor->clg_id;
				$curStd_login->role = 1;

				if(!$curStd_login->save()){
					Log::error($thisMethod . "Throwing exception for unable to make coordinator login");
					throw new Exception('Unable to save coordinator login');
				}
				$curCoor->login_created = 1;
				$curCoor->user_id = $curStd_login->id;

				if(!$curCoor->save()){
					Log::error($thisMethod . "Throwing exception for unable to save coordinator in teachers dtls flag update");
					throw new Exception('Unable to save coordinator in teachers flag update');
				}

				$clgDtl = ElsiCollegeDetail::where('id',$curCoor->clg_id)->get();
				Mail::queue('emails.eyic.coord_invite',  array('username'	=>	$curCoor->emailid, 
					'pwd' => $scpassword, 'coorName' => $curCoor->name, 'clgName' => $clgDtl[0]->college_name), function($message) use($curCoor, $emailSubj)
				{
					$message->from(EYIC_FROM_EMAIL, EYIC_FROM_NAME);
					$message->to($curCoor->emailid)->subject($emailSubj);
				});
			}

			DB::commit();
		}
		catch(Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return Redirect::route('adminHome')->withErrors($messages);
		}

		return Redirect::route('adminHome')->with(['success' => 'Setup Coordinator accounts successfully']);
	}


	/*
	|-------------------------------------------------------------------------
	| Function:		workshop_invite_loi
	| Input:		Null
	| Output:		
	| Logic:		Workshop Send invites to LOI colleges
	|
	*/
	public function workshop_invite(){
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 3){
			return Redirect::Route('commonHome');
		}
		$thisMethod = self::$thisClass . ' -> workshop_invite_loi -> ';

		$region = Input::get('regions');
		$date = Input::get('date');
		$venue = Input::get('venue');
		$nc_coor = Input::get('nc_coor');
		$contact_num = Input::get('contact_num');
		$email = Input::get('email');

		DB::beginTransaction();
		try{
			if(Input::get('loi_invite')) {
				$clg_lst = ElsiCollegeDetail::where('region','like', $region)->where('loi',1)->get();

				//Log::debug($thisMethod . 'Total Colleges: ' . count($clg_lst));
				$emailSubj = 'eLSI-Workshop-Invite';

				foreach($clg_lst as $cur_clg){
					if(!empty($cur_clg['principal_email']) && !empty($cur_clg['tl_email'])){ 
						Mail::queue('emails.workshops.loi_invite',  array('date'	=>	$date, 
							'venue' => $venue, 'nc_coor' => $nc_coor, 'contact_num' => $contact_num, 'email' => $email), function($message) use($cur_clg, $emailSubj)
						{
							$message->from(ELSI_FROM_EMAIL, ELSI_FROM_NAME);
							$message->to(array_merge(explode(',', $cur_clg['principal_email']), explode(',',$cur_clg['tl_email'])))->cc('admin@e-yantra.org')->subject($emailSubj);
						});
					}
				}
			}
			elseif(Input::get('fcfs_invite')) {
				$clg_lst = ElsiCollegeDetail::where('region','like', $region)->where('loi', 0)->get();

				//Log::debug($thisMethod . 'Total Colleges: ' . count($clg_lst));
				$emailSubj = 'eLSI-Workshop-Invite';

				foreach($clg_lst as $cur_clg){
					if(!empty($cur_clg['principal_email'])){ 
						Mail::queue('emails.workshops.loi_invite',  array('date'	=>	$date, 
							'venue' => $venue, 'nc_coor' => $nc_coor, 'contact_num' => $contact_num, 'email' => $email), function($message) use($cur_clg, $emailSubj)
						{
							$message->from(ELSI_FROM_EMAIL, ELSI_FROM_NAME);
							$message->to(explode(',',$cur_clg['principal_email']))->cc('admin@e-yantra.org')->subject($emailSubj);
						});
					}
				}
			}
			return Redirect::route('adminHome')->withSuccess('Workshop invites sent successfully!');
		}

		catch(Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Exception Occured'];
			return Redirect::route('adminHome')->withErrors($messages);
		}
	}

	public function invite_data(){
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 3){
			return Redirect::Route('commonHome');
		}
		$thisMethod = self::$thisClass . ' -> workshop_invite -> ';

		DB::beginTransaction();
		try{
			$dst_region = ElsiCollegeDetail::distinct()->select('region')->lists('region','region');

			return View::make('workshops.invite_data')->with(['regions' => $dst_region]);
		}
		catch(Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Exception Occured'];
			return Redirect::route('adminHome')->withErrors($messages);
		}
	}
}