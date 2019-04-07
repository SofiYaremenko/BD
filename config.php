<?php

$connection = mysqli_connect('localhost:3306', 'root', '', 'explordb');
// Check connection
if($connection === false){
    die("ERROR: Could not connect to DB. " . mysqli_connect_error());
}