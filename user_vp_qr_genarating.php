<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "ams";

    $con = new mysqli($hostname, $username, $password, $database);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    
    if (isset($_FILES['visitor_proof'])) {
      
    $pass_name = $_POST['name'];
    $pass_type = $_POST['pass_type'];
    $block_no = $_POST['block_no'];
    $flat_no = $_POST['flat_no'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $visitor_name = $_POST['visitor_name'];
    $visitor_count = (string)$_POST['visitor_count'];
    $visitor_contact = $_POST['visitor_contact'];
    $visitor_gender =$_POST['visitor_gender'];
    $visitor_age = (string)$_POST['visitor_age'];
    $visiting_time =$_POST['visiting_time'];
    $visitor_proof_data = file_get_contents($_FILES['visitor_proof']['tmp_name']);
    $v_status = "Pending";

    // Prepare the query with a placeholder for the BLOB data
$query = "INSERT INTO ams_visitorpass (
  created_by,
  Pass_type,
  block_no, 
  flat_no, 
  from_date, 
  to_date, 
  Visitor_name,
  Visitor_count,
  Visitor_gender,
  Visitor_age, 
  Visitor_contact,
  Visiting_time,
  Visitor_proof, 
  v_status
) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $con->prepare($query);

// Bind parameters
// Bind parameters
$stmt->bind_param("sssssssssssssb", $pass_name, $pass_type, $block_no, $flat_no, $from_date, $to_date, $visitor_name, $visitor_count, $visitor_gender, $visitor_age, $visitor_contact, $visiting_time, $visitor_proof_data, $v_status);


// Execute the statement
$stmt->execute();

// Check for success
if ($stmt->affected_rows < 1) {
  echo "Error1: " . $stmt->error;
} 


    }else {
      echo "Error2";
    }
    
    

    $query1 = "SELECT * FROM ams_visitorpass WHERE flat_no = '$flat_no' AND Visitor_name = '$visitor_name' ORDER BY ID DESC";

    $result = $con->query($query1);

  if ($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    $idNum = $row['V_ID'];
    echo $idNum;
    exit();
  } else {
    echo "Error3";
  }

}
?>