<?php
include "../include/sessionstart.php";
include "../database/dbconn.php";

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM `schedule` WHERE id = '$id'");

    $_SESSION['delete'] = "Successfully Deleted.";
    header('location:user_sched.php');
}

if (isset($_SESSION['owner'])) {
    $owner = $_SESSION['owner'];
}

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}

$user_id = $_SESSION['id'];
$userprof = $mysqli->query("SELECT * FROM users where id = '$user_id'");
$userinfo = $userprof->fetch_assoc();

$userName = $userinfo['username'];
$userfirst = $userinfo['firstname'];
$userlast = $userinfo['lastname'];
$usergender = $userinfo['gender'];
$useradd = $userinfo['address'];
$userpass = $userinfo['password'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Form</title>
    <link rel="stylesheet" href="../css/medweb.css">
    <link rel="stylesheet" href="../css/googleFonts.css">
    <link rel="stylesheet" href="css/datatable.css">
    <link rel="stylesheet" href="css/usersched.css">
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <style>
        body {
            overflow: hidden;
        }

        div.dataTables_wrapper {
            width: 800px;
            margin: 0 auto;
        }

        .mu-btn button {
            border: none;
            background-color: grey;
            width: 40px;
            font-size: 24px;
            border-radius: 5px;
            cursor: pointer;
        }

        .mu-btn .fa-trash {
            color: crimson;
        }

        #availMssg {
            position: absolute;
            font-size: 14px;
            right: 3rem;
            top: 12px;
        }
    </style>
</head>

