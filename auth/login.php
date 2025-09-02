<?php
session_start();

// $_SESSION['name'] = 'Ankit';

// print_r($_SESSION);

if (isset($_SESSION["user"])) {
    header("location: http://localhost/PHP_Small_Projects/auth");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <!-- cdn css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        include('database.php');

        if (isset($_POST['login'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordHashed = sha1($_POST['password']);

            // 
            $sql = "SELECT * FROM `users1` WHERE `email` = '$email'";

            $result = mysqli_query($conn, $sql);

            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($user) {
                if ($user['password'] == $passwordHashed) {


                    $_SESSION['user'] = $user['fullname'];
                    header('localtion: http://localhost/PHP_Small_Projects/auth');

                    die();
                } else {
                    echo "<div class='alert alert-danger'>Opps password didn't matched!</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not existst!</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <h3 class="mb-3">Sign In</h3>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
            </div>

            <div class="form-btn">
                <input type="submit" class="btn btn-dark" value="Login" name="login">
            </div>
        </form>
        <p class="mt-3">If you haven't created account <a href="register.php">Click here</a></p>
    </div>


    <!-- cdn js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>