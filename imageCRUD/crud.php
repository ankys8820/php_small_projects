

<?php

require('connect.php');

// # Image Upload
function image_upload($img)
{
    $temp_loc = $img['tmp_name'];
    $new_name = random_int(11111, 999999) . $img['name'];

    $new_loc = UPLOAD_SRC . $new_name;

    if (!move_uploaded_file($temp_loc, $new_loc)) {
        header("location: index.php?alert=img_upload");
        exit;
    } else {
        return $new_name;
    }
}

if (isset($_POST['addproduct'])) {

    // for getting the input data
    // print_r($_POST);

    // echo "<br></br>";
    // for getting the image
    // print_r($_FILES['tmp_name']);

    // # filter values
    foreach ($_POST as $key => $value) {
        $_POST[$key] = mysqli_real_escape_string($conn, $value);
    }
    $imagpath = image_upload($_FILES['image']);

    $query = "INSERT INTO `products`( `name`, `price`, `description`, `image`) VALUES ('$_POST[name]','$_POST[price]','$_POST[desc]','$imagpath')";

    if (mysqli_query($conn, $query)) {
        header("location: index.php?success=added");
    } else {
        header("location: index.php?success=add_failed");
    }
}

// # delete Operation
