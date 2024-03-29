<?php
include_once 'db_connection.php';

$query = "SELECT * FROM ams_complaint";

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