<?php
include "database/dbconn.php";
include "include/sessionstart.php";

if (!isset($_SESSION['now'])) {
    $query = mysqli_query($mysqli, "SELECT * from `purchased_session` where session_id = (SELECT max(session_id) from `purchased_session`);");
    $getdate = $query->fetch_assoc();
    $msg = $getdate['session_date'];
} else if (isset($_SESSION['now'])) {
    $msg = $_SESSION['now'];
}
if (!isset($_SESSION['permanentname'])) {
    $perm = mysqli_fetch_assoc($mysqli->query("SELECT * from expenses where id = (select max(id) from expenses)"));
    $name = $perm['patientname'];
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/googleFonts.css">
    <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon">
    <title>Staff | Receipt</title>
    <style>
        .prescription i {
            font-size: 2.5rem;
        }

        .square {
            width: 500px;
        }

        .headText {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php include('include/navbar.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('include/sidebar.php') ?>

        <div id="page-content-wrapper">
            <div class="container-fluid mt-2 px-3">
                <div class="bg-white mt-2 p-4 shadow-sm mb-3">
                    <a href="receipt_form.php" class="btn btn-danger me-1" id="back">Back</a>
                    <button type="button" onclick="printing();" class="btn btn-info">Print</button>
                    <div class="row mt-3 gap-4">
                        <div class="col">
                            <div class="text-center mb-4 headText">
                                <img src="imgs/logo2_24_21540.png" width="20%">
                                <div class="subText">
                                    <h3>Dimaano Medical Clinic</h3>
                                    <p class="text-dark">Espiritu St.. Mangagoy, Bislig City <br>
                                        Tel. No. +639489191629
                                    </p>
                                </div>
                            </div>
                            <div class="prescription ms-3">
                                <i class="fa-solid fa-prescription"></i>
                            </div>
                            <br>
                            <table class="table table-bordered shadow-sm mx-auto" style=" height: 200px; width: 475px;">
                                <?php
                                if (isset($_SESSION['now'])) {
                                    if (isset($_SESSION['permanentname'])) {
                                        $name = $_SESSION['permanentname'];
                                    }
                                    $currDate = explode(' ', $_SESSION['now']); // mahimong array [date, time]
                                    $current = $currDate[0]; // create variable and tawagon niya ang array then gipili nmu ang index
                                    $fDate = date("F d, Y", strtotime($current));
                                    echo "<div class='fw-bold d-flex justify-content-between mb-2' style='padding: 0rem 1rem;'>";
                                    echo "<h6 class='text-dark'>Name: " . " $name</h6>";
                                    echo "<h6 class='text-dark'>Date: " . " $fDate</h6>";
                                    echo "</div>";
                                } else if (!isset($_SESSION['now'])) {
                                    $currDate = explode(' ', $msg); // mahimong array [date, time]
                                    $current = $currDate[0]; // create variable and tawagon niya ang array then gipili nmu ang index
                                    $fDate = date("F d, Y", strtotime($current));
                                    echo "<div class='fw-bold d-flex justify-content-between mb-2' style='padding: 0rem 1rem;'>";
                                    echo "<h6 class='text-dark'>Name: " . " $name</h6>";
                                    echo "<h6 class='text-dark'>Date: " . " $fDate</h6>";
                                    echo "</div>";
                                }
                                ?>
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Medicine</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $patientexpenses = mysqli_query($mysqli, "SELECT expenses.id as id, expenses.patientname as name, expenses.amount as amount, expenses.quantity as quant, medicines.medicine as med FROM expenses join medicines where expenses.medicine = medicines.id and expenses.time_purchased >= '$msg'");
                                    while ($bayad = $patientexpenses->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $bayad['quant'] . 'pcs.' ?></td>
                                            <td><?= $bayad['med'] ?></td>
                                            <td><?= $bayad['amount'] < 1 ? '₱0' : '₱' . $bayad['amount'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <caption class="caption-bottom text-dark text-end me-2">Total price: ₱<?php echo $_SESSION['allExpenses'] ?>
                                    <br><br>
                                    <span class="border-bottom">Glenda V. Cabacungan</span>
                                    <p class="text-dark me-5">Pharmacist</p>
                                </caption>
                            </table>
                        </div>

                        <div class="col">
                            <div class="text-center mb-4 headText">
                                <img src="imgs/logo2_24_21540.png" width="20%">
                                <div class="subText">
                                    <h3>Dimaano Medical Clinic</h3>
                                    <p class="text-dark">Espiritu St.. Mangagoy, Bislig City <br>
                                        Tel. No. +639489191629
                                    </p>
                                </div>
                            </div>
                            <div class="prescription ms-3">
                                <i class="fa-solid fa-prescription"></i>
                            </div>
                            <br>
                            <table class="table table-bordered shadow-sm mx-auto" style="height: 200px;  width: 475px;">
                                <?php
                                if (isset($_SESSION['now'])) {
                                    if (isset($_SESSION['permanentname'])) {
                                        $name = $_SESSION['permanentname'];
                                    }
                                    $currDate = explode(' ', $_SESSION['now']); // mahimong array [date, time]
                                    $current = $currDate[0]; // create variable and tawagon niya ang array then gipili nmu ang index
                                    $fDate = date("F d, Y", strtotime($current));
                                    echo "<div class='fw-bold d-flex justify-content-between mb-2' style='padding: 0rem 1rem;'>";
                                    echo "<h6 class='text-dark'>Name: " . " $name</h6>";
                                    echo "<h6 class='text-dark'>Date: " . " $fDate</h6>";
                                    echo "</div>";
                                } else if (!isset($_SESSION['now'])) {
                                    $currDate = explode(' ', $msg); // mahimong array [date, time]
                                    $current = $currDate[0]; // create variable and tawagon niya ang array then gipili nmu ang index
                                    $fDate = date("F d, Y", strtotime($current));
                                    echo "<div class='fw-bold d-flex justify-content-between mb-2' style='padding: 0rem 1rem;'>";
                                    echo "<h6 class='text-dark'>Name: " . " $name</h6>";
                                    echo "<h6 class='text-dark'>Date: " . " $fDate</h6>";
                                    echo "</div>";
                                }

                                ?>
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Medicine</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $patientexpenses = mysqli_query($mysqli, "SELECT expenses.id as id, expenses.patientname as name, expenses.amount as amount, expenses.quantity as quant, medicines.medicine as med FROM expenses join medicines where expenses.medicine = medicines.id and expenses.time_purchased >= '$msg'");
                                    while ($bayad = $patientexpenses->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $bayad['quant'] . 'pcs.' ?></td>
                                            <td><?= $bayad['med']  ?></td>
                                            <td><?= $bayad['amount'] < 1 ? '₱0' : '₱' . $bayad['amount'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <caption class="caption-bottom text-dark text-end me-2">Total price: ₱<?php echo $_SESSION['allExpenses'] ?>
                                    <br><br>
                                    <span class="border-bottom">Glenda V. Cabacungan</span>
                                    <p class="text-dark me-5">Pharmacist</p>
                                </caption>
                            </table>
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
    <script>
        function printing() {
            $('button').addClass('d-none');
            $('#back').addClass('d-none');
            $('#menu-toggle, #companyname').addClass('d-none');
            window.print();
            $('button').removeClass('d-none');
            $('#back').removeClass('d-none');
            $('#menu-toggle, #companyname').removeClass('d-none');
            <?php
            if (isset($_SESSION['now'])) {
                unset($_SESSION['now']);
            }
            if (isset($_SESSION['permanentname'])) {
                unset($_SESSION['permanentname']);
            }
            ?>
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
            })
        });
    </script>
</body>

</html>