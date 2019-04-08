<?php
require_once "config.php";
session_start();

if (isset($_GET['id_ex'])) {
    $id_excursion = $_GET['id_ex'];
    $redir = "";

    $update = true;
    $sql = mysqli_query($link, "SELECT * FROM excursion_order EO INNER JOIN excursions E ON EO.fk_excurs = E.id_excursion WHERE E.id_excursion=$id_excursion");
    $sql1 =mysqli_query($link,"SELECT P.* FROM excursion_order EO INNER JOIN excursions E ON EO.fk_excurs = E.id_excursion INNER JOIN consists_of CO ON CO.excursion_fk = E.id_excursion INNER JOIN places P ON P.id_place = CO.places_fk WHERE E.id_excursion= $id_excursion");

    if(mysqli_num_rows($sql) == 0){
        die("This excursion order id could not be found! ");
    }
    while ($row = mysqli_fetch_array($sql)){
        $id = $row['id_excursion'];
        $price = $row['price'];
        $date = $row['excurs_date'];
        $time = $row['time_start'];
        $name = $row['name_excurs'];
        $about = $row['discrip_excurs'];
        $min_p = $row['min_people'];
        $max_p = $row['max_people'];
        $duration = $row['duration'];
        $w = $row['winter'];
        $sp = $row['spring'];
        $sm = $row['summer'];
        $a = $row['autumn'];
    }
    if($id_excursion != $id){
        echo $id_excursion ." ! = " .$id;
        die("There has been a fatal error. Please try again.");
    }

}




if (isset($_GET['id_eo'])) {
    $id_excursion = $_GET['id_eo'];
    $redir = "";

    $update = true;
    $sql = mysqli_query($link, "SELECT * FROM excursion_order EO INNER JOIN excursions E ON EO.fk_excurs = E.id_excursion"
                                       . " WHERE EO.id_excurs_order='$id_excursion'");
    $sql1 =mysqli_query($link,"SELECT P.* FROM excursion_order EO INNER JOIN excursions E ON EO.fk_excurs = E.id_excursion" ." INNER JOIN consists_of CO ON CO.excursion_fk = E.id_excursion " ." INNER JOIN places P ON P.id_place = CO.places_fk WHERE EO.id_excurs_order= '$id_excursion'");

    if(mysqli_num_rows($sql) == 0){
        die("This excursion order id could not be found! ");
    }
    while ($row = mysqli_fetch_array($sql)){
        $id = $row['id_excurs_order'];
        $price = $row['price'];
        $date = $row['excurs_date'];
        $time = $row['time_start'];
        $name = $row['name_excurs'];
        $about = $row['discrip_excurs'];
        $min_p = $row['min_people'];
        $max_p = $row['max_people'];
        $duration = $row['duration'];
        $w = $row['winter'];
        $sp = $row['spring'];
        $sm = $row['summer'];
        $a = $row['autumn'];
    }
    if($id_excursion != $id){
        echo $id_excursion ." ! = " .$id;
        die("There has been a fatal error. Please try again.");
    }

}
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo $username; ?> </title>
    <link rel="stylesheet" type="text/css" href="user_view/userstyle.css">
</head>
<body>

<div class="topnav"> <a>ExplorUAm</a>
    <?php  if($_SESSION['user_type'] == "user") {
       echo "<a href=\"user_view/user_order.php\">My Orders</a>";
       echo "<a href=\"user_view/user_info.php\">Account</a>";
    }elseif ($_SESSION['user_type'] == "guide") {
        echo "<a href=\"guide_view/future_excurs.php\">My future excursions </a>";
        echo "<a href=\"guide_view/guide_info.php\">Account</a>";
    } ?>
    <a href="logout.php" style="float:right"> Logout </a>
</div>


<div class="header" align="center">
    <h2>Excursion Detailed Info</h2>
</div>
<div class="content" >
     
        <table>
            <tr><td>Title:</td><td><?php echo $name; ?></td></tr>
            <tr><td>Date:</td><td><?php echo $date; ?></td></tr>
            <tr><td>Time:</td><td><?php echo $time; ?></td></tr>
            <tr><td>Duration:</td><td><?php echo $duration; ?></td></tr>
            <tr><td>Price:</td><td><?php echo $price; ?></td></tr>
            <tr><td>About:</td><td><?php echo $about ; ?></td></tr>
            <tr><td>Number of people:</td><td><?php echo $min_p ." - " . $max_p; ?></td></tr>
            <tr><td>Seasons:</td><td>
            <p><input type="checkbox" <?php echo ($w==1 ? 'checked' : '');?> readonly>winter<Br>
                <input type="checkbox" readonly <?php echo ($sp==1 ? 'checked' : '');?>>spring<Br>
                <input type="checkbox" readonly <?php echo ($sm==1 ? 'checked' : '');?>>summer<Br>
                <input type="checkbox" readonly <?php echo ($a==1 ? 'checked' : '');?>>autumn<Br>
                </td></tr>
        </table>
    
    <div class="header" align="center">
    <h3>Places Info</h3>
</div>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Discription</th>
            <th>Max people</th>
            <th>Provider</th>
            <th>Coordinates</th>
            <th></th>
        </tr>
        </thead>
        <?php while ($row = mysqli_fetch_array($sql1)) { ?>
            <tr>
                <td><?php echo $row['name_place']; ?></td>
                <td><?php echo $row['discrip_place']; ?></td>
                <td><?php echo $row['max_people_place']; ?></td>
                <td><?php echo $row['provider']; ?></td>
                <td><?php echo $row['longitude'] . "," . $row['latitude'] ; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
