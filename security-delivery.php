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
  <title>AMS-Security Delivery</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="request-table.css">

</head>

<body>

<div class="backgroundimg-home">

<header>
  <nav>
    <img class="logo" src="images/logo/App Logo2.png" alt="company-logo">
  </nav>
</header>
<div>
 
    <h1 class="list-head"> Upcoming Deliveries </h1><br><br>
<a class="deliveryR" href="security-received.php">Received Deliveries <ion-icon name="chevron-forward-outline"></ion-icon></a>
      
      <table class="list-table">
        <thead>
          <tr>
            <th>Serial No</th>
            <th>Reciepient Name</th>
            <th>Block NO</th>
            <th>Flat NO</th>
            <th>Date of delivery</th>
            <th>Type of delivery</th>
            <th>Mode of delivery</th>
            <th>Slot</th>
            
            <th class="pd-remove">Action</th>
          </tr> 
        </thead>
        <tbody id="requestBody">
        <?php
              include('db_connection.php');

              $sql = "SELECT * from  ams_delivery where (pro_status = 'Pending' or pro_status = 'Door_closed') ";
              $result = $con->query($sql);
              $sno=1;
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["resident_name"] . "</td>";
                    echo "<td>" . $row["block_no"] . "</td>";
                    echo "<td>" . $row["flat_no"] . "</td>";                    
                    echo "<td>" . $row["delivery_date"] . "</td>";
                    echo "<td>" . $row["delivery_type"] . "</td>";
                    echo "<td>" . $row["mode_of_delivery"] . "</td>";
                    echo "<td>" . $row["slot"] . "</td>";
                    echo "<td>
    <select class='status-select' data-work-id='" . $row['id'] . "'>
        <option value='Pending'" . ($row['pro_status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
        <option value='Reached_ams'" . ($row['pro_status'] == 'Reached_ams' ? ' selected' : '') . ">Reached_ams</option>
        <option value='Reached_reciepient'" . ($row['pro_status'] == 'Reached_reciepient' ? ' selected' : '') . ">Reached_reciepient</option>
    </select>
    <button class='update-status-btn'>Submit</button>
</td>";
                    echo "</tr>";
                  }
              } else {
                  echo "<td colspan='10' style='text-align: center;'>NO Deliveries Assigned</td>";
              }
$con->close();
?>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
$(document).ready(function() {
  $(".update-status-btn").click(function() {
    var selectedValue = $(this).siblings('.status-select').val();
    if (selectedValue == 'Reached_ams') {
      window.location.href = "security-received.php";
    }
  });
});



$(document).ready(function() {
    $('.update-status-btn').click(function(e) {
        e.preventDefault();
        
        var selectedStatus = $(this).siblings('.status-select').val();
var workId = $(this).siblings('.status-select').data('work-id');

        
        $.ajax({
            type: 'POST',
            url: 'security_delivery_status.php', // Replace 'update_status.php' with your update script
            data: { status: selectedStatus, workId: workId },
            success: function(response) {
                // If update is successful, update the displayed status in the table
                if (response === 'success') {
                    alert('Status updated successfully.');
                    // You may want to update the UI here if needed
                } else {
                    alert('Failed to update status.');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });
});



 </script>
</body>

</html>