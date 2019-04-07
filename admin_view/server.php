<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'explordb');

	// initialize variables
	
	$update = false;

	$id_manager = 0;
	$manag_login= "";
	$manag_password= "";
	$m_usertype = "";
	$manag_surname= "";
	$manag_name= ""; 
	$manag_fname= ""; 
	$manag_phone= ""; 
	$m_anoth_phone= "";


	$id_client= 0;
	$cl_login= "";
	$cl_password= "";
	$user_type= "";
	$cl_surname= "";
	$cl_name= "";
	$cl_fname= "";
	$passport_n= "";
	$birthday= "";
	$email= "";
	$cl_phone= "";

	$tab_number = 0;
	$g_login= "";
	$g_password= "";
	$g_usertype= "";
	$g_surname= ""; 
	$g_name= ""; 
	$g_fname= ""; 
	$g_phone= "";
	$g_anoth_phone= "";

	if (isset($_POST['save_manag'])) {
		$manag_login = $_POST['login'];
		$manag_password= $_POST['password'];
		$m_usertype= $_POST['usertype'];
		$manag_surname= $_POST['surname'];
		$manag_name = $_POST['name'];
		$manag_fname= $_POST['fname'];
		$manag_phone = $_POST['phone'];
		$m_anoth_phone = $_POST['anoth_phone'];

		mysqli_query($db, "INSERT INTO managers (manag_login, manag_password,m_usertype, manag_surname, manag_name, manag_fname, manag_phone, m_anoth_phone) VALUES ('$manag_login','$manag_password','$m_usertype', '$manag_surname', '$manag_name', '$manag_fname', '$manag_phone', '$m_anoth_phone')"); 
		$_SESSION['message'] = "Manager add"; 
		header('location: managers.php');
	}

	if (isset($_POST['update_manag'])) {
		$id_manager = $_POST['id'];
		$manag_login = $_POST['login'];
		$manag_password= $_POST['password'];
		$m_usertype= $_POST['usertype'];
		$manag_surname= $_POST['surname'];
		$manag_name = $_POST['name'];
		$manag_fname= $_POST['fname'];
		$manag_phone = $_POST['phone'];
		$m_anoth_phone = $_POST['anoth_phone'];

		mysqli_query($db, "UPDATE managers SET manag_login='$manag_login', manag_password='$manag_password',m_usertype='$m_usertype',manag_surname='$manag_surname',manag_name='$manag_name',manag_fname='$manag_fname',manag_phone='$manag_phone',m_anoth_phone='$m_anoth_phone' WHERE id_manager=$id_manager");
		$_SESSION['message'] = "Admin info updated!"; 
		header('location: managers.php');
	}


if (isset($_GET['del_manag'])) {
	$id_manager = $_GET['del_manag'];
	mysqli_query($db, "DELETE FROM managers WHERE id_manager=$id_manager");
	$_SESSION['message'] = "Admin deleted!"; 
	header('location: managers.php');
}


if (isset($_POST['save_cl'])) {
		$cl_login = $_POST['login'];
		$cl_password= $_POST['password'];
		$user_type= $_POST['usertype'];
		$cl_surname = $_POST['surname'];
		$cl_name= $_POST['name'];
		$cl_fname = $_POST['fname'];
		$passport_n = $_POST['passport'];
		$birthday= $_POST['birthday'];
		$email= $_POST['email'];
		$cl_phone= $_POST['phone'];

		mysqli_query($db, "INSERT INTO clients (cl_login, cl_password, user_type, cl_surname, cl_name, cl_fname, passport_n, birthday, email, cl_phone) VALUES ('$cl_login','$cl_password', '$user_type', '$cl_surname', '$cl_name', '$cl_fname', '$passport_n','$birthday','$email','$cl_phone')"); 
		$_SESSION['message'] = "Client add"; 
		header('location: clients.php');
	}

	if (isset($_POST['update_cl'])) {
		$id_client = $_POST['id'];
		$cl_login = $_POST['login'];
		$cl_password= $_POST['password'];
		$user_type= $_POST['usertype'];
		$cl_surname = $_POST['surname'];
		$cl_name= $_POST['name'];
		$cl_fname = $_POST['fname'];
		$passport_n = $_POST['passport'];
		$birthday= $_POST['birthday'];
		$email= $_POST['email'];
		$cl_phone= $_POST['phone'];

		mysqli_query($db, "UPDATE clients SET cl_password='$cl_password',user_type='$user_type',cl_surname='$cl_surname',cl_name='$cl_name',cl_fname='$cl_fname',passport_n='$passport_n',birthday='$birthday',email='$email',cl_phone='$cl_phone' WHERE id_client=$id_client");
		$_SESSION['message'] = "Client info updated!"; 
		header('location: clients.php');
}



