<?php

global $conn;
require_once '../connection.php';

if (isset($_POST['inputValue'])){
    $inputvalue = $_POST['inputValue'];
    $sql = 'SELECT * FROM games where games_id ="'. $inputvalue .'"';
    $result = $conn->query($sql);

    $data = '';
    $datas = [];
    $cpus = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = $row['games_cpu'];
        }
    }


    $datas[] = explode(',', $data);

    foreach ($datas[0] as $cpu_id) {
        $sql = 'SELECT * FROM cpu where cpu_id ="'. $cpu_id .'"';
        $result = $conn->query($sql);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data = $row;
            }
        }

        array_push($cpus, $data);
    }

    $conn->close();



    header('Content-Type: application/json');

    echo json_encode($cpus);
}

?>