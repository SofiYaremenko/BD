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
     
      if(mysqli_num_rows($sql) == 0){
          die("This username could not be found! ");
      }
      while ($row = mysqli_fetch_array($sql)){
         $id_client = $row['id_client'];
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
      if (isset($_GET['itemno'])) {
    $id_excurs_order = $_GET['itemno'];
    $date =date("Y-m-d");
    mysqli_query($link, "INSERT INTO `order`(`order_date`, `deadline_pay`, `persons`, `language`, `response`, `discount`, `if_payed`, `status`, `client_c_id`, `manag_c_id`, `excurs_c_id`) VALUES ($date, $date , 1,'UKRANIAN','',0,0,0,$id_client,1,$id_excurs_order)");
 
  }


  }

?>
<html>
<head>
<link rel="stylesheet" href="../styles.css">
</head>
<body>

<div class="topnav"> <a>ExplorUAm</a>
  <a class="active"  href="main.php">Excursions</a>
    <a href="user_order.php">My Orders</a>
    <a href="user_info.php">Account</a>
    <a href="../logout.php" style="float:right"> Logout </a>
</div>


<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Excursions</font></h2></center></div>
<div style="width:100%;float:left" >
<?php
include("../db.php");

  $sql = mysqli_query($connection, "SELECT * FROM `excursion_order` EO INNER JOIN `excursions` E ON E.id_excursion = EO.fk_excurs GROUP BY `excurs_date`");
   $sel=mysqli_query($connection,"select * from excursions");
   echo"<form method='post'><table border='0' align='center'><tr>";
   $n=0;
    while($arr=mysqli_fetch_array($sql))
   {
    $d=$arr['id_excursion'];
   $i=$arr['id_excurs_order'];
    if($n%4==0)
	   {
	     echo "<tr>";
	   }
      echo "
        <td height='300' width='300' align='center'>
        <img src='../img/tour/$d.jpg' height='200' width='200'><br/>".
        "<br>".$arr['name_excurs'].
        "<br><b>Discription: </b>".$arr['discrip_excurs'].
        "<br><b>Cost: </b>".$arr['price'].
        "<br><b>Date: </b>".$arr['excurs_date'].
        "<br><br><a href='main.php?itemno=$i'>Order</a>
        <a href='index.php?con=14 & itemno=$i'><button>View More</button></a><br><br>
        </td>";
      $n++;

   }
   	  echo "</tr></table>
       </form>";
	?>
  <div><br>

</div>
</div>
</body>
</html>
