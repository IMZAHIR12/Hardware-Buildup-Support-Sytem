<?php

global $conn;
require_once '../connection.php';

if (isset($_POST['inputValue'])){
    $inputvalue = $_POST['inputValue'];
    $sql = 'SELECT * FROM software where software_id ="'. $inputvalue .'"';
    $result = $conn->query($sql);

    $data = '';
    $datas = [];
    $motherboards = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = $row['software_motherboard'];
        }
    }


    $datas[] = explode(',', $data);

    foreach ($datas[0] as $motherboard_id) {
        $sql = 'SELECT * FROM motherboard where motherboard_id ="'. $motherboard_id .'"';
        $result = $conn->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = $row;
            }
        }

        array_push($motherboards, $data);
    }

    $conn->close();



    header('Content-Type: application/json');

    echo json_encode($motherboards);
}

?>