<?php
include 'include/sessionstart.php';
if (isset($_SESSION['id'])) {
  header('location:superAdmin/home_admin.php');
}
// if (!isset($_SESSION['id'])) {
//   header('location:index.php');
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/googleFonts.css" />
  <link rel="stylesheet" href="css/loginform.css" />
  <link rel="shortcut icon" href="imgs/logo2_24_21540.png" type="image/x-icon" />
  <title>Medical Clinic System</title>
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
  </style>
</head>

<body>
  <div class="container">
    <div class="box shadow align-items-center">
      <div class="leftside text-center text-white p-3 mt-5">
        <h5 class="fw-bold">Scheduling and Inventory Information System</h5>
        <img src="imgs/logo2_24_21540.png" alt="Medical Clinic" />
      </div>

      <div class="header">
        <h2 class="text-center text-uppercase ms-3">Sign In</h2>
        <form action="process.php" method="post" class="loginform">
          <label for="username" class="text-white">Username:</label>
          <input type="text" name="username" class="form-control" id="username" required />
          <span class="usericon"><i class="fa-solid fa-user border-start px-2"></i></span>
          <br>

          <label for="password" class="text-white">Password:</label>
          <input type="password" name="password" class="form-control" id="password" required />
          <span><i class="fa-sharp fa-solid fa-eye border-start px-2" onclick="toggle()" aria-hidden="true"></i></span>
          <br>

          <div class="text-center">
            <button type="submit" name="login" class="btn mb-3">Sign In</button>
            <br />
          </div>
          <!-- <a href="forgotpasswords.php" class="text-white">Forgot password?</a> -->
          <p class="text-white">Don't have an account?<br><a href="register.php" class="text-white">Sign up..</a></p>
        </form>
      </div>
    </div>
  </div>

  <script src="js/fontAwesome.js"></script>
  <script src="js/sweetalert2.js"></script>
  <script>
    let state = false;

    function toggle() {
      if (state) {
        document.getElementById("password").setAttribute("type", "password");
        state = false;
      } else {
        document.getElementById("password").setAttribute("type", "text");
        state = true;
      }
    }
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

    if (isset($_SESSION['auth2'])) {
      $msg = $_SESSION['auth2'];
      echo "Swal.fire({
                icon:'warning', 
                title:'$msg', 
                showConfirmButton: false,
                timer: 1500});";
      unset($_SESSION['auth2']);
    };
    ?>
  </script>
</body>

</html>