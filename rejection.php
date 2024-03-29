<?php

$hostname = "localhost";
$usernamee = "root";
$password = "";
$database = "ams";

$con = mysqli($hostname, $usernamee, $password, $database);

$form_id = $_POST['form_id'];
$flat_no = $_POST['flat_no'];
$block_no = $_POST['block_no'];
$user = $_POST['username'];
$pass = $_POST['pass'];

  if ($form_id == "form1"){
    $query = "UPDATE user_signup 
            SET `status` = 'Accepted'
            WHERE flat_no = '$flat_no' and block_no = '$block_no' ";

    $con->query($query);

    $query = "SELECT * FROM users WHERE flat_no = '$flat_no' AND block_no = '$block_no' ";

    $result = $con->query($query);

    if ($result) {
        if ($result->num_rows >= 1) {
          $query = "UPDATE users 
          SET username = '$user', `password` = '$pass' 
          WHERE flat_no = '$flat_no' and block_no = '$block_no' ";

          $con->query($query);

        }
        else {
          $query = "INSERT INTO users (block_no, flat_no, username, `password`) VALUES ('$block_no', '$flat_no', '$user', '$pass') ";

          $con->query($query);
        }

  } else if ($form_id == "form2"){
    $query = "UPDATE user_signup 
    SET `status` = 'Rejected'
    WHERE flat_no = '$flat_no' and block_no = '$block_no' ";

    $con->query($query);
  }

}

?>
