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
    
    $pass_name = isset($_POST['name']) ? $_POST['name'] :"" ;
    $pass_type =  "security_pass";
    $block_no = isset($_POST['block_no']) ? $_POST['block_no'] :"" ;
    $flat_no = isset($_POST['flat_no']) ? $_POST['flat_no'] :"" ;
    $from_date = date("y-m-d");
    $to_date  = date("y-m-d") ; 
    $visitor_name = isset($_POST['visitor_name']) ? $_POST['visitor_name'] :"" ; 
    $visitor_contact = isset($_POST['visitor_contact']) ? $_POST['visitor_contact'] :"" ; 
    $visitor_gender = isset($_POST['visitor_gender']) ? $_POST['visitor_gender'] :"" ; 
    $visitor_age = isset($_POST['visitor_age']) ? $_POST['visitor_age'] :"" ; 
    $visiting_time = isset($_POST['visiting_time']) ? $_POST['visiting_time'] :"" ; 
    $visitor_proof = isset($_POST['visitor_proof']) ? $_POST['visitor_proof'] :"" ; 
    $v_status = "Approved";
    $query = "INSERT INTO ams_visitorpass 
    (created_by,
    Pass_type, 
    block_no, 
    flat_no, 
    from_date, 
    to_date, 
    Visitor_name,
    Visitor_gender,
    Visitor_age,
    Visitor_contact,
    Visiting_time,
    Visitor_proof,
    `v_status`) 
    VALUES ('$pass_name', 
    '$pass_type',
    '$block_no', 
    '$flat_no', 
    '$from_date', 
    '$to_date', 
    '$visitor_name',
    '$visitor_gender',
    '$visitor_age',
    '$visitor_contact',
    '$visiting_time',
    '$visitor_proof',
    '$v_status')";

    $con->query($query);

    $query1 = "SELECT * FROM ams_visitorpass WHERE flat_no = '$flat_no' AND Visitor_name = '$visitor_name' AND `v_status` = 'Approved'";

    $result = $con->query($query1);

  if ($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    $idNum = $row['V_ID'];
    echo $idNum;
    exit();
  }else {
    echo "Error";
  }

}
?>