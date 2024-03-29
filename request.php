<?php
$hostname = "localhost";
$usernamee = "root";
$password = "";
$database = "ams";

$con = new mysqli($hostname, $usernamee, $password, $database);

$query = "SELECT * FROM user_signup WHERE `status` = 'Pending' ORDER BY `id` DESC";

try {
    $result = mysqli_query($con, $query);

    if ($result) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode(array('rows' => $rows));
    } else {
        echo json_encode(array('error' => 'Failed to fetch data from the database'));
    }
} catch (mysqli_sql_exception $e) {
    echo json_encode(array('error' => 'Error in fetching data: ' . $e->getMessage()));
}
?>