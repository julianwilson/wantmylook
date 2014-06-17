<?php

require_once "../../vendor/instagramapi/Instagram.php";

class SendLikedPhotoEmail
{
	private $mandrill;
	private $instagram;
	 private $mandrillCredentials = 'qywoI6MPROgZFtpqoxQyuw';
	 private $email;
	 private $images = array();
	 private $targets = array('#wantmylook');
	
	public function __construct()
	{
		$instagram = new Instagram($instagramCredentials);
		$mandrill = new Mandrill($mandrillCredentials);
	}
	
	public function fire($job, $data)
    {
		$instagram->setAccessToken($data['accessToken']);
		$this->email = $data['email'];
		
		$likedPhotos = $this->$instagram->getUserLiked();
		// After getting the response, let's iterate the payload
		$likedPhotosJSON = json_decode($likedPhotos, true);
		// Run through data to check for link
		//print_r($response);
		
		// If the last photo scraped is the same as this, no need to continue.
		$lastLikedPhotoID = $likedPhotosJSON['data'][0]['id'];
		if ($data['lastLikedID'] != $lastLikedID)
		{
			// Remember which photo we scraped last fire for this member
			DB::update('update members set lastLikedID = ? where id = ?', array($lastLikedPhotoID, $data['id']));
			
			foreach ($likedPhotosJSON['data'] as $photo)
			{
				$caption = $photo['caption']['text'];
				
				$alreadySentEmail = DB::select('select * from emailSent where memberID = ? AND photoID = ?', array($data['id'], $photo['id']));
				
				if ($this->findTargets($caption) && count($alreadySentEmail) == 0)
				{
					// Remember that we've already emailed the member regarding this photo. Don't send it again.
					DB::insert('insert into emailSent (memberID, photoID) values (?, ?)', array($data['id'], $photo['id']));
					array_push($this->images, $data['images']['standard_resolution']['url']);
				}
			}

			if (count($this->images) > 0) $this->sendEmail();
		}
    }
	
	private function findTargets($haystack)
	{
		foreach ($this->targets as $target)
		{
			if (stripos($haystack, $target)) return true;
		}
		return false;
	}
	
	private function sendEmail()
	{
		$imagesHTML = '';
		
		// Compile list of all images we need to send out into HTML
		foreach ($this->images as $image)
		{
			$imagesHTML .= '<img src="'.$image.'" /><br /><br />';
		}
		
		try {
			$message = array(
				'html' => '<img src="http://54.186.103.115/instaamp/images/wmlLogo.gif" alt="WantMyLook.com"><br />'.$imagesHTML,
				'text' => 'WANTMYLOOK.COM - '.$imagesHTML,
				'subject' => 'WANTMYLOOK.COM',
				'from_email' => 'info@wantmylook.com',
				'from_name' => 'WantMyLook',
				'to' => array(
					array(
						'email' => $this->email,
						'type' => 'to'
					)
				),
				'headers' => array('Reply-To' => 'info@wantmylook.com')
			);
			$async = false;
			$ip_pool = 'Main Pool';
			//$send_at = date('Y-m-d h:m:s');
			$resultEmail = $mandrill->messages->send($message, $async, $ip_pool);
			print_r($result);
		} catch(Mandrill_Error $e) {
			// Mandrill errors are thrown as exceptions
			echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
			// A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
			throw $e;
		}
	}
}

?>