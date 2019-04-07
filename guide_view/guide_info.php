<?php  
session_start();
  require_once "../config.php";

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo "LOG IN FIRST";
    header('location:../login.php');
  }else{
      $username = $_SESSION['username'];

      $sql = mysqli_query($link, "SELECT * FROM guides WHERE g_login='$username'");

    if(mysqli_num_rows($sql) == 0){
          die("This username could not be found! ");
      }
      while ($n = mysqli_fetch_array($sql)){
      $g_login= $n['g_login'];
      $g_password= $n['g_password'];
      $g_usertype= $n['g_usertype'];
      $g_surname= $n['g_surname'];
      $g_name= $n['g_name'];
      $g_fname= $n['g_fname'];
      $g_phone= $n['g_phone'];
      $g_anoth_phone= $n['g_anoth_phone'];
    }
  } 

?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="guidestyle.css">


</head>
<body>

<div class="topnav"> <a class="hover">ExplorUAm</a>
  <a href="future_excurs.php">My future excursions</a>
  <a class="active" href="guide_info.php">Account</a>
  <a href="../logout.php" style="float:right"> Logout </a>
</div>

<form method="post" action="guide_info.php">
    <div class="input-group">
    <input  type="hidden" name="id" value="<?php echo $id; ?>" readonly>
    </div>
    <div class="input-group">
      <label>Login</label>
      <input type="text" name="login" value="<?php echo $g_login; ?>" readonly>
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password" value="<?php echo $g_password; ?>" readonly>
    </div>
    <div class="input-group">
      <input type="hidden" name="usertype" value="<?php echo $g_usertype; ?>">
    </div>
    <div class="input-group">
      <label>Surname</label>
      <input type="text" name="surname"value="<?php echo $g_surname; ?>" readonly>
    </div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $g_name; ?>" readonly>
    </div>
    <div class="input-group">
      <label>Fname</label>
      <input type="text" name="fname" value="<?php echo $g_fname; ?>" readonly>
    </div>
    <div class="input-group">
      <label>Phone</label>
      <input type="text" name="phone" value="<?php echo $g_phone; ?>" readonly>
    </div>
    <div class="input-group">
      <label>Additional Phone</label>
      <input type="text" name="anoth_phone" value="<?php echo $g_anoth_phone; ?>" readonly>
    </div>
    
  </form>


</body>
</html>