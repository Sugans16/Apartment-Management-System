<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $blockNo = $_POST['blockno'];
    $flatNo = $_POST['flatno'];
    $uname = $_POST['name'];
    $workType = $_POST['worktype'];
    $work = $_POST['work'];
    $date = $_POST['date'];

    // Establish a database connection
    include("db_connection.php");

    // Create the SQL query (without sanitizing)
    $insertQuery = "INSERT INTO ams_works (block_no, flat_no, username, work_type, work, `date`, `status`) VALUES ('$blockNo', '$flatNo', '$uname', '$workType', '$work', '$date', 'Pending')";

    // Execute the query
    if ($con->query($insertQuery) === TRUE) {
        header("location:alot_work.php");
    } else {
        header("location:alot_work.php");
        echo "Error inserting work: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>
