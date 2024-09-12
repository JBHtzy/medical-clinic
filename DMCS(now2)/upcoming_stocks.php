<?php
include 'include/sessionstart.php';
include 'database/dbconn.php';

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
    <title>Inventory</title>
    <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/googleFonts.css">
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
                <div class="bg-white p-4 shadow">
                    <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upcoming"><i class="fa-solid fa-plus"></i>Add Stocks</button> -->
                    <div class="row mt-3">
                        <div class="col">
                            <caption class="caption-top mt-3">Stocks Information</caption>
                            <table class="table table-striped" id="tableMedicine">
                                <thead class="bg-info">
                                    <tr>
                                        <th scope="col">Medicine Name</th>
                                        <th scope="col">New Added Stocks</th>
                                        <th scope="col">Available stocks as of today</th>
                                        <th scope="col">Total</th>
                                        <!-- <th scope="col">Stock Out</th> -->
                                        <!-- <th scope="col">Remaining</th> -->
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <?php $upcome = $mysqli->query("SELECT medicines.id as id, medicines.medicine as name,SUM(COALESCE(expenses.quantity, 0)) as stOUt, medicines.quantity as available, medicines.added_meds as upcome, medicines.meds_date as date FROM medicines LEFT JOIN expenses on expenses.medicine = medicines.id GROUP by medicines.medicine ORDER BY id asc"); ?>
                                <tbody class="align-middle text-center">
                                    <?php while ($latest = $upcome->fetch_assoc()) {
                                        $addS2 = $latest['upcome']; // pila na add
                                        $addS = $latest['available'];
                                        $addS3 = $addS2 + $addS; // new total
                                        $minus = $latest['stOUt']; // pila na kaltas
                                        $minS = $addS3 - $minus; //remaining

                                        $medsID = $latest['id'];
                                        $mysqli->query("UPDATE `medicines` SET `quantity` = '$addS3' WHERE id = '$medsID'");
                                    ?>
                                        <tr>
                                            <td><?php echo $latest['name'] ?></td>
                                            <td><?php echo $addS2 ?></td>
                                            <td><?php echo $latest['available'] ?></td>
                                            <td><?php echo $addS3 ?></td>
                                            <!-- <td><#?php echo $latest['stOUt'] ?></td> -->
                                            <!-- <td><#?php echo $minS ?></td> -->
                                            <td>
                                                <button id="medUpdate<?php echo $latest['id']; ?>" class="btn btn-success" value="<?php echo $latest['id']; ?>" onclick="retrieve(<?php echo $latest['id'] ?>);"><i class="fa-solid fa-plus" data-bs-toggle="modal" data-bs-target="#Upcomeupdate"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Modal Update -->
                    <div class="modal fade" id="Upcomeupdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog py-4">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Stocks</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="process.php" method="POST" class="row g-3 p-4" id="stockForm">
                                    <!-- <div class="row g-3 p-4"> -->
                                    <input type="hidden" name="medicineid" id="medicineid">
                                    <div class="col-md-6">
                                        <label for="medicine" class="form-label">Medicine</label>
                                        <input type="text" name="medicine" id="medicinename2" class="form-control" autocomplete="off" readonly>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="qty" class="form-label">Stocks Added</label>
                                        <input type="number" name="qty" class="form-control" id="stocksID" value="0">
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-success" name="add_newstock" id="in">Add</button>
                                    </div>
                                    <!-- </div> -->
                                </form>
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
    <script src="js/dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script>
        function retrieve(id) {
            $.getJSON(`process.php?getupcome=${id}`, function(data) {
                let datas = data.split("_");
                $('#medicineid').val(datas[0]);
                $('#medicinename2').val(datas[1]);
                $('#stocksID').val(datas[2]);
            });
        };

        // function selectmedname() {
        //     let name = $(`#selectmeds option[value=${$('#selectmeds').val()}]`).html();
        //     $('#medicinename').val(`${name}`);
        //     $('#picker').addClass('d-none');
        //     $('#medicineid').val($('#selectmeds').val());
        // }

        $(document).ready(function() {
            // function time() {
            //     setTimeout(() => {
            //         $.getJSON('process.php?setZero=yes', function(data) {
            //             console.log(data);
            //             location.reload();
            //         })
            //     }, 5000);
            // }
            // time;

            // $("#in").click(function() {

            //     // time();
            //     $.ajax({
            //         url: "process.php",
            //         method: "POST",
            //         data: {
            //             name: "yes",
            //             medicineid: $("#medicineid").val(),
            //             medicine: $("#medicinename2").val(),
            //             qty: $("#stocksID").val()
            //         },

            //         success: function(data) {
            //             time();
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: data,
            //                 showConfirmButton: false,
            //                 timer: 3000
            //             })
            //         }
            //     });
            // })
            // getData();
            // $.getJSON('upcumming.php?yes=yes', function(data) {
            //     console.log(data);
            // })
            // function getData() {
            //     $.getJSON('process.php?getData=yes', function(data) {
            //         let tbody = "";
            //         data.forEach((ele) => {
            //             let total = Number(ele.upcome) + Number(ele.available);
            //             let minus = total - Number(ele.stOUt);
            //             tbody += `<tr>
            //                                 <td> ${ele.name} </td>
            //                                 <td>${ele.upcome}</td>
            //                                 <td>${ele.available}</td>
            //                                 <td>${total}</td>
            //                                 <td>${ele.stOUt}</td>
            //                                 <td>${minus}</td>
            //                                 <td>
            //                                     <button id="medUpdate${ele.id}" class="btn btn-success" value="${ele.id}" onclick="retrieve(${ele.id});"><i class="fa-solid fa-plus" data-bs-toggle="modal" data-bs-target="#Upcomeupdate"></i></button>
            //                                 </td>
            //                             </tr>`
            //         });
            //         console.log(tbody);
            //         $("#body").html(tbody);
            //     })
            // }
            $('#tableMedicine').DataTable();

            // $('#medicinename').keyup(function(e) {
            //     // alert(e.target.value);
            //     let holder;
            //     let search = e.target.value;
            //     let htmlpicker = `<select id="selectmeds" name="selectmeds" class="form-control border border-top-0 d-none" onchange="selectmedname();">`;
            //     $('#picker').removeClass('d-none');
            //     $.getJSON(`process.php?meds=${search}`, function(data) {
            //         if (data.length === 0) {
            //             $('#picker').html(htmlpicker + "<option value=''>Medicine not found</option></select><br>");
            //         } else {
            //             htmlpicker += `<option value='' selected disabled>${data.length} are available</option>`;
            //             data.forEach(ele => {
            //                 htmlpicker += `<option value='${ele.id}'>${ele.medicine}</option>`;
            //             });
            //             htmlpicker += `</select><br>`;
            //             $('#picker').html(htmlpicker);
            //             $(this).attr('placeholder', `${data[0]['medicine']}`);
            //         }

            //         if (search.length === 0) {
            //             $('#selectmeds, #picker').addClass('d-none');
            //         } else {
            //             $('#selectmeds, #picker').removeClass('d-none');
            //         }
            //     })
            // });
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
        if (isset($_SESSION['upcome_add'])) {
            $msg = $_SESSION['upcome_add'];
            echo "Swal.fire({
                icon:'success', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 1500
            });";

            echo "setTimeout(() => {
                $.getJSON('process.php?setZero=yes', function(data) {
                    console.log(data);
                    location.reload();
                })
            }, 10000);";
            unset($_SESSION['upcome_add']);
        };
        ?>
    </script>
</body>

</html>