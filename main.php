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
<div style="width:100%;float:left" >
<?php
include("db.php");


   $sel=mysqli_query($connection,"select * from excursions");
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
   "<br><br><a href='index.php?con=12 & itemno=$i'><button>Order</button></a>
   <a href='index.php?con=14 & itemno=$i'><button>View</button></a><br><br>
   </td>";
  $n++;

   }
   	  echo "</tr></table>
       </form>";
	?>
  <div><br>

</div>
</div>
<p>
      <a href="admin_view/clients.php">Admin tools</a>
    </p>

</body>
</html>
