<?php
include 'include/sessionstart.php';
if (isset($_SESSION['id'])) {
    header('location: home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/googleFonts.css">
    <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon">
    <title>Registration Form</title>
    <style>
        body {
            background-image: linear-gradient(rgba(9, 32, 50, 0.219), rgba(9, 32, 50, 0.4)), url(imgs/bg2.jpg);
            height: 100vh;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card shadow w-100 my-1">
            <h3 class="fw-bold">Registration Form</h3>

            <form action="process.php" method="POST" autocomplete="off" class="row g-3" onsubmit="return validateForm()">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">First name</label>
                    <input type="text" name="firstname" class="form-control" id="firstname" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Last name</label>
                    <input type="text" name="lastname" class="form-control" id="lastname" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="col-md">
                    <label for="inputEmail4" class="form-label">Age</label>
                    <input type="text" name="age" class="form-control" id="age">
                </div>
                <div class="col-md-3 mt-5">
                    <select class="form-select" name="gender" aria-label="Default select example" id="gender">
                        <option value="">Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="user_email" class="form-control" id="email">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    <i class="eyeToggle fa-solid fa-eye" onclick="toggle()"></i>
                </div>
                <div class="col-md-3 mt-5">
                    <select class="form-select" name="usertype" aria-label="Default select example" id="usertype" required>
                        <option value="">User type:</option>
                        <option value="staff">Staff</option>
                        <option value="patient">Patient</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-info my-2 w-100" name="register">Register</button>
                </div>
            </form>
            <p class="mt-2">Have an account? <a href="index.php" class="btn-secondary">Login here</a></p>
        </div>
    </div>



    <script src="js/sweetalert2.js"></script>
    <script src="js/fontAwesome.js"></script>
    <script>
        // function validateForm() {
        //     const userType = document.getElementById('usertype').value;

        //     if (userType === 'admin') {
        //         alert("Invalid user type selection. Please choose User/Patient.");
        //         return false;
        //     }
        //     return true;
        // }

        let state = false;

        function toggle() {
            if (state) {
                document.getElementById("password").setAttribute("type", "password");
                state = false;
            } else {
                document.getElementById("password").setAttribute("type", "text");
                state = true;
            }
        };
        <?php
        if (isset($_SESSION['auth'])) {
            $msg = $_SESSION['auth'];
            echo "Swal.fire({icon:'error', title:'$msg', showConfirmButton: false,
            timer: 1500});";
            unset($_SESSION['auth']);
        }

        ?>
    </script>
</body>

</html>