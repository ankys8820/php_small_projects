<?php
include 'connect.php';

$id = $_GET['updateId'];

$sql = "SELECT * FROM `users` WHERE id=$id";

$result = mysqli_query($con, $sql);

$data = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = "UPDATE `users` SET `id` = $id, `name`='$name', `email`='$email',`mobile`='$mobile', `password`='$password' WHERE `id`=$id";

    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>
        alert('Record updated successfully!');
      </script>";
        header('location:index.php');
    } else {
        echo "<script>
        alert('Some error occured!');
      </script>";
        die(mysqli_error($con));
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container mb-3">
        <h3 class="m-4">Update Users Details here !</h3>
        <form method="post">
            <div class="mb-3">
                <input type="text" class="form-control"
                    name="name"
                    placeholder="Enter your name"
                    value="<?php echo $data['name']; ?>"
                    autocomplete="off">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control"
                    name="email"
                    placeholder="Enter your email"
                    value="<?php echo $data['email']; ?>"
                    autocomplete="off">
            </div>
            <div class="mb-3">
                <input type="text" class="form-control"
                    name="mobile"
                    value="<?php echo $data['mobile']; ?>"
                    placeholder="Enter your mobile number" autocomplete="off">
            </div>

            <div class="mb-3">
                <input type="password" class="form-control"
                    name="password"
                    value="<?php echo $data['password']; ?>"
                    placeholder="Enter your password" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-dark" name="submit">Update</button>

        </form>
        <p class="mt-2"><a class="cursor-pointer" href="index.php">Click here</a> see the list of data !</p>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>