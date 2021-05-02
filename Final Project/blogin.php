<?php
	include('./includes/mySQLiConnect.php');
	include('./includes/functions.php');

	//Thanks for the scripting help Larry Ullman
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		list($check,$data) = loginCheck($dbc,$_POST['email'], $_POST['password']);
		
		if($check)
		{
			$_SESSION['user_id'] = $data['user_id'];
			
			$_SESSION['first_name'] = $data['first_name'];
			
			$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);
			
			userRedirect('bloggedIn.php');
		}
		else
		{
			$errors = $data;
		}//end if-else
	}//end if
	mysqli_close($dbc);
?>
<!--End Login(index)-->
