<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])) { 
    $user_cookie = $_COOKIE['admin'] ?? "";
}
else if (!isset($_COOKIE["admin"])){
  header("Location: admin.php");
  exit;
}

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_role = $_POST['staff-role'] ?? "";
    $staff_name = $_POST['staff_name'] ?? "";
    $email = $_POST['staff-email'] ?? "";
    $pass = $_POST['staff-password'] ?? "";
    $sub_role = $_POST['sub_role'] ?? "";

    $hostname = "localhost";
    $usernamee = "root";
    $password = "";
    $database = "ams";

    
    
   try {
    $con = new mysqli($hostname, $usernamee, $password, $database);
    if ($staff_role == "Security"){
      $query = "INSERT INTO ams_security (f_name,email, s_password) VALUES ('$staff_name','$email', '$pass')";
      $con->query($query);
      $output=true;
      echo $output;

  } else if ($staff_role == "Maintenance"){
      $query = "INSERT INTO ams_maintenance (f_name,email, sub_role,m_password) VALUES ('$staff_name','$email','$sub_role' ,'$pass')";

        $con->query($query);
        $output=true;
        echo $output;
      }
   }catch (Exception) {
    $output=false;
    echo $output;
   }
      
    
  }

?>