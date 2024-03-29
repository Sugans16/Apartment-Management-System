<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint Management</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css"> 
  <link rel="stylesheet" href="request-table.css"> 
  <style>
  .complaint-drawer {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%; /* Full width initially */
    max-width: 0; /* Hide off-screen */
    height: 100%;
    background-color: #ACC2E4; /* Set your desired background color */
    z-index: 1050;
    overflow-x: hidden;
    align-items: center;
    transition: max-width 0.3s ease-in-out; /* Transition the max-width property */
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2); /* Optional: Add shadow effect */
  }

  .drawer-open {
    max-width: 400px; /* Adjust the width to display the drawer */
  }
  .card .card-header {
  background-color: #FC8621 ; /* Background color for the card header */
  color: #333; /* Text color for the card header */
  font-size: 14px;
  font-weight: bold;
  padding: 10px; /* Adjust padding as needed */
  border-bottom: 1px solid #f03f3f; /* Optional: Add a border */
}

.card .card-body {
  background-color: #6998E8; /* Background color for the card body */
  color: #333; /* Text color for the card body */
  padding: 15px; /* Adjust padding as needed */
  border-bottom: 1px solid #c3e6cb; /* Optional: Add a border */
}

.card .card-body label {
  font-size: 14px;
  color: #333; /* Text color for the card body */
}

.card .card-body select {
  font-size: 14px;
  font-weight: bold;
  color: #333; /* Text color for the card body */
}

.card .card-body textarea {
  font-size: 14px;
  font-weight: bold;
  color: #333;
  height: 290px; /* Set the desired height */
  resize: vertical; /* Allow vertical resizing */
  border: 1px solid #ccc; /* Border style */
  padding: 8px; /* Adjust padding */
}
</style>
</head>
<body>
  <div class="backgroundimg-home">
    <header>
      <nav>
        <a href="user-homepage.php"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>

    <!-- <section class="container-form-complaint"> -->
      <h1 class="list-head">Complaint Form</h1>
  <?php
  // Database connection details
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ams";

  // Create connection
  $conn = new mysqli($hostname, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Handle form submission
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $complaintReg = mysqli_real_escape_string($conn, $_POST['ComplaintRegarding']);
      $complaintDes = mysqli_real_escape_string($conn, $_POST['Description']);

      $sql = "INSERT INTO ams_complaint (ComplaintRegarding, `Description`, current_status)
        VALUES ('$complaintReg', '$complaintDes', 'Pending')";

      if ($conn->query($sql) === TRUE) {
          echo "Complaint registered successfully!";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }
  ?>

  <div class="card_containerz">
    <?php
    // Fetch data from the database
    $sql = "SELECT * FROM ams_complaint";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data in card format
        while ($row = $result->fetch_assoc()) {
            echo '<div class="cardz cardz1">';
            echo '<div class="box5">';
             echo '<div class="round">';
                
            echo '<span id="id">' . $row['id'] . '</span>';
             echo '</div>';
                
             echo '<div class="come">';
            echo '<label for="complaint_value">Complaint Regarding: </label><br>';
            echo '<span id="complaint_value">' . ucfirst($row['ComplaintRegarding']) . '</span>';
             echo '</div>';
            echo '</div>';

            echo '<div class="description-container">';
            
            echo '<div id="description_value" class="description-content">';
            echo  ucwords($row['Description']);
            echo '</div>';
           
            echo '</div>';
            echo '<div>';
            echo '<label for="status_value">Status: </label>';
            echo '<span id="status_value">' . ucwords($row['current_status']) . '</span>';
            echo '</div>';
            
            echo '</div>';
        }
    } else {
        echo "No complaints found.";
    }
    ?>
  <!-- </section> -->
  <button type="button" class="btn btn-primary plus" onclick="toggleDrawer()">
    <i class="fas fa-plus"></i> 
  </button>

  <!-- Complaint Drawer -->
  <div class="complaint-drawer" id="complaintDrawer">
    <div class="card">
      <div class="card-header">
        Complaint Form
        <button type="button" class="close" onclick="toggleDrawer()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <!-- Complaint form -->
        <form action='dummy.php' method='post'>
          <!-- Your form elements -->
          <div class="form-group">
            <label for="complaintReg">Complaint Regarding</label>
            <select class="form-control" id="complaintReg" name="ComplaintRegarding" required>
              <option value="" disabled selected>Choose...</option>
              <option value="Residents">Resident</option>
              <option value="Security">Security</option>
              <option value="Maintenance">Maintenance</option>
            </select>
          </div>
          <div class="form-group">
            <label for="complaintDes">Description</label>
            <textarea class="form-control" id="complaintDes" name="Description" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
  

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const showMoreButtons = document.querySelectorAll('.show-more-btn');
      showMoreButtons.forEach(button => {
        button.addEventListener('click', function() {
          const content = this.previousElementSibling;
          content.classList.toggle('show-more-content');
          if (content.classList.contains('show-more-content')) {
            this.textContent = 'Show Less';
            content.style.maxHeight = 'none';
          } else {
            this.textContent = 'Show More';
            content.style.maxHeight = '100px'; /* Adjust the maximum height based on your card design */
          }
        });
      });
    });

    function toggleForm() {
      var formContainer = document.getElementById('form-container');
      formContainer.style.display = (formContainer.style.display === 'none' || formContainer.style.display === '') ? 'block' : 'none';
    }

    function toggleDrawer() {
      const drawer = document.getElementById('complaintDrawer');
      drawer.classList.toggle('drawer-open');
    }
  </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>