<?php
include('include/sessionstart.php');
require_once "database/dbconn.php";

if (isset($_GET['delete2'])) {
    $id = $_GET['delete2'];

    $mysqli->query("DELETE FROM `medicines` WHERE `id` = '$id'");
    $_SESSION['delete2'] = "Successfully Deleted.";
    header('location:medicines.php');
}

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff | Medicines</title>
    <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/googleFonts.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/dataTables.min.css">
    <style>
        table thead {
            position: sticky;
            top: -1px;
        }

        .inputType {
            display: flex;
            justify-content: flex-end;
        }

        div.dataTables_wrapper div.dt-row {
            margin-top: 10px;
            margin-right: 10px;
            position: relative;
            height: 400px;
            overflow: scroll;
        }
    </style>
</head>

<body>
    <?php include('include/navbar.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('include/sidebar.php') ?>

        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow mb-3">
                    <h3 class="text-uppercase fw-bold"><i class="fa-sharp fa-solid fa-box-open border rounded-circle secondary-bg2 p-2"></i> Medicines Information</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Medicines</li>
                        </ol>
                    </nav>
                    <div class="meds">
                        <div class="inputType">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmedicine"><i class="fa-solid fa-plus"></i> Add Medicine</button>

                            <!-- ADD Modal -->
                            <div class="modal fade" id="addmedicine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog py-4">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Medicines</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="process.php" method="POST" class="row g-3 p-4">
                                            <div class="col-md-7">
                                                <label for="medicine" class="form-label">Medicine</label>
                                                <input type="text" name="medicine" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="type" class="form-label">Type</label>
                                                <select class="form-select" name="type" aria-label="Default select example">
                                                    <option value="branded">Branded</option>
                                                    <option value="generic">Generic</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="qty" class="form-label">Quantity</label>
                                                <input type="number" name="qty" class="form-control">
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Description</label>
                                                <textarea type="text" class="form-control" name="description" rows="3"></textarea>
                                            </div> -->
                                            <div class="col-md-3">
                                                <label for="unitprice1" class="form-label">Price</label>
                                                <input type="number" name="unitprice1" id="unitprice1" class="form-control" placeholder="₱">
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-success" name="addmeds">Add Medicine</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Update -->
                            <div class="modal fade" id="medsupdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog py-4">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Medicines</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <form action="process.php" method="POST" class="row g-3 p-4">
                                            <input type="hidden" name="medsid" id="medsid" value="">
                                            <div class="col-md-7">
                                                <label for="medicine" class="form-label">Medicine</label>
                                                <input type="text" name="medicine" id="medicine" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="type" class="form-label">Type</label>
                                                <select class="form-select" name="type" id="type" aria-label="Default select example" value="">
                                                    <option value="branded">Branded</option>
                                                    <option value="generic">Generic</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="qty" class="form-label">Quantity</label>
                                                <input type="number" name="qty" id="qty" class="form-control" value="">
                                            </div>
                                            <!-- <div class="col-md-6">
                                                    <label for="inputEmail4" class="form-label">Description</label>
                                                    <textarea type="text" class="form-control" name="description" id="description" rows="3" value=""></textarea>
                                                </div> -->
                                            <div class="col-md-3">
                                                <label for="unitprice" class="form-label">Price</label>
                                                <input type="text" name="unitprice" id="unitprice" class="form-control" value="">
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="submit" class="btn btn-success" name="updatemeds">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <table class="table table-striped" id="tableMedicine">
                                    <thead class="bg-info">
                                        <tr>
                                            <th scope="col">Medicines</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Quantity</th>
                                            <!-- <th scope="col">Description</th> -->
                                            <th scope="col">Unit Price</th>
                                            <th scope="col">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php $result = $mysqli->query("SELECT * FROM `medicines`"); ?>

                                    <tbody id="myTable" class="align-middle text-center">
                                        <?php while ($meds = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td class="text-start"><?php echo $meds['medicine'] ?></td>
                                                <td><?php echo $meds['type'] ?></td>
                                                <td><?php echo $meds['quantity'] ?></td>
                                                <!-- <td><#?php echo $meds['description'] ?></td> -->
                                                <td><?php echo '₱' . $meds['unit_price'] ?></td>
                                                <td>
                                                    <div class="<?= $meds['quantity'] <= 50 ? 'badge bg-danger' : 'badge bg-success' ?>"><?= $meds['quantity'] <= 50 ? 'Low Stock' : 'Stock In' ?>
                                                    </div>
                                                </td>
                                                <td style="display: flex; gap: 2px;">
                                                    <button id="medUpdate<?php echo $meds['id']; ?>" class="btn btn-secondary" value="<?php echo $meds['id']; ?>" onclick="retrieve(<?php echo $meds['id'] ?>);"><i class="fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#medsupdate"></i></button>

                                                    <a href="medicines.php?delete2=<?php echo $meds['id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/toggleSidebar.js"></script>
    <script src="js/fontAwesome.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script>
        function retrieve(id) {
            $.getJSON(`process.php?getmeds=${id}`, function(data) {
                let datas = data.split("_");
                $('#medsid').val(datas[0]);
                $('#medicine').val(datas[1]);
                $('#type').val(datas[2]);
                $('#qty').val(datas[3]);
                $('#description').val(datas[4]);
                $('input#unitprice').val(datas[5]);
            });
        }
        $(document).ready(function() {
            $('#tableMedicine').DataTable();
            let schedtoggle = 0;
            $('#schedtog').click(function() {
                schedtoggle++;
                if (schedtoggle % 2 == 0) {
                    $('.schedtoggle').slideToggle();
                } else {
                    $('.schedtoggle').slideDown();
                }
            });
            let oms = 0;
            $('#onToggle').click(function() {
                oms++;
                if (oms % 2 == 0) {
                    $('.subtoggle').slideToggle();
                } else {
                    $('.subtoggle').slideDown();
                }
            });
            let omsi = 0;
            $('#onToggle2').click(function() {
                omsi++;
                if (omsi % 2 == 0) {
                    $('.subtoggle2').slideToggle();
                } else {
                    $('.subtoggle2').slideDown();
                }
            })
            <?php
            if (isset($_SESSION['updatemeds'])) {
                $msg = $_SESSION['updatemeds'];
                echo "Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '$msg',
                        showConfirmButton: false,
                        timer: 1500 
                      });";
                unset($_SESSION['updatemeds']);
            }

            if (isset($_SESSION['alert1'])) {
                $msg = $_SESSION['alert1'];
                echo "Swal.fire({
                        icon: 'warning',
                        title: '$msg',
                        showConfirmButton: false,
                        timer: 3500 
                      });";
                unset($_SESSION['alert1']);
            }

            if (isset($_SESSION['addmeds'])) {
                $msg = $_SESSION['addmeds'];
                echo "Swal.fire({
                    icon: 'success',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['addmeds']);
            }

            if (isset($_SESSION['delete2'])) {
                $msg = $_SESSION['delete2'];
                echo "Swal.fire({
                    icon: 'success',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['delete2']);
            }
            ?>
        });
    </script>
</body>

</html>