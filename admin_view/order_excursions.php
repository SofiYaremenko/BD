<?php  include('../config.php');

  if (isset($_GET['edit_oe'])) {
    $tab_number = $_GET['edit_oe'];
    $update = true;
    $record = mysqli_query($link, "SELECT * FROM excursion_order WHERE id_excurs_order=$id_excurs_order");

    if (mysqli_num_rows($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $price= $n['price'];
      $excurs_date= $n['excurs_date'];
      $time_start= $n['time_start'];
      $fk_excurs= $n['fk_excurs'];
      $fk_carrier= $n['fk_guides'];
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
  <a href="carriers.php">Carriers</a>
  <a href="guides.php">Guides</a>
  <a href="managers.php">Managers</a>
  <a class="active" href="order_excursions.php">Order excursions</a>
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
<?php $results = mysqli_query($link, "SELECT * FROM excursion_order"); ?>

<table>
  <thead>
    <tr>
      <th>Price</th>
      <th>Date</th>
      <th>Time of start</th>
      <th>Id excursion</th>
      <th>Id carriers</th>
      <th>Id guide</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['price']; ?></td>
      <td><?php echo $row['excurs_date']; ?></td>
      <td><?php echo $row['time_start']; ?></td>
      <td><?php echo $row['fk_excurs']; ?></td>
      <td><?php echo $row['fk_carrier']; ?></td>
      <td><?php echo $row['fk_guides']; ?></td>
      <td>
        <a href="order_excursions.php?edit_eo=<?php echo $row['id_excurs_order']; ?>" class="edit_btn" >Edit</a>
      </td>
      <td>
        <a href="server_ord.php?del_eo=<?php echo $row['id_excurs_order']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

  <form method="post" action="server_ord.php" >
    <div class="input-group">
    <input  type="hidden" name="id" value="<?php echo $id_excurs_order; ?>">
    </div>
    <div class="input-group">
      <label>Price</label>
      <input type="text" name="price" value="<?php echo $price; ?>">
    </div>
    <div class="input-group">
      <label>Date</label>
      <input type="text" name="excurs_date" value="<?php echo $excurs_date; ?>">
    </div>
    <div class="input-group">
      <label>Time of start</label>
      <input type="text" name="time_start" value="<?php echo $time_start; ?>">
    </div>
    <div class="input-group">
      <label>Id excursion</label>
      <input type="text" name="fk_excurs"value="<?php echo $fk_excurs; ?>">
    </div>
    <div class="input-group">
      <label>Id carriers</label>
      <input type="text" name="fk_carrier" value="<?php echo $fk_carrier; ?>">
    </div>
    <div class="input-group">
      <label>Id guide</label>
      <input type="text" name="fk_guides" value="<?php echo $fk_guides; ?>">
    </div>
    <div class="input-group">
      <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update_eo" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="save_eo" >Add</button>
      <?php endif ?>
    </div>
  </form>


</body>
</html>