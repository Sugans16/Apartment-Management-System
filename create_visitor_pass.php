<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["user"])) {
  
  $user_cookie = $_COOKIE['user'] ?? "";
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "ams";

  $con = new mysqli($hostname, $username, $password, $database);

  if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
  }

  $query = "SELECT * FROM users WHERE BINARY username = '$user_cookie' OR BINARY email = '$user_cookie' OR BINARY `contact` = '$user_cookie'";

  $result = $con->query($query);

  if ($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    $block_no = $row['block_no'];
    $flat_no = $row['flat_no'];
    $name = $row['username'];

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
        <a href="user-homepage.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>
    <form id="user-passform" action="user_vp_qr_genarating.php" method="post" enctype="multipart/form-data">
      <div>
      <div id="head-pack">
        <div class="heading-item">
      <label class="head-label">Choose Pass Type</label>
      <select class="pass_type" name="pass_type" required>
        <option value=""selected disabled>Select</option>
        <option value="Visitor pass">Visitor pass</option>
        <option value="Regular pass">Regular pass</option>
      </select>
      </div>
      </div>
      
    </div>
  <section class=pass-container>
    <div class="credit-card">
      
        <div class="pass-item">
          <label for="visitor_name" class="pass-text">Name:</label>
          <input type="text" name="visitor_name"  required>
        </div>
        <div class="pass-item">
          <label for="visitor_contact" class="pass-text">Contact:</label>
          <input type="text" name="visitor_contact"  required>
        </div>
        <div class="pass-item display-none">
          <input type="hidden" value=" <?php echo $block_no ?>" name="block_no" required>
        </div>
        <div class="pass-item display-none">
          <input type="hidden" value=" <?php echo $name ?>" name="name" required>
        </div>
        <div class="pass-item display-none">
          <input type="hidden" value=" <?php echo $flat_no ?>" name="flat_no" required>
        </div>
        <div class="pass-item">
        <label class="pass-text">Gender</label>
        <select name="visitor_gender" class="form-select" required>
            <option disabled selected>SELECT</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Not Specified">Prefer not to say</option>
          </select>
        </div>
        <div class="pass-item">
          <label class="pass-text">Age</label>
          <input type="number" name="visitor_age" required>
        </div>
    
      <div class="pass-item">
         <label class="pass-text">No.of Visitor</label>
          <input class="pass-visi-count" type="number" min="1" name="visitor_count" required>
      </div>
      <div class="pass-item">
         <label class="pass-text">Visiting Time</label>
          <select name="visiting_time">
            <option value="" selected disabled>Select</option>
            <option value="morning">Morning</option>
            <option value="afternoon">Afternoon</option>
            <option value="night">Evening-Night</option>
            <option value="no-timing">No-timing</option>
          </select>
       </div>
      
        <div class="pass-item">
          <label for="From_Date" class="pass-text">From Date:</label>
          <input  type="date" name="from_date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo  date('Y-m-d', strtotime(date("Y-m-d") . ' +1 year')); ?>" required>
        </div>
        <div class="pass-item">
          <label for="To_Date" class="pass-text ">To Date:</label>
          <input  type="date" name="to_date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo  date('Y-m-d', strtotime(date("Y-m-d") . ' +1 year')); ?>"  required>
        </div>
        <div class="pass-item">
          <label  class="pass-text ">ID proof:</label>
          <label for="file-input" class="custom-file-name">Upload Proof</label>
          <!-- <input id="file-input" name="visitor_proof" class="no-border no-fs choose-file" type="file"   required> -->
          <input type="file" name="visitor_proof" class="no-border no-fs choose-file" id="file-input" accept="image/*" required>
        </div>
        <div class="child-last">
          <button type="submit" class="genrator">Generate</button>
        </div>
   
      
    </div>
  </section>
</form>
    <div class="qr-code-box">
    <div class="qr-code" id="qrcode-canvas" width="400" height="400">
    </div>
    <button class="download-btn" id="download-qr-button"  onclick="downloadQRCode()">Download QR Code <ion-icon name="download"></ion-icon></button>
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

      var idNum = "";

      $(document).ready(function () {
    var form = $('#user-passform');
    var qrCodeContainer = $('.qr-code-box');

    $('#user-passform').submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'user_vp_qr_genarating.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
              alert(data.slice(-4));
              console.log(data);
              idNum = data.slice(-4);
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


      function downloadQRCode() {
        var canvas = document.querySelector("#qrcode-canvas canvas");
        var ctx = canvas.getContext("2d");
        // Flip the QR code horizontally on the canvas
        ctx.scale(-1, 1);
        ctx.drawImage(canvas, -canvas.width, 0);
        // Create an anchor element to trigger download
        var link = document.createElement("a");
        // Convert the flipped canvas to a data URL
        link.download = `Visitor ${idNum} Pass.png`;
        link.href = canvas.toDataURL("image/png");
        var qr_code = canvas.toDataURL("image/png");
       
        link.click();
}

    </script>

</body>

</html>