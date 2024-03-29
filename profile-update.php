<?php
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["admin"])){

$username = $_COOKIE['admin']; // Assuming you have a user ID stored in a session

$sql1 = "SELECT `a_password` FROM ams_admin WHERE BINARY a_username = '$username' or BINARY a_email = '$username' or BINARY a_mobile_no = '$username' or BINARY a_fname = '$username' ";
$result1 = $con->query($sql1);

if ($result1) {
    if ($result1->num_rows > 0) {
        
        while ($row = $result1->fetch_assoc()) {
            $opassword = $row["a_password"]; 
            }
    }
}



$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$email = $_POST['email'] ?? '';
$contact = $_POST['contact'] ?? '';
$cpassword = $_POST['password-confirm'] ?? '';


if($opassword == $cpassword){

    $sql = "UPDATE ams_admin SET a_fname='$fname', a_lname='$lname', a_email ='$email', a_mobile_no='$contact' WHERE a_username = '$username' OR a_email = '$username' OR a_mobile_no = '$username' OR a_fname = '$username'";

    $final = $con->query($sql);

    if ($final === true) {
        setcookie("admin", $fname);
        $msg = array(
            'first_name' => ucfirst($fname),
            'output' => true
        );
        header('Content-Type: application/json');
        echo json_encode($msg);
        $con->close();
        exit();
    } else {
        echo "Error inserting data: " . $con->error;
    }
}
else{
    $output=false;
    header('Content-Type: application/json');
    echo json_encode($output);
    exit();
}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["maintenance"])){
    
$m_id = $_COOKIE['maintenance']; // Assuming you have a user ID stored in a session
$sql1 = "SELECT `m_password` FROM ams_maintenance WHERE maintenance_id = '$m_id'";
$result1 = $con->query($sql1);

if ($result1) {
    if ($result1->num_rows > 0) {
        // Output data of each row
        while ($row = $result1->fetch_assoc()) {
            $opassword = $row["m_password"]; 
            }
    }
}
// Fetch values from the users table
// Retrieve form data


$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$email = $_POST['email'] ?? '';
$contact = $_POST['contact'] ?? '';
$cpassword = $_POST['password-confirm'] ?? '';


if($opassword == $cpassword){
// Prepare SQL statement for insertion
$sql = "UPDATE ams_maintenance SET f_name='$fname', l_name='$lname', email='$email', mobile='$contact' WHERE maintenance_id = '$m_id'";

$final = $con->query($sql);

if ($final === TRUE) {
    $msg = array(
        'output' => true,
        'name' => ucfirst($fname)
    );
    header('Content-Type: application/json');
    echo json_encode($msg);
} else {
    echo "Error inserting data: " . $con->error;
}
}
else{
    $output=false;
    header('Content-Type: application/json');
    echo json_encode($output);
}
// Close the connection
$con->close();
exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["security"])){
    $s_id = $_COOKIE['security']; // Assuming you have a user ID stored in a session
    $sql1 = "SELECT `s_password` FROM ams_security WHERE security_id = '$m_id'";
    $result1 = $con->query($sql1);
    
    if ($result1) {
        if ($result1->num_rows > 0) {
            // Output data of each row
            while ($row = $result1->fetch_assoc()) {
                $opassword = $row["s_password"]; 
                }
        }
    }
    // Fetch values from the users table
    // Retrieve form data
    
    
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $email = $_POST['email'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $cpassword = $_POST['password-confirm'] ?? '';
    
    
    if($opassword == $cpassword){
    // Prepare SQL statement for insertion
    $sql = "UPDATE ams_security SET f_name='$fname', l_name='$lname', email='$email', mobile='$contact' WHERE securitye_id = '$s_id'";
    
    $final = $con->query($sql);
    
    if ($final === TRUE) {
        $msg = array(
            'output' => true,
            'name' => ucfirst($fname)
        );
        header('Content-Type: application/json');
        echo json_encode($msg);
    } else {
        echo "Error inserting data: " . $con->error;
    }
    }
    else{
        $output=false;
        header('Content-Type: application/json');
        echo json_encode($output);
    }
    // Close the connection
    $con->close();
    exit();  
}
?>
