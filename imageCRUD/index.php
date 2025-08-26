<?php
require('connect.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>

<body>

    <div class="container bg-dark text-light p-3 rounded my-4">
        <div class="d-flex align-center justify-content-between px-3">

            <h4>
                <a href="index.php" class="text-white text-decoration-none">
                    <i class="bi bi-house"></i>
                    Product Store
                </a>
            </h4>

            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addproduct">
                <i class="bi bi-pencil"></i> Add Product
            </button>

        </div>
    </div>

    <!-- Read -->

    <div class="container mt-5 p-0">
        <table class="table table-dark table-hover text-center">
            <thead>
                <tr>
                    <th width="10%" scope="col" class="rounded-start">Sr. No.</th>
                    <th width="15%" scope="col">Image</th>
                    <th width="10%" scope="col">Name</th>
                    <th width="10%" scope="col">Price</th>
                    <th width="35%" scope="col">Description</th>
                    <th width="20%" scope="col" class="rounded-end">Action</th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                $query = "SELECT * FROM `products`";

                $result = mysqli_query($conn, $query);
                $i = 1;
                $fetch_src = FETCH_SRC;

                while ($fetch = mysqli_fetch_assoc($result)) {

                    // hero method for echo
                    echo <<<product
                         <tr class="align-middle">
                          <th scope="row">$i</th>
                          <td><img src="$fetch_src$fetch[image]" width="150px"></td>
                          <td>$fetch[name]</td>
                          <td>₹ $fetch[price]</td>
                          <td>$fetch[description]</td>
                          <td>
                          <a>Edit</a>
                          <button onclick="confirm_rem($fetch[id])" class="btn btn-danger"><i class="bi bi-trash"></i> </button>
                          </td>
                         </tr>
                    product;
                }

                ?>


            </tbody>
        </table>
    </div>

    <script>
        function confirm_rem($id) {
            if (confirm("Are you sure, you want to delete ?")) {
                window.location.href = "crum.php?rem" + id;
            }
        }
    </script>

    <!-- modal -->
    <div class="modal fade" id="addproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product</h5>
                    </div>
                    <div class="modal-body">
                        <!-- INPUTS -->
                        <div class="input-group mb-3">
                            <!-- <span class="input-group-text">Name</span> -->
                            <input type="text" class="form-control" name="name" placeholder="name" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="price" placeholder="price" min="1" required>
                        </div>
                        <div class="input-group mb-3">
                            <textarea placeholder="description" class="form-control" name="desc" id="description" required></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="image" accept=".jpg,.jpeg,.png,.svg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancle</button>
                        <button type="submit" class="btn btn-success" name="addproduct">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>