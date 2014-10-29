<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', 'HomeController@showWelcome');

Route::match(array('GET', 'POST'), '/login', array(
			'as'	=>	'login',
			'uses'	=>	'AuthController@login'
));

Route::match(array('GET', 'POST'), '/addprojdetail', array(
			'as'	=>	'addprojectdetail',
			'uses'	=>	'MentorOperations@addProjectDetails'
));

Route::match(array('GET', 'POST'), '/addprojdetailLand', array(
			'as'	=>	'addprojectdetailland',
			'uses'	=>	'MentorOperations@eyicMentorLand'
));
	