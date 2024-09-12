<?php
include('../include/sessionstart.php');
include_once '../database/dbconn.php';

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}

if (isset($_SESSION['permanentname'])) {
    unset($_SESSION['permanentname']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Patient's Information</title>
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/googleFonts.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <style>
        table thead {
            position: sticky;
            top: -1px;
        }

        div.dataTables_wrapper div.dt-row {
            margin-top: 10px;
            margin-right: 10px;
            position: relative;
            height: 400px;
        }
    </style>
</head>

<body>
    <?php include('include/navbar_admin.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('include/sidebar_admin.php') ?>
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow mb-4">
                    <h3 class="mt-2 text-uppercase fw-bold"><i class="fa-solid fa-calendar-days border rounded-circle secondary-bg2 p-2"></i> User's Information</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered display nowrap" width="100%" id="tableSchedule">
                                <thead class="bg-info">
                                    <tr>
                                        <th scope="col">User Type</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Date of Registration:</th>
                                        <th scope="col" class="text-center">Action:</th>
                                    </tr>
                                </thead>
                                <?php
                                $result = $mysqli->query("SELECT * FROM users order by id desc");
                                ?>
                                <tbody class="align-middle text-center">
                                    <?php while ($users = $result->fetch_assoc()) {
                                        $date = $users['user_date'];
                                        $newdate = date("F d, Y - D h:i:s A", strtotime($date)); ?>
                                        <tr>
                                            <td><?php echo $users['usertype'] ?></td>
                                            <td><?php echo $users['username'] ?></td>
                                            <td><?php echo $users['firstname'] ?></td>
                                            <td><?php echo $users['lastname'] ?></td>
                                            <td><?php echo $users['age'] ?></td>
                                            <td><?php echo $users['gender'] ?></td>
                                            <td><?php echo $users['address'] ?></td>
                                            <td><?php echo $newdate ?></td>
                                            <td>
                                                <button id="medUpdate<?php echo $users['id']; ?>" class="btn btn-secondary" value="<?php echo $users['id']; ?>" onclick="retrieve(<?php echo $users['id'] ?>);"><i class="fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#userUpdate"></i></button>

                                                <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Modal update -->
                        <div class="modal fade" id="userUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog py-4">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Info</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form action="../process.php" method="POST" class="row g-3 p-4">
                                        <input type="hidden" name="userid" id="userid" value="">
                                        <div class="col-md-5">
                                            <label for="firstname" class="form-label">First name</label>
                                            <input type="text" name="firstname" class="form-control" id="firstname" value="">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="lastname" class="form-label">Last name</label>
                                            <input type="text" name="lastname" class="form-control" id="lastname" value="">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="age" class="form-label">Age</label>
                                            <input type="text" name="age" class="form-control" id="age" value="">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="mail" name="username" class="form-control" id="username" value="">
                                        </div>

                                        <div class="col-md-3">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select class="form-select" name="gender" aria-label="Default select example" id="gender">
                                                <option value="" selected hidden>Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div> <br>
                                        <div class="col-md-7">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" id="address" value="">
                                        </div>
                                        <div class="col-12 text-end">
                                            <button type="submit" class="btn btn-success" name="updateUsers">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/toggleSidebar.js"></script>
    <script src="../js/fontAwesome.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script>
        function retrieve(id) {
            $.getJSON(`../process.php?getUsers=${id}`, function(data) {
                let datas = data.split("_");
                $('#userid').val(datas[0]);
                $('#firstname').val(datas[1]);
                $('#lastname').val(datas[2]);
                $('#username').val(datas[3]);
                $('#age').val(datas[4]);
                $('#gender').val(datas[5]);
                $('#address').val(datas[6]);
            });
        }
        $(document).ready(function() {
            $('#tableSchedule').DataTable({
                ordering: false,
                scrollY: 350,
                responsive: true
            });
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
            if (isset($_SESSION['userdelete'])) {
                $msg = $_SESSION['userdelete'];
                echo "Swal.fire({
                    icon: 'success',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['userdelete']);
            }
            if (isset($_SESSION['user_up'])) {
                $msg = $_SESSION['user_up'];
                echo "Swal.fire({
                    icon: 'success',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['user_up']);
            }
            ?>
        })
    </script>
</body>

</html>