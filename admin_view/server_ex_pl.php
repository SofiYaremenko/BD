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
		$_SESSION['message'] = "Excursion add"; 
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
		$_SESSION['message'] = "Excursion info updated!"; 
		header('location: excursions.php');
}



if (isset($_GET['del_ex'])) {
	$id_excursion = $_GET['del_ex'];
	mysqli_query($db, "DELETE FROM excursions WHERE id_excursion=$id_excursion");
	$_SESSION['message'] = "Excursion deleted!"; 
	header('location: excursions.php');
}

	$id_place= 0;
	$name_place= "";
	$discrip_place= "";
	$max_people_place= 0;
	$provider= "";
	$longitude= 0;
	$latitude= 0;

	if (isset($_POST['save_pl'])) {
		$name_place = $_POST['name'];
		$discrip_place= $_POST['discrip'];
		$max_people_place = $_POST['max'];
		$provider= $_POST['provider'];
		$longitude = $_POST['long'];
		$latitude = $_POST['lat'];

		mysqli_query($db, "INSERT INTO places (name_place, discrip_place,  max_people_place, provider, longitude, latitude) VALUES ('$name_place','$discrip_place', $max_people_place, '$provider', $longitude, $latitude)"); 
		$_SESSION['message'] = "Place add"; 
		header('location: places.php');
	}

	if (isset($_POST['update_pl'])) {
		$id_place = $_POST['id'];
		$name_place = $_POST['name'];
		$discrip_place= $_POST['discrip'];
		$max_people_place = $_POST['max'];
		$provider= $_POST['provider'];
		$longitude = $_POST['long'];
		$latitude = $_POST['lat'];

		mysqli_query($db, "UPDATE places SET  name_place='$name_place', discrip_place='$discrip_place', max_people_place=$max_people_place, provider='$provider', longitude=$longitude, latitude=$latitude WHERE id_place=$id_place");
		$_SESSION['message'] = "Place info updated!"; 
		header('location: places.php');
}



if (isset($_GET['del_pl'])) {
	$id_place = $_GET['del_pl'];
	mysqli_query($db, "DELETE FROM places WHERE id_place=$id_place");
	$_SESSION['message'] = "Place deleted!"; 
	header('location: places.php');
}

?>