<?php

global $conn;
require_once '../connection.php';

if (isset($_POST['inputValue'])){
    $inputvalue = $_POST['inputValue'];
    $sql = 'SELECT * FROM software where software_id ="'. $inputvalue .'"';
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
}

?>