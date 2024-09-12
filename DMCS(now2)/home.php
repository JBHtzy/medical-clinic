<?php
include 'include/sessionstart.php';
require_once 'database/dbconn.php';

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

// if ($_SESSION['usertype'] === 'user') {
//     if ($_SESSION['status'] === 'pending') {
//         header('Location: pendingUser.php');
//     } else if ($_SESSION['status'] === 'approved') {
//         header('Location: pendingUser.php');
//     }
// }

if ($_SESSION['usertype'] === 'admin') {
    header('location:superAdmin/home_admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff | Dashboard</title>
    <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/googleFonts.css">
    <style>
        .bg-white {
            height: 550px;
        }

        body {
            overflow-y: scroll;
        }

        .p-4 {
            background: #00425A;
            box-shadow: 1px 0 3px #00425A;
        }

        .p-4:hover {
            box-shadow: 1px 1px 15px #00425A;
        }

        .col-md-4 {
            position: relative;
        }

        .col-md-4 a {
            text-decoration: none;
            color: #fff;
            position: absolute;
            bottom: 10px;
            right: 35%;
        }

        .col-md-4 a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php include('include/navbar.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('include/sidebar.php') ?>
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow">
                    <h3 class="my-2 text-uppercase ms-3 mb-3 fw-bold"><i class="fa-solid fa-chart-pie border me-2 rounded-circle p-2 secondary-bg2"></i>Dashboard</h3>
                    <div class="nav-tabs">
                        <nav class="mb-3 mt-3">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Overview</button>

                                <!-- <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#chartab" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Chart</button> -->
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <!-- OVERVIEW -->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row ms-2 g-4 mb-3">
                                    <div class="col-md-4 oms">
                                        <div class="p-4 d-flex justify-content-around rounded">
                                            <i class="fa-solid fa-calendar-days fs-2 border rounded secondary-bg p-2 mb-5"></i>
                                            <div>
                                                <h6 class="text-center">Schedules</h6>
                                                <p class="fs-4 fw-bold text-center">
                                                    <?php
                                                    $result = $mysqli->query("SELECT * FROM `schedule`");
                                                    echo $result->num_rows; ?>
                                                </p>
                                                <a href="schedules.php" id="adminlink">View Here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 oms">
                                        <div class="p-4 d-flex justify-content-around rounded">
                                            <i class="fa-solid fa-tablets fs-2 border rounded secondary-bg p-2 mb-5"></i>
                                            <div>
                                                <h6 class="text-center">Sold Medicines</h6>
                                                <p class="fs-4 fw-bold text-center">
                                                    <#?php
                                                    $result = $mysqli->query("SELECT expenses.medicine FROM `expenses`");
                                                    echo $result->num_rows; ?>
                                                </p>
                                                <a href="logs.php" id="adminlink">View Here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 oms">
                                        <div class="p-4 d-flex justify-content-around rounded">
                                            <i class="fa-solid fa-hand-holding-dollar fs-2 border rounded secondary-bg p-2 mb-5"></i>
                                            <div class="ms-4 ms">
                                                <h6 class="text-center">Patient Purchase</h6>
                                                <p class="fs-4 fw-bold text-center">
                                                    <#?php
                                                    $result = $mysqli->query("SELECT expenses.id, count(patientname) FROM `expenses` group by patientname order by expenses.id");
                                                    echo $result->num_rows;
                                                    ?>
                                                </p>
                                                <a href="logs.php" id="adminlink">View Here</a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-4 oms">
                                        <div class="p-4 d-flex justify-content-around rounded">
                                            <i class="fa-solid fa-arrow-trend-down fs-2 border rounded secondary-bg p-2 mb-5"></i>
                                            <div>
                                                <h6 class="text-center">Stockout Medicines</h6>
                                                <p class="fs-4 fw-bold text-center">
                                                    <?php
                                                    $result = $mysqli->query("SELECT * FROM `medicines` WHERE quantity <= 50");
                                                    echo $result->num_rows; ?>
                                                </p>
                                                <a href="medicines.php" id="adminlink">View Here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 oms">
                                        <div class="p-4 d-flex justify-content-around rounded">
                                            <i class="fa-solid fa-pills fs-2 border rounded secondary-bg p-2 mb-5"></i>
                                            <div>
                                                <h6 class="text-center">Available Medicines</h6>
                                                <p class="fs-4 fw-bold text-center">
                                                    <?php
                                                    $result = $mysqli->query("SELECT * FROM `medicines` WHERE quantity >= 11");
                                                    echo $result->num_rows; ?>
                                                </p>
                                                <a href="medicines.php" id="adminlink">View Here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 oms">
                                        <div class="p-4 d-flex justify-content-around rounded">
                                            <i class="fa-solid fa-truck-fast fs-2 border rounded secondary-bg p-2 mb-5"></i>
                                            <div>
                                                <h6 class="text-center">Stocks Arrived</h6>
                                                <p class="fs-4 fw-bold text-center">
                                                    <?php
                                                    $result = $mysqli->query("SELECT * FROM `upcoming_qty` WHERE upcome_qty");
                                                    echo $result->num_rows; ?>
                                                </p>
                                                <a href="upcoming_stocks.php" id="adminlink">View Here</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- CHART-TAB -->
                            <div class="tab-pane fade" id="chartab" role="tabpanel" aria-labelledby="nav-home-tab">
                                <?php
                                $chart = $mysqli->query("SELECT time_purchased as monthname, SUM(amount) as amount FROM expenses GROUP BY monthname");
                                while ($row = $chart->fetch_assoc()) {
                                    $month = $row['monthname'];
                                    $s = explode(" ", $month);
                                    [$temp] = $s;
                                    $tempM[] = date("d M", strtotime($temp));
                                    $amount[] = $row['amount'];
                                }
                                ?>
                                <canvas id="myChart" width="400" height="150"></canvas>
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
    <script src="js/sweetalert2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($tempM) ?>,
                datasets: [{
                    label: '# of Votes',
                    data: <?php echo json_encode($amount) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        $(document).ready(function() {
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
        });
        <?php
        if (isset($_SESSION['authstaff'])) {
            $msg = $_SESSION['authstaff'];
            echo "Swal.fire({
                icon:'success', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 1500
            });";
            unset($_SESSION['authstaff']);
        };
        ?>
    </script>
</body>

</html>