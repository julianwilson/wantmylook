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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/authenticate', function()
{
	// Get the code and pass it to our handshake script
	$code = Input::get('code');
	
	session_start();
	// Instantiate the API handler object
	$instagram = new Instagram($instaConfig);
	$accessToken = $instagram->getOAuthToken($code);
	$_SESSION['InstagramAccessToken'] = $accessToken;
	echo $accessToken;
});