<?php
	//Thanks for the scripting help Larry Ullman
	$pageTitle ='Password Management';
	include('header.php');
	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$errors = array();
		
			
		if(empty($_POST['email']))
		{
			$errors[] = 'Enter Email!';
		}
		else
		{
			$email = mysqli_real_escape_string($dbc,trim($_POST['email']));
		}//end if-else
			
		if(empty($_POST['currentPassword']))
		{
			$errors[] = 'Enter Current Password!';
		}
		else
		{
			$currentPassword = mysqli_real_escape_string($dbc,trim($_POST['currentPassword']));
		}//end if-else
			
		if(empty($_POST['newPassword1']))
		{
			$errors[] = 'Enter New Password!';
		}
		else
		{
			$newPassword1 = mysqli_real_escape_string($dbc,trim($_POST['newPassword1']));
		}//end if-else
			
		if(empty($_POST['newPassword2']))
		{
			$errors[] = 'Confirm New Password!';
		}
		else
		{
			$newPassword2 = mysqli_real_escape_string($dbc,trim($_POST['newPassword2']));
		}//end if-else
			
		if(!empty($_POST['newPassword1']))
		{
			if($_POST['newPassword1'] != $_POST['newPassword2'])
			{
				$errors[] = 'Your Passwords Don\'t match';
			}
			else
			{
				$newPassword = mysqli_real_escape_string($dbc,trim($_POST['newPassword1']));
			}//end if-else
			
		}
		else
		{
			$errors[] = 'Enter Password!';
		}//end if-else
			
		
		if(empty($errors))
		{
			$query = "SELECT user_id FROM users WHERE (email='$email')";
			$response = @mysqli_query($dbc,$query);
			$numberRows = @mysqli_num_rows($response);
			if($numberRows==1)
			{
				$row = mysqli_fetch_array($response, MYSQLI_NUM);
				
				$query = "UPDATE users SET pass=SHA1('$newPassword') WHERE  user_id=$row[0]";
				$response = @mysqli_query($dbc,$query);
				
				if(mysqli_affected_rows($dbc)==1)
				{
					echo "Your Password has been Updated";
				}
				else
				{
					echo "Error\n";
					echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>';
				}//end if-else
			}
			else
			{
				echo "A System Error is Preventing Password Update, Please Try Again\n";
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>';				
			}//end if-else
		}
		else
		{	
			foreach($errors as $message)
			{
				echo "$message\n";
			}//end foreach
		}//end if-else
	}		
	mysqli_close($dbc);
?>
<html>
	<body>
		
		<fieldset>
		<legend align="center"><h2>Password Change</h2></legend>
			<form action="password.php" method="post">
				<!--Email Address-->
				<label for="email">Email:</label>
				<input type="text" id="email" name="email" value="<?php echo $_POST['email'] ?>"><br><br>
				<!--Current Password-->
				<label for="currentPassword"  align="center">Current Password:</label>
				<input type="text" id="currentPassword" name="currentPassword"><br><br>
				<!--New Password-->
				<label for="newPassword1"  align="center">New Password:</label>
				<input type="text" id="newPassword1" name="newPassword1"><br><br>
				<!--New Password Confirm-->
				<label for="newPassword2" >Password Confirm:</label>
				<input type="text" id="newPassword2" name="newPassword2"><br><br>
				<!--Submit Button-->
				<input type="submit" name="newPassword" value"Submit"/>
			</form>
		</fieldset>
	</body>
</html>
<?php include('./includes/footer.php');?>