<?php
include('../include/sessionstart.php');
include_once '../database/dbconn.php';


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
    <title>Admin | Logs</title>
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/googleFonts.css">
    <link rel="stylesheet" href="../css/dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <style>
        div.dataTables_wrapper div.dt-row {
            margin-top: 10px;
            margin-right: 10px;
            position: relative;
            height: 400px;
            overflow-x: hidden;
        }

        .table thead {
            position: sticky;
            top: -1px;
            background: skyblue;
        }
    </style>
</head>

<body>
    <?php include('include/navbar_admin.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('include/sidebar_admin.php') ?>
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow mb-3">
                    <h3 class="mt-1 fw-bold"><i class="fa-solid fa-receipt border rounded-circle secondary-bg2 p-2"></i>Logs Information</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Logs</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col">
                            <div class="nav-tabs">
                                <nav class="mb-3 mt-3">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#patientlogs" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Schedule Logs</button>

                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#medlogs" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Inventory Logs</button>

                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#receiptlogs" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Purchased Logs</button>

                                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Overview</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <!-- PATIENT LOGS -->
                                    <div class="tab-pane fade show active" id="patientlogs" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <table class="table table-hover display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Patient Name</th>
                                                    <th scope="col">Date of Appointment</th>
                                                    <th scope="col">Time of Appointment</th>
                                                    <th scope="col">Purpose</th>
                                                    <th scope="col">Contact No.</th>
                                                    <th scope="col">Date</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $result = $mysqli->query("SELECT * FROM schedule ORDER BY id desc");
                                            ?>
                                            <tbody>
                                                <?php while ($users = $result->fetch_assoc()) {
                                                    $date = $users['sched_create'];
                                                    $newdate = date("F d, Y - D h:i:s A", strtotime($date));
                                                    $d = $users['date'];
                                                    $a = explode(" ", $d);
                                                    [$su] = $a;
                                                    $newdate2 = date("F d, Y - D", strtotime($su));
                                                ?>
                                                    <tr>
                                                        <td><?php echo $users['patient'] ?></td>
                                                        <td><?php echo $newdate2 ?></td>
                                                        <td><?php echo $users['time_sched'] ?></td>
                                                        <td><?php echo $users['service'] ?></td>
                                                        <td><?php echo $users['contact_sched'] ?></td>
                                                        <td><?php echo $newdate ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- INVENTORY LOGS -->
                                    <div class="tab-pane fade" id="medlogs" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <table class="table table-hover display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Medicines</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Remaining Qty</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Date & Time</th>
                                                </tr>
                                            </thead>
                                            <?php $result = $mysqli->query("SELECT * FROM `medicines` order by medicines.meds_date desc");
                                            ?>
                                            <tbody>
                                                <?php while ($meds = $result->fetch_assoc()) {
                                                    $curr = $meds['meds_date']; //gkuha ang value sa meds_date
                                                    $dt = explode(" ", $curr); //explode para malahi ang date ug oras
                                                    [$date] = $dt; //gkuha lang date 
                                                    $newdate = date("F d Y", strtotime($date)); //giformat para molugwa ang day,petsa, ug bulan
                                                    $newhour = date('h:i A', strtotime($curr));
                                                    //strtotime convert ang string to oras then ghtagan og format ang hour, minutes ug AM & PM.
                                                ?>
                                                    <tr>
                                                        <td><?= $meds['medicine'] ?></td>
                                                        <td><?php echo $meds['type'] ?></td>
                                                        <td><?php echo $meds['quantity'] ?></td>
                                                        <td><?php echo '₱' . $meds['unit_price'] ?></td>
                                                        <td><span class="text-capitalize fw-bold"><?php echo $meds['medicine_status'] ?></span> on <?php echo $newdate . ' at ' . $newhour ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- RECEIPT LOGS-->
                                    <div class="tab-pane fade" id="receiptlogs" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <table class="table table-hover table-hover display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Purchased Medicine</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Date & Time</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $result = $mysqli->query("SELECT expenses.patientname as name, medicines.medicine as medname, expenses.amount as amount, expenses.quantity as quantity, expenses.time_purchased as timepurchased FROM expenses join medicines where expenses.medicine = medicines.id ORDER BY expenses.time_purchased DESC");
                                            ?>
                                            <tbody>
                                                <?php while ($users = $result->fetch_assoc()) {
                                                    $current = $users['timepurchased'];
                                                    $ex = explode(" ", $current);
                                                    [$date1] = $ex;
                                                    $currDate = date("F d Y", strtotime($date1));
                                                    $currTime = date('h:i A', strtotime($current));
                                                ?>
                                                    <tr>
                                                        <td><?php echo $users['name'] ?></td>
                                                        <td><?php echo $users['medname'] ?></td>
                                                        <td><?php echo '₱' . $users['amount'] ?></td>
                                                        <td><?php echo $users['quantity'] . 'pcs.' ?></td>
                                                        <td><?php echo 'Purchased at ' . $currDate . ' at ' . $currTime ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- SUMMARY -->
                                    <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <table class="table table-hover display table-bordered table-hover" id="summarylogs" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Medicine Name</th>
                                                    <th scope="col">Stock In</th>
                                                    <th scope="col">Available stocks as of today</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Stock Out</th>
                                                    <th scope="col">Remaining</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $upcome = $mysqli->query("SELECT medicines.id as id, medicines.medicine as name,COALESCE(expenses.quantity, 0) as stOUt, medicines.quantity as available, medicines.added_meds as upcome, medicines.meds_date as date FROM medicines LEFT JOIN expenses on expenses.medicine = medicines.id GROUP by medicines.medicine ORDER BY id asc");
                                            ?>
                                            <tbody class="align-middle text-center">
                                                <?php while ($latest = $upcome->fetch_assoc()) {
                                                    $addS = $latest['available'];
                                                    $addS2 = $latest['upcome'];
                                                    $addS3 = $addS + $addS2; // total sa available ug upcome
                                                    $minus = $latest['stOUt'];
                                                    $minS = $addS3 - $minus; //remaining

                                                    $medsID = $latest['id'];
                                                    // $mysqli->query("UPDATE `medicines` SET `quantity` = '$minS' WHERE id = '$medsID'");
                                                ?>
                                                    <tr>
                                                        <td><?php echo $latest['name'] ?></td>
                                                        <td><?php echo $addS2 ?></td>
                                                        <td><?php echo $latest['available'] ?></td>
                                                        <td><?php echo $addS3 ?></td>
                                                        <td><?php echo $latest['stOUt'] ?></td>
                                                        <td><?php echo $minS ?></td>
                                                    </tr>
                                                <?php
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
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
        $(document).ready(function() {
            $('table.display').DataTable({
                ordering: false,
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
        })
    </script>
</body>

</html>