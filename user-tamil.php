<?php
  include_once 'db_connection.php';
  

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['userpassword'];

    $query = "SELECT * FROM users WHERE (BINARY username = '$user' OR BINARY `email` = '$user' OR BINARY `contact` = '$user') AND BINARY `password` = '$pass'";
    
    try{
      $result = $con->query($query);
    } catch(mysqli_sql_exception) {
      $error = json_decode(file_get_contents('error.json'), true)['tamil4'];
        header('Content-Type: application/json');
        echo json_encode($error);
        exit();
    }

    if ($result->num_rows >= 1) {
      $row = $result->fetch_assoc();
      $t_cookie = $row['first_name'] ?? $user;
      setcookie("user", $user);
      $output=true;
      header('Content-Type: application/json');
      echo json_encode($output);
     exit();
    }
    else
    {
      $query = "SELECT * FROM user_signup WHERE BINARY username = '$user' AND BINARY u_password = '$pass'";
      try{
        $result = $con->query($query);
      } catch(mysqli_sql_exception) {

        $error = json_decode(file_get_contents('error.json'), true)['tamil4'];
        header('Content-Type: application/json');
        echo json_encode($error);
        exit();
      }
      

      if ($result->num_rows >= 1) {
        $row = $result->fetch_assoc();
        $status = $row['status'] ?? null;

        if ($status == "Rejected") {

          $error = json_decode(file_get_contents('error.json'), true)['tamil1'];
          header('Content-Type: application/json');
          echo json_encode($error);
          exit();

        } else if ($status == "Pending") {

          $error = json_decode(file_get_contents('error.json'), true)['tamil2'];
          header('Content-Type: application/json');
          echo json_encode($error);
          exit();

        }
      } else {

        $error = json_decode(file_get_contents('error.json'), true)['tamil3'];
        header('Content-Type: application/json');
        echo json_encode($error);
        exit();
        
      }

    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS- User Login Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="background-img">
    <header class="login-header">
      <nav>
        <img class="logo" src="images/logo/App Logo2.png" alt="company-logo">
      </nav>
    </header>
    <div class="alert-tamil">
      <ion-icon class="start-icon ion-icon" name="time-outline"></ion-icon>
      <ion-icon class="reject-icon ion-icon" name="close-circle-outline"></ion-icon>
      <ion-icon class="wait-icon ion-icon" name="hourglass-outline"></ion-icon>
      <ion-icon class="login-icon ion-icon" name="checkmark"></ion-icon>
      <ion-icon class="error-icon ion-icon" name="alert-circle-outline"></ion-icon>
      <ion-icon class="close-btn ion-icon" name="close-outline"></ion-icon>
      <div class="msg-box">
        <h1 class="red-head">Oh snap!</h1>
        <p class="messagefromphp">Your email id doesn't exist</p>
      </div>
    </div>
    <section class="container">
      <div class="form-box">
        <div class="text-box text-box1">
          <h3>Welcome</h3>
          <p class="subhead">Login to continue</p>
          <form class="login-form" id="login-form">
            <input class="input" type="text" name="username" placeholder="Username / email" required>
            <div class="pass-pack">
              <input class="input i-password" type="password" name="userpassword" placeholder="Password" required>
              <ion-icon class="show i-btn" name="eye-outline"></ion-icon>
              <ion-icon class="hide i-btn" name="eye-off-outline"></ion-icon>
            </div>
            <div class="btn-pack">
              <button class="btn login-btn" type="submit">Login</button>
              <button class="btn btn--2" type="button" onclick="toSignup()">Signup</button>
            </div>
          </form>
        </div>
        <div class="text-box text-box2">
          <h3>Welcome</h3>
          <p class="subhead">Signup to continue</p>
          <form class="login-form signup-form"  id="signup-form">
            <input class="input uppercase" type="text" name="flat-no" placeholder="Flat no" required>
            <input class="input uppercase" type="text" name="block-no" placeholder="Block no" required>
            <input class="input" type="text" id="username" name="susername" placeholder="Username" required>
            <div class="pass-pack">
              <input class="input i-password" id="userpassword" type="password" name="suserpassword" placeholder="Password" required>
              <ion-icon class="show i-btn" name="eye-outline"></ion-icon>
              <ion-icon class="hide i-btn" name="eye-off-outline"></ion-icon>
            </div>
            <div class="btn-pack">
              <button class="btn signup-btn" type="submit">Signup</button>
              <button class="btn btn--2" type="button" onclick="toLogin()">Login</button>
            </div>
          </form>
        </div>
      </div>
      <div class="img-box">
        <img class="container-img" src="images/Login/undraw_Coming_home_re_ausc.png" alt="Apartment-image">
      </div>
    </section>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
    $('.show').click(function () {
      $('.i-password').attr('type', 'text');
      $('.hide').css('display', 'block');
      $('.show').css('display', 'none');
    })

    $('.hide').click(function () {
      $('.i-password').attr('type', 'password');
      $('.show').css('display', 'block');
      $('.hide').css('display', 'none');
    })

    $('.close-btn').click(function () {
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

      let symbol = data3;
      console.log(data3);
switch (symbol) { 
	case 'login-icon': 
		$('.login-icon').css('display', 'block');
    $('.error-icon').css('display', 'none');
    $('.wait-icon').css('display', 'none');
    $('.reject-icon').css('display', 'none');
    $('.start-icon').css('display', 'none');
		break;
	case 'error-icon': 
		$('.error-icon').css('display', 'block');
    $('.login-icon').css('display', 'none');
    $('.wait-icon').css('display', 'none');
    $('.reject-icon').css('display', 'none');
    $('.start-icon').css('display', 'none');
		break;
	case 'wait-icon': 
		$('.wait-icon').css('display', 'block');
    $('.error-icon').css('display', 'none');
    $('.login-icon').css('display', 'none');
    $('.reject-icon').css('display', 'none');
    $('.start-icon').css('display', 'none');
		break;
  case 'reject-icon': 
		$('.reject-icon').css('display', 'block');
    $('.error-icon').css('display', 'none');
    $('.login-icon').css('display', 'none');
    $('.wait-icon').css('display', 'none');
    $('.start-icon').css('display', 'none');
		break;
  case 'start-icon': 
		$('.start-icon').css('display', 'block');
    $('.error-icon').css('display', 'none');
    $('.login-icon').css('display', 'none');
    $('.wait-icon').css('display', 'none');
    $('.reject-icon').css('display', 'none');
		break;   		
	default:
  $('.error-icon').css('display', 'block');
}
    }


    ////// Signup-submission /////////
    $(document).ready(function () {
      $('#signup-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "sign_up_tamil.php",
          dataType: 'json',
          contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
          data: $('#signup-form').serialize(),
          success: function (response) {

            let backgroundClr = response.backgroundColor;
            let textClr = response.textColor;
            let icon = response.icon;
            let errortitle = response.errortitle;
            let errormsg = response.errorMsg;

            notification(backgroundClr,textClr,icon,errormsg,errortitle);

          },
          error: function (xhr, status, error) {
            console.error('AJAX Error:',error, status);
          }
        })
      })
    })

     ////// Login-submission /////////
     $(document).ready(function () {
      $('#login-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "user-tamil.php",
          dataType: 'json',
          data: $('#login-form').serialize(),
          success: function (response) {
            console.log(response.backgroundColor);
            if (response == true) {
              window.location.href = "user-homepage.php";
           } else {
            let backgroundClr = response.backgroundColor;
            let textClr = response.textColor;
            let icon = response.icon;
            let errortitle = response.errortitle;
            let errormsg = response.errorMsg;

   notification(backgroundClr, textClr, icon, errormsg, errortitle);
}
            
          },
          error: function (xhr, status, error, response) {
            console.log(response);
            console.error('AJAX Error:',error, status);
          }
        })
      })
    })
    /////// For upper case /////////////
    $(document).ready(function () {
      $('.uppercase').on('input', function () {
        $(this).val($(this).val().toUpperCase());
      });
    })

  
  </script>
</body>

</html>