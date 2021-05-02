<?php
	//Thanks for the scripting help Larry Ullman
	$pageTitle = "Logged In";
	include('header.php');
	
	if((isset($_SESSION['agent']) AND ($_SESSION['agent'] == md5($_SERVER['HTTP_USER_AGENT']) )))
	{
		userRedirect('blogin.php');
	}//end if
	else
	{
		userRedirect('index.php');
	}
?>