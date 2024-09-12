<?php
include 'include/sessionstart.php';
require_once 'database/dbconn.php';
if (isset($_SESSION['id'])) {
    header('location:superAdmin/home_admin.php');
}
// if (!isset($_SESSION['id'])) {
//   header('location:index.php');
// }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require 'vendor/phpmailer/src/SMTP.php';
require '../phpmailer/src/SMTP.php';

require 'vendor/autoload.php';

if (isset($_POST['forgotpass'])) {
    $username = $_POST['forgotUsername'];

    $query = mysqli_query($connect, "SELECT * from `users` where id = '$username'");
    $row = mysqli_num_rows($query);

    if ($row === 1) {
        $getemail = mysqli_fetch_assoc($query);
        $email = $getemail['member_email'];

        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = 'schedulerascbislig@gmail.com';
        $mail->Password = 'sboffswwrexhrlqr';
        $mail->isHTML(true);

        $mail->setFrom('schedulerascbislig@gmail.com');
        $mail->addAddress($email);

        $mail->Subject = 'Reset Password';
        $newemail = explode("@", $email);
        $convertedemail = '';
        for ($i = 0; $i < strlen($newemail[0]); $i++) {
            if ($i === 0 || $i === 1 || $i === (strlen($newemail[0]) - 1)) {
                $convertedemail .= $newemail[0][$i];
            } else {
                $convertedemail .= '*';
            }
        }
        $convertedemail .= '@';
        $convertedemail .= $newemail[1];
        $_SESSION['email'] = $convertedemail;

        $characters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz0123456789');
        shuffle($characters);
        $newpassword = '';
        for ($j = 0; $j < 15; $j++) {
            shuffle($characters);
            $newpassword .= $characters[$j];
        }

        $mail->Body = 'Your new password is ' . $newpassword;

        $mail->send();
        $hashpass = sha1($newpassword);
        mysqli_query($connect, "UPDATE members SET member_password='$hashpass' where member_username='$username' and member_email='$email';");
        $_SESSION['passwordreset'] = "Password has been reset.";
        header('location: ../forgotpassword.php');
    } else if ($row === 0) {
        $_SESSION['wronguser'] = "No username found!";
        header('location: ../');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/googleFonts.css" />
    <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon" />
    <title>Forgot Password | Dimaano Medical Clinic</title>
    <style>
        body {
            background-image: linear-gradient(rgba(9, 32, 50, 0.219),
                    rgba(9, 32, 50, 0.4)),
                url(imgs/bg2.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .box {
            background-image: linear-gradient(rgba(9, 32, 50, 0.219),
                    rgba(9, 32, 50, 0.4)),
                url(imgs/loginform.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            letter-spacing: 1px;
            font-family: 'poppins', sans-serif;
        }

        body {
            overflow: hidden;
        }

        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            display: flex;
            justify-content: center;
            position: relative;
            color: #fff;
            width: 50%;
            height: 50%;
            border-radius: 5px;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box shadow">
            <div class="header">
                <h2 class="text-center text-uppercase ms-3">Forgot Password</h2>
                <br>
                <label for="hashEmail">New Password has been sent to this Email</label>
                <input type="email" readonly value="<?php if (isset($_SESSION['email'])) {
                                                        echo $_SESSION['email'];
                                                    } ?>" class="form-control"> <br>
                <a href="index.php" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go back to login page</a>
            </div>
        </div>
    </div>

    <script src="js/fontAwesome.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script>
        <?php
        if (isset($_SESSION['auth1'])) {
            $msg = $_SESSION['auth1'];
            echo "Swal.fire({
                icon:'success', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 2000});";
            unset($_SESSION['auth1']);
        };
        ?>
    </script>
</body>

</html>