<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'explordb');

// variable declaration
$username = "";
$email    = "";
$firstname =  "";
$lastname =  "";
$phone    =  "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$firstname   =  e($_POST['firstname']);
	$lastname    =  e($_POST['lastname']);
	$phone       =  e($_POST['phone']);
	$birthday    =  e($_POST['birthday']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);
	$birthday = date("Y-m-d", strtotime($birthday));

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($firstname)) { 
		array_push($errors, "Firstname is required"); 
	}
	if (empty($lastname)) { 
		array_push($errors, "Lastname is required"); 
	}
	if (empty($phone)) { 
		array_push($errors, "Phone is required"); 
	}
	if (empty($birthday)) { 
		array_push($errors, "Birthday date is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO `clients`(`id_client`, `cl_login`, `cl_password`, `user_type`, `cl_surname`, `cl_name`, `cl_fname`, `passport_n`, `birthday`, `email`, `cl_phone`)
					  VALUES(NULL, '$username', '$password', '$user_type','$lastname', '$firstname', NULL, NULL, '$birthday' '$email', '$phone')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		}else{
			$query = "INSERT INTO `clients`(`id_client`, `cl_login`, `cl_password`, `user_type`, `cl_surname`, `cl_name`, `cl_fname`, `passport_n`, `birthday`, `email`, `cl_phone`)
					  VALUES(NULL, '$username', '$password', 'user','$lastname', '$firstname', NULL, NULL, '$birthday' '$email', '$phone')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM clients WHERE id=" . $id_client;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}


}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM clients WHERE cl_login='$username' AND cl_password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: user.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>	