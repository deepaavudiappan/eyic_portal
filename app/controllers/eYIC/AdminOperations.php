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
		$last_date = Input::get('lastdate');
		$from_email = Input::get('from_email');
		
		if($from_email == Null){
			$from_email = ELSI_FROM_EMAIL;
		}
		if(empty($from_email)){
			$from_email = ELSI_FROM_EMAIL;
		}

		DB::beginTransaction();
		try{
			if(Input::get('remind_loi_invite')) {
				$clg_lst = ElsiCollegeDetail::where('region','like', $region)->where('loi',1)->where('phase','like','2015')->get();
				$emailSubj = 'e-Yantra, IIT Bombay: 2-day workshop -- '.$date.' -- Last Chance to register!!!';

				foreach($clg_lst as $cur_clg){
					if(!empty($cur_clg['principal_email']) && !empty($cur_clg['tl_email'])){ 
						
						$token = $cur_clg->workshop_token;
						Mail::queue('emails.workshops.remind_loi_invite',  array('date'	=>	$date, 
							'venue' => $venue, 'nc_coor' => $nc_coor, 'contact_num' => $contact_num, 
							'email' => $email, 'token' => $token, 'last_date' => $last_date), function($message) use($cur_clg, $emailSubj, $from_email)
						{
							$message->from($from_email, WORKSHOP_FROM_NAME);
							$message->to(array_merge(explode(',', $cur_clg['principal_email']), explode(',',$cur_clg['tl_email'])))->cc('admin@e-yantra.org')->subject($emailSubj);
						});
					}
				}
			}
			else if(Input::get('remind_fcfs_invite')){
				$clg_lst = ElsiCollegeDetail::where('region','like', $region)->where('loi', 0)->where('phase','like','2015')->get();

				//Log::debug($thisMethod . 'Total Colleges: ' . count($clg_lst));
				$emailSubj = 'e-Yantra, IIT Bombay: 2-day workshop -- '.$date.' -- Last Chance to register!!!';

				foreach($clg_lst as $cur_clg){
					if(!empty($cur_clg['principal_email'])){
						
						$token = $cur_clg->workshop_token;
						Mail::queue('emails.workshops.remind_fcfs_invite',  array('date'	=>	$date, 
							'venue' => $venue, 'nc_coor' => $nc_coor, 'contact_num' => $contact_num, 
							'email' => $email, 'token' => $token, 'last_date' => $last_date), function($message) use($cur_clg, $emailSubj, $from_email)
						{
							$message->from($from_email, WORKSHOP_FROM_NAME);
							$message->to(explode(',',$cur_clg['principal_email']))->cc('admin@e-yantra.org')->subject($emailSubj);
						});
					}
				}
			}
			else if(Input::get('loi_invite')) {
				$clg_lst = ElsiCollegeDetail::where('region','like', $region)->where('loi',1)->where('phase','like','2015')->get();

				//Log::debug($thisMethod . 'Total Colleges: ' . count($clg_lst));
				$emailSubj = 'e-Yantra, IIT Bombay: 2-day workshop -- '.$date.' -- Invitation to register!';

				foreach($clg_lst as $cur_clg){
					if(!empty($cur_clg['principal_email']) && !empty($cur_clg['tl_email'])){ 
						
						//$newClg = ElsiCollegeDetail::findOrFail($cur_clg['id']);
						$token = substr(md5(rand()), 0, 7);
						$cur_clg->workshop_token = $token;
						if(!$cur_clg->save()){
							return Redirect::route('adminHome')->withErrors('Unable to save college' . $cur_clg->id);
						}
						else{
							Mail::queue('emails.workshops.loi_invite',  array('date'	=>	$date, 
								'venue' => $venue, 'nc_coor' => $nc_coor, 'contact_num' => $contact_num, 
								'email' => $email, 'token' => $token, 'last_date' => $last_date), function($message) use($cur_clg, $emailSubj, $from_email)
							{
								$message->from(ELSI_FROM_EMAIL, ELSI_FROM_NAME);
								$message->to(array_merge(explode(',', $cur_clg['principal_email']), explode(',',$cur_clg['tl_email'])))->cc('admin@e-yantra.org')->subject($emailSubj);
							});
						}
					}
				}
			}
			else if(Input::get('fcfs_invite')) {
				$clg_lst = ElsiCollegeDetail::where('region','like', $region)->where('loi', 0)->where('phase','like','2015')->get();

				//Log::debug($thisMethod . 'Total Colleges: ' . count($clg_lst));
				$emailSubj = 'e-Yantra, IIT Bombay: 2-day workshop -- '.$date.' -- Invitation to register!';

				foreach($clg_lst as $cur_clg){
					if(!empty($cur_clg['principal_email'])){
						//$newClg = ElsiCollegeDetail::findOrFail($cur_clg['id']);
						$token = substr(md5(rand()), 0, 7);
						$cur_clg->workshop_token = $token;
						if(!$cur_clg->save()){
							return Redirect::route('adminHome')->withErrors('Unable to save college' . $cur_clg->id);
						}
						else{
							Mail::queue('emails.workshops.fcfs_invite',  array('date'	=>	$date, 
								'venue' => $venue, 'nc_coor' => $nc_coor, 'contact_num' => $contact_num, 
								'email' => $email, 'token' => $token, 'last_date' => $last_date), function($message) use($cur_clg, $emailSubj, $from_email)
							{
								$message->from(ELSI_FROM_EMAIL, ELSI_FROM_NAME);
								$message->to(explode(',',$cur_clg['principal_email']))->cc('admin@e-yantra.org')->subject($emailSubj);
							});
						}
					}
				}
			}
			DB::commit();
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