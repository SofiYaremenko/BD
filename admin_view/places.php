<?php  include('server_ex_pl.php');

  if (isset($_GET['edit_pl'])) {
    $id_place = $_GET['edit_pl'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM places WHERE id_place=$id_place");

    if (mysqli_num_rows($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $name_place= $n['name_place'];
      $discrip_place= $n['discrip_place'];
      $max_people_place= $n['max_people_place'];
      $provider= $n['provider'];
      $duration= $n['duration'];
      $longitude= $n['longitude'];
      $latitude= $n['latitude'];
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
  <a class="active" href="places.php">Places</a>
  <a href="orders.php">Orders</a>
  <a href="carriers.php">Carriers</a>
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
<?php $results = mysqli_query($db, "SELECT * FROM places"); ?>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Discription</th>
      <th>Max people</th>
      <th>Provider</th>
      <th>Longitude</th>
      <th>Latitude</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td class="name"><?php echo $row['name_place']; ?></td>
      <td class="des"><?php echo $row['discrip_place']; ?></td>
      <td><?php echo $row['max_people_place']; ?></td>
      <td><?php echo $row['provider']; ?></td>
      <td><?php echo $row['longitude']; ?></td>
      <td><?php echo $row['latitude']; ?></td>
      <td>
        <a href="places.php?edit_pl=<?php echo $row['id_place']; ?>" class="edit_btn" >Edit</a>
      </td>
      <td>
        <a href="server_ex_pl.php?del_pl=<?php echo $row['id_place']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

  <form method="post" action="server_ex_pl.php" >
    <div class="input-group">
    <input type="hidden" name="id" value="<?php echo $id_place; ?>">
    </div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $name_place; ?>">
    </div>
    <div class="input-group" >
      <label>Discription</label>
      <textarea name="discrip" rows="5"><?php echo $discrip_place; ?></textarea>
      <!--<input type="text" name="discrip" value="<?php echo $discrip_excurs; ?>">-->
    </div>
    <div class="input-group">
      <label>Max people</label>
      <input type="text" name="max" value="<?php echo $max_people_place; ?>">
    </div>
    <div class="input-group">
      <label>Provider</label>
      <input type="text" name="provider" value="<?php echo $provider; ?>">
    </div>
    <div class="input-group">
      <label>Longitude</label>
      <input type="text" name="long" value="<?php echo $longitude; ?>">
    </div>
    <div class="input-group">
      <label>Latitude</label>
      <input type="text" name="lat" value="<?php echo $latitude; ?>">
    </div>
   
    <div class="input-group">
      <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update_pl" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="save_pl" >Add</button>
      <?php endif ?>
    </div>
  </form>


</body>
</html>