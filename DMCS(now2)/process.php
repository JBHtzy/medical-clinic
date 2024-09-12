<?php
include('include/sessionstart.php');
include "database/dbconn.php";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginquery = $mysqli->query("SELECT * FROM `users` WHERE username = '$username' AND password = '$password'");
    if (mysqli_num_rows($loginquery) === 1) {
        $row = $loginquery->fetch_assoc();
        if ($row['prof_img'] === '') {
            $_SESSION['imgname'] = 'default.jpg';
        } else {
            $_SESSION['imgname'] = $row['prof_img'];
        }

        $_SESSION['id'] = $row['id'];
        $_SESSION['usertype'] = $row['usertype'];
        $_SESSION['status'] = $row['user_status'];
        $_SESSION['email'] = $row['user_email'];


        if ($row['usertype'] === 'admin') {
            $_SESSION["logged"] = true;
            $_SESSION['greet'] = $row['firstname'];
            $_SESSION['auth3'] = 'Welcome ' . '<h1 class="fw-bold">' . $_SESSION['greet'] . '</h1>';
        } else if ($row['usertype'] === 'patient') { // USERS
            $_SESSION['owner'] = $row['lastname'];
            $_SESSION['auth2'] = 'Welcome ' . $_SESSION['owner'];
        } else if ($row['usertype'] === 'staff') { // STAFF
            $_SESSION["logged"] = true;
            $_SESSION['greetstaff'] = $row['firstname'];
            $_SESSION['authstaff'] = 'Welcome ' . '<h1 class="fw-bold">' . $_SESSION['greetstaff'] . '</h1>';
        }
        header('location:superAdmin/home_admin.php');
    } else {
        $_SESSION["logged"] = false;
        $_SESSION['auth2'] = 'Username/Password does not match.';
        header('location: index.php');
    }
}

if (isset($_GET['logout'])) {
    // unset($_SESSION['id']);
    session_unset();
    session_destroy();


    // unset($_SESSION['status']);
    header('location: index.php');
}

