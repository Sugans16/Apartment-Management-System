<?php
  include("db_connection.php");


  $user = $_COOKIE['user'] ?? "";
  $t_cookie = $_COOKIE['tenant'] ?? "";

  $query = "SELECT * FROM users WHERE BINARY username = '$user' OR BINARY `email` = '$user' OR BINARY `contact` = '$user'";

  $result = $con->query($query);

  $row = $result->fetch_assoc();

  $first_name = ucfirst($row['first_name'] ?? '');
  $last_name = ucfirst($row['last_name'] ?? '');
  $contact = $row['contact'] ?? '';
  $no_of_persons = $row['number_of_persons'] ?? '';
  $email = $row['email'] ?? '';
  $disabled_person;
  if ($row['disabled_person'] > 0){
    $tab = "yes";
    $disabled_person = $row['disabled_person'];
  }
  else {
    $tab = "no";
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>USER PROFILE UPDATE</title>
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
        <a href="user-homepage.php"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
        <h1 class="welcome-msg"><span class="user-name">HELLO <?php echo strtoupper($t_cookie) ?></span></h1>
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

    <main class="container-update-form">
      <div class="gird-container">
        <div class="left-column">
          <img src="images/Profile-page/2150793955 copy.jpg" alt="Ai-man-with-dog">
        </div>

        <div class="right-column">
          <h2 for="title" class="register-label">Account Details</h2>
          <form class="input-group" action="profileupdate.php" method="post">
            <div class="input-child">
              <label for="F-name">First Name</label>
              <input type="text" id="Fname" name="fname"  value="<?php echo $first_name; ?>">
            </div>
            <div class="input-child">
              <label for="L-name">Last Name</label>
              <input type="text" id="Lname" name="lname" value="<?php echo $last_name; ?>">
            </div>
            <div class="input-child">
              <label for="email">Email</label>
              <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-child">
              <label for="phoneNO">Phone No</label>
              <input type="text" id="phoneNo" name="contact" value="<?php echo $contact; ?>">
            </div>
            <div class="input-child alter-child">
              <label for="totalnumberofpersons"> Number of persons in home</label>
              <input type="text" id="phoneNo" name="total_person" value="<?php echo $no_of_persons; ?>"> 
            </div>
            <div class=" input-child-disabled ">
                <label class="label-one" for="disabledPerson">Disabled person</label>
                <div class="choice-child">
                <div>
                  <input type="radio" class="radio-btn yes-btn" name="disabledPerson" id="disabledPersonyes" value="yes" <?php echo ($tab == 'yes') ? 'checked' : ''; ?>>
                  <label for="residence">YES</label>
                </div>
                <div>
                  <input class="radio-btn no-btn" type="radio" value="no" id="disabledPersonno" name="disabledPerson" value="no" <?php echo ($tab == 'no') ? 'checked' : ''; ?>>
                  <label for="disabledPerson">NO</label>
                </div>
                </div>
              

              <div class="disabledPerson--child">
                <label for="noofmembers">Number of Person</label>
                <input class="dp-sec-child" type="number" min="0" id="noofmembers" name="disabledPersoncount" value= <?php echo ($tab == 'yes') ? $disabled_person : 0; ?> >
              </div>
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
 
    //////// For nav profile /////////////
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

    $('.nav-link').click(function () {
      $('.nav-hover').slideToggle();
    })


    //////////For disabled Person ////////
    <?php if ($tab === "yes"): ?>
      $(document).ready(function () {
        $('.disabledPerson--child').css('display', 'flex');
        $('.dp-sec-child').removeAttr('disabled');
      });
      <?php endif; ?>
      
    $('.yes-btn').click(function () {
      $('.disabledPerson--child').css('display', 'flex');
      $('.dp-sec-child').removeAttr('disabled', 'false');
    })

    $('.no-btn').click(function () {
      $('.disabledPerson--child').css('display', 'none');

      $('.dp-sec-child').remove();
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