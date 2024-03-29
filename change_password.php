<?php
  include('db_connection.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["admin"]) ){
      $user_cookie = $_COOKIE['admin'] ?? ""; 
      $sql = "SELECT a_password FROM ams_admin WHERE a_username = '$user_cookie' OR a_email = '$user_cookie' OR a_fname = '$user_cookie' OR a_mobile_no = '$user_cookie'";
      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_password = $row["a_password"] ?? "";

    
        $old_Password = $_POST["old_password"];
        $new_Password = $_POST["new_password"];
        $confirm_Password = $_POST["confirm_password"];

        if ($current_password === $old_Password){
          if ($new_Password === $confirm_Password){
            $sql = "UPDATE ams_admin SET a_password = '$new_Password' WHERE a_username = '$user_cookie' OR a_email = '$user_cookie' OR a_fname = '$user_cookie' OR a_mobile_no = '$user_cookie'";
            $con->query($sql);
            $output=true;
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
          }else {
            $output=false;
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
          }

        }else {
          $output="Wrong";
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
        }
      }
  }elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["user"])){
  $user_cookie = $_COOKIE['user'] ?? "";
  $home = "user-homepage.php";
  $sql = "SELECT `password` FROM users WHERE username = '$user_cookie' OR email = '$user_cookie' OR first_name = '$user_cookie' OR contact = '$user_cookie'";
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_password = $row["password"] ?? "";


    $old_Password = $_POST["old_password"];
    $new_Password = $_POST["new_password"];
    $confirm_Password = $_POST["confirm_password"];

    if ($current_password === $old_Password){
      if ($new_Password === $confirm_Password){
        $sql = "UPDATE users SET `password` = '$new_Password' WHERE username = '$user_cookie' OR email = '$user_cookie' OR first_name = '$user_cookie' OR contact = '$user_cookie'";
        $con->query($sql);
        $output=True;
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
      }else {
        $output=false;
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
      }

    }else {
      $output="Wrong";
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
    }
  }
  }elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["maintenance"])){
    $user_cookie = $_COOKIE['maintenance'] ?? "";
    $home = "maintenance-homepage.php";
    $sql = "SELECT `m_password` FROM ams_maintenance WHERE maintenance_id = '$user_cookie'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $current_password = $row["m_password"] ?? "";
  
  
      $old_Password = $_POST["old_password"];
      $new_Password = $_POST["new_password"];
      $confirm_Password = $_POST["confirm_password"];
  
      if ($current_password === $old_Password){
        if ($new_Password === $confirm_Password){
          $sql = "UPDATE ams_maintenance SET `m_password` = '$new_Password' WHERE maintenance_id = '$user_cookie' ";
          $con->query($sql);
          $output=True;
          header('Content-Type: application/json');
          echo json_encode($output);
          exit();
        }else {
          $output=false;
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
        }
  
      }else {
        $output="Wrong";
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
      }
    }
    }elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["security"])){
      $user_cookie = $_COOKIE['security'] ?? "";
      $home = "security-homepage.php";
      $sql = "SELECT `s_password` FROM ams_security WHERE security_id = '$user_cookie'";
      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_password = $row["s_password"] ?? "";
    
    
        $old_Password = $_POST["old_password"];
        $new_Password = $_POST["new_password"];
        $confirm_Password = $_POST["confirm_password"];
    
        if ($current_password === $old_Password){
          if ($new_Password === $confirm_Password){
            $sql = "UPDATE ams_security SET `s_password` = '$new_Password' WHERE security_id = '$user_cookie' ";
            $con->query($sql);
            $output=True;
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
          }else {
            $output=false;
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
          }
    
        }else {
            $output="Wrong";
            header('Content-Type: application/json');
            echo json_encode($output);
            exit();
        }
      }
      }
      $con->close();
  if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if (isset($_COOKIE["admin"])){
      $home = "admin-homepage.php";
      $title = "ADMIN CHANGE PASSWORD";
    }
    else if (isset($_COOKIE["user"])){
      $home = "user-homepage.php";
      $title = "USER CHANGE PASSWORD";
    }else if (isset($_COOKIE["maintenance"])){
      $home = "maintenance-homepage.php";
      $title = "MAINTENANCE CHANGE PASSWORD";
    } else if (isset($_COOKIE["security"])){
      $home = "security-homepage.php";
      $title = "SECURITY CHANGE PASSWORD";
    }
  } else {
    header("Location: admin.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="update.css">
</head>
<body>
  <div class="backgroundimg-home">
    <header>
      <nav>
        <a href="<?php echo $home; ?>"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>

    <div class="alert">
      <ion-icon class="login-icon ion-icon" name="checkmark"></ion-icon>
      <ion-icon class="error-icon ion-icon" name="alert-circle-outline"></ion-icon>
      <ion-icon class="close-btn ion-icon" name="close-outline"></ion-icon>
      <div class="msg-box">
        <h1 class="red-head">Oh snap!</h1>
        <p class="messagefromphp">Your email id doesn't exist</p>
      </div>
  </div>

    <main class="container-update-form">
      <div class="gird-container">
        <div class="left-column">
          <img src="images/Profile-page/2150793955 copy.jpg" alt="Ai-man-with-dog">
        </div>
        <div class="right-column">
          <h2 for="title" class="register-label">Account Details</h2>
          <form class="input-group" action="change_password.php" method="post">
            <div class="input-child">
              <label for="old_password">Old Password</label>
              <div class="pass-pack">
              <input class="input i-password old_pass" type="password" name="old_password" required>
              <ion-icon class="show i-btn show_old" name="eye-outline"></ion-icon>
              <ion-icon class="hide i-btn hide_old" name="eye-off-outline"></ion-icon>
            </div>
            </div>
            <div class="input-child">
              <label for="new_password">New Password</label>
              <div class="pass-pack">
              <input class="input i-password new_pass" type="password" name="new_password" required>
              <ion-icon class="show i-btn show_new" name="eye-outline"></ion-icon>
              <ion-icon class="hide i-btn hide_new" name="eye-off-outline"></ion-icon>
            </div>
            </div>
            <div class="input-child">
              <label for="confirm_password">Confirm Password</label>
              <div class="pass-pack">
              <input class="input i-password conf_pass" type="password" name="confirm_password" required>
              <ion-icon class="show i-btn show_conf" name="eye-outline"></ion-icon>
              <ion-icon class="hide i-btn hide_conf" name="eye-off-outline"></ion-icon>
            </div>
            </div>
            <div class="submitbtn">
              <input type="submit" id="submit" name="submit" onsubmit="validateForm()">
            </div>
          </form>
        </div>
    </main>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous">
  </script>
  <script>

   //////////////Password eye icon function///////////
   $('.show_old').click(function () {
      $('.old_pass').attr('type', 'text');
      $('.hide_old').css('display', 'block');
      $('.show_old').css('display', 'none');
    });

    $('.show_new').click(function () {
      $('.new_pass').attr('type', 'text');
      $('.hide_new').css('display', 'block');
      $('.show_new').css('display', 'none');
    });
    
    $('.show_conf').click(function () {
      $('.conf_pass').attr('type', 'text');
      $('.hide_conf').css('display', 'block');
      $('.show_conf').css('display', 'none');
    });
    

    $('.hide_old').click(function () {
      $('.old_pass').attr('type', 'password');
      $('.hide_old').css('display', 'none');
      $('.show_old').css('display', 'block');
    });

    $('.hide_new').click(function () {
      $('.new_pass').attr('type', 'password');
      $('.hide_new').css('display', 'none');
      $('.show_new').css('display', 'block');
    });

    $('.hide_conf').click(function () {
      $('.conf_pass').attr('type', 'password');
      $('.hide_conf').css('display', 'none');
      $('.show_conf').css('display', 'block');
    });

     /////////Alert from ajax for sucess and fail//////////

     function notification(data1, data2, data3,data4,data5) {
      $('.alert').css('display', 'inline-block');
      $('.alert').css('background-color', data1);
      $('.alert').css('color', data2);
      $('.ion-icon').css('color', data2);
      $('.messagefromphp').text(data4);
      $('.red-head').text(data5);

      let symbol = data3;
      console.log(data1, data2, data3,data4,data5);
      switch (symbol) { 
	      case 'login-icon': 
		    $('.login-icon').css('display', 'inline-block');
        $('.error-icon').css('display', 'none');  
		    break;
	      case 'error-icon': 
		      $('.error-icon').css('display', 'inline-block');
          $('.login-icon').css('display', 'none');
          break;
	      default:
            $('.login-icon').css('display', 'inline-block');
          }
    }

    $(document).ready(function () {
      $('.input-group').submit(function (e) {
        e.preventDefault();
   
    $.ajax({
      type: 'POST',
          url: 'change_password.php',
          data: $('.input-group').serialize(),
          dataType: 'json',
      success: function(response) {
        console.log(response);
        if(response === true){
            let backgroundClr = '#DEF0D8';
            let textClr = '#3A7B50';
            let icon = 'login-icon';
            let errortitle = "Great";
            let errormsg = "Password Updated Successfully" ;

            notification(backgroundClr,textClr,icon,errormsg,errortitle);
        } else if(response === false){
            let backgroundClr = '#FFF5E7';
            let textClr = '#B26000';
            let icon = 'error-icon';
            let errortitle = "You sure!";
            let errormsg =  "Sorry New and Confirm Password Doesn't Match";

            notification(backgroundClr,textClr,icon,errormsg,errortitle);
        } else if(response === "Wrong"){
            let backgroundClr = '#FFF5E7';
            let textClr = '#B26000';
            let icon = 'error-icon';
            let errortitle = "You sure!";
            let errormsg = "old Password Doesn't Match Current Password";

            notification(backgroundClr,textClr,icon,errormsg,errortitle);
        }
      }
    });
  })
  });
</script>
</body>
</html>