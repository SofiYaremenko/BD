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


	if (isset($_POST['save_ex'])) {
		$name_excurs = $_POST['name'];
		$discrip_excurs= $_POST['discrip'];
		$min_people= $_POST['min'];
		$max_people = $_POST['max'];
		$duration= $_POST['duration'];
		$cost_excurs = $_POST['cost'];
		$winter = $_POST['winter'];
		$spring= $_POST['spring'];
		$summer= $_POST['summer'];
		$autumn= $_POST['autumn'];

		mysqli_query($db, "INSERT INTO excursions (name_excurs, discrip_excurs, min_people, max_people, duration, cost_excurs, winter, spring, summer, autumn) VALUES ('$name_excurs','$discrip_excurs', $min_people, $max_people, '$duration', $cost_excurs, $winter, $spring, $summer, $autumn)"); 
		$_SESSION['message'] = "Elient add"; 
		header('location: excursions.php');
	}

	if (isset($_POST['update_ex'])) {
		$id_excursion = $_POST['id'];
		$name_excurs = $_POST['name'];
		$discrip_excurs= $_POST['discrip'];
		$min_people= $_POST['min'];
		$max_people = $_POST['max'];
		$duration= $_POST['duration'];
		$cost_excurs = $_POST['cost'];
		$winter = $_POST['winter'];
		$spring= $_POST['spring'];
		$summer= $_POST['summer'];
		$autumn= $_POST['autumn'];

		mysqli_query($db, "UPDATE excursions SET  name_excurs='$name_excurs', discrip_excurs='$discrip_excurs', min_people=$min_people, max_people=$max_people, duration='$duration', winter=$winter, spring=$spring, summer=$summer, autumn=$autumn WHERE id_excursion=$id_excursion");
		$_SESSION['message'] = "Elient info updated!"; 
		header('location: excursions.php');
}



if (isset($_GET['del_ex'])) {
	$id_excursion = $_GET['del_ex'];
	mysqli_query($db, "DELETE FROM excursions WHERE id_excursion=$id_excursion");
	$_SESSION['message'] = "Excursion deleted!"; 
	header('location: excursions.php');
}

?>