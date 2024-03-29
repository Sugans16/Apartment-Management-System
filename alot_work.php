<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["user"])) { 
    $user_cookie = $_COOKIE['user'] ?? "";
    $t_cookie = $_COOKIE['tenant'] ?? "";
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Maintenance Work alot Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
</head>

<body>
  <div class="backgroundimg-home">
    <!------------------------------------------------------ navibar --------------------------------------------------------------->
    <header>
      <nav class="home-nav">
        <a href="user-homepage.php"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
        <h1 class="welcome-msg user_alotwork">Hello <span class="user-name"><?php echo ucfirst($t_cookie) ?></span></h1>
      </nav>
    </header>

    <!---------------------------------------------------- main container----------------------------------------------------------->
    
    <section class="choice-container choice-containerz two-child-hight">
            <!-- Create a form for user input -->
            <form action="total_work.php" method="POST">
                <!-- Hidden fields for ID, BlockNo, FlatNo, Username -->
                <?php
                include("db_connection.php");
                $sql = "SELECT * FROM `users` WHERE username = '$user_cookie' ";
                $result = $con->query($sql);

                while($row = $result->fetch_assoc()){
                $block_no = $row['block_no'];
                $flat_no = $row['flat_no'];
                $name = $row['username'];
                }
                ?>
                
                <input type="hidden" name="blockno" value=" <?php echo $block_no ?>"> <!-- Replace '2' with actual BlockNo -->
                <input type="hidden" name="flatno" value=" <?php echo $flat_no ?>"> <!-- Replace '3' with actual FlatNo -->
                <input type="hidden" name="name" value=" <?php echo $name ?>"> <!-- Replace 'user123' with actual Username -->
                    
                <!-- Fields to input worktype, work, date -->
                <label for="worktype" class="img-text">Work Type:</label>
                <select class="registration-input option " name="worktype" id="sub_role"><br><br>
                <option class="option" value="" disabled selected>Sub-role</option>
                <option class="option" value="Cleaner">Cleaning</option>
                <option class="option" value="Plumber">Plumbing</option>
                <option class="option" value="Electrician">Electrical Regarding</option>
                <option class="option" value="Gardner">Pestcontrol/Gardening</option>
                <option class="option" value="Carpenter">Carpenting</option>
                <option class="option" value="Mason">Civil works</option>
                <option class="option" value="Helper">Helper</option>
                <option class="option" value="Painter">Painting</option>
                </select><br><br>
                

                <label for="work" class="img-text">Work:</label>
                <input type="text" id="work" name="work" ><br><br>

                <label for="date" class="img-text">Date:</label>
                <input type="date" id="date" name="date"><br><br><br>

                <input type="submit" value="Submit" class="genrator">
            </form>
    
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
else {
  header ("Location: user-homepage.php");
}
?>