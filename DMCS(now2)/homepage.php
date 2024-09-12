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

$userIDS = $userinfo['id'];
$userName = $userinfo['username'];
$userfirst = $userinfo['firstname'];
$userlast = $userinfo['lastname'];
$usergender = $userinfo['gender'];
$useradd = $userinfo['address'];
$userpass = $userinfo['password'];

if (isset($_GET['readDel'])) {
    $notid = $_GET['readDel'];
    $mysqli->query("UPDATE `schedule` SET `notify_status` = 'read' where id = '$notid'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dimaano Medical Clinic</title>
    <link rel="stylesheet" href="../css/medweb.css" />
    <link rel="stylesheet" href="../css/googleFonts.css" />
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon" />
</head>

<body>
    <?php include 'include/unavbar.php' ?>
    <!-- Content BG -->
    <div class="container" id="homepage">
        <div class="content">
            <h1>Dimaano Medical Clinic</h1>
            <h4>Your Health is our Priority</h4>
            <div class="linya"></div>
            <button>
                <span><a href="#wrapper">Book Now</a></span>
            </button>
        </div>
    </div>

    <div id="wrapper">
        <div class="bgmodal">
            <h1 class="title1">Request Schedule</h1>
            <div class="row">
                <div class="card">
                    <div class="image1"></div>
                    <span class="title"><a href="../customer/user_sched.php">Fill-up form</a></span>
                </div>
                <div class="card">
                    <div class="image2"></div>
                    <span class="title"><a href="userhistory.php">My History</a></span>
                </div>
            </div>

            <div class="availability">
                <div class="sepline"></div>
                <h1 class="title1">Clinic's Availability</h1>
                <div class="clinic-tab">
                    <div class="cont-tab">
                        <div class="clinic-title">
                            <h1>Current Status:</h1>
                            <span>[ Open ]</span>
                        </div>
                        <div class="clinichrs">
                            <h1>Operating Hours:</h1>
                            <p>Monday - Friday: 9:00 AM - 5:00 PM </p>
                            <p>Saturday - Sunday: Closed </p>
                        </div>
                    </div>
                    <div class="doc-icon">
                        <img src="../imgs/doctor.png" alt="">
                    </div>
                </div>
                <div class="svg-bg">

                </div>
            </div>

            <div class="other" id="aboutus">
                <h1 class="title2">About Us</h1>
                <div class="content2">
                    <div class="text-content">
                        <h3>
                            "Welcome to Dimaano Medical Clinic, where we strive to provide
                            quality healthcare services to our patients. Our clinic is
                            committed to improving the health and wellbeing of individuals
                            and families in our community. Our team of medical professionals
                            is dedicated to providing compassionate care and personalized
                            treatment plans that meet the unique needs of each patient.
                            <br /><br>
                            We offer a wide range of medical services, from routine
                            check-ups to specialized treatments, and utilize the latest
                            technology and research to ensure the highest level of care. At
                            Dimaano Medical Clinic, your health is our top priority."
                        </h3>
                    </div>
                    <div class="bg-img">
                        <img src="../imgs/home2.png" alt="" />
                    </div>
                </div>
            </div>

            <!-- ==============FOOOTER=========== -->
            <div class="footer" id="services">
                <div class="footertext">
                    <h1>Care Services</h1>
                    <span>Medicine should be your first call for any non-emergency care
                        needed</span>
                </div>
                <div class="footer-content">
                    <div class="card5">
                        <div class="card5-content">
                            <span>Book Schedules</span>
                            <p>Card description goes here.</p>
                        </div>
                    </div>
                    <div class="card5">
                        <div class="card5-content">
                            <span>Check-Ups</span>
                            <p>Card description goes here.</p>
                        </div>
                    </div>
                    <div class="card5">
                        <div class="card5-content">
                            <span>Wellness Care</span>
                            <p>Card description goes here.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer_last">
                <div class="lastcontent">
                    <h3>
                        Dimaano Medical Clinic. 2023
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/fontAwesome.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="js/main.js"></script>
    <script>
        <?php
        if (isset($_SESSION['auth2'])) {
            $msg = $_SESSION['auth2'];
            echo "Swal.fire({
                icon:'success', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 2000
            });";
            unset($_SESSION['auth2']);
        };
        ?>
    </script>
</body>

</html>