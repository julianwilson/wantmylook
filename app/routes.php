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

public function loginWithInstagram() {

    // get data from input
    $code = Input::get( 'code' );

    // get ig service
    $ig = OAuth::consumer( 'Instagram' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from instagram, get the token
        $token = $ig->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $ig->request( '/users/self/media/liked' ), true );

        //Var_dump
        //display whole array().
        dd($result);

    }
    // if not ask for permission first
    else {
        // get ig authorization
        $url = $fb->getAuthorizationUri();

        // return to instagram login url
         return Redirect::to( (string)$url );
    }

}

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/authenticate', loginWithInstagram);