if (isset($_GET['del_cl'])) {
	$id_client = $_GET['del_cl'];
	mysqli_query($db, "DELETE FROM clients WHERE id_client=$id_client");
	$_SESSION['message'] = "Client deleted!"; 
	header('location: clients.php');
}




	if (isset($_POST['save_g'])) {
		$g_login = $_POST['login'];
		$g_password= $_POST['password'];
		$g_usertype= $_POST['usertype'];
		$g_surname = $_POST['surname'];
		$g_name= $_POST['name'];
		$g_fname = $_POST['fname'];
		$g_phone = $_POST['phone'];
		$g_anoth_phone = $_POST['anoth_phone'];

		mysqli_query($db, "INSERT INTO guides (g_login, g_password, g_usertype, g_surname, g_name, g_fname, g_phone, g_anoth_phone) VALUES ('$g_login','$g_password', '$g_usertype', '$g_surname', '$g_name', '$g_fname', '$g_phone','$g_anoth_phone')"); 
		$_SESSION['message'] = "Guide add"; 
		header('location: guides.php');
	}

	if (isset($_POST['save_l'])) {
		$guides_fk = $_POST['id_g'];
		$languag_fk= $_POST['lan_id'];

		mysqli_query($db, "INSERT INTO possess (guides_fk, languag_fk) VALUES (1, $languag_fk)"); 
		$_SESSION['message'] = "Guide language add"; 
		header('location: guides.php');
	}


	if (isset($_POST['update_g'])) {
		$tab_number = $_POST['id'];
		$g_login = $_POST['login'];
		$g_password= $_POST['password'];
		$g_usertype= $_POST['usertype'];
		$g_surname = $_POST['surname'];
		$g_name= $_POST['name'];
		$g_fname = $_POST['fname'];
		$g_phone = $_POST['phone'];
		$g_anoth_phone = $_POST['anoth_phone'];

		mysqli_query($db, "UPDATE guides SET g_login='$g_login', g_password='$g_password',g_usertype='$g_usertype',g_surname='$g_surname',g_name='$g_name',g_fname='$g_fname',g_phone='$g_phone', g_anoth_phone='$g_anoth_phone' WHERE tab_number=$tab_number");
		$_SESSION['message'] = "Guide info updated!"; 
		header('location: guides.php');
	}


if (isset($_GET['del_g'])) {
	$tab_number = $_GET['del_g'];
	mysqli_query($db, "DELETE FROM guides WHERE tab_number=$tab_number");
	$_SESSION['message'] = "Guide deleted!"; 
	header('location: guides.php');
}


	$id_carrier = 0;
	$car_number= "";
	$name_company= "";
	$seats;
	$driver_license= ""; 

	if (isset($_POST['save_carrier'])) {
		$car_number = $_POST['car_number'];
		$name_company= $_POST['name'];
		$seats= $_POST['seats'];
		$driver_license = $_POST['driver_license'];

		mysqli_query($db, "INSERT INTO carrier (car_number, name_company, seats, driver_license) VALUES ('$car_number','$name_company', $seats, '$driver_license')"); 
		$_SESSION['message'] = "Carrier add"; 
		header('location: carriers.php');
	}

	if (isset($_POST['update_carrier'])) {
		$id_carrier = $_POST['id'];
		$car_number = $_POST['car_number'];
		$name_company= $_POST['name'];
		$seats= $_POST['seats'];
		$driver_license = $_POST['driver_license'];

		mysqli_query($db, "UPDATE carrier SET car_number='$car_number', name_company='$name_company',seats=$seats,driver_license='$driver_license' WHERE id_carrier=$id_carrier");
		$_SESSION['message'] = "Carrier info updated!"; 
		header('location: carriers.php');
	}


if (isset($_GET['del_carrier'])) {
	$id_carrier = $_GET['del_carrier'];
	mysqli_query($db, "DELETE FROM carrier WHERE id_carrier=$id_carrier");
	$_SESSION['message'] = "Carrier deleted!"; 
	header('location: carriers.php');
}

?>