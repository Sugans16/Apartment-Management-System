<?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['m_password'];

    $hostname = "localhost";
    $usernamee = "root";
    $password = "";
    $database = "ams";
    $output = "";

    $con = new mysqli($hostname, $usernamee, $password, $database);

    $query = "SELECT * FROM ams_maintenance WHERE email = '$user' and m_password = '$pass' " ; 

    $result = $con->query($query);

    if ($result->num_rows >= 1) {
      $row = $result->fetch_assoc();
      $m_id = $row['maintenance_id'];
      setcookie("maintenance", $m_id);
      
      $output=true;
      echo $output;
      exit();
      
    } else {
      $output=false;
      echo $output;

  }

   
  } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS- Maintenance Login Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
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
        <form class="login-form" id="login-form" >
          <input class="input" type="text" id="username" name="username" placeholder="Username / email" required>
          <div class="pass-pack">
            <input class="input i-password" type="password" id="m_password" name="m_password" placeholder="Password" required>
            <ion-icon class="show i-btn" name="eye-outline"></ion-icon>
            <ion-icon class="hide i-btn" name="eye-off-outline"></ion-icon>
          </div>
          <button class="btn login-btn" type="submit">Login</button>
        </form>
      </div>
      <div class="img-box">
        <img class="container-img margin-top" src="images/Login/undraw_apartment_rent_o0ut.png" alt="Apartment-image">
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
    function notification(data) {
      $('.alert').css('display', 'inline-block');
      $('.messagefromphp').text(data);
    }


    $(document).ready(function () {
      $('#login-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "maintenance.php",
          data: $('#login-form').serialize(),
          success: function (response) {
            let output = response;
            if(output == true)
            {
              window.location.href="maintenance-homepage.php";
            }
            else if (output == false) {
              let error = "Sorry, please check your username and password";
              notification(error);
            } else {
              let error = "Sorry, please check your username and password";
              notification(error);
            }
            
          },
          error: function () {
            alert('error in ajax');
          }
        })
      })
    })


  </script>
</body>

</html>