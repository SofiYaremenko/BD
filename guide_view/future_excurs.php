<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo "LOG IN FIRST";
    header('location:../login.php');
}else{
    $username = $_SESSION['username'];
    $sql = mysqli_query($link," SELECT G.g_login, EO.id_excurs_order, E.name_excurs, EO.excurs_date,EO.time_start, E.duration  FROM guides G "
        . " INNER JOIN excursion_order EO ON G.tab_number = EO.fk_guides "
        . " INNER JOIN excursions E ON EO.fk_excurs = E.id_excursion "
        . " WHERE G.tab_number = (SELECT G1.tab_number "
                                 ." FROM guides G1 "
                                  ." WHERE G1.g_login = '$username') "
        . " AND EO.excurs_date >= CURRENT_DATE");

//
//    while ($row = mysqli_fetch_array($sql)){
//        $dbusername = $row['g_login'];
//        $name = $row['name_excurs'];
//        $date = $row['excurs_date'];
//        $time = $row['time_start'];
//        $duration = $row['duration'];
//
//    }
//    if($username != $dbusername){
//        die("There has been a fatal error. Please try again.");
//    }
    if(mysqli_num_rows($sql) == 0){
        echo ("You don't have any future excursions ");
    }


}

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $username; ?> </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="guidestyle.css">
</head>
<body>
<div class="topnav"> <a class="hover">ExplorUAm</a>
    <a class="active" href="future_excurs.php">My future excursions</a>
    <a href="guide_info.php">Account</a>
    <a href="../logout.php" style="float:right"> Logout </a>
</div>

<div class="header" align="center">
    <h3>My excursions</h3>
</div>
<div class="content">
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Time</th>
            <th></th>
        </tr>
        </thead>
        <?php if(mysqli_num_rows($sql) > 0){
        while ($row = mysqli_fetch_array($sql)) { ?>
            <tr>
                <td><?php echo $row['name_excurs']; ?></td>
                <td><?php echo $row['excurs_date']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo $row['time_start']; ?></td>
                <td>
                    <a href="../excurs_more.php?id_eo=<?php echo $row['id_excurs_order']; ?>" class="more_btn">More</a>
                </td>
            </tr>
        <?php }}?>
    </table>

</div>

</body>
</html>


