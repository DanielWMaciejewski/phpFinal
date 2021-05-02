<?php
	//Thanks for the scripting help Larry Ullman
	$pageTitle ='View Bloggers';
	include('header.php');
	
	$query = "SELECT CONCAT(first_name, ', ', last_name) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS  dateRegistered FROM users ORDER BY registration_date ASC";
	$response = @mysqli_query($dbc,$query);
	
	$numberOfRows = mysqli_num_rows($response);
	
	if($numberOfRows > 0)
	{
		echo "There are $numberOfRows registered users\n";
		
		//echo the table like an animal
		echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
		<tr><td align="left">Blogger Name</td><td align="left">Date Registered</td></tr>
		';
		while($row = mysqli_fetch_array($response, MYSQLI_ASSOC))
		{
			echo '<tr><td align="left">' .$row['name'] . '</td><td align="left">' . $row['dateRegistered'] . '</td></tr>';
		}//end while
		echo '</table>';
	}
	else
	{
		echo 'There are no registered users';
	}//end if-else
		
	mysqli_close($dbc);

	include('./includes/footer.php');
?>