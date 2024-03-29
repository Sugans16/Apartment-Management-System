<?php
include('db_connection.php');


$username = $_COOKIE['user']; // Assuming you have a user ID stored in a session
$sql1 = "SELECT `password` FROM users WHERE username = '$username'";
$result1 = $con->query($sql1);

if ($result1) {
    if ($result1->num_rows > 0) {
        // Output data of each row
        while ($row = $result1->fetch_assoc()) {
            $opassword = $row["password"]; 
            }
    }
}
// Fetch values from the users table
// Retrieve form data


$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$email = $_POST['email'] ?? '';
$contact = $_POST['contact'] ?? '';
$total_person = $_POST['total_person'] ?? '';
$disabledperson = $_POST['disabledPersoncount'] ?? '';
$cpassword = $_POST['password-confirm'] ?? '';


if($opassword == $cpassword){
// Prepare SQL statement for insertion
$sql = "UPDATE users SET first_name='$fname', last_name='$lname', email='$email', contact='$contact', number_of_persons='$total_person', disabled_person='$disabledperson' WHERE username = '$username'";

$final = $con->query($sql);

if ($final === TRUE) {
    if (isset($fname)){
        setcookie("tenant", $fname);
    }
    header("Location: user-profile-update.php");
    $con->close();
    exit();
} else {
    echo "Error inserting data: " . $con->error;
}
}
else{
    header("Location: user-profile-update.php");
    $con->close();
    exit();
}
// Close the connection
?>
