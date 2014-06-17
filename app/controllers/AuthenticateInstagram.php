<?php

require_once '../Instagram.php';

class AuthenticateInstagram extends BaseController
{
	
	private $instagramCredentials = array(
        'apiKey' => 'f61981bc02e042ad9f514a3e897f138f',
        'apiSecret' => 'e43944582a344453a53b7b6172373848',
        'apiCallback' => 'http://54.213.116.180/instaamp/authenticate',
     );

	function handshake()
	{
		session_start();
		// Instantiate the API handler object
		$instagram = new Instagram($instaConfig);
		$accessToken = $instagram->getAccessToken();
		$_SESSION['InstagramAccessToken'] = $accessToken;
	}

}
?>