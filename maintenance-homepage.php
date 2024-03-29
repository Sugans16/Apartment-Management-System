<?php
  include('db_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["maintenance"])) { 
    $user_cookie = $_COOKIE['maintenance'] ?? "";

    $query = "SELECT * FROM ams_maintenance WHERE maintenance_id = '$user_cookie' " ; 

    $result = $con->query($query);

    $row = $result->fetch_assoc();

    $m_name = $row['f_name'];
    $sub_role = $row['sub_role'];
   

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Maintenance Home Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="maintenance_name.js" ></script>
</head>

<body>
  <div class="backgroundimg-home">
    <!------------------------------------------------------ navibar --------------------------------------------------------------->
    <header>
      <nav class="home-nav">
        <a href="security.html"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
        <h1 class="welcome-msg">Hello <span class="user-name"><?php echo $m_name ?></span></h1>
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
            <a class="list-link" href="logout.php?action=maintenance_logout">
              <ion-icon name="log-out-outline"></ion-icon>
              <span>Logout</span>
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </a>
          </div>
        </a>
      </nav>
    </header>

    <!---------------------------------------------------- main container----------------------------------------------------------->
    <section class="choice-container">
      <div class="child-item del">
        <a class="img-link flex-child" href="maintain-received.php">
          <img class="img-child" src="images/4 div/Delivery.jpg" alt="deliveryboy-AI-img">
          <span class="img-text">Deliveries</span>
        </a>
      </div>
      <div class="child-item">
        <a class="img-link flex-child" href="maintain-work.php">
          <img class="img-child" src="images/4 div/main-maintain.jpg" alt="family-AI-img">
          <span class="img-text">Works</span>
        </a>
      </div>
      <div class="child-item child3">
        <a class="img-link flex-child" href="maintain-progress-work.php">
          <img class="img-child" src="images/4 div/maintenance.jpg" alt="family-AI-img">
          <span class="img-text">Progress Works</span>
        </a>
      </div>

    </section>
  </div>
  <!-------------------------------------------------- ion icon cdn link ----------------------------------------------------------->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-------------------------------------------------- jquery cdn link ----------------------------------------------------------->
  

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
 <script>
 window.addEventListener('unload', function () {
  
  window.location.reload();
});
     
    var Helper = "<?php echo $sub_role ?>";
    if (Helper == "Helper"){
      console.log(Helper);
      $('.del').css('display', 'block');
    } else {
      $('div').removeClass("child3");
    }
</script>
</body>

</html>
<?php
  }
  else {
    header("Location: maintenance.php");
    exit;
  }
?>