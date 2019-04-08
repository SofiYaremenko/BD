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

   $sel=mysqli_query($link,"select * from excursions");
   echo"<form method='post'><table border='0' align='center'><tr>";
   $n=1;
    while($arr=mysqli_fetch_array($sel))
   {
   $i=$arr['id_excursion'];
    if($n%4==0)
  {
  echo "<tr>";
  }
   echo "
   <td height='280' width='240' align='center'><img src='../img/tour/$i.jpg' height='200' width='200'><br/>".
   "<br>".$arr['name_excurs'].
   "<br><b>Discription: </b>".$arr['discrip_excurs'].
   "<br><b>Cost: </b>".$arr['cost_excurs'].
   "<br><br><a href='../order.php?id_ex=$i'>Order</a>
   <a href='../excurs_more.php?id_ex=$i'>View more</a><br><br>
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