if (isset($_POST['register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $user = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['user_email'];
    $address = $_POST['address'];
    $usertype = $_POST['usertype'];

    $auth = $mysqli->query("SELECT * FROM `users` WHERE firstname = '$firstname'");
    $row = mysqli_num_rows($auth);
    if ($row >= 1) {
        $_SESSION['auth'] = 'This user is already exist';
        header('location:register.php');
    } else {
        $mysqli->query("INSERT INTO `users`(`firstname`, `lastname`, `username`, `age`, `gender`, `address`, `password`, `user_email`, `usertype`,`user_status`,`user_date`) VALUES ('$firstname','$lastname','$user','$age','$gender','$address','$password', '$email','$usertype','pending', now())");

        $_SESSION['auth1'] = 'Congrats!. Your account is now pending for approval.';
        header('location: index.php');
    }
}

if (isset($_POST['addsched'])) {
    $patient = $_POST['patient'];
    $date = $_POST['date'];
    $timesched = $_POST['time_sched'];
    $service = $_POST['service'];
    $others = $_POST['others'];
    $realservice = $others === "" ? $service : $others;
    $contact_no = $_POST['contactno'];

    $conflictCheck = $mysqli->query("SELECT * FROM schedule WHERE time_sched = '$timesched' and date = '$date'");
    if ($conflictCheck->num_rows > 0) {
        $_SESSION['conflictTime'] = "The selected time is already booked. Please choose a different time.";
        header('location:customer/user_sched.php');
    } else {
        $mysqli->query("INSERT INTO `schedule`(`patient`, `date`, `time_sched` , `service`, `contact_sched`, `status`,`sched_create`) VALUES ('$patient','$date', '$timesched' ,'$realservice','$contact_no','pending', now())");
        $_SESSION['addsched'] = 'Form Submitted';
        header('location:customer/user_sched.php');
    }
}

if (isset($_POST['addmeds'])) {
    $medicine = $_POST['medicine'];
    $type = $_POST['type'];
    $qty = $_POST['qty'];
    $unitprice = $_POST['unitprice1'];
    $description = $_POST['description'];

    $mysqli->query("INSERT INTO `medicines`(`medicine`, `type`, `quantity`, `description`, `unit_price`, `meds_date`, `medicine_status`) VALUES ('$medicine','$type','$qty','$description', '$unitprice', now(), 'added')");
    $_SESSION['addmeds'] = 'Medcine added successfully';
    header("location: medicines.php");
}

if (isset($_GET['getedit'])) {
    $id = $_GET['getedit'];

    $row = $mysqli->query("SELECT * FROM schedule WHERE id = '$id'");
    $data = array();
    $array = $row->fetch_assoc();
    array_push($data, $array);
    echo json_encode($data);
}

if (isset($_GET['getUsers'])) {
    $id = $_GET['getUsers'];

    $result = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
    $user = $result->fetch_assoc();

    $firstN = $user['firstname'];
    $lastN = $user['lastname'];
    $userN = $user['username'];
    $userAge = $user['age'];
    $userGen = $user['gender'];
    $userAdd = $user['address'];

    echo json_encode($id . '_' . $firstN . '_' . $lastN . '_' . $userN . '_' . $userAge . '_' . $userGen . '_' . $userAdd);
}

if (isset($_POST['updated'])) {
    $id = $_POST['upid'];
    $patient1 = $_POST['patient'];
    $date1 = $_POST['date'];
    $timesched1 = $_POST['time_sched'];
    $service1 = $_POST['service'];
    $contact1 = $_POST['contact'];

    $mysqli->query("UPDATE `schedule` SET `patient`='$patient1',`date`='$date1', `time_sched`='$timesched1',`service`='$service1', `contact_sched`='$contact1' WHERE id = '$id'");

    $_SESSION['updated'] = "Successfully updated.";
    header('location: schedules.php');
}

if (isset($_POST['updateAd'])) {
    $id = $_POST['upid'];
    $patient1 = $_POST['patient'];
    $date1 = $_POST['date'];
    $timesched1 = $_POST['time_sched'];
    $service1 = $_POST['service'];
    $contact1 = $_POST['contact'];

    $mysqli->query("UPDATE `schedule` SET `patient`='$patient1',`date`='$date1', `time_sched`='$timesched1',`service`='$service1', `contact_sched`='$contact1' WHERE id = '$id'");

    $_SESSION['updated'] = "Successfully updated.";
    header('location: superAdmin/schedulesAdmin.php');
}

if (isset($_POST['updatemeds'])) {
    $id = $_POST['medsid'];
    $medicine = $_POST['medicine'];
    $type = $_POST['type'];
    $quantity = $_POST['qty'];
    $unitprice = $_POST['unitprice'];
    $description = $_POST['description'];

    $_SESSION['medis'] = $medicine;
    $mysqli->query("UPDATE `medicines` SET `medicine`='$medicine',`type`='$type',`quantity`='$quantity',`description`='$description', `unit_price`='$unitprice', `medicine_status`='updated', `meds_date`=now() WHERE id = '$id'");

    $_SESSION['updatemeds'] = "Successfully updated.";
    header('location: medicines.php');
}

if (isset($_POST['updateUsers'])) {
    $userId = $_POST['userid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $user = $_POST['username'];
    $address = $_POST['address'];

    $mysqli->query("UPDATE `users` SET  `firstname`='$firstname',`lastname`='$lastname',`age`='$age',`gender`='$gender',`username`='$user',`address`='$address' WHERE id = '$userId'");
    $_SESSION['user_up'] = 'User updated successfully.';
    header('location:superAdmin/allUsers.php');
}

if (isset($_POST['saveedit'])) {
    $userid = $_POST['userid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $user = $_POST['username'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    $mysqli->query("UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`username`='$user',`gender`='$gender',`password`='$password' WHERE id = '$userid'");

    $_SESSION['auth4'] = 'Profile Updated';
    header('location: profile.php');
}

if (isset($_GET['getmeds'])) {
    $id = $_GET['getmeds'];

    $result = $mysqli->query("SELECT * FROM medicines WHERE id = '$id'");
    $meds = $result->fetch_assoc();

    $medicine = $meds['medicine'];
    $type = $meds['type'];
    $qty = $meds['quantity'];
    $unitprice = $meds['unit_price'];
    $description = $meds['description'];

    echo json_encode($id . '_' . $medicine . '_' . $type . '_' . $qty . '_' . $description . '_' . $unitprice);
}

if (isset($_GET['getupcome'])) {
    $id = $_GET['getupcome'];

    $result = $mysqli->query("SELECT * FROM medicines WHERE id = '$id'");
    $meds = $result->fetch_assoc();

    $medicine = $meds['medicine'];
    $addedM = $meds['added_meds'];

    echo json_encode($id . '_' . $medicine . '_' . $addedM);
}

if (isset($_POST['purchase'])) {
    $medid = $_POST['selectmeds'];
    $quantity = $_POST['purchaseQty'];
    $patientName = $_POST['patientName'];

    if (!isset($_SESSION['now'])) { // run query to insert new date na wala pay sulod na session
        mysqli_query($mysqli, "INSERT INTO `purchased_session`(`session_date`) VALUES (DATE_ADD(now(),interval 12 hour))"); // insert sa row na karon na date and time
        $query = mysqli_query($mysqli, "SELECT * from `purchased_session` where session_id = (SELECT max(session_id) from `purchased_session`)"); // kuhaon ang latest na petsa
        $getdate = $query->fetch_assoc();
        $_SESSION['now'] = $getdate['session_date']; // the session naay sulod
    }
    if (isset($_SESSION['now'])) { // call the session na naa nay sulod
        $_SESSION['now'] = $_SESSION['now'];
    } else {
        $query = mysqli_query($mysqli, "SELECT * from `purchased_session` where session_id = (SELECT max(session_id) from `purchased_session`)");
        $getdate = $query->fetch_assoc();
        $_SESSION['now'] = $getdate['session_date'];
    }

    $row = mysqli_query($mysqli, "SELECT * from medicines where id = '$medid'"); // call the id of medicine
    $medquantity = $row->fetch_assoc();
    $omsim = $medquantity['medicine'];
    $quantity1 = (int)$medquantity['quantity'] - (int)$quantity; // gkuhaan ang nabilin na tambal sa gpalit na tambal
    $bayrunon = (float)$medquantity['unit_price'] * (int)$quantity; // gitimes ni sa amount sa tambal sa gipalit na quantity
    $newbayrunon = twofixed($bayrunon);

    mysqli_query($mysqli, "UPDATE `medicines` SET `quantity`='$quantity1' WHERE id = '$medid'");
    mysqli_query($mysqli, "INSERT INTO `expenses`(`patientname`, `medicine`, `amount`, `quantity`, `time_purchased`) VALUES ('$patientName','$medid','$newbayrunon', '$quantity', DATE_ADD(now(),interval 12 hour))");

    $lowStock = 50;
    if ($quantity1 <= $lowStock) {
        $_SESSION['alert1'] = $omsim . " is now Low stock.";
    } else {
        $_SESSION['purchaseMeds'] = "Successfully purchased";
        header('location: receipt_form.php');
    }

    $_SESSION['permanentname'] = $patientName;
    $latest = mysqli_query($mysqli, "SELECT time_purchased from expenses where id = (SELECT max(id) from expenses)")->fetch_assoc();
    $_SESSION['nowtime'] = $latest['time_purchased'];
    header('location: receipt_form.php');
}

if (isset($_GET['meds'])) {
    $name = $_GET['meds'];
    $result = mysqli_query($mysqli, "SELECT * from medicines where medicines.medicine like '$name%' order by medicine");
    $medArr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($medArr, $row);
    }
    echo json_encode($medArr);
}

///* request sched approval
if (isset($_GET['approve_status'])) {
    $id = $_GET['approve_status'];

    $z = $mysqli->query("SELECT patient FROM schedule where id = '$id'");
    $username = $z->fetch_assoc();

    $p = $username['patient'];
    $_SESSION['approve_status'] = 'Patient ' . $p . ' Approved';
    $mysqli->query("UPDATE `schedule` SET `status`='done',`notify_status`='new'  WHERE id = '$id'");
    header('location: superAdmin/schedulesAdmin.php');
}

if (isset($_GET['cancel_status'])) {
    $id = $_GET['cancel_status'];

    $z = $mysqli->query("SELECT patient FROM schedule where id = '$id'");
    $username = $z->fetch_assoc();

    $p = $username['patient'];
    $_SESSION['cancel_status'] = 'Patient ' . $p . ' Cancelled';
    $mysqli->query("UPDATE `schedule` SET `status`='cancel',`notify_status`='new' WHERE id = '$id'");
    header('location: superAdmin/schedulesAdmin.php');
}

// if (isset($_POST['name'])) {
//     $medid = $_POST['medicineid'];
//     $stockIn = $_POST['qty'];

//     updateStockIn($mysqli, $stockIn, $medid);
//     // $_SESSION['upcome_add'] = 'Added successfully';

//     // header('location: upcoming_stocks.php');
//     echo "Added successfully";
// }
// */
if (isset($_POST['add_newstock'])) {
    $medid = $_POST['medicineid'];
    $stockIn = $_POST['qty'];

    // updateStockIn($mysqli, $stockIn, $medid);
    $meds_details = $mysqli->query("SELECT quantity,added_meds FROM medicines where `id` = '$medid'");
    $meds = $meds_details->fetch_assoc();

    $added = (int)$meds['added_meds'] + (int)$stockIn;
    // $mysqli->query("UPDATE `medicines` SET `added_meds`='$added', `last_activity_date`= now() where `id` = '$medid'");
    $mysqli->query("UPDATE `medicines` SET `added_meds`='$added' where `id` = '$medid'");
    $_SESSION['upcome_add'] = 'Added successfully';
    header('location: upcoming_stocks.php');
}

if (isset($_GET['setZero'])) {
    $mysqli->query("UPDATE `medicines` SET `added_meds`= 0");
    // $mysqli->query("UPDATE `expenses` SET `quantity`= 0");
    echo json_encode("success");
}
// if (isset($_GET['getData'])) {

//     $storeData = array();
//     $data = $mysqli->query("SELECT medicines.id as id, medicines.medicine as name,SUM(COALESCE(expenses.quantity, 0)) as stOUt, medicines.quantity as available, medicines.added_meds as upcome, medicines.meds_date as date FROM medicines LEFT JOIN expenses on expenses.medicine = medicines.id GROUP by medicines.medicine ORDER BY id asc");

//     while ($row = $data->fetch_assoc()) {
//         array_push($storeData, $row);
//     }
//     echo json_encode($storeData);
// }
// function updateStockIn($mysqli, $stockIn, $medid)
// {
//     // $meds_details = $mysqli->query("SELECT quantity,added_meds FROM medicines where `id` = '$medid'");
//     // $meds = $meds_details->fetch_assoc();

//     // $added = $meds['added_meds'] + $stockIn;
//     // $mysqli->query("UPDATE `medicines` SET `added_meds`='$added', `last_activity_date`= now() where `id` = '$medid'");
// }

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM `schedule` WHERE id = '$id'");

    $_SESSION['delete'] = "Successfully Deleted.";
    header('location:schedules.php');
}

if (isset($_POST['change_prof'])) {
    $id = $_SESSION['id'];
    $changeprof = $_FILES['user_prof']['name'];
    $_SESSION['imgname'] = $changeprof;
    move_uploaded_file($_FILES['user_prof']['tmp_name'], 'imgs/' . $changeprof);
    $mysqli->query("UPDATE `users` SET `prof_img`= '$changeprof' where `id` = '$id'");

    $_SESSION['userchange'] = 'You updated your profile picture.';
    $_SESSION['changeprof'] = 'Picture changed successfully';
    header('location: customer/userprof.php');
}

if (isset($_POST['user_update'])) {
    $iduser = $_POST['iduser'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $genuser = $_POST['gen'];
    $addre = $_POST['addre'];
    $newpass = $_POST['newpass'];

    $mysqli->query("UPDATE `users` SET `firstname`='$fname',`lastname`='$lname',`gender`='$genuser',`address`= '$addre',`password`='$newpass' WHERE id = '$iduser'");

    $_SESSION['ufirst'] = 'You updated your profile information.';
    $_SESSION['useinfo'] = 'User info changed successfully';
    header('location: customer/userprof.php');
}
// User request Approval
if (isset($_GET['userApprove'])) {
    $id = $_GET['userApprove'];

    $mysqli->query("UPDATE `users` SET `user_status`='approved',`notify_status`='new' where id = '$id'");
    $_SESSION['upUser'] = 'User approved successfully';
    header('Location: superAdmin/userlist.php');
}

if (isset($_GET['approveUser'])) {
    $id = $_GET['approveUser'];

    $mysqli->query("UPDATE `users` SET `user_status`='confirmed' where id = '$id'");

    if ($_SESSION['usertype'] === 'patient') {
        header('location:customer/homepage.php');
    } else if ($_SESSION['usertype'] === 'staff') {
        header('location:home.php');
    }
}

if (isset($_GET['salesbyyear'])) {
    [$year, $month] = explode("_", $_GET['salesbyyear']);

    if ($month === '00') {
        $result = $mysqli->query("SELECT * FROM `expenses` where time_purchased like '$year%'");
    } else {
        $result = $mysqli->query("SELECT * FROM `expenses` where time_purchased like '$year-$month%'");
    }
    $resultArr = [];
    while ($row = $result->fetch_assoc()) {
        array_push($resultArr, $row);
    }

    echo json_encode($resultArr);
}

if (isset($_GET['default'])) {
    $now = $_GET['default'];
    $schedtime = array();
    $schedTimeQry = $mysqli->query("SELECT * FROM `schedule` WHERE date = DATE_FORMAT('$now', '%Y-%m-%d')");
    while ($row = $schedTimeQry->fetch_assoc()) {
        array_push($schedtime, $row['time_sched']);
    }
    echo json_encode($schedtime);
}

// FUNCTIONS
function twofixed($price)
{
    $newPrice = (string)($price);
    [$floor, $ceil] = explode(".", $newPrice);
    $newCeil = "";
    if (strlen($ceil) === 0) {
        return (int)($floor);
    } else if (strlen($ceil) > 2) {
        for ($i = 0; $i < 2; $i++) {
            $newCeil .= $ceil[$i];
        }
    } else if (strlen($ceil) <= 2) {
        for ($i = 0; $i < strlen($ceil); $i++) {
            $newCeil .= $ceil[$i];
        }
    }
    return (float)($floor . "." . $newCeil);
}


// if (isset($_POST['pre-signup'])) {
//     $username = $_POST['modalUsername'];
//     $password = sha1($_POST['modalPassword']);
//     $query = mysqli_query($connect, "SELECT * FROM members WHERE member_username LIKE '$username'");

//     $verifier = 0;
//     $accepted = str_split('ABCDEFGHIJKLMNÑOPQRSTUVWXYZ0123456789abcdefghijklmnñopqrstuvwxyz');
//     for ($i = 0; $i < strlen($username); $i++) {
//         if (in_array($username[$i], $accepted)) {
//             $verifier++;
//         }
//     }
//     $row = mysqli_num_rows($query);
//     if ($verifier !== strlen($username)) {
//         $_SESSION['taken'] = 'Username must not contain special characters!';
//         if (isset($_SESSION['referral'])) {
//             header('location:../signup.php?referral=' . $_SESSION['referral']);
//         } else {
//             header('location:../');
//         }
//     } else {
//         if ($row >= 1) {
//             $_SESSION['taken'] = 'Username already taken!';
//             if (isset($_SESSION['referral'])) {
//                 header('location:../signup.php?referral=' . $_SESSION['referral']);
//             } else {
//                 header('location:../');
//             }
//         } else {
//             mysqli_query($connect, "INSERT INTO `partial`(user, pass) VALUES ('$username','$password')");
//             $partial = mysqli_query($connect, "SELECT * from partial order by partial_id DESC");
//             $row = mysqli_fetch_assoc($partial);
//             $_SESSION['pre-user'] = $row['user'];
//             $_SESSION['pre-pass'] = $row['pass'];
//             header('location:../pages/signingup.php');
//         }
//     }
// }