<body>
    <?php include 'include/unavbar.php' ?>
    <div class="user_content">
        <div class="schedule-tab">
            <div class="formsched">
                <h1>Fill up form:</h1>
                <form action="../process.php" method="post" class="feed-form" id="schedform">
                    <div class="col">
                        <label for="patient" class="form-label">Patient:</label>
                        <input type="text" name="patient" id="patient" value="<?= $userfirst . ' ' . $userlast ?>" readonly>
                    </div>
                    <div class="col">
                        <label for="date" class="form-label">Date of Appointment</label>
                        <input type="date" name="date" id="date" value="" required>
                    </div>
                    <div class="col">
                        <label for="time" class="form-label">Time of Appointment</label>
                        <select class="form-select" name="time_sched" id="time_slot" required>
                        </select>
                    </div>
                    <div class="col">
                        <label for="contact" class="form-label">Contact No.</label>
                        <input type="text" name="contactno" id="contact" value="" required>
                    </div>
                    <div class="col">
                        <label for="service" class="form-label">Purpose:</label>
                        <!-- <input type="text" name="service" id="service" value=""> -->
                        <select class="form-select" name="service" id="service">
                            <option value="" selected hidden>Select purposes..</option>
                            <option value="consultation">Consultation</option>
                            <option value="checkup">Checkup</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                    <div id="inputField" style="display: none;margin-left: 8.6rem;">
                        <input type="text" name="others" id="others" placeholder="Enter other purposes..">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn-submit" id="btnSubmit" name="addsched">Submit</button>
                    </div>
                </form>
            </div>
            <!-- TABLE -->
            <div class="sched_table">
                <table id="tableSchedule" class="display nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Date of Appointment</th>
                            <th>Time of Appointment</th>
                            <th>Contact No.</th>
                            <th>Purpose</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    $owner_id = $userfirst . ' ' . $userlast;
                    $result = $mysqli->query("SELECT * FROM schedule where patient = '$owner_id' order by id desc");
                    ?>
                    <tbody>
                        <?php while ($users = $result->fetch_assoc()) {
                            $d = $users['date'];
                            $a = explode(" ", $d);
                            [$su] = $a;
                            $newdate = date("D, d M Y", strtotime($su));
                        ?>
                            <tr>
                                <td><?php echo $users['patient'] ?></td>
                                <td><?php echo $newdate ?></td>
                                <td><?php echo $users['time_sched'] ?></td>
                                <td><?php echo $users['contact_sched'] ?></td>
                                <td><?php echo $users['service'] ?></td>
                                <!-- <td>
                                    <div style="border-radius: 5px; padding: 5px; color:white; <#?php echo ($users['status'] === 'pending' ? 'background-color: grey;' : ($users['status'] === 'approve' ? 'background-color: green;' : ($users['status'] === 'cancel' ? 'background-color: red' : ''))) ?>">
                                        <#?php
                                        $n = $users['status'];
                                        $a = ($n === 'pending') ? "Pending" : (($n === 'approve') ? 'Approved' : 'Canceled');
                                        echo $a ?>
                                    </div>
                                </td> -->
                                <td class="mu-btn">
                                    <button id="edit_<?php echo $users['id']; ?>" class="modalup"><i class="fa-solid fa-pen-to-square"></i></button>

                                    <button><a href="user_sched.php?delete=<?php echo $users['id']; ?>"><i class="fa-solid fa-trash"></i></a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- modal form for update sched -->
                <div class="tab-modal" id="modal1">
                    <div class="closebtn"><i class="fa-solid fa-xmark"></i></div>
                    <hr>
                    <div class="tab-body">
                        <form action="../process.php" method="POST" class="formdet">
                            <input type="hidden" name="upid" id="upid" value="">
                            <div class="col2">
                                <label for="patient" class="form-label">Patient</label>
                                <input type="text" name="patient" class="form-control" id="firstname" value="" readonly>
                            </div>
                            <div class="col2">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" id="date" value="">
                            </div>
                            <div class="col2">
                                <label for="time" class="form-label">Time</label>
                                <input type="text" name="time_sched" class="form-control" id="timesched" value="">
                            </div>
                            <div class="col2">
                                <label for="service" class="form-label">Service</label>
                                <input type="text" name="service" class="form-control" id="rservice" value="">
                            </div>
                            <div class="col2">
                                <label for="service" class="form-label">Contact No.</label>
                                <input type="text" name="contact" class="form-control" id="contact_no" value="">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-sm btn-success w-25" type="submit" name="updated">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/jquery.min.js"></script>
    <script src="../js/fontAwesome.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="js/datatables.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                $("#service").change(function() {
                    var selectedValue = $(this).val();
                    var inputField = $("#inputField");

                    if (selectedValue === "others") {
                        inputField.show();
                    } else {
                        inputField.hide();
                    }
                });
            });
            // schedmaptoday();
            // function schedmaptoday() {
            //     let timeSlots = [
            //         '08:00 AM',
            //         '08:30 AM',
            //         '09:00 AM',
            //         '09:30 AM',
            //         '10:00 AM',
            //         '10:30 AM',
            //         '01:00 PM',
            //         '01:30 PM',
            //         '02:00 PM',
            //         '02:30 PM',
            //         '03:00 PM',
            //         '03:30 PM',
            //         '04:00 PM',
            //         '04:30 PM',
            //         '05:00 PM',
            //         '05:30 PM'
            //     ];
            //     let schedmap = {};
            //     // alert($(this).val());
            //     // $('#defaultTime').css('display', 'none');
            //     $.getJSON('../process.php?default=yes', function(data) {
            //         console.log(data);
            //         let option = '<option selected hidden>Select time...</option>';
            //         for (let y = 0; y < data.length; y++) {
            //             console.log(data[y]);
            //             if (schedmap[data[y]]) {
            //                 continue;
            //             }
            //             schedmap[data[y]] = true;
            //         }
            //         console.log(schedmap);
            //         for (let i = 0; i < timeSlots.length; i++) {
            //             if (schedmap[timeSlots[i]] == true) {
            //                 option += `<option disabled>${timeSlots[i]} Unavailable</option>`
            //             } else {
            //                 option += `<option value="${timeSlots[i]}">${timeSlots[i]} Available</option>`
            //             }
            //         }
            //         console.log(option);
            //         $('#time_slot').html(option);
            //     })
            // }

            $('#date').change(function() {
                let timeSlots = [
                    '08:00 AM',
                    '08:30 AM',
                    '09:00 AM',
                    '09:30 AM',
                    '10:00 AM',
                    '10:30 AM',
                    '01:00 PM',
                    '01:30 PM',
                    '02:00 PM',
                    '02:30 PM',
                    '03:00 PM',
                    '03:30 PM',
                    '04:00 PM',
                    '04:30 PM',
                    '05:00 PM',
                    '05:30 PM'
                ];
                let schedmap = {};
                let date = new Date($(this).val());
                // console.log(date);
                let dayOfWeek = date.getDay();
                // console.log(dayOfWeek);
                $.getJSON('../process.php?default=' + $(this).val(), function(data) {
                    console.log(data);
                    schedmap = {};
                    let option = '<option selected hidden>Select time...</option>';
                    for (let y = 0; y < data.length; y++) {
                        console.log(data[y]);
                        if (schedmap[data[y]]) {
                            continue;
                        }
                        schedmap[data[y]] = true;
                    }
                    console.log(schedmap);

                    for (let i = 0; i < timeSlots.length; i++) {
                        if (dayOfWeek === 0 || dayOfWeek === 6) {
                            option += `<option selected hidden>No available on weekends</option>`;
                        } else {
                            if (schedmap[timeSlots[i]] == true) {
                                option += `<option disabled>${timeSlots[i]} Unavailable</option>`
                            } else {
                                option += `<option value="${timeSlots[i]}">${timeSlots[i]} Available</option>`
                            }
                        }
                    }
                    console.log(option);
                    $('#time_slot').html(option);
                })

            });

            $('#tableSchedule').DataTable({
                ordering: false,
                scrollY: 290,
                scrollX: true,
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
                        $('#rservice').attr('value', element.service);
                        $('#contact_no').attr('value', element.contact_sched);
                    });
                });
            });
            const modal = $('#modal1');
            $('.modalup').click(function() {
                modal.fadeIn();
            });
            $('.closebtn').click(function() {
                modal.fadeOut();
            });
            <?php
            // function checkTimeAvailability($timeSlot)
            // {
            //     include('../database/dbconn.php');
            //     $query = $mysqli->query("SELECT time_sched FROM schedule WHERE time_sched = '$timeSlot'");
            //     if ($query) {
            //         $row = $query->fetch_assoc();
            //         $count = $row['time_sched'];
            //         if ($count > 0) {
            //             // Time slot is not available
            //             return false;
            //         } else {
            //             // Time slot is available
            //             return true;
            //         }
            //     } else {
            //         return false;
            //     }
            // }
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
            if (isset($_SESSION['addsched'])) {
                $msg = $_SESSION['addsched'];
                echo "Swal.fire({
                    icon: 'success',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 2500
                  });";
                unset($_SESSION['addsched']);
            }
            if (isset($_SESSION['conflictTime'])) {
                $msg = $_SESSION['conflictTime'];
                echo "Swal.fire({
                    icon: 'warning',
                    title: '$msg',
                    showConfirmButton: false,
                    timer: 3200
                  });";
                unset($_SESSION['conflictTime']);
            }
            ?>
        });
    </script>
</body>

</html>