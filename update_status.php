<?php
// Include your database connection file
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if status, work ID, and maintenance cookie are set in the POST request
    if (isset($_POST['status']) && isset($_POST['workId']) && isset($_COOKIE['maintenance'])) {
        $status = $_POST['status'];
        $workId = $_POST['workId'];
        $user_cookie = $_COOKIE['maintenance'];

        // Update the status and updated_by in the database using normal query
        $updateQuery = "UPDATE ams_works SET status = '$status', updated_by = '$user_cookie' WHERE id = $workId";

        if ($con->query($updateQuery) === TRUE) {
            echo "success";
        } else {
            echo "Error updating status: " . $con->error;
        }
    } else {
        echo "Invalid data received";
    }
} else {
    echo "Invalid request method";
}

// Close the database connection
$con->close();
?>
