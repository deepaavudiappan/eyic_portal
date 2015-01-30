<?php

class TeacherController extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| TeacherController Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = 'TeacherController';

	/*
	|-------------------------------------------------------------------------
	| Function:		save_profile
	| Input:		Null
	| Output:		
	| Logic:		
	|
	*/
	public function save_profile(){

		if(!Auth::check()){
			return json_encode([JSON_ERROR => 'Operation not allowed.']);
		}
		if(Auth::user()->role != 1){
			return json_encode([JSON_ERROR => 'Operation only allowed to Teachers.']);
		}
		$thisMethod = self::$thisClass . ' -> save_profile -> ';
		$usr_id = Auth::id();

		$rules = [	'alt_email1'	=>	'email',
		'alt_email2'	=>	'email',
		'cnt_num'		=>	'regex:/^[+]?\d+[-]?\d+$/',
		'alt_cnt_num'	=>	'regex:/^[+]?\d+[-]?\d+$/',
		'depart'		=>	'regex:/^[_A-Za-z0-9-\s]*$/',
		'desig'			=>	'regex:/^[_A-Za-z0-9-\s]*$/',
		'gender'		=>	'regex:/^[_A-Za-z0-9-\s]*$/'];

		$messages = [	'alt_email1.email'	=>	'Alternative Email ID 1 is not in proper format.',
		'alt_email2.email'		=>	'Alternative Email ID 2 is not in proper format.',
		'cnt_num.regex'			=>	'Contact Number can only have digits, + and - sign.',
		'alt_cnt_num.regex'		=>	'2nd student email id is not in proper format.',
		'depart.regex'		=>	'Department can only contain characters and numbers.',
		'desig.regex'		=>	'Designation can only contain characters and numbers.',
		'gender.regex'		=>	'Gender can only contain characters and numbers.'
		];

		$validator = Validator::make(Input::all(), $rules, $messages);

		$ar_vl = array_values($validator->messages()->toArray());

		$fn_msg = '';
		foreach($ar_vl as $msg){
			$fn_msg .= $msg[0] . "<br/>";
		}
		if ($validator->fails()){
			return json_encode([JSON_ERROR => $fn_msg]);
		}

		$alt_email1 = Input::get('alt_email1');
		$alt_email2 = Input::get('alt_email2');
		$cnt_num = Input::get('cnt_num');
		$alt_cnt_num = Input::get('alt_cnt_num');
		$depart = Input::get('department');
		$desig = Input::get('desig');
		$gender = Input::get('gender');

		DB::beginTransaction();
		try{

			$tch = ElsiTeachersDtls::where('user_id', $usr_id)->get();

			if(count($tch) < 1){
				throw new Exception("Could not find teacher details");
			}

			//if($alt_email1 != '' && !empty($alt_email1))
			$tch[0]->alt_email1 = $alt_email1;
			//if($alt_email2 != '' && !empty($alt_email2))
			$tch[0]->alt_email2 = $alt_email2;
			//if($cnt_num != '' && !empty($cnt_num))
			$tch[0]->contact_num = $cnt_num;
			//if($alt_cnt_num != '' && !empty($alt_cnt_num))
			$tch[0]->alt_contact1 = $alt_cnt_num;
			if($depart != '-1')
				$tch[0]->department = $depart;
			else
				$tch[0]->department = null;
			if($desig != '-1')
				$tch[0]->designation = $desig;
			else
				$tch[0]->designation = null;
			if($gender != '-1')
				$tch[0]->gender = $gender;
			else
				$tch[0]->gender = null;

			if(!$tch[0]->save()){
				throw new Exception("Failed to update teacher details");
			}

			DB::commit();
		}
		catch(Exception $e){
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
			$messages = ['Unable to save the information. Please contact us at helpdesk@e-yantra.org via email about the issue'];
			return json_encode([JSON_ERROR => $messages]);
		}
		return json_encode([JSON_SUCCESS => 'Successfully updated the details!']);
	}

	public function load_update_profile(){

		if(!Auth::check()){
			return json_encode([JSON_ERROR => 'Operation not allowed.']);
		}
		if(Auth::user()->role != 1){
			return json_encode([JSON_ERROR => 'Operation only allowed to Teachers.']);
		}
		$thisMethod = self::$thisClass . ' -> load_update_profile -> ';
		
		$departments = ElsiDepartments::orderBy('name')->get();
		$desig = ElsiDesignations::orderBy('name')->get();

		$tch = ElsiTeachersDtls::where('user_id', Auth::id())->get();

		$ret_array = ['depart'	=>	$departments, 'desig'	=>	$desig, 'profile'	=> $tch];

		return json_encode($ret_array);
	}
}