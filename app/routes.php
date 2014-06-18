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
	$instaConfig = array(
        'apiKey' => 'e3f5ca5f0bb44527bf4d07b8af9b4e90',
        'apiSecret' => '0b2710a239f140248262c63b0260bff6',
        'apiCallback' => 'http://54.183.26.46/instaamp/authenticate',
     );
	 
	// Get the code and pass it to our handshake script
	$code = Input::get('code');
	
	session_start();
	// Instantiate the API handler object
	$instagram = new Instagram($instaConfig);
	$accessToken = $instagram->getOAuthToken($code);
	$_SESSION['InstagramAccessToken'] = $accessToken;
	return $accessToken;
});