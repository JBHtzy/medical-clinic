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
    <title>Admin | Schedules</title>
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
            overflow: scroll;
        }

        .box-catalog {
            width: 150px;
            height: 50px;
            margin-bottom: 10px;
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
                    <div class="d-flex justify-content-between">
                        <h3 class="mt-2 text-uppercase fw-bold"><i class="fa-solid fa-calendar-days border rounded-circle secondary-bg2 p-2"></i> List of Schedules</h3>
                    </div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Schedules</li>
                        </ol>
                    </nav>
                    <!-- MODAL UPDATE -->
                    <div class="modal fade" id="schedUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">Edit Schedules</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="process.php" method="POST" class="row g-3" style="padding: 30px;">
                                    <input type="hidden" name="upid" id="upid" value="">
                                    <div class="col-md-6">
                                        <label for="patient" class="form-label">Patient</label>
                                        <input type="text" name="patient" class="form-control" id="firstname" value="" readonly>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" name="date" class="form-control" id="date" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="time" class="form-label">Time</label>
                                        <input type="text" name="time_sched" class="form-control" id="timesched" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="contact" class="form-label">Contact no.</label>
                                        <input type="text" name="contact" class="form-control" id="contact_no" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="service" class="form-label">Service</label>
                                        <input type="text" name="service" class="form-control" id="service" value="">
                                    </div>
                                    <div class="col-12 text-end">
                                        <button class="btn btn-sm btn-success w-25" type="submit" name="updateAd">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-striped display nowrap" id="tableSchedule" style="width: 100%;">
                                <thead class="bg-info">
                                    <tr>
                                        <th scope="col">Patient's Name</th>
                                        <th scope="col">Date of Appointment</th>
                                        <th scope="col">Time of Appointment</th>
                                        <th scope="col">Purpose</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Contact No.</th>
                                        <th scope="col" class="text-center">Date</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $result = $mysqli->query("SELECT * FROM schedule ORDER BY id asc");
                                ?>
                                <tbody class="align-middle text-center">
                                    <?php while ($users = $result->fetch_assoc()) {
                                        $date = $users['sched_create'];
                                        $newdate2 = date("F d, Y - D h:i:s A", strtotime($date));
                                        $d = $users['date'];
                                        $a = explode(" ", $d);
                                        [$su] = $a;
                                        $newdate = date("M d Y, D", strtotime($su));
                                    ?>
                                        <tr>
                                            <td><?php echo $users['patient'] ?></td>
                                            <td><?php echo $newdate ?></td>
                                            <td><?php echo $users['time_sched'] ?></td>
                                            <td><?php echo $users['service'] ?></td>
                                            <td>
                                                <a href="../process.php?approve_status=<?php echo $users['id'] ?>" class="btn btn-primary"><i class="fa-solid fa-check"></i>Done</a>

                                                <a href="../process.php?cancel_status=<?php echo $users['id'] ?>" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i>Cancel</a>
                                            </td>
                                            <td><?php echo $users['contact_sched'] ?></td>
                                            <td><?php echo $newdate2 ?></td>
                                            <!-- <td>
                                                <div class="p-2 w-100 <#?php echo ($users['status'] === 'pending' ? 'badge bg-secondary' : ($users['status'] === 'approve' ? 'badge bg-success' : ($users['status'] === 'cancel' ? 'badge bg-warning' : ''))) ?>">
                                                    <#?php
                                                    $n = $users['status'];
                                                    $a = ($n === 'pending') ? "Pending" : (($n === 'approve') ? 'Approved' : 'Canceled');
                                                    echo $a ?>
                                                </div>
                                            </td> -->
                                            <td style="display: flex; gap: 5px;">
                                                <button id="edit_<?php echo $users['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square" data-bs-toggle="modal" data-bs-target="#schedUpdate"></i></button>

                                                <a href="../process.php?delete=<?php echo $users['id']; ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
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
                responsive: true
            });
            $("button[id^='edit_']").click(function() {
                let id = $(this).attr('id').slice(5);
                $('#upid').attr('value', id);
                $.getJSON(`../process.php?getedit=${id}`, function(data) {
                    data.forEach(element => {
                        $('#firstname').attr('value', element.patient);
                        $('#date').attr('value', element.date);
                        $('#timesched').attr('value', element.time_sched);
                        $('#service').attr('value', element.service);
                        $('#contact_no').attr('value', element.contact_sched);
                    });
                });
            })
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
            <?php
            if (isset($_SESSION['updated'])) {
                $msg = $_SESSION['updated'];
                echo "Swal.fire({
                    icon: 'success',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['updated']);
            }

            if (isset($_SESSION['delete'])) {
                $msg = $_SESSION['delete'];
                echo "Swal.fire({
                    icon: 'warning',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['cancel_status'])) {
                $msg = $_SESSION['cancel_status'];
                echo "Swal.fire({
                    icon: 'warning',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 1500
                  });";
                unset($_SESSION['cancel_status']);
            }
            ?>
        })
    </script>
</body>

</html>