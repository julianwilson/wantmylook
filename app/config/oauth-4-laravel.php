<?php
return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Facebook
		 */
		'Instagram' => array(
		    'client_id'     => 'f61981bc02e042ad9f514a3e897f138f',
		    'client_secret' => 'e43944582a344453a53b7b6172373848',
			 'scope'         => array('basic'),
		),		

	)

);
?>