  <?php
    // print_r($_POST);
    if (isset($_POST['submit'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['repeat_password'];

        $error = array();
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
                  <input type="submit" class="btn btn-dark" value="Register" name="submit">
              </div>
          </form>
          <p class="mt-3">Already created an account ?<a href="login.php">Click here</a></p>
      </div>


      <!-- cdn js -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>

  </html>