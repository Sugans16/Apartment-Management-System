<?php 

include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['v_id'])) {

    $v_id = $_POST['v_id'] ?? "hi";
    $status = $_POST['verification'];

    echo $v_id . "THIS IS V_ID";

    $query = "UPDATE ams_visitorpass SET v_status = '$status' WHERE V_ID = '$v_id' ";

    $con->query($query);

    header("location: scanner.html");
    exit();
}

?>