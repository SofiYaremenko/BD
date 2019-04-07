<?php  include('server_ex_pl.php');

  if (isset($_GET['edit_ex'])) {
    $id_excursion = $_GET['edit_ex'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM excursions WHERE id_excursion=$id_excursion");

    if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $name_excurs= $n['name_excurs'];
      $discrip_excurs= $n['discrip_excurs'];
      $min_people= $n['min_people'];
      $max_people= $n['max_people'];
      $duration= $n['duration'];
      $cost_excurs= $n['cost_excurs'];
      $winter= $n['winter']; 
      $spring= $n['spring'];
      $summer= $n['summer']; 
      $autumn= $n['autumn'];
    }
  }
?>
<html>
<head>
<link rel="stylesheet" href="adminstyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="topnav"> <a class="hover">ExplorUAm</a>
  <a class="active" href="excursions.php">Excursions</a>
  <a href="clients.php">Clients</a>
  <a href="places.php">Places</a>
  <a href="orders.php">Orders</a>
  <a href="carriers.php">Carriers</a>
  <a href="guides.php">Guides</a>
  <a href="managers.php">Managers</a>
  <a href="order_excursions.php">Order excursions</a>
</div>

<?php if (isset($_SESSION['message'])): ?>
  <div class="msg">
    <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>
<?php $results = mysqli_query($db, "SELECT * FROM excursions"); ?>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Discription</th>
      <th>Min people</th>
      <th>Max people</th>
      <th>Duration</th>
      <th>Cost</th>
      <th>For winter</th>
      <th>For spring</th>
      <th>For summer</th>
      <th>For autumn</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td class="name"><?php echo $row['name_excurs']; ?></td>
      <td class="des"><?php echo $row['discrip_excurs']; ?></td>
      <td><?php echo $row['min_people']; ?></td>
      <td><?php echo $row['max_people']; ?></td>
      <td><?php echo $row['duration']; ?></td>
      <td><?php echo $row['cost_excurs']; ?></td>
      <td><?php echo $row['winter']; ?></td>
      <td><?php echo $row['spring']; ?></td>
      <td><?php echo $row['summer']; ?></td>
      <td><?php echo $row['autumn']; ?></td>
      <td>
        <a href="excursions.php?edit_ex=<?php echo $row['id_excursion']; ?>" class="edit_btn" >Edit</a>
      </td>
      <td>
        <a href="server_ex_pl.php?del_ex=<?php echo $row['id_excursion']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

  <form method="post" action="server_ex_pl.php" >
    <div class="input-group">
    <input type="hidden" name="id" value="<?php echo $id_excursion; ?>">
    </div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $name_excurs; ?>">
    </div>
    <div class="input-group" >
      <label>Discription</label>
      <textarea name="discrip" rows="5"><?php echo $discrip_excurs; ?></textarea>
      <!--<input type="text" name="discrip" value="<?php echo $discrip_excurs; ?>">-->
    </div>
    <div class="input-group">
      <label>Min people</label>
      <input type="text" name="min"value="<?php echo $min_people; ?>">
    </div>
    <div class="input-group">
      <label>Max people</label>
      <input type="text" name="max" value="<?php echo $max_people; ?>">
    </div>
    <div class="input-group">
      <label>Duration</label>
      <input type="text" name="duration" value="<?php echo $duration; ?>">
    </div>
    <div class="input-group">
      <label>Cost</label>
      <input type="text" name="cost" value="<?php echo $cost_excurs; ?>">
    </div>
    <div class="input-group">
      <label>For winter</label>
      <input type="text" name="winter" value="<?php echo $winter; ?>">
    </div>
    <div class="input-group">
      <label>For spring</label>
      <input type="text" name="spring" value="<?php echo $spring; ?>">
    </div>
    <div class="input-group">
      <label>For summer</label>
      <input type="text" name="summer" value="<?php echo $summer; ?>">
    </div>
    <div class="input-group">
      <label>For autumn</label>
      <input type="text" name="autumn" value="<?php echo $autumn; ?>">
    </div>
    <div class="input-group">
      <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update_ex" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="save_ex" >Add</button>
      <?php endif ?>
    </div>
  </form>

</body>
</html>