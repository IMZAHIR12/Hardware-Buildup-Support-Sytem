<?php

global $conn;
require_once '../connection.php';

if (isset($_POST['inputValue'])){
    $inputvalue = $_POST['inputValue'];
    $sql = 'SELECT     
                `users_id`,
                `users_name`,
                `users_image`,
                `users_birth`,
                `users_email`,
                `users_jobtilte`,
                `users_gender`,
                `users_nationality`,
                `users_uesrname` 
            FROM 
                users 
            where users_id ="'. $inputvalue .'"'; 
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