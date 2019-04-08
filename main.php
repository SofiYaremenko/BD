<html>
<head>
<link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="topnav"> <a>ExplorUAm</a>
  <a class="active" href="main.php">Home</a>
  <a href="login.php">Login</a>
  <a href="register.php">Register</a>
</div>


<div><br/><center><h2><font face="Lucida Handwriting" size="+1" color="#00CCFF">Excursions</font></h2></center></div>

<div align="right" >
<?php
include("config.php");


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
   <td height='280' width='240' align='center'><img src='img/tour/$i.jpg' height='200' width='200'><br/>".
   "<br>".$arr['name_excurs'].
   "<br><b>Discription: </b>".$arr['discrip_excurs'].
   "<br><b>Cost: </b>".$arr['cost_excurs'].
   "<br><br><a href='order.php?id_ex=$i'>Order</a>
   <a href='excurs_more.php?id_ex=$i'>View more</a>
   </td>";
  $n++;

   }
   	  echo "</tr></table>
       </form>";
	?>
  <div><br>

</div>
</div>
<a href="logout.php" style="float:right"> Logout </a>

</body>
</html>
