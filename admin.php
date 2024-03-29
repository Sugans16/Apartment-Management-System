<?php

include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = $_POST['username'];
  $pass = $_POST['userpassword'];

  $query = "SELECT * FROM ams_admin WHERE (BINARY a_username = '$user' or  BINARY a_email = '$user' or BINARY a_mobile_no = '$user') AND BINARY a_password = '$pass'";
  
  try{

    $result = $con->query($query);

  } catch(mysqli_sql_exception) {

    $error = json_decode(file_get_contents('error.json'), true)['4'];
    header('Content-Type: application/json');
    echo json_encode($error);
    exit();
  }
  

  if ($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    $cookies = $row['a_fname'] ?? $user;
    setcookie("admin", $cookies);
    $ouput = true;
    header('content-Type: application/json');
    echo json_encode($ouput);
    exit();
  } else {
    $error = json_decode(file_get_contents('error.json'), true)['5'];
    header('Content-Type: application/json');
        echo json_encode($error);
        exit();
      }
  }

if ($_SERVER["REQUEST_METHOD"] == "GET") {

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS- Admin Login Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="background-img">
    <header>
      <nav>
        <img class="logo" src="images/logo/App Logo2.png" alt="company-logo">
      </nav>
    </header>
    <div class="alert">
      <ion-icon class="error-icon" name="alert-circle-outline"></ion-icon>
      <ion-icon class="close-btn" name="close-outline"></ion-icon>
      <div class="msg-box">
        <h1 class="red-head">Oh snap!</h1>
        <p class="messagefromphp">Your email id doesn't exist</p>
      </div>
    </div>

    <section class="container">
      <div class="text-box">
        <h3>Welcome</h3>
        <p class="subhead">Login to continue</p>
        <form class="login-form admin-form">
          <input class="input" type="text" name="username" placeholder="Username / Mail / Mobile" required>
          <div class="pass-pack">
            <input class="input i-password" type="password" name="userpassword" placeholder="Password" required>
            <ion-icon class="show i-btn" name="eye-outline"></ion-icon>
            <ion-icon class="hide i-btn" name="eye-off-outline"></ion-icon>
          </div>
          <button class="btn login-btn" type="submit">Login</button>
        </form>
      </div>

      <div class="img-box">
        <img class="container-img margin-top" src="images/Login/undraw_art_museum_8or4.png" alt="Apartment-image">
      </div>
    </section>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
    $('.show').click(function() {
      $('.i-password').attr('type', 'text');
      $('.hide').css('display', 'block');
      $('.show').css('display', 'none');
    })

    $('.hide').click(function() {
      $('.i-password').attr('type', 'password');
      $('.show').css('display', 'block');
      $('.hide').css('display', 'none');
    })

    $('.close-btn').click(function() {
      $('.alert').css('display', 'none');
    })

    function toLogin() {
      $('.text-box2').css('display', 'none');
      $('.text-box1').css('display', 'block');
    }

    function toSignup() {
      $('.text-box1').css('display', 'none');
      $('.text-box2').css('display', 'block');
    }

    function notification(data1, data2, data3,data4,data5) {
      $('.alert').css('display', 'inline-block');
      $('.alert').css('background-color', data1);
      $('.alert').css('color', data2);
      $('.ion-icon').css('color', data2);
      $('.messagefromphp').text(data4);
      $('.red-head').text(data5);

      if (data3 == 'error-icon'){
        $('.error-icon').css('display', 'block');
      }

    }

    $(document).ready(function () {
  $('.login-form').submit(function (e) {
    e.preventDefault();

    $.ajax({
      type: "POST",
      url: "admin.php",
      dataType: 'json',
      data: $('.login-form').serialize(),
      success: function (response) {
        console.log(response.backgroundcolor);
        if (response == true){
          window.location.href = "admin-homepage.php";
        }
        else {
          let backgroundClr = response.backgroundcolor;
          let textClr = response.textColor;
          let icon = response.icon;
          let errortitle = response.errortitle;
          let errormsg = response.errorMsg;

          notification(backgroundClr, textClr, icon, errormsg, errortitle);
        }
      },
      error: function (xhr, status, error, response) {
        console.log(response);
        console.error('AJAX Error:', error, status);
      }
    })
  })
})

  </script>
</body>
<?php
}
$con->close();
?>

</html>