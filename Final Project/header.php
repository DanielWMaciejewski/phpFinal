<?php
	include('./includes/functions.php');
	include('./includes/mySQLiConnect.php');
	session_start();
?>

<html>
	<head>
		<meta charset-"utf-8 (Without BOM)">
		<title><?php echo $pageTitle;?></title>
		<meta name="A blog by Dan" content="Blog">
		<meta name="Daniel maciejewski" content="Whateva">
		<link rel="stylesheet" href="https://maciej27.uwmsois.com/Final Project/includes/style.css" rel="stylesheet">
	</head>
	<h1 align="center">Blog</h1>
	<hr width="50%">
	<div align="center">
		<?php //Create link section
			if(isset($_SESSION['user_id']))
			{
				echo'
					<a href="createBlogPost.php">Make a Post</a>
					|
					<a href="blogPasswordManagement.php">Change Password</a>
					|
					<a href="blogout.php">Logout</a>';
			}//end if
			echo'<a href="bloginForm.php">Login</a> 
				| <a href="blogRegister.php">Register</a> 
				| <a href="viewBloggers.php">View Bloggers</a>
				| <a href="index.php">View Blogs</a>';
		?>
	</div>
	<hr width="50%">
	<br>
	<br>
</html>