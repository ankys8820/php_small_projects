

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

function image_remove($img)
{
    if (!unlink(UPLOAD_SRC . $img)) {
        header("location: index.php?alert=img_rem_fail");
        exit;
    }
}

// for delete
if (isset($_GET['rem']) && $_GET['rem'] > 0) {
    $query = "SELECT * FROM `products` WHERE `id`='$_GET[rem]'";
    $result = mysqli_query($conn, $query);
    $fetch = mysqli_fetch_assoc($result);



    image_remove($fetch['image']);

    $query = "DELETE FROM `products` WHERE `id`='$_GET[rem]'";

    if (mysqli_query($conn, $query)) {
        header("location: index.php?success=removed");
    } else {
        header("location: index.php?alert=remove_failed");
    }
}

// for update

if (isset($_POST['editproduct'])) {
    foreach ($_POST as $key => $value) {
        $_POST[$key] = mysqli_real_escape_string($conn, $value);
    }



    // 
    if (file_exists($_FILES['editimg']['tmp_name']) || is_uploaded_file($_FILES['editimg']['tmp_name'])) {

        // 
        $query = "SELECT * FROM `products` WHERE `id`='$_POST[editpid]'";
        $result = mysqli_query($conn, $query);
        $fetch = mysqli_fetch_assoc($result);

        // for test
        // print_r($fetch);
        // die();

        image_remove($fetch['image']);

        $imgpath = image_upload($_FILES['image']);

        $update = "UPDATE `products` SET `name`='$_POST[editname]' ,`price`='$_POST[editprice]',`description`='$_POST[editdesc]',`   image`='$imgpath' WHERE `id` = '$_POST[editpid]'";
    } else {
        $update = "UPDATE `products` SET `name`='$_POST[editname]' ,`price`='$_POST[editprice]',`description`='$_POST[editdesc]' WHERE `id` = '$_POST[editpid]'";
    }
    if (mysqli_query($conn, $update)) {
        header("location:index.php?success=updated");
    } else {
        header("location:index.php?alert=update_failed");
    }
}

?>