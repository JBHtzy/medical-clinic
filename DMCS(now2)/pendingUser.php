<?php
include 'include/sessionstart.php';
require_once 'database/dbconn.php';

if (!isset($_SESSION['id'])) {
    header('location:index.php');
}

if (isset($_GET['deleteUser'])) {
    $delete = $_GET['deleteUser'];

    $mysqli->query("DELETE FROM `users` where id = '$delete'");
    $_SESSION['gone'] = "User request deleted.";
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Request...</title>
    <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/googleFonts.css">
    <style>
        body {
            background: url(imgs/bg.jpg) no-repeat;
            width: 100%;
        }

        .p-4 {
            background: #00425A !important;
            box-shadow: 1px 0 3px #00425A;
        }

        .p-4:hover {
            box-shadow: 1px 1px 15px #00425A;
        }

        img {
            width: 50%;
        }

        .content-text {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: #fff;
        }

        .content-text a {
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['usertype'])) {
        $usertype = $_SESSION['usertype'];
        if ($usertype === 'staff') {
            include 'include/navbar.php';
        }
    }
    ?>
    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow">
                    <div class="content-text">
                        <div class="textSide">
                            <?php
                            if ($_SESSION['status'] === 'approved') {
                                echo '<img src="imgs/approved.png" alt="userApprove">';
                                if ($_SESSION['usertype'] === 'staff') { ?>
                                    <h1 class="fw-bold">User Approved..</h1>
                                    <p>Congratulations your staff registration has been approved. <br> Press the button to proceed</p>
                                    <a href="process.php?approveUser=<?= $_SESSION['id'] ?>" class="btn btn-success">Proceed</a>
                                <?php } else if ($_SESSION['usertype'] === 'patient') { ?>
                                    <h1 class="fw-bold">User Approved..</h1>
                                    <p>Congratulations your user registration has been approved. <br> Press the button to proceed.</p>
                                    <a href="process.php?approveUser=<?= $_SESSION['id'] ?>" class="btn btn-success">Proceed</a>
                                <?php }
                            } else if ($_SESSION['status'] === 'pending') { ?>
                                <img src="imgs/sand-clock.png" alt="userPending">
                                <h1 class="fw-bold">Pending Request..</h1>
                                <p>Your registration request is now pending for the approval. <br> Please wait. Thank you</p>
                                <a href="process.php?logout" class="btn btn-danger">Back to Login Form</a>
                            <?php } else if ($_SESSION['status'] === 'rejected') { ?>
                                <img src="imgs/fired.png" alt="userRejected">
                                <h1 class="fw-bold">User Rejected..</h1>
                                <p>Sorry, your registration request is rejected.</p>
                                <a href="pendingUser.php?deleteUser=<?= $_SESSION['id'] ?>" class="btn btn-danger">Delete User..</a>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/fontAwesome.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script>
        <?php
        if (isset($_SESSION['gone'])) {
            $msg = $_SESSION['gone'];
            echo "Swal.fire({
                icon: 'warning',
                title: '$msg',
                showConfirmButton: false,
                timer: 1500
              });";
            unset($_SESSION['gone']);
        }
        ?>
    </script>
</body>

</html>