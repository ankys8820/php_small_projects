<?php

// host, user, password, database
$conn = mysqli_connect('localhost', 'root', '', 'test');

if (mysqli_connect_error()) {
    die("Cannot connect to Database" . mysqli_connect_errno());
}

define('UPLOAD_SRC', $_SERVER['DOCUMENT_ROOT'] . "/PHP_Small_Projects/imageCRUD/uploads/");


// 
define("FETCH_SRC", "http://127.0.0.1/PHP_Small_Projects/imageCRUD/uploads/");
