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
          $dbusername = $row['cl_login'];
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

<div class="header" align="center">
    <h2>Profile Info</h2>
</div>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
        
    <table>
        <tr><td>First name:</td><td><?php echo $firstname; ?></td></tr>
        <tr><td>Second name:</td><td><?php echo $fname; ?></td></tr>
        <tr><td>Last name:</td><td><?php echo $lastname; ?></td></tr>
        <tr><td>Email:</td><td><?php echo $email; ?></td></tr>
        <tr><td>Passport data:</td><td><?php echo $passport_num; ?></td></tr>
        <tr><td>Birthday:</td><td><?php echo $birthday; ?></td></tr>
        <tr><td>Phone:</td><td><?php echo $phone; ?></td></tr>
    </table>
    <div align="center">
    <a href="edit_info.php" class="edit_btn"  >Edit Info</a>
  </div>
  <?php endif ?>
</div>

</body>
</html>