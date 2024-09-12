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
    <title>Staff | Receipt</title>
    <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/googleFonts.css">
    <style>
        body {
            overflow: hidden;
        }

        .bg-white {
            height: 510px;
        }

        p {
            color: black;
        }

        table {
            height: 200px;
        }

        .form-control {
            width: 70%;
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
                    <h3 class="text-uppercase ms-4 mt-2 fw-bold"><i class="fa-solid fa-cart-shopping border rounded-circle secondary-bg2 p-2"></i> Receipt</h3>
                    <div class="row mx-3 mt-4">
                        <div class="col mt-2">
                            <form action="process.php" autocomplete="off" method="POST">
                                <div class="col-lg">
                                    <label for="patientName">Patient:</label>
                                    <input type="text" name="patientName" class="form-control mb-3" placeholder="Patient's name" <?php if (isset($_SESSION['permanentname'])) { ?> value="<?php echo $_SESSION['permanentname'] ?>" <?php } ?>>
                                </div>
                                <div class="col-lg">
                                    <label for="medicinename">Medicine:</label>
                                    <input type="text" name="medicinename" id="medicinename" class="form-control" placeholder="Choose medicines">
                                </div> <br>
                                <div id="picker" class="col-lg d-none" style="margin-top: -25px; ">
                                </div>
                                <div class="col-lg">
                                    <label for="purchaseQty">Quantity</label>
                                    <input type="number" name="purchaseQty" class="form-control" min="1" placeholder="No. of quantity">
                                </div><br>

                                <button type="submit" name="purchase" class="btn btn-success">Purchase</button>
                                <a href="purchaseInfo.php" class="btn btn-primary">Print receipt</a>
                            </form>
                        </div>

                        <div class="col me-4">
                            <table class="table table-bordered">
                                <?php if (!isset($_SESSION['now'])) {
                                    echo "<caption class='caption-top'>Recent Reciept</caption>";
                                } ?>
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Medicine</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $patientexpenses = mysqli_query($mysqli, "SELECT expenses.id as id, expenses.patientname as name, expenses.amount as amount, expenses.quantity as quant, medicines.medicine as med FROM expenses join medicines where expenses.medicine = medicines.id and expenses.time_purchased >= '$msg'");
                                    $rowspan = mysqli_num_rows($patientexpenses);
                                    $i = 0;
                                    $allExpenses = 0;
                                    while ($bayad = $patientexpenses->fetch_assoc()) {
                                        $num = $bayad['amount'];
                                        $allExpenses = $allExpenses + (float)($num);
                                        $_SESSION['allExpenses'] = $allExpenses;
                                    ?>
                                        <tr>
                                            <?php if ($i === 0) { ?>
                                                <td rowspan="<?php echo $rowspan ?>"><span><?= $bayad['name'] ?></span></td>
                                            <?php } ?>
                                            <td><?= $bayad['med'] ?></td>
                                            <td><?= $bayad['quant'] ?></td>
                                            <td><?= $num < 1 ? '₱0' : '₱' . $num ?></td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                                <caption class="caption-bottom me-2 text-end">Total price: ₱<?php echo $allExpenses ?> </caption>
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
    <script src="js/sweetalert2.js"></script>
    <script>
        function selectmedname() {
            let name = $(`#selectmeds option[value=${$('#selectmeds').val()}]`).html();
            $('#medicinename').val(`${name}`);
            $('#picker').addClass('d-none');
        }
        $(document).ready(function() {
            $('#medicinename').keyup(function(e) {
                // alert(e.target.value);
                let holder;
                let search = e.target.value;
                let htmlpicker = `<select id="selectmeds" name="selectmeds" class="form-control border border-top-0 d-none" onchange="selectmedname();">`;
                $('#picker').removeClass('d-none');
                $.getJSON(`process.php?meds=${search}`, function(data) {
                    if (data.length === 0) {
                        $('#picker').html(htmlpicker + "<option value=''>Medicine not found</option></select><br>");
                    } else {
                        htmlpicker += `<option value='' selected disabled>${data.length} are available</option>`;
                        data.forEach(ele => {
                            htmlpicker += `<option value='${ele.id}'>${ele.medicine}</option>`;
                        });
                        htmlpicker += `</select><br>`;
                        $('#picker').html(htmlpicker);
                        $(this).attr('placeholder', `${data[0]['medicine']}`);
                    }

                    if (search.length === 0) {
                        $('#selectmeds, #picker').addClass('d-none');
                    } else {
                        $('#selectmeds, #picker').removeClass('d-none');
                    }
                })
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
            if (isset($_SESSION['purchaseMeds'])) {
                $msg2 = $_SESSION['purchaseMeds'];
                echo "Swal.fire({
                        icon: 'success',
                        title: '$msg2',
                        showConfirmButton: false,
                        timer: 1500 
                      });";
                unset($_SESSION['purchaseMeds']);
            }
            if (isset($_SESSION['nowtime'])) {
                $msg3 = $_SESSION['nowtime'];
                echo "console.log('$msg3');";
                unset($_SESSION['nowtime']);
            }
            ?>
        });
    </script>
</body>

</html>