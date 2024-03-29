<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "ams";

// Create connection
$con = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>