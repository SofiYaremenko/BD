<?php  include('server.php');

  if (isset($_GET['edit_carrier'])) {
    $id_carrier = $_GET['edit_carrier'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM carrier WHERE id_carrier=$id_carrier");

    if (mysqli_num_rows($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $car_number= $n['car_number'];
      $name_company= $n['name_company'];
      $seats= $n['seats'];
      $driver_license= $n['driver_license'];
      
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
  <a href="clients.php">Clients</a>
  <a href="places.php">Places</a>
  <a href="orders.php">Orders</a>
  <a class="active" href="carriers.php">Carriers</a>
  <a href="guides.php">Guides</a>
  <a href="managers.php">Managers</a>
  <a href="order_excursions.php">Order excursions</a>
  <a href="../logout.php" style="float:right"> Logout </a>
</div>

<?php if (isset($_SESSION['message'])): ?>
  <div class="msg">
    <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>
<?php $results = mysqli_query($db, "SELECT * FROM carrier"); ?>

<table>
  <thead>
    <tr>
      <th>Car Number</th>
      <th>Company</th>
      <th>Seats</th>
      <th>Driver License</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['car_number']; ?></td>
      <td><?php echo $row['name_company']; ?></td>
      <td><?php echo $row['seats']; ?></td>
      <td><?php echo $row['driver_license']; ?></td>
      <td>
        <a href="carriers.php?edit_carrier=<?php echo $row['id_carrier']; ?>" class="edit_btn" >Edit</a>
      </td>
      <td>
        <a href="server.php?del_carrier=<?php echo $row['id_carrier']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

  <form method="post" action="server.php" >
    <div class="input-group">
    <input type="hidden" name="id" value="<?php echo $id_carrier; ?>">
    </div>
    <div class="input-group">
      <label>Car Number</label>
      <input type="text" name="car_number" value="<?php echo $car_number; ?>">
    </div>
    <div class="input-group">
      <label>Company</label>
      <input type="text" name="name" value="<?php echo $name_company; ?>">
    </div>
    <div class="input-group">
      <label>Seats</label>
      <input type="text" name="seats"value="<?php echo $seats; ?>">
    </div>
    <div class="input-group">
      <label>Driver License</label>
      <input type="text" name="driver_license" value="<?php echo $driver_license; ?>">
    </div>
    
    <div class="input-group">
      <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update_carrier" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="save_carrier" >Add</button>
      <?php endif ?>
    </div>
  </form>

</body>
</html>