<?php

include 'connect.php';

if (isset($_GET['deleteId'])) {

    $id = $_GET['deleteId'];

    $sql = "DELETE FROM `users` WHERE `id`=$id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        header('location:index.php');
    } else {
        die(mysqli_error($con));
    }
}
