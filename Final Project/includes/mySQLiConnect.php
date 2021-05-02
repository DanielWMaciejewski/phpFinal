<?php
	DEFINE ('DB_HOST','localhost');
	DEFINE ('DB_USER','maciej27_user');
	DEFINE('DB_PASSWORD','NTirxe9RpkUR8FP');
	DEFINE('DB_NAME','maciej27_blog');
	
	$dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) OR die('Ope, the server could be reached, error: '. mysqli_connect_error());
?>