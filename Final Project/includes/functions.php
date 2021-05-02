<?php
	//Thanks Larry Ullman for all the help with the stuff!
	function userRedirect($page)
	{
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);//URL= http:// + host name + current directory
		$url = rtrim($url,'/\\');//get rid of trailing slashes
		$url .= '/' . $page;//add page
		header("Location: $url");
		exit();
	}//end userRedirect
	function loginCheck($dbc,$email='',$pass='')
	{
		$errors = array();
		
		if(empty($email))//email validation
		{
			$errors[] = 'Enter email address';
		}
		else
		{
			$email = mysqli_real_escape_string($dbc,trim($email));
		}//end if-else
		if(empty($pass))//pass validation
		{
			$errors[] = 'Enter password';
		}
		else
		{
			$pass = mysqli_real_escape_string($dbc,trim($pass));
		}//end if-else
		if(empty($errors))
		{
			$query = "SELECT user_id, first_Name FROM users WHERE email ='$email' AND pass=SHA1('$pass')";
			$response = @mysqli_query($dbc,$query);
			if(mysqli_num_rows($response)==1)
			{
				$row = mysqli_fetch_array($response,MYSQLI_ASSOC);
				return array(true,$row);
			}
		}
		else
		{
			$errors[]= 'Email and password don\'t match records';
			return array(false, $errors);//blast em back with this stuff
		}//end if-else
	}//end loginCheck
?>