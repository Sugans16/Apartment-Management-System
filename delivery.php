<?php 

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["user"])) { 
  $user_cookie = $_COOKIE['user'] ?? "";

include('db_connection.php');


$sql = "SELECT block_no, flat_no FROM users WHERE username = '$user_cookie'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
      $block_no = $row["block_no"];
      $flat_no = $row["flat_no"];
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Delivery Details</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
</head>
<body>
  <div class="backgroundimg-home">
    <header>
      <nav class="home-nav">
        <a href="user-homepage.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>
    <section class="choice-container choice-containerz">
        <form action='delivery_status.php' method='post' class="parent">
        <div class="child-item pass-item">
                <label for="name" class="img-text">Receipt name:</label>
                <input type="text" name="name" class="place_holder_fix"  placeholder="Reciver_name" required>
                </div>
                <div class="child-item display-none">
                <input type="hidden" value=" <?php echo $block_no ?>" name="block_no" required>
                </div>
                <div class="child-item display-none">
                <input type="hidden" value=" <?php echo $flat_no ?>" name="flat_no" required>
                </div>
                <div class="child-item pass-item pass-text">
                <label for="delivery_date" class="img-text">Delivery date:</label>
                <input type="date" name="delivery_date" required>
                </div>
                <div class="child-item pass-item">
                <label for="delivery_type" class="img-text">Delivery Type</label>
                <select name="delivery_type"  class="registration-input option">
                <option class="option" value="" disabled selected>Select type</option>
                <option value="Courier">Courier</option>
                <option value="Hand Delivery">Ecom Delivery</option>
                <option value="Post Delivery">Post Delivery</option>
                </select>
                </div>
                <div class="child-item pass-item">
                <label for="mode_of_delivery" class="img-text">Mode of Delivery</label>
                <select name="delivery_mode"  class="registration-input option">
                <option class="option" value="" disabled selected>Select type</option>
                <option value="Home_Delivery">Home Delivery</option>
                <option value="Curbside_Pickup">Curbside Pickup</option>
                </select>
                </div>
                <div class="child-item pass-item">
                <label for="time_to_deliver" class="img-text">Time to Deliver</label>
                <select name="time_to_deliver"  class="registration-input option">
                <option class="option" value="" disabled selected>Select slot</option>
                <option value="9am_to_12pm">9am to 12pm</option>
                <option value="12pm_to_4pm">12pm to 4pm</option>
                <option value="4pm_to_8pm">4pm to 8pm</option>
                <option value="8pm_to_12am">8pm to 12am</option>
                </select>
                </div>
                <div class="child-item mt">
                <input type="submit" value="Submit" class="genrator">
                </div>
        </form>
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
  </script>
  <script>
    $(document).ready(function () {
        // Handle form submission
        // $('form').submit(function (event) {
        //     // Prevent the default form submission
        //     event.preventDefault();

        //     // Get the form data
        //     var formData = $(this).serialize();

        //     // Append the existing GET parameters to the form data
        //     var currentUrl = window.location.href

        //     // If there are existing GET parameters, append "&" to the URL
        //     var separator = currentUrl.indexOf('?') === -1 ? '?' : '&';
        //     // Append the existing GET parameters to the form data
        //     var urlWithParameters = currentUrl + separator + formData;
        //     // Redirect to the URL with GET parameters
        //     window.location.href = urlWithParameters;
        // });
    });
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