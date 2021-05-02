<?php
	include('header.php');
?>
<html>

	<body>
		<p>To delete a comment, enter the ID and click "submit".</p>
		<form action="<?php echo basename(__FILE__);?>">
		Comment ID: <input name="id" type="text" size="20" value="<?php echo $_POST['id'];?>"><!--ID box-->
		<?php
			//checks if php has stored an id
			if (($_GET['id']== NULL) && ($_SERVER["REQUEST_METHOD"]=="GET"))
			{
			   echo "<br /><strong>Please enter an id!</strong> <br />";
			}
		?>		
		<input type="submit" name="submit" value="Submit"/><!--initiates sending of data to server-->

		</form>
		<?php
			$id = $_GET['id'];
			$query = "DELETE FROM blogposts WHERE guestbook.id = '$id'";
			
			$result = @mysqli_query($dbc,$query);
			//report results
			if($result)
			{
				echo "Comment id: ".$id." has been deleted";
			}
				else
			{
				echo "Error: ".mysqli_error($dbc);
			}
		?>
	</body>
	<?php
		include("./includes/footer.php");//bring in footer file
	?>
</html>