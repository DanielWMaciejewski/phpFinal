<footer>
	<!--Don't be stealin' my brilliant work!-->
	<hr width="50%">
	<?php
		if($_SESSION['user_id']!=NULL)
		{
			echo 'Hello user #'.$_SESSION['user_id'].' Enjoy your Blogging!';
		}
	?>	
	<p align="center"><i>&copy; 2021 Daniel Maciejewski</i></p>
	<hr width="50%">

</footer>