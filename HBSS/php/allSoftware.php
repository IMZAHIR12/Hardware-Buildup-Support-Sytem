<?php

global $conn;
require_once 'connection.php';


$sql = "SELECT * FROM software";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');

echo json_encode($data);

?>