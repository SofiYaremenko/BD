<?php
	$connection = mysqli_connect('localhost', 'root', '', 'explordb');

	if (!$connection){
		die("Database Connection Failed" . mysql_error());
	}

?>