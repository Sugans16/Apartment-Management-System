<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hostname = "localhost";
    $usernamee = "root";
    $password = "";
    $database = "ams";

    $con = new mysqli($hostname, $usernamee, $password, $database);

    $select = $_POST["value"];
    if($select == 'users'){
        $query = "SELECT * FROM users" ; 
        $result = $con->query($query);
        while($row = $result->fetch_assoc()){
            echo "<tr> ";
            echo "<td>". $row['sno'].
            "</td> <td>" . $row['blockno'].
            "</td> <td>" . $row['flatno']. 
            "</td> <td>" . $row['name'].
            "</td> <td>" .$row['contact'].
            "</td> <td>" . $row['email'].
            "</td> <td>" . $row['username']. 
            "</td>";
            echo "</tr>";
        }
    }
    elseif($select == 'security'){
        $query = "SELECT * FROM ams_security" ; 
        $result = $con->query($query);
        while($row = $result->fetch_assoc()){
            echo "<tr> ";
            echo "<td>". $row['sno'].
            "</td> <td>" . $row['securityid'].
            "</td> <td>" . $row['name'].
            "</td> <td>" .$row['contact'].
            "</td> <td>" . $row['email'].
            "</td> <td>" . $row['username']. 
            "</td>";
            echo "</tr>";
        }
    }
    else{
        $query = "SELECT * FROM ams_maintenance"; 
        $result = $con->query($query);
        while($row = $result->fetch_assoc()){
            echo "<tr> ";
            echo "<td>". $row['sno'].
            "</td> <td>" . $row['securityid'].
            "</td> <td>" . $row['name'].
            "</td> <td>" .$row['contact'].
            "</td> <td>" . $row['email'].
            "</td> <td>" . $row['username']. 
            "</td>";
            echo "</tr>";
        }
    }
    $con->close();
}
?>