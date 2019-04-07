<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'explordb');

	// initialize variables
	
	$update = false;

	$id_order= 0;
	$order_date= "";
	$deadline_pay= "";
	$persons= 0;
	$language= "";
	$response= "";
	$discount= 0;
	$if_payed= 0;
	$status= 0;
	$client_c_id= 0;
	$manag_c_id= 0;
	$excurs_c_id= 0;

		if (isset($_POST['save_or'])) {
		$order_date = $_POST['or_date'];
		$deadline_pay= $_POST['pay_date'];
		$persons= $_POST['persons'];
		$language = $_POST['language'];
		$response= $_POST['response'];
		$discount = $_POST['discount'];
		$if_payed = $_POST['pay'];
		$status= $_POST['status'];
		$client_c_id= $_POST['client_id'];
		$manag_c_id= $_POST['manag_id'];
		$excurs_c_id= $_POST['excurs_id'];

		mysqli_query($db, "INSERT INTO order (order_date, deadline_pay, persons, language, response, discount, if_payed, status, client_c_id, manag_c_id, excurs_c_id) 
			VALUES ('$order_date','$deadline_pay', $persons, '$language', '$response', $discount, $if_payed, $status, $client_c_id, $manag_c_id, $excurs_c_id)"); 
		$_SESSION['message'] = "Order add"; 
		header('location: orders.php');
	}

	if (isset($_POST['update_or'])) {
		$id_order = $_POST['id'];
		$order_date = $_POST['or_date'];
		$deadline_pay= $_POST['pay_date'];
		$persons= $_POST['persons'];
		$language = $_POST['language'];
		$response= $_POST['response'];
		$discount = $_POST['discount'];
		$if_payed = $_POST['pay'];
		$status= $_POST['status'];
		$client_c_id= $_POST['client_id'];
		$manag_c_id= $_POST['manag_id'];
		$excurs_c_id= $_POST['excurs_id'];

		mysqli_query($db, "UPDATE order SET order_date='$order_date',deadline_pay='$deadline_pay', persons=$persons, language='$language', response='$response', discount=$discount, if_payed=$if_payed, status=$status, client_c_id=$client_c_id, manag_c_id=$manag_c_id, excurs_c_id=$excurs_c_id WHERE id_order=$id_order");
		$_SESSION['message'] = "Order info updated!"; 
		header('location: orders.php');
}



if (isset($_GET['del_or'])) {
	$id_order = $_GET['del_or'];
	mysqli_query($db, "DELETE FROM order WHERE id_order=$id_order");
	$_SESSION['message'] = "Order deleted!"; 
	header('location: orders.php');
}

?>