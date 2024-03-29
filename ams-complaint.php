<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])){

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Admin Complaint Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="request-table.css">
  <style>
.modal {
    display: none;
    position: fixed;
    top: 250px;
    left: 260px;
    font-size:18px;
    margin-left: 32%;
    transform: translate(-50%, -50%);
    background: linear-gradient(to bottom right, #325CC8, #6998E8 ,#BBD3F5);
    padding: 20px;
    z-index: 9999;
    width: 40%; 
    margin-top: 30px; 
    box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
    cursor: pointer;
    border-radius: 20px;
}
.modal-content {
    font-family: Arial, sans-serif;
    font-size: 16px;
    font-weight: 600px;
    color: #f0f0f0;
    padding: 10px;
  }
  
  .modal-content span {
    font-weight: bold;
    font-size:18px;
    color: #333;
}

.modal-content .close{
position: absolute;
right: 20px;
top: 10px;
font-size: 35px;
}

.modal-header {
    display: flex;
    justify-content: center;
    margin-top: 25px;
    margin-bottom: 20px;
}

.modal-info {
    flex: 100%; /* Adjust width as needed */
}

.modal-info.description {
    flex: 0 0 100%;
    text-align: center;
    margin-bottom: 20px;
}

.modal-content .close {
    position: absolute;
    color: #FF0000 ;
    right: 20px;
    top: 10px;
    font-size: 35px;
}
#statusDropdown{
  margin-bottom: 20px;
  font-weight: bold;
  color: #333;
  /* background-color:#AAAA; */
}
#submitBtn {
    background-color: #FC8621;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s, padding 0.3s; /* Transition for color change and padding */
    cursor: pointer;
}

#submitBtn:hover {
    background-color: #FC8621; /* Adjusted color on hover */
    padding: 15px 25px; /* Adjusted padding on hover */
    box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
}

    </style>
</head>

<body>
  <div class="backgroundimg-home">
    <header>
      <nav>
        <a href="admin-homepage.php"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>


      <h1 class="list-head">Complaint Form</h1>
    <?php
    include("db_connection.php");
    ?>

    <div class="card_containerz">
        <?php
        $sql = "SELECT * FROM ams_complaint ORDER BY id DESC";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="cardz">';
                echo'<div class="box">';
                echo'<div class="boz">';
                echo '<div class="round">';
                echo '<span id="id">' . $row['id'] . '</span>';
                echo '</div>';
                echo '<div class="user">';
                echo '<label for="username">username </label> <br>';
                echo '<span id="username">' . ucfirst($row['Username'] ). '</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="">';
                echo '<label for="complaint_value">ComplaintReg </label> <br>';
                echo '<span id="complaint_value">' . ucwords($row['ComplaintRegarding']) . '</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="description-container">';
                $description = $row['Description'];
                echo '<div class="description-container">';
                echo '<div class="description-content">';
                if (strlen($description) > 20) {
                    echo '<span class="truncated-description">' . ucwords(substr($description, 0, 20)) . '</span>';
                    echo '<span class="full-description" style="display:none;">' . ucwords($description) . '</span>';
                    echo '<span class="expand-description" onclick="expandDescription(this)">...</span>';
                } else {
                    echo ucwords($description);
                }
                echo '</div>';
                echo '</div>';
                echo '<span class="hidden-full-description" style="display:none;">' . $description . '</span>';
                echo '</div>';            
                echo '<div class="box3">';               
                echo '<label for="status_value">Status: </label>';
                echo '<span id="status_value">' . ucwords($row['current_status']) . '</span>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No complaints found.";
        }
        ?>
    </div>
    <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="modal-header">
            <div id="modalName" class="modal-info">Username: <span id="modalUsername"></span></div>
            <div id="modalCom" class="modal-info">Regarding: <span id="modalComplaint"></span></div>
        </div>
        <div id="modalDes" class="modal-info description">Description: <br><span id="modalDescription"></span></div>
        <select id="statusDropdown">
            <option selected disabled>Pending</option>
            <option value="In_progress">In Progress</option>
            <option value="Issue_resolved">Issue Resolved</option>
        </select><br>
        <button id="submitBtn">Submit</button>
    </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.cardz');
    const modal = document.getElementById('myModal');
    const closeBtn = document.querySelector('.close');
    const statusDropdown = document.getElementById('statusDropdown');
    let selectedCardId = null;

    cards.forEach(card => {
        card.addEventListener('click', function () {
            modal.style.display = 'block';
            selectedCardId = this.querySelector('#id').textContent;
            const username = this.querySelector('#username').textContent;
            const complaintReg = this.querySelector('#complaint_value').textContent;
            const status = this.querySelector('#status_value').textContent;
            const fullDescription = this.querySelector('.hidden-full-description').textContent;
            const capitalizedDescription = fullDescription.charAt(0).toUpperCase() + fullDescription.slice(1);
            document.getElementById('modalUsername').textContent = username;
            document.getElementById('modalComplaint').textContent = complaintReg;
            document.getElementById('modalDescription').textContent = capitalizedDescription;
            statusDropdown.value = status;
        });
    });


        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });

        document.getElementById('submitBtn').addEventListener('click', function () {
            const selectedStatus = statusDropdown.value;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'complaint_status.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
              if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            modal.style.display = 'none';
            location.reload(); 
          } else {
            console.error('Error:', xhr.statusText);
          }
        }
            };
            xhr.send(`id=${selectedCardId}&status=${selectedStatus}`);
        });
    });
</script>

<?php
}else {
    header("location: admin-homepage.php");
}
?>
</body>

</html>
