<?php

class MigCoorController extends BaseController {
	
	//Defining the layout to be used for these pages
	protected $layout = 'layouts.master';
	//Storing name of the class
	protected static $thisClass = 'MigCoorController';

	/*
	|-------------------------------------------------------------------------
	| Function:		Migrate Coordinators to TeachersDtls Table
	| Input:		Null
	| Output:		Migrate Coordinators
	| Logic:		Migrate Coordinators
	|
	*/
	public function migrateCoorToTeacher(){
		
		if(!Auth::check()){
			return Redirect::Route('loginLand');
		}
		if(Auth::user()->role != 3){
			return Redirect::Route('commonHome');
		}
		
		$thisMethod = self::$thisClass . ' -> migrateCoorToTeacher -> ';
		$coors = ElsiCoordinator::all();

		$count = 0;
		foreach ($coors as $coor) {
    			/* Create a ElsiTeachersDtls Model */
			$teacher = new ElsiTeachersDtls;
			$teacher->name = ucwords(strtolower($coor->name));
			$teacher->emailid = $coor->email_id;
			$teacher->coor_flag = $coor->type;
			$teacher->clg_id = $coor->clg_id;
			$teachers_array[$count] = $teacher;
			$count++; 			
		}


		DB::beginTransaction();
		try{
			// Save each record
			for($x = 0; $x < count($teachers_array); $x++) {
				if(!$teachers_array[$x]->save()){
					throw new Exception('Unable to save coordinator to teachers table');
				}
			}
			DB::commit();
			Log::success($thisMethod . "All coordinator data migrated to Teachers table.");
		}
		catch (Exception $e){
			//Catching any exception to roll back
			Log::error($thisMethod . "Exception occured! Msg: ". $e->getMessage());
			DB::rollback();
			Log::error($thisMethod . "Rollback successful");
		}

	}
}

