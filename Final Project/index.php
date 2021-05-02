<?php
	$pageTitle='Blog Home';
	include('header.php');
?>
<html>
	<!--Final Project By Daniel Maciejewski-->
	<!--This page is the locus of several scripts that involve of blog posts-->
	<body>
		<h2 align="center">Posts</h2>
		
		<?php
			//Making tables in this stuff is atrocious
			echo '<table align= "center">
			<tr><td colspan="3" align="center">Order By</td></tr><tr>
			<td align= "left"><strong><a href="index.php?sort=pda">Post Date ASC</a></strong></td>
			<td align="left"><strong><a href="index.php?sort=pdd">Post Date DESC</a></strong></td>
			<td align= "left"><strong><a href="index.php?sort=ta">Title ASC</a></strong></td>
			<td align= "left"><strong><a href="index.php?sort=td">Title DESC</a></strong></td>
			</tr><input type="hidden" name="id" value="'.$row['id'].'"></table>';			
			
			if ($_SESSION['user_id']==1){echo "<a href='update.php?id=$blog_id'>Update</a> | <a href='delete.php?id=$blog_id'>Delete</a>";}
			$display = 5;
			//Pagination
			if(isset($_GET['p']) && is_numeric($_GET['p']))
			{
				$pages = $_GET['p'];
			}
			else
			{
				$q ="SELECT COUNT(blog_id) FROM blogposts";
				
				$r = @mysqli_query($dbc,$q);
				
				$rowy = @mysqli_fetch_array($r, MYQLI_NUM);
				
				$records = $rowy[0];
				
				if($records > $display)
				{
					$pages = ceil($records/$display);
				}
				else
				{
					$pages = 1;
				}
			}//end if
			
			if(isset($_GET['s']) && is_numeric($_GET['s']))
			{
				$start = $_GET['s'];
			}
			else
			{
				$start = 0;
			}//end if
				
			$sort =(isset($_GET['sort'])) ? $_GET['sort'] : 'date';
			
			switch($sort)
			{
				case 'pda':
					$orderBy = 'post_date ASC';
					break;
					
				case 'pdd':
					$orderBy = 'post_date DESC';
					break;
					
				case 'ta':
					$orderBy = 'title ASC';
					break;
				
					case 'td':
						$orderBy = 'title DESC';
						break;
					
				default:
					$orderBy = 'post_date DESC';
			}//end switch
			

			
			$query = "SELECT * FROM blogposts JOIN users USING (user_id) WHERE blog_id=$id";
			//$query = "SELECT * FROM blogposts ORDER BY $orderBy LIMIT $start, $display";//create the query
			
			$results = mysqli_query($dbc,$query);//query format function

			//Still more table horror
			echo "<br><hr width=\"70%\"><br>";
			
			while($row = mysqli_fetch_array($results, MYSQLI_ASSOC))
			{
				$blog_id = $row['blog_id'];
				$title = $row['title'];
				$post = $row['post'];
				echo "<table width=\"80%\" border=\"1\">";
				echo "<tr>";
				echo "<td colspan=\"2\"><div align=\"center\"><strong>Comments</strong></div>";
				echo "</tr>";
				echo "<tr>";
				echo "<td width\"200\">". $row['blog_id']."</td>";
				echo "<td rowspan=\"5\" colspan=\"20\"><div align=\"center\">". $row['title']."</td></div>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>".$row['fname']." ".$row['lname']."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>". $row['email']."</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td> Comment ID: ". $row['id']."</td>";
				echo "</tr>";
				echo "<tr>";
				echo '<td align= "left"><strong><a href="updateHandle.php?id='.$row['id'].'">Update Comment</a></strong><strong> | <a href="index.php?deleteID='.$row['id'].'">Delete Comment</a></strong></td>';
				echo "</tr>";
				echo "</table>";
				echo "<br>";
				echo "<hr width=\"70%\">";
				echo "<br>";
			}
			//Deletion Handling
			if((isset($_GET['deleteID'])) && (is_numeric($_GET['deleteID'])))
			{
				$deleteID = $_GET['deleteID'];
				if($_SERVER['REQUEST_METHOD']=='GET')
				{
					$q = "DELETE FROM blog WHERE id = $deleteID";
					$r = @mysqli_query($dbc,$q);
					if(mysqli_affected_rows($dbc)==1)
					{
						echo'<p>Comment Deleted</p>';//huzzah!
					}
					else
					{
						echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';//bug message 
					}//end ifelse
				}//end if
			}
			else
			{
				echo "Erroneous Access";
			}//end if/elseif/else


			
			
			
			//More pagination
			if($pages > 1)
			{
				echo '<br /><p>';//initial <p> tag
				$currentPage = ($start/$display)+1;
				//next button
				if($currentPage != 1)
				{
					echo '<a href="?s='.($start-$display).'&p='.$pages.'&sort='.$sort.'">Previous</a>';
				}//end if

				//Number the pages
				for ($i=1;$i<=$pages;$i++)
				{
					if($i != $currentPage)
					{
						echo '<a href="?s='.(($display*($i-1))).'&p='.$pages.'&sort='.$sort.'">'.$i.'</a>';
					}//end if
					else
					{
						echo $i.' ';
					}//end if-else
				}//end for
			
				//Next Button
				if($currentPage != $pages)
				{
					echo '<a href="?s='.($start+$display).'&p='.$pages.'&sort='.$sort.'">Next</a>';
				}//end if
				
				echo '</p>';//close the initial <p> tag
			}//end "if links"
			

		?>
	</body>
</html>	
	<?php
		mysqli_close($dbc);
		include("./includes/footer.php");
	?>
	
