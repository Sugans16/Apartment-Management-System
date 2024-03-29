<?php include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])) { 
    $user_cookie = $_COOKIE['admin'] ?? "";
    $home = "admin-homepage.php";
    $title = "ADMIN";

    $query = "SELECT * FROM ams_admin WHERE BINARY a_username = '$user_cookie' OR BINARY `a_email` = '$user_cookie' OR BINARY `a_mobile_no` = '$user_cookie' OR BINARY `a_fname` = '$user_cookie'";

    $result = $con->query($query);

    $row = $result->fetch_assoc();

    $first_name = ucfirst($row['a_fname'] ?? '');
    $last_name = ucfirst($row['a_lname'] ?? '');
    $contact = $row['a_mobile_no'] ?? '';
    $email = $row['a_email'] ?? '';

}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["maintenance"])) { 
    $user_cookie = $_COOKIE['maintenance'] ?? "";
    $home = "maintenance-homepage.php";
    $title = "MAINTENANCE";

    $query = "SELECT * FROM ams_maintenance WHERE maintenance_id = '$user_cookie'";

    $result = $con->query($query);

    $row = $result->fetch_assoc();

    $first_name = ucfirst($row['f_name'] ?? '');
    $last_name = ucfirst($row['l_name'] ?? '');
    $contact = $row['mobile'] ?? '';
    $email = $row['email'] ?? '';
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["security"])) { 
  $user_cookie = $_COOKIE['security'] ?? "";
  $home = "security-homepage.php";
  $title = "SECURITY";

  $query = "SELECT * FROM ams_security WHERE security_id = '$user_cookie'";

  $result = $con->query($query);

  $row = $result->fetch_assoc();

  $first_name = ucfirst($row['f_name'] ?? '');
  $last_name = ucfirst($row['l_name'] ?? '');
  $contact = $row['mobile'] ?? '';
  $email = $row['email'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?php echo $title; ?> PROFILE UPDATE</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="update.css">
</head>

<body>
  <div class="backgroundimg-home">
  <header>
      <nav class="home-nav">
        <a href="<?php echo $home; ?>"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
        <h1 class="welcome-msg">Hello <span class="user-name"><?php echo ucfirst($first_name); ?></span></h1>
        <a class="nav-link">
          <img class="profile-icon" src="images/logo/User-profile-logo.png" alt="3d-user-icon"></a>
        <div class="nav-hover">
          <a class="list-link" href="change_password.php">
          <ion-icon name="key"></ion-icon>
            <span>Change Password</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </a>
         
        </div>

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
          <form id="profileUpdate" class="input-group">

            <div class="input-child">
              <label for="F-name">First Name</label>
              <input type="text" id="Fname" name="fname" value="<?php echo $first_name; ?>"/>
            </div>
            <div class="input-child">
              <label for="L-name">Last Name</label>
              <input type="text" id="Lname" name="lname" value="<?php echo $last_name; ?>"/>
            </div>
            <div class="input-child">
              <label for="email">Email</label>
              <input type="text" id="email" name="email" value="<?php echo $email; ?>"/>
            </div>
            <div class="input-child">
              <label for="phoneNO">Phone No</label>
              <input type="text" id="phoneNo" name="contact" value="<?php echo $contact; ?>"/>
            </div>
            
            <div class="input-child">
              <label for="password-confirm">Confirm Password</label>
              <div class="pass-pack">
                <input class="input i-password" type="password" name="password-confirm" required>
                <ion-icon class="show i-btn" name="eye-outline"></ion-icon>
                <ion-icon class="hide i-btn" name="eye-off-outline"></ion-icon>
              </div>
            </div>
            
            <div class="submitbtn">
              <input type="submit" id="submit" name="submit">
            </div>
          </form>
        </div>
    </main>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>

    //////////////Password eye icon function///////////
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
 
    //////// For nav profile /////////////
    $('.nav-link').click(function () {
      $('.nav-hover').slideToggle();
    })

    $('.close-btn').click(function () {
      $('.alert').css('display', 'none');
    })

    /////////Alert from ajax for sucess and fail//////////

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
		    $('.login-icon').css('display', 'inline-block');
        $('.error-icon').css('display', 'none');  
		    break;
	      case 'error-icon': 
		      $('.error-icon').css('display', 'block');
          $('.login-icon').css('display', 'none');
		    break;
	      default:
            $('.login-icon').css('display', 'block');
          }
    }

    /////// Ajax for form completion msg /////////

    $(document).ready(function () {
      $('#profileUpdate').submit(function (e) {
        e.preventDefault();

        $.ajax({
          type: 'POST',
          url: 'profile-update.php',
          data: $('#profileUpdate').serialize(),
          dataType: 'json',
          success: function (response) {
           
            $('.user-name').text(response.first_name);

            if(response.output) {
            let backgroundClr = '#DEF0D8';
            let textClr = '#3A7B50';
            let icon = 'login-icon';
            let errortitle = "Great";
            let errormsg = "Account Updated Successfully" ;

            notification(backgroundClr,textClr,icon,errormsg,errortitle);
          } else if (!response) {
            let backgroundClr = '#FFF5E7';
            let textClr = '#B26000';
            let icon = 'error-icon';
            let errortitle = "You sure!";
            let errormsg = "Password must be wrong";

            notification(backgroundClr,textClr,icon,errormsg,errortitle);
          }

          },
          error: function (response) {
            console.log(response);
            // console.error('AJAX Error:',error, status);
          }
        })
      })
    });

  </script>
</body>

</html>

