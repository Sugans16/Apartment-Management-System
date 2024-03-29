<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["maintenance"])) { 
    $user_cookie = $_COOKIE['maintenance'] ?? "";
} else {
    header("Location: maintenance.php");
    exit;
}

include("db_connection.php");

$query1 = "SELECT sub_role FROM ams_maintenance WHERE maintenance_id = ?";
$stmt = $con->prepare($query1);
$stmt->bind_param("s", $user_cookie);
$stmt->execute();
$result1 = $stmt->get_result();

if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    $field = $row1["sub_role"];
} else {
    // Handle situation when no matching record is found
    // You might want to set a default value for $field or handle this scenario as per your application logic
    $field = "default_value"; // Replace 'default_value' with an appropriate default value
}

$stmt->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Maintenance</title>
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
      <h1 class="list-head"> Progress Works </h1>
      <table class="list-table">
        <thead>
          <tr>
            <th>Serial No</th>
            <th>Block NO</th>
            <th>Flat NO</th>
            <th>Works</th>
            <th>Date of work</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="requestBody">
        <?php
              include('db_connection.php');

              $sql = "SELECT * FROM ams_works WHERE updated_by='$user_cookie' and `status`='In_Progress'";
              $result = $con->query($sql);
              $sno=1;
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . $row["block_no"] . "</td>";
                    echo "<td>" . $row["flat_no"] . "</td>";                    
                    echo "<td>" . $row["work"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>
    <select class='status-select' data-work-id='" . $row['id'] . "'>
        <option value='Pending'" . ($row['status'] == 'Pending' ? ' selected' : '') . ">Pending</option>
        <option value='In_Progress'" . ($row['status'] == 'In_Progress' ? ' selected' : '') . ">In Progress</option>
        <option value='Completed'" . ($row['status'] == 'Completed' ? ' selected' : '') . ">Completed</option>
    </select>
    <button class='update-status-btn'>Submit</button>
</td>";
                    echo "</tr>";
                  }
              } else {
                  // echo "0 results";
              }
              $con->close();
              ?>
        </tbody>
      </table>
    </div>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
  $(".update-status-btn").click(function() {
    var selectedValue = $(this).siblings('.status-select').val();
    if (selectedValue == 'Pending') {
      window.location.href = "maintain-work.php";
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
            url: 'update_status.php', // Replace 'update_status.php' with your update script
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