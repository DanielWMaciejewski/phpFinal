<? include('header.php'); ?>
<html>
	<body>
		<fieldset>
		<legend align="center"><h2>Login</h2></legend>
			<form action="blogin.php" method="post">

				<!--New Password-->
				<label for="email"  align="center">Email:</label>
				<input type="text" id="email" name="email" value="<?php echo $_POST['email']; ?>"><br><br>
				<!--New Password Confirm-->
				<label for="password" >Password:</label>
				<input type="text" id="password" name="password" value="<?php echo $_POST['password']; ?>"><br><br>
				<input type="submit" name="submit" />
		</fieldset>
	</body>
</html>
<?php include('./includes/footer.php');?>