<?php
  session_start();
  require_once "../config.php";

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo "LOG IN FIRST";
    header('location:../login.php');
  }else{
      $username = $_SESSION['username'];

      $sql = mysqli_query($link, "SELECT * FROM clients WHERE cl_login='$username'");
      $sql1 = mysqli_query($link,"SELECT E.name_excurs, E.duration, EO.excurs_date,O.status, O.if_payed, O.deadline_pay, EO.id_excurs_order FROM (`excursions` E INNER JOIN `excursion_order` EO ON E.id_excursion = EO.fk_excurs) INNER JOIN `order` O ON O.excurs_c_id = EO.id_excurs_order WHERE O.client_c_id = (SELECT id_client FROM clients WHERE cl_login = '$username')");

      if(mysqli_num_rows($sql) == 0){
          die("This username could not be found! ");
      }
      while ($row = mysqli_fetch_array($sql)){
          $dbusername = $row['cl_login'];
          $lastname = $row['cl_surname'];
          $firstname = $row['cl_name'];
          $fname = $row['cl_fname'];
          $passport_num = $row['passport_n'];
          $birthday = $row['birthday'];
          $email = $row['email'];
          $phone = $row['cl_phone'];
      }
      if($username != $dbusername){
          die("There has been a fatal error. Please try again.");
      }
      if(mysqli_num_rows($sql1) == 0){
          echo ("You don't have any excursions yet");
      }

  }

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $username; ?> </title>
    <link rel="stylesheet" type="text/css" href="userstyle.css">
</head>
<body>

<div class="topnav"> <a>ExplorUAm</a>
    <a href="main.php">Excursions</a>
    <a class="active"  href="user_order.php">My Orders</a>
    <a href="user_info.php">Account</a>
    <a href="../logout.php" style="float:right"> Logout </a>
</div>

<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Excursion Date</th>
            <th>Pay Deadline</th>
            <th>Duration</th>
            <th>Confirmed</th>
            <th>Payed</th>
            <th></th>
        </tr>
        </thead>
        <?php while ($row = mysqli_fetch_array($sql1)) { ?>
        <tr>
            <td><?php echo $row['name_excurs']; ?></td>
            <td><?php echo $row['excurs_date']; ?></td>
            <td><?php echo $row['deadline_pay']; ?></td>            
            <td><?php echo $row['duration']; ?></td>
            <td><?php if ($row['status'] == 1) echo "Yes"; else echo "No"; ?></td>
            <td><?php if ($row['if_payed'] == 1) echo "Yes"; else echo "No"; ?></td>
            <td style="display:none;"><?php echo $row['id_excurs_order']; ?></td>
            <td>
              <a href="excurs_more.php?id_eo=<?php echo $row['id_excurs_order']; ?>" class="more_btn">More</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    
</div>

</body>
</html>

