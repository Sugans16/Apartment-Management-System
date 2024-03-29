<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "ams";

$con = new mysqli($hostname, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Check if the POST variables are set
if (isset($_POST['visitor_proof'], $_POST['visitor_details'], $_POST['visitor_details_upload'])) {
    $a = $_POST['visitor_proof'];
    $b = $_POST['visitor_details'];
    $c = $_POST['visitor_details_upload'];
    $id=$_POST['id'];

   $query=" UPDATE VisitorTable
    SET visitor_proof = '$a', proof_upload = '$b', visitor_details = '$c'
    WHERE id=$id";
    
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        echo "Record inserted successfully.";
    } else {
        echo "Error executing query: " . $con->error;
    }
} else {
    echo "One or more POST variables are not set.";
}

// Close the database connection when done
$con->close();
?>
