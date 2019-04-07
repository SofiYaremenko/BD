<?php  include('server.php');

  if (isset($_GET['edit_cl'])) {
    $id_client = $_GET['edit_cl'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM clients WHERE id_client=$id_client");

    if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);

      $cl_login= $n['cl_login'];
      $cl_password= $n['cl_password'];
      $user_type= $n['user_type'];
      $cl_surname= $n['cl_surname'];
      $cl_name= $n['cl_name'];
      $cl_fname= $n['cl_fname'];
      $passport_n= $n['passport_n'];
      $birthday= $n['birthday'];
      $email= $n['email'];
      $cl_phone= $n['cl_phone'];
    }
  }
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="adminstyle.css">


</head>
<body>

<div class="topnav"> <a class="hover">ExplorUAm</a>
  <a href="excursions.php">Excursions</a>
  <a class="active" href="clients.php">Clients</a>
  <a href="places.php">Places</a>
  <a href="orders.php">Orders</a>
  <a href="carriers.php">Carriers</a>
  <a href="guides.php">Guides</a>
  <a href="managers.php">Managers</a>
  <a href="order_excursions.php">Order excursions</a>
  <a href="../main.php" style="float:right"> Logout </a>
</div>

<?php if (isset($_SESSION['message'])): ?>
  <div class="msg">
    <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>
<?php $results = mysqli_query($db, "SELECT * FROM clients"); ?>

<table>
  <thead>
    <tr>
      <th>Login</th>
      <th>Password</th>
      <th>User type</th>
      <th>Surname</th>
      <th>Name</th>
      <th>Fname</th>
      <th>Passport</th>
      <th>Birthday</th>
      <th>Email</th>
      <th>Phone</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['cl_login']; ?></td>
      <td><?php echo $row['cl_password']; ?></td>
      <td><?php echo $row['user_type']; ?></td>
      <td><?php echo $row['cl_surname']; ?></td>
      <td><?php echo $row['cl_name']; ?></td>
      <td><?php echo $row['cl_fname']; ?></td>
      <td><?php echo $row['passport_n']; ?></td>
      <td><?php echo $row['birthday']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['cl_phone']; ?></td>
      <td>
        <a href="clients.php?edit_cl=<?php echo $row['id_client']; ?>" class="edit_btn" >Edit</a>
      </td>
      <td>
        <a href="server.php?del_cl=<?php echo $row['id_client']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

  <form method="post" action="server.php" >
    <div class="input-group">
    <input type="hidden" name="id" value="<?php echo $id_client; ?>">
    </div>
    <div class="input-group">
      <label>Login</label>
      <input type="text" name="login" value="<?php echo $cl_login; ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="text" name="password" value="<?php echo $cl_password; ?>">
    </div>
    <div class="input-group">
      <label>User Type</label>
      <input type="text" name="usertype"value="<?php echo $user_type; ?>">
    </div>
    <div class="input-group">
      <label>Surname</label>
      <input type="text" name="surname" value="<?php echo $cl_surname; ?>">
    </div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $cl_name; ?>">
    </div>
    <div class="input-group">
      <label>Fname</label>
      <input type="text" name="fname" value="<?php echo $cl_fname; ?>">
    </div>
    <div class="input-group">
      <label>Passport Number</label>
      <input type="text" name="passport" value="<?php echo $passport_n; ?>">
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
      <input type="text" name="phone" value="<?php echo $cl_phone; ?>">
    </div>
    <div class="input-group">
      <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update_cl" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="save_cl" >Add</button>
      <?php endif ?>
    </div>
  </form>

</body>
</html>
