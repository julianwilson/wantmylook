<?php
session_start();
require_once '../Instagram.php';
require_once 'db.php';
require_once 'constants.php';


// Instantiate the API handler object
$instagram = new Instagram($instaConfig);
$accessToken = $instagram->getAccessToken();
$_SESSION['InstagramAccessToken'] = $accessToken;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>WantMyLook.com</title>
</head>

<body>

<div style="width: 1155px; margin: 0 auto; align: center">
<img src="images/top.jpg" />
<div style="margin-left: 115px">
<h2>Last Step! Please Enter Your Email Address:</h2>
<form name="input" action="thankyou.php" method="post">
<input type="text" name="email" />
<input type="submit" />
</form>
</div>
<img src="images/bottom.jpg" />
</div>
</body>
</html>
