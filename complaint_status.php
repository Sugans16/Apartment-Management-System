<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "ams";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE ams_complaint SET current_status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("location: dummy1.php");
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

$conn->close();
?>
