<?php  include('../config.php');

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `order` WHERE client_c_id=$valueToSearch";
    
}else if(isset($_POST['search2']))
{
    $valueToSearch2 = $_POST['valueToSearch2'];
    $query = "SELECT * FROM `order` WHERE excurs_c_id=$valueToSearch2";
    
}else if(isset($_POST['filter']))
{
    $query = "SELECT * FROM `order` ORDER BY order_date";
    
}else if(isset($_POST['filter2']))
{
    $query = "SELECT * FROM `order` ORDER BY if_payed";
    
}else if(isset($_POST['undo']))
{
   $query = "SELECT * FROM `order`";
  }
 else {
    $query = "SELECT * FROM `order`";
}

  if (isset($_GET['edit_or'])) {
    $id_order = $_GET['edit_or'];
    $update = true;
    $record = mysqli_query($link, "SELECT * FROM `order` WHERE id_order=$id_order");

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

 <form action="orders.php" method="post">
  <div>
  <div class="input-group" >
      <input type="text" name="valueToSearch" value="Find by client ID" style="width: 30%">
      <input type="submit" name="search" value="Find" style="width: 14%">
      <input type="text" name="valueToSearch2" value="Find by excursions ID" style="width: 30%">
      <input type="submit" name="search2" value="Find" style="width: 14%">
      <input type="submit" name="undo" value="Undo" style="width: 10%"><br><br>
      <input type="submit" name="filter" value="Filter by Date" style="width: 10%; ">
      <input type="submit" name="filter2" value="Filter by Payed" style="width: 10%; ">
    </div>
  </div>
  </form>


<?php if (isset($_SESSION['message'])): ?>
  <div class="msg">
    <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>
<?php $results = mysqli_query($link, $query); 
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
      <label>Date</label>
      <input type="text" name="or_date" value="<?php echo $order_date; ?>">
    </div>
    <div class="input-group">
      <label>Deadline of pay</label>
      <input type="text" name="pay_date" value="<?php echo $deadline_pay; ?>">
    </div>
    <div class="input-group">
      <label>Persons</label>
      <input type="text" name="persons"value="<?php echo $persons; ?>">
    </div>
    <div class="input-group">
      <label>Language</label>
      <input type="text" name="language"value="<?php echo $language; ?>">
    </div>
    <div class="input-group">
      <label>Response</label>
      <input type="text" name="response" value="<?php echo $response; ?>">
    </div>
    <div class="input-group">
      <label>Discount</label>
      <input type="text" name="discount" value="<?php echo $discount; ?>">
    </div>
    <div class="input-group">
      <label>Payed?</label>
      <input type="text" name="pay" value="<?php echo $if_payed; ?>">
    </div>
    <div class="input-group">
      <label>Confirmed</label>
      <input type="text" name="status" value="<?php echo $status; ?>">
    </div>
    <div class="input-group">
      <label>Client id</label>
      <input type="text" name="client_id" value="<?php echo $client_c_id; ?>">
    </div>
    <div class="input-group">
      <label>Manager id</label>
      <input type="text" name="manag_id" value="<?php echo $manag_c_id; ?>">
    </div>
    <div class="input-group">
      <label>Excursion id</label>
      <input type="text" name="excurs_id" value="<?php echo $excurs_c_id; ?>">
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