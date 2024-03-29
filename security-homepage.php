<?php
include("db_connection.php");

  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["security"])) { 
    $user_cookie = $_COOKIE['security'] ?? "";

    $query = "SELECT * FROM ams_security WHERE security_id = '$user_cookie' " ; 

    $result = $con->query($query);

    $row = $result->fetch_assoc();

    $s_name = $row['f_name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Security Home Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <!--------------------------------------------------- Google fonts link ---------------------------------------------------->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
</head>

<body>
  <div class="backgroundimg-home">
    <!------------------------------------------------------ navibar --------------------------------------------------------------->
    <header>
      <nav class="home-nav">
        <a href="security-homepage.php"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
        <h1 class="welcome-msg">Hello <span class="user-name"><?php echo $s_name ?></span></h1>
        <a class="nav-link" href="#">
          <img class="profile-icon" src="images/logo/User-profile-logo.png" alt="3d-user-icon">
          <div class="nav-hover">
            <a class="list-link" href="profile_page.php">
              <ion-icon class="user-profile-nav" name="person"></ion-icon>
              <span>Profile</span>
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </a>
            <a class="list-link flex-child-normal" href="complaint.php">
            
            <img class="resize black-icon" src="images/icon/icon.ico" alt="user-complaint-icon">
            <span>Complaint</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </a>
            <a class="list-link" href="logout.php?action=security_logout">
              <ion-icon name="log-out-outline"></ion-icon>
              <span>Logout</span>
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </a>
          </div>
        </a>
      </nav>
    </header>

    <!---------------------------------------------------- main container----------------------------------------------------------->
    <section class="choice-container two-child-hight">
      <div class="child-item">
        <a class="img-link flex-child" href="security-delivery.php">
          <img class="img-child" src="images/4 div/Delivery.jpg" alt="deliveryboy-AI-img">
          <span class="img-text">Deliveries</span>
        </a>
      </div>
      <div class="child-item">
        <a class="img-link flex-child" href="scanner.html">
          <img class="img-child" src="images/4 div/Guest.jpg" alt="family-AI-img">
          <span class="img-text">Visitor's</span>
        </a>
      </div>

      <div class="child-item">
        <a class="img-link flex-child" href="security_visitor_pass.php">
          <img class="img-child" src="images/4 div/Security2.jpg" alt="security-AI-img">
          <span class="img-text">Secutrity Pass</span>
        </a>
      </div>

      <div class="child-item">
        <a class="img-link" href="webcam.php">
          <img class="img-child" src="images/4 div/CCTV.jpg" alt="family-AI-img">
          <span class="img-text">Surveillance Room</span>
        </a>
      </div>


    </section>
  </div>
  <!-------------------------------------------------- ion icon cdn link ----------------------------------------------------------->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-------------------------------------------------- jquery cdn link ----------------------------------------------------------->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

  <!-------------------------------------------------- JS Jquery code ----------------------------------------------------------->
  <script>
    $('.close-btn-home').click(function () {
      $('.flat-alert').slideToggle();
    })
    //////// For nav profile /////////////
    $('.nav-link').click(function () {
      $('.nav-hover').slideToggle();
    })
  </script>
</body>

</html>

<?php
  }
  elseif (!isset($_COOKIE["security"])) {
    header("location:security.php");
    exit();
  }
?>