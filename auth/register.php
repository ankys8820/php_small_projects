  <?php


    session_start();

    // $_SESSION['name'] = 'Ankit';

    // print_r($_SESSION);

    if (isset($_SESSION["user"])) {
        header("location: http://localhost/PHP_Small_Projects/auth");
    }

    include('database.php');
    // print_r($_POST);
    if (isset($_POST['register'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['repeat_password'];

        $passwordHashed = sha1($_POST['password']);



        $errors = array();

        // check if the all feilds are filled or not 
        if (empty($fullname) or empty($email) or empty($password) or empty($passwordRepeat)) {
            array_push($errors, "All fields are required!");
        }

        // check is email is valid or not
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Valid email is required");
        }

        // check password length
        if (strlen($password) < 8) {
            array_push($errors, "Minimum password must 8 char long !");
        }

        // check and password
        if ($password !== $passwordRepeat) {
            array_push($errors, "Password must be same !");
        }

        // check if the email already exists or not {without using unique constrains.}

        $sql = "SELECT * FROM `users1` WHERE email = '$email'";

        $result =  mysqli_query($conn, $sql);

        // get the rows
        $rowCount = mysqli_num_rows($result);

        if ($rowCount) {
            array_push(
                $errors,
                "Email already exist !"
            );
        }


        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'> $error </div>";
            }
        } else {
            // We will insert our data into database
            $sql = "INSERT INTO `users1` (`fullname`,`email`,`password`) VALUE (? , ? , ?)";

            $stmt = mysqli_stmt_init($conn);

            $prepareSTMT = mysqli_stmt_prepare($stmt, $sql);

            if ($prepareSTMT) {
                mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHashed);

                mysqli_stmt_execute($stmt);

                echo "<div class='alert alert-success'>You are registered successfully !</div>";
            } else {
                die("Something went wrong");
            }
        }
    }

    ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sign Up</title>
      <!-- cdn css -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
  </head>

  <body>
      <div class="container">


          <form action="register.php" method="post">
              <h3 class="mb-3">Sign up</h3>
              <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Enter fullname">
              </div>
              <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Enter email">
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Enter Password">
              </div>
              <div class="form-group">
                  <input type="password" name="repeat_password"
                      class="form-control" placeholder="Repeat Password">
              </div>
              <div class="form-btn">
                  <input type="submit" class="btn btn-dark" value="Register" name="register">
              </div>
          </form>
          <p class="mt-3">Already created an account ?<a href="login.php">Click here</a></p>
      </div>


      <!-- cdn js -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>

  </html>