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

function loginWithInstagram() {

    // get data from input
    $code = Input::get( 'code' );


}

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/authenticate', loginWithInstagram);