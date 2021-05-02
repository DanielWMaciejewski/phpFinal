<?php
	include('header.php');
?>
<html>
	<?php
        $id = $_GET['id'];
        $user_id = $_SESSION['user_id'];
		$comments = $_POST['comments'];
	?>
	
	<body>
		<form action="<?php echo basename(__FILE__);?>" method="post">
			<label for="fName">First Name</label> <input name="fName" type="text" size="20" value="<?php echo $_POST['fName'];//sticky?>">
			<!--Input Validation-->
			<?php
				//checks if php has stored a first name
				if (($_POST['fName']== NULL) && ($_SERVER["REQUEST_METHOD"]=="POST"))
				{
				   echo "<br /><strong>Please enter your first name!</strong> <br />";
				}
				else
				{
					$fName = mysqli_real_escape_string($dbc, trim($_POST['fName']));
				}
			?>
			<label for="lName">Last Name</label> <input name="lName" type="text" size="20" value="<?php echo $_POST['lName'];//sticky?>">
			<!--Input Validation-->
			<?php
				//checks if php has stored an last name
				if (($_POST['lName']== NULL) && ($_SERVER["REQUEST_METHOD"]=="POST"))
				{
				   echo "<br /><strong>Please enter your last name!</strong> <br />";
				}
				else
				{
					$lName = mysqli_real_escape_string($dbc, trim($_POST['lName']));
				}
			?>
			<br>
			<br>
			<label for="email">Email</label> <input name="email" type="text" size="20" value="<?php echo $_POST['email'];//sticky?>">
			<!--Input Validation-->
			<?php
				//checks if php has stored an email
				if (($_POST['email']== NULL) && ($_SERVER["REQUEST_METHOD"]=="POST"))
				{
				   echo "<br /><strong>Please enter your email!</strong> <br />";
				}
				else
				{
					$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
				}
			?>
			<br>
			<br>
			<label for="title">Title</label> <input name="title" type="text" size="20" value="<?php echo $_POST['title'];//sticky?>">
			<?php
				//checks if php has stored a title
				if (($_POST['title']== NULL) && ($_SERVER["REQUEST_METHOD"]=="POST"))
				{
				   echo "<br /><strong>Please enter a post title!</strong> <br />";
				}
				else
				{
					$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
				}
			?>
			<br>
			<br>
			<label for="comments">Comments</label>
			<br>
			<textarea name="comments" rows="5" cols="50"><?php echo $_POST['comments'];//sticky?></textarea>
			<!--Input Validation-->
			<?php
				//checks if php has stored a comment
				if (($_POST['comments']== NULL) && ($_SERVER["REQUEST_METHOD"]=="POST"))
				{
				   echo "<br /><strong>Please enter your comments!</strong> <br />";
				}
				else
				{
					$comments = mysqli_real_escape_string($dbc, trim($_POST['comments']));
				}
			?>
			<br>
			<?php
				if (($_POST['fName'] != NULL) && ($_POST['lName'] != NULL) && ($_POST['email'] != NULL) && ($_POST['comments'] != NULL)&&($_POST['title']== NULL))
				{
				$query = "INSERT INTO comments (blog_id,user_id,title,post,date,comments) VALUES ('', '$user_id','$title',$comments,'$fName','$lName',NOW(),'$comments')";
			
				$result = @mysqli_query($dbc,$query);
				}
				if($result)
				{
					echo "Submission Success!";
				}
				else
				{
					echo "Error: ". mysqli_error($dbc);
				}
				include('./includes/footer.php');
			?>				
			<input type="Submit" value="Submit">

		</form>

	</body>
</html>