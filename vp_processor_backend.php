<?php

include_once 'db_connection.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitor_id = $_POST['VP_ID'];

    $query = "SELECT * FROM ams_visitorpass WHERE `V_ID` = '$visitor_id' ";
    
    try{
      $result = $con->query($query);

      if ($result->num_rows >= 1) {
        $row = $result->fetch_assoc();
        $output = array (
            'pass_type' => $row['Pass_type'],
            'block_no' => $row['block_no'],
            'flat_no' => $row['flat_no'],
            'from' => $row['from_date'],
            'to' => $row['to_date'],
            'visitor_name' => $row['Visitor_name'],
            'gender' => $row['Visitor_gender'],
            'age' => $row['Visitor_age'],
            'visitor_count' => $row['Visitor_count'],
            'contact' => $row['Visitor_contact'],
            'time' => $row['Visiting_time'],
            'proof' => base64_encode($row['Visitor_proof']),
            'v_status' => $row['v_status'],
            'v_id' => $row['V_ID']
            
          );

          $_SESSION['output'] = $output;
        header('Content-Type: application/json');
        echo json_encode($output);
       exit();
      } 
    } catch(mysqli_sql_exception) {
      echo "Connection Error";
    }

} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json');
    if (isset($_SESSION['output'])) {
        echo json_encode($_SESSION['output']);
        exit(); 
    } else {
        echo json_encode(array());
        exit(); 
    }
}
?>