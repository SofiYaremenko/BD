<?php  include('server.php');

  if (isset($_GET['edit_manag'])) {
    $id_manager = $_GET['edit_manag'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM managers WHERE id_manager=$id_manager");

    if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $manag_login= $n['manag_login'];
      $manag_password= $n['manag_password']; 
      $m_usertype= $_POST['m_usertype'];
      $manag_surname= $n['manag_surname'];
      $manag_name= $n['manag_name'];
      $manag_fname= $n['manag_fname'];
      $manag_phone= $n['manag_phone'];
      $m_anoth_phone= $n['m_anoth_phone'];
    }
  }
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="adminstyle.css">
</head>
<body>

<div class="topnav"><a class="hover">ExplorUAm</a>
  <a href="excursions.php">Excursions</a>
  <a href="clients.php">Clients</a>
  <a href="places.php">Places</a>
  <a href="orders.php">Orders</a>
  <a href="carriers.php">Carriers</a>
  <a href="guides.php">Guides</a>
  <a class="active" href="managers.php">Managers</a>
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
<?php $results = mysqli_query($db, "SELECT * FROM managers"); ?>

<table>
  <thead>
    <tr>
      <th>Login</th>
      <th>Password</th>
      <th>User Type</th>
      <th>Surname</th>
      <th>Name</th>
      <th>Fname</th>
      <th>Phone</th>
      <th>Additional Phone</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['manag_login']; ?></td>
      <td><?php echo $row['manag_password']; ?></td>
      <td><?php echo $row['m_usertype']; ?></td>
      <td><?php echo $row['manag_surname']; ?></td>
      <td><?php echo $row['manag_name']; ?></td>
      <td><?php echo $row['manag_fname']; ?></td>
      <td><?php echo $row['manag_phone']; ?></td>
      <td><?php echo $row['m_anoth_phone']; ?></td>
      <td>
        <a href="managers.php?edit_manag=<?php echo $row['id_manager']; ?>" class="edit_btn" >Edit</a>
      </td>
      <td>
        <a href="server.php?del_manag=<?php echo $row['id_manager']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

  <form method="post" action="server.php" >
    <div class="input-group">
    <input type="hidden" name="id" value="<?php echo $id_manager; ?>">
    </div>
    <div class="input-group">
      <label>Login</label>
      <input type="text" name="login" value="<?php echo $manag_login; ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="text" name="password" value="<?php echo $manag_password; ?>">
    </div>
    <div class="input-group">
      <label>User Type</label>
      <input type="text" name="usertype"value="<?php echo $m_usertype; ?>">
    </div>
    <div class="input-group">
      <label>Surname</label>
      <input type="text" name="surname"value="<?php echo $manag_surname; ?>">
    </div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $manag_name; ?>">
    </div>
    <div class="input-group">
      <label>Fname</label>
      <input type="text" name="fname" value="<?php echo $manag_fname; ?>">
    </div>
    <div class="input-group">
      <label>Phone</label>
      <input type="text" name="phone" value="<?php echo $manag_phone; ?>">
    </div>
    <div class="input-group">
      <label>Additional Phone</label>
      <input type="text" name="anoth_phone" value="<?php echo $m_anoth_phone; ?>">
    </div>
    <div class="input-group">
      <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update_manag" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="save_manag" >Add</button>
      <?php endif ?>
    </div>
  </form>


</body>
</html>