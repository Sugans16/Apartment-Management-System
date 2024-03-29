<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["user"])) { 
    $user_cookie = $_COOKIE['user'] ?? "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-User Home Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
</head>

<body>
  <div class="backgroundimg-home">
    <header>
      <nav class="home-nav">
        <a href="user.php"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
        <h1 class="welcome-msg">Hello <span class="user-name"><?php echo ucfirst($user_cookie) ?></span></h1>
        <a class="nav-link">
          <img class="profile-icon" src="images/logo/User-profile-logo.png" alt="3d-user-icon"></a>
        <div class="nav-hover">
          <a class="list-link" href="user-profile-update.php">
            <ion-icon class="user-profile-nav" name="person"></ion-icon>
            <span>Profile</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </a>
          
          <a class="list-link flex-child-normal" href="complaint.php">
            <!-- <img class="resize orange-icon" src="images/icon/icon hover.png" alt="user-complaint-icon"> -->
            <img class="resize black-icon" src="images/icon/icon.ico" alt="user-complaint-icon">
            <span>Complaint</span>
            <ion-icon name="chevron-forward-outline"></ion-icon>
          </a>
          <a class="list-link" href="logout.php?action=residents_logout">
              <ion-icon name="log-out-outline"></ion-icon>
              <span>Logout</span>
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </a>
        </div>

      </nav>
    </header>

    <section class="choice-container">
      <div class="child-item">
        <a class="img-link flex-child" href="delivery.php">
          <img class="img-child" src="images/4 div/Delivery.jpg" alt="delivery-man-AI-img">
          <span class="img-text">Delivery</span>
        </a>
      </div>
      <div class="child-item">
        <a class="img-link flex-child" href="alot_work.php">
          <img class="img-child" src="images/4 div/maintenance2.jpg" alt="Worker-AI-img">
          <span class="img-text">Maintenance</span>
        </a>
      </div>
      <div class="child-item child3">
        <a class="img-link flex-child" href="create_visitor_pass.php">
          <img class="img-child" src="images/4 div/Visitor pass.jpg" alt="female-Admin-AI-img">
          <span class="img-text">Visitor Pass</span>
        </a>
      </div>
  </div>
  </section>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
    //////// For colsing alert /////////////
    $('.close-btn-home').click(function () {
      $('.flat-alert').slideToggle();
    })
    //////// For nav profile /////////////
    $('.nav-link').click(function () {
      $('.nav-hover').slideToggle();
    })

    // $('.flex-child-normal').hover(function () {
    //   $('.black-icon').css('display', 'none');
    //   $('.orange-icon').css('display', 'block');
    // })
    // $('.black-icon').css('display', 'block');
    // $('.orange-icon').css('display', 'none');
  </script>
</body>

</html>
<?php
  }
  else if (!isset($_COOKIE["user"])){
    header("Location: user.php");
    exit();
  }
?>