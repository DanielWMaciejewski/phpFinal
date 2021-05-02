<?php
	//Thanks for the scripting help Larry Ullman
	$pageTitle ='Logout Page';
	include('header.php');
	
	if(!isset($_SESSION['userID']))
	{
		userRedirect('blogin.php');
	}
	else
	{
		$_SESSION = array();//clear variables
		session_destroy();//destroy session
		setcookie('PHPSESSID', '',time()-3600, '/','',0,0);//destroy cookie
	}//end if-else
	include('./includes/footer.php');
?>