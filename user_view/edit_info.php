<?php
  session_start();
  require_once "../config.php";

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo "LOG IN FIRST";
    header('location:../login.php');
  }else{
      $username = $_SESSION['username'];

      $sql = mysqli_query($link, "SELECT * FROM clients WHERE cl_login='$username'");
     
      if(mysqli_num_rows($sql) == 0){
          die("This username could not be found! ");
      }
      while ($row = mysqli_fetch_array($sql)){
          $id_client = $row['id_client'];
          $dbusername = $row['cl_login'];
          $cl_password= $row['cl_password'];
          $user_type= $row['user_type'];
          $lastname = $row['cl_surname'];
          $firstname = $row['cl_name'];
          $fname = $row['cl_fname'];
          $passport_num = $row['passport_n'];
          $birthday = $row['birthday'];
          $email = $row['email'];
          $phone = $row['cl_phone'];
      }
      if($username != $dbusername){
          die("There has been a fatal error. Please try again.");
      }
      if (isset($_POST['update_info'])) {
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
    
    header('location: user_info.php');
}
  }

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $username; ?> </title>
    <link rel="stylesheet" type="text/css" href="userstyle.css">
</head>
<body>

<div class="topnav"> <a>ExplorUAm</a>
    <a href="main.php">Excursions</a>
    <a href="user_order.php">My Orders</a>
    <a class="active"  href="user_info.php">Account</a>
    <a href="../logout.php" style="float:right"> Logout </a>
</div>

<form method="post" action="edit_info.php" >
    <div class="input-group">
    <input type="hidden" name="id" value="<?php echo $id_client; ?>">
    </div>
    <div class="input-group">
      <label>Login</label>
      <input type="text" name="login" value="<?php echo $dbusername; ?>" readonly>
    </div>
    <div class="input-group">
      <input type="hidden" name="password" value="<?php echo $cl_password; ?>">
    </div>
    <div class="input-group">
      <input type="hidden" name="usertype"value="<?php echo $user_type; ?>">
    </div>
    <div class="input-group">
      <label>Surname</label>
      <input type="text" name="surname" value="<?php echo $lastname; ?>">
    </div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $firstname; ?>">
    </div>
    <div class="input-group">
      <label>Fname</label>
      <input type="text" name="fname" value="<?php echo $fname; ?>">
    </div>
    <div class="input-group">
      <label>Passport Number</label>
      <input type="text" name="passport" value="<?php echo $passport_num; ?>">
    </div>
    <div class="input-group">
      <label>Birthday Date</label>
      <input type="text" name="birthday" value="<?php echo $birthday; ?>">
    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="text" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
      <label>Phone</label>
      <input type="text" name="phone" value="<?php echo $phone; ?>">
    </div>
    <div class="input-group">
      <button class="btn" type="submit" name="update_info" style="background: #ddd;" >Update</button>
    </div>
  </form>


</body>
</html>