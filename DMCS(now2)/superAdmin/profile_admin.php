<?php
include '../include/sessionstart.php';
require_once '../database/dbconn.php';

$id = $_SESSION['id'];
$result = $mysqli->query("SELECT * FROM users WHERE id = '$id'");
$users = $result->fetch_assoc();

$firstname = $users['firstname'];
$lastname = $users['lastname'];
$user = $users['username'];
$gender = $users['gender'];
$password = $users['password'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Profile</title>
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/googleFonts.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        form {
            position: relative;
        }

        .eyeToggle {
            margin-left: 70px;
            font-size: 1.2rem;
            position: absolute;
            bottom: 148px;
            cursor: pointer;
        }

        .profimg {
            width: 80px;
            position: absolute;
            top: 90px;
        }

        #message {
            position: absolute;
            bottom: 35px;
        }
    </style>
</head>

<body>

    <?php include('include/navbar_admin.php') ?>
    <div class="d-flex bg-light" id="wrapper">
        <?php include('include/sidebar_admin.php') ?>
        <div id="page-content-wrapper">
            <div class="container-fluid mt-3 px-4">
                <div class="bg-white p-4 shadow-sm" style="width: 65%;">
                    <h3 class="mt-2 text-uppercase" style="margin-left: 85px;">Profile</h3>
                    <img src="../imgs/logo2_24_21540.png" class="profimg" alt="">
                    <form action="../process.php" method="POST" class="row ms-2 mt-4 g-3">
                        <input type="hidden" name="userid" id="userid" value="<?php echo $id ?>">
                        <div class="col-md-5">
                            <label for="firstname" class="form-label">First name</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" value="<?= $firstname ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="lastname" class="form-label">Last name</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $lastname ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="username" class="form-label">Username</label>
                            <input type="mail" name="username" class="form-control" id="username" value="<?= $user ?>">
                        </div>
                        <div class="col-md-5">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" name="gender" class="form-control" id="gender" value="<?= $gender ?>">
                        </div>
                        <br>
                        <div class="div" style="width: 250px;">
                            <label for="password" class="form-label"> New password</label>
                            <i class="eyeToggle fa-solid fa-eye border-start px-2" id="eyetoggle"></i>
                            <input type="password" name="password" class="form-control" id="password" value="<?= $password ?>" required>

                            <label for="cpassword" class="form-label mt-2">Confirm password</label>
                            <input type="password" name="password" class="form-control" id="cpassword" value="" required>
                            <span id='message'></span>
                        </div>
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-success" name="saveedit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/toggleSidebar.js"></script>
    <script src="../js/fontAwesome.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script>
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
            $('#eyetoggle').on('click', function() {
                let passInput = $('#password, #cpassword');
                if (passInput.attr('type') === 'password') {
                    passInput.attr('type', 'text');
                } else {
                    passInput.attr('type', 'password');
                }
            });
            $('#password, #cpassword').on('keyup', function() {
                if ($('#password').val() == $('#cpassword').val()) {
                    $('#password, #cpassword').css('border', 'solid 1px green');
                    $('#message').html('Password match!').css('color', 'green');
                } else {
                    $('#password, #cpassword').css('border', 'solid 1px red');
                    $('#message').html('Password does not match!').css('color', 'red');
                }
            })
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

        if (isset($_SESSION['auth4'])) {
            $msg = $_SESSION['auth4'];
            echo "Swal.fire({
                icon:'success', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 1500
            });";
            unset($_SESSION['auth4']);
        };

        ?>
    </script>
</body>

</html>