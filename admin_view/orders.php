<?php  include('server_ord.php');

  if (isset($_GET['edit_or'])) {
    $id_order = $_GET['edit_or'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM order WHERE id_order=$id_order");

    if (mysqli_num_rows($record) == 1 ) {
      $n = mysqli_fetch_array($record);

      $order_date =  $n['order_date'];
    $deadline_pay=  $n['deadline_pay'];
    $persons= $n['persons'];
    $language =  $n['language'];
    $response=  $n['response'];
    $discount =  $n['discount'];
    $if_payed =  $n['if_payed'];
    $status=  $n['status'];
    $client_c_id=  $n['client_c_id'];
    $manag_c_id=  $n['manag_c_id'];
    $excurs_c_id=  $n['excurs_c_id'];
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
  <a class="active" href="orders.php">Orders</a>
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
<?php $results = mysqli_query($db, "SELECT * FROM order"); 
?>

<table style="width: 95%">
  <thead>
    <tr>
      <th>Date</th>
      <th>Deadline of pay</th>
      <th>Persons</th>
      <th>Language</th>
      <th>Response</th>
      <th>Discount</th>
      <th>Payed?</th>
      <th>Сonfirmed</th>
      <th>Client</th>
      <th>Manager</th>
      <th>Excursion</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['order_date']; ?></td>
      <td><?php echo $row['deadline_pay']; ?></td>
      <td><?php echo $row['persons']; ?></td>
      <td><?php echo $row['language']; ?></td>
      <td><?php echo $row['response']; ?></td>
      <td><?php echo $row['discount']; ?></td>
      <td><?php echo $row['if_payed']; ?></td>
      <td><?php echo $row['status']; ?></td>
      <td><?php echo $row['client_c_id']; ?></td>
      <td><?php echo $row['manag_c_id']; ?></td>
      <td><?php echo $row['excurs_c_id']; ?></td>
      <td>
        <a href="orders.php?edit_or=<?php echo $row['id_order']; ?>" class="edit_btn" >Edit</a>
      </td>
      <td>
        <a href="server_ord.php?del_or=<?php echo $row['id_order']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

  <form method="post" action="server_ord.php" >
    <div class="input-group">
    <input type="hidden" name="id" value="<?php echo $id_order; ?>">
    </div>
    <div class="input-group">
      <label>Login</label>
      <input type="text" name="login" value="<?php echo $cl_login; ?>">
    </div>
    <div class="input-group">
      <?php if ($update == false): ?>
      <label>Password</label>
      <input type="text" name="password" value="<?php echo $cl_password; ?>">
      <?php else: ?>
      <input type="hidden" name="password" value="<?php echo $cl_password; ?>">
      <?php endif ?>
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
      <button class="btn" type="submit" name="update_or" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="save_or" >Add</button>
      <?php endif ?>
    </div>
  </form>


</body>
</html>