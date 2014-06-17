<?php
include 'constants.php';

session_start();

$instaReady = (isset($_SESSION['InstagramAccessToken']) && !empty($_SESSION['InstagramAccessToken']));
$authorizationUrl = 'https://api.instagram.com/oauth/authorize/?client_id='.$instaConfig['client_id'].'&redirect_uri='.$instaConfig['redirect_uri'].'&response_type=code';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>WantMyLook.com Instagram Shopper</title>
</head>

<body>
<div style="width: 1155px; margin: 0 auto; align: center">
<img src="images/top.jpg" />
<a href="<? print $authorizationUrl; ?>"><img src="images/cta.jpg" /></a>
<img src="images/bottom.jpg" />
</div>
</html>
