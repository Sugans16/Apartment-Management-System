<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flat = $_POST['flat-no'];
    $block = $_POST['block-no'];
    $user = $_POST['susername'];
    $pass = $_POST['suserpassword'];
    $status = "Pending";

    $hostname = "localhost";
    $usernamee = "root";
    $password = "";
    $database = "ams";
    

    $con = new mysqli($hostname, $usernamee, $password, $database);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $query = "SELECT * FROM user_signup WHERE flat_no = '$flat' AND block_no = '$block' ";

    $result = $con->query($query);

    if ($result) {
        if ($result->num_rows >= 1) {
            $row = $result->fetch_assoc();

            if ($row['status'] == "Accepted") {
                $error = json_decode(file_get_contents('error.json'), true)['tamil6'];
                header('Content-Type: application/json');
                echo json_encode($error);
          exit();
            } elseif ($row['status'] == "Rejected") {
                $updateQuery = "UPDATE user_signup 
                                SET username = '$user',
                                `u_password` = '$pass',
                                `status` = 'Pending'
                                WHERE flat_no = '$flat' ";
                
                $con->query($updateQuery);
                $error = json_decode(file_get_contents('error.json'), true)['tamil8'];
                header('Content-Type: application/json');
                echo json_encode($error);
                
            }
            else {
                $error = json_decode(file_get_contents('error.json'), true)['tamil2'];
          header('Content-Type: application/json');
          echo json_encode($error);
          exit();
            }
        } else {
            $insertQuery = "INSERT INTO user_signup (block_no, flat_no, username, u_password, `status`) 
                            VALUES ('$block', '$flat', '$user', '$pass', '$status')";
            
            if ($con->query($insertQuery)) {
                $error = json_decode(file_get_contents('error.json'), true)['tamil7'];
          header('Content-Type: application/json');
          echo json_encode($error);
          exit();
            } else {
                echo "Error: " . $con->error;
            }
        }
    } else {
        echo "Error: " . $con->error;
    }

    // Close the connection
    $con->close();
}
?>