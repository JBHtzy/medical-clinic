<?php
include '../include/sessionstart.php';
require_once '../database/dbconn.php';

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}


if ($_SESSION['usertype'] !== 'admin') {
    if ($_SESSION['status'] === 'pending') {
        header('Location: ../pendingUser.php');
    } else if ($_SESSION['status'] === 'approved') {
        header('Location: ../pendingUser.php');
    } else if ($_SESSION['status'] === 'rejected') {
        header('Location: ../pendingUser.php');
    } else if ($_SESSION['status'] === 'confirmed') {
        if ($_SESSION['usertype'] === 'staff') {
            header('location: ../home.php');
        } else if ($_SESSION['usertype'] === 'patient') {
            header('location: ../customer/homepage.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/googleFonts.css">
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

        .card2 .contentTop {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0.5rem;
        }

        .contentTop .input_year {
            display: flex;
            gap: 1rem;
            align-items: center;
            height: 2.5rem;
        }
    </style>
</head>

<body>
    <?php include('include/navbar_admin.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('include/sidebar_admin.php') ?>
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow">
                    <h3 class="my-2 text-uppercase ms-3 mb-3 fw-bold"><i class="fa-solid fa-chart-pie border me-2 rounded-circle p-2 secondary-bg2"></i>Dashboard</h3>
                    <div class="nav-tabs">
                        <nav class="mb-3 mt-3">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Overview</button>

                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#chartab" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Chart</button>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <!-- OVERVIEW -->
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="row ms-2 g-4 mt-3">
                                    <div class="col-md-4 oms">
                                        <div class="p-4 d-flex justify-content-around rounded">
                                            <i class="fa-solid fa-users fs-2 border rounded secondary-bg p-2 mb-5"></i>
                                            <div>
                                                <h6 class="text-center">Pending Users</h6>
                                                <p class="fs-4 fw-bold text-center">
                                                    <?php
                                                    $result = $mysqli->query("SELECT * FROM `users` where user_status = 'pending'");
                                                    echo $result->num_rows; ?>
                                                </p>
                                                <a href="./userlist.php" id="adminlink">View Here</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- CHART-TAB -->
                            <div class="tab-pane fade" id="chartab" role="tabpanel" aria-labelledby="nav-home-tab">
                                <div class="card2" data-aos="fade-down">
                                    <div class="contentTop">
                                        <h5 class="fw-bold fs-3">Sales Report</h5>
                                        <select id="selectmonth" class="form-select" disabled style="width: 10rem;height: 2.5rem;">
                                            <option value="" selected disabled id="monthdisabled">-Month-</option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        <div class="input_year">
                                            <label for="chart2yearfilter">Filter:</label>
                                            <input class="form-control" type="number" min="2000" id="chart2yearfilter" style="width: 6rem;" onchange="yearfilter('netpromoterchart');" onkeyup="yearfilter('netpromoterchart');">
                                            <label class="btn btn-primary" for="monthenabler">Daily</label>
                                            <input type="checkbox" id="monthenabler" class="form-check-input" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="chart2">
                                        <div class="chartLine" id="netpromoterchart" style="width:
                                        100%; height: 290px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/toggleSidebar.js"></script>
    <script src="../js/fontAwesome.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/chart.min.js"></script>
    <script>
        function yearfilter(string) {
            if (string === "netpromoterchart") {
                chartpromoter($("#chart2yearfilter").val(), string);
            }
        }

        const monthdates = [
            ["Jan", "Mar", "May", "Jul", "Aug", "Oct", "Dec"],
            ["Feb", "Apr", "Jun", "Sep", "Nov"]
        ];

        function datearrays(number) {
            let array = [
                [],
                []
            ];
            for (let i = 1; i <= number; i++) {
                array[0].push(i);
                array[1].push(0);
            }
            return array;
        }
        // end of year filtering

        // chart promoter
        const monthselector = {
            "Jan": "01",
            "Feb": "02",
            "Mar": "03",
            "Apr": "04",
            "May": "05",
            "Jun": "06",
            "Jul": "07",
            "Aug": "08",
            "Sep": "09",
            "Oct": "10",
            "Nov": "11",
            "Dec": "12"
        };
        var usedcanvas = {},
            forcharts = {
                netpromoterchart: [
                    [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                ],
            };

        function chartpromoter(search, stringObj) {
            let month = $("#selectmonth").val() === null ? "00" : `${$("#selectmonth").val()}`;
            let labelsArr, dataArr, ctx, charttype;
            if (stringObj === "netpromoterchart") {
                labelsArr = forcharts[stringObj][0];
                dataArr = forcharts[stringObj][1];

                if (usedcanvas[stringObj] === undefined) {
                    usedcanvas[stringObj] = 0;
                } else {
                    $(`#${stringObj}${usedcanvas[stringObj]}`).remove();
                    usedcanvas[stringObj]++;
                }
                charttype = "bar";
                $.getJSON(`../process.php?salesbyyear=${search}_${month}`, function(data) {
                    // console.log(data);
                    for (let i = 0; i < data.length; i++) {
                        dataArr[Number(data[i].time_purchased.split(" ")[0].split("-")[1]) - 1] += Number(data[i].amount);
                    }
                    $(`#${stringObj}`).html(
                        `<canvas id="${stringObj}${usedcanvas[stringObj]}"></canvas>`
                    );
                    ctx = $(`#${stringObj}${usedcanvas[stringObj]}`);
                    forcharts[stringObj] = [
                        [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec",
                        ],
                        [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    ];
                    forchart(labelsArr, dataArr, ctx, charttype, stringObj, month, search);
                });
            }
        }

        function forchart(labelarray, dataarray, canvas, charttype, labeltype, month, year) {
            if (labeltype === "netpromoterchart") {
                labeltype = "Total sales";
            }
            if (month !== "00") {
                // alert(forcharts['netpromoterchart'][0][Number(month) - 1]);
                if (monthdates[0].includes(forcharts['netpromoterchart'][0][Number(month) - 1])) {
                    // alert(31);
                    [labelarray, dataarray] = datearrays(31);
                } else {
                    if (month === "02") {
                        if (year % 4 === 0) {
                            [labelarray, dataarray] = datearrays(29);
                        } else {
                            [labelarray, dataarray] = datearrays(28);
                        }
                    } else {
                        [labelarray, dataarray] = datearrays(30);
                    }
                }
                $.getJSON(`../process.php?salesbyyear=${year}_${month}`, function(data) {
                    // console.log(data);
                    for (let i = 0; i < data.length; i++) {
                        dataarray[Number(data[i].time_purchased.split(" ")[0].split("-")[2]) - 1] += Number(data[i].amount);
                    }
                    for (let i = 0; i < dataarray.length; i++) {
                        dataarray[i] = Number(dataarray[i]);
                    }
                    charttype = "bar";
                    // console.log(labelarray, dataarray);
                    new Chart(canvas, {
                        type: charttype,
                        data: {
                            labels: labelarray,
                            datasets: [{
                                label: labeltype,
                                data: dataarray,
                                borderWidth: 3,
                                pointBackgroundColor: "#3367d1",
                                pointStyle: "circle",
                                fill: true,
                                clip: 50,
                                backgroundColor: "rgba(51, 103, 209, 0.4)",
                                borderColor: "#3367d1",
                                tension: 0.2,
                                hitRadius: 20,
                                radius: 3,
                                hoverBackgroundColor: "rgba(51, 103, 209, 0.9)",
                                hoverBorderWidth: 3,
                                hoverBorderColor: false,
                            }, ],
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                tooltip: {
                                    titleFont: {
                                        family: "poppins",
                                        size: 14,
                                    },

                                    titleColor: "#f7b445",
                                    titleSpacing: 3,
                                    padding: 10,
                                    bodyFont: {
                                        family: "poppins",
                                        size: 12,
                                    },
                                    usePointStyle: true,
                                    pointStyle: "circle",
                                    borderWidth: false,
                                },
                                legend: {
                                    align: "end",
                                    labels: {
                                        boxWidth: 10,
                                        boxHeight: 10,
                                        usePointStyle: true,
                                        pointStyle: "circle",
                                        font: {
                                            size: 12,
                                            family: "Poppins",
                                        },
                                    },
                                },
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        display: false,
                                    },
                                    ticks: {
                                        display: Math.max(...dataarray) < 10 ? false : true,
                                    },
                                },
                                x: {
                                    beginAtZero: true,
                                    grid: {
                                        display: false,
                                    },
                                    font: {
                                        color: "#ffff",
                                    },
                                },
                            },
                        },
                    });
                });
            } else {
                for (let i = 0; i < dataarray.length; i++) {
                    dataarray[i] = Number(dataarray[i]);
                }
                new Chart(canvas, {
                    type: charttype,
                    data: {
                        labels: labelarray,
                        datasets: [{
                            label: labeltype,
                            data: dataarray,
                            borderWidth: 3,
                            pointBackgroundColor: "#3367d1",
                            pointStyle: "circle",
                            fill: true,
                            clip: 50,
                            backgroundColor: "rgba(51, 103, 209, 0.4)",
                            borderColor: "#3367d1",
                            tension: 0.2,
                            hitRadius: 20,
                            radius: 3,
                            hoverBackgroundColor: "rgba(51, 103, 209, 0.9)",
                            hoverBorderWidth: 3,
                            hoverBorderColor: false,
                        }, ],
                    },
                    options: {
                        maintainAspectRatio: false,
                        plugins: {
                            tooltip: {
                                titleFont: {
                                    family: "poppins",
                                    size: 14,
                                },

                                titleColor: "#f7b445",
                                titleSpacing: 3,
                                padding: 10,
                                bodyFont: {
                                    family: "poppins",
                                    size: 12,
                                },
                                usePointStyle: true,
                                pointStyle: "circle",
                                borderWidth: false,
                            },
                            legend: {
                                align: "end",
                                labels: {
                                    boxWidth: 10,
                                    boxHeight: 10,
                                    usePointStyle: true,
                                    pointStyle: "circle",
                                    font: {
                                        size: 12,
                                        family: "Poppins",
                                    },
                                },
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: false,
                                },
                                ticks: {
                                    display: Math.max(...dataarray) < 10 ? false : true,
                                },
                            },
                            x: {
                                beginAtZero: true,
                                grid: {
                                    display: false,
                                },
                                font: {
                                    color: "#ffff",
                                },
                            },
                        },
                    },
                });
            }

        }
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
            });

            $('#chart2yearfilter').val(Date().split(" ")[3]);
            chartpromoter(Date().split(" ")[3], "netpromoterchart");

            $("#monthenabler").change(function() {
                let checked = $(this).is(":checked");
                if (checked) {
                    $("#selectmonth").prop("disabled", false);
                    $(`#selectmonth option[value="${monthselector[Date().split(" ")[1]]}"]`).prop("selected", true);
                } else if (!checked) {
                    $("#monthdisabled").prop("selected", true);
                    $("#selectmonth").prop("disabled", true);
                }
                yearfilter("netpromoterchart");
            });
            $("#selectmonth").change(function() {
                yearfilter('netpromoterchart');
            });
        });
        <?php
        if (isset($_SESSION['auth3'])) {
            $msg = $_SESSION['auth3'];
            echo "Swal.fire({
                icon:'success', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 1500
            });";
            unset($_SESSION['auth3']);
        };
        if (isset($_SESSION['none'])) {
            $msg = $_SESSION['none'];
            echo "Swal.fire({
                icon:'warning', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 1500
            });";
            unset($_SESSION['none']);
        };
        ?>
    </script>
</body>

</html>