<?php
include('db_connection.php');

$query = "SELECT Visitor_proof FROM ams_visitorpass WHERE V_ID=?";
$v_id = "VP27";

$stmt = $con->prepare($query);

if (!$stmt) {
    die("Error in statement preparation: " . $con->error);
}

$stmt->bind_param("s", $v_id);
$stmt->execute();

$stmt->bind_result($imageData);
$stmt->fetch();
$stmt->close();

header("Content-type: image/jpeg"); // Adjust the content type based on your image type (JPEG, PNG, etc.)
echo $imageData;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Website</title>

    <style>
        img {
            height: 200px;
            width: 200px;
            display: block; /* Change display to block to make the image visible */
        }
    </style>
</head>
<body>
    <img src="dummy1.php" alt="Image" style="height: 200px;">
</body>
</html>