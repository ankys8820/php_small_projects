<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$conn = mysqli_connect($servername,$username,$password,$database);

if (mysqli_connect_error()) {
    die("Cannot connect to Database" . mysqli_connect_errno());
}


?>