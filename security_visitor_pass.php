

<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["security"])) {
  
  $user_cookie = $_COOKIE['security'] ?? "";
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "ams";

  $con = new mysqli($hostname, $username, $password, $database);

  if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
  }

  $query = "SELECT * FROM ams_security WHERE BINARY `security_id` = '$user_cookie'";

  $result = $con->query($query);

  if ($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    $name = $row['f_name'];

  }
  
}
else if (!isset($_COOKIE["user"])){
  header("Location: user.php");
  exit();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Visitor pass page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="style-registration.css">
  
</head>

<body>
  <div class="card-background-img">
    <header>
      <nav>
        <a href="user.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>
    <div>
<div id="head-pack">
  <div class="heading-item">
<label class="head-label"name="security_pass">Security pass</label>
      </div>
</div>
      
    </div>
    <section class="pass-container security-pass-container">
      <form class="credit-card">
      
        <div class="pass-item">
          <label for="visitor_name" class="pass-text">Name:</label>
          <input type="text" name="visitor_name"  required>
        </div>
        <div class="pass-item">
          <label for="visitor_contact" class="pass-text">Contact:</label>
          <input type="text" name="visitor_contact"  required>
        </div>
        <div class="pass-item">
        <label class="pass-text">Block No:</label>
          <input type="text"  name="block_no" required>
        </div>
        <div class="pass-item display-none">
          <input type="hidden" value=" <?php echo $name ?>" name="name" required>
        </div>
        <div class="pass-item">
        <label class="pass-text">Flat No:</label>
          <input type="text" name="flat_no" required>
        </div>
    
      <div class="pass-item">
         <label class="pass-text">No.of Visitor</label>
          <input class="pass-visi-count" type="text" name="visitor_count" required>
      </div>

        <div class="pass-item">
          <label  class="pass-text ">ID proof:</label>
          <label for="file-input" class="custom-file-name">Upload Proof</label>
          <input id="file-input" class="no-border no-fs choose-file" type="file" name="visitor_proof"  required>
        </div>
        
        <div class="child-last">
          <button type="submit" class="genrator">Generate</button>
        </div>
   
      
      </form>
    </section>
    <div class="qr-code-box">
    <div class="qr-code" id="qrcode-canvas" width="400" height="400">
    </div>
    <button class="download-btn" id="download-qr-button" onclick="downloadQRCode()">Download QR Code <ion-icon name="download"></ion-icon></button>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <script>
      //////// For colsing alert /////////////
      $('.close-btn-home').click(function () {
        $('.flat-alert').slideToggle();
      })
      //////// For nav profile /////////////
      $('.nav-link').click(function () {
        $('.nav-hover').slideToggle();
      })


      $('.choose-file').change(function() {
        let i =$(this).prev('label').clone();
        let file = $('.choose-file')[0].files[0].name;
        $(this).prev('label').text(file);
      })



      function downloadQRCode() {
        var canvas = document.querySelector("#qrcode-canvas canvas");
        var link = document.createElement("a");
        link.download = "visitor-pass.png";
        link.href = canvas.toDataURL("image/png");
        link.click();
}


      var idNum = "";

      $(document).ready(function () {
        var form = $('.pass-container');
        var qrCodeContainer = $('.qr-code-box');


        $('.credit-card').submit(function (e) {
          e.preventDefault();

          $.ajax({
            type: 'POST',
            url: 'visitor_pass_verification.php',
            data: $('.credit-card').serialize(),
            success: function (data) {
              idNum = data;
              alert(data);
              $("#qrcode-canvas").empty();
              form.hide();
              qrCodeContainer.show();
              const qrCode = new QRCodeStyling({
                "width":250,
                "height":250,
                "data":idNum,
                "margin":17,
                "qrOptions":{"typeNumber":"0","mode":"Byte","errorCorrectionLevel":"H"},
                "imageOptions":{"hideBackgroundDots":true,"imageSize":0.4,"margin":0},
                "dotsOptions":{"type":"extra-rounded","color":"#ef8d32"},
                "backgroundOptions":{"color":"#fff"},
                "image":"images/QR/Base QR-image.jpg",
                "dotsOptionsHelper":{"colorType":{"single":true,"gradient":false},
                "gradient":{"linear":true,"radial":false,"color1":"#6a1a4c","color2":"#6a1a4c","rotation":"0"}},
                "cornersSquareOptions":{"type":"extra-rounded","color":"#000000"},
                "cornersSquareOptionsHelper":{"colorType":{"single":true,"gradient":false},
                "gradient":{"linear":true,"radial":false,"color1":"#000000","color2":"#000000","rotation":"0"}},
                "cornersDotOptions":{"type":"","color":"#6998e8"},
                "cornersDotOptionsHelper":{"colorType":{"single":true,"gradient":false},
                "gradient":{"linear":true,"radial":false,"color1":"#000000","color2":"#000000","rotation":"0"}},
                "backgroundOptionsHelper":{"colorType":{"single":true,"gradient":false},
                "gradient":{"linear":true,"radial":false,"color1":"#ffffff","color2":"#ffffff","rotation":"0"}}
              });
              qrCode.append(document.getElementById("qrcode-canvas"));
            },
            error: function (xhr, error, status) {
              alert("Error generating QR code: " + error);
              console.error('AJAX Error:', error, status);
            }
          })
        })
      });

      

    </script>

</body>

</html>