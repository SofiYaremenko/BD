<?php

$link = mysqli_connect('localhost', 'root', '', 'explordb');
// Check connection
if($link === false){
    die("ERROR: Could not connect to DB. " . mysqli_connect_error());
}