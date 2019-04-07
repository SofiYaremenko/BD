<?php  include('server.php');

  if (isset($_GET['edit_g'])) {
    $tab_number = $_GET['edit_g'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM guides WHERE tab_number=$tab_number");

    if (count($record) == 1 ) {
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
  <a class="active" href="guides.php">Guides</a>
  <a href="managers.php">Managers</a>
  <a href="order_excursions.php">Order excursions</a>
  <a href="../main.php" style="float:right"> Logout </a>
</div>

 <!-- Button to open the modal login form 
<button onclick="document.getElementById('id01').style.display='block'">Login</button>-->

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <form method="post" action="server.php" >

      <div class="input-group" >
        <label>Select guide tab number</label>
        <select name="id_g">
          <?php 
            $sql = mysqli_query($db, "SELECT tab_number FROM guides");
            while ($row = $sql->fetch_assoc()){
            echo "<option value= \"" . $row['tab_number'] ."\">" . $row['tab_number'] . "</option>";}?>
        </select>
      </div>

      

      <div class="input-group" align="center">
        <label>Write the ID of the language</label>
        <input type="text" name="lan_id" style="width: 85%" value="">
        <button class="btn" type="submit" name="save_l" style="width: 10%">Add</button>
      </div>

    </form>

    <?php $results_l = mysqli_query($db, "SELECT * FROM language"); ?>

<table  class = "lan_table">
  <thead>
    <tr>
      <th>Id</th>
      <th>Language</th>
      </tr>
  </thead>
  <?php while ($row = mysqli_fetch_array($results_l)) { ?>
    <tr>
      <td><?php echo $row['id_language']; ?></td>
      <td><?php echo $row['lan_name']; ?></td>
      </tr>
  <?php } ?>
</table>

  </div>

</div>



<?php if (isset($_SESSION['message'])): ?>
  <div class="msg">
    <?php 
      echo $_SESSION['message']; 
      unset($_SESSION['message']);
    ?>
  </div>
<?php endif ?>
<?php $results = mysqli_query($db, "SELECT * FROM guides"); ?>

<table>
  <thead>
    <tr>
      <th>Login</th>
      <th>Password</th>
      <th>User type</th>
      <th>Surname</th>
      <th>Name</th>
      <th>Fname</th>
      <th>Phone</th>
      <th>Additional Phone</th>
      <th>Language</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  
  <?php while ($row = mysqli_fetch_array($results)) { ?>
    <tr>
      <td><?php echo $row['g_login']; ?></td>
      <td><?php echo $row['g_password']; ?></td>
      <td><?php echo $row['g_usertype']; ?></td>
      <td><?php echo $row['g_surname']; ?></td>
      <td><?php echo $row['g_name']; ?></td>
      <td><?php echo $row['g_fname']; ?></td>
      <td><?php echo $row['g_phone']; ?></td>
      <td><?php echo $row['g_anoth_phone']; ?></td>
      <td>
        
        <button  id="myBtn"> Add </button></td>
      <td>
        <a href="guides.php?edit_g=<?php echo $row['tab_number']; ?>" class="edit_btn" >Edit</a>
      </td>
      <td>
        <a href="server.php?del_g=<?php echo $row['tab_number']; ?>" class="del_btn">Delete</a>
      </td>
    </tr>
  <?php } ?>
</table>

  <form method="post" action="server.php" >
    <div class="input-group">
    <input  type="hidden" name="id" value="<?php echo $tab_number; ?>">
    </div>
    <div class="input-group">
      <label>Login</label>
      <input type="text" name="login" value="<?php echo $g_login; ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="text" name="usertype" value="<?php echo $g_password; ?>">
    </div>
    <div class="input-group">
      <label>User type</label>
      <input type="text" name="password" value="<?php echo $g_usertype; ?>">
    </div>
    <div class="input-group">
      <label>Surname</label>
      <input type="text" name="surname"value="<?php echo $g_surname; ?>">
    </div>
    <div class="input-group">
      <label>Name</label>
      <input type="text" name="name" value="<?php echo $g_name; ?>">
    </div>
    <div class="input-group">
      <label>Fname</label>
      <input type="text" name="fname" value="<?php echo $g_fname; ?>">
    </div>
    <div class="input-group">
      <label>Phone</label>
      <input type="text" name="phone" value="<?php echo $g_phone; ?>">
    </div>
    <div class="input-group">
      <label>Additional Phone</label>
      <input type="text" name="anoth_phone" value="<?php echo $g_anoth_phone; ?>">
    </div>
    <div class="input-group">
      <?php if ($update == true): ?>
      <button class="btn" type="submit" name="update_g" style="background: #ddd;" >Update</button>
      <?php else: ?>
      <button class="btn" type="submit" name="save_g" >Add</button>
      <?php endif ?>
    </div>
  </form>



  <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>