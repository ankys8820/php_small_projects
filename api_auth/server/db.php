<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = "";
$db = 'auth';


$conn = new mysqli($dbhost,$dbuser, $dbpassword, $db);

if($conn->connect_errno){
    http_response_code(400);
    header('Content_Type : test/plain');
     
    echo $conn->connect_error;
    exit();
}