<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_COOKIE["admin"])) {
  $user_cookie = $_COOKIE['admin'] ?? "";

  $hostname = "localhost";
  $usernamee = "root";
  $password = "";
  $database = "ams";

  $con = mysqli_connect($hostname, $usernamee, $password, $database);


  $form_id = $_POST['form_id'];
  $flat_no = $_POST['flat_no'];
  $block_no = $_POST['block_no'];
  $user = $_POST['username'];
  $pass = $_POST['pass'];

  if ($form_id == "form1") {
    $query = "UPDATE user_signup 
            SET `status` = 'Accepted'
            WHERE flat_no = '$flat_no' and block_no = '$block_no' ";

    $con->query($query);

    $query = "INSERT INTO users (block_no, flat_no, username, `password`) VALUES ('$block_no', '$flat_no', '$user', '$pass') ";

    $con->query($query);
    $msg = "inserted";
    echo $msg;
  } else if ($form_id == "form2") {
    $query = "UPDATE user_signup 
    SET `status` = 'Rejected'
    WHERE flat_no = '$flat_no' and block_no = '$block_no' ";

    $con->query($query);
    $msg = "updated";
    echo $msg;
  }
  
} else  {
  header("Location: admin.php");
  exit();
}

?>
