<?php
include "../include/sessionstart.php";
include "../database/dbconn.php";

if (isset($_SESSION['owner'])) {
    $owner = $_SESSION['owner'];
}

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}

$user_id = $_SESSION['id'];
$userprof = $mysqli->query("SELECT * FROM users where id = '$user_id'");
$userinfo = $userprof->fetch_assoc();

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
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/medweb.css">
    <link rel="stylesheet" href="../css/googleFonts.css">
    <link rel="stylesheet" href="css/userhistory.css">
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon">
</head>

<body>
    <?php include 'include/unavbar.php' ?>
    <div class="user_content">
        <button><a href="homepage.php">Back</a></button>
        <div class="user_wrapper">
            <?php
            $tabid = $userfirst . ' ' . $userlast;
            $result = $mysqli->query("SELECT * FROM schedule where patient = '$tabid' ORDER BY id desc"); ?>
            <div class="userhist">
                <h1>Schedule History</h1>
                <?php while ($users = $result->fetch_assoc()) {
                    $d = $users['date'];
                    $a = explode(" ", $d);
                    [$su] = $a;
                    $newdate = date("D, d M Y", strtotime($su));
                ?>
                    <p><?=
                        'You have booked schedule at ' .  $users['time_sched'] . ', ' . $newdate . '.' ?></p>
                <?php } ?>
            </div>
            <!-- <div class="userdetails">
                <h1>Profile History</h1>
                <p><#?= $_SESSION['ufirst'] ?></p>
                <p><#?= $_SESSION['userchange'] ?></p>
            </div> -->
        </div>
    </div>



    <script src="../js/jquery.min.js"></script>
    <script src="../js/fontAwesome.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="js/main.js"></script>
    <script>
    </script>
</body>

</html>