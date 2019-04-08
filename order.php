<?php
require_once "config.php";
session_start();
if (isset($_GET['id_ex'])) {
    $id_excursion = $_GET['id_ex'];
    $update = true;

    echo $id_excursion;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $id_excursion; ?> </title>
</head>
<body>