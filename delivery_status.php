<?php
include('db_connection.php');



$resident_name = $_POST['name'] ?? '';
$block_no =$_POST['block_no'] ?? '';
$flat_no = $_POST['flat_no'] ?? '';
$delivery_date = $_POST['delivery_date'] ?? '';
$delivery_type = $_POST['delivery_type'] ?? '';
$delivery_mode = $_POST['delivery_mode'] ?? '';
$time_to_deliver = $_POST['time_to_deliver'] ?? '';

// Prepare SQL statement for insertion
$sql = "INSERT INTO ams_delivery (resident_name, block_no, flat_no, delivery_date, delivery_type, mode_of_delivery, slot) VALUES ('$resident_name', '$block_no', '$flat_no', '$delivery_date', '$delivery_type', '$delivery_mode', '$time_to_deliver')";
$final = $con->query($sql);

if ($final) {
    echo "Values inserted";
    header("Location: delivery.php");
    exit();
} else {
    echo "Error inserting data: " . $con->error;
}

// Close the connection
$con->close();
?>
