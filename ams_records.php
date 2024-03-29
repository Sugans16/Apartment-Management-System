<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tab']) && isset($_COOKIE['admin'])) {
    $tab = $_POST['tab'];
    $sql = "";
    $headers = [];
    $fields = [];

    switch ($tab) {
        case 'residence':
            $sql = "SELECT * FROM users";
            $headers = ["Serial No", "Block no", "Flat no", "Username", "Email", "Phone No"];
            $fields = ["block_no", "flat_no", "username", "tenant_email", "tenant_phone_no"];
            break;
        case 'security':
            $sql = "SELECT * FROM ams_security";
            $headers = ["Serial No", "Security Id", "Firstname", "Lastname", "Email", "Phone No"];
            $fields = ["security_id", "f_name", "l_name", "email", "mobile"];
            break;
        case 'maintenance':
            $sql = "SELECT * FROM ams_maintenance";
            $headers = ["Serial No", "Maintenance Id", "Firstname", "Lastname", "Email", "Phone No"];
            $fields = ["maintenance_id", "f_name", "l_name", "email", "mobile"];
            break;
        default:
            echo "No records found";
            exit;
    }

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        echo "<table id='datatableid' class='list-table'>";
        echo "<thead>";
        echo "<tr>";
        foreach ($headers as $header) {
            echo "<th>$header</th>";
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $sno = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $sno++ . "</td>";
            foreach ($fields as $field) {
                echo "<td>" . ($row[$field] ?? "-") . "</td>";
            }
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No records found";
    }

    $con->close();
    exit;

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS-Records</title>
    <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-home.css">
    <link rel="stylesheet" href="request-table.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        .tab-btn.active {
    /* Your desired styles for the active tab */
    background-color: #FC8621;
    color: #fff;
    /* Add any other styling you want for the active tab */
}
#datatableid_paginate {
  margin-top: 10px;
}
.paginate_button .previous{
    border-radius: 3px;
}


#datatableid_paginate .paginate_button {
  display: inline-block;
  padding: 5px 10px;
  margin: 5px;
  margin-bottom: 50px;
  
  border-radius: 5%;
  background-color: #fff;
  color: #333;
  text-decoration: none;
  cursor: pointer;
  font-size:14px;
}

#datatableid_paginate .paginate_button.current {
  background-color: #325CC8;
  color: #fff;
}

#datatableid_paginate .paginate_button.disabled {
  pointer-events: none;
  opacity: 0.5;
}
#datatableid_length{
  background-color: #2A3650;
  padding-bottom: 15px;
  
  margin-top: 5px;
  width:20%;
  position:  absolute;
  /* border-radius: 100% 0% 0% 0%; */
  top: 160px;
  left: 370px;
  border-radius: 10px;
}
#datatableid_filter {
  background-color: #2A3650;
  padding: 10px;
  padding-bottom: 15px;
  /* border-radius: 0% 100% 0% 0%; */
  margin-top: 5px;
  
  width:25%;
  /* margin-bottom: 20px; */
  position: absolute;
  top: 160px;
  right: 370px;
  border-radius: 10px;
}
#datatableid_filter label,
#datatableid_length label {
  font-weight: Bold;
  color: #fff;
  font-size: 15px;
}

#datatableid_filter input[type="search"]{
  padding: 5px;
  border: 1px solid #333;
  margin-right: 50px;
  margin-left: 7px;
  margin-top: 0px;
  border-top: none;
  border-left: none;
  border-right: none;
  border-radius: 3px;
  width: 200px;
}
#datatableid_length select {
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-top: 5px;
  /* margin-left: 10px; */
  width: 70px;
}

#datatableid_info {
  margin-top: 10px;
  /* font-style: italic; */
  font-size: 15px;
}
</style>
</head>

<body>
    <div class="background-img-table">
        <header>
            <nav>
                <a href="admin-homepage.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
            </nav>
        </header>

        <div class="box">
            <div class="three-buttons">
                <button type="button"  id="residenceTab" onclick="showTab('residence')" class="img-text tab-btn">Residence Record</button>
                <button type="button" id="securityTab" onclick="showTab('security')" class="img-text tab-btn">Security Record</button>
                <button type="button" id="maintenanceTab" onclick="showTab('maintenance')" class="img-text tab-btn">Maintenance Record</button>
            </div>
            <div id="recordsTable">
                <!-- Records table will be displayed here -->
            </div>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("recordsTable").innerHTML = this.responseText;
                    // Initialize DataTable after updating HTML content
                    var tabButtons = document.getElementsByClassName("tab-btn");
                    for (var i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove("active");
            }

            // Add 'active' class to the clicked tab button
            document.getElementById(tabName + "Tab").classList.add("active");

                    let dataTable = new DataTable('#datatableid', {
                        paging: true,
                        searching: true, // You can enable searching if needed
                        // Add other DataTable options as needed
                    });
                }
            };
            xhttp.open("POST", "ams_records.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("tab=" + tabName);
        }
    </script>
</body>

</html>

