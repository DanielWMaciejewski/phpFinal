<?php
	$pageTitle='Blog Registration';
	include('header.php');

	//Thanks for the scripting help Larry Ullman

	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$errors = array();
		
		//first name check
		if(empty($_POST['firstName']))
		{
			$errors[] = 'Enter First Name!';
		}
		else
		{
			$firstName = mysqli_real_escape_string($dbc,trim($_POST['firstName']));
		}//end if-else

			
		if(empty($_POST['lastName']))
		{
			$errors[] = 'Enter Last Name!';
		}
		else
		{
			$lastName = mysqli_real_escape_string($dbc,trim($_POST['lastName']));
		}//end if-else
			
		if(empty($_POST['email']))
		{
			$errors[] = 'Enter Email!';
		}
		else
		{
			$email = mysqli_real_escape_string($dbc,trim($_POST['email']));
		}//end if-else
			
		if(!empty($_POST['password1']))
		{
			if($_POST['password1'] != $_POST['password2'])
			{
				$errors[] = 'Your Passwords Don\'t match';
			}
			else
			{
				$password = mysqli_real_escape_string($dbc,trim($_POST['password1']));
			}//end if-else
			
		}
		else
		{
			$errors[] = 'Enter Password!';
		}//end if-else
			
		
		if(empty($errors))
		{
			$query = "INSERT INTO users (first_name,last_name ,email,pass,registration_date) VALUES ('$firstName','$lastName','$email', SHA1('$password'),NOW())";
			$response = @mysqli_query($dbc,$query);
			if($response)
			{
				echo "Thanks for Registering!";
			}
			else
			{
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>';
			}//end if-else
		}
		else
		{	
			echo "Empty bounce! A System Error is Preventing Registration, Please Try Again\n";
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>';
		}//end if-else
			
		mysqli_close($dbc);
			
	}//end if
	
?>
<html>
	<body>
		<!--Registration Form-->
		<fieldset>
		<legend align="center"><h2>Register for the Blog</h2></legend>
			<form action="register.php" method="post">
				<!--First Name-->
				<label for="firstName">First Name:</label>
				<input type="text" id="firstName" name="firstName" value="<?php echo $_POST['firstName']; ?>"><br><br>
				<!--Last Name-->
				<label for="lastName" align="center" >Last Name:</label>
				<input type="text" id="lastName" name="lastName" value="<?php echo $_POST['lastName']; ?>"><br><br>
				<!--Email Address-->
				<label for="email">Email:</label>
				<input type="text" id="email" name="email" value="<?php echo $_POST['email']; ?>"><br><br>
				<!--Password-->
				<label for="password1"  align="center">Password:</label>
				<input type="text" id="password1" name="password1" ><br><br>
				<!--Password Confirm-->
				<label for="password2" >Password Confirm:</label>
				<input type="text" id="password2" name="password2"><br><br>
				<input type="submit" name="submit" value"Submit"/>
			</form>
		</fieldset>
	</body>
</html>
<?php include('./includes/footer.php');?>