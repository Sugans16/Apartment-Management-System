<?php
include("db_connection.php");
  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["security"])) { 
    $user_cookie = $_COOKIE['security'] ?? "";

  }

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
  <link rel="stylesheet" href="request-table.css">
</head>
<body> 
<header>
  <nav>
    <a href="security-homepage.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
  </nav>
</header>
  <div class="backgroundimg-home">
    <div  style="display: flex; align-items: center; justify-content: space-around;">
      <div style="height: 400px; width: 500px;">
      <h1 class="list-head">Camera 1</h1>
        <iframe width="550" height="400" style="margin-top:10px;" src="https://www.youtube.com/embed/GSmCh4DrbWY?si=SmVBPoHSRC9S1BfJ&autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen" ></iframe>
      </div>
      <div style="height: 400px; width: 500px;">
      <h1 class="list-head">Camera 2</h1>
  <iframe width="550" height="400" style="margin-top:10px;" src="https://www.youtube.com/embed/4yLuA3bPkp4?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen" ></iframe>
      </div>
    </div>
  </div>
</body>
</html>
