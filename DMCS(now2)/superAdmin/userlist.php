<?php
include('../include/sessionstart.php');
include_once '../database/dbconn.php';

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

if (isset($_SESSION['permanentname'])) {
    unset($_SESSION['permanentname']);
}

if (isset($_GET['userReject'])) {
    $reject = $_GET['userReject'];

    $mysqli->query("UPDATE `users` SET `user_status`='rejected' where id = '$reject'");
    $_SESSION['reject'] = "User registration rejected.";
    header('location:userlist.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | User List</title>
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
                    <h3 class="mt-2 text-uppercase fw-bold"><i class="fa-solid fa-calendar-days border rounded-circle secondary-bg2 p-2"></i> Pending User's List</h3>
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
                                        <th scope="col" class="w-25">Status</th>
                                        <th scope="col" class="w-25">Date</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $result = $mysqli->query("SELECT * FROM users where user_status = 'pending' ORDER BY id desc");
                                ?>
                                <tbody class="align-middle text-center">
                                    <?php while ($users = $result->fetch_assoc()) {
                                        $date = $users['user_date'];
                                        $newdate2 = date("F d, Y h:i:s A", strtotime($date)); ?>
                                        <tr>
                                            <td><?php echo $users['usertype'] ?></td>
                                            <td><?php echo $users['username'] ?></td>
                                            <td>
                                                <div class="p-2 w-50 <?php echo ($users['user_status'] === 'pending' ? 'badge bg-secondary' : ($users['user_status'] === 'approved' ? 'badge bg-success' : ($users['user_status'] === 'rejected' ? 'badge bg-warning' : ''))) ?>">
                                                    <?php
                                                    $n = $users['user_status'];
                                                    $a = ($n === 'pending') ? "Pending" : (($n === 'approved') ? 'Approved' : 'Rejected');
                                                    echo $a ?>
                                                </div>
                                            </td>
                                            <td><?php echo $newdate2 ?></td>
                                            <td>
                                                <a href="../process.php?userApprove=<?php echo $users['id'] ?>" class="btn btn-success"><i class="fa-solid fa-check"></i>Approve</a>
                                                <a href="userlist.php?userReject=<?php echo $users['id'] ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i>Reject</a>
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

    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/toggleSidebar.js"></script>
    <script src="../js/fontAwesome.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableSchedule').DataTable({
                ordering: false,
                responsive: true
                // scrollY: 350,
                // scrollX: true
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
            if (isset($_SESSION['reject'])) {
                $msg = $_SESSION['reject'];
                echo "Swal.fire({
                    icon: 'warning',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['reject']);
            }
            if (isset($_SESSION['upUser'])) {
                $msg = $_SESSION['upUser'];
                echo "Swal.fire({
                    icon: 'success',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['upUser']);
            }
            ?>
        })
    </script>
</body>

</html>