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
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/medweb.css">
    <link rel="stylesheet" href="../css/googleFonts.css">
    <link rel="stylesheet" href="css/userprof.css">
    <link rel="shortcut icon" href="../imgs/logo2_24_21540.png" type="image/x-icon">
</head>

<body>
    <?php include 'include/unavbar.php' ?>
    <div class="user_content">
        <div class="content-bg">
            <div class="content-img">
                <h1>Profile: <?php echo $userfirst . ' ' . $userlast ?></h1>
                <img src="../imgs/<?= $_SESSION['imgname']; ?>" width="200" height="200" style="border-radius: 50%; border: 1px solid;">
                <div class="content-info">
                    <form action="../process.php" method="post" class="form-user" enctype="multipart/form-data">
                        <span class="drop-title">Change Profile:</span>
                        <label for="file-input" class="drop-container">
                            <input type="file" accept="image/*" name="user_prof" id="file-input">
                        </label>
                        <button type="submit" name="change_prof">Save</button>
                    </form>
                </div>
            </div>

            <div class="other-info">
                <form action="../process.php" class="user_info" method="post">
                    <input type="hidden" name="iduser" id="iduser" value="<?php echo $user_id ?>">
                    <div class="info1">
                        <span>First name:</span>
                        <label for="first" class="label1">
                            <input class="input-style" name="fname" type="text" value="<?php echo $userfirst ?>">
                        </label>
                        <span>Last name:</span>
                        <label for="last" class="label1">
                            <input class="input-style" name="lname" type="text" value="<?php echo $userlast ?>">
                        </label>
                    </div>
                    <br>
                    <div class="info2">
                        <span>Gender:</span>
                        <label for="last" class="label1">
                            <input class="input-style" name="gen" type="text" value="<?php echo $usergender ?>">
                        </label>
                        <span>Address:</span>
                        <label for="last" class="label1">
                            <input class="input-style" name="addre" type="text" value="<?php echo $useradd ?>">
                        </label>
                    </div>
                    <br>
                    <span>Password:</span>
                    <label for="last" class="label1">
                        <input class="input-style" name="newpass" type="text" value="<?php echo $userpass ?>">
                    </label>
                    <br>
                    <button type="submit" name="user_update">Save Changes</button>
                </form>
            </div>
        </div>
    </div>



    <script src="../js/jquery.min.js"></script>
    <script src="../js/fontAwesome.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="js/main.js"></script>
    <script>
        <?php
        if (isset($_SESSION['changeprof'])) {
            $msg = $_SESSION['changeprof'];
            echo "Swal.fire({
                icon:'success', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 2000
            });";
            unset($_SESSION['changeprof']);
        };
        if (isset($_SESSION['useinfo'])) {
            $msg = $_SESSION['useinfo'];
            echo "Swal.fire({
                icon:'success', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 2000
            });";
            unset($_SESSION['useinfo']);
        };
        ?>
    </script>
</body>

</html>