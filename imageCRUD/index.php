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




    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



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
                <i class="bi bi-plus-circle"></i> Add Product
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
                          <a href="?edit=$fetch[id]" class="btn btn-warning me-3"><i class="bi bi-pencil-square"></i></a>
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
        function confirm_rem(id) {
            if (confirm("Are you sure, you want to delete ?")) {
                window.location.href = "crud.php?rem=" + id;
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

    <!--Edit modal -->
    <div class="modal fade" id="editproduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="crud.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                    </div>
                    <div class="modal-body">
                        <!-- INPUTS -->
                        <div class="input-group mb-3">
                            <!-- <span class="input-group-text">Name</span> -->
                            <input type="text" class="form-control" name="editname" id="editname" placeholder="editname" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="editprice" id="editprice" placeholder="Editprice" min="1" required>
                        </div>
                        <div class="input-group mb-3">
                            <textarea placeholder="description" class="form-control" id="editdesc" name="editdesc" required></textarea>
                        </div>
                        <!-- for showing the image -->
                        <img src="" id="editimage" class="mb-3" width="100%">
                        <br>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="editimg" accept=".jpg,.jpeg,.png,.svg">
                        </div>
                        <input type="hidden" name="editpid" id="editpid">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancle</button>
                        <button type="submit" class="btn btn-dark" name="editproduct">Update</button>
                    </div>
                </div>
            </form>

            <?php
            if (isset($_GET['edit']) && $_GET['edit'] > 0) {

                $id = $_GET['edit'];
                $query = "SELECT * FROM `products` WHERE `id` = $id";
                $res = mysqli_query($conn, $query);
                $fetch = mysqli_fetch_assoc($res);

                // if ($res) {
                //     print_r($fetch);
                // } else {
                //     echo "Query failed: " . mysqli_error($conn);
                // }

                echo "
                    <script>
                        var editproduct = new bootstrap.Modal(document.getElementById('editproduct'), {keyboard: false});
                               document.querySelector('#editname').value=`$fetch[name]`;
                               document.querySelector('#editprice').value=`$fetch[price]`;
                               document.querySelector('#editdesc').value=`$fetch[description]`;
                               document.querySelector('#editimage').src=`$fetch_src$fetch[image]`;
                                document.querySelector('#editpid').value=`$_GET[edit]`;
                    editproduct.show();
                 </script>
                ";
            }
            ?>

        </div>
    </div>







</body>

</html>