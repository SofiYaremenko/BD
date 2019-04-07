<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'explordb');

	// initialize variables
	
	$update = false;

	$id_excursion= 0;
	$name_excurs= "";
	$discrip_excurs= "";
	$min_people= 0;
	$max_people= 0;
	$duration= "";
	$cost_excurs= 0;
	$winter= 0;
	$spring= 0;
	$summer= 0;
	$autumn= 0;

?>