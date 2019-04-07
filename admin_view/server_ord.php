<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'explordb');

	// initialize variables
	
	$update = false;

	$id_order= 0;
	$order_date= "";
	$deadline_pay= "";
	$persons= 0;
	$language= 0;
	$response= "";
	$discount= 0;
	$if_payed= 0;
	$status= 0;
	$client_c_id= 0;
	$manag_c_id= 0;
	$excurs_c_id= 0;


	`order`(`id_order`, `order_date`, `deadline_pay`, `persons`, `language`, `response`, `discount`, `if_payed`, `status`, `client_c_id`, `manag_c_id`, `excurs_c_id`

?>