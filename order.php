<?php
require_once "config.php";
session_start();
if (isset($_GET['id_ex'])) {
   $id_ex = $_GET['id_ex'];


}
// $id_ex = "1";
//to fill by user
$persons = $response = $language = "";
$if_payed = $status = 1;
$discount = 0;
$deadline_pay = date("Y-m-d");;
$order_date = date("Y-m-d");
$persons_err = $language_err = "";
$id_user = "";
$id_place;
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo "LOG IN FIRST";
    header('location:login.php');
}else {
$sql = mysqli_query($link, "SELECT * FROM excursion_order WHERE fk_excurs ='$id_ex'");
$username = $_SESSION['username'];
$id_user = $_SESSION['id'];

if (isset($_GET['select_pl'])) {
        $id_place = $_GET['select_pl'];

        $dd = mysqli_query($link, "SELECT excurs_date FROM excursion_order WHERE id_excurs_order ='$id_place'");

        if (mysqli_num_rows($dd) == 1) {
            while ($row = mysqli_fetch_array($dd)) {
                $deadline_pay = date( 'Y-m-d', strtotime( $row['excurs_date'] . ' -1 day' ) );
                
            }
        } else {
            echo("Error deadline exec");
        }

}
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

        $id_place = $POST["id"];

        if(empty(trim($_POST["id"]))){
        $persons_err = "Number of persons is required.";
    }else{
        $id_place = trim($_POST["id"]);
    }

 if(empty(trim($_POST["persons"]))){
        $p_err = "Number of persons is required.";
    }else{
        $persons = trim($_POST["persons"]);
    }
    if(empty(trim($_POST["language"]))){
        $language_err = "Language is required.";
    }else{
        $language = trim($_POST["language"]);
    }

 if(empty($persons_err) && empty($language_err)){
        $ins = "INSERT INTO `order` (order_date, deadline_pay, persons, language, response, discount, if_payed, status, client_c_id, manag_c_id, excurs_c_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($link, $ins)){ 
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_od,$param_dp, $param_p,
                $param_l,$param_r, $param_d, $param_ip, $param_s, $param_ccid,$param_mcid,$param_ecid);
            // Set parameters
            $param_od = $order_date;
            $param_dp = $deadline_pay;
            $param_p = $persons;
            $param_l = $language;
            $param_r = $response;
            $param_d = $discount;
            $param_ip = $if_payed;
            $param_s = $status;
            $param_ccid = $_SESSION['id'];
            $param_mcid = "1";
            $param_ecid = $id_place;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){

                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                $_SESSION["user_type"] = "user";
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "stmt error :  " . (mysqli_stmt_error($stmt));
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
 mysqli_close($link);

}


   

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $id_excursion; ?> </title>

    <link rel="stylesheet" type="text/css" href="user_view/userstyle.css">
</head>
<body>

<div class="topnav"> <a>ExplorUAm</a>
    <a href="main.php">Excursions</a>
    <a href="user_order.php">My Orders</a>
    <a class="active"  href="user_info.php">Account</a>
    <a href="logout.php" style="float:right"> Logout </a>
</div>
<div>
	<div class="header" align="center">
    <h3>Choose date </h3>
</div>
    <table>
        <thead>
        <tr>
            <th>Date</th>
            <th>Price</th>
            <th>Time</th>
            <th></th>
        </tr>
        </thead>
        <?php while ($row = mysqli_fetch_array($sql)) { ?>
            <tr>
                <td><?php echo $row['excurs_date']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['time_start']; ?></td>
                <td>
                    <a href="order.php?select_pl=<?php echo $row['id_excurs_order']; ?>" class="select_btn" >Select</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="input-group">
    <?php
    if (isset($_GET['select_pl'])) {
        $id_place = $_GET['select_pl'];
        echo "<input type=\"hidden\" name=\"id\" value=\"<?php echo $id_place; ?>\">";
    }
    ?>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form_regist">
        <div class="input-group">
    <input type="hidden" name="id" value="<?php echo $id_place; ?>">
    </div>
    <div class="input-group <?php echo (!empty($persons_err)) ? 'has-error' : ''; ?>">
        <label>Persons</label>
        <input type="text" name="persons" class="form-control" value="<?php echo $persons; ?>">
        <span class="help-block"><?php echo $persons_err; ?></span>
    </div>
    <div class="input-group <?php echo (!empty($language_err)) ? 'has-error' : ''; ?>">
        <label>Languages</label>
        <input type="text" name="language" class="form-control" value="<?php echo $language; ?>">
        <span class="help-block"><?php echo $language_err; ?></span>
    </div>
    <div class="input-group">
      <button class="btn" type="submit" name="order_ex" style="background: #ddd;" >Order</button>
    </form>
</div>
</body>
</html>