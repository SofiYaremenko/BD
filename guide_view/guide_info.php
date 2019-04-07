<?php  
 $_SESSION["id"] = $id;
  $db = mysqli_connect('localhost', 'root', '', 'explordb');
  $update = false;

  if (isset($_GET['login'])) {
    $id = $_GET['login'];
    $record = mysqli_query($db, "SELECT * FROM guides WHERE tab_number=$id");

    if (mysqli_num_rows($record) == 1 ) {
      $n = mysqli_fetch_array($record);

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
  if (isset($_GET['edit'])) {
    $tab_number =$_POST['id'];
    $update = true;
  }

if (isset($_POST['update_g'])) {
    $tab_number = $_POST['id'];
    $g_login = $_POST['login'];
    $password= $_POST['password'];
    $g_password= password_hash($password, PASSWORD_DEFAULT);
    $g_usertype= $_POST['usertype'];
    $g_surname = $_POST['surname'];
    $g_name= $_POST['name'];
    $g_fname = $_POST['fname'];
    $g_phone = $_POST['phone'];
    $g_anoth_phone = $_POST['anoth_phone'];

    mysqli_query($db, "UPDATE guides SET g_login='$g_login', g_password='$g_password',g_usertype='$g_usertype',g_surname='$g_surname',g_name='$g_name',g_fname='$g_fname',g_phone='$g_phone', g_anoth_phone='$g_anoth_phone' WHERE tab_number=$tab_number");
    $update = false;
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
  <a href="../main.php" style="float:right"> Logout </a>
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
    <div class="input-group">
      <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update_g" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="edit" >Edit info</button>
      <?php endif ?>
      
    </div>
  </form>


</body>
</html>